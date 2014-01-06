<?php
class NominaXml{	

	function horas_extras(&$nodoNomina, $xml, $arr){
		if ( empty($arr['horas_extraDeNomina']) ) return;
		$horas_extras = $xml->createElement("nomina:HorasExtras");
		$horas_extras = $nodoNomina->appendChild($horas_extras);
		
		foreach($arr['horas_extraDeNomina'] as $value){
			$horaExtra = $xml->createElement("nomina:HorasExtra");
			$horaExtra = $horas_extras->appendChild($horaExtra);
			
			// $cantidad = $importe * ($value['tasa']/100);
			$this->_cargaAtt($horaExtra, array(
				'Dias'=>$value['Dias'],									  
				'TipoHoras'=>$value['TipoHoras'],
				'HorasExtra'=>$value['HorasExtra'],
				'ImportePagado'=>$value['ImportePagado']							
				)
			);
		}
	}
	function incapacidades(&$nodoNomina, $xml, $arr){
		if ( empty($arr['incapacidadesDeNomina']) ) return;
		
		$incapacidades = $xml->createElement("nomina:Incapacidades");
		$incapacidades = $nodoNomina->appendChild($incapacidades);
		
		foreach($arr['incapacidadesDeNomina'] as $value){
			$incapacidad = $xml->createElement("nomina:Incapacidad");
			$incapacidad = $incapacidades->appendChild($incapacidad);
			
			// $cantidad = $importe * ($value['tasa']/100);
			$this->_cargaAtt($incapacidad, array(
				'DiasIncapacidad'=>$value['DiasIncapacidad'],									  
				'TipoIncapacidad'=>$value['TipoIncapacidad'],
				'Descuento'=>$value['Descuento']				
				)
			);
		}
	}
	function ingresos(&$nodoNomina, $xml, $arr){
		if ( empty($arr['percepcionesDeNomina']) ) return;
		
		$ingresos = $xml->createElement("nomina:Percepciones");
		$ingresos = $nodoNomina->appendChild($ingresos);
		$ingresos->SetAttribute("TotalGravado", $arr['percepcionesTotalGravado'] );
		$ingresos->SetAttribute("TotalExento", $arr['percepcionesTotalExcento'] );
		// print_r($arr);
		foreach($arr['percepcionesDeNomina'] as $value){
			$ingreso = $xml->createElement("nomina:Percepcion");
			$ingreso = $ingresos->appendChild($ingreso);
			
			// $cantidad = $importe * ($value['tasa']/100);
			$this->_cargaAtt($ingreso, array(
				'TipoPercepcion'=>$value['TipoPercepcion'],									  
				'Clave'=>$value['Clave'],
				'Concepto'=>$value['Concepto'],
				'ImporteGravado'=>$value['ImporteGravado'],
				'ImporteExento'=>$value['ImporteExcento']
				)
			);
		}
	}
	
	function deducciones(&$nodoNomina, $xml, $arr){
		if ( empty($arr['deduccionesDeNomina']) ) return;
		
		$deducciones = $xml->createElement("nomina:Deducciones");
		$deducciones = $nodoNomina->appendChild($deducciones);
		$deducciones->SetAttribute("TotalGravado", $arr['deduccionesTotalGravado'] );
		$deducciones->SetAttribute("TotalExento", $arr['deduccionesTotalExcento'] );
		// print_r($arr);
		foreach($arr['deduccionesDeNomina'] as $value){
			$ingreso = $xml->createElement("nomina:Deduccion");
			$ingreso = $deducciones->appendChild($ingreso);
			
			// $cantidad = $importe * ($value['tasa']/100);
			$this->_cargaAtt($ingreso, array(
				'TipoDeduccion'=>$value['TipoDeduccion'],									  
				'Clave'=>$value['Clave'],
				'Concepto'=>$value['Concepto'],
				'ImporteGravado'=>$value['ImporteGravado'],
				'ImporteExento'=>$value['ImporteExcento']
				)
			);
		}
	}
	/**
	
	 * http://www.lacorona.com.mx/fortiz/sat/xml.php
	 * Calculo de sello
	 */
	function _sella(&$root, $fk_certificado, $cadena_original) {
		
		 // print_r($arr);
		 // $fk_certificado = $arr['fk_certificado'];
		$certMod = new certificadoModelo();
		$certificado=$certMod->obtener( $fk_certificado );
		// print_r($certificado);
		
		$cer_pem=$certificado['cer_pem'];
		$key_pem = $certificado['key_pem'];
		// $key_pem = str_replace('-----BEGIN PRIVATE KEY-----','', $key_pem);
		// $key_pem = str_replace('-----END PRIVATE KEY-----','', $key_pem);
		
		$pkeyid = openssl_get_privatekey( $key_pem );			
		
		openssl_sign($cadena_original, $crypttext, $pkeyid, OPENSSL_ALGO_SHA1);
		openssl_free_key($pkeyid);
		 
		$sello = base64_encode($crypttext);      // lo codifica en formato base64
		$root->setAttribute("sello",$sello);
		
		
		
		$certificado = str_replace('-----BEGIN CERTIFICATE-----','', $cer_pem);
		$certificado = str_replace('-----END CERTIFICATE-----','', $certificado);
		
		// El certificado como base64 lo agrega al XML para simplificar la validacion
		$certificado= trim($certificado);
		$certificado= preg_replace("(\r\n)", "", $certificado);
		
		$root->setAttribute("certificado",$certificado );
		
		return $sello;
	}
	function _generales(&$root, $arr) {	
		// print_r($arr);
		// 
		
		// $this->_cargaAtt($root, array("xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance",
								  // "xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd "
								 // )
							 // );
				
		// $root->setAttributeNS("http://www.sat.gob.mx/nomina" , 'xmlns:nomina', 'http://www.sat.gob.mx/sitio_internet/cfd/nomina/nomina.xsd');
		
		$root->setAttributeNS(
	  'http://www.w3.org/2001/XMLSchema-instance',
	  'xsi:schemaLocation',
	  'http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd http://www.sat.gob.mx/nomina http://www.sat.gob.mx/sitio_internet/cfd/nomina/nomina11.xsd');

		// add new namespace
		$root->setAttributeNS(
		  'http://www.w3.org/2000/xmlns/',
		  'xmlns:nomina',
		  'http://www.sat.gob.mx/nomina');
		  
		// $this->_cargaAtt($root, array("xmlns:nomina"=>"http://www.sat.gob.mx/nomina") );
		
		// $root->setAttributeNS('http://www.sat.gob.mx/nomina' ,'xmlns:nomina', 'http://www.w3.org/2001/XMLSchema-instance');
		// $nomina = $xml->createElementNS('http://www.sat.gob.mx/nomina', 'nomina:Nomina');
		// $nomina = $complemento->appendChild($nomina);
		
		$this->_cargaAtt($root, array(
							  "version"=>$arr['version'],
							  "serie"=>$arr['serie'],
							  "folio"=>$arr['folio'],
							  "fecha"=>$this->_xml_fech($arr['fecha']),
							  "sello"=>"@",
							  // "noAprobacion"=>$arr['noAprobacion'],
							  // "anoAprobacion"=>$arr['anoAprobacion'],
							  "formaDePago"=>$arr['formaDePago'],
							  "noCertificado"=>$arr['noCertificado'],
							  "certificado"=>"@",
							  "subTotal"=>round($arr['subTotal'],6),
							  "descuento"=>round($arr['descuento'],6),
							  "motivoDescuento"=>$arr['motivoDescuento'],
							  "total"=>round($arr['total'], 6),
							  'condicionesDePago'=>$arr['condicionesDePago'],
							  "tipoDeComprobante"=>strtolower($arr['tipoDeComprobante']),
							  "metodoDePago"=>$arr['metodoDePago'],
							  "LugarExpedicion"=>$arr['LugarExpedicion'],
							  "NumCtaPago"=>$arr['NumCtaPago'],
							  "FolioFiscalOrig"=>$arr['FolioFiscalOrig'],
							  "SerieFolioFiscalOrig"=>$arr['SerieFolioFiscalOrig'],
							  "FechaFolioFiscalOrig"=> empty( $arr['FolioFiscalOrig'] )? '' : $this->_xml_fech($arr['FechaFolioFiscalOrig']),
							  "MontoFolioFiscalOrig"=>$arr['MontoFolioFiscalOrig'],
							  "Moneda"=>$arr['Moneda'],
							  "TipoCambio"=>$arr['TipoCambio']
						   )
						);
	}
	
	function _cargaAtt(&$nodo, $attr) {
		$quitar = array('sello'=>1,'noCertificado'=>1,'certificado'=>1);
		foreach ($attr as $key => $val) {
			$val = preg_replace('/\s\s+/', ' ', $val);   // Regla 5a y 5c
			$val = trim($val);                           // Regla 5b
			if (strlen($val)>0) {   // Regla 6
				 // $val = utf8_encode(str_replace("|","/",$val)); // Regla 1
				$val = str_replace("|","/",$val); // Regla 1
				$nodo->setAttribute($key, htmlspecialchars($val, ENT_NOQUOTES, "UTF-8"));
			}
		}
	}
	// }}}
	// {{{ Formateo de la fecha en el formato XML requerido (ISO)
	function _xml_fech($fech) {
		
		if (empty($fech) ){
			return '';
		}
		$fecha=DateTime::createFromFormat ( 'Y-m-d H:i:s' , $fech );
		
		$strFecha = $fecha->format('Y-m-d').'T'.$fecha->format('H:i:s');
		return $strFecha;
	}
	
	
	/**
	 * Detalle de los conceptos/productos de la factura
	 */
	private function _conceptos(&$root, $xml, $arr) {
		 // print_r($arr); exit;
		// print_r($arr);
		$conceptos = $xml->createElement("cfdi:Conceptos");
		$conceptos = $root->appendChild($conceptos);
		for ($i=0; $i<sizeof($arr['conceptos']); $i++) {
			if ( empty($arr['conceptos'][$i]['descripcion']) || empty($arr['conceptos'][$i]['unidad']) ) continue;
			if ( !empty($arr['conceptos'][$i]['eliminado']) ) continue;
			
			$concepto = $xml->createElement("cfdi:Concepto");
			$concepto = $conceptos->appendChild($concepto);
			// $prun = $arr['conceptos'][$i]['valorUnitario'];
			
			
			$this->_cargaAtt($concepto, array("cantidad"=>$arr['conceptos'][$i]['cantidad'],
									  "unidad"=>$arr['conceptos'][$i]['unidad'],
									  "descripcion"=>$arr['conceptos'][$i]['descripcion'],
									  "valorUnitario"=>$arr['conceptos'][$i]['valorUnitario'],
									  "importe"=>round($arr['conceptos'][$i]['importe'],6),
						   )
						);
		}
	}
	/**
	 * Impuesto (IVA)
	 */
	function impuestos(&$root, $xml, $arr) {
		
		$impuestos = $xml->createElement("cfdi:Impuestos");
		$impuestos = $root->appendChild($impuestos);
		
		$totTras = 0;
		$totRet = 0;
		
		$trasladosArr=array();
		$retencionesArr=array();
		
		$importe = $arr['subTotal'] - $arr['descuento'];
		// FORMATO DECIMALES
		
		foreach($arr['impuestos'] as $imp){
			// if ( empty($imp['seleccionado']) ) continue;
			
			if ($imp['tipo_impuesto'] == 1){
				$trasladosArr[] = array(
					'nombre'=>$imp['nombre'],
					'tasa'=>$imp['tasa'] * 1,
					'importe'=>$imp['importe'] * 1,
				);
			}else if ($imp['tipo_impuesto'] == 2){
				$retencionesArr[] = array(
					'nombre'=>$imp['nombre'],				
					'importe'=>$imp['importe'] * 1,
				);
				
			}
		}
			

		if ( !empty($retencionesArr) ) {
			$impuestos->SetAttribute("totalImpuestosRetenidos", $arr['totImpRet'] );
			$traslados = $xml->createElement("cfdi:Retenciones");
			$traslados = $impuestos->appendChild($traslados);
			foreach($retencionesArr as $value){
				$Retencion = $xml->createElement("cfdi:Retencion");
				$Retencion = $traslados->appendChild($Retencion);
				
				// $cantidad = $importe * ($value/100);
				$this->_cargaAtt($Retencion, array("impuesto"=>$value['nombre'],									  
										  "importe"=>$value['importe']
										 )
									 );
			}			
		}

		
		if ( !empty($trasladosArr) ) {
			$impuestos->SetAttribute("totalImpuestosTrasladados", $arr['totImpTras'] );
		
			$traslados = $xml->createElement("cfdi:Traslados");
			$traslados = $impuestos->appendChild($traslados);
			foreach($trasladosArr as $value){
				$traslado = $xml->createElement("cfdi:Traslado");
				$traslado = $traslados->appendChild($traslado);
				
				// $cantidad = $importe * ($value['tasa']/100);
				$this->_cargaAtt($traslado, array("impuesto"=>$value['nombre'],									  
										  "importe"=>$value['importe'],
										  'tasa'=>$value['tasa']
										 )
									 );
			}			
		}
		
	}
		
	/**
	 *  genera_cadena_original
	 */
	function _genera_cadena_original($xml) {
		//http://www.sat.gob.mx/sitio_internet/cfd/3/cadenaoriginal_3_0/cadenaoriginal_3_2.xslt		
		$paso = new DOMDocument;
		$paso->loadXML($xml->saveXML());
		$xsl = new DOMDocument;		
		
		$file='../nomina/cadenaoriginal_3_2.xslt';
		
		$xsl->load($file);
		$proc = new XSLTProcessor;
		@$proc->importStyleSheet($xsl); 
		$cadena_original = $proc->transformToXML($paso);
		
		// $cadena_original = utf8_decode($cadena_original);
		 
		return $cadena_original;
	}
	public function generarXml($factura){				
		// ehttp://www.lacorona.com.mx/fortiz/sat/xml.php
		
		// global $xml, $ret;
		
		$xml = new DOMdocument("1.0","UTF-8");
				
		// $root = $xml->createElementNS('http://www.sat.gob.mx/nomina', 'nomina:Nomina');
		// $root = $xml->appendChild($root);
		
		$root = $xml->createElementNS('http://www.sat.gob.mx/cfd/3', 'cfdi:Comprobante');
		
		$root = $xml->appendChild($root);
		
		// $root = $xml->createElementNS('http://www.sat.gob.mx/nomina', 'nomina:Nomina');
		// $root = $xml->appendChild($root);
		
		$sello='';
		
		
		
		  $this->_generales($root, $factura);
		  $this->_emisor($root, $xml, $factura);
		$this->_receptor($root, $xml, $factura);
		$this->_conceptos($root, $xml, $factura);				
		$this->impuestos($root, $xml, $factura);
		
		$this->complementoNomina($root, $xml, $factura['nomina']);
		
		$cadena = $this->_genera_cadena_original($xml);			
		// return array('success'=>false, 'msg'=>'ErROR DE PRUEBA');
		 $sello = $this->_sella($root, $factura['nomina']['fk_certificado'], $cadena);
	
		
		return array(
			'xml'=>$xml->saveXml(),
			 'sello'=>$sello,
			 'cadena'=>$cadena,
			'success'=>true
		);
	}
	function generarNomina($nomina){
		// print_r($nomina); exit;
		$factura=array();
		
		
		$factura['version']='3.2';
	    $factura['serie'] = $nomina['serie'];
		$factura['folio'] = $nomina['folio'];	
		// $fecha=DateTime::createFromFormat ( 'Y-m-dTH:i:s' ,  $nomina['fecha_emision'] );
		$factura['fecha'] =  $nomina['fecha_emision'];
		$factura['sello'] =  '@';
		$factura['formaDePago'] = $nomina['nombre_fk_forma_pago']; 
		$factura['noCertificado'] = $nomina['no_serie_fk_certificado']; 
		$factura['certificado'] = '@'; 
		
		$factura['subTotal'] = $nomina['subTotal']; 
		$factura['descuento'] = $nomina['descuento']; 
		$factura['motivoDescuento'] = $nomina['motivo_descuento']; 
		$factura['total'] = $nomina['total']; 
		$factura['condicionesDePago'] = $nomina['condiciones_de_pago']; 
		$factura['tipoDeComprobante'] = 'EGRESO'; 
		$factura['metodoDePago'] = $nomina['nombre_fk_metodo_pago']; 
		
		$factura['NumCtaPago'] = $nomina['num_cta_pago']; 
		$factura['TipoCambio'] = $nomina['tipo_cambio']; 
		
		$factura['FolioFiscalOrig'] ='';
		$factura['FechaFolioFiscalOrig'] ='';
		$factura['SerieFolioFiscalOrig'] ='';		  
		
		$factura['MontoFolioFiscalOrig'] = 0; 
		$factura['totImpRet'] = $nomina['totImpRet']; 
		$factura['totImpTras'] = $nomina['totImpTras']; 
		 
		//----------------------------------------
		$fk_moneda=$nomina['fk_moneda'];
		$monMod = new monedaModelo();
		$moneda = $monMod->obtener($fk_moneda);		
		$factura['Moneda'] = $moneda['codigo']; 	
		//----------------------------------------
		$fk_patron=$nomina['fk_patron'];
		$empMod = new empresaModelo();
		$empresa = $empMod->obtener($fk_patron);		
		//----------------------------------------
		$factura['emisor_rfc'] = $empresa['rfc']; 
		$factura['emisor_razon_social'] = $empresa['razon_social']; 
		$factura['emisor_calle'] = $empresa['calle']; 
		$factura['emisor_numero_exterior'] = $empresa['noExterior']; 
		$factura['emisor_numero_interior'] = $empresa['noInterior']; 
		$factura['emisor_colonia'] = $empresa['colonia']; 
		$factura['emisor_municipio'] = $empresa['nombre_fk_municipio']; 
		$factura['emisor_estado'] = $empresa['nombre_fk_estado']; 
		$factura['emisor_pais'] = $empresa['nombre_fk_pais']; 
		$factura['emisor_codigoPostal'] = $empresa['codigoPostal']; 
		$factura['emisor_localidad'] = $empresa['localidad']; 
		$factura['emisor_referencia'] = $empresa['referencia']; 
		$factura['LugarExpedicion'] = $empresa['localidad'].', '.$empresa['nombre_fk_municipio'].', '.$empresa['nombre_fk_estado'].'. '.$empresa['nombre_fk_pais']; 
		$factura['regimen']='';
		foreach($empresa['regimen_fiscalDeEmpresa'] as $regimen){	
			$factura['regimen'].=$regimen['regimen'].', ';
		}
		$factura['regimen'] = substr($factura['regimen'], 0, strlen($factura['regimen'])-2 );
		//----------------------------------------				
		$fk_empleado=$nomina['fk_empleado'];
		$empMod = new trabajadorModelo();
		$empleado = $empMod->obtener($fk_empleado);			
		//----------------------------------------
		$factura['cliente_rfc'] = $empleado['rfc']; 
		$factura['cliente_nombre'] = $empleado['nombre']; 
		$factura['receptor_calle'] = $empleado['calle']; 
		$factura['receptor_numero_exterior'] = $empleado['noExterior']; 
		$factura['receptor_numero_interior'] = $empleado['noInterior']; 
		$factura['receptor_colonia'] = $empleado['colonia']; 
		$factura['receptor_localidad'] = $empleado['localidad']; 
		$factura['receptor_municipio'] = $empleado['nombre_fk_municipio']; 
		$factura['receptor_estado'] = $empleado['nombre_fk_estado']; 
		$factura['receptor_pais'] = utf8_encode($empleado['nombre_fk_pais']); 
		$factura['receptor_codigo_postal'] = $empleado['codigoPostal']; 
		$factura['receptor_localidad'] = $empleado['localidad']; 
		$factura['receptor_referencia'] = $empleado['referencia']; 
		//----------------------------------------
		$conceptosDeNomina=array();
		foreach($nomina['conceptosDeNomina'] as $concepto){
			$conceptosDeNomina[]=array(
				'cantidad'		=>$concepto['cantidad'],
				'unidad'		=>'Servicio',
				'descripcion'	=>$concepto['nombre_fk_concepto'],
				'valorUnitario' =>$concepto['valorUnitario'],
				'importe' 		=>$concepto['importe']
			);		
		}
		$factura['conceptos']=$conceptosDeNomina;
		//----------------------------------------				
		$impuestosDeNomina=array();
		// print_r($nomina['impuestosDeNomina']);
		foreach($nomina['impuestosDeNomina'] as $imp){
			$impuestosDeNomina[]=array(			
				'nombre'=>$imp['nombre_fk_impuesto'],
				'tasa'=>$imp['tasai'] * 1,
				'importe'=>$imp['importe'],	
				'tipo_impuesto'=>$imp['fk_tipo_impuesto']*1	//1=traslado, 2=retencion
			);		
		}
		$factura['impuestos']=$impuestosDeNomina;
		//----------------------------------------	
		$fk_TipoRegimen=$nomina['fk_TipoRegimen'];
		$regMod = new regimen_contratacionModelo();
		$regimen = $regMod->obtener($fk_TipoRegimen);		
		$nomina['TipoRegimen'] = $regimen['clave'];
		//----------------------------------------		
		$fk_Departamento=$nomina['fk_Departamento'];
		$depMod = new departamentoModelo();
		$depto = $depMod->obtener($fk_Departamento);		
		$nomina['Departamento'] = $depto['nombre'];
		//----------------------------------------
		$fk_Banco=$nomina['fk_banco'];
		$bancoMod = new bancoModelo();
		$banco = $bancoMod->obtener($fk_Banco);		
		$nomina['Banco'] = $banco['clave'];
		//----------------------------------------		
		$factura['nomina'] = $nomina;
		//----------------------------------------		
		$res = $this->generarXml($factura);
		$xml=$res['xml'];		
		// file_put_contents('../nomina.xml', $xml->saveXML() );
		$valida = $this->_valida( $xml );
		
		
		if ( !$valida['success'] ){
			// print_r( $valida ) ;
			return array(
				'success'=>false,
				'msg'=>$valida['errores'][0]->message
			);
		}
		return $res;
		// file_put_contents('../nomina.xml', $xml->saveXML());
	}
	function complementoNomina(&$root, $xml, $arr){
		 // xmlns:detallista="http://www.sat.gob.mx/detallista"
		
		
		$complemento = $xml->createElement("cfdi:Complemento");
		$complemento = $root->appendChild($complemento);
		
		$nomina = $xml->createElement('nomina:Nomina');		
		$nomina = $complemento->appendChild($nomina);
		
		// $nomina = $xml->createElementNS('http://www.sat.gob.mx/nomina', 'nomina:Nomina');
		// $nomina = $complemento->appendChild($nomina);
		
		
		// $this->_cargaAtt($nomina, array("xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance",
								  // "xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/cfd/nomina/nomina.xslt"
								 // )
							 // );
							 
		// $nomina = $xml->createElement("nomina:Nomina");
		// $nomina = $complemento->appendChild($nomina);
		// print_r($arr);
		$fechaPago=date_create_from_format('Y-d-m H:i:s', $arr['FechaPago']);
		$fechaPago = $fechaPago->format('Y-d-m');
		
		$FechaInicialPago=date_create_from_format('Y-d-m H:i:s', $arr['FechaInicialPago']);
		$FechaInicialPago = $FechaInicialPago->format('Y-d-m');
		
		$FechaFinalPago=date_create_from_format('Y-d-m H:i:s', $arr['FechaFinalPago']);
		$FechaFinalPago = $FechaFinalPago->format('Y-d-m');
		
		
		$FechaInicioRelLaboral=date_create_from_format('Y-d-m H:i:s', $arr['FechaInicioRelLaboral']);
		$FechaInicioRelLaboral = $FechaInicioRelLaboral->format('Y-d-m');
		
		// print_r($arr);
		$this->_cargaAtt($nomina, array(
			"Version"=>'1.1',
			"RegistroPatronal"=>$arr['RegistroPatronal'],
			"NumEmpleado"=>$arr['NumEmpleado'],
			"CURP"=>$arr['CURP'],
			"TipoRegimen"=>$arr['TipoRegimen'],
			"NumSeguridadSocial"=>$arr['NumSeguridadSocial'],
			"FechaPago"=>$fechaPago,
			"FechaInicialPago"=>$FechaInicialPago,
			"FechaFinalPago"=>$FechaFinalPago,
			"NumDiasPagados"=>$arr['NumDiasPagados'],
			"Departamento"=>$arr['Departamento'],
			"TipoRegimen"=>$arr['TipoRegimen'],
			"CLABE"=>$arr['CLABE'],
			"Banco"=>$arr['Banco'],
			"FechaInicioRelLaboral"=>$FechaInicioRelLaboral,
			"Antiguedad"=>$arr['Antiguedad'],
			"Puesto"=>$arr['Puesto'],
			"TipoContrato"=>$arr['TipoContrato'],
			"TipoJornada"=>$arr['TipoJornada'],
			"PeriodicidadPago"=>$arr['PeriodicidadPago'],
			"SalarioBaseCotApor"=>$arr['SalarioBaseCotApor'],
			"RiesgoPuesto"=>$arr['RiesgoPuesto'],
			"SalarioDiarioIntegrado"=>$arr['SalarioDiarioIntegrado']
		));
		
		$this->ingresos($nomina, $xml, $arr);
		$this->deducciones($nomina, $xml, $arr);
		$this->incapacidades($nomina, $xml, $arr);
		$this->horas_extras($nomina, $xml, $arr);
	}
	function _receptor($root, $xml, $arr) {
		
		$receptor = $xml->createElement("cfdi:Receptor");
		$receptor = $root->appendChild($receptor);
		$this->_cargaAtt($receptor, array("rfc"=>$arr['cliente_rfc'],
								  "nombre"=>$arr['cliente_nombre']
							  )
						  );
		$domicilio = $xml->createElement("cfdi:Domicilio");
		$domicilio = $receptor->appendChild($domicilio);
		$this->_cargaAtt($domicilio, array("calle"=> $arr['receptor_calle'] ,
								"noExterior"=>$arr['receptor_numero_exterior'],
								"noInterior"=>$arr['receptor_numero_interior'],
							   "colonia"=>$arr['receptor_colonia'],
							   "municipio"=>$arr['receptor_municipio'],
							   "estado"=>$arr['receptor_estado'],
							   "pais"=>utf8_decode($arr['receptor_pais']),
							   "codigoPostal"=>$arr['receptor_codigo_postal'],
							   "localidad"=>$arr['receptor_localidad'],
							   "referencia"=>$arr['receptor_referencia']
						   )
					   );
		}
	function _emisor(&$root, $xml, $arr) {

	$emisor = $xml->createElement("cfdi:Emisor");
	$emisor = $root->appendChild($emisor);
	 
	$this->_cargaAtt($emisor, array("rfc"=>$arr['emisor_rfc'],
						   "nombre"=>$arr['emisor_razon_social']
					   )
					);
$domfis = $xml->createElement("cfdi:DomicilioFiscal");
$domfis = $emisor->appendChild($domfis);

$this->_cargaAtt($domfis, array("calle"=>$arr['emisor_calle'],
                        "noExterior"=>$arr['emisor_numero_exterior'],
                        "noInterior"=>$arr['emisor_numero_interior'],
                        "colonia"=>$arr['emisor_colonia'],
                        "municipio"=>$arr['emisor_municipio'],
                        "estado"=>$arr['emisor_estado'],
                        "pais"=>$arr['emisor_pais'],
                        "codigoPostal"=>$arr['emisor_codigoPostal'],
						"localidad"=>$arr['emisor_localidad'],
						"referencia"=>$arr['emisor_referencia'],
                   )
                );
	
	
	$regimenes=explode(',',$arr['regimen']);
	foreach($regimenes as $regEl){
		$regimen = $xml->createElement("cfdi:RegimenFiscal");
		$regimen = $emisor->appendChild($regimen);
		$this->_cargaAtt($regimen, array("Regimen"=>$regEl));
		
	}

}
// }}}
	function _valida($xml) {
		global $_PETICION;
		 $paso = new DOMDocument;				 
		 $paso->loadXML($xml );
		
		libxml_use_internal_errors(true);  
		
		// $additionalSchema = simplexml_load_file('http://www.sat.gob.mx/sitio_internet/cfd/nomina/nomina.xsd');
		// $additionalSchema->registerXPathNamespace("nomina", "http://www.w3.org/2001/XMLSchema");
		// $nodes = $additionalSchema->xpath('/xs:schema/*');

		// $file="http://www.sat.gob.mx/cfd/3/cfdv32.xsd";  
		// $file='../nomina/cfdv32.xsd';
		
		// http://stackoverflow.com/questions/9805359/how-to-handle-multiple-namespaces-with-different-uri-in-xsd
		$file='../nomina/on_all.xsd';
		$ok = @$paso->schemaValidate($file);
		// $ok = @$paso->validate($file);
		$errors=array();
		
		if (!$ok){
			$errors = libxml_get_errors();			
			libxml_clear_errors();
		}
		
		return array(
			'success'=>$ok,
			'errores'=>$errors
		);
		
	}
}
?>