<div class="col-sm-12">
    <?php
    if ($link_doc!=null && $link_doc!='') {
    ?>
        <h3>Material</h3>
        <iframe src = "<?= base_url();?>js/ViewerJS/#../../archivos/documentos/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_doc; ?>" width='640' height='500' allowfullscreen webkitallowfullscreen></iframe>
        <br />
        <br />
    <?php
    }
    else {
        echo '<h3>No hay material cargado</h3>';
    }
    ?>
    <br />
    <br />    
    <br />
    <br />
</div>		