/*price range*/

$('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	

		
/*scroll to top*/

function update_users_table(){
	$("#users_table").html('Cargando...');
	$.ajax({
	    url: "get_users_table",
		dataType:"json",
		success: function(resp){
			$("#users_table").html(resp);
		}
	});
}
function update_cats(){
	$("#cat_container").html('Cargando...');
	$.ajax({
	    url: "get_cat_list",
		dataType:"json",
		success: function(resp){
			$("#cat_container").html(resp);
		}
	});
}

function update_cursos(){
	$("#cursos_container").html('Cargando...');
	$.ajax({
	    url: "listado_total",
		dataType:"json",
		success: function(resp){
			$("#cursos_container").html(resp);
		}
	});
}

function is_email(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
	
	//USERS FUNCTIONS
	
	$('#add_usr_btn').bind('click', function () {
		$("#generic_modal_title").text("Nuevo Usuario");
		$("#generic_modal_body").html("<div class='user-modal-content'><ul><li><label for='new_user_nombre'>Nombre</label><input type='text' id='new_user_nombre' placeholder='Nombre'></li><li><label for='new_user_usuario'>Usuario</label><input type='text' id='new_user_usuario' name='usuario' placeholder='Usuario'></li><li><label for='new_user_email'>Email</label><input type='email' id='new_user_email' name='email' placeholder='Email'></li></ul><div class='generic-modal-footer'><button id='new_user_ok' class='btn btn-default btn-newedit'>Crear Usuario</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#new_user_ok', function(event) {
		if($('#new_user_nombre').val() == '' || $('#new_user_usuario').val() == '' || is_email($('#new_user_email').val()) == false){
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#new_user_ok").attr('disabled','disabled');
		$("#new_user_ok").html('Cargando...');
		var map = {
			'nombre' : $('#new_user_nombre').val(),
			'usuario' : $('#new_user_usuario').val(),
			'email' : $('#new_user_email').val()
		};
		$.ajax({
		    url: "new_user",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_users_table();
				}else{
					alert('No se pudo registrar nuevo usuario');
				}
				$("#generic_modal").modal('hide');
			}
		});
	});
	$('body').on('click', '.edit_tr', function(event) {
		var this_id = $(this).parents('tr').find('.td_id').text();
		var this_name = $(this).parents('tr').find('.td_name').text();
		var this_user = $(this).parents('tr').find('.td_user').text();
		var this_email = $(this).parents('tr').find('.td_email').text();
		$("#generic_modal_title").text("Editar Usuario");
		$("#generic_modal_body").html("<div class='user-modal-content'><input type='text' id='edit_id' style='display:none' value='"+this_id+"'><ul><li><label for='edit_user_nombre'>Nombre</label><input type='text' id='edit_user_nombre' placeholder='Nombre' value='"+this_name+"'></li><li><label for='edit_user_usuario'>Usuario</label><input type='text' id='edit_user_usuario' name='usuario' placeholder='Usuario' value='"+this_user+"'></li><li><label for='edit_user_email'>Email</label><input type='email' id='edit_user_email' name='email' placeholder='Email' value='"+this_email+"'></li></ul><div class='generic-modal-footer'><button id='edit_user_ok' class='btn btn-default btn-newedit'>Modificar Usuario</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#edit_user_ok', function(event) {
		if($('#edit_user_nombre').val() == '' || $('#edit_user_usuario').val() == '' || is_email($('#edit_user_email').val()) == false){
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#edit_user_ok").attr('disabled','disabled');
		$("#edit_user_ok").html('Cargando...');
		var map = {
			'id' : $('#edit_id').val(),
			'nombre' : $('#edit_user_nombre').val(),
			'usuario' : $('#edit_user_usuario').val(),
			'email' : $('#edit_user_email').val()
		};
		$.ajax({
		    url: "edit_user",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_users_table();
				}else{
					alert('No se pudo editar al usuario');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
	$('body').on('click', '.delete_tr', function(event) {
		var this_id = $(this).parents('tr').find('.td_id').text();
		$("#generic_modal_title").text("Eliminar Usuario");
		$("#generic_modal_body").html("<div class='user-modal-content'><input type='text' id='edit_id' style='display:none' value='"+this_id+"'>¿Esta seguro que desea eliminar al usuario? <div class='generic-modal-footer'><button id='delete_user_ok' class='btn btn-default'>Eliminar Usuario</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#delete_user_ok', function(event) {
		$("#delete_user_ok").attr('disabled','disabled');
		$("#delete_user_ok").html('Cargando...');
		var map = {
			'id' : $('#edit_id').val()
		};
		$.ajax({
		    url: "delete_user",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_users_table();
				}else{
					alert('No se pudo eliminar al usuario');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
	
	//CATEGORIES FUNCTIONS
	$('body').on('click', '.edit_cat_btn', function(event) {
		event.stopPropagation();
		$("#generic_modal_title").text("Editando Categoría");
		$("#generic_modal_body").html("<div class='user-modal-content'>Cargando...</div>");
		$("#generic_modal").modal('show');
		var map = {
			'cat_id' : $(this).attr('cat_id')
		};
		$.ajax({
		    url: "get_cat_edit_form",
			type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				$("#generic_modal_body").html(resp);
			}
		});
	});
	$('body').on('click', '.delete_cat_btn', function(event) {
		event.stopPropagation();
		var this_id = $(this).attr('cat_id');
		var this_name = $(this).attr('cat_name');
		$("#generic_modal_title").text("Eliminar Categoría");
		$("#generic_modal_body").html("<div class='user-modal-content'><input type='text' id='edit_id' style='display:none' value='"+this_id+"'>¿Esta seguro que desea eliminar la categoría "+this_name.toUpperCase()+"? <div class='generic-modal-footer'><button id='delete_cat_ok' class='btn btn-default'>Eliminar Categoría</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#new_cat_btn', function(event) {
		event.stopPropagation();
		$("#generic_modal_title").text("Nueva Categoría");
		$("#generic_modal_body").html("<div class='user-modal-content'>Cargando...</div>");
		$("#generic_modal").modal('show');
		$.ajax({
		    url: "get_cat_new_form",
			dataType:"json",
			success: function(resp){
				$("#generic_modal_body").html(resp);
			}
		});
	});
	$('body').on('click', '#new_subcat', function(event) {
		//$('.subcat').first().clone().insertBefore('#new_subcat').find('input').val("");
		var template_html = $('#subcat_template').html();
		$("#edited_subcats").append(template_html);
	});
	$('body').on('click', '.delete_subcat', function(event) {	//TODO se pueden borrar TODAS y no confirma!
		$(this).parents('.subcat').hide();
		$(this).parents('.subcat').attr('deleted',1);
	});
	$('body').on('click', '#edit_cat_ok', function(event) {
		if($('#edit_cat_nombre').val() == '' || $('.edit_subcat_nombre').val() == ''){
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#edit_cat_ok").attr('disabled','disabled');
		$("#edit_cat_ok").html('Cargando...');
		var subcats = [];
		$('#edited_subcats > .subcat').each(function(){
			var id_cat = $(this).attr('id_cat');
			var deleted = $(this).attr('deleted');
			var name_cat = $(this).find('input').val();
			var subcat = {
				id: id_cat,
				name: name_cat,
				deleted : deleted
			};
			subcats.push(subcat);
		});
		var map = {
			'id' : $('#edit_id').val(),
			'nombre' : $('#edit_cat_nombre').val(),
			'subcats' : subcats
		};
		$.ajax({
		    url: "edit_cat",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_cats();
				}else{
					alert('No se pudo editar la categoria');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
	$('body').on('click', '#delete_cat_ok', function(event) {
		$("#delete_cat_ok").attr('disabled','disabled');
		$("#delete_cat_ok").html('Cargando...');
		var map = {
			'id' : $('#edit_id').val()
		};
		$.ajax({
		    url: "delete_cat",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_cats();
				}else{
					alert('No se pudo eliminar la categoría');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
        
        
        // cursos functions
        $('body').on('click', '.delete_curso_btn', function(event) {
		event.stopPropagation();
		var this_id = $(this).attr('curso_id');
		var this_name = $(this).attr('curso_name');
		$("#generic_modal_title").text("Eliminar Curso");
		$("#generic_modal_body").html("<div class='user-modal-content'><input type='text' id='edit_id' style='display:none' value='"+this_id+"'>¿Esta seguro que desea eliminar el curso "+this_name.toUpperCase()+"? <div class='generic-modal-footer'><button id='delete_curso_ok' class='btn btn-default'>Eliminar Curso</button></div></div>");
		$("#generic_modal").modal('show');
	});
        
        $('body').on('click', '#delete_curso_ok', function(event) {
		$("#delete_curso_ok").attr('disabled','disabled');
		$("#delete_curso_ok").html('Cargando...');
		var map = {
			'id' : $('#edit_id').val()
		};
		$.ajax({
		    url: "eliminar_curso_administrador",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					update_cursos();
				}else{
					alert('No se pudo eliminar el curso');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
        
	//examenes
    $('body').on('click', '#add_new_question', function(event) {
    	//$('#question_template').find('.question').attr('question_num',$('.question').length);
		var template_html = $('#question_template').html();
		$("#edited_questions").append(template_html);
	});
	$('body').on('click', '#add_new_answer', function(event) {
		//var answer_length = $(this).siblings('.answers').find('.answer').length+1;
		//$('#answer_template').find('.answer').attr('answer_num',answer_length);
		var template_html = $('#answer_template').html();
		$(this).siblings('.answers').append(template_html);
	});

	$('body').on('click', '.delete_answer', function(event) {	//TODO se pueden borrar TODAS y no confirma!
		$(this).parents('.answer').hide();
		$(this).parents('.answer').attr('deleted',1);
	});
        
    $('body').on('click', '#edit_exam_ok', function(event) {
                var nro_preg=$('#nro_preguntas').val();
                var i=1;
		/*if($('#edit_cat_nombre').val() == '' || $('.edit_subcat_nombre').val() == ''){
			alert('Los datos ingresados no son válidos');
			return;
		}*/
		$("#edit_exam_ok").attr('disabled','disabled');
		$("#edit_exam_ok").html('Cargando...');
		var questions = [];
		$('#edited_questions .question').each(function(){
			var actual_question = $(this).find('.actual_question').val();
			var answers = [];
			$(this).find('.answers .answer').each(function(){
				if($(this).attr('deleted') == '0'){
					answers.push($(this).find('.actual_answer').val());
				}
			});
			var question = {
				actual_question: actual_question,
				answers: answers
			};
			questions.push(question);
		});
		var map = {
			'edit_id' : $('#edit_id').val(),
			'questions' : questions
		};
		$.ajax({
		    url: "http://localhost/e-cursos/index.php/application/grabar_examen",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					window.location.href = "http://localhost/e-cursos/index.php/application/mis_cursos/0";	//TODO arreglar relativo
				}else{
					alert(resp);
				}
			}
		});	
	});
	
		// ASIGNACIONES 
	$('body').on('click', '.new_asig_btn', function(event) {
		$("#generic_modal_title").text("Asignaciones del curso");
		$("#generic_modal_body").html("<div class='user-modal-content'>Cargando...</div>");
		$("#generic_modal").modal('show');
		var map = {
			'id' : $(this).attr('idcurso')
		};
		$.ajax({
		    url: "http://localhost/e-cursos/index.php/application/get_asig_form",		//TODO arreglar relativo
			type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				$("#generic_modal_body").html(resp.html);
				$.each(resp.asig_data, function(index) {
					$(".asig_check[value='"+this.idusuario+"']").attr('checked','checked');
					if(this.visto == '1'){
						$(".visto[user_id='"+this.idusuario+"']").show();
					}
					$(".calificacion[user_id='"+this.idusuario+"']").html(this.calificacion);
					$(".asig_check[value='"+this.idusuario+"']").attr('original','1');
				});
			}
		});
	});
	$('body').on('click', '#edit_asig_ok', function(event) {
		$("#edit_asig_ok").attr('disabled','disabled');
		$("#edit_asig_ok").html('Cargando...');
		var adds = [];
		var removes = [];
		$('.asig_check').each(function(){
			if ($(this).is(':checked') && $(this).attr('original') == '0') {
				adds.push($(this).val());
			}
			if (!$(this).is(':checked') && $(this).attr('original') == '1') {
				removes.push($(this).val());
			}
		});
		var map = {
			'id' : $('#edit_id').val(),
			'adds' : adds,
			'removes' : removes
		};
		$.ajax({
		    url: "http://localhost/e-cursos/index.php/application/edit_asig",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					
				}else{
					alert('No se pudo realizar los cambios');
				}
				$("#generic_modal").modal('hide');
			}
		});	
	});
        
       //hacer examen

        $('body').on('click', '#response_exam_ok', function(event) {
                var i=1;
		$("#response_exam_ok").attr('disabled','disabled');
		$("#response_exam_ok").html('Cargando...');
		var questions = [];
		$('#edited_questions .question').each(function(){
			//var actual_question = $(this).find('.actual_question').val();
                        var nro_question;
                        var answer;
			$(this).find('.answers .answer').each(function(){
                                if ($(this).find('input').is(':checked')) {
                                    //variables=variables+$(this).find('input').attr('name'); 
                                    //variables=variables+$(this).find('input').val(); 
                                    nro_question=$(this).find('input').attr('name'); 
                                    answer=$(this).find('input').val();  
                                }
			});
                        
			var question = {
                                'idquestion': nro_question,
                                'idanswer': answer
			};
                        
			questions.push(question);
		});
		var map = {
			'edit_id' : $('#edit_id').val(),
			'questions' : questions
		};
		$.ajax({
		    url: "http://localhost/e-cursos/index.php/application/grabar_examen_usuario",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp == 1){
					window.location.href = "http://localhost/e-cursos/index.php/application/cursos_asignados/0";	//TODO arreglar relativo
				}else{
					alert(resp);
				}
			}
		});	
	});
        
        
        //Crear pdf
        $('#create_pdf').bind('click', function () {
		$("#generic_modal_title").text("Nuevo documento");
		$("#generic_modal_body").html("<div class='user-modal-content'><ul><li><label for='title'>Titulo</label><input type='text' id='title' placeholder='Titulo'></li><li><label for='pdfcontent'>Contenido</label><textarea id='pdfcontent' name='pdfcontent' rows='10' cols='42' required placeholder='content'></textarea></li></ul><div class='generic-modal-footer'><button id='create_pdf_ok' class='btn btn-default btn-newedit'>Crear pdf</button></div></div>");
		$("#generic_modal").modal('show');
	});
	$('body').on('click', '#create_pdf_ok', function(event) {
		if($('#title').val() == '' || $('#content').val() == '') {
			alert('Los datos ingresados no son válidos');
			return;
		}
		$("#create_pdf_ok").attr('disabled','disabled');
		$("#create_pdf_ok").html('Cargando...');
                
                var timestamp=Math.round(new Date().getTime()/1000);
                var format=".pdf";
                var filename="";
                filename=filename.concat(timestamp,format);
                
		var map = {
			'title' : $('#title').val(),
			'content' : $('#pdfcontent').val(),
                        'filename' : filename
		};
                
                var element = this;
		$.ajax({
		    url: "new_pdf",
		    type: 'post',
			dataType:"json",
			data: map,
			success: function(resp){
				if(resp==1){
                                    //$(element).find('#material_nombre').attr("value",'aaa.pdf');
                                    $('#material_nombre').val(filename);
				}else{
                                    alert('No se pudo crear el pdf');
				}
                                
				$("#generic_modal").modal('hide');
			}
		});
	});
});
