var BusquedaTrabajadores=function(){
	
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
			var r=confirm("¿Eliminar Trabajador?");
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
						var r=confirm("¿Eliminar Trabajador?");
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
					dataKey: "nombre",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "rfc",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "email",
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
					dataKey: "NumSeguridadSocial",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "calle",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "noExterior",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "noInterior",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "colonia",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "localidad",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "referencia",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_pais",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_estado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_municipio",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "codigoPostal",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "NoEmpleado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "SalarioDiarioIntegrado",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "SalarioBaseCotApor",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "FechaInicioRelLaboral",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "puesto",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_tipo_de_contrato",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_departamento",
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
					dataKey: "descripcion_riesgo",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "nombre_corto_banco",
					filterOperator: "Contains",
					filterValue: value
				});
		
				data.proxy.options.data.filtering.push({
					dataKey: "CLABE",
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
{ dataKey: "nombre", visible:true, headerText: "Nombre" },
{ dataKey: "rfc", visible:true, headerText: "Rfc" },
{ dataKey: "email", visible:true, headerText: "Email" },
{ dataKey: "CURP", visible:true, headerText: "CURP" },
{ dataKey: "nombre_fk_TipoRegimen", visible:true, headerText: "Tipo Regimen" },
{ dataKey: "fk_TipoRegimen", visible:false, headerText: "Tipo Regimen" },
{ dataKey: "NumSeguridadSocial", visible:true, headerText: "NumSeguridadSocial" },
{ dataKey: "calle", visible:true, headerText: "Calle" },
{ dataKey: "noExterior", visible:true, headerText: "NoExterior" },
{ dataKey: "noInterior", visible:true, headerText: "NoInterior" },
{ dataKey: "colonia", visible:true, headerText: "Colonia" },
{ dataKey: "localidad", visible:true, headerText: "Localidad" },
{ dataKey: "referencia", visible:true, headerText: "Referencia" },
{ dataKey: "nombre_fk_pais", visible:true, headerText: "Pais" },
{ dataKey: "fk_pais", visible:false, headerText: "Pais" },
{ dataKey: "nombre_fk_estado", visible:true, headerText: "Estado" },
{ dataKey: "fk_estado", visible:false, headerText: "Estado" },
{ dataKey: "nombre_fk_municipio", visible:true, headerText: "Municipio" },
{ dataKey: "fk_municipio", visible:false, headerText: "Municipio" },
{ dataKey: "codigoPostal", visible:true, headerText: "Codigo Postal" },
{ dataKey: "NoEmpleado", visible:true, headerText: "No Empleado" },
{ dataKey: "SalarioDiarioIntegrado", visible:true, headerText: "Salario Diario Integrado" },
{ dataKey: "SalarioBaseCotApor", visible:true, headerText: "Salario Base Cot" },
{ dataKey: "FechaInicioRelLaboral", visible:true, headerText: "Fecha Contratación" },
{ dataKey: "puesto", visible:true, headerText: "Puesto" },
{ dataKey: "nombre_fk_TipoContrato", visible:true, headerText: "Tipo Contrato" },
{ dataKey: "fk_TipoContrato", visible:false, headerText: "Tipo Contrato" },
{ dataKey: "nombre_fk_departamento", visible:true, headerText: "Departamento" },
{ dataKey: "fk_departamento", visible:false, headerText: "Departamento" },
{ dataKey: "nombre_fk_TipoJornada", visible:true, headerText: "Tipo Jornada" },
{ dataKey: "fk_TipoJornada", visible:false, headerText: "Tipo Jornada" },
{ dataKey: "descripcion_fk_PeriodicidadPago", visible:true, headerText: "Periodicidad Pago" },
{ dataKey: "fk_PeriodicidadPago", visible:false, headerText: "Periodicidad Pago" },
{ dataKey: "descripcion_fk_RiesgoPuesto", visible:true, headerText: "Riesgo Puesto" },
{ dataKey: "fk_RiesgoPuesto", visible:false, headerText: "Riesgo Puesto" },
{ dataKey: "nombre_corto_fk_banco", visible:true, headerText: "Banco" },
{ dataKey: "fk_banco", visible:false, headerText: "Banco" },
{ dataKey: "CLABE", visible:true, headerText: "CLABE" },
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