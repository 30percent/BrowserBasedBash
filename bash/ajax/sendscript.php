<?php
	$filepath = "../users/" . $_POST["user"];
	$user = $_POST["user"];
	if($user === "m" || $user === "daemon" || $user === "root"){
		echo "You cannot execute as this user";
	} else{
	if(file_exists($filepath)){
		//"sucessfully found dir";
		$old_path = getcwd();
		chdir($filepath);
		$fileName = $_POST["title"];
		$fileName = preg_replace('/[^A-Za-z0-9-. ]/', '', $fileName);
		if(file_exists($fileName)){
			if(!unlink($fileName)){
				echo "Error attempting to overwrite file.";
			}
		}
			$fp = fopen($fileName, "w");
			fwrite($fp, $_POST["script"]);
			fclose($fp);
			chmod($fileName,  0640);
			$toExec = 'shellcheck ' . $fileName;
			$res = shell_exec($toExec);
			if($res == ""){
				$t = "bash " . $fileName;
				$fileWD = getcwd() . "/" . $fileName;
				$script = "/opt/lampp/htdocs/script/exec.sh";
				$toExec = "sudo -u mrtodd /bin/bash " . $script . " '" . $fileWD . "' 2>&1";
				$res = shell_exec($toExec);
				echo $_POST['user'] . ": " . $fileName . "\n\n";
			} else {
				echo $fileName . " failed to pass shellcheck.\nProblems:\n";
			}
		echo $res;
	}
}
?>
