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

						<label for="nombre">Nombre:</label>
						<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>
		
						<label for="email">Correo electrónico:</label>
						<p><input type="text" class="form-control" name="email" id="email" value="" /></p>

						<label for="email">Teléfono:</label>
						<p><input type="text" class="form-control" name="telefono" id="telefono" value="" /></p>

						<label for="edad">Edad:</label>
						<p><input type="text" class="form-control" name="edad" id="edad" value="" /></p>

						<label for="lugar">Lugar desde el que nos escribes:</label>
						<p><input type="text" class="form-control" name="lugar" id="lugar" value="" /></p>

						<label for="mensaje">Escribe aquí la intención por la que deseas que oremos:</label>
						<p><textarea name="mensaje" class="form-control" id="mensaje"></textarea></p>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

<button class="g-recaptcha btn btn-success" style="width:170px;" 
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar mensaje</button>

					</div>
	
				</form>

			</div>