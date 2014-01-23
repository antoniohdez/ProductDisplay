<?php
	//Script incompleto, es necesario guardar el path de la imagen y validar la sesion
	require("core/handlerDB.php");
	$name = $_POST["name"];
	$email = $_POST["email"];
	$country = $_POST["country"];
	$city = $_POST["city"];
	session_start();
	$db = new handlerDB("productDisplay");
	$statement = "UPDATE user set name = :name, email = :email, country = :country, city = :city WHERE id = :id";
	$query = $db->prepare($statement);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':country', $country, PDO::PARAM_STR);
	$query->bindParam(':city', $city, PDO::PARAM_STR);
	$query->bindParam(':id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
	$query->execute();
	header("Location: index.php?success=updatedProfile");
?>