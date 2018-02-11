<?php
require'includes/db.php';
$page=isset($_GET['page'])?$_GET['page']:'index';
require'includes/head.php';
require'includes/menu.php';
require'includes/'.$page.'.php';
require'includes/footer.php';
