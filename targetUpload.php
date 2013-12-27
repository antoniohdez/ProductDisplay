<?php
	$output_dir = "";
	if(isset($_FILES["video"])){
		$output_dir = "uploadedMedia/video/";
		move_uploaded_file($_FILES["video"]["tmp_name"],$output_dir.$_FILES["video"]["name"]);
	   	echo "Uploaded File :".$_FILES["video"]["name"];
	}
	if(isset($_FILES["audio"])){
		$output_dir = "uploadedMedia/audio/";
		move_uploaded_file($_FILES["audio"]["tmp_name"],$output_dir.$_FILES["audio"]["name"]);
	   	echo "Uploaded File :".$_FILES["audio"]["name"];
	}

?>