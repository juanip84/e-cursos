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
                    <h2 class="title text-center">Informacion curso</h2>
                    <div class="single-blog-post">
                        <h3><?php echo $curso; ?></h3>
			<div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> <?php echo $autor; ?></li>
				<li><i class="fa fa-clock-o"></i> <?php echo $hora; ?></li>
				<li><i class="fa fa-calendar"></i> <?php echo $fecha; ?></li>
                            </ul>
                            <span>
                            </span>
			</div>
                        <div align="center">
                            <img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_imagen; ?>" alt="">
                        </div>
                        <p><br></p>
			<p>
                            <?php echo $descripcion; ?>
                        </p> 
                        <br>
			<div class="pager-area">
                            <ul class="pager pull-right">
                                <a href="<?php echo site_url('/application/inscribirme/'.$id); ?>" class="btn btn-default add-to-cart">Agregar a favoritos</a>
                                <a href="<?php echo site_url('/application/curso_usuario/'.$id); ?>" class="btn btn-default add-to-cart">Ver curso</a>
                            </ul>
			</div>
                    </div>
                </div><!--/blog-post-area-->

                <div class="socials-share">
                    <a href=""><img src="<?= base_url();?>images/blog/socials.png" alt=""></a>
                </div><!--/socials-share-->
            </div>	
	</div>
    </div>
</section>
	
<!--<php
$this->load->view("footer");
?>-->