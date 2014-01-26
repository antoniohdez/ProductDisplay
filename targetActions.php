<?php
	session_start();

	function moveFile($fileType){
		$output_dir = "uploadedMedia/".$fileType."/";
		$file_name = $_FILES[$fileType]["name"];
		while(file_exists($output_dir.$_SESSION["userInfo"]["id"]."-".$file_name)){
			$file_name = "(1)".$file_name;
		}
		$path = $output_dir.$_SESSION["userInfo"]["id"]."-".$file_name;
		move_uploaded_file($_FILES[$fileType]["tmp_name"], $path);
		return $path;
	}

	//=====//=====//
	//UPLOAD TARGET
	//=====//=====//

	if(isset($_GET["upload"])){
		require("core/handlerDB.php");

		$output_dir = "";
		$db = new handlerDB();
		
		if(isset($_FILES["image"])){
			$path = moveFile("image");
			$id = $_POST["imageId"];

			$statement = "SELECT name FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':id', 	  $id);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);

			$query->execute();
			if($query->rowCount() === 1){
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

				//list($width, $height, $type, $attr) = getimagesize($path);
				//require("vuforia/PostNewTarget.php");
				//$vuforiaRequest = new PostNewTarget($id."-".$result["name"], $path, $width);
				//$vuforiaID = $vuforiaRequest->get_target_id();
				$vuforiaID = "{vuforiaID_goes_here}";
				
				$db = new handlerDB();
				$statement = "UPDATE target SET path_image = :image, vuforiaID = :vuforiaID WHERE id=:id";
				$query = $db->prepare($statement);

				$query->bindParam(':image', 	$path);
				$query->bindParam(':vuforiaID', $vuforiaID);
				$query->bindParam(':id', 		$id);

				$query->execute();
			}
		}

		else if(isset($_FILES["audio"])){
			$path = moveFile("audio");
			$id = $_POST["audioId"];
			$statement = "UPDATE target SET path_audio = :audio WHERE id=:id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':audio',   $path);
			$query->bindParam(':id',	  $id);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);

			$query->execute();
		}

		else if(isset($_FILES["video"])){
			$path = moveFile("video");
			$id = $_POST["videoId"];
			$statement = "UPDATE target SET path_video = :video WHERE id=:id AND user_id = :user_id";
			$query = $db->prepare($statement);
			$query->bindParam(':video',   $path);
			$query->bindParam(':id', 	  $id);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);
			$query->execute();
		}

		else if(isset($_POST["productName"])){
			$productName = $_POST["productName"];
			$url = $_POST["url"];
			$facebook = $_POST["facebook"];
			$twitter = $_POST["twitter"];
			$phoneNum = $_POST["phone"];

			$statement = "INSERT INTO target (user_id, name, url, facebook, twitter, phone) VALUES(:user_id, :name, :url, :facebook, :twitter, :phone)";
			$query = $db->prepare($statement);

			$query->bindParam(':user_id',	$_SESSION["userInfo"]["id"]);
			$query->bindParam(':name',		$productName);
			$query->bindParam(':url', 		$url);
			$query->bindParam(':facebook', 	$facebook);
			$query->bindParam(':twitter', 	$twitter);
			$query->bindParam(':phone', 	$phoneNum);

			$query->execute();
			echo $db->lastInsertId(); //Return the id from the current connection
		}
	}

	//====//====//
	//EDIT TARGET
	//====//====//

	else if(isset($_GET["edit"])){
		require("core/handlerDB.php");

		function replaceFile($fileType, $path){
			if(file_exists($path)){
				unlink($path);
			}
			return moveFile($fileType);
		}

		$output_dir = "";
		$db = new handlerDB();
		
		if(isset($_FILES["image"])){
			$id = $_POST["imageId"];
			//Se selecciona el nombre para nombrarlo de la misma manera en vuforia
			//Se selecciona el id de vuforia para eliminar el anterior cuando se edita la imagen
			//Se selecciona path_image para eliminar la imagen
			$statement = "SELECT name, vuforiaID, path_image FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':id', 	  $id);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);

			$query->execute();
			if($query->rowCount() === 1){
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

				$path = replaceFile("image", $result["path"]);

				//require("vuforia/DeleteTarget.php");
				//$vuforiaRequest = new DeleteTarget($result["vuforiaID"]);
				//$vuforiaRequest->deleted();

				//list($width, $height, $type, $attr) = getimagesize($path);
				//require("vuforia/PostNewTarget.php");
				//$vuforiaRequest = new PostNewTarget($id."-".$result["name"], $path, $width);
				//$vuforiaID = $vuforiaRequest->get_target_id();
				$vuforiaID = "{vuforiaID_goes_here}";
				
				$db = new handlerDB();
				$statement = "UPDATE target SET path_image = :image, vuforiaID = :vuforiaID WHERE id=:id";
				$query = $db->prepare($statement);

				$query->bindParam(':image', 	$path);
				$query->bindParam(':vuforiaID', $vuforiaID);
				$query->bindParam(':id', 		$id);

				$query->execute();
			}
		}

		else if(isset($_FILES["audio"])){
			$id = $_POST["audioId"];
			$statement = "SELECT path_audio FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':id', 		$id);
			$query->bindParam(':user_id', 	$_SESSION["userInfo"]["id"]);

			$query->execute();
			if($query->rowCount() === 1){
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

				$path = replaceFile("audio", $result["path"]);

				$statement = "UPDATE target SET path_audio = :audio WHERE id=:id";
				$query = $db->prepare($statement);
				$query->bindParam(':audio', $path);
				$query->bindParam(':id', 	$id);
				$query->execute();
			}
		}

		else if(isset($_FILES["video"])){
			$id = $_POST["videoId"];
			$statement = "SELECT path_video FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);
			$query->bindParam(':id', 	  $id);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);
			$query->execute();
			if($query->rowCount() === 1){
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

				$path = replaceFile("video", $result["path"]);

				$statement = "UPDATE target SET path_video = :video WHERE id=:id";
				$query = $db->prepare($statement);
				$query->bindParam(':video', $path);
				$query->bindParam(':id', 	$id);
				$query->execute();
			}
		}

		else if(isset($_POST["productName"])){
			$targetID = 	$_POST["targetID"];
			$productName = 	$_POST["productName"];
			$url =			$_POST["url"];
			$facebook = 	$_POST["facebook"];
			$twitter = 		$_POST["twitter"];
			$phoneNum = 	$_POST["phone"];

			$statement = "UPDATE target SET name = :name, url = :url, facebook = :facebook, twitter = :twitter, phone = :phone WHERE id=:id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':id', 	  $targetID);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);

			$query->bindParam(':name', 	  $productName);
			$query->bindParam(':url', 	  $url);
			$query->bindParam(':facebook',$facebook);
			$query->bindParam(':twitter', $twitter);
			$query->bindParam(':phone',   $phoneNum);

			$query->execute();
			echo $targetID; //Return the id from the current connection
		}
	}

	//=====//=====//
	//REMOVE TARGET
	//=====//=====//

	else if(isset($_GET["remove"])){
		require("core/handlerDB.php");

		if(isset($_POST["id"])){
			$db = new handlerDB();

			//Se selecciona las rutas para borrar los archivos
			$statement = "SELECT path_image, path_audio, path_video, vuforiaID FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);

			$query->bindParam(':id', 	  $_POST["id"]);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);

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
				$query->bindParam(':id', 	  $_POST["id"]);
				$query->bindParam(':user_id', $_SESSION["userInfo"]["id"]);
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