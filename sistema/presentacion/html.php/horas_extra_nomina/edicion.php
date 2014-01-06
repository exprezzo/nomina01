<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$fk_TipoHoras_listado=array();
			$fk_TipoHoras_listado[]=array('id'=>$this->datos['fk_TipoHoras'],'nombre'=>$this->datos['nombre_fk_TipoHoras'] );
			$this->fk_TipoHoras_listado = $fk_TipoHoras_listado;
		}else{
			$mod=new tipo_horaModelo();
			$objs=$mod->buscar( array() );		
			$this->fk_TipoHoras_listado = $objs['datos'];
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
		 var editor=new EdicionHoras_extra_nomina();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Hora Extra</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_Dias" style=""  >
					<label style="">Dias:</label>
					<input title="Dias" type="text" name="Dias" class="entradaDatos" value="<?php echo $this->datos['Dias']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_TipoHoras oculto" style=""  >
					<label style="">TipoHoras:</label>
					<input title="TipoHoras" type="text" name="TipoHoras" class="entradaDatos" value="<?php echo $this->datos['TipoHoras']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_fk_TipoHoras" style=""  >
					<label style="">Tipo Horas:</label>
					<select name="fk_TipoHoras" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->fk_TipoHoras_listado as $tipo_hora){
								echo '<option value="'.$tipo_hora['id'].' " >'.$tipo_hora['nombre'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="inputBox contenedor_HorasExtra" style=""  >
					<label style="">HorasExtra:</label>
					<input title="HorasExtra" type="text" name="HorasExtra" class="entradaDatos" value="<?php echo $this->datos['HorasExtra']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_ImportePagado" style=""  >
					<label style="">ImportePagado:</label>
					<input title="ImportePagado" type="text" name="ImportePagado" class="entradaDatos" value="<?php echo $this->datos['ImportePagado']; ?>" style="width:500px;" />
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