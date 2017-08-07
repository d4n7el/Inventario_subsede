<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/roles_controller.php');
	$roles = new Roles();
	$id_rol = $_REQUEST['id_rol'];
	$id_rol || $id_rol = '%%';
	$retorno = $roles->get_roles($id_rol); 
	?>
	
<i class="material-icons prefix">pan_tool</i>
<select class="icons" name="rol" id="id rol">
	<option value="" disabled selected>Selecciona el rol del usuario</option>
	<?php 
		foreach ($retorno as $rol) { ?>
			<option value="<?php echo $rol['id_role']; ?>"><?php echo $rol['name_rol']; ?></option>
			<?php 
		}
	?>
</select>