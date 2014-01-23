<?php
	require("core/handlerDB.php");
	if(isset($_GET["login"])){
		$db = new handlerDB();	
		$email = $_POST["email"];
		$password = $_POST["password"];
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){//Valida que el formato de email sea valido
			$statement = "SELECT * FROM user WHERE email = :email";
			$query = $db->prepare($statement);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() === 1){//Debería regresar solamente un usuario
				$result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
				$hashedPassword = $result["password"];
				if(crypt($password, $hashedPassword) == $hashedPassword){//Verifica el password
					session_start();
					//Carga los datos del usuario para no traerlos desde la base de datos cada que se carga el index
					$_SESSION["userInfo"]["id"] 	 = $result["id"];
					$_SESSION["userInfo"]["name"] 	 = $result["name"];
					$_SESSION["userInfo"]["country"] = $result["country"];
					$_SESSION["userInfo"]["city"] 	 = $result["city"];
					$_SESSION["userInfo"]["email"] 	 = $result["email"];
					$_SESSION["userInfo"]["pathLogo"]= $result["path_logo"];
					
					//Valida que la session activa en el servidor sea válida para productDisplay
					$_SESSION["session"]["productDisplay"] = true;
					$_SESSION["session"]["lastActivity"]   = time();
					
					if(isset($_POST["sessionTime"])){
						$_SESSION["session"]["expirationTime"] = 60 * 60 * 24 * 2;//Tiempo de sesion, dos dias sin actividad
					}else{
						$_SESSION["session"]["expirationTime"] = 60 * 30;//Tiempo de sesion, 30 min sin actividad
					}
					header("Location: index.php");//Si se inicio sesion correctamente se envia al usuario al index
				}else{
					header("Location: login.php?error=wrongPassword");
				}
			}else{
				header("Location: login.php?error=wrongUsername");//El usuario no fue encontrado en la base de datos
			}
		}else{
			header("Location: login.php?error=invalidEmail");//El formato de email no es valido
		}
	}
	else if(isset($_GET["logout"])){
		session_start();
		session_destroy();
		if($_GET["logout"] === "expiredSession"){//En la funcion que valida la sesion se envia le argumento logout con el valor expiredSession
			header("Location: login.php?warning=expiredSession");
		}else{
			header("Location: login.php");//Si la sesion la cierra el usuario se dirige al login normalmente
		}
	}
	else{//Invalid action
		header("Location: session.php?logout");//El argumento enviado a session.php no es valido
	}
?>
