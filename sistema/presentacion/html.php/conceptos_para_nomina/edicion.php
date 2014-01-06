<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_unidad_listado=array();
			$fk_unidad_listado[]=array('id'=>$this->datos['fk_unidad'],'abreviacion'=>$this->datos['abreviacion_fk_unidad'] );
			$this->fk_unidad_listado = $fk_unidad_listado;
		}else{
			$mod=new unidad_de_medidaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_unidad_listado = $objs['datos'];
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
		 var editor=new EdicionConceptos_para_nomina();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Concepto Para Nomina</h1>
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
				<div class="inputBox contenedor_descripcion" style=""  >
					<label style="">Descripcion:</label>
					<input title="Descripcion" type="text" name="descripcion" class="entradaDatos" value="<?php echo $this->datos['descripcion']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_precio" style=""  >
					<label style="">Precio:</label>
					<input title="Precio" type="text" name="precio" class="entradaDatos" value="<?php echo $this->datos['precio']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_unidad" style=""  >
					<label style="">UM:</label>
					<select name="fk_unidad" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_unidad_listado as $unidad_de_medida){
								echo '<option value="'.$unidad_de_medida['id'].' " >'.$unidad_de_medida['abreviacion'].'</option>';
							}
						?>
					</select>
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