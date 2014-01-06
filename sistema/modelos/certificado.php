<?php
class certificadoModelo extends Modelo{	
	var $tabla='facturacion_certificados';
	var $pk='id';
	var $campos= array('id', 'fk_razon_social', 'nombre_comercial_empresa', 'no_serie', 'cer_pem', 'key_pem', 'pass', 'valido_desde', 'valido_hasta', 'es_default');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' certificado.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='fk_razon_social' ) {
					$filtros .= ' certificado.fk_razon_social like :fk_razon_social OR ';
				} 
				if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
					$filtros .= ' empresa0.nombre_comercial like :nombre_comercial_empresa OR ';
				} 
				if ( $filtro['dataKey']=='no_serie' ) {
					$filtros .= ' certificado.no_serie like :no_serie OR ';
				} 
				if ( $filtro['dataKey']=='cer_pem' ) {
					$filtros .= ' certificado.cer_pem like :cer_pem OR ';
				} 
				if ( $filtro['dataKey']=='key_pem' ) {
					$filtros .= ' certificado.key_pem like :key_pem OR ';
				} 
				if ( $filtro['dataKey']=='pass' ) {
					$filtros .= ' certificado.pass like :pass OR ';
				} 
				if ( $filtro['dataKey']=='valido_desde' ) {
					$filtros .= ' certificado.valido_desde like :valido_desde OR ';
				} 
				if ( $filtro['dataKey']=='valido_hasta' ) {
					$filtros .= ' certificado.valido_hasta like :valido_hasta OR ';
				} 
				if ( $filtro['dataKey']=='es_default' ) {
					$filtros .= ' certificado.es_default like :es_default OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = certificado.fk_razon_social';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' certificado '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_razon_social' ) {
				$sth->bindValue(':fk_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
				$sth->bindValue(':nombre_comercial_empresa', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='no_serie' ) {
				$sth->bindValue(':no_serie','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='cer_pem' ) {
				$sth->bindValue(':cer_pem','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='key_pem' ) {
				$sth->bindValue(':key_pem','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='pass' ) {
				$sth->bindValue(':pass','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valido_desde' ) {
				$sth->bindValue(':valido_desde','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valido_hasta' ) {
				$sth->bindValue(':valido_hasta','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='es_default' ) {
				$sth->bindValue(':es_default','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT certificado.id, certificado.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social, certificado.no_serie, certificado.cer_pem, certificado.key_pem, certificado.pass, certificado.valido_desde, certificado.valido_hasta, certificado.es_default FROM '.$this->tabla.' certificado '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT certificado.id, certificado.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social, certificado.no_serie, certificado.cer_pem, certificado.key_pem, certificado.pass, certificado.valido_desde, certificado.valido_hasta, certificado.es_default FROM '.$this->tabla.' certificado '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='fk_razon_social' ) {
				$sth->bindValue(':fk_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
				$sth->bindValue(':nombre_comercial_empresa', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='no_serie' ) {
				$sth->bindValue(':no_serie','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='cer_pem' ) {
				$sth->bindValue(':cer_pem','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='key_pem' ) {
				$sth->bindValue(':key_pem','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='pass' ) {
				$sth->bindValue(':pass','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valido_desde' ) {
				$sth->bindValue(':valido_desde','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valido_hasta' ) {
				$sth->bindValue(':valido_hasta','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='es_default' ) {
				$sth->bindValue(':es_default','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['fk_razon_social']='';
			$obj['nombre_comercial_empresa']='';
			$obj['no_serie']='';
			$obj['cer_pem']='';
			$obj['key_pem']='';
			$obj['pass']='';
			$obj['valido_desde']='';
			$obj['valido_hasta']='';
			$obj['es_default']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT certificado.id, certificado.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social, certificado.no_serie, certificado.cer_pem, certificado.key_pem, certificado.pass, certificado.valido_desde, certificado.valido_hasta, certificado.es_default
 FROM facturacion_certificados AS certificado
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = certificado.fk_razon_social
  WHERE certificado.id=:id';
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
		
		return $modelos[0];			
	}
	
	function guardar( $datos ){
	
		$esNuevo=( empty( $datos['id'] ) )? true : false;			
		$strCampos='';
		
		//--------------------------------------------
		// CAMPOS A GUARDAR
		 
		if ( isset( $datos['fk_razon_social'] ) ){
			$strCampos .= ' fk_razon_social=:fk_razon_social, ';
		} 
		if ( isset( $datos['no_serie'] ) ){
			$strCampos .= ' no_serie=:no_serie, ';
		} 
		if ( isset( $datos['cer_pem'] ) ){
			$strCampos .= ' cer_pem=:cer_pem, ';
		} 
		if ( isset( $datos['key_pem'] ) ){
			$strCampos .= ' key_pem=:key_pem, ';
		} 
		if ( isset( $datos['pass'] ) ){
			$strCampos .= ' pass=:pass, ';
		} 
		if ( isset( $datos['valido_desde'] ) ){
			$strCampos .= ' valido_desde=:valido_desde, ';
		} 
		if ( isset( $datos['valido_hasta'] ) ){
			$strCampos .= ' valido_hasta=:valido_hasta, ';
		} 
		if ( isset( $datos['es_default'] ) ){
			$strCampos .= ' es_default=:es_default, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Certificado Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Certificado Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['fk_razon_social'] ) ){
			$sth->bindValue(':fk_razon_social', $datos['fk_razon_social'] );
		}
		if  ( isset( $datos['no_serie'] ) ){
			$sth->bindValue(':no_serie', $datos['no_serie'] );
		}
		if  ( isset( $datos['cer_pem'] ) ){
			$sth->bindValue(':cer_pem', $datos['cer_pem'] );
		}
		if  ( isset( $datos['key_pem'] ) ){
			$sth->bindValue(':key_pem', $datos['key_pem'] );
		}
		if  ( isset( $datos['pass'] ) ){
			$sth->bindValue(':pass', $datos['pass'] );
		}
		if  ( isset( $datos['valido_desde'] ) ){
			$sth->bindValue(':valido_desde', $datos['valido_desde'] );
		}
		if  ( isset( $datos['valido_hasta'] ) ){
			$sth->bindValue(':valido_hasta', $datos['valido_hasta'] );
		}
		if  ( isset( $datos['es_default'] ) ){
			$sth->bindValue(':es_default', $datos['es_default'] );
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
		
		
		
		
		$obj=$this->obtener( $idObj );
		return array(
			'success'=>true,
			'datos'=>$obj,
			'msg'=>$msg
		);
		
	}
}
?>