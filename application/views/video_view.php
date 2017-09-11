<div class="col-sm-12">
    <?php
    if ($link_video!=null && $link_video!='') {
        echo '<h3>Video</h3>';
        if ($youtube==0) {
    ?>
            <video src="<?= base_url();?>archivos/videos/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_video; ?>" width="640" height="360" autoplay controls></video>
    <?php 
        }
        else {
    ?>
            <iframe width="640" height="360" src="<?php echo $link_video; ?>" frameborder="0" allowfullscreen></iframe>
    <?php
        }
    }
    else {
        echo '<h3>No hay video cargado</h3>';
    }
    ?>
    <br />
    <br />
    <br />
    <br />
</div>		