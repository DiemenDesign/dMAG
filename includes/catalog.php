<div class="container mt-3">
<?php
$q = $db -> prepare("SELECT DISTINCT category FROM magazines WHERE category!='' ORDER BY category ASC");
$q -> execute();
while($r = $q -> fetch(PDO::FETCH_ASSOC)){
  echo'<a class="badge badge-info" href="?page=catalog&cat='.$r['category'].'">'.$r['category'].'</a> ';
}?>
  <div class="row mt-3">
<?php
$imageSize=' s92';
$removeItem=true;
$cat=isset($_GET['cat'])?$_GET['cat']:'';
$tag=isset($_GET['tag'])?$_GET['tag']:'';
$sea=isset($_POST['search'])?$_POST['search']:'';
$qry="SELECT * FROM magazines";
if($cat!=''){
  $qry.=" WHERE LOWER(category) LIKE LOWER(:query)";
  $query=$cat;
}
if($tag!=''){
  $qry.=" WHERE LOWER(tags) LIKE LOWER(:query)";
  $query=$tag;
}
if($sea!=''){
  $qry.=" WHERE LOWER(title) LIKE LOWER(:query) OR LOWER(category) LIKE LOWER(:query) OR LOWER(tags) LIKE LOWER(:query) OR LOWER(commments) LIKE LOWER(:query)";
  $query=$sea;
}
$qry.=" ORDER BY ti DESC";
if($query=='')$qry.=" LIMIT 1,8";
$q=$db->prepare($qry);
$q->execute(array(':query'=>'%'.$query.'%'));
while($r = $q -> fetch(PDO::FETCH_ASSOC)){
  include'includes/listitems.php';
}?>
  </div>
</div>
