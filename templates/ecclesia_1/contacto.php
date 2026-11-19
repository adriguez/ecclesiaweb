<?php

	$destinatario = getDestinos($idparroquia, 'form-control');

?>

<div class="row">
	<div class="col-lg-12">

			<div class="noticia">

					<div class="titular-noticia">
						<span><img src="<?=$urlOri;?>templates/ecclesia_1/images/sobre_naranja.png" alt="Contacta" /> Contacta con la Parroquia</span></span>
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

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-12 destino">
								<?=$destinatario;?>
							</div>
						</div>
					</div>

				<?php } ?>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Mensaje <span>*</span>:</label>
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

						<?php if($idparroquia == 30){ ?>
						<p>Al enviar este formulario, acepta las condiciones generales del servicio,
							<a href="<?=$urlRecursos;?>/uploads/30/Informacion_de_privacidad.pdf" title="Información de privacidad">Información de privacidad</a></p>
						<?php } ?>


<p><button class="g-recaptcha btn btn-success" style="margin-top:10px;" 
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button></p>

					</div>
	
				</form>

				</div>

			</div>

		</div>
	</div>