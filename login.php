<?php
	require("core/driverUser.php");
	require("core/view.php");
	validateSession("login");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>
	        ProductDisplay - Login
	    </title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap2.css" rel="stylesheet">
	    <link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<!--BETA-->
	    <div class="ribbon">
	        <a href="#" rel="me">BETA</a>
	    </div>
	    <!--/BETA-->
		<header class="navbar navbar-inverse navbar-fixed-top" style="position:relative">
	        <div class="container">
	            <div class="navbar-header">
	                <a class="navbar-brand" href="index.php">ProductDisplay</a>
	            </div>
	        </div>
	    </header>

		<div class="container CScontenedor">
			<div class="row-fluid">
				<div class="col-md-offset-4 col-md-4">
					<div class="panel panel-primary shadow">
						<div class="panel-heading CScentrar">
				        	Product Display
				        </div>
						<form class="form-signin" action="session.php?login" method="post">
							<?php
								printLoginError();
							?>
				        	
	                        <input id="email" type="email" name="email" class="form-control firstInput" placeholder="Email" autofocus required>
				        	
	                        <input type="password" name="password" class="form-control lastInput" placeholder="Password" pattern=".{6,}" title="6 characters minimum" required>
				        	<div class="checkbox">
						    <label>
						      <input type="checkbox" name="sessionTime">Keep me logged in
						    </label>
						  </div>
	                        <button type="submit" class="btn btn-lg btn-primary btn-block signIn">Log In</button>
	                        <!--<button class="btn btn-lg btn-primary btn-block signIn" type="submit">Log In</button>-->
				    	</form>
			    	</div>
	    		</div>
	    	</div>
		</div>
		
	    <!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	    <script src="http://code.jquery.com/jquery-1.11.0-beta1.js"></script>
	    <script src="js/bootstrap.min.js"></script>
		
	</body>
</html>
