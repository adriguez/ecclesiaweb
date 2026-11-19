			<div class="post">
				<h2 class="title">Petición de oraciones</h2>

				<form id="contactoForm" name="contactoForm" method="post" action="dev_oraciones.php">

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
					$msg = "La petición de oración ha sido enviada correctamente. Muchas gracias."; 
				break;
			} ?>

				<div class="mensaje <?=$tipo;?>">
					<p><?=$msg;?></p>
				</div>

			<?php } ?>

			<?php $pre = getValue("SELECT pre_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1);

				if($pre != "")
				{
					echo "<div class=\"preoraciones\">".convertYoutube($pre)."</div>\n";
				}
			?>

						<label>Nombre:</label>
						<p><input type="text" class="input" name="nombre" id="nombre" value="" /></p>
		
						<label>Correo electrónico:</label>
						<p><input type="text" class="input" name="email" id="email" value="" /></p>

						<label>Edad:</label>
						<p><input type="text" class="input" name="edad" id="edad" value="" /></p>

						<label>Lugar desde el que nos escribes:</label>
						<p><input type="text" class="input" name="lugar" id="lugar" value="" /></p>

						<label>Escribe aquí la intención por la que deseas que oremos:</label>
						<p><textarea name="mensaje" id="mensaje"></textarea></p>

						<label>Introduzca el código de seguridad:</label>

						<?php

  							require_once('code/recaptchalib.php');
  							$publickey = "6LebBs0SAAAAAEiVPATHkLHycafLhNt1S1EQ1sEV"; // you got this from the signup page
  							echo recaptcha_get_html($publickey);

						?>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p><input type="submit" class="buttonNew whiteNew" style="width:170px;" name="enviar" id="enviar" value="Enviar mensaje" /></p>

					</div>
	
				</form>

			</div>