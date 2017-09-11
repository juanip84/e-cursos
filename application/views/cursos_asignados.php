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
                    <h2 class="title text-center">Asignaciones</h2>
                    <?php
                    if ($cursos!=null){
                        foreach ($cursos as $row)
			{?>
                            <div class="single-blog-post">
                                <h3><?php echo $row['titulo'];?></h3>
				<div class="post-meta">
                                    <ul>
					<li><i class="fa fa-user"></i> <?php echo $row['nombre']; ?></li>
					<li><i class="fa fa-clock-o"></i> <?php echo $row['hora']; ?></li>
					<li><i class="fa fa-calendar"></i> <?php echo $row['fecha']; ?></li>
                                    </ul>
                                </div>
							<!--<a href="">-->
                                <div align="center">
                                    <img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$row['link_imagen'];?>" alt="">
                                </div>
                                <p><br></p>
				<div class="pager-area">
                                    <ul class="pager pull-right">
                                        <a href="<?php echo site_url('/application/curso_usuario/'.$row['id']); ?>" class="btn btn-default add-to-cart">Ver</a>
                                        <?php if ($row['calificacion']==null && $row['idexamen']!=null) { ?>
                                            <a href="<?php echo site_url('/application/ver_examen/'.$row['idexamen']); ?>" class="btn btn-default add-to-cart">Examen</a>
                                        <?php } ?>
                                    </ul>
				</div>
                            </div>
                        <?php }
                    }
                    else {
                        echo '<h3>No hay cursos asignados</h3>';
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