<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/roles_controller.php');
	$roles = new Roles();
	(isset($_REQUEST['id_rol']) ? $id_rol = $_REQUEST['id_rol'] : $id_rol = "");
	(isset($_REQUEST['remote']) ? $remote = $_REQUEST['remote'] : "");
	$id_rol || $id_rol = '%%';
	$retorno = $roles->get_roles($id_rol);
	if (isset($remote)) {
	 	$respuesta = array('mensaje' => $retorno , 'status' => 1, 'render' => 'vista_select_roles' );
	 	echo json_encode($respuesta);
	} else{ ?>
		<i class="material-icons prefix">pan_tool</i>
		<select class="icons" name="rol" id="id rol">
			<option value="" disabled selected>Selecciona el rol del usuario</option>
			<?php 
				foreach ($retorno as $rol) { ?>
					<option <?php  echo $rol['id_role'] == $value['id_role'] ? "selected" : '';?> value="<?php echo $rol['id_role']; ?>"><?php echo $rol['name_rol']; ?>  </option>
					<?php 
				}
			?>
		</select>
	<?php
	}
	?>
	
