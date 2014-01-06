var EdicionTrabajadores = function(){
	this.editado=false;
	this.tituloNuevo='Nuevo Trabajador';
	this.saveAndClose=false;
	
	this.configurarComboFk_TipoRegimen=function(){
		var me=this;
		
		$('select[name="fk_TipoRegimen"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_TipoRegimen input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_TipoRegimenEnAjax) return true;			
			me.setDSFk_TipoRegimen();
			me.Fk_TipoRegimenEnAjax=true;
		 });
	};
		
		
	this.setDSFk_TipoRegimen = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarRegimen_contratacion',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_TipoRegimen"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_pais=function(){
		var me=this;
		
		$('select[name="fk_pais"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_pais input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_paisEnAjax) return true;			
			me.setDSFk_pais();
			me.Fk_paisEnAjax=true;
		 });
	};
		
		
	this.setDSFk_pais = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarPais',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_pais"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_estado=function(){
		var me=this;
		
		$('select[name="fk_estado"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_estado input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_estadoEnAjax) return true;			
			me.setDSFk_estado();
			me.Fk_estadoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_estado = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarEstado',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_estado"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_municipio=function(){
		var me=this;
		
		$('select[name="fk_municipio"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_municipio input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_municipioEnAjax) return true;			
			me.setDSFk_municipio();
			me.Fk_municipioEnAjax=true;
		 });
	};
		
		
	this.setDSFk_municipio = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarMunicipio',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_municipio"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_TipoContrato=function(){
		var me=this;
		
		$('select[name="fk_TipoContrato"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_TipoContrato input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_TipoContratoEnAjax) return true;			
			me.setDSFk_TipoContrato();
			me.Fk_TipoContratoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_TipoContrato = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarTipo_de_contrato',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_TipoContrato"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_departamento=function(){
		var me=this;
		
		$('select[name="fk_departamento"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			// forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_departamento input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_departamentoEnAjax) return true;			
			me.setDSFk_departamento();
			me.Fk_departamentoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_departamento = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarDepartamento',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_departamento"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_TipoJornada=function(){
		var me=this;
		
		$('select[name="fk_TipoJornada"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_TipoJornada input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_TipoJornadaEnAjax) return true;			
			me.setDSFk_TipoJornada();
			me.Fk_TipoJornadaEnAjax=true;
		 });
	};
		
		
	this.setDSFk_TipoJornada = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarJornada',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_TipoJornada"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_PeriodicidadPago=function(){
		var me=this;
		
		$('select[name="fk_PeriodicidadPago"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_PeriodicidadPago input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_PeriodicidadPagoEnAjax) return true;			
			me.setDSFk_PeriodicidadPago();
			me.Fk_PeriodicidadPagoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_PeriodicidadPago = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarPeriodo_pago',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'descripcion' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_PeriodicidadPago"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_RiesgoPuesto=function(){
		var me=this;
		
		$('select[name="fk_RiesgoPuesto"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_RiesgoPuesto input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_RiesgoPuestoEnAjax) return true;			
			me.setDSFk_RiesgoPuesto();
			me.Fk_RiesgoPuestoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_RiesgoPuesto = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarRiesgo',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'descripcion' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_RiesgoPuesto"]').wijcombobox('option','data',datasource);
	};
		
	this.configurarComboFk_banco=function(){
		var me=this;
		
		$('select[name="fk_banco"]').wijcombobox({			
			showTrigger: true,
			width:300,
			minLength:1,
			autoFilter:false,	
			// forceSelectionText:true,
			select : function (e, data) {						
			},
			search: function (e, obj) { 						
			}
		 });
		 
		 $('.contenedor_fk_banco input[role="textbox"]').bind('keypress', function(){			
			if (me.Fk_bancoEnAjax) return true;			
			me.setDSFk_banco();
			me.Fk_bancoEnAjax=true;
		 });
	};
		
		
	this.setDSFk_banco = function(){		
		
		var filtering=new Array();
		var proxy = new wijhttpproxy({
			url: kore.url_base+kore.modulo+'/trabajadores/buscarBanco',
			dataType: "json", 
			type:"POST",
			data: {
				style: "full",
				 filtering:filtering						
			},
			key: 'datos'
		}); 

		var myReader = new wijarrayreader([
		{name:'label', mapping:'nombre_corto' }, 
		{name:'value', mapping:'id' }]); 

		var datasource = new wijdatasource({ 
			reader: myReader, 
			proxy: proxy 
		}); 
	
		$('select[name="fk_banco"]').wijcombobox('option','data',datasource);
	};
		
	var me=this;
	this.borrar=function(){		
		var r=confirm("¿Eliminar Trabajador?");
		if (r==true){
		  this.eliminar();
		}
	}
	this.activate=function(){
		var tabId=this.tabId;
		
	}
	this.close=function(){
		
		if (this.editado){
			var res=confirm('¿Guardar antes de salir?');
			if (res===true){
				this.saveAndClose=true;
				this.guardar();
				return false;
			}else{
				return true
			}
		}else{
			return true;
		}
	};
	this.init=function(params){
		this.controlador=params.controlador;
		this.catalogo=params.catalogo;
		this.configuracion=params;
		
		var tabId='#'+params.tab.id;
		var objId=params.objId;
		
		this.tabId= tabId;		
		
		$(tabId+' .cerrar_tab').bind('click', function(){
			TabManager.cerrarTab( params.tab.id );
		 });
		
		var tab=$('div'+this.tabId);
		//estas dos linas deben estar en la hoja de estilos
		tab.css('padding','0');
		tab.css('border','0 1px 1px 1px');
		
		
		this.agregarClase('frm'+this.controlador.nombre);		
		this.agregarClase('tab_'+this.controlador.nombre);
		
		this.configurarFormulario(this.tabId);
		this.configurarToolbar(this.tabId);		
		// this.notificarAlCerrar();			
		this.actualizarTitulo();				
		
		var me=this;
		$(this.tabId + ' .frmEdicion input').change(function(){
			me.editado=true;		
		});
		
		$(tabId+' .toolbarEdicion .boton:not(.btnPrint, .btnEmail)').mouseenter(function(){
			$(this).addClass("ui-state-hover");
		});
		
		$(tabId+' .toolbarEdicion .boton *').mouseenter(function(){						
			 $(this).parent('.boton').addClass("ui-state-hover");						
		});
		
		$(tabId+' .toolbarEdicion .boton').mouseleave(function(e){			 
				$(this).removeClass("ui-state-hover");			
		});
		
		tab.data('tabObj',this); //Este para que?		
	};
	//esta funcion pasara al plugin
	//agrega una clase al panel del contenido y a la pesta�a relacionada.
	
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.notificarAlCerrar=function(){
		var tabId = this.tabId;
		var me=this;
		 $('#tabs > ul a[href="'+tabId+'"] + span').click(function(e){
			e.preventDefault();
			 var tmp=$(me.tabId+' .txtIdTmp');				
			if (tmp.length==1){
				var id=$(tmp[0]).val();				
				$.ajax({
					type: "POST",
					url: '/'+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/cerrar',
					data: { id:id }
				}).done(function( response ) {
					
				});
			}	
		 });
	}
	this.actualizarTitulo=function(){
		var me=this;
		function getValorCampo(campo){
			var valor = $(me.tabId + ' [name="'+campo+'"]').val();
			return valor;
		}
		
		var tabId = this.tabId;		
		var id = $(this.tabId + ' [name="id"]').val();
		if (id>0){						
			$(tabId +' #titulo h1').html('Trabajador:  ' + getValorCampo('nombre') + ''); 
		}else{
			$(tabId +' #titulo h1').html(this.tituloNuevo);
			// $('a[href="'+tabId+'"]').html('Nuevo');
		}
	};
	this.nuevo=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);		
		$(tabId +' #titulo h1').html(this.tituloNuevo);
		
		tab.find('[name="id"]').val(0);
		me.editado=false;
	};	
	this.guardar=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		var me=this;
	
		//-----------------------------------
		// http://stackoverflow.com/questions/2403179/how-to-get-form-data-as-a-object-in-jquery
		var paramObj = {};
		$.each($(tabId + ' .frmEdicion').serializeArray(), function(_, kv) {
		  if (paramObj.hasOwnProperty(kv.name)) {
			paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
			paramObj[kv.name].push(kv.value);
		  }
		  else {
			paramObj[kv.name] = kv.value;
		  }
		});
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_TipoRegimen"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_TipoRegimen"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_TipoRegimen'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_TipoRegimen'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_TipoRegimen'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_pais"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_pais"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_pais'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_pais'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_pais'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_estado"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_estado"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_estado'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_estado'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_estado'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_municipio"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_municipio"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_municipio'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_municipio'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_municipio'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_TipoContrato"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_TipoContrato"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_TipoContrato'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_TipoContrato'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_TipoContrato'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_departamento"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_departamento"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_departamento'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_departamento'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_departamento'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_TipoJornada"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_TipoJornada"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_TipoJornada'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_TipoJornada'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_TipoJornada'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_PeriodicidadPago"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_PeriodicidadPago"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_PeriodicidadPago'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_PeriodicidadPago'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_PeriodicidadPago'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_RiesgoPuesto"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_RiesgoPuesto"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_RiesgoPuesto'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_RiesgoPuesto'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_RiesgoPuesto'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		

		//-----------------------------------		
		var selectedIndex = $('[name="fk_banco"]').wijcombobox('option','selectedIndex');  
		var selectedItem = $('[name="fk_banco"]').wijcombobox("option","data");		
		if (selectedIndex == -1){
			paramObj['fk_banco'] =0;
		}else{
			if (selectedItem.data == undefined ){
				paramObj['fk_banco'] =selectedItem[selectedIndex]['value'];
			}else{
				paramObj['fk_banco'] =selectedItem.data[selectedIndex]['id'];
			}
		}
		//-----------------------------------
		
		//-----------------------------------
		var datos=paramObj;
		
				
		//Envia los datos al servidor, el servidor responde success true o false.
		$("#contenedorDatos2").block({ 
			message: '<h1>Guardando</h1>'               
		}); 
		$.ajax({
			type: "POST",
			url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/guardar',
			data: { datos: datos}
		}).done(function( response ) {
			$("#contenedorDatos2").unblock(); 
			var msg;
			var title;	
			try{
					var resp = eval('(' + response + ')');
			}catch(err){
				msg='El servidor ha respondido de manera incorrecta. <br />'+response;
				title='Error Al Guardar';
				icon= kore.url_web+'imagenes/error.png';
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
				return false;
			}			
			msg= (resp.msg)? resp.msg : '';
			
			
			if ( resp.success == true	){
				if (resp.msgType!=undefined && resp.msgType == 'info'){
					icon=kore.url_web+'imagenes/yes.png';
				}else{
					icon=kore.url_web+'imagenes/info.png';
				}
				
				if (resp.esNuevo){					
					window.location = kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar/'+ resp.datos.id;
				}
				title= 'Success';				
				// tab.find('[name="'+me.configuracion.pk+'"]').val(resp.datos[me.configuracion.pk]);
				tab.find('[name="'+me.configuracion.pk+'"]').val(resp.datos[me.configuracion.pk]);
				
				me.actualizarTitulo();
				me.editado=false;
				var objId = '/'+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);				
				
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
				
				
				if (me.saveAndClose===true){
					//busca el indice del tab
					var idTab=$(me.tabId).attr('id');
					var tabs=$('#tabs > div');
					for(var i=0; i<tabs.length; i++){
						if ( $(tabs[i]).attr('id') == idTab ){
							$('#tabs').wijtabs('remove', i);
						}
					}
				}
			}else{
				icon= kore.url_web+'imagenes/error.png';
				title= 'Error';					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			}
			
			//cuando es true, envia tambien los datos guardados.
			//actualiza los valores del formulario.
			
		});
	};	
	this.eliminar=function(){
		var id = $(this.tabId + ' [name="id"]').val();
		var me=this;
		
		var params={};
		params['id']=id;
		
		
		$.ajax({
				type: "POST",
				url: kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/eliminar',

				data: params
			}).done(function( response ) {		
				var msg;
				var title;	
				try{
						var resp = eval('(' + response + ')');
				}catch(err){
					msg='El servidor ha respondido de manera incorrecta. <br />'+response;
					title='Error Al Intentar Eliminar';
					icon= kore.url_web+'imagenes/error.png';
					$.gritter.add({
						position: 'bottom-left',
						title:title,
						text: msg,
						image: icon,
						class_name: 'my-sticky-class'
					});
					return false;
				}			
				msg= (resp.msg)? resp.msg : '';
				if ( resp.success == true	){					
					icon=kore.url_web+'imagenes/yes.png';
					title= 'Success';									
				}else{
					icon= kore.url_web+'imagenes/error.png';
					title= 'Error';
				}
				
				//cuando es true, envia tambien los datos guardados.
				//actualiza los valores del formulario.
				// var idTab=$(me.tabId).attr('id');
				// var tabs=$('#tabs > div');
				me.editado=false;
				// for(var i=0; i<tabs.length; i++){
					// if ( $(tabs[i]).attr('id') == idTab ){
						// $('#tabs').wijtabs('remove', i);
					// }
				// }
				$(me.tabId).find('[name="id"]').val(0);
					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			});
	},	
	this.configurarFormulario=function(tabId){		
		var me=this;
		// $(this.tabId+' .frmEdicion input[type="text"]').wijtextbox();		
		// $(this.tabId+' .frmEdicion textarea').wijtextbox();			
		
this.configurarComboFk_TipoRegimen();
this.configurarComboFk_pais();
this.configurarComboFk_estado();
this.configurarComboFk_municipio();
this.configurarComboFk_TipoContrato();
this.configurarComboFk_departamento();
this.configurarComboFk_TipoJornada();
this.configurarComboFk_PeriodicidadPago();
this.configurarComboFk_RiesgoPuesto();
this.configurarComboFk_banco();
	};
	this.configurarToolbar=function(tabId){					
		var me=this;			
		$(this.tabId + ' .toolbarEdicion .btnNuevo').click( function(){
			window.location=kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/nuevo';
		});
		
		$(this.tabId + ' .toolbarEdicion .btnGuardar').click( function(){
			me.guardar();
			me.editado=true;
		});
		
		$(this.tabId + ' .toolbarEdicion .btnPdf').click( function(){
			var id=$(me.tabId + ' [name="id"]').val();
			if (id > 0){								
				window.location=kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/bajarPdf/'+id;
			}
		});
		
		$(this.tabId + ' .toolbarEdicion .btnDelete').click( function(){
			var r=confirm("¿Eliminar Trabajador?");
			if (r==true){
			  me.eliminar();
			  me.editado=false;
			  me.nuevo();
			}
		});
	};	
}
