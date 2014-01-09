<?php
	require("core/handlerDB.php");
	$output_dir = "";
	$db = new handlerDB("productDisplay");
	if(isset($_FILES["audio"])){
		$output_dir = "uploadedMedia/audio/";
		session_start();
		move_uploaded_file($_FILES["audio"]["tmp_name"],$output_dir.$_SESSION["userInfo"]["id"]."-".$_FILES["audio"]["name"]);
	   	echo "Uploaded File :".$_FILES["audio"]["name"];
	}
	else if(isset($_FILES["video"])){
		$output_dir = "uploadedMedia/video/";
		session_start();
		move_uploaded_file($_FILES["video"]["tmp_name"],$output_dir.$_SESSION["userInfo"]["id"]."-".$_FILES["video"]["name"]);
	}
	else if(isset($_POST["productName"])){
		$productName = $_POST["productName"];
		$url = $_POST["url"];
		$facebook = $_POST["facebook"];
		$twitter = $_POST["twitter"];
		$phoneNum = $_POST["phone"];
		session_start();
		$statement = "INSERT INTO Target (user_id, name, url, facebook, twitter, phone) VALUES(:user_id, :name, :url, :facebook, :twitter, :phone)";
		$query = $db->prepare($statement);
		$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
		$query->bindParam(':name', $productName, PDO::PARAM_STR);
		$query->bindParam(':url', $url, PDO::PARAM_STR);
		$query->bindParam(':facebook', $facebook, PDO::PARAM_STR);
		$query->bindParam(':twitter', $twitter, PDO::PARAM_STR);
		$query->bindParam(':phone', $phoneNum, PDO::PARAM_STR);
		$query->execute();
	}

?>