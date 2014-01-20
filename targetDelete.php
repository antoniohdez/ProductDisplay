<?php
	require("core/handlerDB.php");
	if(isset($_POST["id"])){
		$db = new handlerDB("productDisplay");
		session_start();
		//Se selecciona las rutas para borrar los archivos
		$statement = "SELECT path_image, path_audio, path_video, vuforiaID FROM target WHERE id = :id AND user_id = :user_id";
		$query = $db->prepare($statement);
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
		$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

		require("vuforia/DeleteTarget.php");
		$vuforiaRequest = new DeleteTarget($result["vuforiaID"]);
		if($vuforiaRequest->deleted()){

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
			$db = new handlerDB("productDisplay");
			$statement = "DELETE FROM target WHERE id = :id AND user_id = :user_id";
			$query = $db->prepare($statement);
			$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
			$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
			$query->execute();
			header("Location: index.php?success=targetDeleted");
		}
		
	}
?>