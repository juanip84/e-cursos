<div class="col-sm-3">
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
                                    <span class="badge pull-right" ><i class="fa fa-pencil edit_cat_btn" cat_id="<?php echo $row->idcategoria; ?>"></i></span>
                                    <span class="badge pull-right" ><i class="fa fa-trash-o delete_cat_btn" cat_id="<?php echo $row->idcategoria; ?>" cat_name="<?php echo $row->categoria; ?>"></i></span>
                                    <?php echo $row->categoria; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="<?php echo $row->idcategoria; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo site_url('/application/listado/'.$row->idcategoria.'/'.$row->idsubcategoria); ?>"><?php echo $row->subcategoria; ?> </a>
                                    </li>
                <?php 
                }
                else { ?>
                    <li>
                        <a href="<?php echo site_url('/application/listado/'.$row->idcategoria.'/'.$row->idsubcategoria); ?>"><?php echo $row->subcategoria ?> </a>
                    </li>
                <?php	
                }

            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        else {
            echo 'No hay categorias para modificar';
        }
            ?>
	<div class="panel panel-default" id='new_cat_btn'>
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" >
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        NUEVA CATEGORÍA
                    </a>
                </h4>
            </div>
        </div>
    </div><!--/category-productsr-->             
</div>
				