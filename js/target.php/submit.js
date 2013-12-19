$(document).ready(function(){
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