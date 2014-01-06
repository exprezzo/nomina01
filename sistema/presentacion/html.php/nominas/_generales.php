	<div id="tablaFechas" style="text-align:center; margin:0px 0 20px 0;">
		<table style="display:inline-block; text-align:left;">
			<thead>
				<tr>
					<td><div class="inputBox"><label style="margin-left:0;">Fecha Pago</label></div></td>
					<td><div class="inputBox"><label style="margin-left:0;">F. Inicial Pago</label></div></td>
					<td><div class="inputBox"><label style="margin-left:0;">F. Final Pago</label></div></td>
					<td><div class="inputBox"><label style="margin-left:0;">Dias Pagados</label></div></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input title="FechaPago" type="text" name="FechaPago" class="entradaDatos" value="<?php echo $this->datos['FechaPago']; ?>" style="width:150px; display:inline-block;" /></td>
					<td><input title="FechaInicialPago" type="text" name="FechaInicialPago" class="entradaDatos" value="<?php echo $this->datos['FechaInicialPago']; ?>" style="width:150px;" /></td>
					<td><input title="FechaFinalPago" type="text" name="FechaFinalPago" class="entradaDatos" value="<?php echo $this->datos['FechaFinalPago']; ?>" style="width:150px;" /></td>
					<td><input title="Numero de Días pagados" type="text" name="NumDiasPagados" class="entradaDatos" value="<?php echo $this->datos['NumDiasPagados']; ?>" style="width:115px;" /></td>
					
					
				</tr>
			</tbody>
		</table>
	</div>
	<div style="margin:30px 0 20px 0;">
		<div class="inputBox contenedor_fecha_emision" style="display:inline-block;"  >
			<div style="display:inline-block;">
				<label style="">Fecha Emision:</label>
				<input title="Fecha Emision" type="text" name="fecha_emision" class="entradaDatos" value="<?php echo $this->datos['fecha_emision']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox contenedor_fk_serie" style="display:inline-block;"  >
				<label style="margin:0 10px 0 20px; width:auto;">Serie Y Folio:</label>
				<select name="fk_serie" class="entradaDatos" style="width:80px;">
					<?php
						foreach($this->fk_serie_listado as $serie_nomina){
							echo '<option value="'.$serie_nomina['id'].' " >'.$serie_nomina['serie'].'</option>';
						}
					?>
				</select>
									
				<input title="Folio" required="true" readonly type="text" name="folio" class="entradaDatos" value="<?php echo $this->datos['folio']; ?>" style="width:20px; display:inline-block;" />
				
			</div>
		</div>
		<div class="inputBox contenedor_serie oculto" style=""  >
			<label style="">Serie:</label>
			<input title="Serie" type="text" name="serie" class="entradaDatos" value="<?php echo $this->datos['serie']; ?>" style="width:500px;" />
		</div>
		<div class="inputBox contenedor_fk_empleado" style=""  >
			<label style="">Empleado:</label>
			<select name="fk_empleado" class="entradaDatos" style="width:250px;">
				<?php
					foreach($this->fk_empleado_listado as $trabajador){
						echo '<option value="'.$trabajador['id'].' " >'.$trabajador['nombre'].'</option>';
					}
				?>
			</select>
			<a id="lnkDetallesTrabajador" href="#datos_empleado" style="text-decoration:underline;">ver detalles</a>
		</div>
	</div>
	
	
	
	
	