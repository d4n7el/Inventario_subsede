<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	session_start();
	$maestro 		= new ExitProduct();
	$cant_stock 	= new ExitProduct();
	$id_user 		= $_SESSION["id_user_activo"];
	$products 		= $_REQUEST['producto_id'];
	$stock 			= $_REQUEST['lote_id'];
	$cantidad 		= $_REQUEST['cantidad'];
	$nota 			= $_REQUEST['nota'];
	$destino 		= $_REQUEST['destino'];
	$recive 		= $_REQUEST['receive_user'];
	$name_recive 	= $_REQUEST['name_receive_user'];
	$permiso 		= True;
	$valores_insert = "";
	$ids_cant_stock = "";
	$consulta_cantidades = [];
	if ($destino == "Int" || $destino == "Ext" && $recive != "" && count($cantidad) > 0 && count($stock) > 0) {	
		foreach ($stock as $index => $id_stock) {
			$ids_cant_stock.= "id_stock = ".$id_stock." OR ";
		}
		$ids_cant_stock = substr($ids_cant_stock,0,-4);
		$retorno_cant = $cant_stock->get_cant_stock($ids_cant_stock);
		foreach ($retorno_cant as  $index => $id_stock) {
			$consulta_cantidades[$id_stock['id_stock']] =  $id_stock['amount'];
		}
		foreach ($stock as $index => $id_stock) {
			if ($consulta_cantidades[$id_stock] >= $cantidad[$index] && $permiso == True && $cantidad[$index] > 0) {
				$permiso = True;
			}else{
				$permiso = False;
			}
		}
		if ($permiso == true) {
			$retorno = $maestro->insert_exit_product($destino,$recive,$id_user,$name_recive);
			foreach ($products as $key => $value) {
				$valores_insert.= "(".$stock[$key].",".$retorno.",".$cantidad[$key].",'".$nota[$key]."'),";
			}
			$valores_insert = substr($valores_insert,0,-1);
			$detalle = new ExitProduct();
			$retorno_detalle = $detalle->insert_exit_product_detalle($valores_insert);
			if ($retorno > 0 AND $retorno_detalle > 0) {
				if ($destino == "Int") {
					$valores_insert_planta = "";
					$planta = new ExitProduct();
					foreach ($products as $key => $value) {
						$valores_insert_planta.= "(".$value.",".$stock[$key].",".$retorno.",".$cantidad[$key]."),";
					}
					$valores_insert_planta = substr($valores_insert_planta,0,-1);
					$retorno_planta = $planta->insert_stock_planta($valores_insert_planta);
				}
				if (isset($retorno_planta) && $retorno_planta > 0) {
					$respuesta = array('mensaje' => "registro correcto, Se añadio a stock planta", 'status' => 1, 'process' => 'exit_product' );
				}else{
					$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'exit_product' );
				}
				
			}else{
				$respuesta = array('mensaje' => "Error", 'status' => 0);
			}
		}else{
			$respuesta = array('mensaje' => "Algunas cantidades superan las disponibles", 'status' => 0 );
		}
	}else{
		$respuesta = array('mensaje' => "Todos los campos son requeridos", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>