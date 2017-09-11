<div class='user-modal-content'>
    <input type='text' id='edit_id' style='display:none' value='<?php echo $cat_id;?>'>
    <ul>
	<li><label for='edit_cat_nombre'>Categoría</label><input type='text' id='edit_cat_nombre' placeholder='Nombre' value='<?php if($cat_data != null){echo $cat_data[0]->categoria;}?>'></li>
	<li><label>Subcategorías</label</li>
	<ul id='edited_subcats' style="  white-space: nowrap;">
            <?php if($cat_data != null){ foreach ($cat_data as $row){?>
                <li class="subcat" id_cat="<?php echo $row->idsubcategoria;?>" deleted='0'><input type='text' id='edit_subcat_nombre' placeholder='Subcategoría' value='<?php echo $row->subcategoria;?>'><i class="fa fa-trash-o delete_subcat"></i></li>
            <?php }}else{?>
		<li class="subcat" id_cat="0" deleted='0'><input type='text' id='edit_subcat_nombre' placeholder='Subcategoría' value=''><i class="fa fa-trash-o delete_subcat"></i></li>
            <?php }?>
	</ul>
	<button class='btn btn-default' id="new_subcat">Agregar Subcategoría</button>
    </ul>
    <div id="subcat_template" style="display: none">
	<li class="subcat" id_cat="0" deleted='0'><input type='text' id='edit_subcat_nombre' placeholder='Subcategoría' value=''><i class="fa fa-trash-o delete_subcat"></i></li>
    </div>
    <div class='generic-modal-footer'>
	<button id='edit_cat_ok' class='btn btn-default btn-newedit'>OK</button>
    </div>
</div>