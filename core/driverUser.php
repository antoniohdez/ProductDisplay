<?php
	function validateSession($source = "default"){
		session_start();
		if($source === "default"){
			if(!isset($_SESSION["session"]["productDisplay"])){
				header("Location: session.php?logout");
			}
			else{
				checkTimeSession();
			}
		}
		else if($source === "login"){
			if(isset($_SESSION["session"]["productDisplay"])){
				header("Location: index.php");
			}
			else{
				checkTimeSession();
			}
		}
		else{
			header("Location: session.php?logout");
		}
	}

	function checkTimeSession(){
		if((time() - $_SESSION["session"]["lastActivity"]) => $_SESSION["session"]["expirationTime"]){//If 
			header("Location: session.php?logout=sessionExpired");
		}
		else{
			$_SESSION["session"]["lastActivity"] = time();
		}
	}
?>