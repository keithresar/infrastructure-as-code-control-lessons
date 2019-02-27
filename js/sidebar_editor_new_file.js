
$(document).ready(function() {

    cur_path = false;
    $("a.add_item").on("click",function(){
        cur_path = $(this).data("path");
        $("#filename").val("");
        $("#path").html(cur_path.replace(/\/home\/student\d*\//,"")+"/");
        $("#filename_modal").modal('show');
        return(false);
    });


    $("#create_file_btn").on("click",function(){
        window.location.href = window.location.origin+"/i/editor/?path="+escape(cur_path+"/"+$("#filename").val());
        return(false);
    });

});

