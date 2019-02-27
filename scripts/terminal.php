<script>

$(document).ready(function() {

    $("#btn_go").on("click",function(){

	window.location.href = "http://"+$("#ip_addr").val()+":8080/ssh/host/"+$("#ip_addr").val();
	return(false);
    })


});

</script>

