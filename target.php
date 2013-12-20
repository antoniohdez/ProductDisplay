<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home - ProductDisplay</title>
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
					<a class="navbar-brand" href="index.php">ReportaTec</a>
				</div>
				<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
                        <li class="active">
                            <a href="target.php">Add target</a>
                        </li>
					</ul>            
                    <ul class="nav navbar-nav navbar-right">
      					
      					<li >
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
                	<div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">New target</h3>
                        </div>
                        <div class="panel-body">
                            <form id="targetForm" role="form" action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="productName">Product name*</label>
                                    <input type="text" class="form-control" name="productName" placeholder="Product" required>
                            	</div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" class="form-control" name="url" placeholder="www.myCompany.com">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" placeholder="facebook.com/MyAccount">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" placeholder="twitter.com/MyAccount">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" class="form-control" name="telephone" placeholder="(555) 555-5555">
                                </div>
                            </form>

                            <hr style="margin-top: 2em">
                            <form id="targetFormVideo" role="form" action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <!--
                                    <label for="video">Video</label>
                                    <input id="video" type="file" class="form-control" name="video">
                                    -->
                                    <label for="video">Video</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Browse… <input id="video" name="video" type="file">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly="" value="Select a file...">
                                    </div>

                                    <div id="progressVideo" class="progress progress-striped active">
                                        <div id="barVideo" class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span id="percentVideo" class="sr-only">0%</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr style="margin-top: 3em">
                            <form id="targetFormAudio" role="form" action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <!--
                                    <label for="audio">Audio</label>
                                    <input id="audio" type="file" class="form-control" name="audio">
                                    -->
                                    <label for="audio">Audio</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Browse… <input id="audio" name="audio" type="file">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly="" value="Select a file...">
                                    </div>

                                    <div id="progressAudio" class="progress progress-striped active">
                                        <div id="barAudio" class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span id="percentAudio" class="sr-only">0%</span>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            <hr style="margin-top: 3em">
                            <button id="submit" class="btn btn-primary btn-block" onclick="submit()">
                                Submit
                            </button>
                        </div>
                    </div>
                </div><!-- /.sidebar -->
                <!--
                CONTENIDO
                -->
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Image</h3>
                        </div>
                        <div class="panel-body">
                            <form id="targetFormImage" role="form" action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <!--<label for="image">Image</label>-->
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Browse… <input id="audio" name="image" type="file" onchange="return ShowImagePreview(this.files);" >
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
                                <canvas id="previewcanvas">

                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>	
		</div><!-- /.container -->
		
        <script src="js/jquery-1.11.0-beta1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/target.php/submit.js"></script>
        <script src="js/target.php/fileSelect.js"></script>
        <script src="js/target.php/imagePreview.js"></script>
    

        </body>
  	</body>
</html>
