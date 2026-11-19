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

							<label>Nombre <span>*</span>:</label>
							<p><input type="text" class="form-control input" name="nombre" id="nombre" value="" /></p>

							<label><?php if($idparroquia==825) echo "Identificación"; else echo "NIF";?>:</label>
							<p><input type="text" class="form-control input" name="nif" id="nif" value="" /></p>
						
							<label><?php if($idparroquia==825) echo "Dirección"; else echo "Domicilio";?>:</label>
							<p><input type="text" class="form-control input" name="domicilio" id="domicilio" value="" /></p>
						
							<?php if($idparroquia!=825){ ?><label>Código Postal:</label>
							<p><input type="text" class="form-control input" name="codigo_postal" id="codigo_postal" value="" /></p>
						
							<label>Población:</label>
							<p><input type="text" class="form-control input" name="poblacion" id="poblacion" value="" /></p>

							<?php } ?>
					
						</div>
						<div class="col-sm-6">

							<label>Provincia:</label>
							<p><input type="text" class="form-control input" name="provincia" id="provincia" value="" /></p>
						
							<label>Correo electrónico <span>*</span>:</label>
							<p><input type="text" class="form-control input" name="email" id="email" value="" /></p>
						
							<label>Teléfono <span>*</span>:</label>
							<p><input type="text" class="form-control input" name="telefono" id="telefono" value="" /></p>
						
							<?php if($idparroquia!=825){ ?>
								<label>Cuenta Bancaria <span>*</span>:</label>
							<p><input type="text" class="form-control input" name="cuenta_bancaria" id="cuenta_bancaria" value="" /></p>
							<?php } ?>
						
							<label>Con carácter:</label>
								<?php
									$sql = "SELECT id, caracter FROM donativos_caracteres ORDER BY caracter ASC";
									$rs = mysql_query($sql,$conex) or die (mysql_error());

									echo "<select name=\"caracter\" class=\"form-control  input\" style=\"font-size:11px;\" id=\"caracter\">\n";

									while($rw = mysql_fetch_assoc($rs)) echo "<option value=\"".$rw['id']."\">".$rw['caracter']."</option>\n";

									echo "</select>\n";
								?>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row">
						<div class="col-lg-12">
							<label>Mensaje:</label>
							<p><textarea name="mensaje" style="width:100%;" id="mensaje"></textarea></p>
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

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p>
						
						<button class="g-recaptcha buttonNew redNew" style="width:170px;"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitDonativos' 
								data-action='submit'>Remitir datos a la Parroquia</button>
												
						</p>

					</div>
	
</form>