<form id="donativosForm" name="donativosForm" method="post" action="dev_donativos.php">

					<div class="entry donativos">

				<?php if(isset($_GET['msg']) && $_GET['msg'] > 0){ ?>
			<div class="error">
				<?php switch($_GET['msg'])
					{
						case 1; echo "El código de seguridad introducido es incorrecto."; break;
						case 2; echo "Los campos con asteriscos son obligatorios"; break;
						case 3; echo "El formulario se ha enviado con éxito, en breve nos pondremos en contacto con usted."; break;
					}
				?>
			</div>
				<?php } ?>

					<div class="row">
						<div class="col-sm-6">

							<label>Nombre <?php if($idparroquia==599) echo "y apellidos"; ?><span>*</span>:</label>
							<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>

							<label><?php if($idparroquia==599) echo "Documento de identidad"; else if($idparroquia == 1473) echo "C.I. (Cedula de Identidad)"; else echo "NIF"; ?>:</label>
							<p><input type="text" class="form-control" name="nif" id="nif" value="" /></p>
						
							<label><?php if($idparroquia==599) echo "Dirección"; else echo "Domicilio"; ?>:</label>
							<p><input type="text" class="form-control" name="domicilio" id="domicilio" value="" /></p>

							<?php if($idparroquia != 599){ ?>
							<label>Código Postal:</label>
							<p><input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value="" /></p>
						
							<label>Población:</label>
							<p><input type="text" class="form-control" name="poblacion" id="poblacion" value="" /></p>

							<?php } ?>
						</div>
						<div class="col-sm-6">

							<label><?php if($idparroquia == 599) echo "Ciudad"; else if($idparroquia == 1473) echo "Departamento"; else echo "Provincia"; ?>:</label>
							<p><input type="text" class="form-control" name="provincia" id="provincia" value="" /></p>
						
							<label>Correo electrónico <span>*</span>:</label>
							<p><input type="text" class="form-control" name="email" id="email" value="" /></p>
						
							<label>Teléfono <span>*</span>:</label>
							<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>
							
							<?php if($idparroquia != 599){ ?>
							<label>Cuenta Bancaria <span>*</span>:</label>
							<p><input type="text" class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" value="" /></p>
							<?php } ?>
							
							<label>Con carácter:</label>
								<?php
									$sql = "SELECT id, caracter FROM donativos_caracteres ORDER BY caracter ASC";
									$rs = mysql_query($sql,$conex) or die (mysql_error());

									echo "<select name=\"caracter\" class=\"form-control\" style=\"font-size:11px;\" id=\"caracter\">\n";

									while($rw = mysql_fetch_assoc($rs)) echo "<option value=\"".$rw['id']."\">".$rw['caracter']."</option>\n";

									echo "</select>\n";
								?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<label>Mensaje:</label>
							<p><textarea class="form-control" name="mensaje" id="mensaje"></textarea></p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<label>Donativo <span>*</span>:</label>
							<p><input type="text" class="input peque" style="width:100px;" name="donativo" id="donativo" value="" /> <span style="font-size:18px;margin-left:6px;"><?=getValue("SELECT moneda FROM configuracion_base WHERE parroquia = $idparroquia",1);?></span></p>
						</div>
						<div class="col-sm-6">
							<p class="info" style="font-weight:bold;color:#000;text-align:justify;">Antes de formalizar esta domiciliación nos pondremos en contacto con el donante.  Muchas gracias.</p>
						</div>
					</div>

					<div class="clearfix"></div>


						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p style="margin-top:20px;">
						
						
						<button class="g-recaptcha btn btn-success"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitDonativos' 
								data-action='submit'>Remitir datos a la Parroquia</button>
						
						
						</p>

					</div>
	
</form>