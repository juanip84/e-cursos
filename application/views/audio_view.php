<div class="col-sm-12">
    <?php
    if ($link_audio!=null && $link_audio!='') {
        echo '<h3>Audio</h3>';
    ?>
        <audio controls src="<?= base_url();?>archivos/audios/<?php echo $this->session->userdata("empresa_carpeta").'/'.$link_audio; ?>">Your browser does not support the audio element.</audio>
    <?php
    }
    else {
        echo '<h3>No hay audio cargado</h3>';
    }
    ?>
    <br />
    <br />
    <br />
    <br />
</div>		