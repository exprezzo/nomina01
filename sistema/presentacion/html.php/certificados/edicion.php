<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_razon_social_listado=array();
			$fk_razon_social_listado[]=array('id'=>$this->datos['fk_razon_social'],'nombre_comercial'=>$this->datos['nombre_comercial_fk_razon_social'] );
			$this->fk_razon_social_listado = $fk_razon_social_listado;
		}else{
			$mod=new empresaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_razon_social_listado = $objs['datos'];
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
		 var editor=new EdicionCertificados();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Certificado</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_razon_social" style=""  >
					<label style="">Razon Social:</label>
					<select name="fk_razon_social" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_razon_social_listado as $empresa){
								echo '<option value="'.$empresa['id'].' " >'.$empresa['nombre_comercial'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_no_serie" style=""  >
					<label style="">No Serie:</label>
					<input title="Numero de  Serie" type="text" name="no_serie" class="entradaDatos" value="<?php echo $this->datos['no_serie']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_cer_pem oculto" style=""  >
					<label style="">Cer_pem:</label>
					<input title="Cer_pem" type="text" name="cer_pem" class="entradaDatos" value="<?php echo $this->datos['cer_pem']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_key_pem oculto" style=""  >
					<label style="">Key_pem:</label>
					<input title="Key_pem" type="text" name="key_pem" class="entradaDatos" value="<?php echo $this->datos['key_pem']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_pass" style=""  >
					<label style="">Pass:</label>
					<input title="Pass" type="text" name="pass" class="entradaDatos" value="<?php echo $this->datos['pass']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_valido_desde" style=""  >
					<label style="">Valido Desde:</label>
					<input title="Valido Desde" type="text" name="valido_desde" class="entradaDatos" value="<?php echo $this->datos['valido_desde']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_valido_hasta" style=""  >
					<label style="">Valido Hasta:</label>
					<input title="Valido Hasta" type="text" name="valido_hasta" class="entradaDatos" value="<?php echo $this->datos['valido_hasta']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_es_default" style=""  >
					<label style="">Es Default:</label>
					<input title="Es Default" type="text" name="es_default" class="entradaDatos" value="<?php echo $this->datos['es_default']; ?>" style="width:500px;" />
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