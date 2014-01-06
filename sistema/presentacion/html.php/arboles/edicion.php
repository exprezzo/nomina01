<?php
	$id=$_PETICION->controlador.'-'.$_PETICION->accion;
	$_REQUEST['tabId'] =$id;
	
	
if ( !empty( $this->datos['id'] ) ){
			
			$parent_listado=array();
			$parent_listado[]=array('id'=>$this->datos['parent'],'title'=>$this->datos['title_parent'] );
			$this->parent_listado = $parent_listado;
		}else{
			$mod=new arbolModelo();
			$objs=$mod->buscar( array() );		
			$this->parent_listado = $objs['datos'];
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
		 var editor=new EdicionArboles();
		 editor.init(config);	
		//-----
		
	});
</script>
<style>

</style>
<div class="contenedor_formulario" id="<?php echo $id; ?>">
	<div id="titulo">
    	<h1>Nuevo Nodo</h1>
	</div>
	<div id="cuerpo">
		<div id="contenedorDatos2">
			<form class="frmEdicion" style="">
				
				<div class="inputBox contenedor_id" style=""  >
					<label style="">Id:</label>
					<input title="Id" type="text" name="id" class="entradaDatos" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_title" style=""  >
					<label style="">Title:</label>
					<input title="Title" type="text" name="title" class="entradaDatos" value="<?php echo $this->datos['title']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_lft" style=""  >
					<label style="">Lft:</label>
					<input title="Lft" type="text" name="lft" class="entradaDatos" value="<?php echo $this->datos['lft']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_rgt" style=""  >
					<label style="">Rgt:</label>
					<input title="Rgt" type="text" name="rgt" class="entradaDatos" value="<?php echo $this->datos['rgt']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox contenedor_parent" style=""  >
					<label style="">Parent:</label>
					<select name="parent" class="entradaDatos" style="width:250px;">
						<?php
							foreach($this->parent_listado as $arbol){
								echo '<option value="'.$arbol['id'].' " >'.$arbol['title'].'</option>';
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