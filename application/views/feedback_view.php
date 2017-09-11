<div class="col-sm-12">
    <?php 
    if($mostrar_feedback===1) { ?>
        <h3>Feedback</h3>
        <form action="<?php echo site_url('/application/feedback/'); ?>" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
            <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>
            <div class="form-group col-md-12">
                <textarea name="mensaje" id="mensaje" class="form-area" required rows="5" cols="80" placeholder="Consulta"></textarea>
            </div>                        
            <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
            </div>
        </form>
    <?php 
    }
    else if ($mostrar_feedback===-1){
        echo '<h3>No se puede enviar feedback de un curso del cual es autor</h3>';
    }
    else {
        echo '<h3>Ya envio feedback del curso</h3>';
    }
    ?>
    <br />
    <br />
    <br />
    <br />
</div>		