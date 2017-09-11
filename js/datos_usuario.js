$(document).ready(function(){	
        $('#cambiar_clave').bind('click', function () {
		$("#generic_modal_title").text("Cambiar clave");
		$("#generic_modal_body").html("<div class='user-modal-content'><ul><li><label for='clave'>Clave nueva</label><input type='password' id='clave' name='clave' placeholder='Nueva clave'/></li></ul><div class='generic-modal-footer'><button id='cambiar_clave_ok' class='btn btn-default btn-newedit'>Guardar</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#cambiar_clave_ok', function(event) {
		if($('#clave').val() == ''){
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#cambiar_clave_ok").attr('disabled','disabled');
		$("#cambiar_clave_ok").html('Cargando...');
		var map = {
			'clave' : $('#clave').val()
		};
		$.ajax({
		    url: "http://localhost/empresas-dev/index.php/application/cambiar_clave",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp != 1){
                                    alert('No se pudo cambiar la clave');
				}
				$("#generic_modal").modal('hide');
			}
		});
	});
        
        $('#cambiar_mail').bind('click', function () {
		$("#generic_modal_title").text("Cambiar mail");
		$("#generic_modal_body").html("<div class='user-modal-content'><ul><li><label for='mail'>Mail nuevo</label><input type='text' id='mail' name='mail' placeholder='Nuevo mail'/></li></ul><div class='generic-modal-footer'><button id='cambiar_mail_ok' class='btn btn-default btn-newedit'>Guardar</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#cambiar_mail_ok', function(event) {
		if($('#mail').val() == ''){
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#cambiar_mail_ok").attr('disabled','disabled');
		$("#cambiar_mail_ok").html('Cargando...');
		var map = {
			'mail' : $('#mail').val()
		};
		$.ajax({
		    url: "http://localhost/empresas-dev/index.php/application/cambiar_mail",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp != 1){
                                    alert('No se pudo registrar nuevo cliente');
				}
                                else {
                                    $("#email").val($('#mail').val());
                                }
				$("#generic_modal").modal('hide');
			}
		});
	});
});        
