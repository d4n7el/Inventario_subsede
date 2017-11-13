<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	session_start();
	$maestro 			= new Planta();
	$cant_stock 		= new Planta();
	$id_user 			= $_SESSION["id_user_activo"];
	$id_stocks 			= $_REQUEST['elements'];
	$proceso 			= $_REQUEST['proceso'];
	$cantidad 			= $_REQUEST['cantidad'];
	$nota 				= $_REQUEST['nota'];
	$destino 			= $_REQUEST['destino'];
	$recive 			= $_REQUEST['receive_user'];
	$name_recive 		= $_REQUEST['name_receive_user'];
	$permiso 			= True;
	$valores_insert 	= "";
	$ids_cant_stock 	= "";
	$consulta_cantidades = [];
	if ($destino != "" && $recive != "" && count($cantidad) > 0 && count($id_stocks) > 0) {	
		foreach ($id_stocks as $index => $id_stock) {
			$ids_cant_stock.= "id_proceso = ".$id_stock." AND proceso = '".$proceso[$index]."' OR ";
	 	}
	 	$ids_cant_stock = substr($ids_cant_stock,0,-4);
	 	$retorno_cant = $cant_stock->get_cant_stock_plant($ids_cant_stock);
	 	foreach ($retorno_cant as  $index => $id_stock) {
	 		$consulta_cantidades[$id_stock['id_proceso']] =  $id_stock['quantity'];
	 	}
	 	foreach ($id_stocks as $index => $id_stock) {
	 		if ($consulta_cantidades[$id_stock] >= $cantidad[$index] && $permiso == True && $cantidad[$index] > 0) {
	 			$permiso = True;
	 		}else{
	 			$permiso = False;
	 		}
	 	}
	 	if ($permiso == true) {
	 		$retorno = $maestro->insert_exit_product_planta($destino,$recive,$id_user,$name_recive);
	 		foreach ($id_stocks as $key => $id_stock) {
	 			$valores_insert.= "('".$proceso[$key]."' ,".$id_stock.",".$retorno.",".$cantidad[$key].",'".$nota[$key]."'),";
	 		}
	 		$respuesta = array('mensaje' => $valores_insert, 'status' => 1, 'process' => 'exit_product', 'closeModal' => 1 );
	 		$valores_insert = substr($valores_insert,0,-1);
	 		$detalle = new Planta();
	 		$retorno_detalle = $detalle->insert_exit_product_detalle_plant($valores_insert);
	 		if ($retorno > 0 AND $retorno_detalle > 0) {
	 			$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'exit_product', 'closeModal' => 1 );	
	 		}else{
	 			$respuesta = array('mensaje' => $retorno_detalle, 'status' => 0);
	 		}
	 	}else{
	 		$respuesta = array('mensaje' => "Algunas cantidades superan las disponibles", 'status' => 0 );
	 	}
	 }else{
	 	$respuesta = array('mensaje' => "Todos los campos son requeridos", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>