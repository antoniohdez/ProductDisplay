$(document).ready(function(){
    $("#submit").click(function(){
        $("#submitHidden").trigger("click");
    });

    $("#targetForm").on("submit", function(){
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
                $("#targetFormImage").submit();
                $("#targetFormAudio").submit();
                $("#targetFormVideo").submit();
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
            //console.log(response);
        },
        error: function()
        {
            
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
    var optionsImage = { 
        beforeSend: function() 
        {
            
        },
        uploadProgress: function(event, position, total, percentComplete) 
        {
            
        },
        success: function() 
        {
            
        },
        complete: function(response) 
        {

        },
        error: function()
        {
            
        }
    };
    $("#targetFormAudio").ajaxForm(optionsAudio);
    $("#targetFormVideo").ajaxForm(optionsVideo);
    $("#targetFormImage").ajaxForm(optionsAudio);
});

function submit(){
    //$("#targetForm").submit();
    //$("#targetFormVideo").submit();
    //$("#targetFormAudio").submit();
    //$("#targetFormImage").submit();
}