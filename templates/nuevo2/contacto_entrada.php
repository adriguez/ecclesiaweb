<?php

	$destinatario = getDestinos($idparroquia);

?>

<div class="row">
	<div class="col-lg-12">

			<div class="noticia">

					<!-- #titular noticia -->
					<div style="clear:both;"></div>

				<div class="text-noticia">

				<form id="contactoForm" name="contactoForm" method="post" action="dev_contacto.php" enctype="multipart/form-data">

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
					$msg = "El mensaje ha sido enviado correctamente, en caso de ser necesario la parroquia se pondrá en contacto con usted lo más pronto posible."; 
				break;
			} ?>

				<div class="mensaje <?=$tipo;?>">
					<p><?=$msg;?></p>
				</div>

			<?php } ?>


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
								<label>Apellidos <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="apellidos" id="apellidos" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Teléfono <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>E-mail: <span>*</span></label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="email" id="email" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>DNI <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="dni" id="dni" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label style="font-size:11px;">Domicilio completo <span>*</span>:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="direccion" id="direccion" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Adjunto:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="file" class="form-control" name="adjunto" id="adjunto" value="" /></p>
								<small>Sólo se permiten imágenes y ficheros PDF</small>
							</div>
						</div>
					</div>

					<input type="hidden" name="destino" id="destino" value="132" />

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Expone:</label>
							</div>
							<div class="col-xs-8">
								<p><textarea name="mensaje" class="form-control" id="mensaje"></textarea></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<label>Solicita:</label>
							</div>
							<div class="col-xs-8">
								<p><textarea name="solicita" class="form-control" id="solicita"></textarea></p>
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
								data-callback='onSubmitEntrada' 
								data-action='submit'>Enviar mensaje</button>
						</p>

					</div>
					<input type="hidden" name="registroentrada" id="registroentrada" value="1" />
				</form>

				</div>

			</div>

		</div>
	</div>