<!--<php
$this->load->view("header");
?>-->
<section>
    <div class="container">
        <div class="row">
            <?php
            $this->load->view("categorias",$categorias);
            ?>
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Notificaciones</h2>
                    <?php
                    if ($notificaciones!=null){
                        foreach ($notificaciones as $row)
			{?>
                            <div class="single-blog-post">
                                <div align="left">
                                    <?php
                                    if ($row['estado']==0) {
                                    ?>
                                        <h4>
                                            <?php 
                                            if ($row['tipo']==1) { 
                                                echo 'Feedback de curso: '.$row['nombre_curso']; 
                                            }
                                            else {
                                                echo 'Nuevo curso asignado';
                                            }
                                            ?>
                                        </h4>
                                    <?php 
                                    }
                                    else {
                                    ?>
                                        <h3>
                                        <!--<php echo 'Feedback de curso: '.$row['nombre_curso'];?>-->
                                            <?php 
                                            if ($row['tipo']==1) { 
                                                echo 'Feedback de curso: '.$row['nombre_curso']; 
                                            }
                                            else {
                                                echo 'Nuevo curso asignado';
                                            }
                                            ?>
                                        </h3>
                                    <?php } ?>
                                </div>
				<div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> <?php echo $row['nombre_usuario']; ?></li>
                                    </ul>
                                    <?php echo $row['mensaje'];?>
                                </div>
                                <p><br></p>
                            </div>
                        <?php }
			}
			else {
                            echo '<h3>No tiene notificaciones</h3>';
			}?>

		</div><!--/blog-post-area-->
                <?php
                if ($links!=null)
                    echo $links; 
                ?>
            </div>	
	</div>
    </div>
</section>
	
<!--<php
$this->load->view("footer");
?>-->