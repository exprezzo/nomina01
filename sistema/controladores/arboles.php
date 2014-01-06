<?php

require_once $_PETICION->basePath.'/modelos/arbol.php';
require_once $_PETICION->basePath.'/presentacion/html.php/arboles/arbol_pdf.php';

require_once '../php_libs/zebra_mptt/Zebra_Mptt.php';
class arboles extends Controlador{
	var $modelo="arbol";	
	
	function agregarNodo(){
		global $DB_CONFIG;
		$esNuevo = empty( $_POST['datos']['id'] );
		$exito = mysql_connect ( $DB_CONFIG['DB_SERVER'], $DB_CONFIG['DB_USER'], $DB_CONFIG['DB_PASS']);		
		if ( !$exito ){
			$res = array(
				'success'=>false,
				'msg'=>'No pudo conectarse a la bdd'
			);
			echo json_encode($res); exit;
		}
		
		$exito= mysql_select_db($DB_CONFIG['DB_NAME'], $exito);		
		if ( !$exito ){
			$res = array(
				'success'=>false,
				'msg'=>mysql_error()
			);
			echo json_encode($res); exit;
		}
		
		
		$mptt = new Zebra_Mptt();
		$parent=empty( $_POST['datos']['parent'] )? 0 : $_POST['datos']['parent'];
		$title = $_POST['datos']['title'];
		
		$exito=$mptt->add( $parent , $title );
		if ( !$exito ){
			$res = array(
				'success'=>false,
				'msg'=>mysql_error()
			);
			echo json_encode($res); exit;
		}else{
			$id = $exito;
		}
		
		$nodoMod=$this->getModelo();
		$nodo=$nodoMod->obtener( $id );
		
		$res=array('success'=>true);		
		$res['datos']=$nodo;
		$res['msg']=($esNuevo)? 'Nodo Creado': 'Nodo Almacenado';
		if ( $esNuevo ){					
			$res['esNuevo']=true;				
			sessionSet('res', $res);			
		}
		echo json_encode($res);
		return $res;
	}
		function buscarArbol(){
			$arbolMod= new arbolModelo();
			$res = $arbolMod->buscar( array() );
			echo json_encode( $res );
		}
		
	
	function bajarPdf(){
		//-------
		$mod= $this->getModelo();
		global $_PETICION;
		$id=$_PETICION->params[0];
		$datos= $mod->obtener( $id );
		//-------
		$objPdf = new ArbolPdf('P','mm','letter');
		$objPdf->datos=$datos;
		$objPdf->AddPage();
		$objPdf->imprimir(  );
		//-------
		$path='../';
		$nombreArchivo=$objPdf->titulo.'_'.$datos['id'];			
		//http://stackoverflow.com/questions/2021624/string-sanitizer-for-filename			
		$nombreArchivo = preg_replace('/[^a-zA-Z0-9-_\.]/','_', $nombreArchivo);
		$fullPath=$path.$nombreArchivo.'.pdf';
		$pdfStr=$objPdf->Output($fullPath, 'S');
		//-------
		header ("Content-Length: ".strlen($pdfStr)); 
		header ("Content-Disposition: attachment; filename=".$nombreArchivo.'.pdf');
		header ("Content-Type: application/octet-stream");
		echo $pdfStr;
	}
		
	function mostrarVista( $archivos=""){
		$vista= $this->getVista();
		
		global $_TEMA_APP;
		global $_PETICION;
		return $vista->mostrarTema($_PETICION, $_TEMA_APP);
	}
	
	function nuevo(){		
		$modelo = $this->getModelo();
		$obj=$modelo->nuevo( array() );
		
		$vista=$this->getVista();
		$vista->datos=$obj;		
		
		global $_TEMA_APP;
		global $_PETICION;
		$_PETICION->accion="edicion";
		return $vista->mostrarTema($_PETICION, $_TEMA_APP);
		
	
	}
	
	function guardar(){
		$modelo=$this->getModelo();
		$esNuevo = empty( $_POST['datos'][$modelo->pk] );
		
		global $DB_CONFIG;
		
		if ( $esNuevo){
			return $this->agregarNodo();
		}else{
			ob_start();
			$res = parent::guardar();
			ob_end_clean();
		}
		
		if ( !$res['success'] ){			
			echo json_encode($res);
			return $res;
		}
		
		if ( $esNuevo ){					
			$res['esNuevo']=true;				
			sessionSet('res', $res);			
		}
		echo json_encode($res);
		return $res;
	}
	function eliminar(){
		return parent::eliminar();
	}
	function editar(){
		global $_PETICION;
		// print_r($_PETICION);
		if ( isset($_PETICION->params[0]) )
		$_REQUEST['id'] = $_PETICION->params[0];
		
		// return parent::editar();
		$id=empty( $_REQUEST['id'])? 0 : $_REQUEST['id'];
		$model=$this->getModelo();
		$params=array(
			$model->pk=>$id
		);		
		
		$obj=$model->obtener( $id );			
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		global $_PETICION;
		global $_TEMA_APP;
		$_PETICION->accion="edicion";
		$vista->mostrarTema($_PETICION,$_TEMA_APP);
	}
	function buscar(){
		if ( $_SERVER['REQUEST_METHOD']=='POST'  ){
			return parent::buscar();			
		}else{
			global $_PETICION, $_TEMA_APP;
			$vista = $this->getVista();
			$_PETICION->accion='busqueda';
			return $vista->mostrarTema($_PETICION, $_TEMA_APP);
		}
	}
}
?>