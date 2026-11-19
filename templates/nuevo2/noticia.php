			<?php 

				$urlActual = $urlOri.$_SERVER['REDIRECT_URL'];

				if(isset($_GET['m']) && $_GET['m'] > 0) $idnoticia = intval($_GET['m']); else $idnoticia = "";

				$bucle = dameBucle($idparroquia, $numNotis, $idnoticia, 0, '', '', 'single');

				$bucle = $bucle[0];

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);

					$noticia = stripslashes($rw['noticia']);
					$noticia = convertYoutube($noticia);

					$fecha = date('Y-m-d',strtotime($rw['fecha']));
					$fecha = explode("-",$fecha);

					$anyo = $fecha[0];
					$dia = $fecha[2];
					$mes = $fecha[1];

					$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;

					$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

					$urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";

					// **********************
					// **** IMAGENES ********
					// **********************

					$sql = "SELECT * FROM noticias_fotos WHERE parroquia = $idparroquia AND idnoticia = $idnoticia ORDER BY idfoto ASC";
					$rs = mysql_query($sql,$conex) or die (mysql_error());

					$imagenes = "";
					$imagenPrimera = "";
					$conta = 0;

					if(mysql_num_rows($rs) == 1)
					{
						$fila = mysql_fetch_assoc($rs);

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];

						$imagenPrimera = "<img class=\"thumbnail\" style=\"width:100%;\" src=\"$urlFoto\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" style=\"width:100%;\" alt=\"".$rw['titular']."\" src=\"$foto\" />";
							else{
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img  style=\"width:100%;\" alt=\"".$rw['titular']."\" src=\"$foto\" /></a>";

							}
						}
					}


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


	<div class="row">
		<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia row">
						<div class="col-lg-2">
							<div class="fecha"><?=$fechaPublicada;?></div>
						</div>
						<div class="col-lg-10" style="padding:0;">
							<h1><?=$rw['titular'];?></h1>
						</div>
					</div>
					<!-- #titular noticia -->

				<div class="text-noticia">
					<?php if($imagenPrimera != ""){ ?>
						<div class="photo-article">
							<a href="<?=str_replace("/mid_","/",$foto);?>" target="_blank"><?=$imagenPrimera;?></a>
						</div>
					<?php } ?>
					<hr />
					<?php if($idparroquia == 1131) echo "<b>¡Visita nuestras redes sociales!</b><br>"; ?>
					<ul class="redesnoWindow">
						<?php if($idparroquia == 1473){ ?>
							<li><a href="https://www.facebook.com/ParroquiaPereptuoSocorro.pjc" target="_blank" class="facebook"></a></li>
							<li><a href="https://www.instagram.com/p/CyiovKxuHbR/" target="_blank" class="instagram"></a></li>
							<li><a href="https://www.youtube.com/channel/UCobGaeGGIo2u-m12lkS1oTg" class="youtube"></a></li>
							<li><a href="https://api.whatsapp.com/send/?phone=+595971822959" class="whatsapp"></a></li>
						<?php }else if($idparroquia == 1131){ ?>
							<li><a href="https://www.facebook.com/share/1HBzwaA1XT/" target="_blank" class="facebook"></a></li>
							<li><a href="https://www.instagram.com/iglesiamiguelturra?igsh=MWExdXNtZHMzcXJoZA==" target="_blank" class="instagram"></a></li>
							<li><a href="https://www.youtube.com/@IglesiaMiguelturra" class="youtube"></a></li>
							<li><a href="https://whatsapp.com/channel/0029VasSgcTE50UovoRdiz18" style="position:static;" class="whatsapp"></a></li>
						<?php }else{ ?>
					<ul class="redes">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlActual;?>" class="facebook"></a></li>
						<li><a href="https://twitter.com/intent/tweet?text=<?=$rw['titular'];?> - <?=$urlActual;?>" class="twitter"></a></li>
						<li><a href="https://plus.google.com/share?url=<?=$urlActual;?>" class="gplus"></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$urlActual;?>&title=<?=$rw['titular'];?>&summary=&source=" class="linkedin"></a></li>
						<?php } ?>
					</ul>
					<div style="clear:both;"></div>
					<hr />
					<?=$noticia;?>
					<hr />
				</div>

				<?=$imagenes;?>

				<?php
					echo getAdjuntosNoticia($idnoticia);
				?>

				<div class="clearfix"></div>
				<?php echo getComentarios($idnoticia); ?>

			</div>
		</div>
	</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>

