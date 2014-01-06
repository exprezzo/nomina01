<?php
class bancoModelo extends Modelo{	
	var $tabla='nomina_bancos';
	var $pk='id';
	var $campos= array('id', 'clave', 'nombre_corto', 'nombre_o_razon_social');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' banco.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='clave' ) {
					$filtros .= ' banco.clave like :clave OR ';
				} 
				if ( $filtro['dataKey']=='nombre_corto' ) {
					$filtros .= ' banco.nombre_corto like :nombre_corto OR ';
				} 
				if ( $filtro['dataKey']=='nombre_o_razon_social' ) {
					$filtros .= ' banco.nombre_o_razon_social like :nombre_o_razon_social OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' banco '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='clave' ) {
				$sth->bindValue(':clave','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_corto' ) {
				$sth->bindValue(':nombre_corto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_o_razon_social' ) {
				$sth->bindValue(':nombre_o_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT banco.id, banco.clave, banco.nombre_corto, banco.nombre_o_razon_social FROM '.$this->tabla.' banco '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT banco.id, banco.clave, banco.nombre_corto, banco.nombre_o_razon_social FROM '.$this->tabla.' banco '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='nombre_corto' ) {
				$sth->bindValue(':nombre_corto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_o_razon_social' ) {
				$sth->bindValue(':nombre_o_razon_social','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['nombre_corto']='';
			$obj['nombre_o_razon_social']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT banco.id, banco.clave, banco.nombre_corto, banco.nombre_o_razon_social
 FROM nomina_bancos AS banco
  WHERE banco.id=:id';
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
		 
		if ( isset( $datos['clave'] ) ){
			$strCampos .= ' clave=:clave, ';
		} 
		if ( isset( $datos['nombre_corto'] ) ){
			$strCampos .= ' nombre_corto=:nombre_corto, ';
		} 
		if ( isset( $datos['nombre_o_razon_social'] ) ){
			$strCampos .= ' nombre_o_razon_social=:nombre_o_razon_social, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Banco Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Banco Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['clave'] ) ){
			$sth->bindValue(':clave', $datos['clave'] );
		}
		if  ( isset( $datos['nombre_corto'] ) ){
			$sth->bindValue(':nombre_corto', $datos['nombre_corto'] );
		}
		if  ( isset( $datos['nombre_o_razon_social'] ) ){
			$sth->bindValue(':nombre_o_razon_social', $datos['nombre_o_razon_social'] );
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