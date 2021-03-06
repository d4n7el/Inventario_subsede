$(document).on('ready',function(){
	cantidad = ""; 	nombre = "";	id = "";	disponible = "";
	div_id	 = ""; destino = "";  id_user = ""; name_user = "";
	recargar_eventos();
	if ($(window).width() < 447) {
		widthNav = 350;
		marginButtons = ['21em','17em']
		leftButtons = ['17em','13em','21em'];
		topButtons = ['4em','8em']
	}else{
		widthNav = 430;
		leftButtons = ['22em','18em','26em'];
		topButtons = ['4em','8em']
	}
	$('.button-collapse').sideNav({
		menuWidth: widthNav, 
		edge: 'left', 
		closeOnClick: true, 
		draggable: true,
		onOpen: function(el) {
			$('a.collapse_one,a.collapse_two').css({
				'transition': "1s",
				'margin-left': leftButtons[0],
				'margin-top': topButtons[0],
			});
			$('a.collapse_two').css({
				'transition': "1s",
				'margin-left': leftButtons[1],
				'margin-top': topButtons[1],
			});
			$('.button-collapse').css('margin-left', leftButtons[2]);
			$('i.slide-outs').css({
				transform: 'rotate(360deg)',
				transition: '.5s',
			});
			$('i.slide-outs').text('clear');
			$('#modal_right,#modal_center,#modal_center_two').modal('close');
		}, 
		onClose: function(el) {
			$('a.collapse_one,a.collapse_two').css({
				'transition': "1s",
				'margin-left': ".5em",
				'margin-top': "0em",
			});
			$('a.collapse_two').css({
				'transition': "1s",
				'margin-left': "0em",
				'margin-top': "0em",
			});
			$('.button-collapse').css('margin-left', '1em');
			$('i.slide-outs').css({
				transform: 'rotate(-360deg)',
				transition: '.5s'
			});
			
			$('i.slide-outs').text('menu');
		}, 
    });
	$('a.link_page').on('click', function(event) {
		event.preventDefault();
		$("div#vista_ventana").css({
			transition: '1s',
			opacity: '0',
		});
		$('a.link_page').closest('div.card-action').addClass('fondo_negro').removeClass('fondo_claro');
		$(this).closest('div.card-action').addClass('fondo_claro').removeClass('fondo_negro');
		var ruta = $(this).attr('href');
		$('div.list_add_exit_plant').html("");
		$('div.list_add_exit_plant').html("");
		$("div#vista_ventana").load(ruta,function() {
			limpiar_variables();
			recargar_eventos();
			$( "div#vista_ventana" ).fadeIn( 400 );
			$("div#vista_ventana").css({
			transition: '1s',
			opacity: '1',
		});
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
});
function limpiar_variables(){
	cantidad = ""; 	nombre = "";	id = "";	disponible = "";
	div_id	 = ""; destino = "";  id_user = ""; name_user = "";
}
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
	$('a.delete_exit').off('click');
	$('button.view_exit_inform').off('click');
	$('form.search').off('submit');
	$('button.edit_cant_inform').off('click');
	$('button.delete_exit_inform').off('click');
	$('input#test1,input#test2').off('change');
	$('button#generar_pdf').off('click');
	$('a.tabla').off('click');
	$('a.add_exit_plant').off('click');
	$('a.delete_exit_plant').off('click');
	$('form.search_exit_plant').off('submit');
	$('a.view_graphics').off('click');
	$('button.view_info_user').off('click');
	$('button.view_info_stock').off('click');
	$('button.flujo_alterno,a.flujo_alterno').off('click');
	$('button.view_info_equipment').off('click');
	$('button.view_info_product').off('click');
	$('button.view_info_tool').off('click');
	$('a.view_expiration').off('click');
	$('input.state').off('change');
	$('button#view_list_exit').off('click');
	$('button.view_entry_inform').off('click');
	$('button.edit_entry_cant_inform').off('click');
	$('button.link_page_session').off('click');
	$('form.create_info_exit_stock').off('submit');
	$('i.mas').off('click');
	$('i.menos').off('click');
	$('button.add_destinatario').off('click');
	$('button.expired_output').off('click');
	$('button.view_info_cellar').off('click');
	$('a#exportExcel').off('click');
}
var recargar_eventos = function(){
	eliminar_eventos();
	next_view_actions_height = $('div#view_actions').height();
	$('div#next_view_actions').css('margin-top', next_view_actions_height+"px");
	$('.collapsible').collapsible();
	$('a#exportExcel').on('click', function(event) {
		var ruta = $(this).attr('ruta');
		formData = {
			'imprimir': 1,
		}
		ajax_get_data(ruta,formData);
	});
	$('.icons_select').on('click', function(event) {
		var name_icon = $(this).attr('name_icon');
		$('input#icon_cellar').val(name_icon);
		$('.icons_select').removeClass('iconActive');
		$(this).addClass('iconActive');
	});
	$('i.destination').on('click', function(event) {
		event.preventDefault();
		$('i.destination').removeClass('color_letra_danger').addClass('color_letra_secundario');
		$(this).addClass('color_letra_danger');
		$('input#'+$(this).attr('destino')).click();
	});
	$('btn-cerrar').on('click', function(event) {
		$('.button-collapse').sideNav('hide');
	});
	$('i.mas').on('click', function(event) {
		event.preventDefault();
		$(this).siblings('p.range-field').find('span.thumb').addClass('active');
		$(this).siblings('p.range-field').find('input[type=range]').val(parseInt($(this).siblings('p.range-field').find('input[type=range]').val()) + 1);
		$(this).siblings('p.range-field').find('span.thumb').addClass('active');
		dialogo($(this).siblings('p.range-field').find('input[type=range]').val(),status = 1 ,duracion = 4000);
	});
	$('i.menos').on('click', function(event) {
		event.preventDefault();
		$(this).siblings('p.range-field').find('span.thumb').addClass('active');
		$(this).siblings('p.range-field').find('input[type=range]').val(parseInt($(this).siblings('p.range-field').find('input[type=range]').val()) - 1);
		$(this).siblings('p.range-field').find('span.thumb').addClass('active');
		dialogo($(this).siblings('p.range-field').find('input[type=range]').val(),status = 1 ,duracion = 4000);
	});
	$('.modal').modal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		inDuration: 300, // Transition in duration
		outDuration: 200, // Transition out duration
		startingTop: '4%', // Starting top style attribute
		endingTop: '10%', // Ending top style attribute
		complete: function() { 
			$(this).find('div.modal-content').html("");
			$('#modal_center .modal-content').html("<form class='update_info'></form>");
		} // Callback for Modal close
	});
	$('form.create_info_exit_stock').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		formData.append("destino", destino);
		formData.append("receive_user", id_user);
		formData.append("name_receive_user", name_user);
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	});
	$('button#create_destino').on('click', function(event) {
		event.preventDefault();
		destino = $('input#desc_destino').val();
		id_user = $('input#receive_user').val();
		name_user = $('input#name_receive_user').val();
		if ($('input#desc_destino').val() != "" && $('input#name_receive_user') != "" && name_user != undefined ) {
			
			var html_user = 
				'<h6 class="">\
					Recibe: '+name_user+'\
					<i class="material-icons col s2 right" >account_circle</i>\
				</h6>';
			var html_destino = 
				'<h6 class="">\
					Destino: '+destino+'\
					<i class="material-icons col s2 right" >airport_shuttle</i>\
				</h6>';
			$('div.recibe').html(html_user);
			$('div.destino_salida').html(html_destino);
			$('#modal_center').modal('close');
		}else{
			dialogo('Ingresa todos los campos');
		}
	});
	$('button.add_destinatario').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		var alterno = 1;
		$("div#modal_center div.modal-content").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('button.link_page_session').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		$('button.link_page_session').removeClass('btn-success');
		$(this).addClass('btn-success');
		$("div.contenedor_session").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('button#view_list_exit').on('click', function(event) {
		event.preventDefault();
		if (destino != "" &&  id_user != "" && name_user != "") {
			var html = $('div.list_add_exit_plant').html();
			$("div#modal_right div.modal-content").html('<div class="row list_stock_exit">'+html+"</div>");
			$("div#modal_right div.modal-content div.list_add_exit_plant").removeClass('hide');
			recargar_eventos();
			$('#modal_right').modal('open');
		}else{
			dialogo("Ingresa la informacion de destino");
		}
	});
	$('input.state').on('change', function(event) {
		($(this).val() == 1) ? $(this).val("0") : $(this).val("1");
		($(this).val() == 1) ? mensaje =  "Si" : mensaje = "No";
		var state = $(this).val();
		var master = $(this).attr('master');
		var detalle = $(this).attr('detalle');
		var ruta = $(this).attr('ruta');
		formData = {
			'master': master,
			'detalle': detalle,
			'state': state
		};
		$('h6#'+detalle+master).text(mensaje);
		ajax_get_data(ruta,formData);
	});
	$('button.flujo_alterno,a.flujo_alterno').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		var alterno = 1;
		$("div#modal_center_two div.modal-content").load(ruta,{alterno : alterno},function() {
			recargar_eventos();
		});
	});
	$('button.expired_output').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/expiration/_expired_output.php";
		var datos = [];
		$(this).closest('div').siblings('div').find('h6').each(function() {
  			datos.push($(this).text());
		});
		id_stock = $(this).attr('stock');
		formData = {
			'datos' : datos,
			'id_stock' : id_stock
		}	
		$("div#modal_center div.modal-content").load(ruta,formData,function() {
			recargar_eventos();
		});
	});
	$('button.view_info_user').on('click', function(event) {
		event.preventDefault();
		var id_user = $(this).attr('id_user');
		var estado = $(this).attr('state');
		var ruta = $(this).attr('ruta');
		$("div#modal_right div.modal-content").load(ruta,{id_user: id_user, estado: estado,modal: 1},function() {
			recargar_eventos();
		});
	});
	$('a.view_graphics').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		$("div#modal_right div.modal-content").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('a.add_exit_plant').on('click', function(event) {
		event.preventDefault();
		var divs = $(this).attr('divs');
		if ($('div#'+divs+"add").length > 0) {
			mensaje_alert("error","No puedes agregar el producto varias veces",2000);
		}else{
			dialogo("Agregado correctamente",status = 1 ,duracion = 4000)
			var html = $('div#'+divs).html();
			$('div.list_add_exit_plant div.listado').after(html);
			$('div.list_add_exit_plant div.card').first()
				.animate({ opacity: 0 },0)
				.animate({ opacity: 1 },1000);
			$('div.list_add_exit_plant div.card').first().attr('id',divs+"add");
			$('div.list_add_exit_plant div.card div.cantidad').removeClass('hide');
			$('div.list_add_exit_plant div.card').removeClass('s12').addClass('col s12 m6 l4');
			$('div.list_add_exit_plant a.add_exit_plant').addClass('hide');
			$('div.list_add_exit_plant a.delete_exit_plant').removeClass('hide');
			recargar_eventos();
		}
	});
	$('form.search_exit_plant').on('submit', function(event) {
		event.preventDefault();

		var ruta = $(this).attr('action');
		var search = $('input#search').val();
		$("div.formulario").load(ruta,{search: search},function() {
			recargar_eventos();
		});
	});
	$('a.delete_exit_plant').on('click', function(event) {
		event.preventDefault();
		var div = $(this).attr('divs')+"add";
		$('div#'+div)
			.animate({ opacity: 0 },300);
		$('div#'+div).remove();
		$('div#'+div).remove();
	});
	$('a.tabla').on('click', function(event) {
		event.preventDefault();
		$('input#order').val($(this).attr('order'));
		$('form.search').submit();
	});
	$('input#Externo,input#interno').on('change', function(event) {
		event.preventDefault();
		if ($(this).val() == "Ext") {
			$('div#desc_destino').removeClass('hide');
			$('div#desc_destino input').removeAttr('readonly');
			$('div#desc_destino input').val('');
		}else{
			$('div#desc_destino').addClass('hide');
			$('div#desc_destino input').add('readonly');
			$('div#desc_destino input').val('Interno');
		}
	});
	$('button#generar_pdf').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/expor_pdf.php";
		formData = {
			'html': $('div#area_impresion').html(),
		}
		ajax_get_data(ruta,formData);
	});
	$('a#new_impresion').on('click', function(event) {
		$('button#generar_pdf').removeClass('hide').addClass('btn-primary');
		$(this).addClass('hide');
	});
	$('select').material_select();
	$('button.view_info_stock').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/stock/index.php";
		var id_stock = $(this).attr('stock');
		$("div#modal_right div.modal-content").load(ruta,{id_stock: id_stock},function() {
			recargar_eventos();
		});
	});
	$('a.view_expiration').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		$("div#modal_right div.modal-content").load(ruta,function() {
			recargar_eventos();
		});
	});
	$('button.view_info_product').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/products/index.php";
		var id_product = $(this).attr('product');
		$("div#modal_center div.modal-content").load(ruta,{id_product: id_product},function() {
			recargar_eventos();
		});
	});
	$('button.view_info_cellar').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		var id_cellar = $(this).attr('cellar');
		$("div#modal_right div.modal-content").load(ruta,{id_cellar: id_cellar},function() {
			recargar_eventos();
		});
	});
	$('button.view_info_equipment').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/equipments/index.php";
		var id_equipment = $(this).attr('equipment');
		var estado = $(this).attr('estado');
		$("div#modal_right div.modal-content").load(ruta,{estado: estado,id_equipment: id_equipment},function() {
			recargar_eventos();
		});
	});
	$('button.view_info_tool').on('click', function(event) {
		event.preventDefault();
		var ruta = "../php/tools/index.php";
		var id_tool = $(this).attr('tool');
		$("div#modal_right div.modal-content").load(ruta,{id_tool: id_tool},function() {
			recargar_eventos();
		});
	});
	$('button#impresion').on('click', function(event) {
		event.preventDefault();
		var html = $('div#area_impresion').html();
		var ruta = "../php/expor_pdf.php";
		$("div#area_impresion").load(ruta,{html: html},function() {
			recargar_eventos();
		});
	});
	$('form.search').on('submit', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('action');
		var formData = {};
		$('input.search').each(function() {
  			formData[$(this).attr('id')] =  $(this).val();
		});
		$("div#vista_ventana").load(ruta,formData,function() {
			recargar_eventos();
		});
	});
	$('button.view_entry_inform').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		var id_process = $(this).attr('id_process');
		var proccess = $(this).attr('procceso');
		var fecha = $(this).attr('fecha');
		formData = {
			'id_process': id_process,
			'proccess': proccess,
			'fecha': fecha,
		}
		$("div#modal_right div.modal-content").load(ruta,formData,function() {
			recargar_eventos();
		});
	});
	$('button.view_exit_inform').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('ruta');
		var id_process = $(this).attr('id_process');
		var id_exit_master = $(this).attr('id_exit_master');
		$("div#modal_right div.modal-content").load(ruta,{id_exit_master: id_exit_master},function() {
			recargar_eventos();
		});
	});

	$('button.delete_exit_inform').on('click', function(event) {
		event.preventDefault();
		var id_exit_master = $(this).attr('id_exit_master');
		var id_exit_detalle = $(this).attr('id_exit_detalle');
		var id_element = $(this).attr('id_element');
		var ruta = $(this).attr('ruta');
		var datos = {};
		datos['id_exit_master'] = id_exit_master;
		datos['id_exit_detalle'] = id_exit_detalle;
		datos['id_element'] = id_element;
		var x = 0;
		if ($(this).closest('div').siblings('div').find('h6').length > 0) {
			$(this).closest('div').siblings('div').find('h6').each(function() {
				datos["a_"+x] =  $.trim($(this).text());
				x++;	
			});
		}else{
			$(this).closest('div.info').siblings('div').find('h6').each(function() {
				datos["a_"+x] =  $.trim($(this).text());
				x++;	
			});
		}
		$("div#modal_center div.modal-content").load(ruta,datos,function() {
			recargar_eventos();
		});
	});
	$('button.edit_cant_inform').on('click', function(event) {
		var ruta = $(this).attr('ruta');
		var ruta_update = $(this).attr('ruta_update');
		var id_exit_master = $(this).attr('id_exit_master');
		var id_exit_detalle = $(this).attr('id_exit_detalle');
		var id_element = $(this).attr('id_element');
		var formData = {
			'id_exit_master': id_exit_master,
			'id_exit_detalle': id_exit_detalle,
			'id_element': id_element
		}
		div_id = id_exit_master+id_exit_detalle+id_element;
		$('div#modal_center div.modal-content form').load(ruta,formData,function() {
			$('div#modal_center div.modal-content form').attr('action',ruta_update);
			recargar_eventos();
		});
	});
	$('button.edit_entry_cant_inform').on('click', function(event) {
		var ruta = $(this).attr('ruta');
		var ruta_update = $(this).attr('ruta_update');
		var procceso = $(this).attr('procceso');
		var id_process = $(this).attr('id_process');
		var stock = $(this).attr('stock');
		var formData = {
			'procceso': procceso,
			'id_process': id_process,
			'stock': stock
		}
		div_id = procceso+id_process+stock;
		$('div#modal_center div.modal-content form').load(ruta,formData,function() {
			$('div#modal_center div.modal-content form').attr('action',ruta_update);
			recargar_eventos();
		});
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
	$('a.delete_exit').on('click', function(event) {
		event.preventDefault();
		$(this).closest('div').animate({
			opacity: "0",
			overflow: "hidden",
		},500, function() {
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
		unidad = $('option:selected', this).attr('unidad');
		$('input#cantidad').attr('max',disponible).val(disponible);
		$('input#cantidad').attr('min','0.1').val(disponible);
		$('input#cantidad').siblings('label').text('disponibles ( '+ disponible + " ) Unidad de salida " + unidad);
	});
	$('a.pagination').on('click', function(event) {
		event.preventDefault();
		var ruta = $(this).attr('href');
		var pagina = $(this).attr('pag');
		formData = {};
		$('input.search').each(function() {
			if ($(this).val() == "") {
				var value = "%%";
			}else{
				var value = $(this).val();
			}
  			formData[$(this).attr('id')] =  value;
		});
		formData['pagina'] = pagina;
		$("div#vista_ventana").load(ruta,formData,function() {
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
	$('input#test1,input#test2').on('change',function(event) {
		$('input#estado').val($(this).val());
	});
	$('form.create_info').on('submit', function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		var ruta =  $(this).attr('action');
		ajax_set_form_data(ruta,formData);
	});
	$('button.editar_info').on('click', function(event) {
		event.preventDefault();
		$(this).closest('form').find('div.oculto').addClass('hide');
		$(this).closest('form').find('div').removeClass('hide');
		$(this).closest('form').find('button').removeClass('hide');
		$(this).closest('form').find('button.editar_info').addClass('hide');
		$(this).closest('form').find('input').removeAttr('readonly');
		$(this).closest('div#vista_ventana').find('i').css('color', 'rgba(0,0,0,.4) !important');
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
	    selectYears: 10, // Creates a dropdown of 15 years to control year,
	    selectMonths: true, // Creates a dropdown to control month 
	    format: 'yyyy-mm-dd',
  	});
}
function ajax_set_form_data(ruta,formData){
	$.ajax({
		beforeSend:function() { 
         	mensaje_alert('process','Se está realizando el proceso');
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
	    	$('#modal_mensajes').modal('close');
	    	success(response);
	    	if (response['status']==1 && response['process']=='create')  {
 	    		clean_input();
 	    		if (response['graphics'] != undefined) {
					$('div#view_graphics').load(response['graphics']);
		    	}
 	    	}
 	    	if (response['status']==1 && response['process']=='exit_product')  {
 	    		limpiar_exit();
 	    	}
 	    	if (response['status']==1 && response['process']=='update_cant_product' && response['cantidad'] != undefined ) {
 	    		$('h6#cantidad_'+div_id).text(response['cantidad']);
 	    	}
 	    	if (response['status']==1 && response['process']=='new_expired' && response['stock'] != undefined ) {
 	    		new_expiration(response);
 	    	}
 	    	if (response['status']==1 && response['redirecTo'] != undefined && response['redirecTo'] != "" ) {
 	    		$("div.contenedor_session").load(response['redirecTo'],function() {
					recargar_eventos();
				});
 	    	}
 	    	if (response['status']==1 && response['closeModal'] != undefined && response['closeModal'] == 1 ) {
 	    		$('#modal_right,#modal_center,#modal_center_two').modal('close');
 	    	}
 	    	(response['reload'] != undefined && response['reload'] == "search") ?  $('form.search').submit() : "";
	
	    },
	    error: function(jqXHR,error,estado){
	    }
	})
}
function new_expiration(response){
	$('div#celda_stock'+response['stock']).find('button.expired_output').text('done').removeClass('color_letra_danger').addClass('color_letra_secundario');
	var num_antes = parseInt($('a.view_expiration_count').text());
	var nueva_cantidad = num_antes - 1;
	nueva_cantidad = nueva_cantidad.toString();
	$('a.view_expiration_count').text(nueva_cantidad);
}
function request_user(ruta,formData){
	var datos = ""; 	var status = "";
	$.ajax({
		beforeSend:function() { 
         	mensaje_alert('process','Se está realizando el proceso');
     	},
		url: ruta,
	    type: "POST",
	    dataType: "json",
	    data: formData,
	    success: function(response){
	    	$('#modal_mensajes').modal('close');
	    	var response = jQuery.parseJSON(response);
	    	$.each(response,function(index, value) {
	    		if (index === "data") {
	    			var data = jQuery.parseJSON(value);
	    			$.each(data,function(pos, data) {
						(pos === "modelo") ? datos = data : "";
	    			});	
	    		}
	    		(index === "status") ? status = jQuery.parseJSON(value) : "";
	    	});
	    	
	    	ver_info_user(datos,status);
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(error);
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
	    	(response['process'] != undefined && response['process'] == "imprimir") ? view_btn_imprimir(response) : "";
	    	(response['process'] != undefined && response['process'] == "imprimiendo") ? view_btn_imprimir(response) : "";
	    	(response['process'] != undefined && response['process'] == "returned") ?  dialogo(response['mensaje'],response['status']) : "";
	    	(response['process'] != undefined && response['process'] == "returned") ?  $('form.search').submit() : "";
	    },
	    error: function(jqXHR,error,estado){
	    	console.log(jqXHR);
	    }
	})
}
function success(response = "Exito"){
	if (response['status'] > 0) {
		dialogo(response['mensaje'],response['status'],4000);
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
		dialogo(response['mensaje'],response['status'],4000);
	}
}
function dialogo(mensaje,status = 1 ,duracion = 4000){
	if (status == 1) {
		$('div.toast').addClass('fondo_negro');
	}
	Materialize.toast(mensaje, duracion);
}
function clean_input(){
	$('form.update_info input[type=password]').val("");
	$('.create_info')[0].reset(); //Sirve para resetear a su estado original el form
	$('.create_info i, .create_info label').removeClass('active'); 
	$('div#name_receive_user').html("");
	$('input#receive_user').val("");
	$('div#view_add_elements').html("");
	$('.create_info input').removeClass('valid');
	$("a.delete_exit_plant").click();
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
            <input id="name_receive_user" value="'+datos['nombre_completo']+'" type="text" class="validate" name="name_receive_user" autocomplete="off" required>\
            <label for="name_receive_user" class="active">Nombre de quien recibe</label>'
	}else{
		var html = 
			'<div class="col s12 centrar sombra" id="">\
				<h5 class="color_letra_secundario titulo">\
					<i class="material-icons color_letra_secundario">warning</i> ¡Usuario no encontrado! \
				</h5>\
    		</div> '
	}
	$('div#name_receive_user').html(html);
}
function mensaje_alert(tipo,mensaje,duracion){
	duracion || (duracion = 2000);
	if (tipo == "success" || tipo == "process") {
		var img = "../image/sena.svg";
	}else{
		var img = "../image/errormessage.png";
	}
	var html = 
		'<div class="modal-content">\
			<div class="row">\
				<div class="col s12 m6 offset-m3">\
					<div class="card">\
						<div class="card-image centrar fondo_negro">\
							<img src="'+img+'" class="cargando">\
						</div>\
						<div class="card-action fondo_negro center">\
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
		var img = "../image/sena.svg";
	}
	var html = 
		'<div class="modal-content">\
			<div class="row">\
				<div class="col s12 m6 offset-m3">\
					<div class="card">\
						<div class="card-image centrar fondo_negro">\
							<img src="'+img+'" class="cargando">\
						</div>\
						<div class="card-action fondo_negro">\
							<a href="#" class="color_letra_primario">'+mensaje+'</a>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>'
	$("div#modal_mensajes").html(html);
	$('#modal_mensajes').modal('open');
}
function limpiar_add_exit(){
	cantidad = ""; 	nombre = "";	id = "";	disponible = "";
	$('select#id_cellar').val( $('select#id_cellar').prop('defaultSelected') );
	$('div#mostrar_lotes,div#mostrar_productos').html("");
	$("input#cantidad").val("");
	$("input#cantidad").siblings('label').text("");
}
function limpiar_exit(){
	destino = "";  id_user = ""; name_user = "";
	$("a.delete_exit_plant").click();
	$('div#name_receive_user').html("");
	$('input#receive_user').val("");
	var html_user = 
		'<h6 class="">\
			Recibe:\
			<i class="material-icons col s2 right" >account_circle</i>\
		</h6>';
	var html_destino = 
		'<h6 class="">\
			Destino:\
			<i class="material-icons col s2 right" >airport_shuttle</i>\
		</h6>';
	$('div.recibe').html(html_user);
	$('div.destino_salida').html(html_destino);
}
function view_btn_imprimir(response){
	if (response['process'] == "imprimir" && response['status'] == 1) {
		$('a#new_impresion').removeClass('hide');
		$('button#generar_pdf').addClass('hide');	
	}else{
		$('a#new_impresion').addClass('hide');
		$('button#generar_pdf').removeClass('hide');	
	}
	if (response['process'] == "imprimiendo" && response['status'] == 1) {
		$('a#new_impresion').addClass('hide');
		$('button#generar_pdf').removeClass('hide');
	}
}