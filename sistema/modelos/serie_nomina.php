<?php
class serie_nominaModelo extends Modelo{	
	var $tabla='nomina_series';
	var $pk='id';
	var $campos= array('id', 'serie', 'sig_folio', 'es_default', 'documento', 'fk_razon_social', 'nombre_comercial_empresa');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' serie_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='serie' ) {
					$filtros .= ' serie_nomina.serie like :serie OR ';
				} 
				if ( $filtro['dataKey']=='sig_folio' ) {
					$filtros .= ' serie_nomina.sig_folio like :sig_folio OR ';
				} 
				if ( $filtro['dataKey']=='es_default' ) {
					$filtros .= ' serie_nomina.es_default like :es_default OR ';
				} 
				if ( $filtro['dataKey']=='documento' ) {
					$filtros .= ' serie_nomina.documento like :documento OR ';
				} 
				if ( $filtro['dataKey']=='fk_razon_social' ) {
					$filtros .= ' serie_nomina.fk_razon_social like :fk_razon_social OR ';
				} 
				if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
					$filtros .= ' empresa0.nombre_comercial like :nombre_comercial_empresa OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = serie_nomina.fk_razon_social';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' serie_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='serie' ) {
				$sth->bindValue(':serie','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='sig_folio' ) {
				$sth->bindValue(':sig_folio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='es_default' ) {
				$sth->bindValue(':es_default','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='documento' ) {
				$sth->bindValue(':documento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_razon_social' ) {
				$sth->bindValue(':fk_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
				$sth->bindValue(':nombre_comercial_empresa', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT serie_nomina.id, serie_nomina.serie, serie_nomina.sig_folio, serie_nomina.es_default, serie_nomina.documento, serie_nomina.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social FROM '.$this->tabla.' serie_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT serie_nomina.id, serie_nomina.serie, serie_nomina.sig_folio, serie_nomina.es_default, serie_nomina.documento, serie_nomina.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social FROM '.$this->tabla.' serie_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='serie' ) {
				$sth->bindValue(':serie','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='sig_folio' ) {
				$sth->bindValue(':sig_folio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='es_default' ) {
				$sth->bindValue(':es_default','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='documento' ) {
				$sth->bindValue(':documento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_razon_social' ) {
				$sth->bindValue(':fk_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_comercial_empresa' ) {
				$sth->bindValue(':nombre_comercial_empresa', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['serie']='';
			$obj['sig_folio']='';
			$obj['es_default']='';
			$obj['documento']='';
			$obj['fk_razon_social']='';
			$obj['nombre_comercial_empresa']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT serie_nomina.id, serie_nomina.serie, serie_nomina.sig_folio, serie_nomina.es_default, serie_nomina.documento, serie_nomina.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social
 FROM nomina_series AS serie_nomina
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = serie_nomina.fk_razon_social
  WHERE serie_nomina.id=:id';
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
		 
		if ( isset( $datos['serie'] ) ){
			$strCampos .= ' serie=:serie, ';
		} 
		if ( isset( $datos['sig_folio'] ) ){
			$strCampos .= ' sig_folio=:sig_folio, ';
		} 
		if ( isset( $datos['es_default'] ) ){
			$strCampos .= ' es_default=:es_default, ';
		} 
		if ( isset( $datos['documento'] ) ){
			$strCampos .= ' documento=:documento, ';
		} 
		if ( isset( $datos['fk_razon_social'] ) ){
			$strCampos .= ' fk_razon_social=:fk_razon_social, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Serie Para Nomina Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Serie Para Nomina Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['serie'] ) ){
			$sth->bindValue(':serie', $datos['serie'] );
		}
		if  ( isset( $datos['sig_folio'] ) ){
			$sth->bindValue(':sig_folio', $datos['sig_folio'] );
		}
		if  ( isset( $datos['es_default'] ) ){
			$sth->bindValue(':es_default', $datos['es_default'] );
		}
		if  ( isset( $datos['documento'] ) ){
			$sth->bindValue(':documento', $datos['documento'] );
		}
		if  ( isset( $datos['fk_razon_social'] ) ){
			$sth->bindValue(':fk_razon_social', $datos['fk_razon_social'] );
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