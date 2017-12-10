<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/export_controller.php');
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; file_name=data.csv'); 
	$output = fopen('php://output', 'w');
	fputcsv($output,$_SESSION["exporExcel"]['datos']);
	$export = new Export();
	$retono_sql = $export->get_sql();
	foreach ($retono_sql as $value) {
		$datos = array();
		foreach ($value as $index => $data) {
			$data = ($index == 'state' && $data == 1) ? 'Activo' : $data;
			$data = ($index == 'state' && $data == 0 && $data != 'Activo') ? 'Inactivo' : $data;
			$data = ($index == 'returned' && $data == 1) ? 'Retornado' : $data;
			$data = ($index == 'returned' && $data == 0 && $data != 'Retornado') ? 'Sin regresar' : $data;
			array_push($datos, $data);
		}
		fputcsv($output,$datos);
	}
	fclose($output);
?>
