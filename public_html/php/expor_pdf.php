<?php 	
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/pdf/mpdf.php');
	if (isset($_SESSION["contenido_impresion"])) {
		$respuesta = array('mensaje' => "imprimiendo", 'status' => '1', 'process' => 'imprimiendo' );
		$html = $_SESSION["contenido_impresion"];
		unset($_SESSION["contenido_impresion"]);
		$pdf = new mPDF('c','A4');
		$pdf->writeHTML($html);
		$pdf->Output('reporte.pdf','I');
		unset($_SESSION["contenido_impresion"]);
	}elseif (isset($_REQUEST['html'])) {
		$_SESSION["contenido_impresion"] = $_REQUEST['html'];
		$respuesta = array('mensaje' => " creada ", 'status' => '1', 'process' => 'imprimir' );
	}else{
		$respuesta = array('mensaje' => " nada ", 'status' => '0','process' => 'imprimir' );
	}
	echo json_encode($respuesta);

?>
