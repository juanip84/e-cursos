<table class="users_table" id="users" align="center">
        <?php if ($users_data!=null) { ?>
	<tr>
		<th>id</th>
		<th>nombre</th>
		<th>usuario</th>
		<th>email</th>
		<th>perfil</th>
		<th>opciones</th>
	</tr>
	<?php 
            foreach ($users_data as $user) {
                    echo "<tr><td class='td_id'>".$user->id."</td><td class='td_name'>".$user->nombre."</td><td class='td_user'>".$user->usuario."</td><td class='td_email'>".$user->email."</td><td>".$user->perfil."</td><td><span class='edit_tr' style='margin-right:10px'><i class='fa fa-pencil' title='Editar'></i></span><span class='delete_tr'><i class='fa fa-trash-o' title='Eliminar'></i></span></td></tr>";
            }
        } 
        else {
            echo 'No hay usuarios para modificar';
            //echo '<h2 class="title text-center">No hay usuarios para modificar</h2>';
        }
        ?>
</table>