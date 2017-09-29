$(document).on('ready',function(){
	cantidad = ""; 	nombre = "";	id = "";	disponible = "";
	recargar_eventos();
	$('a.link_page').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		$("div#vista_ventana").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('button.link_page_session').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		$("div.contenedor_session").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('a.view_user').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		var id_user = $(this).attr('id_user');
		$("div#vista_ventana").load(ruta,{id_user: id_user},function() {
			recargar_eventos();
		});
	});
	$('div.targeta_inicio').on('click', function(event) {
		event.preventDefault();
		$('div.targeta_inicio').css('height', '5em');
		$(this).find('i').first().css('transform', 'rotate(720deg)');
   		$(this)
   		.animate({ opacity: "0" }, 100 )
   		.animate({ height: "24em" }, 100 )
	    .animate({ opacity: "1" }, 400 )
	    .animate({ borderLeftWidth: "15px" }, 1000 );
	});
});
function eliminar_eventos(){
	$('form#submit_session').off('submit');
	$('button.editar_info').off('click');
	$('form.create_info').off('submit');
	$('form.update_info').off('submit');
	$('button.actualizar_info').off('submit');
	$('select').material_select('destroy');
	$('form#recover_access').off('submit');
	$('input#receive_user').off('focusout');
	$('a.pagination').off('click');
	$('select#select_equipment').off('change');
	$('button#add_exit').off('click');
	$('select#cantidades').off('change');
	$('select').material_select('destroy');
	$('form.create_info #pass_user, form.create_info #pass_user_confirm').off('focusout');
	$('#id_product_exit').off('change');
	$('form#add_exit_product').off('submit');
	$('a#delete_exit').off('click');
}
var recargar_eventos = function(){
	eliminar_eventos();
	$('select').material_select();
	$('form#add_exit_product').on('submit', function(event) {
		event.preventDefault();
		var bodega 			= $( "#id_cellar option:selected" ).text();
		var bodega_id 		= $( "#id_cellar option:selected" ).val();
		var producto 		= $( "#id_product_exit option:selected" ).text();
		var producto_id 	= $( "#id_product_exit option:selected" ).val();
		var lote 			= $( "#id_lote option:selected" ).text();
		var lote_id 		= $( "#id_lote option:selected" ).val();
		var cantidad 		= $( "input#cantidad" ).val();
		var destino 		= $('input:radio[name=destino]:checked').val();
		var recive_id		= $('input#receive_user').val();
		var recive			= $('input#name_receive_user').val();
		var product_exit = {
			'bodega' : bodega,
			'bodega_id': bodega_id,
			'producto' : producto,
			'producto_id' : producto_id,
			'lote' : lote,
			'lote_id' : lote_id,
			'cantidad' : cantidad,
			'destino' : destino,
			'recive_id' : recive_id,
			'recive' : recive
		}
		ver_add_exit_product(product_exit);
	});
	$('button#add_exit').on('click', function(event) {
		event.preventDefault();
		if (cantidad != "" &&  nombre != "") {
			ruta = $('div#view_add_elements').attr('ruta');
			var html =  '<div class="col s12" style="margin-bottom: 1em">\
							<input type="hidden" name="" value="'+id+'">\
							<div class="col s12 sombra element_salida">\
								<a class="btn-floating waves-effect waves-light white right" style="position: absolute; margin-top: -.9em; margin-left: -1.5em"><i class="material-icons">clear</i></a>\
								<h5 class="col s12 titulo color_letra_primario center">'+nombre+'</h5>\
								<div class="input-field col s12 m6" id="'+nombre+'">\
							    </div>\
							    <div class="input-field col s12 m6">\
						            <input id="anotacion" type="text" class="validate" name="nota[]" autocomplete="off">\
						            <label for="anotacion" class="">Nota</label>\
						        </div>\
						    </div>\
				        </div>'; 
			$("div#view_add_elements").append(html);
			$("div#"+nombre).load(ruta,{cantidad_disponible: disponible, cantidad: cantidad},function() {
				$('option#'+nombre+"_"+id).attr('disabled', 'true').attr('selected','true');
				$('select#select_equipment').val( $('select#select_equipment').prop('defaultSelected') );
				cantidad = ""; 	nombre = "";	id = "";	disponible = "";
				recargar_eventos();
			});
		}else{
			mensaje_alert("error","Selecciona todos los campos",2000);
		}
	});
	$('#id_product_exit').change(function(event) {
		var ruta = "../php/stock/_view_select_stock.php";
		var id_product = $('option:selected', this).val();
		$("div#mostrar_lotes").load(ruta,{id_product: id_product},function() {
			recargar_eventos();
		});
	});
	$('#stock select').change(function(event){
		var ruta = "../php/products/view_selects_products.php";
		var id_cellars = $(this).val();
		$("div#mostrar_productos").load(ruta,{id_cellars: id_cellars},function() {
			recargar_eventos();
		});
	});
	$('a#delete_exit').on('click', function(event) {
		event.preventDefault();
		$(this).closest('div').animate({
			opacity: "0",
			overflow: "hidden",
			height: "0px",
			width: "0px",
		},1000, function() {
			$(this).closest('div').remove();
		});
		
	});
	$('select#cantidades').change(function(event) {
		cantidad = 	$(this).val();
	});
	$('select#select_equipment').change(function(event) {
		cantidad = "";		nombre = "";		id = "";
		nombre = $('option:selected', this).text();
		id = $('option:selected', this).val();
		disponible = $('option:selected', this).attr('disponible');
		ruta = $(this).attr('ruta');
		$("div#cantidad_disponible").load(ruta,{cantidad_disponible: disponible},function() {
			recargar_eventos();
		});
	});
	$('select#id_lote').change(function(event) {
		disponible = $('option:selected', this).attr('disponible');
		alert(disponible);
		$('input#cantidad').attr('max',disponible).attr('placeholder', 'Cantidad disponible'+ disponible).val(disponible);
	});
	$('a.pagination').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		var pagina = $(this).attr('pag');
		$("div#vista_ventana").load(ruta,{pagina: pagina},function() {
			recargar_eventos();
		});
	});
	$('input#receive_user').focusout(function(event) {
		var ruta = $(this).attr('ruta');
		var cedula = $(this).val();
		var formData = {
			'cedula' : cedula
		};
		request_user(ruta,formData);
	});
	$('form#recover_access').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		formData.append("recover", true);
		var ruta = $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	});
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
		$(this).closest('div#vista_ventana').find('i').css('color', 'rgba(0,0,0,.4)');
		$(this).closest('div').siblings('div').find('i').css('color', 'rgb(30,136,229)');
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
	$('form.create_info #pass_user, form.create_info #pass_user_confirm,form.update_info #pass_user, form.update_info #pass_user_confirm').focusout(function(event) {
		var pass = $('input#pass_user').val();
		var pass_confirm = $('input#pass_user_confirm').val();
		if (pass == pass_confirm){
			$('form.create_info #pass_user, form.create_info #pass_user_confirm, form.update_info #pass_user, form.update_info #pass_user_confirm').removeClass('invalid');
			$('form.create_info #pass_user, form.create_info #pass_user_confirm, form.update_info #pass_user, form.update_info #pass_user_confirm').addClass('valid');
		}else{
			if(pass != pass_confirm && pass != '' && pass_confirm != ''){
				$('form.create_info #pass_user, form.create_info #pass_user_confirm, form.update_info #pass_user, form.update_info #pass_user_confirm').removeClass('valid');
				$('form.create_info #pass_user, form.create_info #pass_user_confirm, form.update_info #pass_user, form.update_info #pass_user_confirm').addClass('invalid');
			}
		}
	});
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 2, // Creates a dropdown of 15 years to control year,
	    selectMonths: true, // Creates a dropdown to control month 
	    format: 'yyyy-mm-dd',
  	});
}
function ajax_set_form_data(ruta,formData){
	$.ajax({
		beforeSend:function() { 
         	mensaje_cargando('process','Se está realizando el proceso');
     	},
     	complete: function(){
   		},
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    //es necesario por que estamos utlizando var formData = new FormData(document.getElementById("submit_user"));
	    contentType: false,
	    processData: false, 
	    success: function(response){
	    	success(response);
	    	if (response['status']==1 && response['process']=='create')  {
 	    		clean_input();
 	    	}
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(estado);
	    }
	})
}
function request_user(ruta,formData){
	var datos = ""; 	var status = "";
	$.ajax({
		beforeSend:function() { 
         	mensaje_cargando('process','Se está realizando el proceso');
     	},
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    success: function(response){
	    	var response = jQuery.parseJSON(response);
	    	$.each(response,function(index, value) {
	    		(index === "data") ? datos = jQuery.parseJSON(value) : "";
	    		(index === "status") ? status = jQuery.parseJSON(value) : "";
	    		
	    	});
	    	$('#modal_mensajes').modal('close');
	    	ver_info_user(datos,status);
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(estado);
	    	console.log(jqXHR);
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
function success(response = "Exito"){
	if (response['status'] > 0) {
		mensaje_alert("success",response['mensaje'],response['duracion']);
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
}
function limpiar(){
	$('form#add_exit_product select').val($('select').prop('defaultSelected'));
}
function clean_input(){
	$('.create_info')[0].reset(); //Sirve para resetear a su estado original el form
	$('.create_info i, .create_info label').removeClass('active'); 
	$('.create_info input').removeClass('valid');
}
function parse_fecha_numeric(fecha){
	var fecha = new Date(fecha);
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	var fecha = fecha.toLocaleDateString("es-ES", options);
	var fecha = fecha.split("/");
	fecha = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
	return fecha;
}
function parse_fecha_string(fecha){
	var fecha = new Date(fecha);
	var options = { year: 'numeric', month: 'long', day: '2-digit' };
	var fecha = fecha.toLocaleDateString("es-ES", options);
	return fecha;
}
function ver_info_user(datos,status){
	if(datos['documento'] != undefined ){
		var html = 
			'<input type="hidden" name="name_receive_user" value="'+datos['documento']+'">\
			<i class="material-icons prefix">account_circle</i>\
            <input id="name_receive_user" value="'+datos['nombre_completo']+'" type="text" class="validate" name="receive_user" autocomplete="off" required>\
            <label for="name_receive_user" class="active">Nombre de quien recibe</label>'
	}else{
		var html = 
			'<div class="col s12 centrar sombra" id="">\
				<h5 class="color_letra_primario">\
					<i class="material-icons color_letra_secundario">warning</i> ¡No hay registros! \
				</h5>\
    		</div> '
	}
	$('div#name_receive_user').html(html);
}
function mensaje_alert(tipo,mensaje,duracion){
	duracion || (duracion = 2000);
	if (tipo == "success") {
		var img = "../image/success.gif";
	}else{
		var img = "../image/errormessage.png";
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
							<a href="#" class="color_letra_primario">'+mensaje+'</a>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>'
	$("div#modal_mensajes").html(html);
	$('#modal_mensajes').modal('open');
	setTimeout(function(){
		$("div#modal_mensajes").html("");
		$('#modal_mensajes').modal('close');
	}, duracion);
}
function mensaje_cargando(tipo,mensaje){
	if(tipo == "process"){
		var img = "../image/process.webp";
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
							<a href="#" class="color_letra_primario">'+mensaje+'</a>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>'
	$("div#modal_mensajes").html(html);
	$('#modal_mensajes').modal('open');
}
function ver_add_exit_product(product_exit){
	if ($("div#"+product_exit['bodega']+"_"+product_exit['producto_id']+"_"+product_exit['lote']).length == 0) {
		var html =  
		'<div class="col s12" style="margin-bottom: 1em">\
			<input type="hidden" name="producto_id[]" value="'+product_exit['producto_id']+'">\
			<input type="hidden" name="bodega_id[]" value="'+product_exit['bodega_id']+'">\
			<input type="hidden" name="lote_id[]" value="'+product_exit['lote_id']+'">\
			<input type="hidden" name="destino[]" value="'+product_exit['destino']+'">\
			<div class="col s12 sombra element_salida">\
				<a id="delete_exit" class="btn-floating waves-effect waves-light white right" style="position: absolute; margin-top: -.9em; margin-left: -1.5em"><i class="material-icons">clear</i></a>\
				<h6 class="col s12 m6 center titulo color_letra_secundario">Bodega: '+product_exit['bodega']+'</h6>\
				<h6 class="col s12 m6 center titulo color_letra_secundario">producto: '+product_exit['producto']+'</h6>\
				<h6 class="col s12 m6 center titulo color_letra_secundario">lote: '+product_exit['lote']+'</h6>\
				<div class="col s12">\
					<div class="input-field col s12 m6" id="'+product_exit['bodega']+"_"+product_exit['producto_id']+"_"+product_exit['lote']+'">\
						<i class="material-icons prefix">filter_9_plus</i>\
			            <input id="nombre_descripcion" type="number" class="validate" name="cantidad[]" value="'+product_exit['cantidad']+'" autocomplete="off" required >\
			            <label for="nombre_descripcion" class="active">Descripción</label>\
				    </div>\
				    <div class="input-field col s12 m6">\
			            <input id="anotacion" type="text" class="validate" name="nota" autocomplete="off">\
			            <label for="anotacion" class="">Nota</label>\
			        </div>\
		        </div>\
		    </div>\
	    </div>';
	    alert("-----"+ disponible);
	    $('div#'+product_exit['bodega']+"_"+product_exit['producto_id']+"_"+product_exit['lote']+" input").attr('max', disponible);
	    ruta = $('div#view_add_elements').attr('ruta');
	    $("div#view_add_elements").append(html);
	    limpiar();
	}else{
		mensaje_alert("error","No puedes agregar el producto varias veces",2000);
	}
}