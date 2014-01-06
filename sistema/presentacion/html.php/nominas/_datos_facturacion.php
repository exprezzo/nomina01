<div class="inputBox contenedor_fk_forma_pago" style="display: none;" >
		<label style="">Forma de Pago:</label>
		<select name="fk_forma_pago" class="entradaDatos" style="width:250px;">
			<?php
				foreach($this->fk_forma_pago_listado as $forma_de_pago){
					echo '<option value="'.$forma_de_pago['id'].' " >'.$forma_de_pago['nombre'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="inputBox contenedor_fk_certificado" style=""  >
		<label style="">Certificado:</label>
		<select name="fk_certificado" class="entradaDatos" style="width:250px;">
			<?php
				foreach($this->fk_certificado_listado as $certificado){
					echo '<option value="'.$certificado['id'].' " >'.$certificado['no_serie'].'</option>';
				}
			?>
		</select>
	</div>
	
	
	
	<div class="inputBox contenedor_motivo_descuento" style="display: none;"  >
		<label style="">Motivo de descuento:</label>
		<input title="Motivo de descuento" type="text" name="motivo_descuento" class="entradaDatos" value="<?php echo $this->datos['motivo_descuento']; ?>" style="width:300px;" />
	</div>
	
	<div class="inputBox contenedor_fk_moneda" style=""  >
		<label style="">Moneda:</label>
		<select name="fk_moneda" class="entradaDatos" style="width:150px !important;">
			<?php
				foreach($this->fk_moneda_listado as $moneda){
					echo '<option value="'.$moneda['id'].' " >'.$moneda['moneda'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="inputBox contenedor_tipo_cambio" style="display:none;"  >
		<label style="">Tipo de Cambio:</label>
		<input title="Tipo de Cambio" type="text" name="tipo_cambio" class="entradaDatos" value="<?php echo $this->datos['tipo_cambio']; ?>" style="width:300px;" />
	</div>
	
	<div class="inputBox contenedor_tipo_comprobante" style="display:none;"  >
		<label style="">Tipo De Comprobante:</label>
		<input title="Tipo De Comprobante" type="text" name="tipo_comprobante" class="entradaDatos" value="<?php echo $this->datos['tipo_comprobante']; ?>" style="width:300px;" />
	</div>
	<div class="inputBox contenedor_fk_metodo_pago" style=""  >
		<label style="">M&eacute;todo de Pago:</label>
		<select name="fk_metodo_pago" class="entradaDatos" style="width:250px;">
			<?php
				foreach($this->fk_metodo_pago_listado as $metodo_de_pago){
					echo '<option value="'.$metodo_de_pago['id'].' " >'.$metodo_de_pago['nombre'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="inputBox contenedor_condiciones_de_pago" style=""  >
		<label style="">Condiciones De Pago:</label>
		<input title="Condiciones De Pago" type="text" name="condiciones_de_pago" class="entradaDatos" value="<?php echo $this->datos['condiciones_de_pago']; ?>" style="width:300px;" />
	</div>
	<div class="inputBox contenedor_num_cta_pago" style="display:none;"  >
		<label style="">Num Cta Pago:</label>
		<input title="Ultimos 4 digitos de la cuenta" type="text" name="num_cta_pago" class="entradaDatos" value="<?php echo $this->datos['num_cta_pago']; ?>" style="width:300px;" />
	</div>
	
	
	
	