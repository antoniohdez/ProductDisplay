<?php
	$output_dir = "uploads/";
	if(isset($_FILES["video"])){
		move_uploaded_file($_FILES["video"]["tmp_name"],$output_dir.$_FILES["video"]["name"]);
	   	echo "Uploaded File :".$_FILES["video"]["name"];
	}
	if(isset($_FILES["audio"])){
		move_uploaded_file($_FILES["audio"]["tmp_name"],$output_dir.$_FILES["audio"]["name"]);
	   	echo "Uploaded File :".$_FILES["audio"]["name"];
	}
?>