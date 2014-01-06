<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoDeduccion_listado=array();
			$fk_TipoDeduccion_listado[]=array('id'=>$this->datos['fk_TipoDeduccion'],'descripcion'=>$this->datos['descripcion_fk_TipoDeduccion'] );
			$this->fk_TipoDeduccion_listado = $fk_TipoDeduccion_listado;
		}else{
			$mod=new tipo_deduccionModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoDeduccion_listado = $objs['datos'];
		}
?>
<script src="<?php echo $_PETICION->url_web; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

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
		 var editor=new EdicionDeducciones_nomina();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Deducción</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_TipoDeduccion" style=""  >
					<label style="">Tipo Deduccion:</label>
					<select name="fk_TipoDeduccion" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoDeduccion_listado as $tipo_deduccion){
								echo '<option value="'.$tipo_deduccion['id'].' " >'.$tipo_deduccion['descripcion'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_TipoDeduccion oculto" style=""  >
					<label style="">TipoDeduccion:</label>
					<input title="TipoDeduccion" type="text" name="TipoDeduccion" class="entradaDatos" value="<?php echo $this->datos['TipoDeduccion']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_Clave" style=""  >
					<label style="">Clave:</label>
					<input title="Clave" type="text" name="Clave" class="entradaDatos" value="<?php echo $this->datos['Clave']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_Concepto" style=""  >
					<label style="">Concepto:</label>
					<input title="Concepto" type="text" name="Concepto" class="entradaDatos" value="<?php echo $this->datos['Concepto']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_ImporteGravado" style=""  >
					<label style="">ImporteGravado:</label>
					<input title="ImporteGravado" type="text" name="ImporteGravado" class="entradaDatos" value="<?php echo $this->datos['ImporteGravado']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_ImporteExcento" style=""  >
					<label style="">ImporteExcento:</label>
					<input title="ImporteExcento" type="text" name="ImporteExcento" class="entradaDatos" value="<?php echo $this->datos['ImporteExcento']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_nomina oculto" style=""  >
					<label style="">Fk_nomina:</label>
					<input title="Fk_nomina" type="text" name="fk_nomina" class="entradaDatos" value="<?php echo $this->datos['fk_nomina']; ?>" style="width:500px;" />
				</div>
			</form>
			<div id="contenedorMenu2" class="toolbarEdicion">
				<input type="submit" value="Nuevo" class="botonNuevo btnNuevo">
				<input type="submit" value="Guardar" class="botonNuevo btnGuardar">
				<input type="submit" value="Eliminar" class="botonNuevo sinMargeDerecho btnDelete">
			</div>
		</div>
	</div>
</div>