<?php
	require("model/handlerDB.php");

	if(isset($_GET["login"])){
		$db = new handlerDB("productDisplay");
		$email = $_POST["email"];
		print $email;
		$password = $_POST["password"];
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
			$statement = "SELECT * FROM user WHERE email = :email AND password = :password";
			$query = $db->prepare($statement);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() === 1){
				//INICILIZAR VARIABLES DE SESSION
				header("Location: index.php");
			}else{
				header("Location: login.php?error=wrongPassword");
			}
		}
		else{
			header("Location: login.php?error=invalidEmail");
		}
	}

	else if(isset($_GET["logout"])){

	}

	else{//Invalid action

	}

	
	

?>
