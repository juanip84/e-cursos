<div class="col-sm-3">
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        	<?php
                if ($cursos!=null) {
            	foreach ($cursos as $row)
		{

		?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="<?php echo '#'.$row->id; ?>">
                     	<span class="badge pull-right" ><i class="fa fa-trash-o delete_curso_btn" curso_id="<?php echo $row->id; ?>" curso_name="<?php echo $row->titulo; ?>"></i></span>
                    <?php echo $row->titulo; ?>
                    </a>
                    </h4>
                </div>
            </div>
                <?php 
				}
                }
                else {
                    echo 'No hay cursos';
                }

			?>

        </div><!--/category-productsr-->

                        
</div>
				