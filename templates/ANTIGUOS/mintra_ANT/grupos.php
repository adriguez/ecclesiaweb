
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

						$foto = $urlOri."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
						$urlFoto = $urlOri."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

						$imagenPrimera = "<a href=\"$urlFoto\" rel=\"prettyPhoto[pp_gal]\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlOri."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
							$urlFoto = $urlOri."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

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

	<div class="post type-post hentry category-belief-practice post cat-11-id">

	<script type="text/javascript" charset="utf-8">
  	$(document).ready(function(){
    	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:''});
  	});
	</script>

	<article>
			<div class="post">
				<h2 class="title"><?=$rw['nombre'];?></h2>
			<div id="post-content">

					<div class="entry">
						<?=$imagenPrimera;?>
						<?=stripslashes($rw['contenido']);?>
					</div>

				<?=$imagenes;?>

				<?php

					echo getAdjuntosGrupo($idgrupo);

				?>



			</div><!--#post-content-->
	</article>

	</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen datos.</h2>";

			}
			else{

			?>

	<div class="post type-post hentry category-belief-practice post cat-11-id">

	<article>
			<div class="post">
				<h2 class="title">Grupos Parroquiales</h2>
			<div id="post-content">

					<div class="entry">
						<?=allGroups();?>
					</div>

			</div><!--#post-content-->
	</article>

	</div>

			<?php } ?>