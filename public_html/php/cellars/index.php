<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/cellar_controller.php');
	$cellar 		= new Cellars();
	$bodega = (isset($_REQUEST['bodega'])) && $_REQUEST['bodega'] != "" ? $_REQUEST['bodega'] : "%%";
	$encargado = (isset($_REQUEST['encargado'])) && $_REQUEST['encargado'] != "" ? $_REQUEST['encargado'] : "%%";
	$id_cellar = (isset($_REQUEST['id_cellar'])) && $_REQUEST['id_cellar'] != "" ? $_REQUEST['id_cellar'] : "%%";
	// NECESARIO PARA LA PAGINACION
	$count_cellars = new Cellars();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 50;
	$offset = $limit * $pagina;
	$retorno_cellars = $cellar->index($id_cellar,$bodega,$encargado,$limit,$offset);
	$retorno_count_cellars = $count_cellars->count_cellars($id_cellar,$bodega,$encargado);
	$count_rows = $retorno_count_cellars['count'];
	$href = '/php/cellars/index.php';
	// NECESARIO PARA LA PAGINACION
	if ($id_cellar == "%%") {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_list_cellar.php');
	}else{
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_show_cellar.php');
	}
?>