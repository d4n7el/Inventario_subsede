<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="es">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inventario Subsede </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/estilos.css">
</head>
<body>
	<header>
  		<nav>
	    <div class="nav-wrapper fondo_negro">
	    	<a href="../index.php" class="brand-logo" style="margin-left: 3em">
	    		<img src="../image/sena.svg" alt="">
	    	</a>
	    	<?php 
	      	if (isset($_SESSION["name_user_activo"])) { ?>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li>
						<a class=" btn-nav btn view_user" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/users/index.php" id_user="<?php echo $_SESSION["id_user_activo"] ?>">
							<?php echo $_SESSION["name_user_activo"]." - ".$_SESSION["id_user_activo_role"]." - ".$_SESSION["user_zone"] ?>
							<i class="material-icons color_letra_secundario left">account_circle</i>
						</a>
					</li>
					
					<li>
						<a class=" btn-cerrar btn-nav btn" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/sessions/remove_session.php?cerrarSesion=true">
						<i class="material-icons">power_settings_new</i>
						</a>
					</li>	
				</ul>
				<?php 
	      	}
	      	?>
	    </div>
	  </nav>
	</header>
	<div class="principal col s12" >
		<?php 
	    if (isset($_SESSION["name_user_activo"])) { ?>
			<a href="#" data-activates="slide-out" class="button-collapse btn-primary btn-floating fixed"><i class="material-icons slide-outs">menu</i></a>
			<?php  
		}?>
		<div class="row">
			<div class="col m12" >
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
	<div id="modal_right" class="modal bottom-sheet col s12">
	    <div class="modal-content">
	      	
	    </div>
	    <div class="modal-footer">
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat close_modal"><i class="material-icons">clear</i></a>
	    </div>
  	</div>
  	<div id="modal_center" class="modal">
	    <div class="modal-content">
	      	<form action="" class="update_info">
	      		
	      	</form>
	    </div>
	    <div class="modal-footer">
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat close_modal"><i class="material-icons">clear</i></a>
	    </div>
	</div>
	<div id="modal_center_two" class="modal">
	    <div class="modal-content">
	      	
	    </div>
	    <div class="modal-footer">
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat close_modal"><i class="material-icons">clear</i></a>
	    </div>
	</div>
	<div id="modal_left" class="modal">
	    <div class="modal-content">
	      	
	    </div>
	    <div class="modal-footer">
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat close_modal"><i class="material-icons">clear</i></a>
	    </div>
	</div>
	<div id="modal_full" class="modal">
	    <div class="modal-content">
	      	<form action="" class="update_info">
	      		
	      	</form>
	    </div>
	    <div class="modal-footer">
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat close_modal"><i class="material-icons">clear</i></a>
	    </div>
	</div>
	<ul id="slide-out" class="side-nav">
		<?php require_once('nav.php') ?>
	</ul>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jQuery.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/indexx.js"></script>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
</body>
</html>