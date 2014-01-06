<?php
class arbolModelo extends Modelo{	
	var $tabla='mptt';
	var $pk='id';
	var $campos= array('id', 'title', 'lft', 'rgt', 'parent', 'title_arbol');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' arbol.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='title' ) {
					$filtros .= ' arbol.title like :title OR ';
				} 
				if ( $filtro['dataKey']=='lft' ) {
					$filtros .= ' arbol.lft like :lft OR ';
				} 
				if ( $filtro['dataKey']=='rgt' ) {
					$filtros .= ' arbol.rgt like :rgt OR ';
				} 
				if ( $filtro['dataKey']=='parent' ) {
					$filtros .= ' arbol.parent like :parent OR ';
				} 
				if ( $filtro['dataKey']=='title_arbol' ) {
					$filtros .= ' arbol0.title like :title_arbol OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN mptt AS arbol0 ON arbol0.id = arbol.parent';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' arbol '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='title' ) {
				$sth->bindValue(':title','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='lft' ) {
				$sth->bindValue(':lft','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='rgt' ) {
				$sth->bindValue(':rgt','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='parent' ) {
				$sth->bindValue(':parent','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='title_arbol' ) {
				$sth->bindValue(':title_arbol', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT arbol.id, arbol.title, arbol.lft, arbol.rgt, arbol.parent, arbol0.title AS title_parent FROM '.$this->tabla.' arbol '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT arbol.id, arbol.title, arbol.lft, arbol.rgt, arbol.parent, arbol0.title AS title_parent FROM '.$this->tabla.' arbol '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='title' ) {
				$sth->bindValue(':title','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='lft' ) {
				$sth->bindValue(':lft','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='rgt' ) {
				$sth->bindValue(':rgt','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='parent' ) {
				$sth->bindValue(':parent','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='title_arbol' ) {
				$sth->bindValue(':title_arbol', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['title']='';
			$obj['lft']='';
			$obj['rgt']='';
			$obj['parent']='';
			$obj['title_arbol']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT arbol.id, arbol.title, arbol.lft, arbol.rgt, arbol.parent, arbol0.title AS title_parent
 FROM mptt AS arbol
 LEFT JOIN mptt AS arbol0 ON arbol0.id = arbol.parent
  WHERE arbol.id=:id';
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
		 
		if ( isset( $datos['title'] ) ){
			$strCampos .= ' title=:title, ';
		} 
		if ( isset( $datos['lft'] ) ){
			$strCampos .= ' lft=:lft, ';
		} 
		if ( isset( $datos['rgt'] ) ){
			$strCampos .= ' rgt=:rgt, ';
		} 
		if ( isset( $datos['parent'] ) ){
			$strCampos .= ' parent=:parent, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Nodo Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Nodo Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['title'] ) ){
			$sth->bindValue(':title', $datos['title'] );
		}
		if  ( isset( $datos['lft'] ) ){
			$sth->bindValue(':lft', $datos['lft'] );
		}
		if  ( isset( $datos['rgt'] ) ){
			$sth->bindValue(':rgt', $datos['rgt'] );
		}
		if  ( isset( $datos['parent'] ) ){
			$sth->bindValue(':parent', $datos['parent'] );
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