<div class="container mt-3">
  <div class="row">
<?php
$q = $db->prepare("SELECT DISTINCT category FROM magazines WHERE category !='' ORDER BY ti DESC");
$q -> execute();
while($r = $q -> fetch(PDO::FETCH_ASSOC)){
  if(file_exists('media/'.strtolower($r['category']).'.jpg'))
    $image='media/'.strtolower($r['category']).'.jpg';
  elseif(file_exists('media/'.strtolower($r['category']).'.png'))
    $image='media/'.strtolower($r['category']).'.png';
  else
    $image='images/category-placeholder.jpg';
  ?>
  <div class="card" style="width: 18rem;">
    <a href="?page=catalog&cat=<?php echo$r['category'];?>"><img class="card-img-top" src="<?php echo$image;?>"></a>
    <div class="card-body">
      <h5 class="card-title"><a href="?page=catalog&cat=<?php echo$r['category'];?>"><?php echo$r['category'];?></a></h5>
    </div>
  </div>
<?php }?>
  </div>
</div>
