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
		 var editor=new EdicionSeries_nomina();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nueva Serie Para Nomina</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id oculto" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_serie" style=""  >
					<label style="">Serie:</label>
					<input title="Serie" type="text" name="serie" class="entradaDatos" value="<?php echo $this->datos['serie']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_sig_folio" style=""  >
					<label style="">Folio Sig:</label>
					<input title="Este es el folio a ser usado en el proximo documento" type="text" name="sig_folio" class="entradaDatos" value="<?php echo $this->datos['sig_folio']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_es_default" style=""  >
					<label style="">Es Default:</label>
					<input title="Serie predeterminada al crear un nuevo documento" type="text" name="es_default" class="entradaDatos" value="<?php echo $this->datos['es_default']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_documento oculto" style=""  >
					<label style="">Documento:</label>
					<input title="Documento" type="text" name="documento" class="entradaDatos" value="<?php echo $this->datos['documento']; ?>" style="width:500px;" />
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
			</form>
			<div id="contenedorMenu2" class="toolbarEdicion">
				<input type="submit" value="Nuevo" class="botonNuevo btnNuevo">
				<input type="submit" value="Guardar" class="botonNuevo btnGuardar">
				<input type="submit" value="Eliminar" class="botonNuevo sinMargeDerecho btnDelete">
			</div>
		</div>
	</div>
</div>