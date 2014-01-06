<?php
class incapacidadModelo extends Modelo{	
	var $tabla='nomina_incapacidades';
	var $pk='id';
	var $campos= array('id', 'DiasIncapacidad', 'fk_TipoIncapacidad', 'descripcion_tipo_incapacidad', 'TipoIncapacidad', 'Descuento', 'fk_nomina');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' incapacidad.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='DiasIncapacidad' ) {
					$filtros .= ' incapacidad.DiasIncapacidad like :DiasIncapacidad OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoIncapacidad' ) {
					$filtros .= ' incapacidad.fk_TipoIncapacidad like :fk_TipoIncapacidad OR ';
				} 
				if ( $filtro['dataKey']=='descripcion_tipo_incapacidad' ) {
					$filtros .= ' tipo_incapacidad0.descripcion like :descripcion_tipo_incapacidad OR ';
				} 
				if ( $filtro['dataKey']=='TipoIncapacidad' ) {
					$filtros .= ' incapacidad.TipoIncapacidad like :TipoIncapacidad OR ';
				} 
				if ( $filtro['dataKey']=='Descuento' ) {
					$filtros .= ' incapacidad.Descuento like :Descuento OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' incapacidad.fk_nomina like :fk_nomina OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_tipo_incapacidad AS tipo_incapacidad0 ON tipo_incapacidad0.id = incapacidad.fk_TipoIncapacidad';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' incapacidad '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='DiasIncapacidad' ) {
				$sth->bindValue(':DiasIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoIncapacidad' ) {
				$sth->bindValue(':fk_TipoIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_incapacidad' ) {
				$sth->bindValue(':descripcion_tipo_incapacidad', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoIncapacidad' ) {
				$sth->bindValue(':TipoIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Descuento' ) {
				$sth->bindValue(':Descuento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT incapacidad.id, incapacidad.DiasIncapacidad, incapacidad.fk_TipoIncapacidad, tipo_incapacidad0.descripcion AS descripcion_fk_TipoIncapacidad, incapacidad.TipoIncapacidad, incapacidad.Descuento, incapacidad.fk_nomina FROM '.$this->tabla.' incapacidad '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT incapacidad.id, incapacidad.DiasIncapacidad, incapacidad.fk_TipoIncapacidad, tipo_incapacidad0.descripcion AS descripcion_fk_TipoIncapacidad, incapacidad.TipoIncapacidad, incapacidad.Descuento, incapacidad.fk_nomina FROM '.$this->tabla.' incapacidad '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='DiasIncapacidad' ) {
				$sth->bindValue(':DiasIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoIncapacidad' ) {
				$sth->bindValue(':fk_TipoIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_tipo_incapacidad' ) {
				$sth->bindValue(':descripcion_tipo_incapacidad', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoIncapacidad' ) {
				$sth->bindValue(':TipoIncapacidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Descuento' ) {
				$sth->bindValue(':Descuento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['DiasIncapacidad']='';
			$obj['fk_TipoIncapacidad']='';
			$obj['descripcion_tipo_incapacidad']='';
			$obj['TipoIncapacidad']='';
			$obj['Descuento']='';
			$obj['fk_nomina']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT incapacidad.id, incapacidad.DiasIncapacidad, incapacidad.fk_TipoIncapacidad, tipo_incapacidad0.descripcion AS descripcion_fk_TipoIncapacidad, incapacidad.TipoIncapacidad, incapacidad.Descuento, incapacidad.fk_nomina
 FROM nomina_incapacidades AS incapacidad
 LEFT JOIN nomina_tipo_incapacidad AS tipo_incapacidad0 ON tipo_incapacidad0.id = incapacidad.fk_TipoIncapacidad
  WHERE incapacidad.id=:id';
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
		 
		if ( isset( $datos['DiasIncapacidad'] ) ){
			$strCampos .= ' DiasIncapacidad=:DiasIncapacidad, ';
		} 
		if ( isset( $datos['fk_TipoIncapacidad'] ) ){
			$strCampos .= ' fk_TipoIncapacidad=:fk_TipoIncapacidad, ';
		} 
		if ( isset( $datos['TipoIncapacidad'] ) ){
			$strCampos .= ' TipoIncapacidad=:TipoIncapacidad, ';
		} 
		if ( isset( $datos['Descuento'] ) ){
			$strCampos .= ' Descuento=:Descuento, ';
		} 
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Incapacidad Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Incapacidad Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['DiasIncapacidad'] ) ){
			$sth->bindValue(':DiasIncapacidad', $datos['DiasIncapacidad'] );
		}
		if  ( isset( $datos['fk_TipoIncapacidad'] ) ){
			$sth->bindValue(':fk_TipoIncapacidad', $datos['fk_TipoIncapacidad'] );
		}
		if  ( isset( $datos['TipoIncapacidad'] ) ){
			$sth->bindValue(':TipoIncapacidad', $datos['TipoIncapacidad'] );
		}
		if  ( isset( $datos['Descuento'] ) ){
			$sth->bindValue(':Descuento', $datos['Descuento'] );
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