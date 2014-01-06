<?php
class regimenModelo extends Modelo{	
	var $tabla='facturacion_regimenes';
	var $pk='id';
	var $campos= array('id', 'regimen', 'fk_razon_social', 'nombre_comercial_empresa');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' regimen.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='regimen' ) {
					$filtros .= ' regimen.regimen like :regimen OR ';
				} 
				if ( $filtro['dataKey']=='fk_razon_social' ) {
					$filtros .= ' regimen.fk_razon_social like :fk_razon_social OR ';
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
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = regimen.fk_razon_social';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' regimen '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='regimen' ) {
				$sth->bindValue(':regimen','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT regimen.id, regimen.regimen, regimen.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social FROM '.$this->tabla.' regimen '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT regimen.id, regimen.regimen, regimen.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social FROM '.$this->tabla.' regimen '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='regimen' ) {
				$sth->bindValue(':regimen','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['regimen']='';
			$obj['fk_razon_social']='';
			$obj['nombre_comercial_empresa']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT regimen.id, regimen.regimen, regimen.fk_razon_social, empresa0.nombre_comercial AS nombre_comercial_fk_razon_social
 FROM facturacion_regimenes AS regimen
 LEFT JOIN facturacion_razones_sociales AS empresa0 ON empresa0.id = regimen.fk_razon_social
  WHERE regimen.id=:id';
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
			throw new Exception("El identificador est� duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		return $modelos[0];			
	}
	
	function guardar( $datos ){
	
		$esNuevo=( empty( $datos['id'] ) )? true : false;			
		$strCampos='';
		
		//--------------------------------------------
		// CAMPOS A GUARDAR
		 
		if ( isset( $datos['regimen'] ) ){
			$strCampos .= ' regimen=:regimen, ';
		} 
		if ( isset( $datos['fk_razon_social'] ) ){
			$strCampos .= ' fk_razon_social=:fk_razon_social, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Régimen Fiscal Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Régimen Fiscal Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['regimen'] ) ){
			$sth->bindValue(':regimen', $datos['regimen'] );
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