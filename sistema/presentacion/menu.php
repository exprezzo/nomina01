<?php
	// require_once '../portal/modelos/catalogo_modelo.php';
	// require_once '../portal/modelos/modulo.php';
	
	// $moduMod = new moduloModelo();
	
	// $params = array(
		// 'filtros'=>array(
			// array(
				// 'dataKey'=>'id',
				// 'filterOperator'=>'equals',
				// 'filterValue'=>7
			// )
		// )
	// );
	// $modulos = $moduMod->buscar( $params );		
	// $modulos = $modulos['datos'];
	
	// $catMod = new catalogoModelo();
	

	// $params = array(
		// 'filtros'=>array(
			// array(
				// 'dataKey'=>'fk_modulo',
				// 'filterOperator'=>'equals',
				// 'filterValue'=>7
			// )
		// )
	// );
	// $catalogos = $catMod->buscar( $params );		
	// $catalogos=$catalogos['datos'];
	// 
	 // print_r($catalogos);
?>
<ul class="nav">                    	
	<li>
		<a href="#">Cat&aacute;logos<span class="flecha">∨</span></a>
		<ul>
			<li><a href="<?php echo $_PETICION->url_app; ?>nomina/paises/buscar" class="elemento elementoTop">Pais<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/estados/buscar" class="elemento ">Estados<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/municipios/buscar" class="elemento ">Municipio<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/regimenes_contratacion/buscar" class="elemento ">R&eacute;gimen de Contratato<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/bancos/buscar" class="elemento ">Bancos<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/riesgos/buscar" class="elemento ">Nivel de Riesgo<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_percepcion/buscar" class="elemento ">Tipo de Percepci&oacute;n<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_deduccion/buscar" class="elemento ">Tipo de Deduccion<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_incapacidad/buscar" class="elemento ">Tipo de Incapacidad<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/trabajadores/buscar" class="elemento ">Trabajador<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/regimenes/buscar" class="elemento ">Regimen Fiscal<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/certificados/buscar" class="elemento ">Certificados<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/series_nomina/buscar" class="elemento ">Serie Nomina<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/empresas/buscar" class="elemento ">Empresa<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/jornadas/buscar" class="elemento ">Jornada<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/periodo_pagos/buscar" class="elemento ">Periodo de Pago<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/departamentos/buscar" class="elemento ">Departamento<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/nominas/buscar" class="elemento ">Nomina<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/percepciones_nomina/buscar" class="elemento ">Percepciones<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/deducciones_nomina/buscar" class="elemento ">Deducciones<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/incapacidades/buscar" class="elemento ">Incapacidades<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_hora/buscar" class="elemento ">Tipo Horas<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/horas_extra_nomina/buscar" class="elemento ">Horas Extra<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/formas_de_pago/buscar" class="elemento ">Formas De Pago<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/metodos_de_pago/buscar" class="elemento ">Métodos de Pago<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/monedas/buscar" class="elemento ">Monedas<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/conceptos_de_nomina/buscar" class="elemento ">Conceptos de Nomina<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/unidades_de_medida/buscar" class="elemento ">Unidades De Medida<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/conceptos_para_nomina/buscar" class="elemento ">Conceptos Para Nomina<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_de_impuesto/buscar" class="elemento ">Naturaleza del Impuesto<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/impuestos/buscar" class="elemento ">Impuestos<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/impuestos_de_nomina/buscar" class="elemento ">Impuestos De Nomina<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/arboles/buscar" class="elemento ">Arbol<span class="flecha">∨</span></a></li><li><a href="<?php echo $_PETICION->url_app; ?>nomina/tipos_de_contrato/buscar" class="elemento elementoBottom">Tipo De Contrato<span class="flecha">∨</span></a></li>		</ul>
	</li>
	<li>
		<a href="#" class="estiloFactura">Documentos<span class="flecha">∨</span></a>
		<ul>
			<li><a href="<?php echo $_PETICION->url_app; ?>nominas/buscar" class="elementoTop elementoBottom">Nominas<span class="flecha">∨</span></a></li>	
		</ul>
	</li>                                        
	<li>
		<a href="#">Ayuda<span class="flecha">∨</span></a>
		
		
	</li>
</ul>