<?php

	$destinatario = getDestinos($idparroquia);

?>

<div class="row">
	<div class="col-lg-12">

			<div class="noticia">

					<div class="titular-noticia">
						<span><img src="<?=$urlOri;?>templates/nuevo2/images/sobre_naranja.png" alt="Contacta" /> JMJ Lisboa 2023</span></span>
					</div>
					<!-- #titular noticia -->
					<div style="clear:both;"></div>

				<div class="text-noticia">

				<form id="contactoForm" name="contactoForm" method="post" action="dev_contacto.php">

					<div class="entry contacto">

			<?php if(isset($_GET['msg']) && $_GET['msg'] > 0){ 

			switch(intval($_GET['msg']))
			{
				case 1;
					$tipo = "error";
					$msg = "El código de seguridad introducido es incorrecto";
				break;

				case 2; 
					$tipo = "error"; 
					$msg = "Faltan campos obligatorios por rellenar."; 
				break;

				case 3; 
					$tipo = "exito";
					$msg = "El mensaje ha sido enviado correctamente, la parroquia se pondrá en contacto con usted lo más pronto posible."; 
				break;
			} ?>

				<div class="mensaje <?=$tipo;?>">
					<p><?=$msg;?></p>
				</div>

			<?php } ?>

			<?php /* if($idparroquia==14){ ?>

				<p>Puede contactar con los sacerdotes a través de los siguientes números de teléfono:</p>

				<ul>
					<li>Miguel Angel: <b>658 892 373</b> (diacono)</li>
					<li>Diego León: <b>696 893 145</b></li>
					<li>Pep Toni: <b>606 379 832</b></li>
				</ul>

				<p>O también usar el siguiente formulario de contacto:</p>

			<?php } */ ?>


			<div class="row">
				<div class="col-lg-12">

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Nombre <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Apellidos:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="apellidos" id="apellidos" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Teléfono:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>E-mail <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="email" id="email" value="" /></p>
							</div>
						</div>
					</div>

				<?php if($destinatario != ""){ ?>

					<br><div class="inputcontact">
						<?=$destinatario;?>
					</div>

				<?php } ?>
				
				<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Dirección:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="direccion" id="direccion" value="" /></p>
							</div>
						</div>
					</div>
					
					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Fecha de nacimiento:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="fechanacimiento" id="fechanacimiento" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Porqué desea ir a la JMJ Lisboa 2023 <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><textarea name="mensaje" class="form-control" id="mensaje"></textarea></p>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="clearfix"></div>
			
						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p style="margin-top:10px;">
						<button class="g-recaptcha btn btn-success"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar mensaje</button>
						</p>

					</div>
					
					<input type="hidden" name="jmj2023lisboa" id="jmjlisboa2023" value="1" />
	
				</form>

				</div>

			</div>

		</div>
	</div>