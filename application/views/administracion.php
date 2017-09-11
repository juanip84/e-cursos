<!--<php
$this->load->view("header");
?>-->
	 
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
		<h2 class="title text-center">Administracion</h2>
		<ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#usr_tab">Usuarios</a></li>
                    <li><a data-toggle="tab" href="#cat_tab">Categorias</a></li>
                    <li><a data-toggle="tab" href="#cursos_tab">Cursos</a></li>
		</ul>
		<div class="tab-content">
                    <div id="usr_tab" class="tab-pane fade in active">
                        <button id='add_usr_btn' class='btn btn-default'>+ Nuevo usuario</button>
                        <div id="users_table"><?php echo $users_table; ?></div>	
                    </div>
                    <div id="cat_tab" class="tab-pane fade">
                        <div id="cat_container">
                            <?php
                            $this->load->view("categorias_edit",$categorias);
                            ?>
			</div>
                    </div>
                    <div id="cursos_tab" class="tab-pane fade">
                        <div id="cursos_container">
                            <?php
                            $this->load->view("cursos_edit",$cursos);
                            ?>
			</div>
                    </div>
		</div>   			
            </div>			 		
	</div>    	
        <br>

    </div>	
</div><!--/#contact-page-->
	
<!--<php
$this->load->view("footer");
?>-->