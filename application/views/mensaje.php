<!--<php
$this->load->view("header");
?>-->
<section>
    <div class="container">
        <div class="row">
            <?php
            $this->load->view("categorias",$categorias);
            ?>
            <div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->
                    <?php
                    echo '<h2 class="title text-center">'.$subtitle.'</h2>';
                    echo '<h2 class="title text-center">'.$mensaje.'</h2>';
                    ?>
		</div><!--features_items-->
					
            </div>
	</div>
    </div>
</section>
<!--<php
$this->load->view("footer");
?>-->