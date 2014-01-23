<?php
    require("core/driverUser.php");
    require("core/view.php");
    validateSession();
    $name = $phone = $path_audio = $path_video = $path_image = "";
    $url = $facebook = $twitter = "http://";
    if(isset($_GET["t"])){
        require("core/handlerDB.php");
        $db = new handlerDB();  
        $statement = "SELECT * FROM target WHERE id = :id AND user_id = :user_id";
        $query = $db->prepare($statement);
        $query->bindParam(':id', $_GET["t"], PDO::PARAM_STR);
        $query->bindParam(':user_id', $_SESSION["userInfo"]["id"], PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount() === 1){
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $name =     $result["name"];
            $url =      $result["url"];
            $facebook = $result["facebook"];
            $twitter =  $result["twitter"];
            $phone =    $result["phone"];
            $path_audio = $result["path_audio"];
            $path_video = $result["path_video"];
            $path_image = $result["path_image"];
            $path = array("uplodedMedia/audio/", "uplodedMedia/video/", "uplodedMedia/image/");
            $path_audio_preview = str_replace($path, "", $result["path_audio"]);
            $path_video_preview = str_replace($path, "", $result["path_video"]);
            $path_image_preview = str_replace($path, "", $result["path_image"]);
        }
        else{
            header("Location: index.php?error=invalidTarget");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
            <?php 
                if(isset($_GET["t"])) echo "Edit ";
                else echo "Add ";
            ?>
            target - ProductDisplay
        </title>
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
        <!--BETA-->
        <div class="ribbon">
            <a href="#" rel="me">BETA</a>
        </div>
        <!--/BETA-->
		<?php
            printHeader();
        ?>
		<div class="container CScontenedor">
            <div class="row-fluid">
            	<!--
                SIDEBAR
                -->
                <div class="col-md-4 col-md-offset-1">
                	<div class="panel panel-primary shadow">
                        <div class="panel-heading">
                            <h3 class="panel-title">New target</h3>
                        </div>
                        <div class="panel-body">
                            <form id="targetForm" role="form" action="targetActions.php?upload" method="post">
                                <div class="form-group">
                                    <label for="productName">Product name*</label>
                                    <input type="text" class="form-control" name="productName" placeholder="My Product" value="<?php echo $name; ?>" maxlength="60" autofocus required>
                            	</div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" class="form-control" name="url" pattern="https?://.+" maxlength="128" placeholder="http://www.example.com" value="<?php echo $url; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" pattern="https?://.+" maxlength="128" placeholder="http://facebook.com/example" value="<?php echo $facebook; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" pattern="https?://.+" maxlength="128" placeholder="http://twitter.com/example" value="<?php echo $twitter; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Phone number</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="(555) 555-5555" maxlength="14" value="<?php echo $phone; ?>">
                                </div>
                                <button id="submitHidden" class="btn btn-primary btn-block" style="display: none;">
                                    Submit
                                </button>
                            </form>
                            <hr style="margin-top: 2em">

                            <form id="targetFormAudio" role="form" action="targetActions.php?upload" method="post" enctype="multipart/form-data"
                            <?php if(isset($_GET["t"])){ ?> style="display:none;"<?php } ?> >
                                <div class="form-group">
                                    <!--
                                    <label for="audio">Audio</label>
                                    <input id="audio" type="file" class="form-control" name="audio">
                                    -->
                                    <label for="audio">Audio</label>
                                        <input id="audioHidden" name="audioId" type="hidden">
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

                            <?php if(isset($_GET["t"])){ ?>
                            <div id="previewAudio">
                                <label for="audio">Audio</label><br>
                                <div class="previewNameForm">
                                    <span onclick="showAudioForm()" class="cursorLink remove"><b class="glyphicon glyphicon-remove"></b>&nbspRemove</span>
                                    <span>
                                        <a href="http://google.com.mx" target="_blank">
                                            audio.mp3
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <?php } ?>

                            <hr style="margin-top: 2em">

                            <form id="targetFormVideo" role="form" action="targetActions.php?upload" method="post" enctype="multipart/form-data"
                            <?php if(isset($_GET["t"])){ ?> style="display:none;"<?php } ?> >
                                <div class="form-group">
                                    <!--
                                    <label for="video">Video</label>
                                    <input id="video" type="file" class="form-control" name="video">
                                    -->
                                    <label for="video">Video</label>
                                    <input id="videoHidden" name="videoId" type="hidden">
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

                            <?php if(isset($_GET["t"])){ ?>
                            <div id="previewVideo">
                                <label for="video">Video</label>
                                <div class="previewNameForm">
                                    <span onclick="showVideoForm()" class="cursorLink remove"><b class="glyphicon glyphicon-remove"></b>&nbspRemove</span>
                                    <span>
                                        <a href="http://google.com.mx" target="_blank">
                                            video.mp4
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <?php } ?>

                            <hr style="margin-top: 2em">
                            <button id="submit" class="btn btn-primary btn-block">
                                Save target
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
                            <h3 class="panel-title">Target</h3>
                        </div>
                        <div class="panel-body">
                            <form id="targetFormImage" role="form" action="targetActions.php?upload" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="image">Image (.jpg and .png only)</label>
                                    <input id="imageHidden" name="imageId" type="hidden">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Browse… <input id="image" name="image" type="file" onchange="return ShowImagePreview(this.files);" required>
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
        <script src="js/jquery.form.js"></script>
        <script src="js/target.php/submit.js"></script>
        <script src="js/target.php/fileSelect.js"></script>
        <script src="js/target.php/imagePreview.js"></script>
        <script>
            $("canvas").click(function(){
                $("#image").trigger("click");
            });

            function showVideoForm(){
                $("#previewVideo").fadeOut("slow", function() {
                    $("#targetFormVideo").fadeIn("slow");
                });
            }

            function showAudioForm(){
                $("#previewAudio").fadeOut("slow", function() {
                    $("#targetFormAudio").fadeIn("slow");    
                });
            }
        </script>
    

        </body>
  	</body>
</html>
