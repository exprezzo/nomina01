<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_patron_listado=array();
			$fk_patron_listado[]=array('id'=>$this->datos['fk_patron'],'razon_social'=>$this->datos['razon_social_fk_patron'] );
			$this->fk_patron_listado = $fk_patron_listado;
		}else{
			$mod=new empresaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_patron_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_empleado_listado=array();
			$fk_empleado_listado[]=array('id'=>$this->datos['fk_empleado'],'nombre'=>$this->datos['nombre_fk_empleado'] );
			$this->fk_empleado_listado = $fk_empleado_listado;
		}else{
			// $mod=new trabajadorModelo();
			// $objs=$mod->buscar( array() );		
			// $this->fk_empleado_listado = $objs['datos'];
			$this->fk_empleado_listado = array();
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_serie_listado=array();
			$fk_serie_listado[]=array('id'=>$this->datos['fk_serie'],'serie'=>$this->datos['serie_fk_serie'] );
			$this->fk_serie_listado = $fk_serie_listado;
		}else{
			$mod=new serie_nominaModelo();
			$objs=$mod->buscar( array() );		
			$this->datos['serie'] = $objs['datos'][0]['serie'];
			$this->datos['folio'] = $objs['datos'][0]['sig_folio'];
			
			$this->fk_serie_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoRegimen_listado=array();
			$fk_TipoRegimen_listado[]=array('id'=>$this->datos['fk_TipoRegimen'],'nombre'=>$this->datos['nombre_fk_TipoRegimen'] );
			$this->fk_TipoRegimen_listado = $fk_TipoRegimen_listado;
		}else{
			$mod=new regimen_contratacionModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoRegimen_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_Departamento_listado=array();
			$fk_Departamento_listado[]=array('id'=>$this->datos['fk_Departamento'],'nombre'=>$this->datos['nombre_fk_Departamento'] );
			$this->fk_Departamento_listado = $fk_Departamento_listado;
		}else{
			$mod=new departamentoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_Departamento_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$TipoContrato_listado=array();
			$TipoContrato_listado[]=array('id'=>$this->datos['TipoContrato'],'nombre'=>$this->datos['nombre_TipoContrato'] );
			$this->TipoContrato_listado = $TipoContrato_listado;
		}else{
			$mod=new tipo_de_contratoModelo();
			$objs=$mod->buscar( array() );		
			$this->TipoContrato_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$TipoJornada_listado=array();
			$TipoJornada_listado[]=array('id'=>$this->datos['TipoJornada'],'nombre'=>$this->datos['nombre_TipoJornada'] );
			$this->TipoJornada_listado = $TipoJornada_listado;
		}else{
			$mod=new jornadaModelo();
			$objs=$mod->buscar( array() );		
			$this->TipoJornada_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$PeriodicidadPago_listado=array();
			$PeriodicidadPago_listado[]=array('id'=>$this->datos['PeriodicidadPago'],'descripcion'=>$this->datos['descripcion_PeriodicidadPago'] );
			$this->PeriodicidadPago_listado = $PeriodicidadPago_listado;
		}else{
			$mod=new periodo_pagoModelo();
			$objs=$mod->buscar( array() );		
			$this->PeriodicidadPago_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_banco_listado=array();
			$fk_banco_listado[]=array('id'=>$this->datos['fk_banco'],'nombre_corto'=>$this->datos['nombre_corto_fk_banco'] );
			$this->fk_banco_listado = $fk_banco_listado;
		}else{
			$mod=new bancoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_banco_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_RiesgoPuesto_listado=array();
			$fk_RiesgoPuesto_listado[]=array('id'=>$this->datos['fk_RiesgoPuesto'],'descripcion'=>$this->datos['descripcion_fk_RiesgoPuesto'] );
			$this->fk_RiesgoPuesto_listado = $fk_RiesgoPuesto_listado;
		}else{
			$mod=new riesgoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_RiesgoPuesto_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_forma_pago_listado=array();
			$fk_forma_pago_listado[]=array('id'=>$this->datos['fk_forma_pago'],'nombre'=>$this->datos['nombre_fk_forma_pago'] );
			$this->fk_forma_pago_listado = $fk_forma_pago_listado;
		}else{
			$mod=new forma_de_pagoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_forma_pago_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_certificado_listado=array();
			$fk_certificado_listado[]=array('id'=>$this->datos['fk_certificado'],'no_serie'=>$this->datos['no_serie_fk_certificado'] );
			$this->fk_certificado_listado = $fk_certificado_listado;
		}else{
			$mod=new certificadoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_certificado_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_moneda_listado=array();
			$fk_moneda_listado[]=array('id'=>$this->datos['fk_moneda'],'moneda'=>$this->datos['moneda_fk_moneda'] );
			$this->fk_moneda_listado = $fk_moneda_listado;
		}else{
			$mod=new monedaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_moneda_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_metodo_pago_listado=array();
			$fk_metodo_pago_listado[]=array('id'=>$this->datos['fk_metodo_pago'],'nombre'=>$this->datos['nombre_fk_metodo_pago'] );
			$this->fk_metodo_pago_listado = $fk_metodo_pago_listado;
		}else{
			$mod=new metodo_de_pagoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_metodo_pago_listado = $objs['datos'];
		}
?>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/percepciones_de_nomina.js"></script>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/deducciones_de_nomina.js"></script>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/incapacidades_de_nomina.js"></script>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/horas_extra_de_nomina.js"></script>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/conceptos_de_nomina.js"></script>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/impuestos_de_nomina.js"></script>
<script>			
	$( function(){	
		
		//---------------------
		<?php
		$resAntS = sessionGet('res');
		$resAnt = empty($resAntS) ? array() : $resAntS;		
		sessionUnset('res');
		?>
		var resAnt = <?php echo json_encode($resAnt); ?>;
		
		if (resAnt.success != undefined ){			
			var title='', msg	=resAnt.msg, icon='';
			if(resAnt.success){
				icon=kore.url_web+'imagenes/yes.png';
				title= 'Success';					
			}else{
				icon= kore.url_web+'imagenes/error.png';
				title= 'Error';
			}
			
			$.gritter.add({
				position: 'bottom-left',
				title:title,
				text: msg,
				image: icon,
				class_name: 'my-sticky-class'
			});
		}
		//---------------------
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			modulo:{
				nombre:'<?php echo $_PETICION->modulo; ?>'
			},
			catalogo:{
				nombre:'Paginas',
				modelo:'Pagina'
			},			
			pk:"id"
			
		};				
		 var editor=new EdicionNominas();
		 editor.init(config);	
		//-----
		
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['percepcionesDeNomina']); ?>,
			target:'.tabla_percepciones',
			contenedor:'.contenedor_tabla_percepciones',
		};

		var percepcionesDeNomina = new PercepcionesDeNomina();		
		percepcionesDeNomina.init(configDet);
				
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['deduccionesDeNomina']); ?>,
			target:'.tabla_deducciones',
			contenedor:'.contenedor_tabla_deducciones',
		};

		var deduccionesDeNomina = new DeduccionesDeNomina();		
		deduccionesDeNomina.init(configDet);
				
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['incapacidadesDeNomina']); ?>,
			target:'.tabla_incapacidades',
			contenedor:'.contenedor_tabla_incapacidades',
		};

		var incapacidadesDeNomina = new IncapacidadesDeNomina();		
		incapacidadesDeNomina.init(configDet);
				
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['horas_extraDeNomina']); ?>,
			target:'.tabla_horas_extra',
			contenedor:'.contenedor_tabla_horas_extra',
		};

		var horas_extraDeNomina = new Horas_extraDeNomina();		
		horas_extraDeNomina.init(configDet);
				
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['conceptosDeNomina']); ?>,
			target:'.tabla_conceptos',
			contenedor:'.contenedor_tabla_conceptos',
		};

		var conceptosDeNomina = new ConceptosDeNomina();		
		conceptosDeNomina.init(configDet);
				
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['impuestosDeNomina']); ?>,
			target:'.tabla_impuestos',
			contenedor:'.contenedor_tabla_impuestos',
		};

		var impuestosDeNomina = new ImpuestosDeNomina();		
		impuestosDeNomina.init(configDet);
		
		var options={requireOpenedPane: false, active: false, collapsible: true};
		// $(".datos_empleado").wijaccordion(options);
		// $(".datos_empleado").accordion(options);
		// $(".datos_facturacion").accordion(options);
		
		
	});
</script>
<style>
.wijmo-wijinput{display:inline-block; }

.contenedor_fecha_emision .inputBox div[role="combobox"] {width: 91px !important;}
div[role="combobox"] input[role="textbox"] {height:24px !important; }
#datos_empleado .inputBox label:nth-child(1), .datos_facturacion .inputBox label:nth-child(1){
	margin-left:0;
}
#tablaFechas thead td{width:164px;}
#tablaFechas thead td{width:164px;}

#tablaTotales input{text-align: right; }

.toolbar_detalles{margin-bottom:24px !important;}

[name="fk_moneda"]{width: 150px !important;}

.ui-state-disabled, .ui-widget-content .ui-state-disabled{opacity: 1 !important; filter: Alpha(Opacity=1) !important;}
</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Nomina</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto"   >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				
				<div class="datos_empleado" title="Datos del empleado" style="width:800px; margin:10px 0 20px 100px;">
					<div>
						<?php // include dirname(__FILE__).'/_datos_empleado.php'; ?>	
					</div>				
				</div>
				<div class="datos_generales" style="">
					<?php include dirname(__FILE__).'/_generales.php'; ?>		
				</div>			
					
				
				<div id="tabsConceptosDeNomina" style="margin: 0 30px 20px 30px;">
					<ul>
						<li><a href="#tabPercepciones">Percepciones</a></li>
						<li><a href="#tabDeducciones">Deducciones</a></li>
						<li><a href="#tabIncapacidades">Incapacidades</a></li>
						<li><a href="#tabHorasExtra">Horas Extra</a></li>
						<li><a href="#tabConceptos">Conceptos</a></li>
						<li><a href="#tabImpuestos">Impuestos</a></li>
					</ul>
					<div id="tabPercepciones" class="tabla contenedor_tabla_percepciones" style="position: relative; margin-bottom: 35px;"  >
						
						<h1 class="tituloTabla" style="" >Percepciones</h1>
						<div class="toolbar_detalles" style="">
							<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
							<input type="button" value="" class="btnEliminar" id="botonEliminar" />
						</div>
						<table class="tabla_percepciones">
							<thead></thead>
							<tbody></tbody>
						</table>
						<div id="<?php echo $id; ?>-dialog-confirm-eliminar-percepcion_nomina" title="&iquest;Eliminar Percepcion_nomina?">
							<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Percepcion_nomina?</p>
						</div> 
						<div style="display:none;">
							<div class="inputBox contenedor_percepcionesTotalGravado" style=""  >
								<label style="">P. Tot. Gravado:</label>
								<input title="Percepciones Total Gravado" type="text" name="percepcionesTotalGravado" class="entradaDatos" value="<?php echo $this->datos['percepcionesTotalGravado']; ?>" style="width:500px;" />
							</div>
							<div class="inputBox contenedor_percepcionesTotalExcento" style=""  >
								<label style="">P. Tot. Excento:</label>
								<input title="Percepciones Total Excento" type="text" name="percepcionesTotalExcento" class="entradaDatos" value="<?php echo $this->datos['percepcionesTotalExcento']; ?>" style="width:500px;" />
							</div>
						</div>
					</div>
					
					
					<div id="tabDeducciones" class="tabla contenedor_tabla_deducciones" style="position: relative; margin-bottom: 35px;"  >
						
						<h1 class="tituloTabla" >Deducciones</h1>
						<div class="toolbar_detalles" style="">
							<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
							<input type="button" value="" class="btnEliminar" id="botonEliminar" />
						</div>
						<table class="tabla_deducciones">
							<thead></thead>
							<tbody></tbody>
						</table>
						<div id="<?php echo $id; ?>-dialog-confirm-eliminar-deduccion_nomina" title="&iquest;Eliminar Deduccion_nomina?">
							<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Deduccion_nomina?</p>
						</div>
						<div style="display:none;">
							<div class="inputBox contenedor_deduccionesTotalGravado" style=""  >
								<label style="">D Tot. Gravado:</label>
								<input title="Deducciones Total Gravado" type="text" name="deduccionesTotalGravado" class="entradaDatos" value="<?php echo $this->datos['deduccionesTotalGravado']; ?>" style="width:500px;" />
							</div>
							<div class="inputBox contenedor_deduccionesTotalExcento" style=""  >
								<label style="">D. Tot. Excento:</label>
								<input title="Deducciones" type="text" name="deduccionesTotalExcento" class="entradaDatos" value="<?php echo $this->datos['deduccionesTotalExcento']; ?>" style="width:500px;" />
							</div>
						</div>
					</div>
					
					
					<div id="tabIncapacidades" class="tabla contenedor_tabla_incapacidades" style="position: relative;  margin-bottom: 35px;"  >
						
						<h1 class="tituloTabla" >Incapacidades</h1>
						<div class="toolbar_detalles" style="">
							<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
							<input type="button" value="" class="btnEliminar" id="botonEliminar" />
						</div>
						<table class="tabla_incapacidades">
							<thead></thead>
							<tbody></tbody>
						</table>
						<div id="<?php echo $id; ?>-dialog-confirm-eliminar-incapacidad" title="&iquest;Eliminar Incapacidad?">
							<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Incapacidad?</p>
						</div> 
					</div>
					<div id="tabHorasExtra" class="tabla contenedor_tabla_horas_extra" style="position: relative;  margin-bottom: 35px;"  >
						
						<h1 class="tituloTabla" >Horas Extra</h1>
						<div class="toolbar_detalles" style="">
							<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
							<input type="button" value="" class="btnEliminar" id="botonEliminar" />
						</div>
						<table class="tabla_horas_extra">
							<thead></thead>
							<tbody></tbody>
						</table>
						<div id="<?php echo $id; ?>-dialog-confirm-eliminar-hora_extra_nomina" title="&iquest;Eliminar Hora_extra_nomina?">
							<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Hora_extra_nomina?</p>
						</div> 
					</div>
					<div id="tabConceptos">
						<div class="tabla contenedor_tabla_conceptos" style="position: relative;  margin-bottom: 35px;"  >		
							<h1 class="tituloTabla" >Conceptos</h1>
							<div class="toolbar_detalles" style="">
								<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
								<input type="button" value="" class="btnEliminar" id="botonEliminar" />
							</div>
							<table class="tabla_conceptos">
								<thead></thead>
								<tbody></tbody>
							</table>
							<div id="<?php echo $id; ?>-dialog-confirm-eliminar-concepto_de_nomina" title="&iquest;Eliminar Concepto_de_nomina?">
								<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Concepto_de_nomina?</p>
							</div> 
						</div>
					</div>
					<div id="tabImpuestos">
						<div class="tabla contenedor_tabla_impuestos" style="position: relative; margin-bottom: 35px;"  >		
							<h1 class="tituloTabla" >Impuestos</h1>
							<div class="toolbar_detalles" style="">
								<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
								<input type="button" value="" class="btnEliminar" id="botonEliminar" />
							</div>
							<table class="tabla_impuestos">
								<thead></thead>
								<tbody></tbody>
							</table>
							<div id="<?php echo $id; ?>-dialog-confirm-eliminar-impuesto_de_nomina" title="&iquest;Eliminar Impuesto_de_nomina?">
								<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Impuesto_de_nomina?</p>
							</div> 
						</div>
					</div>
				</div>
				
				
				
				<div class="datos_facturacion" style="display:inline-block; margin-left: 30px;">
					
					<div>
						<?php include dirname(__FILE__).'/_datos_facturacion.php'; ?>	
					</div>
					
				</div>
				
				<?php include dirname(__FILE__).'/_totales.php'; ?>	
				
				
				<div   style="display:none;"> 
					<div class="inputBox contenedor_fk_patron"  >
						<label style="">Patron:</label>
						<select name="fk_patron" class="entradaDatos" style="width:250px;">
							<?php
								foreach($this->fk_patron_listado as $empresa){
									echo '<option value="'.$empresa['id'].' " >'.$empresa['razon_social'].'</option>';
								}
							?>
						</select>
					</div>
					
					<div class="inputBox contenedor_Version" style=""  >
						<label style="">Version:</label>
						<input title="Version" type="text" name="Version" class="entradaDatos" value="<?php echo $this->datos['Version']; ?>" style="width:500px;" />
					</div>
					<div class="inputBox contenedor_RegistroPatronal" style=""  >
						<label style="">RegistroPatronal:</label>
						<input title="RegistroPatronal" type="text" name="RegistroPatronal" class="entradaDatos" value="<?php echo $this->datos['RegistroPatronal']; ?>" style="width:500px;" />
					</div>
				</div>
				
			</form>
			
			<div id="datos_empleado" title="Datos del empleado" style="width:800px; margin:10px 0 20px 100px;">
				<form>
					<?php include dirname(__FILE__).'/_datos_empleado.php'; ?>	
				</form>				
			</div>
			<div id="contenedorMenu2" class="toolbarEdicion">
				<input type="submit" value="Nuevo" class="botonNuevo btnNuevo">
				<input type="submit" value="Guardar" class="botonNuevo btnGuardar">
				<input type="submit" value="Timbrar" class="botonNuevo btnTimbrar">
				<input type="submit" value="PDF" class="botonNuevo btnPdf">
				<input type="submit" value="XML" class="botonNuevo btnXML">
				<input type="submit" value="ZIP" class="botonNuevo btnZip">
				<input type="submit" value="Cancelar" class="botonNuevo sinMargeDerecho btnCancelar">
			</div>
		</div>
	</div>
</div>