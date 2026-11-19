			<?php 

				if(isset($_GET['m']) && $_GET['m'] > 0) $idnoticia = intval($_GET['m']); else $idnoticia = "";

				$bucle = dameBucle($idparroquia, $numNotis, $idnoticia);

				$bucle = $bucle[0];

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);

					$fechaPublicada = dameFecha(strtotime($rw['fecha']));

					$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

					$urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";

				?>

			<div class="post">
				<h2 class="title"><?=$rw['titular'];?></h2>
				<p class="byline"><small>Publicada el <?=$fechaPublicada;?> en la categoría <a href="<?=$urlCat;?>" style="font-weight:bold;"><?=$catTxt;?></a></small></p>
				<div class="entry">
					<?=stripslashes($rw['noticia']);?>
				</div>
			</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>

