<?php
  $dir = "../users/" . $_POST["user"] . "/";
  $files = scandir($dir);
  $newArr = array();
  foreach($files as $file){
    if(is_file($dir.$file)){
      array_push($newArr, $file);
    }
  }
  echo json_encode($newArr);
?>
