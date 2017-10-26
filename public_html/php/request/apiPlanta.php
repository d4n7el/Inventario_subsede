<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	parse_str(file_get_contents('php://input'), $post_vars); 
	if ($post_vars['user'] == "Subsede_santarosa" AND $post_vars['token'] == "2y10MbgK/SGQWmmh1uEpHtC3WeySu5VfCYSbF42hyi/IBaS5TMIgiXFGG" ) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
		$planta = new Planta();
		(isset($post_vars['product'])? $product = $post_vars['product'] : $product = "%%" );
		(isset($post_vars['group'])? $group = $post_vars['group'] : $group = "%%" );
		(isset($post_vars['cellar'])? $cellar = $post_vars['cellar'] : $cellar = "%%" );
		(isset($post_vars['nameReceive'])? $nameReceive = $post_vars['nameReceive'] : $nameReceive = "%%" );
		(isset($post_vars['prefix'])? $prefix = $post_vars['prefix'] : $prefix = "%%" );
		(isset($post_vars['limit'])? $limit = $post_vars['limit'] : $limit = "%%" );
		(isset($post_vars['offset'])? $offset = $post_vars['offset'] : $offset = "%%" );
		$retorno_planta = $planta->index_stock_planta($group,$product,$cellar,$nameReceive,$prefix,$limit,$offset);
        if(count($retorno_planta)){
		   	$datos = [
	              "name" => $retorno_planta,
	              "status" => 200,
                  "mensaje" => "Busqueda exitosa",
	        ];
        }else{
            $datos = [
              "status" => 400,
              "mensaje" => "No se encontraron registros",
            ];
        }
	}else{
		$datos = [
      		"status" => 501,
      		"mensaje" => "Informacion de validación incorrecta",
   		];
	}
}else{
	$datos = [
      "status" => 500,
      "mensaje" => "Metodo no aceptado",
    ];
}
echo json_encode($datos);
?>
<!-- <script type="text/javascript">
var row = <?= ($datos) ?>;
console.log(row);
</script> 
