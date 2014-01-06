<?php
class tipo_deduccionModelo extends Modelo{	
	var $tabla='nomina_tipo_deduccion';
	var $pk='id';
	var $campos= array('id', 'clave', 'descripcion', 'comentario');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' tipo_deduccion.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='clave' ) {
					$filtros .= ' tipo_deduccion.clave like :clave OR ';
				} 
				if ( $filtro['dataKey']=='descripcion' ) {
					$filtros .= ' tipo_deduccion.descripcion like :descripcion OR ';
				} 
				if ( $filtro['dataKey']=='comentario' ) {
					$filtros .= ' tipo_deduccion.comentario like :comentario OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' tipo_deduccion '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='clave' ) {
				$sth->bindValue(':clave','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='comentario' ) {
				$sth->bindValue(':comentario','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT tipo_deduccion.id, tipo_deduccion.clave, tipo_deduccion.descripcion, tipo_deduccion.comentario FROM '.$this->tabla.' tipo_deduccion '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT tipo_deduccion.id, tipo_deduccion.clave, tipo_deduccion.descripcion, tipo_deduccion.comentario FROM '.$this->tabla.' tipo_deduccion '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='clave' ) {
				$sth->bindValue(':clave','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='comentario' ) {
				$sth->bindValue(':comentario','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['clave']='';
			$obj['descripcion']='';
			$obj['comentario']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT tipo_deduccion.id, tipo_deduccion.clave, tipo_deduccion.descripcion, tipo_deduccion.comentario
 FROM nomina_tipo_deduccion AS tipo_deduccion
  WHERE tipo_deduccion.id=:id';
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
		 
		if ( isset( $datos['clave'] ) ){
			$strCampos .= ' clave=:clave, ';
		} 
		if ( isset( $datos['descripcion'] ) ){
			$strCampos .= ' descripcion=:descripcion, ';
		} 
		if ( isset( $datos['comentario'] ) ){
			$strCampos .= ' comentario=:comentario, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Tipo de Deducción Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Tipo de Deducción Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['clave'] ) ){
			$sth->bindValue(':clave', $datos['clave'] );
		}
		if  ( isset( $datos['descripcion'] ) ){
			$sth->bindValue(':descripcion', $datos['descripcion'] );
		}
		if  ( isset( $datos['comentario'] ) ){
			$sth->bindValue(':comentario', $datos['comentario'] );
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