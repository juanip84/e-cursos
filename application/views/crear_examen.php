<!--<php
$this->load->view("header");
?>-->
<div class="container" align="center">
    <div class="row">
	<div class="col-sm-12">
            <div class="blog-post-area" align="center">
                <h2 class="title text-center">Crear examen</h2>
		<div class="single-blog-post" align="center">
                    <h3 class="title text-center"><?php echo 'Curso: '.$curso_titulo; ?></h3>    
                    <input type='text' id='edit_id' style='display:none' value='<?php echo $curso_id; ?>'>
                    <div id='edited_questions' class="login-form">
                        <div class="question" question_num='1'>
                            <label>Pregunta: </label>
                            <input type='text' placeholder='Pregunta' value='' class="actual_question">
                            <div><label>Respuestas</label></div>
                            <div class='answers' style="list-style-type:none;white-space: nowrap;">
                                <div><label class="label_normal">Correcta</label></div>
                                <div class="answer" answer_num="1" deleted='0'>
                                    <input type='text' class='actual_answer' placeholder='Respuesta' value=''>
                                </div>
                                <div><label class="label_normal">Incorrectas</label></div>
                            </div>
                            <br>
                            <button class='btn btn-default' id="add_new_answer">Agregar Respuesta Incorrecta</button>
                        <br>
                        </div>
                    </div>
                </div>
                <br>
                <button class='btn btn-default' id="add_new_question">+ Pregunta</button>
                            
                <div id="answer_template" style="display: none">
                    <div class="answer" answer_num="" deleted='0'>
                        <input type='text' class='actual_answer' placeholder='Respuesta' value=''><i class="fa fa-trash-o delete_answer"></i>
                    </div>
                </div>

                <div id="question_template" style="display: none">
                    <div class="question" question_num=''>
                        <br>
                        <div>
                            <label>Pregunta</label>
                        </div>
		        <div><input type='text' placeholder='Pregunta' value='' class="actual_question"></div>
		        <div><label>Respuestas</label></div>
		        <div class='answers' style="list-style-type:none;white-space: nowrap;">
                            <div>
                                <label class="label_normal">Correcta</label>
                            </div>
		            <div class="answer" answer_num="1" deleted='0'>
                                <input type='text' class='actual_answer' placeholder='Respuesta' value=''></i>
		            </div>
                            <div>
                                <label class="label_normal">Incorrectas</label>
                            </div>
		        </div>
		        <br>
		        <button class='btn btn-default' id="add_new_answer">Agregar Respuesta Incorrecta</button>
		        <br>
                    </div>
                </div>
                <div>
                    <br>
                    <input type="submit" id='edit_exam_ok' name="submit" class="btn btn-primary" value="Guardar examen">
                </div>
            </div>
	</div><!--/blog-post-area-->
	<br />
    </div>	
</div>
</div>
	
<!--<php
$this->load->view("footer");
?>-->