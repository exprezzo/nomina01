<?php
class percepcion_nominaModelo extends Modelo{	
	var $tabla='nomina_percepciones';
	var $pk='id';
	var $campos= array('id', 'fk_TipoPercepcion', 'descripcion_tipo_percepcion', 'Clave', 'Concepto', 'ImporteGravado', 'ImporteExcento', 'TipoPercepcion', 'fk_nomina');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' percepcion_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoPercepcion' ) {
					$filtros .= ' percepcion_nomina.fk_TipoPercepcion like :fk_TipoPercepcion OR ';
				} 
				if ( $filtro['dataKey']=='descripcion_tipo_percepcion' ) {
					$filtros .= ' tipo_percepcion0.descripcion like :descripcion_tipo_percepcion OR ';
				} 
				if ( $filtro['dataKey']=='Clave' ) {
					$filtros .= ' percepcion_nomina.Clave like :Clave OR ';
				} 
				if ( $filtro['dataKey']=='Concepto' ) {
					$filtros .= ' percepcion_nomina.Concepto like :Concepto OR ';
				} 
				if ( $filtro['dataKey']=='ImporteGravado' ) {
					$filtros .= ' percepcion_nomina.ImporteGravado like :ImporteGravado OR ';
				} 
				if ( $filtro['dataKey']=='ImporteExcento' ) {
					$filtros .= ' percepcion_nomina.ImporteExcento like :ImporteExcento OR ';
				} 
				if ( $filtro['dataKey']=='TipoPercepcion' ) {
					$filtros .= ' percepcion_nomina.TipoPercepcion like :TipoPercepcion OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' percepcion_nomina.fk_nomina like :fk_nomina OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_tipo_percepcion AS tipo_percepcion0 ON tipo_percepcion0.id = percepcion_nomina.fk_TipoPercepcion';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' percepcion_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoPercepcion' ) {
				$sth->bindValue(':fk_TipoPercepcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_percepcion' ) {
				$sth->bindValue(':descripcion_tipo_percepcion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Clave' ) {
				$sth->bindValue(':Clave','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Concepto' ) {
				$sth->bindValue(':Concepto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImporteGravado' ) {
				$sth->bindValue(':ImporteGravado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImporteExcento' ) {
				$sth->bindValue(':ImporteExcento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoPercepcion' ) {
				$sth->bindValue(':TipoPercepcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_nomina' ) {
				$sth->bindValue(':fk_nomina','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT percepcion_nomina.id, percepcion_nomina.fk_TipoPercepcion, tipo_percepcion0.descripcion AS descripcion_fk_TipoPercepcion, percepcion_nomina.Clave, percepcion_nomina.Concepto, percepcion_nomina.ImporteGravado, percepcion_nomina.ImporteExcento, percepcion_nomina.TipoPercepcion, percepcion_nomina.fk_nomina FROM '.$this->tabla.' percepcion_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT percepcion_nomina.id, percepcion_nomina.fk_TipoPercepcion, tipo_percepcion0.descripcion AS descripcion_fk_TipoPercepcion, percepcion_nomina.Clave, percepcion_nomina.Concepto, percepcion_nomina.ImporteGravado, percepcion_nomina.ImporteExcento, percepcion_nomina.TipoPercepcion, percepcion_nomina.fk_nomina FROM '.$this->tabla.' percepcion_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='fk_TipoPercepcion' ) {
				$sth->bindValue(':fk_TipoPercepcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_percepcion' ) {
				$sth->bindValue(':descripcion_tipo_percepcion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Clave' ) {
				$sth->bindValue(':Clave','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Concepto' ) {
				$sth->bindValue(':Concepto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImporteGravado' ) {
				$sth->bindValue(':ImporteGravado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImporteExcento' ) {
				$sth->bindValue(':ImporteExcento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoPercepcion' ) {
				$sth->bindValue(':TipoPercepcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_nomina' ) {
				$sth->bindValue(':fk_nomina','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['fk_TipoPercepcion']='';
			$obj['descripcion_tipo_percepcion']='';
			$obj['Clave']='';
			$obj['Concepto']='';
			$obj['ImporteGravado']='';
			$obj['ImporteExcento']='';
			$obj['TipoPercepcion']='';
			$obj['fk_nomina']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT percepcion_nomina.id, percepcion_nomina.fk_TipoPercepcion, tipo_percepcion0.descripcion AS descripcion_fk_TipoPercepcion, percepcion_nomina.Clave, percepcion_nomina.Concepto, percepcion_nomina.ImporteGravado, percepcion_nomina.ImporteExcento, percepcion_nomina.TipoPercepcion, percepcion_nomina.fk_nomina
 FROM nomina_percepciones AS percepcion_nomina
 LEFT JOIN nomina_tipo_percepcion AS tipo_percepcion0 ON tipo_percepcion0.id = percepcion_nomina.fk_TipoPercepcion
  WHERE percepcion_nomina.id=:id';
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
		 
		if ( isset( $datos['fk_TipoPercepcion'] ) ){
			$strCampos .= ' fk_TipoPercepcion=:fk_TipoPercepcion, ';
		} 
		if ( isset( $datos['Clave'] ) ){
			$strCampos .= ' Clave=:Clave, ';
		} 
		if ( isset( $datos['Concepto'] ) ){
			$strCampos .= ' Concepto=:Concepto, ';
		} 
		if ( isset( $datos['ImporteGravado'] ) ){
			$strCampos .= ' ImporteGravado=:ImporteGravado, ';
		} 
		if ( isset( $datos['ImporteExcento'] ) ){
			$strCampos .= ' ImporteExcento=:ImporteExcento, ';
		} 
		if ( isset( $datos['TipoPercepcion'] ) ){
			$strCampos .= ' TipoPercepcion=:TipoPercepcion, ';
		} 
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Percepcion Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Percepcion Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['fk_TipoPercepcion'] ) ){
			$sth->bindValue(':fk_TipoPercepcion', $datos['fk_TipoPercepcion'] );
		}
		if  ( isset( $datos['Clave'] ) ){
			$sth->bindValue(':Clave', $datos['Clave'] );
		}
		if  ( isset( $datos['Concepto'] ) ){
			$sth->bindValue(':Concepto', $datos['Concepto'] );
		}
		if  ( isset( $datos['ImporteGravado'] ) ){
			$sth->bindValue(':ImporteGravado', $datos['ImporteGravado'] );
		}
		if  ( isset( $datos['ImporteExcento'] ) ){
			$sth->bindValue(':ImporteExcento', $datos['ImporteExcento'] );
		}
		if  ( isset( $datos['TipoPercepcion'] ) ){
			$sth->bindValue(':TipoPercepcion', $datos['TipoPercepcion'] );
		}
		if  ( isset( $datos['fk_nomina'] ) ){
			$sth->bindValue(':fk_nomina', $datos['fk_nomina'] );
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