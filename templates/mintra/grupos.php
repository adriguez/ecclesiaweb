
	<div class="row">
		<div class="col-lg-12">
			<?php 

				if(isset($_GET['m']) && $_GET['m'] > 0) $idgrupo = intval($_GET['m']); else $idgrupo = "";

				if($idgrupo > 0)
				{

				$bucle = getGrupos($idparroquia, $idgrupo);

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);

					// **********************
					// **** IMAGENES ********
					// **********************

					$sql = "SELECT * FROM grupos_fotos WHERE parroquia = $idparroquia AND idgrupo = $idgrupo ORDER BY idfoto ASC";
					$rs = mysql_query($sql,$conex) or die (mysql_error());

					$imagenes = "";
					$imagenPrimera = "";
					$conta = 0;

					if(mysql_num_rows($rs) == 1)
					{
						$fila = mysql_fetch_assoc($rs);

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

						$imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";
							else{
								$imagenes .= "<a href=\"$urlFoto\"  class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img src=\"$foto\" /></a>";

							}
						}
					}

					$valContacto = getValue("SELECT permitir_contacto, email_contacto FROM grupos_pastorales WHERE id = '$idgrupo'",0);
					$permiteContacto = $valContacto[0];
					$emailContacto = $valContacto[1];


					// **********************
					// **********************
					// **********************

				?>


				<script type="text/javascript" language="javascript">

				jQuery(document).ready(function() {
					jQuery(".fancybox-thumb").fancybox({
						prevEffect	: 'none',
						nextEffect	: 'none',
						helpers	: {
							title	: {
								type: 'inside'
							},
							thumbs	: {
								width	: 50,
								height	: 50
							}
						}
					});
				});

				</script>

	<article>
			<div class="post">
				<h2 class="title"><?=$rw['nombre'];?></h2>
			<div id="post-content">

					<div class="entry">

					<?php if($imagenPrimera != ""){ ?>
						<div class="photo-article">
							<?=$imagenPrimera;?>	
						</div>
					<?php } ?>	
						
						<?php $noticia = convertYoutube($rw['contenido']);
							
							echo stripslashes($noticia);
						?>
						
					</div>

				<?=$imagenes;?>

				<?php

					echo getAdjuntosGrupo($idgrupo);

				?>

				<?php if($permiteContacto == "1" && $emailContacto != ""){

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
								$msg = "El mensaje ha sido enviado correctamente."; 
							break;
						} 

						$msg = '<h5>'.$msg.'</h5>';

					}
				?>
				<div class="mensaje <?=$tipo;?>">
					<p><?=$msg;?></p>
				</div>

				<form id="contactoForm" name="contactoForm" method="post" action="dev_contacto.php">

					<div class="entry contacto">
					<label for="nombre">Nombre <span>*</span>:</label>
						<p><input type="text" class="form-control" name="nombre" id="nombre" value="" /></p>
		
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
				<input type="hidden" name="idGrupo" id="idGrupo" value="<?=$idgrupo;?>" />
				<input type="hidden" name="contactoGrupos" id="contactoGrupos" value="1" />
              	<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />
			</form>
			<?php } // permite contacto ?>

			</div><!--#post-content-->
	</article>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen datos.</h2>";

			}
			else{

			?>

	<article>
			<div class="post">
				<h2 class="title">Grupos Parroquiales</h2>
			<div id="post-content">

					<div class="entry">
						<?=allGroups();?>
					</div>

			</div><!--#post-content-->
	</article>

			<?php } ?>

</div>
</div>