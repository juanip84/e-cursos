<!--<php
$this->load->view("header");
?>-->
	
	<!--<section id="form">-->
<div class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12" align="center">
		<div class="login-form"><!--login form-->
                    <h2 class="title text-center">Ingresa a tu cuenta</h2>
                    <form action="<?php echo site_url('/application/login_data/'); ?>" method="post">
                        <input type="text" id="usuario" name="usuario" placeholder="Usuario" />
			<input type="password" id="clave" name="clave" placeholder="Clave" />
                        <select name="empresa" id="empresa" required width="200" style="width: 200px">
                            <option value="0">Seleccionar empresa</option>
                            <?php
                            foreach ($empresas as $empresa) {
                                echo '<option value="'.$empresa->id.'">'.$empresa->nombre.'</option>';
                            } ?>
                        </select>

			<button type="submit" class="btn btn-default">Ingresar</button>
                    </form>
		</div><!--/login form-->
                <br />
            </div>
	</div>
    </div>
</div>
<!--</section>-->
	
<!--<php
$this->load->view("footer");
?>-->