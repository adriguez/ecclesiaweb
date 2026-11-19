<section id="contact-form" class="form-main-block form-two form-three">
    <div class="section">
	</div>
    <div class="container">
        <div class="row">
        	<div class="contact-form-block">

				<form id="donativosForm" name="donativosForm" method="post" action="/dev_donativos.php">

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
					
					<div class="col-sm-12">          
                  		<div class="form-group">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="<?php if($idioma == "en") echo "First name"; else echo "Nombre"; ?>:" value="" required />
                		</div>
                	</div><?php if($idparroquia != 1319){ ?>
					<div class="col-sm-3">
                  		<div class="form-group">
							<input type="text" class="form-control" name="nif" id="nif" placeholder="NIF:" value="" />
                		</div>
                	</div><?php } ?>

					<div class="col-sm-9">
                  		<div class="form-group">
							<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="<?php if($idioma == "en") echo "Address"; else echo "Domicilio"; ?>:" value="" />
                		</div>
                	</div>
<?php if($idparroquia != 1319){ ?>
					<div class="col-sm-2">
                  		<div class="form-group">
							<input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="<?php if($idioma == "en") echo "Postal Code"; else echo "Código Postal"; ?>:" value="" />
                		</div>
                	</div>

					<div class="col-sm-7">
                  		<div class="form-group">
							<input type="text" class="form-control" name="poblacion" id="poblacion" placeholder="<?php if($idioma == "en") echo "Town"; else echo "Población"; ?>:" value="" />
                		</div>
                	</div>
<?php } ?>
					
					<div class="col-sm-3">
                  		<div class="form-group">
							<input type="text" class="form-control" name="provincia" id="provincia" placeholder="<?php if($idioma == "en") echo "City"; else echo "Provincia"; ?>:" value="" />
                		</div>
                	</div>

					<div class="col-sm-10">
                  		<div class="form-group">
							<input type="text" class="form-control" name="email" id="email" placeholder="<?php if($idioma == "en") echo "Email"; else echo "Correo electrónico"; ?>" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-2">
                  		<div class="form-group">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="<?php if($idioma == "en") echo "Phone"; else echo "Teléfono"; ?>" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-8">
                  		<div class="form-group">
							<input type="text" class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" placeholder="<?php if($idioma == "en") echo "Account bank"; else echo "Cuenta bancaria"; ?>" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-4">
                  		<div class="form-group">
						
								<?php
									$sql = "SELECT id, caracter, caracter_en FROM donativos_caracteres ORDER BY caracter ASC";
									$rs_ca = mysql_query($sql,$conex) or die (mysql_error());

									if($idioma == "en"){
										echo "<select name=\"caracter\" class=\"form-control\"  placeholder=\"Type:\" id=\"caracter\">\n";
										while($rw_ca = mysql_fetch_assoc($rs_ca)) echo "<option value=\"".$rw_ca['id']."\"> Type: ".$rw_ca['caracter_en']."</option>\n";
									}else{
										echo "<select name=\"caracter\" class=\"form-control\"  placeholder=\"Con carácter:\" id=\"caracter\">\n";
										while($rw_ca = mysql_fetch_assoc($rs_ca)) echo "<option value=\"".$rw_ca['id']."\"> Con carácter: ".$rw_ca['caracter']."</option>\n";
									}

									echo "</select>\n";
								?>
						</div>
					</div>
					
						
					<div class="col-sm-12">
                  		<div class="form-group">
							<textarea class="form-control" name="mensaje" id="mensaje" placeholder="<?php if($idioma == "en") echo "Message"; else echo "Mensaje"; ?>:"></textarea>
						</div>
					</div>

					<div class="col-sm-6">
                  		<div class="form-group">
							<input type="text" class="form-control"
							 style="width:200px;" name="donativo" id="donativo" 
							 placeholder="<?=substr($donativosTxt, 0, strlen($donativos)-1);?> <?php if($idioma == "en") echo "in"; else echo "en"; ?> <?=getValue("SELECT moneda FROM configuracion_base WHERE parroquia = $idparroquia",1);?>" 
							 value="" required /> 
							
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<p><?php if($idioma == "en") echo "Before formalizing this direct debit we will contact the donor.  Thank you very much."; else echo "Antes de formalizar esta domiciliación nos pondremos en contacto con el donante.  Muchas gracias."; ?></p>
						</div>
					</div>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

 					<div class="col-sm-12">
 						<span><a href="#">						
						<button class="g-recaptcha btn btn-default"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitDonativos' 
								data-action='submit'><?php if($idioma == "en") echo "Send form"; else echo "Remitir datos a la Parroquia"; ?></button>
						
						</a></span>
					</div>
	
</form>
        </div>
      </div>
    </div>
  </section> 