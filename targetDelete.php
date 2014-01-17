<?php
	require("core/handlerDB.php");
	if(isset($_POST["id"])){
		$db = new handlerDB("productDisplay");
		session_start();
		$statement = "DELETE FROM target WHERE id = :id AND user_id = :user_id";
		$query = $db->prepare($statement);
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
		$query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
		$query->execute();
		echo "Done";
	}
?>