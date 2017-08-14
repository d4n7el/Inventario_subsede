<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inventario Subsede </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/estilos.css">
</head>
<body>
	<header>
  		<nav>
	    <div class="nav-wrapper">
	      <?php 
	      	if (isset($_SESSION["name_user_activo"])) { ?>	
	      		<a href="#" class="brand-logo right"><?php echo $_SESSION["name_user_activo"]; ?></a>
	      		<?php 
	      	}
	      ?>
	      <ul id="nav-mobile" class="left hide-on-med-and-down">
	      		<li>
	      			<a class="btn-floating btn-cerrar btn" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/sessions/remove_session.php?cerrarSesion=true">
						<i class="material-icons">power_settings_new</i>
					</a>
	      		</li>
	      </ul>
	    </div>
	  </nav>
	</header>
	<div class="principal">
		<div class="row">
			<div class="col m12">
				<?php  
					if (isset($_SESSION["id_user_activo"])) {
						require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/_view_index_session.php'); 
					}else{
						require_once($_SERVER['DOCUMENT_ROOT'].'/php/sessions/create_session.php'); 
					}
				?>
			</div>
		</div>
	</div>
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h5 class="titulo col m12 center-align ">Actualizacion</h5 class="titulo center-align ">
			<section>
				
			</section>
		</div>
		<div class="modal-footer">
			<button class="modal-action modal-close waves-effect btn-flat btn-cerrar">
				<i class="material-icons">backspace</i>
			</button>
		</div>
	</div>  
	<div id="modal_mensajes" class="modal">
		
	</div>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jQuery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/indexx.js"</script>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
</body>
</html>