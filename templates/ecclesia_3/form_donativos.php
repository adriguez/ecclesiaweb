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
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre:" value="" required />
                		</div>
                	</div><?php if($idparroquia != 1319){ ?>
					<div class="col-sm-3">
                  		<div class="form-group">
							<input type="text" class="form-control" name="nif" id="nif" placeholder="NIF:" value="" />
                		</div>
                	</div><?php } ?>

					<div class="col-sm-9">
                  		<div class="form-group">
							<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio:" value="" />
                		</div>
                	</div>
<?php if($idparroquia != 1319){ ?>
					<div class="col-sm-2">
                  		<div class="form-group">
							<input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="Código Postal:" value="" />
                		</div>
                	</div>

					<div class="col-sm-7">
                  		<div class="form-group">
							<input type="text" class="form-control" name="poblacion" id="poblacion" placeholder="Población:" value="" />
                		</div>
                	</div>
<?php } ?>
					
					<div class="col-sm-3">
                  		<div class="form-group">
							<input type="text" class="form-control" name="provincia" id="provincia" placeholder="Provincia:" value="" />
                		</div>
                	</div>

					<div class="col-sm-10">
                  		<div class="form-group">
							<input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-2">
                  		<div class="form-group">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-8">
                  		<div class="form-group">
							<input type="text" class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" placeholder="Cuenta Bancaria" value="" required />
                		</div>
                	</div>

						
					<div class="col-sm-4">
                  		<div class="form-group">
						
								<?php
									$sql = "SELECT id, caracter FROM donativos_caracteres ORDER BY caracter ASC";
									$rs_ca = mysql_query($sql,$conex) or die (mysql_error());

									echo "<select name=\"caracter\" class=\"form-control\"  placeholder=\"Con carácter:\" id=\"caracter\">\n";

									while($rw_ca = mysql_fetch_assoc($rs_ca)) echo "<option value=\"".$rw_ca['id']."\"> Con carácter: ".$rw_ca['caracter']."</option>\n";

									echo "</select>\n";
								?>
						</div>
					</div>
					
						
					<div class="col-sm-12">
                  		<div class="form-group">
							<textarea class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje:"></textarea>
						</div>
					</div>

					<div class="col-sm-6">
                  		<div class="form-group">
							<input type="text" class="form-control"
							 style="width:200px;" name="donativo" id="donativo" 
							 placeholder="<?=substr($donativosTxt, 0, strlen($donativos)-1);?> en <?=getValue("SELECT moneda FROM configuracion_base WHERE parroquia = $idparroquia",1);?>" 
							 value="" required /> 
							
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<p>Antes de formalizar esta domiciliación nos pondremos en contacto con el donante.  Muchas gracias.</p>
						</div>
					</div>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

 					<div class="col-sm-12">
 						<span><a href="#">						
						<button class="g-recaptcha btn btn-default"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitDonativos' 
								data-action='submit'>Remitir datos a la Parroquia</button>
						
						</a></span>
					</div>
	
</form>
        </div>
      </div>
    </div>
  </section> 