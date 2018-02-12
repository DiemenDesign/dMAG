<div id="item_<?php echo$r['id'];?>" class="media bg-primary col-xs-12 col-sm-5 m-1">
<?php if($r['url']!=''){
  echo'<a target="_blank" href="'.$r['url'].'"><img class="align-self-start'.$imageSize.' mr-2" src="'.$r['image'].'"></img>';
}else{
  echo'<img class="align-self-start'.$imageSize.' mr-2" src="'.$r['image'].'">';
}?>
  <div class="media-body text-small">
    <h6 class="text-white mt-1 mb-0">
      <a class="d-block d-sm-none" href="?page=view&id=<?php echo$r['id'];?>"><?php echo$r['title'].' - Issue '.$r['issue'];?></a>
      <a class="viewModal d-none d-sm-block" href="#" data-toggle="modal" data-target="#viewModal" data-remote="includes/viewmodal.php?id=<?php echo$r['id'];?>"><?php echo$r['title'].' - Issue '.$r['issue'];?></a>
    </h6>
    <small>
      <div>
        Published: <?php echo date("M Y",$r['ti']);?>
      </div>
<?php if($r['category']){?>
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
        echo'<a class="badge badge-secondary" href="?page=catalog&tag='.$tag.'">'.$tag.'</a> ';
}?>
      </div>
<?php }?>
    </small>
  </div>
<?php if($removeItem == true){?>
  <div class="itemButtons d-none d-sm-block">
    <a class="btn btn-sm btn-info" href="?page=edit&id=<?php echo$r['id'];?>">Edit</a>
    <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo$r['id'];?>">Delete</button>
  </div>
<?php }?>
</div>
