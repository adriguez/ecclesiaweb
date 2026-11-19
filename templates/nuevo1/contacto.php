<?php

	$destinatario = getDestinos($idparroquia);

?>
<div class="row">
	<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia">
						<span>Contacta con la Parroquia</span>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

				<div class="text-noticia">

				<?php if($idparroquia == 1788){ ?>
				
					<b>Datos de contacto:</b><br>
					Tel: 1-809-572-3654<br>
					mail: <a href="mailto:lacatedralsantacruz@gmail.com">lacatedralsantacruz@gmail.com</a>
					<hr/>

				<?php } ?>

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

				<?php if($destinatario != ""){ ?>

					<div class="inputcontact">
						<?=$destinatario;?>
					</div>

				<?php } ?>


						<label>Mensaje <span>*</span>:</label>
						<p><textarea name="mensaje" style="width:100%;" class="form-control" id="mensaje"></textarea></p>

						<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

						<p>
						
						<button class="g-recaptcha btn btn-success"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button></p>

					</div>
	
				</form>

				</div>

				<?php if($idparroquia == 376){ ?>
				
					<div class="row">
						<div class="col-md-3" style="text-align:center;">
							<a href="https://www.instagram.com/parroquiasfp/" target="_blank">
								<img src="<?=$urlOri;?>images/redes/instagram.png" style="width:80%;" alt="Instagram" />
							</a>
						</div>
						<div class="col-md-3" style="text-align:center;">
							<a href="https://www.youtube.com/c/ParroquiaSFP" target="_blank">
								<img src="<?=$urlOri;?>images/redes/youtube.png" style="width:80%;" alt="Youtube" />
							</a>
						</div>
						<div class="col-md-3" style="text-align:center;">
							<a href="https://www.facebook.com/ParroquiaSFP" target="_blank">
								<img src="<?=$urlOri;?>images/redes/facebook.png" style="width:80%;" alt="Facebook" />
							</a>
						</div>
						<div class="col-md-3" style="text-align:center;">
							<a href="https://wa.link/u6dbg5" target="_blank">
								<img src="<?=$urlOri;?>images/redes/whatsapp.png" style="width:80%;" alt="Whatsapp" />
							</a>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>