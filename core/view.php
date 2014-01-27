<?php
	function printHeader(){
		//$path = pathinfo($_SERVER['PHP_SELF']);
		//$path['basename'];
		echo '	<header class="navbar navbar-inverse navbar-fixed-top" style="position:relative">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
		                    <a class="navbar-brand" href="index.php">ProDisplay</a>
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

	function printIndexMessages(){
		if(isset($_GET["error"])){
			$error = $_GET["error"];
			if($error === "vuforia"){
				$title = "Target can't be deleted!";
				$message = "if you uploaded some minutes ago, you have to wait until the image can be processed.";
			}
			if($error === "invalidTarget"){
				$title = "Invalid target!";
				$message = "The target you're trying to edit wasn't found.";
			}
			echo '	<div class="alert alert-danger alert-dismissable">
                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            		<strong>'.$title.'</strong> '.$message.'
        			</div>';
		}
		if(isset($_GET["success"])){
			$error = $_GET["success"];
			if($error === "upload"){
				$title = "Target was saved!";
				$message = "It will be available on the mobile app in some minutes.";
			}
			if($error === "edit"){
				$title = "Target was edited!";
				$message = "";
			}
			echo '	<div class="alert alert-success alert-dismissable">
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
	                        <!--<a href="profile.php">
	                            <span id="editProfile" class="glyphicon glyphicon-pencil cursorLink editProfileButton" rel="tooltip" title="Edit" data-placement="right"></span>
	                        </a>-->
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

	function printTargets(){
		require("core/handlerDB.php");
		$db = new handlerDB();
		$statement = "SELECT * FROM target WHERE user_id = :id";
		$query = $db->prepare($statement);
		$query->bindParam(':id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
		$query->execute();
		$targets = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($targets as $target) {
			echo '	<div id='.$target["id"].' class="col-md-4">
	                    <div class="targetContainer shadow">
	                        <div class="targetTitle info">
	                        '.$target["name"].'
	                        </div>
	                        <div class="text-right actionButtons">
	                            <span class="editButton">
	                                <a href="target.php?t='.$target["id"].'" class="glyphicon glyphicon-edit" rel="tooltip" title="Edit"></a>
	                            </span>
	                            <span class="glyphicon glyphicon-remove removeButton cursorLink" rel="tooltip" title="Delete" onClick="deleteTarget('.$target["id"].')"></span>
	                        </div>
	                        <div class="targetImageContainer">
	                            <div class="vertical">
	                                <img src="'.$target["path_image"].'" class="targetImage" alt="Target image">
	                            </div>
	                        </div>
	                        <div class="targetInfo">
	                            <div class="info">
	                                <span><img src="img/web.png" width="14" height="14">&nbsp;</span><a class="CSlink" target="_blank" href="'.$target["url"].'">'.$target["url"].'&nbsp</a>
	                            </div>
	                            <div class="info">
	                                <span><img src="img/facebook.png" width="14" height="14">&nbsp;<a class="CSlink" target="_blank" href="'.$target["facebook"].'">'.$target["facebook"].'&nbsp</a>
	                            </div>
	                            <div class="info">
	                                <span><img src="img/twitter.png" width="14" height="14">&nbsp;<a class="CSlink" target="_blank" href="'.$target["twitter"].'">'.$target["twitter"].'&nbsp</a>
	                            </div>
	                            <div class="info">
	                                <span><img src="img/phone.png" width="14" height="14">&nbsp;'.$target["phone"].'&nbsp
	                            </div>
	                        </div>
	                    </div>
	                </div>';
		}
	}

?>