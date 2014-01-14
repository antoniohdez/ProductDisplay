<?php
	require("core/handlerDB.php");
	if(isset($_GET["login"])){
		$db = new handlerDB("productDisplay");
		$email = $_POST["email"];
		$password = $_POST["password"];
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
			$statement = "SELECT * FROM user WHERE email = :email";
			$query = $db->prepare($statement);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() === 1){
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
				$hashedPassword = $result["password"];
				if(crypt($password, $hashedPassword) == $hashedPassword){
					session_start();
					$_SESSION["userInfo"]["id"] 	 = $result["id"];
					$_SESSION["userInfo"]["name"] 	 = $result["name"];
					$_SESSION["userInfo"]["country"] = $result["country"];
					$_SESSION["userInfo"]["city"] 	 = $result["city"];
					$_SESSION["userInfo"]["email"] 	 = $result["email"];
					$_SESSION["userInfo"]["pathLogo"]= $result["path_logo"];

					$_SESSION["session"]["productDisplay"] = true;
					$_SESSION["session"]["lastActivity"]   = time();
					
					if(isset($_POST["sessionTime"])){
						$_SESSION["session"]["expirationTime"] = 60 * 60 * 24;//Session time, 1 day without activity.
					}else{
						$_SESSION["session"]["expirationTime"] = 60 * 30;//Session time, 30 min without activity.
					}
					header("Location: index.php");
				}else{
					header("Location: login.php?error=wrongPassword");
				}
			}else{
				header("Location: login.php?error=wrongUsername");
			}
		}else{
			header("Location: login.php?error=invalidEmail");
		}
	}
	else if(isset($_GET["logout"])){
		session_start();
		session_destroy();
		if($_GET["logout"] === "expiredSession"){
			header("Location: login.php?warning=expiredSession");
		}else{
			header("Location: login.php");
		}
	}
	else{//Invalid action
		header("Location: session.php?logout");
	}
?>
