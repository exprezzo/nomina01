<?php
class municipioModelo extends Modelo{	
	var $tabla='system_ubicacion_municipios';
	var $pk='id';
	var $campos= array('id', 'nombre', 'clave_sepomex', 'fk_estado', 'nombre_estado');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' municipio.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='nombre' ) {
					$filtros .= ' municipio.nombre like :nombre OR ';
				} 
				if ( $filtro['dataKey']=='clave_sepomex' ) {
					$filtros .= ' municipio.clave_sepomex like :clave_sepomex OR ';
				} 
				if ( $filtro['dataKey']=='fk_estado' ) {
					$filtros .= ' municipio.fk_estado like :fk_estado OR ';
				} 
				if ( $filtro['dataKey']=='nombre_estado' ) {
					$filtros .= ' estado0.nombre like :nombre_estado OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN system_ubicacion_estados AS estado0 ON estado0.id = municipio.fk_estado';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' municipio '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='clave_sepomex' ) {
				$sth->bindValue(':clave_sepomex','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT municipio.id, municipio.nombre, municipio.clave_sepomex, municipio.fk_estado, estado0.nombre AS nombre_fk_estado FROM '.$this->tabla.' municipio '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT municipio.id, municipio.nombre, municipio.clave_sepomex, municipio.fk_estado, estado0.nombre AS nombre_fk_estado FROM '.$this->tabla.' municipio '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='clave_sepomex' ) {
				$sth->bindValue(':clave_sepomex','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['nombre']='';
			$obj['clave_sepomex']='';
			$obj['fk_estado']='';
			$obj['nombre_estado']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT municipio.id, municipio.nombre, municipio.clave_sepomex, municipio.fk_estado, estado0.nombre AS nombre_fk_estado
 FROM system_ubicacion_municipios AS municipio
 LEFT JOIN system_ubicacion_estados AS estado0 ON estado0.id = municipio.fk_estado
  WHERE municipio.id=:id';
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
		 
		if ( isset( $datos['nombre'] ) ){
			$strCampos .= ' nombre=:nombre, ';
		} 
		if ( isset( $datos['clave_sepomex'] ) ){
			$strCampos .= ' clave_sepomex=:clave_sepomex, ';
		} 
		if ( isset( $datos['fk_estado'] ) ){
			$strCampos .= ' fk_estado=:fk_estado, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Municipio Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Municipio Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['nombre'] ) ){
			$sth->bindValue(':nombre', $datos['nombre'] );
		}
		if  ( isset( $datos['clave_sepomex'] ) ){
			$sth->bindValue(':clave_sepomex', $datos['clave_sepomex'] );
		}
		if  ( isset( $datos['fk_estado'] ) ){
			$sth->bindValue(':fk_estado', $datos['fk_estado'] );
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