<?php
$settings = [
  'youtubeAPI'  => '' // Your API Key
];
$database = [
  'driver'   => 'mysql',
  'host'     => 'localhost',
//  'port'      = '',
  'schema'   => 'magazines',
  'username' => 'root',
  'password' => 'dev'
];
try{
  $dns=$database['driver'].':host='.$database['host'].';port='.$database['port'].';dbname='.$database['schema'];
  $db=new PDO($dns,$database['username'],$database['password']);
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo'Database Connection Error';
  die();
}
