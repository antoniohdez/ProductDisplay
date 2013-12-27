<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>
        ReportaTec - Login
    </title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ProductDisplay</a>
            </div>
        </div>
    </header>

	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading CScentrar">
			        	Product Display
			        </div>
					<form class="form-signin" action="" method="post">
						<div id="message" class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <strong>WARNING!</strong> DESIGN TEST.
			        	</div>
			        	
                        <input id="username" type="text" name="username" class="form-control firstInput" placeholder="Username" autofocus required>
			        	
                        <input type="password" name="password" class="form-control lastInput" placeholder="Password" required>
			        	
                        <a class="btn btn-lg btn-primary btn-block signIn" href="index.php">Log In</a>
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
