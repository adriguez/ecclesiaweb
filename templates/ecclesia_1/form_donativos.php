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

							<label><?php if($idparroquia == 587) echo "Nom / "; ?>Nombre <?php if($idparroquia==599) echo "y apellidos"; ?><span>*</span>:</label>
							<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>

							<label><?php if($idparroquia==599) echo "Documento de identidad"; else echo "NIF"; ?>:</label>
							<p><input type="text" class="form-control" name="nif" id="nif" value="" /></p>
						
							<label><?php if($idparroquia == 587) echo "Domicili / "; ?><?php if($idparroquia==599) echo "Dirección"; else echo "Domicilio"; ?>:</label>
							<p><input type="text" class="form-control" name="domicilio" id="domicilio" value="" /></p>
						
							<?php if($idparroquia != 599){ ?>
							<label><?php if($idparroquia == 587) echo "Codi Postal / "; ?>Código Postal:</label>
							<p><input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value="" /></p>
						
							<label><?php if($idparroquia == 587) echo "Població / "; ?>Población:</label>
							<p><input type="text" class="form-control" name="poblacion" id="poblacion" value="" /></p>
							<?php } ?>
						</div>
						<div class="col-sm-6">

							<label>Provincia:</label>
							<p><input type="text" class="form-control" name="provincia" id="provincia" value="" /></p>
						
							<label style="font-size:11px;"><?php if($idparroquia == 587) echo "Correu electrónic / "; ?>Correo electrónico <span>*</span>:</label>
							<p><input type="text" class="form-control" name="email" id="email" value="" /></p>
						
							<label><?php if($idparroquia == 587) echo "Telèfon / "; ?>Teléfono <span>*</span>:</label>
							<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>

							<?php if($idparroquia != 599){ ?>
							<label><?php if($idparroquia == 587) echo "Compte Bancari / "; ?>Cuenta Bancaria <span>*</span>:</label>
							<p><input type="text" class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" value="" /></p>
							<?php } ?>
							
							<label><?php if($idparroquia == 587) echo "Amb caràcter / "; ?>Con carácter:</label>
								<?php
									$sql = "SELECT id, caracter FROM donativos_caracteres ORDER BY caracter ASC";
									$rs = mysql_query($sql,$conex) or die (mysql_error());

									echo "<select name=\"caracter\" class=\"form-control\" style=\"font-size:11px;\" id=\"caracter\">\n";
									

									while($rw = mysql_fetch_assoc($rs)){
											if($rw['id'] == 5 && $idparroquia == 587) $caracter = "Una sola vegada / ".$rw['caracter'];
											else $caracter = $rw['caracter'];
										 echo "<option value=\"".$rw['id']."\">".$caracter."</option>\n";
									}

									echo "</select>\n";
								?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<label><?php if($idparroquia == 587) echo "Missatge / "; ?>Mensaje:</label>
							<p><textarea class="form-control" name="mensaje" id="mensaje"></textarea></p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<label><?php if($idparroquia == 587) echo "Donatiu / "; ?>Donativo <span>*</span>:</label>
							<p><input type="text" class="input peque" style="width:100px;" name="donativo" id="donativo" value="" /> <span style="font-size:18px;margin-left:6px;"><?=getValue("SELECT moneda FROM configuracion_base WHERE parroquia = $idparroquia",1);?></span></p>
						</div>
						<div class="col-sm-6">
							<p class="info" style="<?php if($idparroquia != 587) echo "font-weight:bold;"; ?>color:#000;text-align:justify;"><?php if($idparroquia == 587) echo "(CAT) Abans de formalitzar aquesta domiciliació ens posarem en contacte amb el donant a través del correu electrònic indicat. Moltes gràcies. <br>(ES) Antes de formalizar esta domiciliación nos pondremos en contacto con el donante a través del correo electrónico indicado. Muchas gracias. "; else echo "Antes de formalizar esta domiciliación nos pondremos en contacto con el donante.  Muchas gracias."; ?></p>
						</div>
					</div>

					<div class="clearfix"></div>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p style="margin-top:20px;">
						
						<button class="g-recaptcha btn btn-success"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitDonativos' 
								data-action='submit'><?php if($idparroquia == 587) echo "Enviar dades / "; ?>Enviar datos</button>
						
						</p>

						<?php if($idparroquia == 587){ ?>
							<p>
							<i>De conformitat amb el que es disposa en les normatives vigents en protecció de dades personals, el Reglament (UE) 2016/679, del Parlament Europeu i del Consell, de 27 d'abril de 2016, relatiu a la protecció de les persones físiques pel que fa al tractament de dades personals i a la lliure circulació d'aquestes dades (RGPD) i la Llei Orgànica 3/2018, de 5 de desembre, de Protecció de Dades personals i garantia dels drets digitals (LOPDGDD), l'informem que les teves dades seran tractades per la parròquia de Sant Antoni de Pàdua (Adreça: Plaça Carme Llinás, 1 / Telf: 93 656 16 55), com a responsable del tractament.<br><br>
							La finalitat del tractament és gestionar les donacions efectuades i les relacions amb els nostres donants.<br><br>
							La base de legitimació és el seu consentiment. Conservarem les teves dades mentre sigui necessari per a la finalitat per la qual han estat recollides, d'acord amb els períodes de conservació legals. Les teves dades podran ser cedides a entitats bancàries i altres tercers en cas d'obligació legal.<br><br>
							Podràs exercir el teu dret d'accés, rectificació, supressió, oposició, limitació del tractament, portabilitat o retirar el teu consentiment enviant un escrit a <a href="mailto:noutemple683@bisbatsantfeliu.cat">noutemple683@bisbatsantfeliu.cat</a>.</i>
							</p>
						<?php } ?>

					</div>
	
</form>