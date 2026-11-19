<div class="row">
	<div class="col-lg-12">			

		<div class="noticia">

					<div class="titular-noticia">
						<span>Peticiones de Oraciones</span></span>
					</div>
					<!-- #titular noticia -->
					<div style="clear:both;"></div>

				<div class="text-noticia">

				<form id="contactoForm" name="contactoForm" method="post" action="dev_oraciones.php">

					<div class="entry contacto">

			<?php 

		if(isset($_GET['msg']) && $_GET['msg'] > 0){ 

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

			<?php if($idparroquia==14){ ?>
				<div align="center">
					<img class="thumbnail" style="width:100%;" src="http://www.unitatcostacalvia.com/images/unitatpeticion.jpg" />
				</div>
			<?php } ?>

			<div class="row">
				<div class="col-lg-12">
					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Nombre:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>Correo electrónico:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="email" id="email" value="" /></p>
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
								<label>Edad:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="edad" id="edad" value="" /></p>
							</div>
						</div>
					</div>

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-4">
								<label>De donde escribes:</label>
							</div>
							<div class="col-xs-8">
								<p><input type="text" class="form-control" name="lugar" id="lugar" value="" /></p>
							</div>
						</div>
					</div>										

					<div class="formOracion">
						<div class="row">
							<div class="col-xs-12">
								<label>Escribe la intención por la que deseas que oremos:</label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
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
	
				</form>

			</div>

		</div>

	</div>
</div>		