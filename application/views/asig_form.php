<div class='user-modal-content' style='width:100%;text-align:center;'>
	<input type='text' id='edit_id' style='display:none' value='<?php echo $idcurso;?>'>
	<div style="overflow: auto;height: 400px;">
		<table class='table-padding'>
			<tr>
				<th></th>
				<th>Usuario</th>
				<th>Visto</th>
				<th>Calificación</th>
			</tr>
			<?php if($users_data != null){ foreach ($users_data as $row){?>
				<tr> 
					<td><input class="asig_check" original='0' type="checkbox" value="<?php echo $row->id; ?>"></td>
					<td><?php echo $row->usuario; ?></td>
					<td><span class="visto" user_id="<?php echo $row->id; ?>" style='display: none'><i class="fa fa-check"></i></span></td>
					<td><span class="calificacion" user_id="<?php echo $row->id; ?>"></span></td>
				</tr>
			<?php }?>
			<?php }?>
		</table>
	</div>
	<div class='generic-modal-footer'>
		<button id='edit_asig_ok' class='btn btn-default btn-newedit'>OK</button>
	</div>
</div>