<?php
$act = isset($_POST['act']) ? $_POST['act'] : $_GET['act'];
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$error = [
    'count'     => 0,
    'title'     => '',
    'image'     => '',
    'issue'     => '',
    'tags'      => '',
    'youtubAPI' => ''
  ];
if($act == 'add' || $act == 'edit'){
  $r = [
    'id'        => $id,
    'title'     => $_POST['title'],
    'url'       => $_POST['url'],
    'image'     => 'images/placeholder.jpg',
    'issue'     => $_POST['issue'],
    'publisher' => $_POST['pub'],
    'category'  => $_POST['category'],
    'tags'      => $_POST['tags'],
    'comments'  => $_POST['comments'],
    'ti'        => strtotime($_POST['ti'])
  ];
  if($r['title'] == '' && $r['url'] == ''){
    $error['count']++;
    $error['title'] = '<div class="invalid-feedback">A <strong>Title</strong> wasn\'t entered.</div>';
  }
  if($r['issue'] == '' && $r['url'] == ''){
    $error['count']++;
    $error['issue'] = '<div class="invalid-feedback">An <strong>Issue Number</strong> wasn\'t entered.</div>';
  }
  if($r['tags'] == '' && $r['url'] == ''){
    $error['count']++;
    $error['tags'] = '<div class="invalid-feedback">No <strong>Tags</strong> were added.</div>';
  }
  if($settings['youtubeAPI'] == ''){
    $error['counte']++;
    $error['youtubeAPI'] = '<div class="alert alert-danger">The is no API Key set to retreive YouTube Video data.</div>';
  }
}
if($act == 'add'){
  if($error['count'] == 0){
    if($r['url']!=''){
      $video_id = explode("?v=", $r['url']);
      $video = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$video_id[1]."&key=".$settings['youtubeAPI']);
      $video = json_decode($video, true);
      $r['title'] = $video['items'][0]['snippet']['title'];
      $r['image'] = $video['items'][0]['snippet']['thumbnails']['maxres']['url'];
      $r['ti'] = strtotime($video['items'][0]['snippet']['publishedAt']);
      $r['publisher'] = $video['items'][0]['snippet']['channelTitle'];
      $r['category'] = 'youtube';
      $r['comments'] = $video['items'][0]['snippet']['description'];
      $tags = $video['items'][0]['snippet']['tags'];
      foreach($tags as $tag){
        $r['tags'].=$tag.',';
      }
    }else{
      if(isset($_FILES['image'])){
        $r['image'] = 'media/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES["image"]["tmp_name"],$r['image']);
      }
    }
    $q = $db -> prepare("INSERT INTO magazines (title,url,image,issue,publisher,category,tags,comments,ti) VALUES (:title,:url,:image,:issue,:publisher,:category,:tags,:comments,:ti)");
    $q -> execute(array(
      ':title'      =>  $r['title'],
      ':url'        =>  $r['url'],
      ':image'      =>  $r['image'],
      ':issue'      =>  $r['issue'],
      ':publisher'  =>  $r['publisher'],
      ':category'   =>  $r['category'],
      ':tags'       =>  $r['tags'],
      ':comments'   =>  $r['comments'],
      ':ti'         =>  $r['ti']
    ));
    $r['id'] = $db -> lastInsertId();
    $id=$r['id'];
  }else{
    $id = 0;
  }
}
if($act == 'edit'){
  if($error['count'] == 0){
    if($r['url']!=''){
      $video_id = explode("?v=", $r['url']);
      $r['image']="http://img.youtube.com/vi/".$video_id[1]."/maxresdefault.jpg";
    }else{
      if(isset($_FILES['image'])){
        $r['image'] = 'media/' . $_FILES['image']['name'];
        if(!file_exists('media/'.$_FILES['image']['name'])){
          move_uploaded_file($_FILES["image"]["tmp_name"],$r['image']);
        }
      }
    }
    $q = $db -> prepare("UPDATE magazines SET image=:image WHERE id=:id");
    $q -> execute(array(
      ':image'  =>  $r['image'],
      ':id'     =>  $id
    ));
    $q = $db -> prepare("UPDATE magazines SET title=:title,url=:url,issue=:issue,publisher=:publisher,category=:category,tags=:tags,comments=:comments,ti=:ti WHERE id=:id");
    $q->execute(array(
      ':title'      =>  $r['title'],
      ':url'        =>  $r['url'],
      ':issue'      =>  $r['issue'],
      ':publisher'  =>  $r['publisher'],
      ':category'   =>  $r['category'],
      ':tags'       =>  $r['tags'],
      ':comments'   =>  $r['comments'],
      ':ti'         =>  $r['ti'],
      ':id'         =>  $id
    ));
  }
}
if($id == 0){
  $r = [
    'id'        =>  0,
    'title'     =>  isset($_POST['title'])?$_POST['title']:'',
    'image'     =>  'images/placeholder.jpg',
    'url'       =>  isset($_POST['url'])?$_POST['url']:'',
    'issue'     =>  isset($_POST['issue'])?$_POST['issue']:'',
    'publisher' =>  isset($_POST['publisher'])?$_POST['publisher']:'',
    'category'  =>  isset($_POST['category'])?$_POST['category']:'',
    'tags'      =>  isset($_POST['tags'])?$_POST['tags']:'',
    'comments'  =>  isset($_POST['comments'])?$_POST['comments']:'',
    'ti'        =>  isset($_POST['ti'])?strtotime($_POST['ti']):time(),
  ];
}else{
  $q = $db->prepare("SELECT * FROM magazines WHERE id=:id");
  $q -> execute(array(':id' => $id));
  $r = $q -> fetch(PDO::FETCH_ASSOC);
}?>
<div class="container mt-3">
  <div id="item_<?php echo$r['id'];?>" class="media bg-primary">
<?php if(!file_exists($r['image'])){
  $r['image']='images/placeholder.jpg';
}elseif($r['image']==''){
  $r['image']='images/placeholder.jpg';
}?>
    <img class="align-self-start s256 mr-2" src="<?php echo$r['image'];?>">
    <div class="media-body mt-2 ml-2 mr-4">
<?php if($error['count'] > 0){?><div class="alert alert-danger">There were <strong><?php echo$error['count'];?></strong> errors found.</div><?php }
if($error['youtubeAPI']!='')echo$error['youtubeAPI'];?>
      <form action="index.php?page=edit&id=<?php echo$r['id'];?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="act" value="<?php if($id==0){echo'add';}else{echo'edit';}?>">

        <div class="form-group<?php if($error['title']!='')echo' has-danger';?>">
          <label for="title" class="<?php if($error['title']!='')echo' text-danger';?>">Title</label>
          <input type="text" class="form-control<?php if($error['title']!='')echo' is-invalid';?>" id="title" name="title" list="titlelist" value="<?php echo$r['title'];?>" placeholder="Enter Title...">
          <datalist id="titlelist">
<?php $sql = $db -> prepare("SELECT DISTINCT title FROM magazines WHERE title!='' ORDER BY title ASC");
$sql -> execute();
while($row = $sql -> fetch(PDO::FETCH_ASSOC)){
  echo'<option value="'.$row['title'].'">';
}?>
          </datalist>
          <?php if($error['title']!='')echo$error['title'];?>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" class="form-control" id="url" name="url" value="<?php echo$r['url'];?>" placeholder="Enter URL...">
        </div>

        <div class="form-group">
          <label for="image">Image</label>
          <div class="custom-file form-control-sm">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Choose Image</label>
          </div>
        </div>

        <div class="form-group">
          <label for="ti">Published Date</label>
          <input type="date" class="form-control" id="ti" name="ti" value="<?php echo date('Y-m-d',$r['ti']);?>">
        </div>

        <div class="form-group<?php if($error['issue']!='')echo' has-danger';?>">
          <label for="issue" class="<?php if($error['issue']!='')echo' text-danger';?>">Issue</label>
          <input type="text" class="form-control<?php if($error['issue']!='')echo' is-invalid';?>" id="issue" name="issue" value="<?php echo$r['issue'];?>" placeholder="Enter Issue #">
          <?php if($error['issue']!='')echo$error['issue'];?>
        </div>

        <div class="form-group">
          <label for="pub">Publisher</label>
          <input type="text" class="form-control" id="pub" name="pub" list="publist" value="<?php echo$r['publisher'];?>" placeholder="Enter Publisher...">
          <datalist id="publist">
<?php $sql = $db -> prepare("SELECT DISTINCT publisher FROM magazines WHERE publisher!='' ORDER BY publisher ASC");
$sql -> execute();
while($row = $sql -> fetch(PDO::FETCH_ASSOC)){
  echo'<option value="'.$row['publisher'].'">';
}?>
          </datalist>
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" id="category" name="category" list="catlist" value="<?php echo$r['category'];?>" placeholder="Enter Category...">
          <datalist id="catlist">
<?php $sql = $db -> prepare("SELECT DISTINCT category FROM magazines WHERE category!='' ORDER BY category ASC");
$sql -> execute();
while($row = $sql -> fetch(PDO::FETCH_ASSOC)){
  echo'<option value="'.$row['category'].'">';
}?>
          </datalist>
        </div>

        <div class="form-group<?php if($error['tags']!='')echo' has-danger';?>">
          <label for="tags" class="<?php if($error['tags']!='')echo' text-danger';?>">Tags</label>
          <input type="text" class="form-control<?php if($error['tags']!='')echo' is-invalid';?>" id="tags" name="tags" value="<?php echo$r['tags'];?>" placeholder="Enter Tags...">
          <?php if($error['tags']!='')echo$error['tags'];?>
        </div>

        <div class="form-group">
          <label for="title">Comments</label>
          <textarea class="form-control js-lite-editor" id="comments" name="comments"><?php echo$r['comments'];?></textarea>
        </div>

        <div class="form-group text-right">
          <button class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

