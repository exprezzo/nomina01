<?php
class concepto_para_nominaModelo extends Modelo{	
	var $tabla='nomina_conceptos';
	var $pk='id';
	var $campos= array('id', 'nombre', 'descripcion', 'precio', 'fk_unidad', 'abreviacion_unidad_de_medida');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' concepto_para_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='nombre' ) {
					$filtros .= ' concepto_para_nomina.nombre like :nombre OR ';
				} 
				if ( $filtro['dataKey']=='descripcion' ) {
					$filtros .= ' concepto_para_nomina.descripcion like :descripcion OR ';
				} 
				if ( $filtro['dataKey']=='precio' ) {
					$filtros .= ' concepto_para_nomina.precio like :precio OR ';
				} 
				if ( $filtro['dataKey']=='fk_unidad' ) {
					$filtros .= ' concepto_para_nomina.fk_unidad like :fk_unidad OR ';
				} 
				if ( $filtro['dataKey']=='abreviacion_unidad_de_medida' ) {
					$filtros .= ' unidad_de_medida0.abreviacion like :abreviacion_unidad_de_medida OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN facturacion_um AS unidad_de_medida0 ON unidad_de_medida0.id = concepto_para_nomina.fk_unidad';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' concepto_para_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='precio' ) {
				$sth->bindValue(':precio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_unidad' ) {
				$sth->bindValue(':fk_unidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='abreviacion_unidad_de_medida' ) {
				$sth->bindValue(':abreviacion_unidad_de_medida', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT concepto_para_nomina.id, concepto_para_nomina.nombre, concepto_para_nomina.descripcion, concepto_para_nomina.precio, concepto_para_nomina.fk_unidad, unidad_de_medida0.abreviacion AS abreviacion_fk_unidad FROM '.$this->tabla.' concepto_para_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT concepto_para_nomina.id, concepto_para_nomina.nombre, concepto_para_nomina.descripcion, concepto_para_nomina.precio, concepto_para_nomina.fk_unidad, unidad_de_medida0.abreviacion AS abreviacion_fk_unidad FROM '.$this->tabla.' concepto_para_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='precio' ) {
				$sth->bindValue(':precio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_unidad' ) {
				$sth->bindValue(':fk_unidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='abreviacion_unidad_de_medida' ) {
				$sth->bindValue(':abreviacion_unidad_de_medida', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['descripcion']='';
			$obj['precio']='';
			$obj['fk_unidad']='';
			$obj['abreviacion_unidad_de_medida']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT concepto_para_nomina.id, concepto_para_nomina.nombre, concepto_para_nomina.descripcion, concepto_para_nomina.precio, concepto_para_nomina.fk_unidad, unidad_de_medida0.abreviacion AS abreviacion_fk_unidad
 FROM nomina_conceptos AS concepto_para_nomina
 LEFT JOIN facturacion_um AS unidad_de_medida0 ON unidad_de_medida0.id = concepto_para_nomina.fk_unidad
  WHERE concepto_para_nomina.id=:id';
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
		if ( isset( $datos['descripcion'] ) ){
			$strCampos .= ' descripcion=:descripcion, ';
		} 
		if ( isset( $datos['precio'] ) ){
			$strCampos .= ' precio=:precio, ';
		} 
		if ( isset( $datos['fk_unidad'] ) ){
			$strCampos .= ' fk_unidad=:fk_unidad, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Concepto Para Nomina Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Concepto Para Nomina Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['nombre'] ) ){
			$sth->bindValue(':nombre', $datos['nombre'] );
		}
		if  ( isset( $datos['descripcion'] ) ){
			$sth->bindValue(':descripcion', $datos['descripcion'] );
		}
		if  ( isset( $datos['precio'] ) ){
			$sth->bindValue(':precio', $datos['precio'] );
		}
		if  ( isset( $datos['fk_unidad'] ) ){
			$sth->bindValue(':fk_unidad', $datos['fk_unidad'] );
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