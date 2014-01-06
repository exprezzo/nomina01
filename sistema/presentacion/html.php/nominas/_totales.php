<div id="tablaTotales" style="display: inline-block; float: right; margin-right: 29px;">
	<h1 class="tituloTabla" style="display: block; margin-left: 133px; margin-bottom:30px; display:none;" >Totales</h1>
	<table style="display:inline-block; ">
		<thead>
			
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="inputBox"><label style="margin-left:0;">Subtotal</label></div>
				</td>
				<td>
					<input title="Subtotal" type="text" name="subTotal" class="entradaDatos" value="<?php echo $this->datos['subTotal']; ?>" style="width:200px;" />
				</td>
			</tr>
			<tr>
				<td>
					<div class="inputBox"><label style="margin-left:0;">Descuentos</label></div>
				</td>
				<td>
					<input title="Descuento" type="text" name="descuento" class="entradaDatos" value="<?php echo $this->datos['descuento']; ?>" style="width:200px;" />
				</td>
			</tr>
			<tr>
				<td>
					<div class="inputBox"><label style="margin-left:0;">Traslados</label></div>
				</td>
				<td>
					<input title="Total de Impuestos Trasladados" type="text" name="totImpTras" class="entradaDatos" value="<?php echo $this->datos['totImpTras']; ?>" style="width:200px;" />	
				</td>
			</tr>
			<tr>
				<td>
					<div class="inputBox"><label style="margin-left:0;">Retenciones</label></div>
				</td>
				<td>
					<input title="Total de Impuestos Retenidos" type="text" name="totImpRet" class="entradaDatos" value="<?php echo $this->datos['totImpRet']; ?>" style="width:200px;" />
				</td>
			</tr>
			<tr>
				<td>
					<div class="inputBox"><label style="margin-left:0;">Total</label></div>
				</td>
				<td>
					<input title="Total" type="text" name="total" class="entradaDatos" value="<?php echo $this->datos['total']; ?>" style="width:200px;" />
				</td>
			</tr>
			
		</tbody>
	</table>
</div>