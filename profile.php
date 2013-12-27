<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Profile - ProductDisplay</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap2.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
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
				<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
                        <li>
                            <a href="target.php">Add target</a>
                        </li>
					</ul>            
                    <ul class="nav navbar-nav navbar-right">
      					<li>
        					<a href="logout.php" id="user" data-container="body" >Log Out</a>
      					</li>
    				</ul> 
				</div><!--/.nav-collapse -->
			</div>
		</header>
		
		<div class="container CScontenedor">
            <div class="row">
            	<!--
                SIDEBAR
                -->
                <div class="col-md-4 col-md-offset-1">
                	<div class="panel panel-primary shadow">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit profile</h3>
                        </div>
                        <div class="panel-body">
                            <form id="profileForm" role="form" action="saveProfile.php" method="post">
                                <div class="form-group">
                                    <label for="productName">Name*</label>
                                    <input type="text" class="form-control" name="Name" placeholder="Name" autofocus required>
                            	</div>
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="text" class="form-control" name="email" placeholder="myEmail@example.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country*</label>
                                    <input type="text" class="form-control" name="country" placeholder="My country" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="My city">
                                </div>
                            </form>
                            
                            <hr style="margin-top: 2em">
                            <button id="submit" class="btn btn-primary btn-block" onclick="submit()">
                                Save profile
                            </button>
                        </div>
                    </div>
                </div><!-- /.sidebar -->
                <!--
                CONTENIDO
                -->
                <div class="col-md-6">
                    <div class="panel panel-primary shadow">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Logo</h3>
                        </div>
                        <div class="panel-body">
                            <form id="logoForm" role="form" action="saveProfile.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <!--<label for="image">Image</label>-->
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Browse… <input id="image" name="image" type="file" onchange="return ShowImagePreview(this.files);" >
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly="" value="Select a file...">
                                    </div>
                                    <!--
                                    <div id="progressImage" class="progress progress-striped active">
                                        <div id="barImage" class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span id="percentImage" class="sr-only">0%</span>
                                        </div>
                                    </div>
                                    -->
                                </div> 
                            </form>
                            <div id="preview">
                                <canvas id="previewcanvas" style="cursor:pointer; border: 1px solid #AAA">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>	
		</div><!-- /.container -->
		
        <script src="js/jquery-1.11.0-beta1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/target.php/fileSelect.js"></script>
        <script src="js/target.php/imagePreview.js"></script>
        <script>
            $("canvas").click(function(){
                $("#image").trigger("click");
            });

            function submit(){
                $("#submit").click(function(){
                    $("#profileForm").submit();
                    $("#logoForm").submit();
                });
            }
        </script>
    

        </body>
  	</body>
</html>
