<?php

$filepath = "../users/" . $_POST["user"];
if(file_exists($filepath)){
	$old_path = getcwd();
	chdir($filepath);
	if(file_exists($_POST["name"])){
	      $fp = fopen($_POST["name"], "r");
	      $contents = fread($fp, filesize($_POST["name"]));
	      /*$toExec = 'shellcheck ' . $_POST["name"];
	      $res = shell_exec($toExec);
	      if($res == ""){
			$res = shell_exec("sudo -u mrtodd /bin/bash " . $_POST['name'] . " 2>&1");
		}*/
		fclose($fp);
		// $ret = array($contents, $res);
		//echo json_encode($contents);
		echo $contents;    
	}
}

?>
