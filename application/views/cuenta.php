<!--<php
$this->load->view("header");
?>-->
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">  	
            <div class="col-sm-6">
                <div class="login-form">
                    <h2 class="title text-center">Datos usuario</h2>

                    <form action="#">
                        <div align="center"><label align="middle">Nombre</label></div>
                        <div align="center"><input type="text" align="middle" value="<?php echo $this->session->userdata['nombre'] ?>" readonly/></div>
                        <div align="center"><label align="middle">Usuario</label></div>
                        <div align="center"><input type="usuario" align="middle" value="<?php echo $this->session->userdata['usuario'] ?>" readonly/></div>

                        <div align="center"><label align="middle">Email</label></div>
                        <div align="center"><input type="email" align="middle" id="email" name="email" value="<?php echo $this->session->userdata['email'] ?>" readonly/></div>
                        <div align="center"><label align="middle">Empresa</label></div>
                        <div align="center"><input type="text" align="middle" value="<?php echo $this->session->userdata['empresa_nombre'] ?>" readonly/></div>
                    </form>
                    <p><br /></p>
	    	</div>
	    </div>
	    <div class="col-sm-6">
                <div class="contact-info">
                    <h2 class="title text-center">Acciones</h2>
                    <address>
                        <div align="center"><a href="#" id="cambiar_clave" class="btn btn-default add-to-cart">Cambiar clave</a></div>
                        <div align="center"><a href="#" id="cambiar_mail" class="btn btn-default add-to-cart">Cambiar email</a></div>
                    </address>
	    	</div>
            </div>    			
	</div>  
    </div>	
</div><!--/#contact-page-->
<!--<php
$this->load->view("footer");
?>-->