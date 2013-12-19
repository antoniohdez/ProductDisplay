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
					<a class="navbar-brand" href="#">ReportaTec</a>
				</div>
				<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
						<li><a href="#">Home</a></li>
                        <li class="active">
                            <a href="#">Add target</a>
                        </li>
					</ul>            
                    <ul class="nav navbar-nav navbar-right">
      					
      					<li >
        					<a href="#" id="user" data-container="body" >Log Out</a>
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
                                    <input type="text" class="form-control" name="url" placeholder="www.example.com">
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
                            <button id="submit" class="btn btn-primary btn-block" onclick="submit()">
                                Submit
                            </button> 
                        </div>
                    </div><!-- Busqueda -->
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
		
        <script src="http://code.jquery.com/jquery-1.11.0-beta1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>

        <script type="text/javascript">
            document.write(window.innerWidth+'x'+window.innerHeight+'<br>');
            document.write('320x480');
        </script>

        <script>
            $(document).ready(function()
            {
                var optionsVideo = { 
                    beforeSend: function() 
                    {
                        $("#progressVideo").show();
                        $("#barVideo").width('0%');
                        $("#percentVideo").html("0%");
                    },
                    uploadProgress: function(event, position, total, percentComplete) 
                    {
                        if($("#video").val() != ''){
                            $("#barVideo").width(percentComplete+'%');
                            $("#percentVideo").html(percentComplete+'%');
                        }
                    },
                    success: function() 
                    {
                        if($("#video").val() != ''){
                            $("#barVideo").width('100%');
                            $("#percentVideo").html('100%');
                            setTimeout(function(){
                                $("#barVideo").parent().removeClass("active");
                                $("#barVideo").parent().removeClass("progress-striped");
                                $("#barVideo").removeClass("progress-bar-default");
                                $("#barVideo").addClass("progress-bar-success");
                            },1000);
                        }
                    },
                    complete: function(response) 
                    {
                        console.log(response);
                        //$("#message").html("<font color='green'>"+response.responseText+"</font>");
                    },
                    error: function()
                    {
                        alert("Error");
                        //$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
                    }
                };
                var optionsAudio = { 
                    beforeSend: function() 
                    {
                        $("#progressAudio").show();
                        //clear everything
                        $("#barAudio").width('0%');
                        $("#percentAudio").html("0%");
                    },
                    uploadProgress: function(event, position, total, percentComplete) 
                    {
                        if($("#audio").val() != ''){
                            $("#barAudio").width(percentComplete+'%');
                            $("#percentAudio").html(percentComplete+'%');
                        }
                    },
                    success: function() 
                    {
                        if($("#audio").val() != ''){
                            $("#barAudio").width('100%');
                            $("#percentAudio").html('100%');
                            setTimeout(function(){
                                $("#barAudio").parent().removeClass("active");
                                $("#barAudio").parent().removeClass("progress-striped");
                                $("#barAudio").removeClass("progress-bar-default");
                                $("#barAudio").addClass("progress-bar-success");
                            },1000);
                        }
                    },
                    complete: function(response) 
                    {
                        //$("#message").html("<font color='green'>"+response.responseText+"</font>");
                    },
                    error: function()
                    {
                        //$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
                    }
                }; 
                $("#targetFormVideo").ajaxForm(optionsVideo);
                $("#targetFormAudio").ajaxForm(optionsAudio);
            });
            
            function submit(){
                //$("#targetForm").submit();
                $("#targetFormVideo").submit();
                $("#targetFormAudio").submit();
                //$("#targetFormImage").submit();
            }
        </script>

        <script>
            //Script para la selección de archivos
            $(document)
                .on('change', '.btn-file :file', function() {
                    var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [numFiles, label]);
                });
            
            $(document).ready( function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'), label;
                    if(input.length) {
                        if(label != "")
                            input.val(label);
                        else
                            input.val("Select a file...");
                    }
                });
            });     
        </script>
        <script>
            function ShowImagePreview(files)
            {
                if(!(window.File && window.FileReader && window.FileList && window.Blob)){
                  alert('The File APIs are not fully supported in this browser.');
                  return false;
                }

                if(typeof FileReader === "undefined"){
                    alert("Filereader undefined!");
                    return false;
                }

                var file = files[0];
                if(file == undefined){
                    var canvas = document.getElementById('previewcanvas');
                    var context = canvas.getContext( '2d' );
                    context.clearRect(0, 0, canvas.width, canvas.height);
                }else{
                    if(!( /image/i ).test(file.type)){
                        alert( "File is not an image." );
                        return false;
                    }
                }

                reader = new FileReader();
                reader.onload = function(event) 
                        { var img = new Image; 
                          img.onload = UpdatePreviewCanvas; 
                          img.src = event.target.result;  }
                reader.readAsDataURL( file );
            }

            function UpdatePreviewCanvas()
            {
                var img = this;
                var canvas = document.getElementById('previewcanvas');

                if(typeof canvas === "undefined" || typeof canvas.getContext === "undefined")
                    return;

                var context = canvas.getContext( '2d' );
                context.clearRect(0, 0, canvas.width, canvas.height);

                var world = new Object();
                world.width = canvas.offsetWidth;
                world.height = canvas.offsetHeight;

                canvas.width = world.width;
                canvas.height = world.height;

                if(typeof img === "undefined")
                    return;

                var WidthDif = img.width - world.width;
                var HeightDif = img.height - world.height;

                var Scale = 0.0;
                if(WidthDif > HeightDif){
                    Scale = world.width / img.width;
                }
                else{
                    Scale = world.height / img.height;
                }
                if(Scale > 1)
                    Scale = 1;

                var UseWidth = Math.floor( img.width * Scale );
                var UseHeight = Math.floor( img.height * Scale );

                var x = Math.floor( ( world.width - UseWidth ) / 2 );
                var y = Math.floor( ( world.height - UseHeight ) / 2 );

                context.drawImage(img, x, y, UseWidth, UseHeight);  
            }
        </script>

        </body>
  	</body>
</html>
