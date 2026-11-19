
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

						<label>Nombre <span>*</span>:</label>
						<p><input type="text" class="input" name="nombre" id="nombre" value="" /></p>
		
						<label>Apellidos:</label>
						<p><input type="text" class="input" name="apellidos" id="apellidos" value="" /></p>

						<label>Teléfono:</label>
						<p><input type="text" class="input" name="telefono" id="telefono" value="" /></p>

						<label>Correo electrónico <span>*</span>:</label>
						<p><input type="text" class="input" name="email" id="email" value="" /></p>

						<label>Mensaje <span>*</span>:</label>
						<p><textarea name="mensaje" id="mensaje"></textarea></p>

						<label>Introduzca el código de seguridad:</label>

						<?php

  							require_once('code/recaptchalib.php');
  							$publickey = "6LebBs0SAAAAAEiVPATHkLHycafLhNt1S1EQ1sEV"; // you got this from the signup page
  							echo recaptcha_get_html($publickey);

						?>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p><input type="button" onclick="compruebaContacto();" class="buttonNew whiteNew" style="width:170px;margin-top:10px;" name="enviar" id="enviar" value="Enviar contacto" /></p>

					</div>
	
				</form>

			</div>