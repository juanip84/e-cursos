<!--<php
$this->load->view("header");
?>-->
<div class="container" align="center">
    <div class="row">
	<div class="col-sm-12">
            <div class="blog-post-area" align="center">
		<h2 class="title text-center"><?php echo $curso; ?></h2>
		<div class="single-blog-post" align="center">
                    <h3>Informacion general</h3>
                    <div class="post-meta">
			<ul>
                            <li><i class="fa fa-user"></i> <?php echo $autor; ?></li>
                            <li><i class="fa fa-clock-o"></i> <?php echo $hora; ?></li>
                            <li><i class="fa fa-calendar"></i> <?php echo $fecha; ?></li>
			</ul>

                        <div style="float: right;">
                            <?php if ($idfavorito==null){ ?>
                                <a href="<?php echo site_url('/application/inscribirme/'.$id); ?>" class="btn btn-default add-to-cart">Agregar a favoritos</a>
                            <?php }?>
                        </div>
                    </div>
							<!--<a href="">-->
                    <div align="center">
			<img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_imagen; ?>" alt="">
                    </div>
                    <p><br></p>
                    <p>
                        <?php echo $descripcion; ?>
                    </p> <br>
                    
                    <!-- 
                    Cambios para tener solapas en curso
                    -->
                    
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#video_tab">Video</a></li>
                        <li><a data-toggle="tab" href="#audio_tab">Audio</a></li>
                        <li><a data-toggle="tab" href="#material_tab">Material</a></li>
                        <li><a data-toggle="tab" href="#feedback_tab">Feedback</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="video_tab" class="tab-pane fade in active">
                            <div id="video_container">
                                <?php
                                $this->load->view("video_view",$link_video);
                                ?>
                            </div>
                        </div>
                        <div id="audio_tab" class="tab-pane fade">
                            <div id="audio_container">
                                <?php
                                $this->load->view("audio_view",$link_audio);
                                ?>
                            </div>
                        </div>
                        <div id="material_tab" class="tab-pane fade">
                            <div id="material_container">
                                <?php
                                $this->load->view("material_view",$link_doc);
                                ?>
                            </div>
                        </div>
                        <div id="feedback_tab" class="tab-pane fade">
                            <div id="feedback_container">
                                <?php
                                $this->load->view("feedback_view",$mostrar_feedback);
                                ?>
                            </div>
                        </div>
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