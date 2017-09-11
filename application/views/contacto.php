<!--<php
$this->load->view("header");
?>-->	 
<div id="contact-page" class="container">
    <div class="bg">
	<div class="row">    		
            <div class="col-sm-12">    			   			
		<h2 class="title text-center">Contacto</h2>    			
                <!--<div align="center">			    				
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3284.6458228796055!2d-58.4183651!3d-34.5878273!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb5800934f041%3A0xbd677a802e04c72b!2sAr%C3%A1oz+2241%2C+Buenos+Aires%2C+Ciudad+Aut%C3%B3noma+de+Buenos+Aires!5e0!3m2!1ses!2sar!4v1424037596618" width="400" height="300" frameborder="0" style="border:0"></iframe>
                </div>-->
            </div>			 		
	</div>    	
        <br>
    	<div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Consulta</h2>
                    <div class="status alert alert-success" style="display: none">
                    </div>
                    <form action="<?php echo site_url('/application/envio_mail/'); ?>" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="nombre" class="form-control" required placeholder="Nombre">
			</div>
			<div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required placeholder="Email">
			</div>
			<div class="form-group col-md-12">
                            <input type="text" name="asunto" class="form-control" required placeholder="Asunto">
			</div>
			<div class="form-group col-md-12">
                            <textarea name="mensaje" id="mensaje" class="form-area" required rows="8" placeholder="Consulta"></textarea>
			</div>                        
			<div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-left" value="Enviar">
			</div>
                    </form>
	    	</div>
	    </div>
	    <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Datos de contacto</h2>
                    <address>
                        <p>E-Cursos</p>
                        <p>Email: info@e-cursos.com.ar</p>
                    </address>
	    	</div>
            </div>    			
	</div>  
    </div>	
</div><!--/#contact-page-->
	
<!--<php
$this->load->view("footer");
?>-->