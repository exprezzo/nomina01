<?php
class deduccion_nominaModelo extends Modelo{	
	var $tabla='nomina_deducciones';
	var $pk='id';
	var $campos= array('id', 'fk_TipoDeduccion', 'descripcion_tipo_deduccion', 'TipoDeduccion', 'Clave', 'Concepto', 'ImporteGravado', 'ImporteExcento', 'fk_nomina');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' deduccion_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoDeduccion' ) {
					$filtros .= ' deduccion_nomina.fk_TipoDeduccion like :fk_TipoDeduccion OR ';
				} 
				if ( $filtro['dataKey']=='descripcion_tipo_deduccion' ) {
					$filtros .= ' tipo_deduccion0.descripcion like :descripcion_tipo_deduccion OR ';
				} 
				if ( $filtro['dataKey']=='TipoDeduccion' ) {
					$filtros .= ' deduccion_nomina.TipoDeduccion like :TipoDeduccion OR ';
				} 
				if ( $filtro['dataKey']=='Clave' ) {
					$filtros .= ' deduccion_nomina.Clave like :Clave OR ';
				} 
				if ( $filtro['dataKey']=='Concepto' ) {
					$filtros .= ' deduccion_nomina.Concepto like :Concepto OR ';
				} 
				if ( $filtro['dataKey']=='ImporteGravado' ) {
					$filtros .= ' deduccion_nomina.ImporteGravado like :ImporteGravado OR ';
				} 
				if ( $filtro['dataKey']=='ImporteExcento' ) {
					$filtros .= ' deduccion_nomina.ImporteExcento like :ImporteExcento OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' deduccion_nomina.fk_nomina like :fk_nomina OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_tipo_deduccion AS tipo_deduccion0 ON tipo_deduccion0.id = deduccion_nomina.fk_TipoDeduccion';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' deduccion_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoDeduccion' ) {
				$sth->bindValue(':fk_TipoDeduccion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_deduccion' ) {
				$sth->bindValue(':descripcion_tipo_deduccion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoDeduccion' ) {
				$sth->bindValue(':TipoDeduccion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT deduccion_nomina.id, deduccion_nomina.fk_TipoDeduccion, tipo_deduccion0.descripcion AS descripcion_fk_TipoDeduccion, deduccion_nomina.TipoDeduccion, deduccion_nomina.Clave, deduccion_nomina.Concepto, deduccion_nomina.ImporteGravado, deduccion_nomina.ImporteExcento, deduccion_nomina.fk_nomina FROM '.$this->tabla.' deduccion_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT deduccion_nomina.id, deduccion_nomina.fk_TipoDeduccion, tipo_deduccion0.descripcion AS descripcion_fk_TipoDeduccion, deduccion_nomina.TipoDeduccion, deduccion_nomina.Clave, deduccion_nomina.Concepto, deduccion_nomina.ImporteGravado, deduccion_nomina.ImporteExcento, deduccion_nomina.fk_nomina FROM '.$this->tabla.' deduccion_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='fk_TipoDeduccion' ) {
				$sth->bindValue(':fk_TipoDeduccion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_deduccion' ) {
				$sth->bindValue(':descripcion_tipo_deduccion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoDeduccion' ) {
				$sth->bindValue(':TipoDeduccion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['fk_TipoDeduccion']='';
			$obj['descripcion_tipo_deduccion']='';
			$obj['TipoDeduccion']='';
			$obj['Clave']='';
			$obj['Concepto']='';
			$obj['ImporteGravado']='';
			$obj['ImporteExcento']='';
			$obj['fk_nomina']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT deduccion_nomina.id, deduccion_nomina.fk_TipoDeduccion, tipo_deduccion0.descripcion AS descripcion_fk_TipoDeduccion, deduccion_nomina.TipoDeduccion, deduccion_nomina.Clave, deduccion_nomina.Concepto, deduccion_nomina.ImporteGravado, deduccion_nomina.ImporteExcento, deduccion_nomina.fk_nomina
 FROM nomina_deducciones AS deduccion_nomina
 LEFT JOIN nomina_tipo_deduccion AS tipo_deduccion0 ON tipo_deduccion0.id = deduccion_nomina.fk_TipoDeduccion
  WHERE deduccion_nomina.id=:id';
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
		 
		if ( isset( $datos['fk_TipoDeduccion'] ) ){
			$strCampos .= ' fk_TipoDeduccion=:fk_TipoDeduccion, ';
		} 
		if ( isset( $datos['TipoDeduccion'] ) ){
			$strCampos .= ' TipoDeduccion=:TipoDeduccion, ';
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
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Deducción Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Deducción Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['fk_TipoDeduccion'] ) ){
			$sth->bindValue(':fk_TipoDeduccion', $datos['fk_TipoDeduccion'] );
		}
		if  ( isset( $datos['TipoDeduccion'] ) ){
			$sth->bindValue(':TipoDeduccion', $datos['TipoDeduccion'] );
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