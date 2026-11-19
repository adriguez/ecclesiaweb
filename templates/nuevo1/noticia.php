			<?php 

				$urlActual = $urlOri.$_SERVER['REDIRECT_URL'];

				if(isset($_GET['m']) && $_GET['m'] > 0) $idnoticia = intval($_GET['m']); else $idnoticia = "";

				$bucle = dameBucle($idparroquia, $numNotis, $idnoticia);

				$bucle = $bucle[0];

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);

					$noticia = stripslashes($rw['noticia']);

					$noticia = convertYoutube($noticia);

					$fecha = explode("-",$rw['fecha']);

					$anyo = $fecha[0];
					$dia = date('d',strtotime($rw['fecha']));
					$mes = $fecha[1];

					$fechaPublicada = $dia."<span>".substr(strtoupper(getMes($mes)),0,3)." ".$anyo."</span>";

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

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/mid_".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

						$imagenPrimera = "<img src=\"$urlFoto\" class=\"thumbnail\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/mid_".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" /></a>";
							else{
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img src=\"$foto\" /></a>";

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
							<span style="margin:0;"><?=$rw['titular'];?></span>
						</div>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

				<div class="text-noticia">
					<?php if($imagenPrimera != ""){ ?>
						<div class="photo-article">
							<?=$imagenPrimera;?>
						</div>
					<?php } ?>		
					<hr />
					<ul class="redes">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlActual;?>" class="facebook"></a></li>
						<li><a href="https://twitter.com/intent/tweet?text=<?=$rw['titular'];?> - <?=$urlActual;?>" class="twitter"></a></li>
						<li><a href="https://plus.google.com/share?url=<?=$urlActual;?>" class="gplus"></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$urlActual;?>&title=<?=$rw['titular'];?>&summary=&source=" class="linkedin"></a></li>
					</ul>
					<div style="clear:both;"></div>
					<hr />

					<?=$noticia;?>
				</div>

				<?=$imagenes;?>

				<?php
					echo getAdjuntosNoticia($idnoticia);
				?>

				<?php echo getComentarios($idnoticia); ?>
		</div>
	</div>
			</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>

