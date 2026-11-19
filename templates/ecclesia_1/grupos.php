
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
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class=\"thumbnail\" src=\"$foto\" /></a>";

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

			<div class="noticia">

					<div class="titular-noticia">
						<span><?=$rw['nombre'];?></span>
					</div>

					<!-- #titular noticia -->
					<div style="clear:both;"></div>

					<div class="text-noticia">

					<?php if($imagenPrimera != ""){ ?>
						<div class="photo-article">
							<?=$imagenPrimera;?>	
						</div>
					<?php } ?>	

						<?php 

						$dato = stripslashes($rw['contenido']);

						$dato = convertYoutube($dato);
						echo $dato;
						?>
				
						<?=$imagenes;?>

						<?php
							echo getAdjuntosGrupo($idgrupo);
						?>

				<?php if($permiteContacto == "1" && $emailContacto != ""){	?>
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
							</div>


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

					<p><button class="g-recaptcha btn btn-success" style="margin-top:10px;" 
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button></p>

<input type="hidden" name="idGrupo" id="idGrupo" value="<?=$idgrupo;?>" />
<input type="hidden" name="contactoGrupos" id="contactoGrupos" value="1" />
  <input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />
				</div>
						</div>
						</form>
					<?php } // permite contacto ?>

					</div>

			</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen datos.</h2>";

			}
			else{

				if($idparroquia == 233) $txtGrupos = "Pastoral Castrense";
				else if($idparroquia == 1667) $txtGrupos = "Iniciación Cristiana";
				else $txtGrupos = "Grupos Parroquiales";

			?>

			<div class="noticia">

					<div class="titular-noticia">
						<span><?=$txtGrupos;?></span>
					</div>
					<!-- #titular noticia -->
					<div style="clear:both;"></div>

					<div class="text-noticia">
						<?=allGroups('fa-arrow-right');?>
					</div>
					<div class="separanoticia"></div>
			</div><!--#noticia-->

			<?php } ?>

	</div>
</div>