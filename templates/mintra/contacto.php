<?php

	$destinatario = getDestinos($idparroquia, 'form-control', false);

?>
			<div class="post">
				<h2 class="title">Contacta con la parroquia</h2>
				<p class="byline"><?=$nombreParroquia;?></p>

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

						<label for="nombre">Nombre <span>*</span>:</label>
						<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>
		
						<label for="apellidos">Apellidos:</label>
						<p><input type="text" class="form-control" name="apellidos" id="apellidos" value="" /></p>

						<label for="telefono">Teléfono:</label>
						<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>

						<label for="email">Correo electrónico <span>*</span>:</label>
						<p><input type="text" class="form-control" name="email" id="email" value="" /></p>

						<p><?=$destinatario;?></p>

						<label for="mensaje">Mensaje <span>*</span>:</label>
						<p><textarea name="mensaje" class="form-control" id="mensaje"></textarea></p>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<button class="g-recaptcha btn btn-success" style="width:170px;" 
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button>

					</div>
	
				</form>

			</div>