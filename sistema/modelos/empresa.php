<?php
class empresaModelo extends Modelo{	
	var $tabla='facturacion_razones_sociales';
	var $pk='id';
	var $campos= array('id', 'rfc', 'razon_social', 'nombre_comercial', 'datos_de_contacto', 'logo_factura', 'fk_pais', 'nombre_pais', 'fk_estado', 'nombre_estado', 'fk_ciudad', 'fk_municipio', 'nombre_municipio', 'calle', 'noExterior', 'noInterior', 'colonia', 'localidad', 'referencia', 'codigoPostal', 'email_bcc', 'RegistroPatronal');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' empresa.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='rfc' ) {
					$filtros .= ' empresa.rfc like :rfc OR ';
				} 
				if ( $filtro['dataKey']=='razon_social' ) {
					$filtros .= ' empresa.razon_social like :razon_social OR ';
				} 
				if ( $filtro['dataKey']=='nombre_comercial' ) {
					$filtros .= ' empresa.nombre_comercial like :nombre_comercial OR ';
				} 
				if ( $filtro['dataKey']=='datos_de_contacto' ) {
					$filtros .= ' empresa.datos_de_contacto like :datos_de_contacto OR ';
				} 
				if ( $filtro['dataKey']=='logo_factura' ) {
					$filtros .= ' empresa.logo_factura like :logo_factura OR ';
				} 
				if ( $filtro['dataKey']=='fk_pais' ) {
					$filtros .= ' empresa.fk_pais like :fk_pais OR ';
				} 
				if ( $filtro['dataKey']=='nombre_pais' ) {
					$filtros .= ' pais0.nombre like :nombre_pais OR ';
				} 
				if ( $filtro['dataKey']=='fk_estado' ) {
					$filtros .= ' empresa.fk_estado like :fk_estado OR ';
				} 
				if ( $filtro['dataKey']=='nombre_estado' ) {
					$filtros .= ' estado1.nombre like :nombre_estado OR ';
				} 
				if ( $filtro['dataKey']=='fk_ciudad' ) {
					$filtros .= ' empresa.fk_ciudad like :fk_ciudad OR ';
				} 
				if ( $filtro['dataKey']=='fk_municipio' ) {
					$filtros .= ' empresa.fk_municipio like :fk_municipio OR ';
				} 
				if ( $filtro['dataKey']=='nombre_municipio' ) {
					$filtros .= ' municipio2.nombre like :nombre_municipio OR ';
				} 
				if ( $filtro['dataKey']=='calle' ) {
					$filtros .= ' empresa.calle like :calle OR ';
				} 
				if ( $filtro['dataKey']=='noExterior' ) {
					$filtros .= ' empresa.noExterior like :noExterior OR ';
				} 
				if ( $filtro['dataKey']=='noInterior' ) {
					$filtros .= ' empresa.noInterior like :noInterior OR ';
				} 
				if ( $filtro['dataKey']=='colonia' ) {
					$filtros .= ' empresa.colonia like :colonia OR ';
				} 
				if ( $filtro['dataKey']=='localidad' ) {
					$filtros .= ' empresa.localidad like :localidad OR ';
				} 
				if ( $filtro['dataKey']=='referencia' ) {
					$filtros .= ' empresa.referencia like :referencia OR ';
				} 
				if ( $filtro['dataKey']=='codigoPostal' ) {
					$filtros .= ' empresa.codigoPostal like :codigoPostal OR ';
				} 
				if ( $filtro['dataKey']=='email_bcc' ) {
					$filtros .= ' empresa.email_bcc like :email_bcc OR ';
				} 
				if ( $filtro['dataKey']=='RegistroPatronal' ) {
					$filtros .= ' empresa.RegistroPatronal like :RegistroPatronal OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN system_ubicacion_paises AS pais0 ON pais0.id = empresa.fk_pais
 LEFT JOIN system_ubicacion_estados AS estado1 ON estado1.id = empresa.fk_estado
 LEFT JOIN system_ubicacion_municipios AS municipio2 ON municipio2.id = empresa.fk_municipio';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' empresa '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='rfc' ) {
				$sth->bindValue(':rfc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='razon_social' ) {
				$sth->bindValue(':razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial' ) {
				$sth->bindValue(':nombre_comercial','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='datos_de_contacto' ) {
				$sth->bindValue(':datos_de_contacto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='logo_factura' ) {
				$sth->bindValue(':logo_factura','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_pais' ) {
				$sth->bindValue(':fk_pais','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_pais' ) {
				$sth->bindValue(':nombre_pais', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_ciudad' ) {
				$sth->bindValue(':fk_ciudad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_municipio' ) {
				$sth->bindValue(':fk_municipio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_municipio' ) {
				$sth->bindValue(':nombre_municipio', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='calle' ) {
				$sth->bindValue(':calle','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noExterior' ) {
				$sth->bindValue(':noExterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noInterior' ) {
				$sth->bindValue(':noInterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='colonia' ) {
				$sth->bindValue(':colonia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='localidad' ) {
				$sth->bindValue(':localidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='referencia' ) {
				$sth->bindValue(':referencia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='codigoPostal' ) {
				$sth->bindValue(':codigoPostal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='email_bcc' ) {
				$sth->bindValue(':email_bcc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='RegistroPatronal' ) {
				$sth->bindValue(':RegistroPatronal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}		
			}
		}
		$exito = $sth->execute();		
		if ( !$exito ){
			$error = $this->getError( $sth );
			throw new Exception($error['msg']); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$paginar=false;
		if ( isset($params['limit']) && isset($params['start']) ){
			$paginar=true;
		}
		
		if ($paginar){
			$limit=$params['limit'];
			$start=$params['start'];
			$sql = 'SELECT empresa.id, empresa.rfc, empresa.razon_social, empresa.nombre_comercial, empresa.datos_de_contacto, empresa.logo_factura, empresa.fk_pais, pais0.nombre AS nombre_fk_pais, empresa.fk_estado, estado1.nombre AS nombre_fk_estado, empresa.fk_ciudad, empresa.fk_municipio, municipio2.nombre AS nombre_fk_municipio, empresa.calle, empresa.noExterior, empresa.noInterior, empresa.colonia, empresa.localidad, empresa.referencia, empresa.codigoPostal, empresa.email_bcc, empresa.RegistroPatronal FROM '.$this->tabla.' empresa '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT empresa.id, empresa.rfc, empresa.razon_social, empresa.nombre_comercial, empresa.datos_de_contacto, empresa.logo_factura, empresa.fk_pais, pais0.nombre AS nombre_fk_pais, empresa.fk_estado, estado1.nombre AS nombre_fk_estado, empresa.fk_ciudad, empresa.fk_municipio, municipio2.nombre AS nombre_fk_municipio, empresa.calle, empresa.noExterior, empresa.noInterior, empresa.colonia, empresa.localidad, empresa.referencia, empresa.codigoPostal, empresa.email_bcc, empresa.RegistroPatronal FROM '.$this->tabla.' empresa '.$joins.$filtros;
		}
				
		$sth = $pdo->prepare($sql);
		if ($paginar){
			$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
			$sth->bindValue(':start',$start,PDO::PARAM_INT);
		}
		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='rfc' ) {
				$sth->bindValue(':rfc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='razon_social' ) {
				$sth->bindValue(':razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial' ) {
				$sth->bindValue(':nombre_comercial','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='datos_de_contacto' ) {
				$sth->bindValue(':datos_de_contacto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='logo_factura' ) {
				$sth->bindValue(':logo_factura','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_pais' ) {
				$sth->bindValue(':fk_pais','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_pais' ) {
				$sth->bindValue(':nombre_pais', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_ciudad' ) {
				$sth->bindValue(':fk_ciudad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_municipio' ) {
				$sth->bindValue(':fk_municipio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_municipio' ) {
				$sth->bindValue(':nombre_municipio', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='calle' ) {
				$sth->bindValue(':calle','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noExterior' ) {
				$sth->bindValue(':noExterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noInterior' ) {
				$sth->bindValue(':noInterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='colonia' ) {
				$sth->bindValue(':colonia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='localidad' ) {
				$sth->bindValue(':localidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='referencia' ) {
				$sth->bindValue(':referencia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='codigoPostal' ) {
				$sth->bindValue(':codigoPostal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='email_bcc' ) {
				$sth->bindValue(':email_bcc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='RegistroPatronal' ) {
				$sth->bindValue(':RegistroPatronal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}	
			}
		}
		$exito = $sth->execute();

		
		if ( !$exito ){		
			$error = $this->getError( $sth );
			throw new Exception($error['msg']); //TODO: agregar numero de error, crear una exception MiEscepcion			
		}
		
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$modelos
		);
	}
	
	function nuevo( $params ){
		$obj=array();
		
			$obj['id']='';
			$obj['rfc']='';
			$obj['razon_social']='';
			$obj['nombre_comercial']='';
			$obj['datos_de_contacto']='';
			$obj['logo_factura']='';
			$obj['fk_pais']='';
			$obj['nombre_pais']='';
			$obj['fk_estado']='';
			$obj['nombre_estado']='';
			$obj['fk_ciudad']='';
			$obj['fk_municipio']='';
			$obj['nombre_municipio']='';
			$obj['calle']='';
			$obj['noExterior']='';
			$obj['noInterior']='';
			$obj['colonia']='';
			$obj['localidad']='';
			$obj['referencia']='';
			$obj['codigoPostal']='';
			$obj['email_bcc']='';
			$obj['Regimen_FiscalDeEmpresa']=array();
			
			$obj['RegistroPatronal']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT empresa.id, empresa.rfc, empresa.razon_social, empresa.nombre_comercial, empresa.datos_de_contacto, empresa.logo_factura, empresa.fk_pais, pais0.nombre AS nombre_fk_pais, empresa.fk_estado, estado1.nombre AS nombre_fk_estado, empresa.fk_ciudad, empresa.fk_municipio, municipio2.nombre AS nombre_fk_municipio, empresa.calle, empresa.noExterior, empresa.noInterior, empresa.colonia, empresa.localidad, empresa.referencia, empresa.codigoPostal, empresa.email_bcc, empresa.RegistroPatronal
 FROM facturacion_razones_sociales AS empresa
 LEFT JOIN system_ubicacion_paises AS pais0 ON pais0.id = empresa.fk_pais
 LEFT JOIN system_ubicacion_estados AS estado1 ON estado1.id = empresa.fk_estado
 LEFT JOIN system_ubicacion_municipios AS municipio2 ON municipio2.id = empresa.fk_municipio
  WHERE empresa.id=:id';
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		 $sth->BindValue(':id',$llave ); 
		$exito = $sth->execute();
		if ( !$exito ){
			$error =  $this->getError( $sth );
			throw new Exception($error['msg']);
		}
		
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){						
			throw new Exception("Elemento no encontrado");
		}
		
		if ( sizeof($modelos) > 1 ){			
			throw new Exception("El identificador está duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
				//----------------------------
				$conceptosMod=new regimenModelo();
				$params=array(
					'filtros'=>array(
						array(
							'filterValue'=>$modelos[0]['id'],
							'filterOperator'=>'equals',
							'dataKey'=>'fk_razon_social'
						)
					)
				);
				$regimen_fiscalDeEmpresa=$conceptosMod->buscar($params);				
				$modelos[0]['regimen_fiscalDeEmpresa'] =$regimen_fiscalDeEmpresa['datos'];
				//---------------------------
				
		return $modelos[0];			
	}
	
	function guardar( $datos ){
	
		$esNuevo=( empty( $datos['id'] ) )? true : false;			
		$strCampos='';
		
		//--------------------------------------------
		// CAMPOS A GUARDAR
		 
		if ( isset( $datos['rfc'] ) ){
			$strCampos .= ' rfc=:rfc, ';
		} 
		if ( isset( $datos['razon_social'] ) ){
			$strCampos .= ' razon_social=:razon_social, ';
		} 
		if ( isset( $datos['nombre_comercial'] ) ){
			$strCampos .= ' nombre_comercial=:nombre_comercial, ';
		} 
		if ( isset( $datos['datos_de_contacto'] ) ){
			$strCampos .= ' datos_de_contacto=:datos_de_contacto, ';
		} 
		if ( isset( $datos['logo_factura'] ) ){
			$strCampos .= ' logo_factura=:logo_factura, ';
		} 
		if ( isset( $datos['fk_pais'] ) ){
			$strCampos .= ' fk_pais=:fk_pais, ';
		} 
		if ( isset( $datos['fk_estado'] ) ){
			$strCampos .= ' fk_estado=:fk_estado, ';
		} 
		if ( isset( $datos['fk_ciudad'] ) ){
			$strCampos .= ' fk_ciudad=:fk_ciudad, ';
		} 
		if ( isset( $datos['fk_municipio'] ) ){
			$strCampos .= ' fk_municipio=:fk_municipio, ';
		} 
		if ( isset( $datos['calle'] ) ){
			$strCampos .= ' calle=:calle, ';
		} 
		if ( isset( $datos['noExterior'] ) ){
			$strCampos .= ' noExterior=:noExterior, ';
		} 
		if ( isset( $datos['noInterior'] ) ){
			$strCampos .= ' noInterior=:noInterior, ';
		} 
		if ( isset( $datos['colonia'] ) ){
			$strCampos .= ' colonia=:colonia, ';
		} 
		if ( isset( $datos['localidad'] ) ){
			$strCampos .= ' localidad=:localidad, ';
		} 
		if ( isset( $datos['referencia'] ) ){
			$strCampos .= ' referencia=:referencia, ';
		} 
		if ( isset( $datos['codigoPostal'] ) ){
			$strCampos .= ' codigoPostal=:codigoPostal, ';
		} 
		if ( isset( $datos['email_bcc'] ) ){
			$strCampos .= ' email_bcc=:email_bcc, ';
		} 
		if ( isset( $datos['RegistroPatronal'] ) ){
			$strCampos .= ' RegistroPatronal=:RegistroPatronal, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Empresa Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Empresa Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['rfc'] ) ){
			$sth->bindValue(':rfc', $datos['rfc'] );
		}
		if  ( isset( $datos['razon_social'] ) ){
			$sth->bindValue(':razon_social', $datos['razon_social'] );
		}
		if  ( isset( $datos['nombre_comercial'] ) ){
			$sth->bindValue(':nombre_comercial', $datos['nombre_comercial'] );
		}
		if  ( isset( $datos['datos_de_contacto'] ) ){
			$sth->bindValue(':datos_de_contacto', $datos['datos_de_contacto'] );
		}
		if  ( isset( $datos['logo_factura'] ) ){
			$sth->bindValue(':logo_factura', $datos['logo_factura'] );
		}
		if  ( isset( $datos['fk_pais'] ) ){
			$sth->bindValue(':fk_pais', $datos['fk_pais'] );
		}
		if  ( isset( $datos['fk_estado'] ) ){
			$sth->bindValue(':fk_estado', $datos['fk_estado'] );
		}
		if  ( isset( $datos['fk_ciudad'] ) ){
			$sth->bindValue(':fk_ciudad', $datos['fk_ciudad'] );
		}
		if  ( isset( $datos['fk_municipio'] ) ){
			$sth->bindValue(':fk_municipio', $datos['fk_municipio'] );
		}
		if  ( isset( $datos['calle'] ) ){
			$sth->bindValue(':calle', $datos['calle'] );
		}
		if  ( isset( $datos['noExterior'] ) ){
			$sth->bindValue(':noExterior', $datos['noExterior'] );
		}
		if  ( isset( $datos['noInterior'] ) ){
			$sth->bindValue(':noInterior', $datos['noInterior'] );
		}
		if  ( isset( $datos['colonia'] ) ){
			$sth->bindValue(':colonia', $datos['colonia'] );
		}
		if  ( isset( $datos['localidad'] ) ){
			$sth->bindValue(':localidad', $datos['localidad'] );
		}
		if  ( isset( $datos['referencia'] ) ){
			$sth->bindValue(':referencia', $datos['referencia'] );
		}
		if  ( isset( $datos['codigoPostal'] ) ){
			$sth->bindValue(':codigoPostal', $datos['codigoPostal'] );
		}
		if  ( isset( $datos['email_bcc'] ) ){
			$sth->bindValue(':email_bcc', $datos['email_bcc'] );
		}
		if  ( isset( $datos['RegistroPatronal'] ) ){
			$sth->bindValue(':RegistroPatronal', $datos['RegistroPatronal'] );
		}		
		if ( !$esNuevo)	{
			$sth->bindValue(':id', $datos['id'] );
		}	
		//--------------------------------------------
		$exito = $sth->execute();
		if ( !$exito ){
			$error =  $this->getError( $sth );
			throw new Exception($error['msg']);
		}
		
		if ( $esNuevo ){
			$idObj=$pdo->lastInsertId();
		}else{
			$idObj=$datos['id'];
		}	
		
		
		
		
		$regimenMod = new regimenModelo();
		foreach( $datos['Regimen_FiscalDeEmpresa'] as $el ){
			if ( !empty($el['eliminado']) ){
				if ( !empty($el['id']) ){
					$res = $regimenMod->eliminar( array('id'=>$el['id']) );
					if ($res )$res =array('success'=>true);
				}else{
					$res=array('success'=>true);
				}					
			 }else{
				unset( $el['eliminado'] );
				$el['fk_razon_social']=$idObj;
				// if ( empty($concepto['nombre'])  )  continue;
				$res = $regimenMod->guardar($el);
			 }
			
			
			//-----
			//
			//$res=$regimenMod->guardar($el);
			//if ( !$res['success'] ){											
			//	return $res;
			//}
			
		}
		$obj=$this->obtener( $idObj );
		return array(
			'success'=>true,
			'datos'=>$obj,
			'msg'=>$msg
		);
		
	}
}
?>