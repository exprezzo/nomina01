<?php

require_once $_PETICION->basePath.'/modelos/nomina.php';
require_once $_PETICION->basePath.'/presentacion/html.php/nominas/nomina_pdf.php';

require_once $_PETICION->basePath.'/modelos/empresa.php';

require_once $_PETICION->basePath.'/modelos/trabajador.php';

require_once $_PETICION->basePath.'/modelos/serie_nomina.php';

require_once $_PETICION->basePath.'/modelos/regimen_contratacion.php';

require_once $_PETICION->basePath.'/modelos/departamento.php';

require_once $_PETICION->basePath.'/modelos/regimen_contratacion.php';

require_once $_PETICION->basePath.'/modelos/jornada.php';

require_once $_PETICION->basePath.'/modelos/periodo_pago.php';

require_once $_PETICION->basePath.'/modelos/banco.php';

require_once $_PETICION->basePath.'/modelos/riesgo.php';

require_once $_PETICION->basePath.'/modelos/percepcion_nomina.php';

require_once $_PETICION->basePath.'/modelos/deduccion_nomina.php';

require_once $_PETICION->basePath.'/modelos/incapacidad.php';

require_once $_PETICION->basePath.'/modelos/hora_extra_nomina.php';

require_once $_PETICION->basePath.'/modelos/forma_de_pago.php';

require_once $_PETICION->basePath.'/modelos/certificado.php';

require_once $_PETICION->basePath.'/modelos/moneda.php';

require_once $_PETICION->basePath.'/modelos/metodo_de_pago.php';
require_once $_PETICION->basePath.'/modelos/tipo_de_contrato.php';

require_once $_PETICION->basePath.'/modelos/concepto_de_nomina.php';

require_once $_PETICION->basePath.'/modelos/impuesto_de_nomina.php';
require_once $_PETICION->basePath.'/nomina_xml.php';
require_once $_PETICION->basePath.'/modelos/regimen.php';
@require_once "../php_libs/nusoap/lib/nusoap.php";

class nominas extends Controlador{
	var $modelo="nomina";	
	private function timbrarXML( $xml ){
		$modoPrueba = $this->modoPrueba;
		// echo $modoPrueba;
		$client = new nusoap_client("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl", true);
		$error = $client->getError();
		if ($error) {
			return array(
				'success'=>false,
				'msg'=>$error,
			);			
		}
		
		global $APP_CONFIG;
		$Usuario=$APP_CONFIG['cfdi_user'];
		$pass=$APP_CONFIG['cfdi_pass'];
		
		// $handle = fopen ($filename,'r+');
		// $contents = fread($handle, filesize($filename));
		$contents = base64_encode($xml);
		
		if ($this->modoPrueba){
			$result = @$client->call("getCfdiTest", array('user'=>$Usuario,'password'=>$pass, 'file'=>$contents ) );
		}else{
			$mod=$this->getModelo();
			$res=$mod->getTimbresDisponibles();
			if ( !$res['success'] ){
				return $res;
			}
			if ( empty($res['disponibles']) ){
				$res=array(
					'success'=>false,
					'msg'=>'Sus timbres se han agotado, solicite un nuevo paquete con su proveedor'
				);
				return $res;
			}
			
			$result = @$client->call("getCfdi", array('user'=>$Usuario,'password'=>$pass, 'file'=>$contents ) );
		}
		
		
		if ( $result == false && !empty($client->error_str ) ){
			$result['success']=false;
			$result['msg']=$client->error_str;
		}
		
		if ( !empty($result['faultcode']) ){
			$result['success']=false;
						
			// switch($result['detail']['fault']['cod']){
				// case '301':					
					// $result['detail']['fault']['text'] =utf8_encode('El comprobante no cumple con el estándar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).');
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '302':					
					// $result['detail']['fault']['text'] = 'El sello del emisor no es válido..';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '303':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '304':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '305':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '306':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '307':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '308':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '401':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '402':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;
				// case '403':					
					// $result['detail']['fault']['text'] = 'El comprobante no cumple con el estandar XML (Conforme al W3C) o con la estructura XML (XSD ycomplementos aplicables).';
					// $result['detail']['fault']['text'].=' '.$result['faultstring'];
				// break;				
			// }
			
			$result['detail']['fault']['text'] =utf8_encode( $result['detail']['fault']['text'] );
			
			if ( empty( $result['detail']['fault']['text'] ) ) $result['msg'] = 'Error al timbrar';
			
			
			$result['msg']=$result['detail']['fault']['text'];
			error_log( $result['msg'] );
		}
		
		$result['zip64']='';
		if ($this->modoPrueba){
			if ( !empty($result['getCfdiTestReturn']) ){
				$result['success']=true;
				$result['msg']="Timbrado en modo Prueba";	
				$result['zip64']=$result['getCfdiTestReturn'];
			}
		}else{
			$mod->consumirTimbre();
			if ( !empty($result['getCfdiReturn']) ){
				$result['success']=true;
				$result['msg']="Timbre Correcto";			
				$result['zip64']=$result['getCfdiReturn'];
			}
		}

		return array(
			'success'=>$result['success'],
			'msg'	 =>$result['msg'],
			'zip64'	 =>$result['zip64']
		);
	}
	function extraerXML($zipname, $ruta_destino, $nombreArchivo ){
		$zip = new ZipArchive;		
		if($zip->open($zipname)){			 
			for($i=0; $i<$zip->numFiles; $i++){			 
			 $Filename=$zip->getNameIndex($i);			 
			  $res = $zip->renameName($Filename, $nombreArchivo.'.xml');			 			  
			 break;
		   }
		   
		    $zip->close();
			$zip->open($zipname);
			
		   if($zip->extractTo($ruta_destino)){ 
				$msg= 'FILE EXTRACTED'; 
				$success=true;
			}else{ 
				$msg= 'ERROR IN FILE ECTRACTING!'; 
				$success=false;
			}
			
		   // $zip->addFile($ruta_destino.$nombreArchivo.'.pdf', $nombreArchivo.'.pdf');
		  
		} 
		else 
		{
		  $msg= 'ERROR IN FILE ECTRACTING!'; 
			$success=false;
		}
		
		
		
		return array('success'=>$success, 'msg'=>$msg);
	}
	function nominas(){
		// $DB_CONFIG = sessionGet('DB_CONFIG');
		// $this->modoPrueba = empty($DB_CONFIG['modo_prueba'])?  false : true;
		$this->modoPrueba=true;
	}
	function timbrar(){
		if ( empty($_POST['datos']) ||  empty($_POST['datos']['id']) ){
			$res = array(
				'success'=>false,
				'msg'	 =>'Proporcione la nomina a timbrar'
			);
			echo json_encode( $res ); return $res;
		}
		$id= $_POST['datos']['id'];
		
		$params=array(
			'id'=>$_POST['datos']['id']
		);
		
		
		$mod = $this->getModelo();
		$obj = $mod->obtener( $_POST['datos']['id'] );

		if ( !empty($obj['folio_fiscal']) && empty($obj['modo_prueba']) ){
			$res=array(
				'success'=>false,
				'msg'=>utf8_encode('La nomina ya está timbrada')
			);
			echo json_encode($res);
			return $res;
		}
		
		
		$resRNA=$mod->getRutayNombreDeArchivo($obj);
		
		$pathname=$resRNA['ruta'];
		$nombreArchivo=$resRNA['nombre'];
		
		$filename =$pathname.$nombreArchivo;			
		$xml = file_get_contents($filename.'.xml');		
		$resTimbrado = $this->timbrarXML( $xml );
		
		// print_r($resTimbrado);
		if (!$resTimbrado['success']){			
			echo json_encode( $resTimbrado ); return $resTimbrado;
		}
	
		//guarda el xml
			//lo incluye al zip
			//genera pdf
			//lo incluye al zip
			//guarda en la tabla 
			// todo OK
		$filename =$pathname.$nombreArchivo.'.zip';						 
		
		@unlink($filename);
		
		// echo $filename;
		$handle=fopen($filename ,'c');
		fwrite ( $handle , base64_decode($resTimbrado['zip64']) );
		fclose ( $handle );
		
		$this->extraerXML($filename, $pathname, $nombreArchivo );
		
		//abre el xml timbrado para obtener los datos de timbrado
		
		$string = file_get_contents($pathname.$nombreArchivo.'.xml');
		$xml = new SimpleXMLElement($string);		
		$xml->registerXPathNamespace('tfd', 'http://www.sat.gob.mx/TimbreFiscalDigital');		
		$nodo = $xml->xpath('//tfd:TimbreFiscalDigital');		
		$nomina=array();
		$nomina['id'] = $obj['id'];		
		foreach($nodo[0]->attributes() as $key=>$val ){			
			switch($key){
				case 'UUID':
					$nomina['folio_fiscal'] = $val;
				break;
				case 'FechaTimbrado':
					// echo $val;
					$val = str_replace ('T',' ',$val);
					$ft= DateTime::createFromFormat ( 'Y-m-d H:i:s' , $val);
					$nomina['FechaTimbrado'] = $ft->format('Y-m-d H:i:s');
				break;
				case 'noCertificadoSAT':
					$nomina['noCertificadoSAT'] = $val;
				break;
				case 'selloSAT':
					 $nomina['selloSAT'] = $val;										
					 $selloSAT =$val;
				break;
				case 'selloCFD':
					 $nomina['selloCFD'] = $val;					
					 // echo $val;
					 $selloCFD =$val;
				break;
				case 'version':
					 $nomina['versionTimbre'] = $val;					
					 $version =$val;
				break;			
			}
		}
		
		$cadenaCFDI = '||'.$version.'|'.$nomina['folio_fiscal'].'|'.$nomina['FechaTimbrado'].'|'.$selloCFD.'|'.$nomina['noCertificadoSAT'].'||';		
		$nomina['cadenaCFDI'] = $cadenaCFDI;
		//======================================================================================================
		$modelo = $this->getModelo();
		
		// $FechaFolioFiscalOrig=$nomina['FechaFolioFiscalOrig'];
		// unset($nomina['FechaFolioFiscalOrig']);
		$nomina['modo_prueba'] = empty($this->modoPrueba)? 0 : 1;		
		// print_r($nomina);
		$res = $modelo->guardar($nomina);
		
		if ( !$res['success'] ){
			echo json_encode($res); return $res;
		}
		$res['msg'] = empty($this->modoPrueba)? "Nomina Timbrada" : "Nomina Timbrada en modo de prueba";
		//======================================================================================================		
		// $mod->generarPdf($pathname, $nombreArchivo, $nomina, $res['datos']['conceptos'], $res['datos']['impuestos']);
		// ==================================================================================================================================	
		
		$res['datos']['folio_fiscal']=$nomina['folio_fiscal'];
		$res['datos']['FechaTimbrado']=$nomina['FechaTimbrado'];
		$res['datos']['noCertificadoSAT']=$nomina['noCertificadoSAT'];
		$res['datos']['cadenaCFDI'] = $nomina['cadenaCFDI'];
		
		$res['datos']['selloCFD'] =$nomina['selloCFD'];
		$res['datos']['selloSAT'] =$nomina['selloSAT'];
		
		// if ( $nomina['fk_forma_pago']==2 && !empty($nomina['FolioFiscalOrig']) ){			
			// $resSaldo=$modelo->actualizarSaldo( $nomina );
			// if ( !$resSaldo['success'] ){
				// $res['msg'].='<br />'.' El saldo NO pudo actualizarse, consulte a soporte tecnico<br />'.$resSaldo['msg'];
				// $res['msgType']='warning';
			// }
		// }
		
		
		echo json_encode( $res ); exit;
		
	}
	function generarArchivos(){
		
		if ( empty($_POST['id'])  ){
			$res = array(
				'success'=>false,
				'msg'	 =>'Proporcione la Nomina a generar'
			);
			echo json_encode( $res ); return $res;
		}
		
		$esNuevo = ( $_POST['esNuevo']=='false' ) ? false : true;
		$nomina_id= $_POST['id'];

		$mod = $this->getModelo();
		$res = $obj = $mod->generarArchivos( $nomina_id );
		if ($res['success']){
			unset($res['datos']);
			$res['msg']='Archivos Generados';
			
			$nomina=array();
			$nomina['id'] = $nomina_id;			
			$nomina['archivosGenerados']=1;
			$mod->guardar($nomina);
			
		}
		if ( $esNuevo ){					
			// $res['esNuevo']=true;				
			// $_SESSION['res']=$res;
			sessionSet('res', $res);
		}
		
		unset($res['xml']);
		echo json_encode( $res );
		return $res;
	}	
		function buscarEmpresa(){
			$empresaMod= new empresaModelo();
			$res = $empresaMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarTrabajador(){
			$trabajadorMod= new trabajadorModelo();
			$res = $trabajadorMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarSerie_nomina(){
			$serie_nominaMod= new serie_nominaModelo();
			$res = $serie_nominaMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarRegimen_contratacion(){
			$regimen_contratacionMod= new regimen_contratacionModelo();
			$res = $regimen_contratacionMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarTipoContrato(){
			$tipo_de_contratoMod= new tipo_de_contratoModelo();
			$res = $tipo_de_contratoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarDepartamento(){
			$departamentoMod= new departamentoModelo();
			$res = $departamentoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarJornada(){
			$jornadaMod= new jornadaModelo();
			$res = $jornadaMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarPeriodo_pago(){
			$periodo_pagoMod= new periodo_pagoModelo();
			$res = $periodo_pagoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarBanco(){
			$bancoMod= new bancoModelo();
			$res = $bancoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarRiesgo(){
			$riesgoMod= new riesgoModelo();
			$res = $riesgoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarForma_de_pago(){
			$forma_de_pagoMod= new forma_de_pagoModelo();
			$res = $forma_de_pagoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarCertificado(){
			$certificadoMod= new certificadoModelo();
			$res = $certificadoMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarMoneda(){
			$monedaMod= new monedaModelo();
			$res = $monedaMod->buscar( array() );
			echo json_encode( $res );
		}
		
		function buscarMetodo_de_pago(){
			$metodo_de_pagoMod= new metodo_de_pagoModelo();
			$res = $metodo_de_pagoMod->buscar( array() );
			echo json_encode( $res );
		}
		
	
	function bajarPdf(){
		//-------
		$mod= $this->getModelo();
		global $_PETICION;
		$id=$_PETICION->params[0];
		$datos= $mod->obtener( $id );
		//-------
		$objPdf = new NominaPdf('P','mm','letter');
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
		
		function formatJsToMysql($fechaJs){
			$fecha = date_create_from_format('d/m/Y', $fechaJs);
			return $fecha->format('Y-m-d H:i:s');
		}
		 $_POST['datos']['FechaPago'] = formatJsToMysql($_POST['datos']['FechaPago']);
		 $_POST['datos']['FechaInicialPago'] = formatJsToMysql($_POST['datos']['FechaInicialPago']);
		 $_POST['datos']['FechaFinalPago'] = formatJsToMysql($_POST['datos']['FechaFinalPago']);
		 $_POST['datos']['FechaInicioRelLaboral'] = formatJsToMysql($_POST['datos']['FechaInicioRelLaboral']);
		 $_POST['datos']['fecha_emision'] = formatJsToMysql($_POST['datos']['fecha_emision']);
		
		
		
		
		// print_r( $_POST ); exit;
		
		ob_start();
		$res = parent::guardar();
		ob_end_clean();
		
		if ( !$res['success'] ){			
			echo json_encode($res);
			return $res;
		}
		
		$res['esNuevo']=$esNuevo;	
		if ( $esNuevo ){					
						
			sessionSet('res', $res);			
		}
		
		// $nomXml = new nominaXml();
		// $resN = $nomXml->generarNomina( $res['datos'] );
		
		// if ( !$resN['success']){
			// $resN['msg']='errores en el XML';
			// echo json_encode($resN);
		// }else{
			// echo json_encode($res);
		// }
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