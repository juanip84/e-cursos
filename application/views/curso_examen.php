<!--<php
$this->load->view("header");
?>-->
<div class="container" align="center">
    <div class="row">
	<div class="col-sm-12">
            <div class="blog-post-area" align="center">
		<h2 class="title text-center"><?php echo 'Examen: '.$curso_titulo; ?></h2>
		<div class="single-blog-post" align="center">
                    <input type='text' id='edit_id' style='display:none' value='<?php echo $idexamen; ?>'>    
                    <?php
                    if ($preguntas!=null){
                        $nro_pregunta=1;

                        $preguntas_izq=ceil($nro_preguntas/2);
                        $preguntas_der=$nro_preguntas-$preguntas_izq;
                                                
                        echo '<div id="edited_questions" class="login-form">';
                        foreach ($preguntas as $row)
			{
                            $respuestas=$row['respuestas'];
                                                    
                            if ($nro_pregunta==1) {
                                echo '<div style="width: 50%; float: left; text-align:center">';
                            }
                            else if ($nro_pregunta>$preguntas_izq){
                                echo '</div>';
                                echo '<div style="width: 50%; float: right;text-align:center">';
                            }
                                                    
                            echo '<div class="question" question_num="'.$nro_pregunta.'">';
                            echo '<h3>'.$nro_pregunta.'. '.$row['pregunta'].'</h3>';
                            echo '<div class="answers" style="list-style-type:none;white-space: nowrap;">';
                            foreach ($respuestas as $rowResp)
                            {
                                echo '<div class="answer" answer_num="1">';
                                echo '<input class="response_check" type="radio" name="'.$row['id'].'" value="'.$rowResp['id'].'">'.$rowResp['respuesta'].'<br>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                            $nro_pregunta++;

                        }
                                                
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
               	</div>
            </div><!--/blog-post-area-->
            <br />
	</div>	
        <?php 
            echo '<div align="center">';
            echo '<input type="submit" id="response_exam_ok" name="submit" class="btn btn-primary" value="Guardar">';
            echo '</div>';
            echo '<br>';
        ?>
    </div>
</div>
	
<!--<php
$this->load->view("footer");
?>-->