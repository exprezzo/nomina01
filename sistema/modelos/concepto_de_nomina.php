<?php
class concepto_de_nominaModelo extends Modelo{	
	var $tabla='nomina_nomina_conceptos';
	var $pk='id';
	var $campos= array('id', 'cantidad', 'unidad', 'fk_um', 'nombre_unidad_de_medida', 'fk_concepto', 'nombre_concepto_para_nomina', 'descripcion', 'valorUnitario', 'importe', 'noIdentificacion', 'fk_nomina');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' concepto_de_nomina.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='cantidad' ) {
					$filtros .= ' concepto_de_nomina.cantidad like :cantidad OR ';
				} 
				if ( $filtro['dataKey']=='unidad' ) {
					$filtros .= ' concepto_de_nomina.unidad like :unidad OR ';
				} 
				if ( $filtro['dataKey']=='fk_um' ) {
					$filtros .= ' concepto_de_nomina.fk_um like :fk_um OR ';
				} 
				if ( $filtro['dataKey']=='nombre_unidad_de_medida' ) {
					$filtros .= ' unidad_de_medida0.nombre like :nombre_unidad_de_medida OR ';
				} 
				if ( $filtro['dataKey']=='fk_concepto' ) {
					$filtros .= ' concepto_de_nomina.fk_concepto like :fk_concepto OR ';
				} 
				if ( $filtro['dataKey']=='nombre_concepto_para_nomina' ) {
					$filtros .= ' concepto_para_nomina1.nombre like :nombre_concepto_para_nomina OR ';
				} 
				if ( $filtro['dataKey']=='descripcion' ) {
					$filtros .= ' concepto_de_nomina.descripcion like :descripcion OR ';
				} 
				if ( $filtro['dataKey']=='valorUnitario' ) {
					$filtros .= ' concepto_de_nomina.valorUnitario like :valorUnitario OR ';
				} 
				if ( $filtro['dataKey']=='importe' ) {
					$filtros .= ' concepto_de_nomina.importe like :importe OR ';
				} 
				if ( $filtro['dataKey']=='noIdentificacion' ) {
					$filtros .= ' concepto_de_nomina.noIdentificacion like :noIdentificacion OR ';
				} 
				if ( $filtro['dataKey']=='fk_nomina' ) {
					$filtros .= ' concepto_de_nomina.fk_nomina like :fk_nomina OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN facturacion_um AS unidad_de_medida0 ON unidad_de_medida0.id = concepto_de_nomina.fk_um
 LEFT JOIN nomina_conceptos AS concepto_para_nomina1 ON concepto_para_nomina1.id = concepto_de_nomina.fk_concepto';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' concepto_de_nomina '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='cantidad' ) {
				$sth->bindValue(':cantidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='unidad' ) {
				$sth->bindValue(':unidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_um' ) {
				$sth->bindValue(':fk_um','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_unidad_de_medida' ) {
				$sth->bindValue(':nombre_unidad_de_medida', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_concepto' ) {
				$sth->bindValue(':fk_concepto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_concepto_para_nomina' ) {
				$sth->bindValue(':nombre_concepto_para_nomina', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valorUnitario' ) {
				$sth->bindValue(':valorUnitario','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='importe' ) {
				$sth->bindValue(':importe','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noIdentificacion' ) {
				$sth->bindValue(':noIdentificacion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT concepto_de_nomina.id, concepto_de_nomina.cantidad, concepto_de_nomina.unidad, concepto_de_nomina.fk_um, unidad_de_medida0.nombre AS nombre_fk_um, concepto_de_nomina.fk_concepto, concepto_para_nomina1.nombre AS nombre_fk_concepto, concepto_de_nomina.descripcion, concepto_de_nomina.valorUnitario, concepto_de_nomina.importe, concepto_de_nomina.noIdentificacion, concepto_de_nomina.fk_nomina FROM '.$this->tabla.' concepto_de_nomina '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT concepto_de_nomina.id, concepto_de_nomina.cantidad, concepto_de_nomina.unidad, concepto_de_nomina.fk_um, unidad_de_medida0.nombre AS nombre_fk_um, concepto_de_nomina.fk_concepto, concepto_para_nomina1.nombre AS nombre_fk_concepto, concepto_de_nomina.descripcion, concepto_de_nomina.valorUnitario, concepto_de_nomina.importe, concepto_de_nomina.noIdentificacion, concepto_de_nomina.fk_nomina FROM '.$this->tabla.' concepto_de_nomina '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='cantidad' ) {
				$sth->bindValue(':cantidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='unidad' ) {
				$sth->bindValue(':unidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_um' ) {
				$sth->bindValue(':fk_um','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_unidad_de_medida' ) {
				$sth->bindValue(':nombre_unidad_de_medida', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_concepto' ) {
				$sth->bindValue(':fk_concepto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_concepto_para_nomina' ) {
				$sth->bindValue(':nombre_concepto_para_nomina', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion' ) {
				$sth->bindValue(':descripcion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='valorUnitario' ) {
				$sth->bindValue(':valorUnitario','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='importe' ) {
				$sth->bindValue(':importe','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noIdentificacion' ) {
				$sth->bindValue(':noIdentificacion','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['cantidad']='';
			$obj['unidad']='';
			$obj['fk_um']='';
			$obj['nombre_unidad_de_medida']='';
			$obj['fk_concepto']='';
			$obj['nombre_concepto_para_nomina']='';
			$obj['descripcion']='';
			$obj['valorUnitario']='';
			$obj['importe']='';
			$obj['noIdentificacion']='';
			$obj['fk_nomina']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT concepto_de_nomina.id, concepto_de_nomina.cantidad, concepto_de_nomina.unidad, concepto_de_nomina.fk_um, unidad_de_medida0.nombre AS nombre_fk_um, concepto_de_nomina.fk_concepto, concepto_para_nomina1.nombre AS nombre_fk_concepto, concepto_de_nomina.descripcion, concepto_de_nomina.valorUnitario, concepto_de_nomina.importe, concepto_de_nomina.noIdentificacion, concepto_de_nomina.fk_nomina
 FROM nomina_nomina_conceptos AS concepto_de_nomina
 LEFT JOIN facturacion_um AS unidad_de_medida0 ON unidad_de_medida0.id = concepto_de_nomina.fk_um
 LEFT JOIN nomina_conceptos AS concepto_para_nomina1 ON concepto_para_nomina1.id = concepto_de_nomina.fk_concepto
  WHERE concepto_de_nomina.id=:id';
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
		 
		if ( isset( $datos['cantidad'] ) ){
			$strCampos .= ' cantidad=:cantidad, ';
		} 
		if ( isset( $datos['unidad'] ) ){
			$strCampos .= ' unidad=:unidad, ';
		} 
		if ( isset( $datos['fk_um'] ) ){
			$strCampos .= ' fk_um=:fk_um, ';
		} 
		if ( isset( $datos['fk_concepto'] ) ){
			$strCampos .= ' fk_concepto=:fk_concepto, ';
		} 
		if ( isset( $datos['descripcion'] ) ){
			$strCampos .= ' descripcion=:descripcion, ';
		} 
		if ( isset( $datos['valorUnitario'] ) ){
			$strCampos .= ' valorUnitario=:valorUnitario, ';
		} 
		if ( isset( $datos['importe'] ) ){
			$strCampos .= ' importe=:importe, ';
		} 
		if ( isset( $datos['noIdentificacion'] ) ){
			$strCampos .= ' noIdentificacion=:noIdentificacion, ';
		} 
		if ( isset( $datos['fk_nomina'] ) ){
			$strCampos .= ' fk_nomina=:fk_nomina, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Concepto De Nomina Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Concepto De Nomina Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['cantidad'] ) ){
			$sth->bindValue(':cantidad', $datos['cantidad'] );
		}
		if  ( isset( $datos['unidad'] ) ){
			$sth->bindValue(':unidad', $datos['unidad'] );
		}
		if  ( isset( $datos['fk_um'] ) ){
			$sth->bindValue(':fk_um', $datos['fk_um'] );
		}
		if  ( isset( $datos['fk_concepto'] ) ){
			$sth->bindValue(':fk_concepto', $datos['fk_concepto'] );
		}
		if  ( isset( $datos['descripcion'] ) ){
			$sth->bindValue(':descripcion', $datos['descripcion'] );
		}
		if  ( isset( $datos['valorUnitario'] ) ){
			$sth->bindValue(':valorUnitario', $datos['valorUnitario'] );
		}
		if  ( isset( $datos['importe'] ) ){
			$sth->bindValue(':importe', $datos['importe'] );
		}
		if  ( isset( $datos['noIdentificacion'] ) ){
			$sth->bindValue(':noIdentificacion', $datos['noIdentificacion'] );
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