<?php
class impuesto_de_nominaModelo extends Modelo{	
	var $tabla='nomina_nomina_impuesto';
	var $pk='id';
	var $campos= array('id', 'fk_impuesto', 'nombre_impuesto', 'fk_nomina', 'importe', 'tasai', 'nombre', 'fk_tipo_impuesto', 'nombre_tipo_de_impuesto');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' impuesto_de_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='fk_impuesto' ) {
					$filtros .= ' impuesto_de_nomina.fk_impuesto like :fk_impuesto OR ';
				} 
				if ( $filtro['dataKey']=='nombre_impuesto' ) {
					$filtros .= ' impuesto0.nombre like :nombre_impuesto OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' impuesto_de_nomina.fk_nomina like :fk_nomina OR ';
				} 
				if ( $filtro['dataKey']=='importe' ) {
					$filtros .= ' impuesto_de_nomina.importe like :importe OR ';
				} 
				if ( $filtro['dataKey']=='tasai' ) {
					$filtros .= ' impuesto_de_nomina.tasai like :tasai OR ';
				} 
				if ( $filtro['dataKey']=='nombre' ) {
					$filtros .= ' impuesto_de_nomina.nombre like :nombre OR ';
				} 
				if ( $filtro['dataKey']=='fk_tipo_impuesto' ) {
					$filtros .= ' impuesto_de_nomina.fk_tipo_impuesto like :fk_tipo_impuesto OR ';
				} 
				if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
					$filtros .= ' tipo_de_impuesto1.nombre like :nombre_tipo_de_impuesto OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_impuesto AS impuesto0 ON impuesto0.id = impuesto_de_nomina.fk_impuesto
 LEFT JOIN nomina_naturaleza_impuesto AS tipo_de_impuesto1 ON tipo_de_impuesto1.id = impuesto_de_nomina.fk_tipo_impuesto';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' impuesto_de_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_impuesto' ) {
				$sth->bindValue(':fk_impuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_impuesto' ) {
				$sth->bindValue(':nombre_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_nomina' ) {
				$sth->bindValue(':fk_nomina','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='importe' ) {
				$sth->bindValue(':importe','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='tasai' ) {
				$sth->bindValue(':tasai','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_tipo_impuesto' ) {
				$sth->bindValue(':fk_tipo_impuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
				$sth->bindValue(':nombre_tipo_de_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT impuesto_de_nomina.id, impuesto_de_nomina.fk_impuesto, impuesto0.nombre AS nombre_fk_impuesto, impuesto_de_nomina.fk_nomina, impuesto_de_nomina.importe, impuesto_de_nomina.tasai, impuesto_de_nomina.nombre, impuesto_de_nomina.fk_tipo_impuesto, tipo_de_impuesto1.nombre AS nombre_fk_tipo_impuesto FROM '.$this->tabla.' impuesto_de_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT impuesto_de_nomina.id, impuesto_de_nomina.fk_impuesto, impuesto0.nombre AS nombre_fk_impuesto, impuesto_de_nomina.fk_nomina, impuesto_de_nomina.importe, impuesto_de_nomina.tasai, impuesto_de_nomina.nombre, impuesto_de_nomina.fk_tipo_impuesto, tipo_de_impuesto1.nombre AS nombre_fk_tipo_impuesto FROM '.$this->tabla.' impuesto_de_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='fk_impuesto' ) {
				$sth->bindValue(':fk_impuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_impuesto' ) {
				$sth->bindValue(':nombre_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_nomina' ) {
				$sth->bindValue(':fk_nomina','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='importe' ) {
				$sth->bindValue(':importe','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='tasai' ) {
				$sth->bindValue(':tasai','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_tipo_impuesto' ) {
				$sth->bindValue(':fk_tipo_impuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_impuesto' ) {
				$sth->bindValue(':nombre_tipo_de_impuesto', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['fk_impuesto']='';
			$obj['nombre_impuesto']='';
			$obj['fk_nomina']='';
			$obj['importe']='';
			$obj['tasai']='';
			$obj['nombre']='';
			$obj['fk_tipo_impuesto']='';
			$obj['nombre_tipo_de_impuesto']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT impuesto_de_nomina.id, impuesto_de_nomina.fk_impuesto, impuesto0.nombre AS nombre_fk_impuesto, impuesto_de_nomina.fk_nomina, impuesto_de_nomina.importe, impuesto_de_nomina.tasai, impuesto_de_nomina.nombre, impuesto_de_nomina.fk_tipo_impuesto, tipo_de_impuesto1.nombre AS nombre_fk_tipo_impuesto
 FROM nomina_nomina_impuesto AS impuesto_de_nomina
 LEFT JOIN nomina_impuesto AS impuesto0 ON impuesto0.id = impuesto_de_nomina.fk_impuesto
 LEFT JOIN nomina_naturaleza_impuesto AS tipo_de_impuesto1 ON tipo_de_impuesto1.id = impuesto_de_nomina.fk_tipo_impuesto
  WHERE impuesto_de_nomina.id=:id';
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
		 
		if ( isset( $datos['fk_impuesto'] ) ){
			$strCampos .= ' fk_impuesto=:fk_impuesto, ';
		} 
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		} 
		if ( isset( $datos['importe'] ) ){
			$strCampos .= ' importe=:importe, ';
		} 
		if ( isset( $datos['tasai'] ) ){
			$strCampos .= ' tasai=:tasai, ';
		} 
		if ( isset( $datos['nombre'] ) ){
			$strCampos .= ' nombre=:nombre, ';
		} 
		if ( isset( $datos['fk_tipo_impuesto'] ) ){
			$strCampos .= ' fk_tipo_impuesto=:fk_tipo_impuesto, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Impuesto De Nomina Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Impuesto De Nomina Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['fk_impuesto'] ) ){
			$sth->bindValue(':fk_impuesto', $datos['fk_impuesto'] );
		}
		if  ( isset( $datos['fk_nomina'] ) ){
			$sth->bindValue(':fk_nomina', $datos['fk_nomina'] );
		}
		if  ( isset( $datos['importe'] ) ){
			$sth->bindValue(':importe', $datos['importe'] );
		}
		if  ( isset( $datos['tasai'] ) ){
			$sth->bindValue(':tasai', $datos['tasai'] );
		}
		if  ( isset( $datos['nombre'] ) ){
			$sth->bindValue(':nombre', $datos['nombre'] );
		}
		if  ( isset( $datos['fk_tipo_impuesto'] ) ){
			$sth->bindValue(':fk_tipo_impuesto', $datos['fk_tipo_impuesto'] );
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