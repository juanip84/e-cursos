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
                    <h2 class="title text-center"><?php echo $curso; ?></h2>
                    <div class="single-blog-post">
			<h3>Informacion general</h3>
			<div class="post-meta">
                            <ul>
				<li><i class="fa fa-user"></i> <?php echo $autor; ?></li>
                                <li><i class="fa fa-clock-o"></i> <?php echo $hora; ?></li>
				<li><i class="fa fa-calendar"></i> <?php echo $fecha; ?></li>
                            </ul>
                            <span>
                            </span>
			</div>
                        <div align="left">
                            <img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_imagen; ?>" alt="">
                        </div>
                        <p><br></p>

			<?php echo $descripcion; ?></p> <br>                     
                        <?php
                        if ($link_video!=null && $link_video!='') {
                            echo '<h3>Video</h3>';
                            if ($youtube==0) {
                            ?>
                                <video src="<?= base_url();?>archivos/videos/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_video; ?>" width="420" height="315" autoplay controls></video>
                            <?php 
                            }
                            else {
                            ?>
                                <iframe width="420" height="315" src="<?php echo $link_video; ?>" frameborder="0" allowfullscreen></iframe>
                            <?php
                            }
                        }
                        ?>
                        <?php
                        if ($link_audio!=null && $link_audio!='') {
                            echo '<h3>Audio</h3>';
                        ?>
                        <audio controls src="<?= base_url();?>archivos/audios/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_audio; ?>">Your browser does not support the audio element.</audio>
                        <?php
                        }
                        ?>  

                        <?php
                        if ($link_doc!=null && $link_doc!='') {
                        ?>
                            <h3>Material</h3>
                            <iframe src = "<?= base_url();?>js/ViewerJS/#../../archivos/documentos/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_doc; ?>" width='420' height='315' allowfullscreen webkitallowfullscreen></iframe><?php
                        }
                        ?>
                        <br />
                    </div>
		</div><!--/blog-post-area-->

            </div>	
	</div>
    </div>
</section>
	
<!--<php
$this->load->view("footer");
?>-->