$(document).ready(function(){
    var video = audio = image = false;
    $("#submit").click(function(){
        $("#submitHidden").trigger("click");
    });

    $("#targetForm").on("submit", function(){
        if($("#image").val() == ""){
            alert("Select an image");
            return false;
        }
        var $form = $(this);
        var $inputs = $form.find("input, select");
        var data = $form.serialize();
        $.ajax({
            data:   data,
            url:    "targetUpload.php",
            type:   "post",
            beforeSend:function(){
                $("#submit").prop("disabled","disabled").html("Saving...");;
                $inputs.prop("disabled", "disabled");
                $("input:file").click(function(e){
                    e.preventDefault();
                });
            },
            success:function(response){
                $("#imageHidden").val(response);
                $("#audioHidden").val(response);
                $("#videoHidden").val(response);
                $("#targetFormImage").submit();
                $("#targetFormAudio").submit();
                $("#targetFormVideo").submit();
                setInterval(function(){
                    if(video && audio && image){
                        window.location.href = "index.php";
                    }
                },1000);
            }
        });
        return false;
    });

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
            //console.log("Audio");
            audio = true;
        },
        error: function()
        {
            alert("Error");   
        }
    };
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
            //console.log("Video");
            video = true;
        },
        error: function()
        {
            alert("Error");
        }
    };
    var optionsImage = { 
        beforeSend: function() 
        {
            
        },
        success: function() 
        {
            
        },
        complete: function(response) 
        {
            //console.log("Image");
            image = true;
            //console.log(response);
        },
        error: function()
        {
            alert("Error");
        }
    };
    $("#targetFormAudio").ajaxForm(optionsAudio);
    $("#targetFormVideo").ajaxForm(optionsVideo);
    $("#targetFormImage").ajaxForm(optionsImage);
});