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
                    <h2 class="title text-center">Nuevo curso</h2>
                    <div class="single-blog-post">
                        <div class="pager-area">
                            <ul class="pager pull-center">
                                <a href="<?php echo site_url('/application/nuevo_curso/'); ?>" class="btn btn-default add-to-cart">Agregar</a>
                            </ul>
                        </div>
                    </div>
		</div><!--/blog-post-area-->

		<div class="blog-post-area">
                    <h2 class="title text-center">Mis cursos</h2>
                    <?php
                    if ($cursos!=null){
                        foreach ($cursos as $row)
			{?>
                            <div class="single-blog-post">
                                <h3>
                                    <?php 
                                    echo $row->titulo; 
                                    if ($row->estado==0) echo ' (Eliminado)'; ?>
                                </h3>
				<div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> <?php echo $row->nombre; ?></li>
					<li><i class="fa fa-clock-o"></i> <?php echo $row->hora; ?></li>
					<li><i class="fa fa-calendar"></i> <?php echo $row->fecha; ?></li>
                                    </ul>
				</div>
							<!--<a href="">-->
                                <div align="center">
                                    <img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$row->link_imagen;?>" alt="">
                                </div>
                                <p><br></p>
				<div class="pager-area">
                                    <ul class="pager pull-right">
                                        <button class="btn btn-default add-to-cart new_asig_btn" idcurso="<?php echo $row->id;?>">Asignar</button> 
                                        <a href="<?php echo site_url('/application/curso_autor/'.$row->id); ?>" class="btn btn-default add-to-cart">Ver</a>
                                        <?php if ($row->idexamen==null) { ?>
                                            <a href="<?php echo site_url('/application/crear_examen/'.$row->id); ?>" class="btn btn-default add-to-cart">Crear examen</a>
                                        <?php } ?>
                                        <a href="<?php echo site_url('/application/eliminar_curso_usuario/'.$row->id); ?>" class="btn btn-default add-to-cart">Eliminar</a>
                                    </ul>
				</div>
                            </div>
                        <?php }
			}
			else {
                            echo '<h3>No tiene cursos subidos</h3>';
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