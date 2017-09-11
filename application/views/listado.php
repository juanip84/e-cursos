<!--<php
$this->load->view("header");
?>-->
<section>
    <div class="container">
        <!-- Buscador -->
        <div class="row">
            <div class="col-sm-12">      
                <div class="busqueda-form">
                    <form action="<?php echo site_url('/application/buscar_cursos/'); ?>" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-12">
                            <input type="text" name="frase" id="frase"/><button type="submit" class="btn btn-default">Buscar</button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin buscador -->
	<div class="row">
            <?php
            $this->load->view("categorias",$categorias);
            ?>
            <div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Listado</h2>
                    <?php
                    if ($cursos!=null){
                        foreach ($cursos as $row)
			{?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
					<div class="productinfo text-center">
                                            <img src="<?= base_url();?>archivos/imagenes/<?php echo $this->session->userdata("empresa_carpeta").'/'.$row->link_imagen;?>" alt="" />
                                            <h2><?php echo $row->titulo;?></h2>
                                            <a href="<?php echo site_url('/application/curso_usuario/'.$row->id); ?>" class="btn btn-default add-to-cart">Ver curso</a>
					</div>
					<div class="product-overlay">
                                            <div class="overlay-content">
                                                <p><?php echo $row->descripcion;?></p>
						<h2><?php echo $row->titulo;?></h2>
						<a href="<?php echo site_url('/application/curso_usuario/'.$row->id); ?>" class="btn btn-default add-to-cart">Ver curso</a>
                                            </div>
					</div>
                                    </div>
				</div>
                            </div>
			<?php }
                    }
                    else {
                        echo '<h2 class="title text-center">No hay cursos disponibles</h2>';
                    }
                    ?>

		</div><!--features_items-->
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