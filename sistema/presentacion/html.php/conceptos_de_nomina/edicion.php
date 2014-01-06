<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_um_listado=array();
			$fk_um_listado[]=array('id'=>$this->datos['fk_um'],'nombre'=>$this->datos['nombre_fk_um'] );
			$this->fk_um_listado = $fk_um_listado;
		}else{
			$mod=new unidad_de_medidaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_um_listado = $objs['datos'];
		}
if ( !empty( $this->datos['id'] ) ){
			
			$fk_concepto_listado=array();
			$fk_concepto_listado[]=array('id'=>$this->datos['fk_concepto'],'nombre'=>$this->datos['nombre_fk_concepto'] );
			$this->fk_concepto_listado = $fk_concepto_listado;
		}else{
			$mod=new concepto_para_nominaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_concepto_listado = $objs['datos'];
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
		 var editor=new EdicionConceptos_de_nomina();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Concepto De Nomina</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_cantidad" style=""  >
					<label style="">Cantidad:</label>
					<input title="Cantidad" type="text" name="cantidad" class="entradaDatos" value="<?php echo $this->datos['cantidad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_unidad" style=""  >
					<label style="">Unidad:</label>
					<input title="Unidad" type="text" name="unidad" class="entradaDatos" value="<?php echo $this->datos['unidad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_um" style=""  >
					<label style="">UM:</label>
					<select name="fk_um" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_um_listado as $unidad_de_medida){
								echo '<option value="'.$unidad_de_medida['id'].' " >'.$unidad_de_medida['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_fk_concepto" style=""  >
					<label style="">Concepto:</label>
					<select name="fk_concepto" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_concepto_listado as $concepto_para_nomina){
								echo '<option value="'.$concepto_para_nomina['id'].' " >'.$concepto_para_nomina['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_descripcion" style=""  >
					<label style="">Descripcion:</label>
					<input title="Descripcion" type="text" name="descripcion" class="entradaDatos" value="<?php echo $this->datos['descripcion']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_valorUnitario" style=""  >
					<label style="">ValorUnitario:</label>
					<input title="ValorUnitario" type="text" name="valorUnitario" class="entradaDatos" value="<?php echo $this->datos['valorUnitario']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_importe" style=""  >
					<label style="">Importe:</label>
					<input title="Importe" type="text" name="importe" class="entradaDatos" value="<?php echo $this->datos['importe']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_noIdentificacion oculto" style=""  >
					<label style="">NoIdentificacion:</label>
					<input title="NoIdentificacion" type="text" name="noIdentificacion" class="entradaDatos" value="<?php echo $this->datos['noIdentificacion']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_nomina oculto" style=""  >
					<label style="">Fk_nomina:</label>
					<input title="Fk_nomina" type="text" name="fk_nomina" class="entradaDatos" value="<?php echo $this->datos['fk_nomina']; ?>" style="width:500px;" />
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