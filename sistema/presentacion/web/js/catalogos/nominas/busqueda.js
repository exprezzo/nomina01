var BusquedaNominas=function(){
	
	this.buscar=function(){
		var gridBusqueda=$(this.tabId+" .grid_busqueda");				
		gridBusqueda.wijgrid('ensureControl', true);
	}
	this.eliminar=function(){
	
	var me=this;
	
	var id = this.selected[this.configuracion.pk];
	var me=this;	
	var params={};
	params[this.configuracion.pk]=id;
	
	$.ajax({
			type: "POST",
			url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/eliminar',

			data: params
		}).done(function( response ) {		
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon=kore.url_web+'imagenes/yes.png';
				title= 'Success';				
				var gridBusqueda=$(me.tabId+" .grid_busqueda");				
				gridBusqueda.wijgrid('ensureControl', true);
			}else{
				icon= kore.url_web+'imagenes/error.png';
				title= 'Error';
			}
			
			//cuando es true, envia tambien los datos guardados.
			//actualiza los valores del formulario.
			$.gritter.add({
				position: 'bottom-left',
				title:title,
				text: msg,
				image: icon,
				class_name: 'my-sticky-class'
			});
		});
}
	this.nuevo=function(){		
		TabManager.add(kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/nuevo');
	};
	this.activate=function(){
		// vuelve a renderear estos elementos que presentaban problemas. (correccion de bug)		
		$(this.tabId+" .lista_toolbar").removeClass('ui-tabs-hide');
		$(this.tabId+" .lista_toolbar  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');		
		
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("¿Eliminar Elemento?");
		if (r==true){
		  this.eliminar();
		}
	}
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.init=function(config){		
		//-------------------------------------------Al nucleo		*/		
		this.controlador=config.controlador;
		this.catalogo=config.catalogo;
		this.configuracion=config;
		//-------------------------------------------
		var tab=config.tab;		
		tabId = '#' + tab.id;
		this.tabId = tabId;
		var jTab=$('div'+tabId);				
		jTab.data('tabObj',this);		
				
		var jTab=$('a[href="'+tabId+'"]');		//// this.agregarClase('busqueda_'+this.controlador.nombre);
	    jTab.html(this.catalogo.nombre);		 
		 jTab.addClass('busqueda_'+this.controlador.nombre); 
		 this.agregarClase('tab_'+this.controlador.nombre);
		//-------------------------------------------
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');			
		//-------------------------------------------				
		this.configurarToolbar(tabId);		
		 this.configurarGrid(tabId);
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		$(this.tabId + ' .toolbarEdicion .btnNuevo').click( function(){
			window.location=kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/nuevo';
		});
		
		$(this.tabId + ' .toolbarEdicion .btnEditar').click( function(){
			if (me.selected!=undefined){													
				var id=me.selected[me.configuracion.pk];							
				window.location=kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar/'+id;				
			}			
		});
		
		$(this.tabId + ' .toolbarEdicion .btnEliminar').click( function(){
			if (me.selected==undefined) return false;
			var r=confirm("¿Eliminar Nomina?");
			if (r==true){
			  me.eliminar();
			}
		});
		
		$(this.tabId + ' .toolbarEdicion input[type="submit"]').click( function(e){
			e.preventDefault();
			var gridBusqueda=$(me.tabId+" .grid_busqueda");				
			gridBusqueda.wijgrid('ensureControl', true);
		});
		
		$(this.tabId+ " > .lista_toolbar").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':						
						me.nuevo();
					break;
					case 'editar':
						if (me.selected!=undefined){													
							var id=me.selected[me.configuracion.pk];							
							TabManager.add(kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,id);
						}
					break;
					case 'eliminar':
						if (me.selected==undefined) return false;
						var r=confirm("¿Eliminar Nomina?");
						if (r==true){
						  me.eliminar();
						}
					break;
					case 'refresh':
						
						var gridBusqueda=$(me.tabId+" .grid_busqueda");
						gridBusqueda.wijgrid('ensureControl', true);
					break;
										
					default:						 
						$.gritter.add({
							position: 'bottom-left',
							title:cmd.commandName,
							text: "Acciones del toolbar en construcci&oacute;n",
							image: kore.url_web+'imagenes/info.png',
							class_name: 'my-sticky-class'
						});
						
					break;
					case 'imprimir':
						alert("Imprimir en construcción");
					break;
				}
				
			}
		});
		
	};
	this.configurarGrid=function(tabId){
		pageSize=10;
		
		var campos=[
			// { name: "id"  }
		];
		var dataReader = new wijarrayreader(campos);
			
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/buscar',
				dataType: "json",
				type:'POST'
			}),
			dynamic:true,
			reader:new wijarrayreader(campos),
			loading : function(data){				
				var value = $( ' input[name="query"]').val();				
				
				data.proxy.options.data.filtering.push({
					dataKey: "razon_social_empresa",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_trabajador",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "serie_serie_nomina",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "serie",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "folio",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "Version",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "RegistroPatronal",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "NumEmpleado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "CURP",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_regimen_contratacion",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "TipoRegimen",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "NumSeguridadSocial",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "FechaPago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "FechaInicialPago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "FechaFinalPago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "NumDiasPagados",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_departamento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "Departamento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "CLABE",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "Banco",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "FechaInicioRelLaboral",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "Antiguedad",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "Puesto",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_regimen_contratacion",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_jornada",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "descripcion_periodo_pago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "SalarioBaseCotApor",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "RiesgoPuesto",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "SalarioDiarioIntegrado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_corto_banco",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "descripcion_riesgo",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "percepcionesTotalGravado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "percepcionesTotalExcento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "deduccionesTotalGravado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "deduccionesTotalExcento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_forma_de_pago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "no_serie_certificado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "condiciones_de_pago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "subTotal",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "descuento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "motivo_descuento",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "tipo_cambio",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "moneda_moneda",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "total",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "tipo_comprobante",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_metodo_de_pago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "num_cta_pago",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "totImpRet",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "totImpTras",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "fecha_emision",
					filterOperator: "Contains",
					filterValue: value
				});
		
				
				
            }
		});
				
		dataSource.reader.read= function (datasource) {						
			var totalRows=datasource.data.totalRows;						
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
		this.dataSource=dataSource;
		var gridBusqueda=$(this.tabId+" .grid_busqueda");

		var me=this;		 
		gridBusqueda.wijgrid({
			dynamic: true,
			allowColSizing:true,			
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:pageSize,
			selectionMode:'singleRow',
			data:dataSource,
			showFilter:false,
			columns: [ 
				{ dataKey: "id", visible:false, headerText: "Id" },
{ dataKey: "razon_social_fk_patron", visible:true, headerText: "Patron" },
{ dataKey: "fk_patron", visible:false, headerText: "Patron" },
{ dataKey: "nombre_fk_empleado", visible:true, headerText: "Empleado" },
{ dataKey: "fk_empleado", visible:false, headerText: "Empleado" },
{ dataKey: "serie_fk_serie", visible:true, headerText: "Serie" },
{ dataKey: "fk_serie", visible:false, headerText: "Serie" },
{ dataKey: "serie", visible:false, headerText: "Serie" },
{ dataKey: "folio", visible:true, headerText: "Folio" },
{ dataKey: "Version", visible:true, headerText: "Version" },
{ dataKey: "RegistroPatronal", visible:true, headerText: "RegistroPatronal" },
{ dataKey: "NumEmpleado", visible:true, headerText: "NumEmpleado" },
{ dataKey: "CURP", visible:true, headerText: "CURP" },
{ dataKey: "nombre_fk_TipoRegimen", visible:true, headerText: "Tipo Regimen" },
{ dataKey: "fk_TipoRegimen", visible:false, headerText: "Tipo Regimen" },
{ dataKey: "TipoRegimen", visible:false, headerText: "TipoRegimen" },
{ dataKey: "NumSeguridadSocial", visible:true, headerText: "NumSeguridadSocial" },
{ dataKey: "FechaPago", visible:true, headerText: "FechaPago" },
{ dataKey: "FechaInicialPago", visible:true, headerText: "FechaInicialPago" },
{ dataKey: "FechaFinalPago", visible:true, headerText: "FechaFinalPago" },
{ dataKey: "NumDiasPagados", visible:true, headerText: "NumDiasPagados" },
{ dataKey: "nombre_fk_Departamento", visible:true, headerText: "Departamento" },
{ dataKey: "fk_Departamento", visible:false, headerText: "Departamento" },
{ dataKey: "Departamento", visible:false, headerText: "Departamento" },
{ dataKey: "CLABE", visible:true, headerText: "CLABE" },
{ dataKey: "Banco", visible:false, headerText: "Banco" },
{ dataKey: "FechaInicioRelLaboral", visible:true, headerText: "FechaInicioRelLaboral" },
{ dataKey: "Antiguedad", visible:true, headerText: "Antiguedad" },
{ dataKey: "Puesto", visible:true, headerText: "Puesto" },
{ dataKey: "nombre_TipoContrato", visible:true, headerText: "TipoContrato" },
{ dataKey: "TipoContrato", visible:false, headerText: "TipoContrato" },
{ dataKey: "nombre_TipoJornada", visible:true, headerText: "Tipo Jornada" },
{ dataKey: "TipoJornada", visible:false, headerText: "Tipo Jornada" },
{ dataKey: "descripcion_PeriodicidadPago", visible:true, headerText: "Periodicidad Pago" },
{ dataKey: "PeriodicidadPago", visible:false, headerText: "Periodicidad Pago" },
{ dataKey: "SalarioBaseCotApor", visible:true, headerText: "SalarioBaseCotApor" },
{ dataKey: "RiesgoPuesto", visible:false, headerText: "RiesgoPuesto" },
{ dataKey: "SalarioDiarioIntegrado", visible:true, headerText: "SalarioDiarioIntegrado" },
{ dataKey: "nombre_corto_fk_banco", visible:true, headerText: "Banco" },
{ dataKey: "fk_banco", visible:false, headerText: "Banco" },
{ dataKey: "descripcion_fk_RiesgoPuesto", visible:true, headerText: "Riesgo Puesto" },
{ dataKey: "fk_RiesgoPuesto", visible:false, headerText: "Riesgo Puesto" },
{ dataKey: "percepcionesTotalGravado", visible:true, headerText: "P. Tot. Gravado" },
{ dataKey: "percepcionesTotalExcento", visible:true, headerText: "P. Tot. Excento" },
{ dataKey: "deduccionesTotalGravado", visible:true, headerText: "D Tot. Gravado" },
{ dataKey: "deduccionesTotalExcento", visible:true, headerText: "D. Tot. Excento" },
{ dataKey: "nombre_fk_forma_pago", visible:true, headerText: "Forma de Pago" },
{ dataKey: "fk_forma_pago", visible:false, headerText: "Forma de Pago" },
{ dataKey: "no_serie_fk_certificado", visible:true, headerText: "Certificado" },
{ dataKey: "fk_certificado", visible:false, headerText: "Certificado" },
{ dataKey: "condiciones_de_pago", visible:true, headerText: "Condiciones De Pago" },
{ dataKey: "subTotal", visible:true, headerText: "Subtotal" },
{ dataKey: "descuento", visible:true, headerText: "Descuento" },
{ dataKey: "motivo_descuento", visible:true, headerText: "Motivo de descuento" },
{ dataKey: "tipo_cambio", visible:true, headerText: "Tipo de Cambio" },
{ dataKey: "moneda_fk_moneda", visible:true, headerText: "Moneda" },
{ dataKey: "fk_moneda", visible:false, headerText: "Moneda" },
{ dataKey: "total", visible:true, headerText: "Total" },
{ dataKey: "tipo_comprobante", visible:true, headerText: "Tipo De Comprobante" },
{ dataKey: "nombre_fk_metodo_pago", visible:true, headerText: "Método de Pago" },
{ dataKey: "fk_metodo_pago", visible:false, headerText: "Método de Pago" },
{ dataKey: "num_cta_pago", visible:true, headerText: "Num Cta Pago" },
{ dataKey: "totImpRet", visible:true, headerText: "Tot Imp Ret" },
{ dataKey: "totImpTras", visible:true, headerText: "Tot Imp Tras" },
{ dataKey: "fecha_emision", visible:true, headerText: "Fecha Emision" },
			]
		});
		
		var me=this;
		
		gridBusqueda.wijgrid({ selectionChanged: function (e, args) { 					
			var item=args.addedCells.item(0);
			var row=item.row();
			var data=row.data;			
			me.selected=data;			
		} });
		
		gridBusqueda.wijgrid({ loaded: function (e) { 
			$(me.tabId + ' .grid_busqueda tr').bind('dblclick', function (e) { 							
				var pedidoId=me.selected[me.configuracion.pk];
				//          TabManager.add(kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,pedidoId);				
				window.location=kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar/'+pedidoId;
			});			
		} });
	};
};