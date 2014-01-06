
<div class="inputBox contenedor_NumEmpleado" style=""  >
	<label style="">NumEmpleado:</label>
	<input title="NumEmpleado" type="text" name="NumEmpleado" class="entradaDatos" value="<?php echo $this->datos['NumEmpleado']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_CURP" style=""  >
	<label style="">CURP:</label>
	<input title="CURP del trabajador" type="text" name="CURP" class="entradaDatos" value="<?php echo $this->datos['CURP']; ?>" style="width:200px;" />
</div>
<div class="inputBox contenedor_fk_TipoRegimen" style=""  >
	<label style="">Tipo Regimen:</label>
	<select name="fk_TipoRegimen" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->fk_TipoRegimen_listado as $regimen_contratacion){
				echo '<option value="'.$regimen_contratacion['id'].' " >'.$regimen_contratacion['nombre'].'</option>';
			}
		?>
	</select>
</div>
<div class="inputBox contenedor_TipoRegimen oculto" style=""  >
	<label style="">TipoRegimen:</label>
	<input title="TipoRegimen" type="text" name="TipoRegimen" class="entradaDatos" value="<?php echo $this->datos['TipoRegimen']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_NumSeguridadSocial" style=""  >
	<label style="">NSS:</label>
	<input title="Atributo opcional para la expresi&oacute;n del número de seguridad social 
aplicable al trabajador" type="text" name="NumSeguridadSocial" class="entradaDatos" value="<?php echo $this->datos['NumSeguridadSocial']; ?>" style="width:200px;" />
</div>
<div class="inputBox contenedor_fk_Departamento" style=""  >
	<label style="" title="Departamento o &aacute;rea a la 
que pertenece el trabajador	">Departamento:</label>
	<select name="fk_Departamento" class="entradaDatos" style="width:250px;" >
		<?php
			foreach($this->fk_Departamento_listado as $departamento){
				echo '<option value="'.$departamento['id'].' " >'.$departamento['nombre'].'</option>';
			}
		?>
	</select>
</div>

<div class="inputBox contenedor_Departamento oculto" style=""  >
	<label style="">Departamento:</label>
	<input title="Departamento" type="text" name="Departamento" class="entradaDatos" value="<?php echo $this->datos['Departamento']; ?>" style="width:500px;" />
</div>

<div class="inputBox contenedor_FechaInicioRelLaboral" style=""  >
	<label style="">FechaInicioRelLaboral:</label>
	<input title="FechaInicioRelLaboral" type="text" name="FechaInicioRelLaboral" class="entradaDatos" value="<?php echo $this->datos['FechaInicioRelLaboral']; ?>" style="width:150px;" />
</div>
<div class="inputBox contenedor_Antiguedad" style=""  >
	<label style="">Antiguedad:</label>
	<input title="Antiguedad" type="text" name="Antiguedad" class="entradaDatos" value="<?php echo $this->datos['Antiguedad']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_Puesto" style=""  >
	<label style="">Puesto:</label>
	<input title="Puesto" type="text" name="Puesto" class="entradaDatos" value="<?php echo $this->datos['Puesto']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_TipoContrato" style=""  >
	<label style="">TipoContrato:</label>
	<select name="TipoContrato" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->TipoContrato_listado as $regimen_contratacion){
				echo '<option value="'.$regimen_contratacion['id'].' " >'.$regimen_contratacion['nombre'].'</option>';
			}
		?>
	</select>
</div>
<div class="inputBox contenedor_TipoJornada" style=""  >
	<label style="">Tipo Jornada:</label>
	<select name="TipoJornada" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->TipoJornada_listado as $jornada){
				echo '<option value="'.$jornada['id'].' " >'.$jornada['nombre'].'</option>';
			}
		?>
	</select>
</div>
<div class="inputBox contenedor_PeriodicidadPago" style=""  >
	<label style="">Periodicidad Pago:</label>
	<select name="PeriodicidadPago" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->PeriodicidadPago_listado as $periodo_pago){
				echo '<option value="'.$periodo_pago['id'].' " >'.$periodo_pago['descripcion'].'</option>';
			}
		?>
	</select>
</div>
<div class="inputBox contenedor_SalarioBaseCotApor" style=""  >
	<label style="">SalarioBaseCotApor:</label>
	<input title="Retribuci&oacute;n otorgada al trabajador, que se integra por los pagos 
hechos en efectivo por cuota diaria, gratificaciones, percepciones, 
alimentaci&oacute;n, habitaci&oacute;n, primas, comisiones, prestaciones en 
especie y cualquiera otra cantidad o prestaci&oacute;n que se entregue al 
trabajador por su trabajo" type="text" name="SalarioBaseCotApor" class="entradaDatos" value="<?php echo $this->datos['SalarioBaseCotApor']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_RiesgoPuesto oculto" style=""  >
	<label style="">RiesgoPuesto:</label>
	<input title="RiesgoPuesto" type="text" name="RiesgoPuesto" class="entradaDatos" value="<?php echo $this->datos['RiesgoPuesto']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_SalarioDiarioIntegrado" style=""  >
	<label style="">SalarioDiarioIntegrado:</label>
	<input title="Salario diario integrado" type="text" name="SalarioDiarioIntegrado" class="entradaDatos" value="<?php echo $this->datos['SalarioDiarioIntegrado']; ?>" style="width:500px;" />
</div>
<div class="inputBox contenedor_fk_RiesgoPuesto" style=""  >
	<label style="">Riesgo Puesto:</label>
	<select name="fk_RiesgoPuesto" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->fk_RiesgoPuesto_listado as $riesgo){
				echo '<option value="'.$riesgo['id'].' " >'.$riesgo['descripcion'].'</option>';
			}
		?>
	</select>
</div>
<div class="inputBox contenedor_Banco oculto" style=""  >
					<label style="">Banco:</label>
					<input  type="text" name="Banco" class="entradaDatos" value="<?php echo $this->datos['Banco']; ?>" style="width:500px;" />
				</div>
	
<div class="inputBox contenedor_fk_banco" style=""  >
	<label style="" title="para la expresi&oacute;n del Banco conforme al catálogo, donde se realiza un dep&oacute;sito de n&oacute;mina ">Banco:</label>
	<select name="fk_banco" class="entradaDatos" style="width:250px;">
		<?php
			foreach($this->fk_banco_listado as $banco){
				echo '<option value="'.$banco['id'].' " >'.$banco['nombre_corto'].'</option>';
			}
		?>
	</select>
</div>

<div class="inputBox contenedor_CLABE" style=""  >
	<label style="">CLABE:</label>
	<input title="CLABE interbancaria" type="text" name="CLABE" class="entradaDatos" value="<?php echo $this->datos['CLABE']; ?>" style="width:500px;" />
</div>