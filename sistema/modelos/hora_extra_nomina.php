<?php
class hora_extra_nominaModelo extends Modelo{	
	var $tabla='nomina_horas_extra';
	var $pk='id';
	var $campos= array('id', 'Dias', 'TipoHoras', 'fk_TipoHoras', 'nombre_tipo_hora', 'HorasExtra', 'ImportePagado', 'fk_nomina');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' hora_extra_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='Dias' ) {
					$filtros .= ' hora_extra_nomina.Dias like :Dias OR ';
				} 
				if ( $filtro['dataKey']=='TipoHoras' ) {
					$filtros .= ' hora_extra_nomina.TipoHoras like :TipoHoras OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoHoras' ) {
					$filtros .= ' hora_extra_nomina.fk_TipoHoras like :fk_TipoHoras OR ';
				} 
				if ( $filtro['dataKey']=='nombre_tipo_hora' ) {
					$filtros .= ' tipo_hora0.nombre like :nombre_tipo_hora OR ';
				} 
				if ( $filtro['dataKey']=='HorasExtra' ) {
					$filtros .= ' hora_extra_nomina.HorasExtra like :HorasExtra OR ';
				} 
				if ( $filtro['dataKey']=='ImportePagado' ) {
					$filtros .= ' hora_extra_nomina.ImportePagado like :ImportePagado OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' hora_extra_nomina.fk_nomina like :fk_nomina OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_tipo_horas AS tipo_hora0 ON tipo_hora0.id = hora_extra_nomina.fk_TipoHoras';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' hora_extra_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='Dias' ) {
				$sth->bindValue(':Dias','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoHoras' ) {
				$sth->bindValue(':TipoHoras','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoHoras' ) {
				$sth->bindValue(':fk_TipoHoras','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_hora' ) {
				$sth->bindValue(':nombre_tipo_hora', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='HorasExtra' ) {
				$sth->bindValue(':HorasExtra','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImportePagado' ) {
				$sth->bindValue(':ImportePagado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT hora_extra_nomina.id, hora_extra_nomina.Dias, hora_extra_nomina.TipoHoras, hora_extra_nomina.fk_TipoHoras, tipo_hora0.nombre AS nombre_fk_TipoHoras, hora_extra_nomina.HorasExtra, hora_extra_nomina.ImportePagado, hora_extra_nomina.fk_nomina FROM '.$this->tabla.' hora_extra_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT hora_extra_nomina.id, hora_extra_nomina.Dias, hora_extra_nomina.TipoHoras, hora_extra_nomina.fk_TipoHoras, tipo_hora0.nombre AS nombre_fk_TipoHoras, hora_extra_nomina.HorasExtra, hora_extra_nomina.ImportePagado, hora_extra_nomina.fk_nomina FROM '.$this->tabla.' hora_extra_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='Dias' ) {
				$sth->bindValue(':Dias','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='TipoHoras' ) {
				$sth->bindValue(':TipoHoras','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoHoras' ) {
				$sth->bindValue(':fk_TipoHoras','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_hora' ) {
				$sth->bindValue(':nombre_tipo_hora', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='HorasExtra' ) {
				$sth->bindValue(':HorasExtra','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='ImportePagado' ) {
				$sth->bindValue(':ImportePagado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['Dias']='';
			$obj['TipoHoras']='';
			$obj['fk_TipoHoras']='';
			$obj['nombre_tipo_hora']='';
			$obj['HorasExtra']='';
			$obj['ImportePagado']='';
			$obj['fk_nomina']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT hora_extra_nomina.id, hora_extra_nomina.Dias, hora_extra_nomina.TipoHoras, hora_extra_nomina.fk_TipoHoras, tipo_hora0.nombre AS nombre_fk_TipoHoras, hora_extra_nomina.HorasExtra, hora_extra_nomina.ImportePagado, hora_extra_nomina.fk_nomina
 FROM nomina_horas_extra AS hora_extra_nomina
 LEFT JOIN nomina_tipo_horas AS tipo_hora0 ON tipo_hora0.id = hora_extra_nomina.fk_TipoHoras
  WHERE hora_extra_nomina.id=:id';
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
		 
		if ( isset( $datos['Dias'] ) ){
			$strCampos .= ' Dias=:Dias, ';
		} 
		if ( isset( $datos['TipoHoras'] ) ){
			$strCampos .= ' TipoHoras=:TipoHoras, ';
		} 
		if ( isset( $datos['fk_TipoHoras'] ) ){
			$strCampos .= ' fk_TipoHoras=:fk_TipoHoras, ';
		} 
		if ( isset( $datos['HorasExtra'] ) ){
			$strCampos .= ' HorasExtra=:HorasExtra, ';
		} 
		if ( isset( $datos['ImportePagado'] ) ){
			$strCampos .= ' ImportePagado=:ImportePagado, ';
		} 
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Hora Extra Creada';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Hora Extra Actualizada';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['Dias'] ) ){
			$sth->bindValue(':Dias', $datos['Dias'] );
		}
		if  ( isset( $datos['TipoHoras'] ) ){
			$sth->bindValue(':TipoHoras', $datos['TipoHoras'] );
		}
		if  ( isset( $datos['fk_TipoHoras'] ) ){
			$sth->bindValue(':fk_TipoHoras', $datos['fk_TipoHoras'] );
		}
		if  ( isset( $datos['HorasExtra'] ) ){
			$sth->bindValue(':HorasExtra', $datos['HorasExtra'] );
		}
		if  ( isset( $datos['ImportePagado'] ) ){
			$sth->bindValue(':ImportePagado', $datos['ImportePagado'] );
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