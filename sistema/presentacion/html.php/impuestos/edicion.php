<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_naturaleza_listado=array();
			$fk_naturaleza_listado[]=array('id'=>$this->datos['fk_naturaleza'],'nombre'=>$this->datos['nombre_fk_naturaleza'] );
			$this->fk_naturaleza_listado = $fk_naturaleza_listado;
		}else{
			$mod=new tipo_de_impuestoModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_naturaleza_listado = $objs['datos'];
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
		 var editor=new EdicionImpuestos();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Impuesto</h1>
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
				<div class="inputBox contenedor_tasa" style=""  >
					<label style="">Tasa:</label>
					<input title="Tasa" type="text" name="tasa" class="entradaDatos" value="<?php echo $this->datos['tasa']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_naturaleza" style=""  >
					<label style="">Naturaleza:</label>
					<select name="fk_naturaleza" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_naturaleza_listado as $tipo_de_impuesto){
								echo '<option value="'.$tipo_de_impuesto['id'].' " >'.$tipo_de_impuesto['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_detalles" style=""  >
					<label style="">Detalles:</label>
					<input title="Detalles" type="text" name="detalles" class="entradaDatos" value="<?php echo $this->datos['detalles']; ?>" style="width:500px;" />
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