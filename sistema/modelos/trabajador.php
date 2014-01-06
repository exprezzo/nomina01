<?php
class trabajadorModelo extends Modelo{	
	var $tabla='nomina_trabajador';
	var $pk='id';
	var $campos= array('id', 'nombre', 'rfc', 'email', 'CURP', 'fk_TipoRegimen', 'nombre_regimen_contratacion', 'NumSeguridadSocial', 'calle', 'noExterior', 'noInterior', 'colonia', 'localidad', 'referencia', 'fk_pais', 'nombre_pais', 'fk_estado', 'nombre_estado', 'fk_municipio', 'nombre_municipio', 'codigoPostal', 'NoEmpleado', 'SalarioDiarioIntegrado', 'SalarioBaseCotApor', 'FechaInicioRelLaboral', 'puesto', 'fk_TipoContrato', 'nombre_tipo_de_contrato', 'fk_departamento', 'nombre_departamento', 'fk_TipoJornada', 'nombre_jornada', 'fk_PeriodicidadPago', 'descripcion_periodo_pago', 'fk_RiesgoPuesto', 'descripcion_riesgo', 'fk_banco', 'nombre_corto_banco', 'CLABE');
	
	function buscar($params){
		
		$pdo = $this->getConexion();
		$filtros='';
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				 
				if ( $filtro['dataKey']=='id' ) {
					$filtros .= ' trabajador.id like :id OR ';
				} 
				if ( $filtro['dataKey']=='nombre' ) {
					$filtros .= ' trabajador.nombre like :nombre OR ';
				} 
				if ( $filtro['dataKey']=='rfc' ) {
					$filtros .= ' trabajador.rfc like :rfc OR ';
				} 
				if ( $filtro['dataKey']=='email' ) {
					$filtros .= ' trabajador.email like :email OR ';
				} 
				if ( $filtro['dataKey']=='CURP' ) {
					$filtros .= ' trabajador.CURP like :CURP OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoRegimen' ) {
					$filtros .= ' trabajador.fk_TipoRegimen like :fk_TipoRegimen OR ';
				} 
				if ( $filtro['dataKey']=='nombre_regimen_contratacion' ) {
					$filtros .= ' regimen_contratacion0.nombre like :nombre_regimen_contratacion OR ';
				} 
				if ( $filtro['dataKey']=='NumSeguridadSocial' ) {
					$filtros .= ' trabajador.NumSeguridadSocial like :NumSeguridadSocial OR ';
				} 
				if ( $filtro['dataKey']=='calle' ) {
					$filtros .= ' trabajador.calle like :calle OR ';
				} 
				if ( $filtro['dataKey']=='noExterior' ) {
					$filtros .= ' trabajador.noExterior like :noExterior OR ';
				} 
				if ( $filtro['dataKey']=='noInterior' ) {
					$filtros .= ' trabajador.noInterior like :noInterior OR ';
				} 
				if ( $filtro['dataKey']=='colonia' ) {
					$filtros .= ' trabajador.colonia like :colonia OR ';
				} 
				if ( $filtro['dataKey']=='localidad' ) {
					$filtros .= ' trabajador.localidad like :localidad OR ';
				} 
				if ( $filtro['dataKey']=='referencia' ) {
					$filtros .= ' trabajador.referencia like :referencia OR ';
				} 
				if ( $filtro['dataKey']=='fk_pais' ) {
					$filtros .= ' trabajador.fk_pais like :fk_pais OR ';
				} 
				if ( $filtro['dataKey']=='nombre_pais' ) {
					$filtros .= ' pais1.nombre like :nombre_pais OR ';
				} 
				if ( $filtro['dataKey']=='fk_estado' ) {
					$filtros .= ' trabajador.fk_estado like :fk_estado OR ';
				} 
				if ( $filtro['dataKey']=='nombre_estado' ) {
					$filtros .= ' estado2.nombre like :nombre_estado OR ';
				} 
				if ( $filtro['dataKey']=='fk_municipio' ) {
					$filtros .= ' trabajador.fk_municipio like :fk_municipio OR ';
				} 
				if ( $filtro['dataKey']=='nombre_municipio' ) {
					$filtros .= ' municipio3.nombre like :nombre_municipio OR ';
				} 
				if ( $filtro['dataKey']=='codigoPostal' ) {
					$filtros .= ' trabajador.codigoPostal like :codigoPostal OR ';
				} 
				if ( $filtro['dataKey']=='NoEmpleado' ) {
					$filtros .= ' trabajador.NoEmpleado like :NoEmpleado OR ';
				} 
				if ( $filtro['dataKey']=='SalarioDiarioIntegrado' ) {
					$filtros .= ' trabajador.SalarioDiarioIntegrado like :SalarioDiarioIntegrado OR ';
				} 
				if ( $filtro['dataKey']=='SalarioBaseCotApor' ) {
					$filtros .= ' trabajador.SalarioBaseCotApor like :SalarioBaseCotApor OR ';
				} 
				if ( $filtro['dataKey']=='FechaInicioRelLaboral' ) {
					$filtros .= ' trabajador.FechaInicioRelLaboral like :FechaInicioRelLaboral OR ';
				} 
				if ( $filtro['dataKey']=='puesto' ) {
					$filtros .= ' trabajador.puesto like :puesto OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoContrato' ) {
					$filtros .= ' trabajador.fk_TipoContrato like :fk_TipoContrato OR ';
				} 
				if ( $filtro['dataKey']=='nombre_tipo_de_contrato' ) {
					$filtros .= ' tipo_de_contrato4.nombre like :nombre_tipo_de_contrato OR ';
				} 
				if ( $filtro['dataKey']=='fk_departamento' ) {
					$filtros .= ' trabajador.fk_departamento like :fk_departamento OR ';
				} 
				if ( $filtro['dataKey']=='nombre_departamento' ) {
					$filtros .= ' departamento5.nombre like :nombre_departamento OR ';
				} 
				if ( $filtro['dataKey']=='fk_TipoJornada' ) {
					$filtros .= ' trabajador.fk_TipoJornada like :fk_TipoJornada OR ';
				} 
				if ( $filtro['dataKey']=='nombre_jornada' ) {
					$filtros .= ' jornada6.nombre like :nombre_jornada OR ';
				} 
				if ( $filtro['dataKey']=='fk_PeriodicidadPago' ) {
					$filtros .= ' trabajador.fk_PeriodicidadPago like :fk_PeriodicidadPago OR ';
				} 
				if ( $filtro['dataKey']=='descripcion_periodo_pago' ) {
					$filtros .= ' periodo_pago7.descripcion like :descripcion_periodo_pago OR ';
				} 
				if ( $filtro['dataKey']=='fk_RiesgoPuesto' ) {
					$filtros .= ' trabajador.fk_RiesgoPuesto like :fk_RiesgoPuesto OR ';
				} 
				if ( $filtro['dataKey']=='descripcion_riesgo' ) {
					$filtros .= ' riesgo8.descripcion like :descripcion_riesgo OR ';
				} 
				if ( $filtro['dataKey']=='fk_banco' ) {
					$filtros .= ' trabajador.fk_banco like :fk_banco OR ';
				} 
				if ( $filtro['dataKey']=='nombre_corto_banco' ) {
					$filtros .= ' banco9.nombre_corto like :nombre_corto_banco OR ';
				} 
				if ( $filtro['dataKey']=='CLABE' ) {
					$filtros .= ' trabajador.CLABE like :CLABE OR ';
				}			
			}
			$filtros=substr( $filtros,0,  strlen($filtros)-3 );
			if ( !empty($filtros) ){
				$filtros=' WHERE '.$filtros;
			}
		}
		
		
		$joins='
 LEFT JOIN nomina_regimen_contratacion AS regimen_contratacion0 ON regimen_contratacion0.id = trabajador.fk_TipoRegimen
 LEFT JOIN system_ubicacion_paises AS pais1 ON pais1.id = trabajador.fk_pais
 LEFT JOIN system_ubicacion_estados AS estado2 ON estado2.id = trabajador.fk_estado
 LEFT JOIN system_ubicacion_municipios AS municipio3 ON municipio3.id = trabajador.fk_municipio
 LEFT JOIN nomina_tipo_contrato AS tipo_de_contrato4 ON tipo_de_contrato4.id = trabajador.fk_TipoContrato
 LEFT JOIN nomina_departamento AS departamento5 ON departamento5.id = trabajador.fk_departamento
 LEFT JOIN nomina_jornada AS jornada6 ON jornada6.id = trabajador.fk_TipoJornada
 LEFT JOIN nomina_periodicidad_pago AS periodo_pago7 ON periodo_pago7.id = trabajador.fk_PeriodicidadPago
 LEFT JOIN nomina_riesgo_puesto AS riesgo8 ON riesgo8.id = trabajador.fk_RiesgoPuesto
 LEFT JOIN nomina_bancos AS banco9 ON banco9.id = trabajador.fk_banco';
						
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.' trabajador '.$joins.$filtros;				
		$sth = $pdo->prepare($sql);		
		if ( !empty($params['filtros']) ){
			foreach($params['filtros'] as $filtro){
				
			if ( $filtro['dataKey']=='id' ) {
				$sth->bindValue(':id','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre' ) {
				$sth->bindValue(':nombre','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='rfc' ) {
				$sth->bindValue(':rfc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='email' ) {
				$sth->bindValue(':email','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='CURP' ) {
				$sth->bindValue(':CURP','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoRegimen' ) {
				$sth->bindValue(':fk_TipoRegimen','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_regimen_contratacion' ) {
				$sth->bindValue(':nombre_regimen_contratacion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='NumSeguridadSocial' ) {
				$sth->bindValue(':NumSeguridadSocial','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='calle' ) {
				$sth->bindValue(':calle','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noExterior' ) {
				$sth->bindValue(':noExterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noInterior' ) {
				$sth->bindValue(':noInterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='colonia' ) {
				$sth->bindValue(':colonia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='localidad' ) {
				$sth->bindValue(':localidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='referencia' ) {
				$sth->bindValue(':referencia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_pais' ) {
				$sth->bindValue(':fk_pais','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_pais' ) {
				$sth->bindValue(':nombre_pais', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_municipio' ) {
				$sth->bindValue(':fk_municipio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_municipio' ) {
				$sth->bindValue(':nombre_municipio', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='codigoPostal' ) {
				$sth->bindValue(':codigoPostal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='NoEmpleado' ) {
				$sth->bindValue(':NoEmpleado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='SalarioDiarioIntegrado' ) {
				$sth->bindValue(':SalarioDiarioIntegrado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='SalarioBaseCotApor' ) {
				$sth->bindValue(':SalarioBaseCotApor','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='FechaInicioRelLaboral' ) {
				$sth->bindValue(':FechaInicioRelLaboral','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='puesto' ) {
				$sth->bindValue(':puesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoContrato' ) {
				$sth->bindValue(':fk_TipoContrato','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_contrato' ) {
				$sth->bindValue(':nombre_tipo_de_contrato', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_departamento' ) {
				$sth->bindValue(':fk_departamento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_departamento' ) {
				$sth->bindValue(':nombre_departamento', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoJornada' ) {
				$sth->bindValue(':fk_TipoJornada','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_jornada' ) {
				$sth->bindValue(':nombre_jornada', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_PeriodicidadPago' ) {
				$sth->bindValue(':fk_PeriodicidadPago','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_periodo_pago' ) {
				$sth->bindValue(':descripcion_periodo_pago', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_RiesgoPuesto' ) {
				$sth->bindValue(':fk_RiesgoPuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_riesgo' ) {
				$sth->bindValue(':descripcion_riesgo', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_banco' ) {
				$sth->bindValue(':fk_banco','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_corto_banco' ) {
				$sth->bindValue(':nombre_corto_banco', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='CLABE' ) {
				$sth->bindValue(':CLABE','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$sql = 'SELECT trabajador.id, trabajador.nombre, trabajador.rfc, trabajador.email, trabajador.CURP, trabajador.fk_TipoRegimen, regimen_contratacion0.nombre AS nombre_fk_TipoRegimen, trabajador.NumSeguridadSocial, trabajador.calle, trabajador.noExterior, trabajador.noInterior, trabajador.colonia, trabajador.localidad, trabajador.referencia, trabajador.fk_pais, pais1.nombre AS nombre_fk_pais, trabajador.fk_estado, estado2.nombre AS nombre_fk_estado, trabajador.fk_municipio, municipio3.nombre AS nombre_fk_municipio, trabajador.codigoPostal, trabajador.NoEmpleado, trabajador.SalarioDiarioIntegrado, trabajador.SalarioBaseCotApor, trabajador.FechaInicioRelLaboral, trabajador.puesto, trabajador.fk_TipoContrato, tipo_de_contrato4.nombre AS nombre_fk_TipoContrato, trabajador.fk_departamento, departamento5.nombre AS nombre_fk_departamento, trabajador.fk_TipoJornada, jornada6.nombre AS nombre_fk_TipoJornada, trabajador.fk_PeriodicidadPago, periodo_pago7.descripcion AS descripcion_fk_PeriodicidadPago, trabajador.fk_RiesgoPuesto, riesgo8.descripcion AS descripcion_fk_RiesgoPuesto, trabajador.fk_banco, banco9.nombre_corto AS nombre_corto_fk_banco, trabajador.CLABE FROM '.$this->tabla.' trabajador '.$joins.$filtros.' limit :start,:limit';
		}else{
			$sql = 'SELECT trabajador.id, trabajador.nombre, trabajador.rfc, trabajador.email, trabajador.CURP, trabajador.fk_TipoRegimen, regimen_contratacion0.nombre AS nombre_fk_TipoRegimen, trabajador.NumSeguridadSocial, trabajador.calle, trabajador.noExterior, trabajador.noInterior, trabajador.colonia, trabajador.localidad, trabajador.referencia, trabajador.fk_pais, pais1.nombre AS nombre_fk_pais, trabajador.fk_estado, estado2.nombre AS nombre_fk_estado, trabajador.fk_municipio, municipio3.nombre AS nombre_fk_municipio, trabajador.codigoPostal, trabajador.NoEmpleado, trabajador.SalarioDiarioIntegrado, trabajador.SalarioBaseCotApor, trabajador.FechaInicioRelLaboral, trabajador.puesto, trabajador.fk_TipoContrato, tipo_de_contrato4.nombre AS nombre_fk_TipoContrato, trabajador.fk_departamento, departamento5.nombre AS nombre_fk_departamento, trabajador.fk_TipoJornada, jornada6.nombre AS nombre_fk_TipoJornada, trabajador.fk_PeriodicidadPago, periodo_pago7.descripcion AS descripcion_fk_PeriodicidadPago, trabajador.fk_RiesgoPuesto, riesgo8.descripcion AS descripcion_fk_RiesgoPuesto, trabajador.fk_banco, banco9.nombre_corto AS nombre_corto_fk_banco, trabajador.CLABE FROM '.$this->tabla.' trabajador '.$joins.$filtros;
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
			if ( $filtro['dataKey']=='rfc' ) {
				$sth->bindValue(':rfc','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='email' ) {
				$sth->bindValue(':email','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='CURP' ) {
				$sth->bindValue(':CURP','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoRegimen' ) {
				$sth->bindValue(':fk_TipoRegimen','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_regimen_contratacion' ) {
				$sth->bindValue(':nombre_regimen_contratacion', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='NumSeguridadSocial' ) {
				$sth->bindValue(':NumSeguridadSocial','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='calle' ) {
				$sth->bindValue(':calle','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noExterior' ) {
				$sth->bindValue(':noExterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='noInterior' ) {
				$sth->bindValue(':noInterior','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='colonia' ) {
				$sth->bindValue(':colonia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='localidad' ) {
				$sth->bindValue(':localidad','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='referencia' ) {
				$sth->bindValue(':referencia','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_pais' ) {
				$sth->bindValue(':fk_pais','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_pais' ) {
				$sth->bindValue(':nombre_pais', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_estado' ) {
				$sth->bindValue(':fk_estado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_estado' ) {
				$sth->bindValue(':nombre_estado', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_municipio' ) {
				$sth->bindValue(':fk_municipio','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_municipio' ) {
				$sth->bindValue(':nombre_municipio', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='codigoPostal' ) {
				$sth->bindValue(':codigoPostal','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='NoEmpleado' ) {
				$sth->bindValue(':NoEmpleado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='SalarioDiarioIntegrado' ) {
				$sth->bindValue(':SalarioDiarioIntegrado','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='SalarioBaseCotApor' ) {
				$sth->bindValue(':SalarioBaseCotApor','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='FechaInicioRelLaboral' ) {
				$sth->bindValue(':FechaInicioRelLaboral','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='puesto' ) {
				$sth->bindValue(':puesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoContrato' ) {
				$sth->bindValue(':fk_TipoContrato','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_tipo_de_contrato' ) {
				$sth->bindValue(':nombre_tipo_de_contrato', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_departamento' ) {
				$sth->bindValue(':fk_departamento','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_departamento' ) {
				$sth->bindValue(':nombre_departamento', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_TipoJornada' ) {
				$sth->bindValue(':fk_TipoJornada','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_jornada' ) {
				$sth->bindValue(':nombre_jornada', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_PeriodicidadPago' ) {
				$sth->bindValue(':fk_PeriodicidadPago','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_periodo_pago' ) {
				$sth->bindValue(':descripcion_periodo_pago', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_RiesgoPuesto' ) {
				$sth->bindValue(':fk_RiesgoPuesto','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='descripcion_riesgo' ) {
				$sth->bindValue(':descripcion_riesgo', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='fk_banco' ) {
				$sth->bindValue(':fk_banco','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='nombre_corto_banco' ) {
				$sth->bindValue(':nombre_corto_banco', '%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
			}
			if ( $filtro['dataKey']=='CLABE' ) {
				$sth->bindValue(':CLABE','%'.$filtro['filterValue'].'%', PDO::PARAM_STR );
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
			$obj['rfc']='';
			$obj['email']='';
			$obj['CURP']='';
			$obj['fk_TipoRegimen']='';
			$obj['nombre_regimen_contratacion']='';
			$obj['NumSeguridadSocial']='';
			$obj['calle']='';
			$obj['noExterior']='';
			$obj['noInterior']='';
			$obj['colonia']='';
			$obj['localidad']='';
			$obj['referencia']='';
			$obj['fk_pais']='';
			$obj['nombre_pais']='';
			$obj['fk_estado']='';
			$obj['nombre_estado']='';
			$obj['fk_municipio']='';
			$obj['nombre_municipio']='';
			$obj['codigoPostal']='';
			$obj['NoEmpleado']='';
			$obj['SalarioDiarioIntegrado']='';
			$obj['SalarioBaseCotApor']='';
			$obj['FechaInicioRelLaboral']='';
			$obj['puesto']='';
			$obj['fk_TipoContrato']='';
			$obj['nombre_tipo_de_contrato']='';
			$obj['fk_departamento']='';
			$obj['nombre_departamento']='';
			$obj['fk_TipoJornada']='';
			$obj['nombre_jornada']='';
			$obj['fk_PeriodicidadPago']='';
			$obj['descripcion_periodo_pago']='';
			$obj['fk_RiesgoPuesto']='';
			$obj['descripcion_riesgo']='';
			$obj['fk_banco']='';
			$obj['nombre_corto_banco']='';
			$obj['CLABE']='';
		return $obj;
	}
	function obtener( $llave ){		
		$sql = 'SELECT trabajador.id, trabajador.nombre, trabajador.rfc, trabajador.email, trabajador.CURP, trabajador.fk_TipoRegimen, regimen_contratacion0.nombre AS nombre_fk_TipoRegimen, trabajador.NumSeguridadSocial, trabajador.calle, trabajador.noExterior, trabajador.noInterior, trabajador.colonia, trabajador.localidad, trabajador.referencia, trabajador.fk_pais, pais1.nombre AS nombre_fk_pais, trabajador.fk_estado, estado2.nombre AS nombre_fk_estado, trabajador.fk_municipio, municipio3.nombre AS nombre_fk_municipio, trabajador.codigoPostal, trabajador.NoEmpleado, trabajador.SalarioDiarioIntegrado, trabajador.SalarioBaseCotApor, trabajador.FechaInicioRelLaboral, trabajador.puesto, trabajador.fk_TipoContrato, tipo_de_contrato4.nombre AS nombre_fk_TipoContrato, trabajador.fk_departamento, departamento5.nombre AS nombre_fk_departamento, trabajador.fk_TipoJornada, jornada6.nombre AS nombre_fk_TipoJornada, trabajador.fk_PeriodicidadPago, periodo_pago7.descripcion AS descripcion_fk_PeriodicidadPago, trabajador.fk_RiesgoPuesto, riesgo8.descripcion AS descripcion_fk_RiesgoPuesto, trabajador.fk_banco, banco9.nombre_corto AS nombre_corto_fk_banco, trabajador.CLABE
 FROM nomina_trabajador AS trabajador
 LEFT JOIN nomina_regimen_contratacion AS regimen_contratacion0 ON regimen_contratacion0.id = trabajador.fk_TipoRegimen
 LEFT JOIN system_ubicacion_paises AS pais1 ON pais1.id = trabajador.fk_pais
 LEFT JOIN system_ubicacion_estados AS estado2 ON estado2.id = trabajador.fk_estado
 LEFT JOIN system_ubicacion_municipios AS municipio3 ON municipio3.id = trabajador.fk_municipio
 LEFT JOIN nomina_tipo_contrato AS tipo_de_contrato4 ON tipo_de_contrato4.id = trabajador.fk_TipoContrato
 LEFT JOIN nomina_departamento AS departamento5 ON departamento5.id = trabajador.fk_departamento
 LEFT JOIN nomina_jornada AS jornada6 ON jornada6.id = trabajador.fk_TipoJornada
 LEFT JOIN nomina_periodicidad_pago AS periodo_pago7 ON periodo_pago7.id = trabajador.fk_PeriodicidadPago
 LEFT JOIN nomina_riesgo_puesto AS riesgo8 ON riesgo8.id = trabajador.fk_RiesgoPuesto
 LEFT JOIN nomina_bancos AS banco9 ON banco9.id = trabajador.fk_banco
  WHERE trabajador.id=:id';
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
		if ( isset( $datos['rfc'] ) ){
			$strCampos .= ' rfc=:rfc, ';
		} 
		if ( isset( $datos['email'] ) ){
			$strCampos .= ' email=:email, ';
		} 
		if ( isset( $datos['CURP'] ) ){
			$strCampos .= ' CURP=:CURP, ';
		} 
		if ( isset( $datos['fk_TipoRegimen'] ) ){
			$strCampos .= ' fk_TipoRegimen=:fk_TipoRegimen, ';
		} 
		if ( isset( $datos['NumSeguridadSocial'] ) ){
			$strCampos .= ' NumSeguridadSocial=:NumSeguridadSocial, ';
		} 
		if ( isset( $datos['calle'] ) ){
			$strCampos .= ' calle=:calle, ';
		} 
		if ( isset( $datos['noExterior'] ) ){
			$strCampos .= ' noExterior=:noExterior, ';
		} 
		if ( isset( $datos['noInterior'] ) ){
			$strCampos .= ' noInterior=:noInterior, ';
		} 
		if ( isset( $datos['colonia'] ) ){
			$strCampos .= ' colonia=:colonia, ';
		} 
		if ( isset( $datos['localidad'] ) ){
			$strCampos .= ' localidad=:localidad, ';
		} 
		if ( isset( $datos['referencia'] ) ){
			$strCampos .= ' referencia=:referencia, ';
		} 
		if ( isset( $datos['fk_pais'] ) ){
			$strCampos .= ' fk_pais=:fk_pais, ';
		} 
		if ( isset( $datos['fk_estado'] ) ){
			$strCampos .= ' fk_estado=:fk_estado, ';
		} 
		if ( isset( $datos['fk_municipio'] ) ){
			$strCampos .= ' fk_municipio=:fk_municipio, ';
		} 
		if ( isset( $datos['codigoPostal'] ) ){
			$strCampos .= ' codigoPostal=:codigoPostal, ';
		} 
		if ( isset( $datos['NoEmpleado'] ) ){
			$strCampos .= ' NoEmpleado=:NoEmpleado, ';
		} 
		if ( isset( $datos['SalarioDiarioIntegrado'] ) ){
			$strCampos .= ' SalarioDiarioIntegrado=:SalarioDiarioIntegrado, ';
		} 
		if ( isset( $datos['SalarioBaseCotApor'] ) ){
			$strCampos .= ' SalarioBaseCotApor=:SalarioBaseCotApor, ';
		} 
		if ( isset( $datos['FechaInicioRelLaboral'] ) ){
			$strCampos .= ' FechaInicioRelLaboral=:FechaInicioRelLaboral, ';
		} 
		if ( isset( $datos['puesto'] ) ){
			$strCampos .= ' puesto=:puesto, ';
		} 
		if ( isset( $datos['fk_TipoContrato'] ) ){
			$strCampos .= ' fk_TipoContrato=:fk_TipoContrato, ';
		} 
		if ( isset( $datos['fk_departamento'] ) ){
			$strCampos .= ' fk_departamento=:fk_departamento, ';
		} 
		if ( isset( $datos['fk_TipoJornada'] ) ){
			$strCampos .= ' fk_TipoJornada=:fk_TipoJornada, ';
		} 
		if ( isset( $datos['fk_PeriodicidadPago'] ) ){
			$strCampos .= ' fk_PeriodicidadPago=:fk_PeriodicidadPago, ';
		} 
		if ( isset( $datos['fk_RiesgoPuesto'] ) ){
			$strCampos .= ' fk_RiesgoPuesto=:fk_RiesgoPuesto, ';
		} 
		if ( isset( $datos['fk_banco'] ) ){
			$strCampos .= ' fk_banco=:fk_banco, ';
		} 
		if ( isset( $datos['CLABE'] ) ){
			$strCampos .= ' CLABE=:CLABE, ';
		}		
		//--------------------------------------------
		
		$strCampos=substr( $strCampos,0,  strlen($strCampos)-2 );
		
		
		if ( $esNuevo ){
			$sql = 'INSERT INTO '.$this->tabla.' SET '.$strCampos;
			$msg='Trabajador Creado';
		}else{
			$sql = 'UPDATE '.$this->tabla.' SET '.$strCampos.' WHERE id=:id';
			$msg='Trabajador Actualizado';
		}
		
		$pdo = $this->getConexion();
		$sth = $pdo->prepare($sql);
		//--------------------------------------------		
		// BIND VALUES
		
		if  ( isset( $datos['nombre'] ) ){
			$sth->bindValue(':nombre', $datos['nombre'] );
		}
		if  ( isset( $datos['rfc'] ) ){
			$sth->bindValue(':rfc', $datos['rfc'] );
		}
		if  ( isset( $datos['email'] ) ){
			$sth->bindValue(':email', $datos['email'] );
		}
		if  ( isset( $datos['CURP'] ) ){
			$sth->bindValue(':CURP', $datos['CURP'] );
		}
		if  ( isset( $datos['fk_TipoRegimen'] ) ){
			$sth->bindValue(':fk_TipoRegimen', $datos['fk_TipoRegimen'] );
		}
		if  ( isset( $datos['NumSeguridadSocial'] ) ){
			$sth->bindValue(':NumSeguridadSocial', $datos['NumSeguridadSocial'] );
		}
		if  ( isset( $datos['calle'] ) ){
			$sth->bindValue(':calle', $datos['calle'] );
		}
		if  ( isset( $datos['noExterior'] ) ){
			$sth->bindValue(':noExterior', $datos['noExterior'] );
		}
		if  ( isset( $datos['noInterior'] ) ){
			$sth->bindValue(':noInterior', $datos['noInterior'] );
		}
		if  ( isset( $datos['colonia'] ) ){
			$sth->bindValue(':colonia', $datos['colonia'] );
		}
		if  ( isset( $datos['localidad'] ) ){
			$sth->bindValue(':localidad', $datos['localidad'] );
		}
		if  ( isset( $datos['referencia'] ) ){
			$sth->bindValue(':referencia', $datos['referencia'] );
		}
		if  ( isset( $datos['fk_pais'] ) ){
			$sth->bindValue(':fk_pais', $datos['fk_pais'] );
		}
		if  ( isset( $datos['fk_estado'] ) ){
			$sth->bindValue(':fk_estado', $datos['fk_estado'] );
		}
		if  ( isset( $datos['fk_municipio'] ) ){
			$sth->bindValue(':fk_municipio', $datos['fk_municipio'] );
		}
		if  ( isset( $datos['codigoPostal'] ) ){
			$sth->bindValue(':codigoPostal', $datos['codigoPostal'] );
		}
		if  ( isset( $datos['NoEmpleado'] ) ){
			$sth->bindValue(':NoEmpleado', $datos['NoEmpleado'] );
		}
		if  ( isset( $datos['SalarioDiarioIntegrado'] ) ){
			$sth->bindValue(':SalarioDiarioIntegrado', $datos['SalarioDiarioIntegrado'] );
		}
		if  ( isset( $datos['SalarioBaseCotApor'] ) ){
			$sth->bindValue(':SalarioBaseCotApor', $datos['SalarioBaseCotApor'] );
		}
		if  ( isset( $datos['FechaInicioRelLaboral'] ) ){
			$sth->bindValue(':FechaInicioRelLaboral', $datos['FechaInicioRelLaboral'] );
		}
		if  ( isset( $datos['puesto'] ) ){
			$sth->bindValue(':puesto', $datos['puesto'] );
		}
		if  ( isset( $datos['fk_TipoContrato'] ) ){
			$sth->bindValue(':fk_TipoContrato', $datos['fk_TipoContrato'] );
		}
		if  ( isset( $datos['fk_departamento'] ) ){
			$sth->bindValue(':fk_departamento', $datos['fk_departamento'] );
		}
		if  ( isset( $datos['fk_TipoJornada'] ) ){
			$sth->bindValue(':fk_TipoJornada', $datos['fk_TipoJornada'] );
		}
		if  ( isset( $datos['fk_PeriodicidadPago'] ) ){
			$sth->bindValue(':fk_PeriodicidadPago', $datos['fk_PeriodicidadPago'] );
		}
		if  ( isset( $datos['fk_RiesgoPuesto'] ) ){
			$sth->bindValue(':fk_RiesgoPuesto', $datos['fk_RiesgoPuesto'] );
		}
		if  ( isset( $datos['fk_banco'] ) ){
			$sth->bindValue(':fk_banco', $datos['fk_banco'] );
		}
		if  ( isset( $datos['CLABE'] ) ){
			$sth->bindValue(':CLABE', $datos['CLABE'] );
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