<?php
class impuestoModelo extends Modelo{	
	var $tabla='nomina_impuesto';
	var $pk='id';
	var $campos= array('id', 'nombre', 'tasa', 'fk_naturaleza', 'nombre_tipo_de_impuesto', 'detalles');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' impuesto.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='nombre' ) {
					$filtros .= ' impuesto.nombre like :nombre OR ';
				} 
				if ( $filtro['dataKey']=='tasa' ) {
					$filtros .= ' impuesto.tasa like :tasa OR ';
				} 
				if ( $filtro['dataKey']=='fk_naturaleza' ) {
					$filtros .= ' impuesto.fk_naturaleza like :fk_naturaleza OR ';
				} 
				if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
					$filtros .= ' tipo_de_impuesto0.nombre like :nombre_tipo_de_impuesto OR ';
				} 
				if ( $filtro['dataKey']=='detalles' ) {
					$filtros .= ' impuesto.detalles like :detalles OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_naturaleza_impuesto AS tipo_de_impuesto0 ON tipo_de_impuesto0.id = impuesto.fk_naturaleza';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' impuesto '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='tasa' ) {
				$sth->bindValue(':tasa','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_naturaleza' ) {
				$sth->bindValue(':fk_naturaleza','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
				$sth->bindValue(':nombre_tipo_de_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='detalles' ) {
				$sth->bindValue(':detalles','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT impuesto.id, impuesto.nombre, impuesto.tasa, impuesto.fk_naturaleza, tipo_de_impuesto0.nombre AS nombre_fk_naturaleza, impuesto.detalles FROM '.$this->tabla.' impuesto '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT impuesto.id, impuesto.nombre, impuesto.tasa, impuesto.fk_naturaleza, tipo_de_impuesto0.nombre AS nombre_fk_naturaleza, impuesto.detalles FROM '.$this->tabla.' impuesto '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='tasa' ) {
				$sth->bindValue(':tasa','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_naturaleza' ) {
				$sth->bindValue(':fk_naturaleza','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
				$sth->bindValue(':nombre_tipo_de_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='detalles' ) {
				$sth->bindValue(':detalles','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['tasa']='';
			$obj['fk_naturaleza']='';
			$obj['nombre_tipo_de_impuesto']='';
			$obj['detalles']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT impuesto.id, impuesto.nombre, impuesto.tasa, impuesto.fk_naturaleza, tipo_de_impuesto0.nombre AS nombre_fk_naturaleza, impuesto.detalles
 FROM nomina_impuesto AS impuesto
 LEFT JOIN nomina_naturaleza_impuesto AS tipo_de_impuesto0 ON tipo_de_impuesto0.id = impuesto.fk_naturaleza
  WHERE impuesto.id=:id';
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
		if ( isset( $datos['tasa'] ) ){
			$strCampos .= ' tasa=:tasa, ';
		} 
		if ( isset( $datos['fk_naturaleza'] ) ){
			$strCampos .= ' fk_naturaleza=:fk_naturaleza, ';
		} 
		if ( isset( $datos['detalles'] ) ){
			$strCampos .= ' detalles=:detalles, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Impuesto Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Impuesto Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['nombre'] ) ){
			$sth->bindValue(':nombre', $datos['nombre'] );
		}
		if  ( isset( $datos['tasa'] ) ){
			$sth->bindValue(':tasa', $datos['tasa'] );
		}
		if  ( isset( $datos['fk_naturaleza'] ) ){
			$sth->bindValue(':fk_naturaleza', $datos['fk_naturaleza'] );
		}
		if  ( isset( $datos['detalles'] ) ){
			$sth->bindValue(':detalles', $datos['detalles'] );
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