<?php if(!isset($_GET['m'])){ ?>

			<div class="post">
				<h2 class="title">Galerías fotográficas</h2>
				<p class="byline"><?=$nombreParroquia;?></p>
			</div>

			<?php

				$bucle = getGalerias($idparroquia);

				if(mysql_num_rows($bucle) > 0)
				{
					while($rw = mysql_fetch_assoc($bucle))
					{

						$idgal = $rw['id'];
						$categoria = stripslashes($rw['categoria']);
						$fecha = date('d/m/Y G:i',strtotime($rw['fecha']));
						$numfotos = intval($rw['numfotos']);

						$foto = getValue("SELECT foto FROM galeria_fotos WHERE foto != '' AND categoria = $idgal ORDER BY orden ASC LIMIT 1",1);

						$foto = "timthumb.php?q=100&w=180&h=160&src=uploads/$idparroquia/mid_".$foto;

						$urlGal = $urlOri."galeria-".limpiarCadena($categoria,'archivo')."_".$idgal.".html";

			?>

					<div class="gal">

						<a href="<?=$urlGal;?>">
							<img src="<?=$foto;?>" alt="<?=$categoria;?>" />
							<span class="titulo"><?=$categoria;?></span>
							<span class="ultfecha">Última actualización: <?=$fecha;?></span>
						</a>

					</div>

				<?php } ?>


				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen galerías.</h2>";

			?>

<?php }else{ 

	$idgaleria = intval($_GET['m']);

	$titulo = getValue("SELECT categoria FROM galeria_categorias WHERE parroquia = $idparroquia AND id = $idgaleria",1);

?>

	<script type="text/javascript" charset="utf-8">
  	$(document).ready(function(){
    	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:''});
  	});
	</script>

			<div class="post">
				<h2 class="title"><?=$titulo;?></h2>
				<p class="byline"><?=$nombreParroquia;?></p>
			</div>

			<?php

				$bucle = getGaleria($idparroquia, $idgaleria);

				if(mysql_num_rows($bucle) > 0)
				{

						$conta = 0;

					while($rw = mysql_fetch_assoc($bucle))
					{

						$idgal = $rw['id'];
						$tituloFoto = stripslashes($rw['titulo']);
						$fecha = date('d/m/Y G:i',strtotime($rw['fecha']));

						$foto = $rw['foto'];

						$fotoThumb = $urlOri."uploads/$idparroquia/thb_".$foto;

						$urlFoto = $urlOri."uploads/$idparroquia/big_".$foto;

						$urlDescarga = $urlOri."descarga.php?file=".$urlFoto;
						$urlPrint = $urlOri."print.php?tipo=imagen&file=".$urlFoto;

						$conta++;

			?>

					<div class="galTope">

						<a href="<?=$urlFoto;?>" rel="prettyPhoto[pp_gal]" title="<?=$tituloFoto;?>">
							<img src="<?=$fotoThumb;?>" alt="<?=$tituloFoto;?>" />
							<span class="titulo"><?=$tituloFoto;?></span>
							<span class="ultfecha">Fecha de subida: <?=$fecha;?></span>
						</a>


						<div class="tolbot">
							<a href="<?=$urlPrint;?>" target="_blank" title="Imprimir">
								<img class="sinborder" src="<?=$urlOri;?>images/print.png" /> <span class="topp">Imprimir</span>
							</a>
							<a href="<?=$urlDescarga;?>" title="Descargar">
								<img class="sinborder" src="<?=$urlOri;?>images/download.png" /> <span class="topp">Descargar</span>
							</a>
						</div>

					</div>

				<?php if($conta == 2){ echo "<div style=\"clear:both;\"></div>\n"; $conta = 0; } ?>

				<?php } ?>


				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">La galería a la que intentas acceder no existe.</h2>";

			?>

<?php } ?>