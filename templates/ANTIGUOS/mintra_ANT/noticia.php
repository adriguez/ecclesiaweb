			<?php 

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

						$foto = $urlOri."uploads/".$fila['parroquia']."/noticias/mid_".$fila['foto'];
						$urlFoto = $urlOri."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

						$imagenPrimera = "<a href=\"$urlFoto\" rel=\"prettyPhoto[pp_gal]\"><img style=\"border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlOri."uploads/".$fila['parroquia']."/noticias/mid_".$fila['foto'];
							$urlFoto = $urlOri."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<a href=\"$urlFoto\" rel=\"prettyPhoto[pp_gal]\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";
							else{
								$imagenes .= "<a href=\"$urlFoto\" rel=\"prettyPhoto[pp_gal]\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";

							}
						}
					}


					// **********************
					// **********************
					// **********************

				?>

	<script type="text/javascript" charset="utf-8">
  	$(document).ready(function(){
    	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:''});
  	});
	</script>

			<div class="post">
				<h2 class="title"><?=$rw['titular'];?></h2>
				<p class="byline"><small>Publicada el <?=$fechaPublicada;?> en la categoría <a href="<?=$urlCat;?>" style="font-weight:bold;"><?=$catTxt;?></a></small></p>
				<div class="entry">
					<?=$imagenPrimera;?>
					<?=$noticia;?>
				</div>

				<?=$imagenes;?>
			</div>

			<?php echo getComentarios($idnoticia); ?>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>

