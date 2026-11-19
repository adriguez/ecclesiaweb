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

					$fechaPublicada = dameFecha(strtotime($rw['fecha']));

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

						$imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/mid_".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";
							else{
								$imagenes .= "<a href=\"$urlFoto\" title=\"".$rw['titular']."\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class=\"thumbnail\" alt=\"".$rw['titular']."\" src=\"$foto\" /></a>";

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

			<article class="unique-post">

				<?php if($imagenPrimera != ""){ ?>
					<div class="photo-article">
						<?=$imagenPrimera;?>	
					</div>
				<?php } ?>

				<div class="extra-data">
					<span class="glyphicon glyphicon-calendar"></span> <?=$fechaPublicada;?>
					<span class="glyphicon glyphicon-folder-close"></span> <a href="<?=$urlCat;?>"><?=$catTxt;?></a>
				</div>
				
				<hr />
				<h1><?=$rw['titular'];?></h1>

					<hr />
					<ul class="redes">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlActual;?>" class="facebook"></a></li>
						<li><a href="https://twitter.com/intent/tweet?text=<?=$rw['titular'];?> - <?=$urlActual;?>" class="twitter"></a></li>
						<li><a href="https://plus.google.com/share?url=<?=$urlActual;?>" class="gplus"></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$urlActual;?>&title=<?=$rw['titular'];?>&summary=&source=" class="linkedin"></a></li>
					</ul>
					<div style="clear:both;"></div>
					<hr />

				<div class="post-content">
					<?=$noticia;?>
				</div>

				<?=$imagenes;?>

				<?php
					echo getAdjuntosNoticia($idnoticia);
				?>

			<?php echo getComentarios($idnoticia); ?>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>

			</article>

		</div>
	</div>
