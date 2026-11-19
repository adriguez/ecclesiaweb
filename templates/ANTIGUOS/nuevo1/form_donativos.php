<form id="donativosForm" name="donativosForm" method="post" action="dev_donativos.php">

					<div class="entry donativos">

				<?php if(isset($_GET['msg']) && $_GET['msg'] > 0){ ?>
			<div class="error">
				<?php switch($_GET['msg'])
					{
						case 1; echo "El código de seguridad introducido es incorrecto."; break;
						case 2; echo "Los campos con asteriscos son obligatorios"; break;
						case 3; echo "El formulario se ha enviado con éxito, en breve nos pondrémos en contacto con usted."; break;
					}
				?>
			</div>
				<?php } ?>

					<div style="width:230px;float:left;">
						<label>Nombre <span>*</span>:</label>
						<p><input type="text" class="input" name="nombre" id="nombre" value="" /></p>

					</div>
					<div style="width:150px;float:left;margin-left:30px;">
						<label>NIF:</label>
						<p><input type="text" class="input peque" name="nif" id="nif" value="" /></p>
					</div>

					<div style="clear:both;"></div>

					<div style="width:230px;float:left;">
						<label>Domicilio:</label>
						<p><input type="text" class="input" name="domicilio" id="domicilio" value="" /></p>
					</div>

					<div style="width:150px;float:left;margin-left:30px;">
						<label>Código Postal:</label>
						<p><input type="text" class="input peque" name="codigo_postal" id="codigo_postal" value="" /></p>
					</div>

					<div style="clear:both;"></div>

					<div style="width:230px;float:left;">
						<label>Población:</label>
						<p><input type="text" class="input midle" name="poblacion" id="poblacion" value="" /></p>
					</div>

					<div style="width:150px;float:left;margin-left:30px;">
						<label>Provincia:</label>
						<p><input type="text" class="input midle" name="provincia" id="provincia" value="" /></p>
					</div>

					<div style="clear:both;"></div>

					<div style="width:230px;float:left;">
						<label>Correo electrónico <span>*</span>:</label>
						<p><input type="text" class="input" name="email" id="email" value="" /></p>
					</div>

					<div style="width:150px;float:left;margin-left:30px;">
						<label>Teléfono <span>*</span>:</label>
						<p><input type="text" class="input peque" name="telefono" id="telefono" value="" /></p>
					</div>

					<div style="clear:both;"></div>

					<div style="width:250px;float:left;">
						<label>Cuenta Bancaria <span>*</span>:</label>
						<p><input type="text" class="input" name="cuenta_bancaria" id="cuenta_bancaria" value="" /></p>
					</div>


					<div style="width:150px;float:left;margin-left:30px;">
						<label>Con carácter:</label>
							<?php
								$sql = "SELECT id, caracter FROM donativos_caracteres ORDER BY caracter ASC";
								$rs = mysql_query($sql,$conex) or die (mysql_error());

								echo "<select name=\"caracter\" style=\"width:150px;\" id=\"caracter\">\n";

								while($rw = mysql_fetch_assoc($rs)) echo "<option value=\"".$rw['id']."\">".$rw['caracter']."</option>\n";

								echo "</select>\n";
							?>
					</div>

					<div style="clear:both;"></div>

						<label>Mensaje:</label>
						<p><textarea name="mensaje" id="mensaje"></textarea></p>

					<div style="width:180px;float:left;">
						<label>Donativo <span>*</span>:</label>
						<p><input type="text" class="input peque" style="width:100px;" name="donativo" id="donativo" value="" /> <span style="font-size:18px;margin-left:6px;">Euros</span></p>
					</div>
					<div style="width:250px;float:left;">
						<p class="info" style="font-weight:bold;color:#000;border-left:dotted 1px #333;padding-left:20px;text-align:justify;">Antes de formalizar esta domiciliación nos pondremos en contacto con el donante.  Muchas gracias.</p>
					</div>

					<div style="clear:both;"></div>


					<label>Introduzca el código de seguridad:</label>

					<?php

  						require_once('code/recaptchalib.php');
  						$publickey = "6LebBs0SAAAAAEiVPATHkLHycafLhNt1S1EQ1sEV"; // you got this from the signup page
  						echo recaptcha_get_html($publickey);

					?>


						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p><input type="button" onclick="compruebaDonativo();" class="buttonNew redNew" style="width:170px;" name="enviar" id="enviar" value="Remitir datos a la Parroquia" /></p>

					</div>
	
</form>