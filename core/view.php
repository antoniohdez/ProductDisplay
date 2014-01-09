<?php
	function printHeader(){
		//$path = pathinfo($_SERVER['PHP_SELF']);
		//$path['basename'];
		echo '	<header class="navbar navbar-inverse navbar-fixed-top">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
		                    <a class="navbar-brand" href="index.php">ProductDisplay</a>
						</div>
						<nav class="collapse navbar-collapse">
		                    <ul class="nav navbar-nav">
								<li><a href="index.php">Home</a></li>
		                        <li>
		                            <a href="target.php">Add target</a>
		                        </li>
							</ul>            
		                    <ul class="nav navbar-nav navbar-right">
		      					
		      					<li >
		        					<a href="session.php?logout" id="user" data-container="body">Log Out</a>
		      					</li>
		    				</ul> 
						</nav><!--/.nav-collapse -->
					</div>
				</header>';
	}

	function printLoginError(){
		if(isset($_GET["error"])){
			$error = $_GET["error"];
			if($error === "invalidEmail"){
				$title = "Invalid email!";
				$message = "The email format is incorrect.";
			}
			else if($error === "wrongUsername"){
				$title = "Incorrect email!";
				$message = "The email you entered does not belong to any account.";
			}
			else if($error === "wrongPassword"){
				$title = "Incorrect password!";
				$message = "Please try again.";
			}else{
				$title = "Unknown error!";
				$message = "Please try again.";
			}
			echo '	<div class="alert alert-danger alert-dismissable">
                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            		<strong>'.$title.'</strong> '.$message.'
        			</div>';
		}
		else if(isset($_GET["warning"])){
			$warning = $_GET["warning"];
			if($warning === "expiredSession"){
				$title = "Expired session!";
				$message = "You have to log in again.";
			}else{
				return;
			}
			echo '	<div class="alert alert-warning alert-dismissable">
                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            		<strong>'.$title.'</strong> '.$message.'
        			</div>';
		}
	}

	function printProfileInfo(){
		echo '	<div class="panel panel-primary shadow">
	                <div class="panel-heading">
	                    <h3 class="panel-title">
	                        Profile
	                        <a href="profile.php">
	                            <span id="editProfile" class="glyphicon glyphicon-pencil cursorLink editProfileButton" rel="tooltip" title="Edit" data-placement="right"></span>
	                        </a>
	                    </h3>
	                </div>
	                <div>
	                    <img src="'.$_SESSION["userInfo"]["pathLogo"].'" style="width:100%" alt="Logo image">
	                </div>
	                <div class="panel-body">
	                    <div><div class="infoTitle" contenteditable>'.$_SESSION["userInfo"]["name"].'</div></div>
	                    <div>'.$_SESSION["userInfo"]["country"].'</div>
	                    <div>'.$_SESSION["userInfo"]["city"].'</div>
	                    <div>'.$_SESSION["userInfo"]["email"].'</div>
	                </div>
	            </div>';					
	}

	function printTagets(){

	}
?>