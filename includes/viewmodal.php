<?php
require'db.php';
$id=$_GET['id'];
$q=$db->prepare("SELECT * FROM magazines WHERE id=:id");
$q->execute(array(':id'=>$id));
$r=$q->fetch(PDO::FETCH_ASSOC);
?>
<div class="modal-header">
  <h5 class="modal-title"><?php echo$r['title'].' - Issue '.$r['issue'];?></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body>">
  <div id="item_<?php echo$r['id'];?>" class="media m-1">
    <img class="align-self-start mr-2" style="max-width:256px;max-height:256px;" src="<?php echo$r['image'];?>">
    <div class="media-body text-small">
      <small>
        <div>
          Published: <?php echo date("M Y",$r['ti']);?>
        </div>
<?php if($r['publisher']){?>
        <div>
          Publisher: <?php echo$r['publisher'];?>
        </div>
<?php }
if($r['category']){?>
        <div>
          Category: 
          <?php echo'<a href="?page=catalog&cat='.$r['category'].'">'.$r['category'].'</a>';?>
        </div>
<?php }
if($r['tags']!=''){
  $tags=explode(",",$r['tags']);?>
        <div>
          Tags: 
<?php foreach($tags as $tag){
          echo'<a class="badge badge-info" href="?page=catalog&tag='.$tag.'">'.$tag.'</a> ';
}?>
        </div>
<?php }
if($r['comments']!=''){?>
        <div class="mt-2 ml-2">
          <?php echo$r['comments'];?>
        </div>
<?php }?>
      </small>
    </div>
  </div>
</div>
