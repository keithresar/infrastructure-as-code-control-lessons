<script>

$(document).ready(function() {

    $("#btn_go").on("click",function(){

	window.location.href = "http://"+$("#ip_addr").val()+":81/i/editor";
	return(false);
    })


});

</script>

