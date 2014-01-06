<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_pais_listado=array();
			$fk_pais_listado[]=array('id'=>$this->datos['fk_pais'],'nombre'=>$this->datos['nombre_fk_pais'] );
			$this->fk_pais_listado = $fk_pais_listado;
		}else{
			$mod=new paisModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_pais_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_estado_listado=array();
			$fk_estado_listado[]=array('id'=>$this->datos['fk_estado'],'nombre'=>$this->datos['nombre_fk_estado'] );
			$this->fk_estado_listado = $fk_estado_listado;
		}else{
			$mod=new estadoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_estado_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_municipio_listado=array();
			$fk_municipio_listado[]=array('id'=>$this->datos['fk_municipio'],'nombre'=>$this->datos['nombre_fk_municipio'] );
			$this->fk_municipio_listado = $fk_municipio_listado;
		}else{
			$mod=new municipioModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_municipio_listado = $objs['datos'];
		}
?>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/regimen_fiscal_de_empresa.js"></script>
<script>			
	$( function(){	
		
		//---------------------
		<?php
		$resAnt = empty($_SESSION['res']) ? array() : $_SESSION['res'];
		unset($_SESSION['res']);
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
		 var editor=new EdicionEmpresas();
		 editor.init(config);	
		//-----
		
		var tabId='#'+config.tab.id;
		configDet={
			padre:editor,
			tabId:'#<?php echo $_REQUEST['tabId']; ?>',
			elementos: <?php echo json_encode($this->datos['regimen_fiscalDeEmpresa']); ?>,
			target:'.tabla_Regimen_Fiscal',
			contenedor:'.contenedor_tabla_Regimen_Fiscal',
		};

		var regimen_fiscalDeEmpresa = new Regimen_fiscalDeEmpresa();		
		regimen_fiscalDeEmpresa.init(configDet);
				
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Empresa</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_rfc" style=""  >
					<label style="">Rfc:</label>
					<input title="Rfc" type="text" name="rfc" class="entradaDatos" value="<?php echo $this->datos['rfc']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_razon_social" style=""  >
					<label style="">Razon Social:</label>
					<input title="Razon Social" type="text" name="razon_social" class="entradaDatos" value="<?php echo $this->datos['razon_social']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_nombre_comercial" style=""  >
					<label style="">Nombre Comercial:</label>
					<input title="Nombre Comercial" type="text" name="nombre_comercial" class="entradaDatos" value="<?php echo $this->datos['nombre_comercial']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_datos_de_contacto" style=""  >
					<label style="">Datos de Contacto:</label>
					<input title="Datos de Contacto" type="text" name="datos_de_contacto" class="entradaDatos" value="<?php echo $this->datos['datos_de_contacto']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_logo_factura" style=""  >
					<label style="">Logotipo:</label>
					<input title="Logotipo" type="text" name="logo_factura" class="entradaDatos" value="<?php echo $this->datos['logo_factura']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_pais" style=""  >
					<label style="">Pais:</label>
					<select name="fk_pais" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_pais_listado as $pais){
								echo '<option value="'.$pais['id'].' " >'.$pais['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_estado" style=""  >
					<label style="">Fk_estado:</label>
					<select name="fk_estado" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_estado_listado as $estado){
								echo '<option value="'.$estado['id'].' " >'.$estado['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_ciudad oculto" style=""  >
					<label style="">Fk_ciudad:</label>
					<input title="Fk_ciudad" type="text" name="fk_ciudad" class="entradaDatos" value="<?php echo $this->datos['fk_ciudad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_municipio" style=""  >
					<label style="">Fk_municipio:</label>
					<select name="fk_municipio" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_municipio_listado as $municipio){
								echo '<option value="'.$municipio['id'].' " >'.$municipio['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_calle" style=""  >
					<label style="">Calle:</label>
					<input title="Calle" type="text" name="calle" class="entradaDatos" value="<?php echo $this->datos['calle']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_noExterior" style=""  >
					<label style="">No Exterior:</label>
					<input title="Numero Exterior" type="text" name="noExterior" class="entradaDatos" value="<?php echo $this->datos['noExterior']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_noInterior" style=""  >
					<label style="">No Interior:</label>
					<input title="Numero Interior" type="text" name="noInterior" class="entradaDatos" value="<?php echo $this->datos['noInterior']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_colonia" style=""  >
					<label style="">Colonia:</label>
					<input title="Colonia" type="text" name="colonia" class="entradaDatos" value="<?php echo $this->datos['colonia']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_localidad" style=""  >
					<label style="">Localidad:</label>
					<input title="Localidad" type="text" name="localidad" class="entradaDatos" value="<?php echo $this->datos['localidad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_referencia" style=""  >
					<label style="">Referencia:</label>
					<input title="Referencia" type="text" name="referencia" class="entradaDatos" value="<?php echo $this->datos['referencia']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_codigoPostal" style=""  >
					<label style="">Codigo Postal:</label>
					<input title="Codigo Postal" type="text" name="codigoPostal" class="entradaDatos" value="<?php echo $this->datos['codigoPostal']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_email_bcc" style=""  >
					<label style="">Email:</label>
					<input title="Email" type="text" name="email_bcc" class="entradaDatos" value="<?php echo $this->datos['email_bcc']; ?>" style="width:500px;" />
				</div>
				<div class="tabla contenedor_tabla_Regimen_Fiscal" style="position: relative; margin-top: 26px;"  >
					
					<h1 style="display: inline-block; margin-bottom: 6px;">Regimen Fiscal</h1>
					<div class="toolbar_detalles" style="position: absolute; right: 0; top: -2PX;">
						<input type="button" value="" class="btnAgregar" id="botonAgregar"/>
						<input type="button" value="" class="btnEliminar" id="botonEliminar" />
					</div>
					<table class="tabla_Regimen_Fiscal">
						<thead></thead>
						<tbody></tbody>
					</table>
					<div id="<?php echo $id; ?>-dialog-confirm-eliminar-regimen" title="&iquest;Eliminar Regimen?">
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>&iquest;Eliminar Regimen?</p>
					</div> 
				</div>
				<div class="inputBox contenedor_RegistroPatronal" style=""  >
					<label style="">Registro Patronal:</label>
					<input title="Registro Patronal" type="text" name="RegistroPatronal" class="entradaDatos" value="<?php echo $this->datos['RegistroPatronal']; ?>" style="width:500px;" />
				</div>
			</form>
			<div id="contenedorMenu2" class="toolbarEdicion">
				<input type="submit" value="Nuevo" class="botonNuevo btnNuevo">
				<input type="submit" value="Guardar" class="botonNuevo btnGuardar">
				<input type="submit" value="PDF" class="botonNuevo btnPdf">
				<input type="submit" value="Eliminar" class="botonNuevo sinMargeDerecho btnDelete">
			</div>
		</div>
	</div>
</div>