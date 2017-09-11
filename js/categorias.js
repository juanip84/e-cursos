// JavaScript Document
$(document).ready(function(){
	$("#categoria").change(function(event){
		var id = $("#categoria").find(':selected').val();
		$("#subcategoria").load('subcategorias/'+id);
    });
});
