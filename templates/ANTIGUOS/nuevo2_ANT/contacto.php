<?php

	$destinatario = getDestinos($idparroquia);

?>

			<div class="noticia">

					<div class="titular-noticia">
						<span><img src="<?=$urlOri;?>templates/nuevo2/images/sobre_naranja.png" alt="Contacta" style="position:relative;top:10px;" /> Contacta con la Parroquia</span></span>
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

					<div class="inputcontact">
						<label>Nombre <span>*</span>:</label>
						<p><input type="text" class="input" name="nombre" id="nombre" value="" /></p>
					</div>

					<div class="inputcontact">
						<label>Apellidos:</label>
						<p><input type="text" class="input" name="apellidos" id="apellidos" value="" /></p>
					</div>

					<div class="inputcontact">
						<label>Teléfono:</label>
						<p><input type="text" class="input" name="telefono" id="telefono" value="" /></p>
					</div>

					<div class="inputcontact">
						<label>E-mail <span>*</span>:</label>
						<p><input type="text" class="input" name="email" id="email" value="" /></p>
					</div>

				<?php if($destinatario != ""){ ?>

					<br><div class="inputcontact">
						<?=$destinatario;?>
					</div>

				<?php } ?>

					<div style="clear:both;"></div>

					<div class="textareacontact">
						<label>Mensaje <span>*</span>:</label>
						<p><textarea name="mensaje" id="mensaje"></textarea></p>
					</div>

					<div style="clear:both;"></div><br />

						<label>Introduzca el código de seguridad:</label>

						<?php

  							require_once('code/recaptchalib.php');
  							$publickey = "6LebBs0SAAAAAEiVPATHkLHycafLhNt1S1EQ1sEV"; // you got this from the signup page
  							echo recaptcha_get_html($publickey);

						?>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p><input type="button" onclick="compruebaContacto();" class="buttonNew whiteNew" style="width:170px;" name="enviar" id="enviar" value="Enviar contacto" /></p>

					</div>
	
				</form>

				</div>

			</div>
