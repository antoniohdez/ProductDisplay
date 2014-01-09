$(document).ready(function(){
    var optionsForm = { 
        beforeSend: function() 
        {
            //$("input").prop('disabled', true);
        },
        success: function() 
        {
            $("#targetFormVideo").submit();
            $("#targetFormAudio").submit();
        },
        complete: function(response) 
        {
            console.log(response);
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
            //console.log(response);
        },
        error: function()
        {
            alert("Error");
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
            //console.log(response);
        },
        error: function()
        {
            
        }
    };
    $("#targetForm").ajaxForm(optionsForm); 
    $("#targetFormVideo").ajaxForm(optionsVideo);
    $("#targetFormAudio").ajaxForm(optionsAudio);
});

function submit(){
    $("#targetForm").submit();
    //$("#targetFormVideo").submit();
    //$("#targetFormAudio").submit();
    //$("#targetFormImage").submit();
}