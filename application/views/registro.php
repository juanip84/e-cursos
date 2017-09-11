<?php
$this->load->view("header");
?>
	
	<!--<section id="form">-->
		<div class="container">
        <div class="bg">
			<div class="row">
				<div class="col-sm-12" align="center">
					<div class="signup-form"><!--sign up form-->
                    	<h2 class="title text-center">Registrarse</h2>
						<form action="<?php echo site_url('/application/registrar/'); ?>" method="post">
							<input type="text" id="nombre" name="nombre" placeholder="Nombre"/>
                            <input type="text" id="usuario" name="usuario" placeholder="Usuario"/>
							<input type="email" id="email" name="email" placeholder="Email"/>
                            <input type="text" id="empresa" name="empresa" placeholder="Empresa"/>
							<input type="password" id="clave" name="clave" placeholder="Clave"/>
							<button type="submit" class="btn btn-default">Registrar</button>
						</form>
					</div><!--/sign up form-->
                    <br />
                    <a href="<?php echo site_url('/application/login/'); ?>">Si estas registrado logueate aca.</a>
                    <br />
                    <br />
				</div>
			</div>
            </div>
		</div>
	<!--</section>-->
	
<?php
$this->load->view("footer");
?>