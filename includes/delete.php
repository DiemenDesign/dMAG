<?php
$id=$_POST['id'];
include'db.php';
$q=$db->prepare("DELETE FROM magazines WHERE id=:id");
$q->execute(array(':id'=>$id));
