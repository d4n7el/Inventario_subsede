$(document).on('ready',function(){
	recargar_eventos();
	$('a.link_page').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		$("div#vista_ventana").load(ruta,function() {
			recargar_eventos();
		});
	});
});
function eliminar_eventos(){
	$('form#submit_session').off('submit');
	$('button.editar_info').off('click');
	$('form.update_info').off('submit');
	$('button.actualizar_info').off('submit');
	$('select').material_select('destroy');
}
var recargar_eventos = function(){
	eliminar_eventos();
	$('select').material_select();
	$('form.create_info').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	});
	$('button.editar_info').on('click', function(event) {
		event.preventDefault();
		$(this).closest('form').find('div').removeClass('hide');
		$(this).closest('form').find('button').removeClass('hide');
		$(this).closest('form').find('button.editar_info').addClass('hide');
		$(this).closest('form').find('input').removeAttr('readonly');
	});
	$('form.update_info').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		var ruta = $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	});
	$('button.actualizar_info').on('click', function(event) {
		$(this).addClass('hide');
		$(this).closest('form').find('button.editar_info').removeClass('hide');
		$(this).closest('form').find('div.oculto').addClass('hide');
		$(this).closest('form').find('input').attr('readonly','true');
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
	    			if (response['render'] != "") {
			    		setTimeout(function(){
							var url = window.location.href;
							url = url.replace(location.pathname, response['render']);
							location.href = url;
						}, 1500);
		    		}else{
			    		setTimeout(function(){
							var url = window.location.href;
							location.href = url;
						}, 1500);
		    		}
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
	    	if (response['render'] != undefined && response['render'] != "") {
		    		setTimeout(function(){
						var url = window.location.href;
						url = url.replace(location.pathname, response['render']);
						location.href = url;
					}, 1500);
				}else{
					setTimeout(function(){
						var url = window.location.href;
						location.href = url;
					}, 1500);
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
	    
	    },
	    error: function(jqXHR,error,estado){
	    	
	    }
	})
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