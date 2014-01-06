<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoIncapacidad_listado=array();
			$fk_TipoIncapacidad_listado[]=array('id'=>$this->datos['fk_TipoIncapacidad'],'descripcion'=>$this->datos['descripcion_fk_TipoIncapacidad'] );
			$this->fk_TipoIncapacidad_listado = $fk_TipoIncapacidad_listado;
		}else{
			$mod=new tipo_incapacidadModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoIncapacidad_listado = $objs['datos'];
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
		 var editor=new EdicionIncapacidades();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Incapacidad</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_DiasIncapacidad" style=""  >
					<label style="">DiasIncapacidad:</label>
					<input title="DiasIncapacidad" type="text" name="DiasIncapacidad" class="entradaDatos" value="<?php echo $this->datos['DiasIncapacidad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_TipoIncapacidad" style=""  >
					<label style="">Tipo Incapacidad:</label>
					<select name="fk_TipoIncapacidad" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoIncapacidad_listado as $tipo_incapacidad){
								echo '<option value="'.$tipo_incapacidad['id'].' " >'.$tipo_incapacidad['descripcion'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_TipoIncapacidad oculto" style=""  >
					<label style="">TipoIncapacidad:</label>
					<input title="TipoIncapacidad" type="text" name="TipoIncapacidad" class="entradaDatos" value="<?php echo $this->datos['TipoIncapacidad']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_Descuento" style=""  >
					<label style="">Descuento:</label>
					<input title="Descuento" type="text" name="Descuento" class="entradaDatos" value="<?php echo $this->datos['Descuento']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_nomina" style=""  >
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