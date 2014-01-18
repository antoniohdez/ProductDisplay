<?php
	function validateSession($source = "default"){
		session_start();
		if($source === "default"){
			if(!isset($_SESSION["session"]["productDisplay"])){//Si la session no esta iniciada o no es de productDisplay se envia al logout de session.php para ser redireccionado.
				header("Location: session.php?logout");
			}
			else{
				checkTimeSession();//Si la sesión es válida, se revisa que no se haya excedido el tiempo de la session.
			}
		}
		else if($source === "login"){
			if(isset($_SESSION["session"]["productDisplay"])){//Si se llega al login y la sesion está iniciada, se redirecciona al index.
				header("Location: index.php");
			}
		}
		else{
			header("Location: session.php?logout");//Argumento de la función no válido.
		}
	}

	function checkTimeSession(){
		//Revisa la difenrecia entre el tiempo actual, la hora de la última acción en la plataforma y el tiempo permitido (keep me logged in).
		if((time() - $_SESSION["session"]["lastActivity"]) >= $_SESSION["session"]["expirationTime"]){
			header("Location: session.php?logout=expiredSession");
		}
		else{
			$_SESSION["session"]["lastActivity"] = time();//Si la sesión aún es válida, se registra de nueva cuenta la última actividad.
		}
	}
?>