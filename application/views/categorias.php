<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Categorias</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        	<?php
		$idcategoria_anterior=0;
            	if ($categorias!=null){
                    foreach ($categorias as $row)
                    {
                        if ($row->idcategoria!=$idcategoria_anterior) {
                            if ($idcategoria_anterior!=0){
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }

                        $idcategoria_anterior=$row->idcategoria;
                    ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="<?php echo '#'.$row->idcategoria; ?>">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            <?php echo $row->categoria; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo $row->idcategoria; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="<?php echo site_url('/application/listado/'.$row->idcategoria.'/'.$row->idsubcategoria); ?>"><?php echo $row->subcategoria; ?> </a></li>
                                            <?php 
                        }
                        else { ?>
                            <li><a href="<?php echo site_url('/application/listado/'.$row->idcategoria.'/'.$row->idsubcategoria); ?>"><?php echo $row->subcategoria ?> </a></li>
                        <?php
                        }

                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                    ?>
        </div><!--/category-productsr-->           
    </div>
</div>
				