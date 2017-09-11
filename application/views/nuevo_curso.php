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
                    <h2 class="title text-center">Cargar curso</h2>
                    <div class="single-blog-post">
                        <h3>Informacion cuenta</h3>     
                        <label>Espacio disponible: <?php echo $espacio.' '.$medida_espacio;?></label>
                        <div class="row">                      
                            <div class="col-sm-4">
                                <div class="login-form"><!--login form-->
                                    <h2></h2>
                                    <form id="curso" action="<?php echo site_url('/application/grabar_curso/'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                                        <h3>Informacion general</h3>  
                                        <input type="text" id="titulo" name="titulo" required placeholder="Titulo"/>
                                        <textarea id="descripcion" name="descripcion" rows="3" cols="42" required placeholder="Descripcion"></textarea>
                                        <p><br></p>
                                        <h3>Categoria</h3>
                                        <select name="categoria" id="categoria" required width="200" style="width: 200px">
                                            <option value="0">Categoria</option>
                                            <?php
                                            foreach ($categorias_drop as $row) {
                                                echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
                                            } ?>
                                        </select>
    
                                        <select name="subcategoria" id="subcategoria" required width="200" style="width: 200px">
                                            <option value="0">SubCategoria</option>
                                        </select>
                                        <p><br></p>
                                        <h3>Imagen</h3>
                                        <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png" title="" required size="20" />
                                
                                        <h3>Video</h3>
                                        <label>Origen video: </label>
                                        <select name="filefrom" id="filefrom" width="150" style="width: 150px">
                                            <option value="0">Archivo</option>
                                            <option value="1">Youtube</option>
                                        </select>
                                        <p><br></p>
                                        <input type="text" id="link_video" name="link_video" placeholder="Link video" style="display: none"/>
                                        <input type="file" id="video" name="video" title="" accept="video/mp4,video/webm,video/ogg,video/mov" size="20" />
                                        
                                        <h3>Audio</h3>
                                        <input type="file" id="audio" name="audio" title="" accept="audio/*" />                                        
                                
                                        <h3>Material</h3>
                                        <!--<label>Origen material: </label>
                                        <select name="docfrom" id="docfrom" width="150" style="width: 150px">
                                            <option value="0">Archivo</option>
                                            <option value="1">Generar</option>
                                        </select>
                                        <p><br></p>-->
                                        <input type="file" name="material" id="material" accept="application/pdf"size="20">
                                        <!--<input type="text" id="material_nombre" name="material_nombre" value="" placeholder="Archivo generado" readonly style="display: none"/>
                                        <button id="create_pdf" type="button" class="btn btn-default" style="display: none">Crear doc</button>-->
                                        
                                        <br>
                                        <button type="submit" class="btn btn-default">Guardar</button>
                                        <p><br></p>
                                    </form>

    				</div><!--/login form-->
                            </div>
                   	</div>
                    </div>
		</div><!--/blog-post-area-->

            </div>	
	</div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url();?>js/categorias.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/video.js" ></script>
<!--<php
$this->load->view("footer");
?>-->