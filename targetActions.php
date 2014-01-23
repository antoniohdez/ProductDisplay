<?php
	if(isset($_GET["upload"])){
		//=====//=====//
		//UPLOAD TARGET
		//=====//=====//
		require("core/handlerDB.php");
		function moveFile($fileType){
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
		$db = new handlerDB();
		if(isset($_FILES["image"])){
			$path = moveFile("image");
			$id = $_POST["imageId"];

			$statement = "SELECT name FROM target WHERE id = :id";
			$query = $db->prepare($statement);
			$query->bindParam(':id', $id, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

			//list($width, $height, $type, $attr) = getimagesize($path);
			//require("vuforia/PostNewTarget.php");
			//$vuforiaRequest = new PostNewTarget($id."-".$result["name"], $path, $width);
			//$vuforiaID = $vuforiaRequest->get_target_id();
			$vuforiaID = "{vuforiaID_goes_here}";
			
			$db = new handlerDB();
			$statement = "UPDATE target SET path_image = :image, vuforiaID = :vuforiaID WHERE id=:id";
			$query = $db->prepare($statement);
			$query->bindParam(':image', $path, PDO::PARAM_STR);
			$query->bindParam(':vuforiaID', $vuforiaID, PDO::PARAM_STR);
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
	}else if(isset($_GET["edit"])){
		//====//====//
		//EDIT TARGET
		//====//====//


		
	}else if(isset($_GET["remove"])){
		//=====//=====//
		//REMOVE TARGET
		//=====//=====//
		require("core/handlerDB.php");
		if(isset($_POST["id"])){
			$db = new handlerDB();
			session_start();
			//Se selecciona las rutas para borrar los archivos
			$statement = "SELECT path_image, path_audio, path_video, vuforiaID FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);
			$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
			/*
			require("vuforia/DeleteTarget.php");
			$vuforiaRequest = new DeleteTarget($result["vuforiaID"]);
			if($vuforiaRequest->deleted()){
			*/
				//Elimina los archivos
				if(file_exists($result["path_image"])){
					unlink($result["path_image"]);
				}
				if(file_exists($result["path_audio"])){
					unlink($result["path_audio"]);
				}
				if(file_exists($result["path_video"])){
					unlink($result["path_video"]);
				}

				//Se elimina el registro de la base de datos una vez que los archivos se borraron.
				$db = new handlerDB();
				$statement = "DELETE FROM target WHERE id = :id AND user_id = :user_id";
				$query = $db->prepare($statement);
				$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
				$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
				$query->execute();
				echo "success";
			/*
			}
			else{
				echo "error vofuria";
			}
			*/
			
		}
	}
	header("session.php?logout");
?>