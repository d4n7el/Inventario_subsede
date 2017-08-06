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
		formData = {
			'id_user': '%%', 
		}
		ajax_get_data(ruta,formData);
	});
});
function eliminar_eventos(){
	$('form#submit_user').off('submit');
	$('form#submit_session').off('submit');
	$('input.editar_usuario').off('submit');
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
		var formData = new FormData(document.getElementById("submit_session"));
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	})
	$('input.editar_usuario').on('click', function(event) {
		event.preventDefault();
		$('div#modal1 div.modal-content form').html("<h5 class='titulo col m12 right-align '>Actualizacion</h5>");
		$('#modal1').modal('open');
		var html = $(this).closest('section').html();
		$('div#modal1 div.modal-content h5').after(html);
		$('div#modal1 div.modal-content input').removeAttr('readonly');
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
		'<div class="row">\
			<section>\
				<div class="input-field col s4">\
		            <i class="material-icons prefix">account_circle</i>\
		            <input id="nombre_user" type="text" class="validate editar_usuario" name="nombre" autocomplete="off" value="'+value['name_user']+'"  readonly>\
		            <label for="nombre_user" class="active">Nombre cliente</label>\
		        </div>	\
		        <div class="input-field col s4">\
		            <i class="material-icons prefix">account_circle</i>\
		            <input id="apellido_user" type="text" class="validate editar_usuario" name="apellido" autocomplete="off" value="'+value['last_name_user']+'" readonly >\
		            <label for="apellido_user" class="active">Apellido cliente</label>\
		        </div>\
		        <div class="input-field col s4">\
		            <i class="material-icons prefix">credit_card</i>\
		            <input id="cedula_user" type="text" class="validate editar_usuario" name="cedula" autocomplete="off" value="'+value['cedula']+'" readonly >\
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