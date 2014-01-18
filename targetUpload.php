<?php
	require("core/handlerDB.php");

	function moveFile($fileType = "image"){
		session_start(); 
		$output_dir = "uploadedMedia/".$fileType."/";
		$file_name = $_FILES[$fileType]["name"];
		while(file_exists($output_dir.$_SESSION["userInfo"]["id"]."-".$file_name)){
			$file_name = "(1)".$file_name;
		}
		$path = $output_dir.$_SESSION["userInfo"]["id"]."-".$file_name;
		move_uploaded_file($_FILES[$fileType]["tmp_name"], $path);
		return $path;
	}

	$output_dir = "";
	$db = new handlerDB("productDisplay");
	if(isset($_FILES["image"])){

		//=====//=====//
		//FALTA AGREGAR LA IMAGEN AL CLOUD DATABASE DE VUFORIA
		//=====//=====//
		require("HTTP/Request2.php");

		//=====//=====//
		//
		//=====//=====//

		$path = moveFile("image");
		$id = $_POST["imageId"];
		$statement = "UPDATE target SET path_image = :image WHERE id=:id";
		$query = $db->prepare($statement);
		$query->bindParam(':image', $path, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
	}
	if(isset($_FILES["audio"])){
		$path = moveFile("audio");
		$id = $_POST["audioId"];
		$statement = "UPDATE target SET path_audio = :audio WHERE id=:id";
		$query = $db->prepare($statement);
		$query->bindParam(':audio', $path, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
	}
	else if(isset($_FILES["video"])){
		$path = moveFile("video");
		$id = $_POST["videoId"];
		$statement = "UPDATE target SET path_video = :video WHERE id=:id";
		$query = $db->prepare($statement);
		$query->bindParam(':video', $path, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
	}
	else if(isset($_POST["productName"])){
		$productName = $_POST["productName"];
		$url = $_POST["url"];
		$facebook = $_POST["facebook"];
		$twitter = $_POST["twitter"];
		$phoneNum = $_POST["phone"];
		session_start();
		$statement = "INSERT INTO target (user_id, name, url, facebook, twitter, phone) VALUES(:user_id, :name, :url, :facebook, :twitter, :phone)";
		$query = $db->prepare($statement);
		$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
		$query->bindParam(':name', $productName, PDO::PARAM_STR);
		$query->bindParam(':url', $url, PDO::PARAM_STR);
		$query->bindParam(':facebook', $facebook, PDO::PARAM_STR);
		$query->bindParam(':twitter', $twitter, PDO::PARAM_STR);
		$query->bindParam(':phone', $phoneNum, PDO::PARAM_STR);
		$query->execute();
		echo $db->lastInsertId(); //Return the id from the current connection
	}
?>