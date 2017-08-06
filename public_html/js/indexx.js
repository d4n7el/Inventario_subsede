$(document).on('ready',function(){
	recargar_eventos();
	$('a#create_user').on('click', function(event) {
		event.preventDefault();
		$("div#vista_ventana").load("../php/users/create_user.php",function() {
			recargar_eventos();
		});
	});
	$('a#index_user').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		get_users(ruta);
	});
});
function get_users(ruta){
	formData = {
		'id_user': '%%', 
	}
	ajax_get_data(ruta,formData);
}
function eliminar_eventos(){
	$('form#submit_user').off('submit');
	$('form#submit_session').off('submit');
	$('input.editar_info').off('click');
	$('form#editar_info').off('submit');
}
var recargar_eventos = function(){
	eliminar_eventos();
	$('form#submit_user').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(document.getElementById("submit_user"));
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	})
	$('form#submit_session').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);	
	})
	$('form#editar_info').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		var ruta =  $(this).attr('action');
		var id = $(this).attr('id_upate');
		ajax_set_form_data(ruta,formData);
		var action_next = $(this).attr('action_next');
		$('#modal1').modal('close');
		setTimeout($('a#'+action_next).click());
	})
	$('input.editar_info').on('click', function(event) {
		event.preventDefault();
		var html = '<h5 class="titulo col m12 right-align " >Actualizacion</h5>\
					<section></section>\
					<div class="action col m12">\
			        	<button class="waves-effect waves-light btn btn-primary right">\
			        		<i class="material-icons left">near_me</i>Seguir\
			        	</button>\
		        	</div>'
		$('div#modal1 div.modal-content form').html(html);
		$('#modal1').modal('open');
		var ruta = $(this).attr('ruta');
		var id_form = $(this).attr('id_form');
		var id = $(this).attr('id_update');
		var action_next = $(this).attr('action_next');
		var html = $(this).closest('section').html();
		$('div#modal1 div.modal-content section').html(html);
		$('div#modal1 div.modal-content div input').removeAttr('readonly');
		$('div#modal1 div.modal-content form').attr({
			action: ruta,
			id: id_form,
			id_upate: id,
			action_next: action_next,
		});
		$('div#modal1 div.modal-content input').removeClass(id_form);
		recargar_eventos();
	});
}
function ajax_set_form_data(ruta,formData){
	$.ajax({
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    //es necesario por que estamos utlizando var formData = new FormData(document.getElementById("submit_user"));
	    contentType: false,
	    processData: false, 
	    success: function(response){
	    	if (response['status'] > 0) {
	    		mensaje_alert("success",response['mensaje']);
	    		if (response['render'] != undefined ) {
		    		setTimeout(function(){
						var url = window.location.href;
						url = url.replace(location.pathname, response['render']);
						location.href = url;
					}, 1500);
				}
	    	}else{
	    		mensaje_alert("error",response['mensaje']);
	    	}
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(estado);
	    }
	})
}
function ajax_set_form_json(ruta,formData){
	$.ajax({
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    success: function(response){
	    	if (response['status'] > 0) {
	    		mensaje_alert("success",response['mensaje']);
	    		if (response['render'] != undefined ) {
		    		setTimeout(function(){
						var url = window.location.href;
						url = url.replace(location.pathname, response['render']);
						location.href = url;
					}, 1500);
				}
	    	}else{
	    		mensaje_alert("error",response['mensaje']);
	    	}
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(estado);
	    }
	})
}
function ajax_get_data(ruta,formData){
	$.ajax({
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    success: function(response){
	    	(response['render'] == "ver_usuarios" ? ver_usuarios(response['mensaje']) : "");
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(estado);
	    }
	})
}
function ver_usuarios(response){
	$("div#vista_ventana").html("");
	var html = "";
	$.each(response, function(key, value){
		html += 
		'<div class="row" id="'+value['id_user']+'">\
			<section>\
				<input value="'+value['id_user']+'" name="id_user" type="hidden" readonly>\
				<div class="input-field col s4">\
		            <i class="material-icons prefix">account_circle</i>\
		            <input id="nombre_user" type="text" action_next="index_user" id_form="editar_info" ruta="php/users/update_user.php" id_update="'+value['id_user']+'" class="validate editar_info" name="nombre" autocomplete="off" value="'+value['name_user']+'"  readonly>\
		            <label for="nombre_user" class="active">Nombre cliente</label>\
		        </div>	\
		        <div class="input-field col s4">\
		            <i class="material-icons prefix">account_circle</i>\
		            <input id="apellido_user" type="text" action_next="index_user" id_form="editar_info" ruta="php/users/update_user.php" id_update="'+value['id_user']+'" class="validate editar_info" name="apellido" autocomplete="off" value="'+value['last_name_user']+'" readonly >\
		            <label for="apellido_user" class="active">Apellido cliente</label>\
		        </div>\
		        <div class="input-field col s4">\
		            <i class="material-icons prefix">credit_card</i>\
		            <input id="cedula_user" type="text" action_next="index_user" id_form="editar_info" ruta="php/users/update_user.php" id_update="'+value['id_user']+'" class="validate editar_info" name="cedula" autocomplete="off" value="'+value['cedula']+'" readonly >\
		            <label for="cedula_user" class="active">Cedula cliente</label>\
		        </div>\
		    </section>\
		</div>' 
	});
	$("div#vista_ventana").append(html);
	recargar_eventos();
}
function mensaje_alert(tipo,mensaje,duracion){
	duracion || (duracion = 1500);
	if (tipo == "success") {
		var img = "https://cdn4.iconfinder.com/data/icons/ballicons-2-new-generation-of-flat-icons/100/tick-512.png";
	}else{
		var img = "https://cdn2.iconfinder.com/data/icons/perfect-flat-icons-2/512/Error_warning_alert_attention_remove_dialog.png";
	}
	var html = 
		'<div class="modal-content">\
			<div class="row">\
				<div class="col s12 m6 offset-m3">\
					<div class="card">\
						<div class="card-image centrar">\
							<img src="'+img+'">\
						</div>\
						<div class="card-action">\
							<a href="#">'+mensaje+'</a>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>'
	$("div#modal_mensajes").html(html);
	$('#modal_mensajes').modal('open');
	setTimeout(function(){
		$('#modal_mensajes').modal('close');
	}, duracion);
}