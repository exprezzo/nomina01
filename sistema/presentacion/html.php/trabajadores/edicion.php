<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
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
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoContrato_listado=array();
			$fk_TipoContrato_listado[]=array('id'=>$this->datos['fk_TipoContrato'],'nombre'=>$this->datos['nombre_fk_TipoContrato'] );
			$this->fk_TipoContrato_listado = $fk_TipoContrato_listado;
		}else{
			$mod=new tipo_de_contratoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoContrato_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_departamento_listado=array();
			$fk_departamento_listado[]=array('id'=>$this->datos['fk_departamento'],'nombre'=>$this->datos['nombre_fk_departamento'] );
			$this->fk_departamento_listado = $fk_departamento_listado;
		}else{
			$mod=new departamentoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_departamento_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoJornada_listado=array();
			$fk_TipoJornada_listado[]=array('id'=>$this->datos['fk_TipoJornada'],'nombre'=>$this->datos['nombre_fk_TipoJornada'] );
			$this->fk_TipoJornada_listado = $fk_TipoJornada_listado;
		}else{
			$mod=new jornadaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoJornada_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_PeriodicidadPago_listado=array();
			$fk_PeriodicidadPago_listado[]=array('id'=>$this->datos['fk_PeriodicidadPago'],'descripcion'=>$this->datos['descripcion_fk_PeriodicidadPago'] );
			$this->fk_PeriodicidadPago_listado = $fk_PeriodicidadPago_listado;
		}else{
			$mod=new periodo_pagoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_PeriodicidadPago_listado = $objs['datos'];
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
			
			$fk_banco_listado=array();
			$fk_banco_listado[]=array('id'=>$this->datos['fk_banco'],'nombre_corto'=>$this->datos['nombre_corto_fk_banco'] );
			$this->fk_banco_listado = $fk_banco_listado;
		}else{
			$mod=new bancoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_banco_listado = $objs['datos'];
		}
?>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

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
		 var editor=new EdicionTrabajadores();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Trabajador</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_nombre" style=""  >
					<label style="">Nombre:</label>
					<input title="Nombre" type="text" name="nombre" class="entradaDatos" value="<?php echo $this->datos['nombre']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_rfc" style=""  >
					<label style="">Rfc:</label>
					<input title="Rfc" type="text" name="rfc" class="entradaDatos" value="<?php echo $this->datos['rfc']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_email" style=""  >
					<label style="">Email:</label>
					<input title="Email" type="text" name="email" class="entradaDatos" value="<?php echo $this->datos['email']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_CURP" style=""  >
					<label style="">CURP:</label>
					<input title="CURP" type="text" name="CURP" class="entradaDatos" value="<?php echo $this->datos['CURP']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_TipoRegimen" style=""  >
					<label style="">Tipo Regimen:</label>
					<select name="fk_TipoRegimen" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoRegimen_listado as $regimen_contratacion){
								echo '<option value="'.$regimen_contratacion['id'].' " >'.$regimen_contratacion['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_NumSeguridadSocial" style=""  >
					<label style="">NumSeguridadSocial:</label>
					<input title="Numero de Seguridad Social" type="text" name="NumSeguridadSocial" class="entradaDatos" value="<?php echo $this->datos['NumSeguridadSocial']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_calle" style=""  >
					<label style="">Calle:</label>
					<input title="Calle" type="text" name="calle" class="entradaDatos" value="<?php echo $this->datos['calle']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_noExterior" style=""  >
					<label style="">NoExterior:</label>
					<input title="Numero Exterior" type="text" name="noExterior" class="entradaDatos" value="<?php echo $this->datos['noExterior']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_noInterior" style=""  >
					<label style="">NoInterior:</label>
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
					<label style="">Estado:</label>
					<select name="fk_estado" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_estado_listado as $estado){
								echo '<option value="'.$estado['id'].' " >'.$estado['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_municipio" style=""  >
					<label style="">Municipio:</label>
					<select name="fk_municipio" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_municipio_listado as $municipio){
								echo '<option value="'.$municipio['id'].' " >'.$municipio['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_codigoPostal" style=""  >
					<label style="">Codigo Postal:</label>
					<input title="Codigo Postal" type="text" name="codigoPostal" class="entradaDatos" value="<?php echo $this->datos['codigoPostal']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_NoEmpleado" style=""  >
					<label style="">No Empleado:</label>
					<input title="Numero De Empleado" type="text" name="NoEmpleado" class="entradaDatos" value="<?php echo $this->datos['NoEmpleado']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_SalarioDiarioIntegrado" style=""  >
					<label style="">Salario Diario Integrado:</label>
					<input title="Salario Diario Integrado" type="text" name="SalarioDiarioIntegrado" class="entradaDatos" value="<?php echo $this->datos['SalarioDiarioIntegrado']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_SalarioBaseCotApor" style=""  >
					<label style="">Salario Base Cot:</label>
					<input title="Salario Base " type="text" name="SalarioBaseCotApor" class="entradaDatos" value="<?php echo $this->datos['SalarioBaseCotApor']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_FechaInicioRelLaboral" style=""  >
					<label style="">Fecha Contratación:</label>
					<input title="Fecha De Inicio De La Relación Laboral" type="text" name="FechaInicioRelLaboral" class="entradaDatos" value="<?php echo $this->datos['FechaInicioRelLaboral']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_puesto" style=""  >
					<label style="">Puesto:</label>
					<input title="Puesto" type="text" name="puesto" class="entradaDatos" value="<?php echo $this->datos['puesto']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_TipoContrato" style=""  >
					<label style="">Tipo Contrato:</label>
					<select name="fk_TipoContrato" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoContrato_listado as $tipo_de_contrato){
								echo '<option value="'.$tipo_de_contrato['id'].' " >'.$tipo_de_contrato['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_departamento" style=""  >
					<label style="">Departamento:</label>
					<select name="fk_departamento" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_departamento_listado as $departamento){
								echo '<option value="'.$departamento['id'].' " >'.$departamento['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_TipoJornada" style=""  >
					<label style="">Tipo Jornada:</label>
					<select name="fk_TipoJornada" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoJornada_listado as $jornada){
								echo '<option value="'.$jornada['id'].' " >'.$jornada['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_PeriodicidadPago" style=""  >
					<label style="">Periodicidad Pago:</label>
					<select name="fk_PeriodicidadPago" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_PeriodicidadPago_listado as $periodo_pago){
								echo '<option value="'.$periodo_pago['id'].' " >'.$periodo_pago['descripcion'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_RiesgoPuesto" style=""  >
					<label style="">Riesgo Puesto:</label>
					<select name="fk_RiesgoPuesto" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_RiesgoPuesto_listado as $riesgo){
								echo '<option value="'.$riesgo['id'].' " >'.$riesgo['descripcion'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_banco" style=""  >
					<label style="">Banco:</label>
					<select name="fk_banco" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_banco_listado as $banco){
								echo '<option value="'.$banco['id'].' " >'.$banco['nombre_corto'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_CLABE" style=""  >
					<label style="">CLABE:</label>
					<input title="Clave interbancaria" type="text" name="CLABE" class="entradaDatos" value="<?php echo $this->datos['CLABE']; ?>" style="width:500px;" />
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