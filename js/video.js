jQuery(document).ready(function($){
	$("#filefrom").change(function(event){
                var id = $("#filefrom").find(':selected').val();
                if (id==="0") {
                    $("#video").css("display","block");
                    $("#link_video").css("display","none");
                    //video.style.display='block';
                }
                else {
                    $("#video").css("display","none");
                    $("#link_video").css("display","block");
                    //video.style.display='none';
                }
	});
        
        $("#docfrom").change(function(event){
                var id = $("#docfrom").find(':selected').val();
                if (id==="0") {
                    $("#material").css("display","block");
                    $("#material_nombre").css("display","none");
                    $("#create_pdf").css("display","none");
                    //video.style.display='block';
                }
                else {
                    $("#material").css("display","none");
                    $("#material_nombre").css("display","block");
                    $("#create_pdf").css("display","block");
                    //video.style.display='none';
                }
	});
});
	