<?php

	if($mapa === true)
	{
?>

<script type="text/javascript">
  var point = new google.maps.LatLng(<?=$lat;?>, <?=$lng;?>);
  var parliament = new google.maps.LatLng(<?=$lat;?>, <?=$lng;?>);
  var marker;
  var map;
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();

  function initialize() {
    var mapOptions = {
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: point
    };

	directionsDisplay = new google.maps.DirectionsRenderer();

    map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('directions-panel'));

        var control = document.getElementById('control');
        control.style.display = 'block';

          
    marker = new google.maps.Marker({
      map:map,
      draggable:false,
      animation: google.maps.Animation.DROP,
      position: parliament
    });
    google.maps.event.addListener(marker, 'click', toggleBounce);
  }

  function toggleBounce() {

    if (marker.getAnimation() != null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }

      function calcRoute() {

	$.scrollTo('#anclabaja',800);
	$("#directions-panel").show();

        var start = document.getElementById('start').value;
        var end = '<?=$lat;?>, <?=$lng;?>';
        var request = {
          origin: start,
          destination: end,
          travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }

        });
      }

</script>

<?php
	}
?>

			<?php 

				if(isset($_GET['m']) && $_GET['m'] > 0) $idpagina = intval($_GET['m']); else $idpagina = "";

				$bucle = getEstatica($idparroquia, $idpagina);

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);


					// **********************
					// **** IMAGENES ********
					// **********************

					$sql = "SELECT * FROM secciones_fotos WHERE parroquia = $idparroquia AND idseccion = $idpagina ORDER BY idfoto ASC";
					$rs = mysql_query($sql,$conex) or die (mysql_error());

					$imagenes = "";
					$imagenPrimera = "";
					$conta = 0;

					if(mysql_num_rows($rs) == 1)
					{
						$fila = mysql_fetch_assoc($rs);

						$foto = $urlOri."uploads/".$fila['parroquia']."/secciones/mid_".$fila['foto'];
						$urlFoto = $urlOri."uploads/".$fila['parroquia']."/secciones/big_".$fila['foto'];

						$imagenPrimera = "<a href=\"$urlFoto\" rel=\"prettyPhoto[pp_gal]\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlOri."uploads/".$fila['parroquia']."/secciones/mid_".$fila['foto'];
							$urlFoto = $urlOri."uploads/".$fila['parroquia']."/secciones/big_".$fila['foto'];

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
			<h2><?=$rw['titulo'];?></h2>
			<div id="post-content">

<?php if($mapa){ ?>

					<div class="entry mapaa">
						<?=stripslashes($rw['texto']);?>
					</div>

				<h2 class="title">Cómo llegar</h2>
				<p class="byline">Mapa de cómo llegar a la <?=$nombreParroquia;?></p>

					<div id="map_canvas" style="width: 420px; margin-left:10px;height: 380px;text-align:center;border:solid 1px #AA945B;padding:2px;" align="center">Cargando mapa...</div>
    <div id="control">
      <strong>Cómo llegar desde:</strong>
      	<input type="text" class="smallInput small" style="width:130px;" name="start" id="start" value="" />
	<p class="links" style="padding-top:0px;float:right;margin-right:10px;position:relative;top:-8px;font-size:11px;"><a href="javascript:calcRoute();" class="more">Calcular ruta</a></p>
    </div>
    <div id="directions-panel"></div>

				<?php }elseif($rw['txt_int'] == "donativos"){ ?>

					<?php if(isset($_GET['donar']) && $_GET['donar'] == 1){ ?>

					<div class="entry">
						<?php include('form_donativos.php'); ?>
					</div>

					<?php }else{ ?>
						<div class="entry">
							<?=stripslashes($rw['texto']);?>

							<div align="center">
								<form method="get" action"" name="dona" id="dona">
									<input type="hidden" name="donar" id="donar" value="1" />
									<input type="submit" name="boton" id="boton" value="Haz aquí tu donativo" class="buttonNew redNew" />
								</form>
							</div>
						</div>
					<?php } ?>

				<?php }elseif($rw['txt_int'] == "revista_parroquial"){ ?>

					<div class="entry">
						<?=stripslashes($rw['texto']);?>
					</div>

				<?php

					$css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = 0 ORDER BY fecha DESC";
					$rss = mysql_query($css,$conex) or die (mysql_error());

					if(mysql_num_rows($rss) > 0)
					{

						echo "<ul class=\"descarga\">\n";

						while($fila = mysql_fetch_assoc($rss))
						{

							$urlDescarga = $urlOri."descarga.php?file=uploads/$idparroquia/".$fila['archivo'];

							echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['numero']."</a><span>Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."</li>\n";
						}

						echo "</ul>\n";

					}

				?>

				<?php }else{ ?>

						<?=$imagenPrimera;?>
					<div style="clear:both;"></div>

					<?=stripslashes($rw['texto']);?>

					<div style="clear:both;"></div>

					<?php if($rw['adjuntar_documentos'] == 1){

						$css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = ".$rw['id']." ORDER BY fecha DESC";
						$rss = mysql_query($css,$conex) or die (mysql_error());

						if(mysql_num_rows($rss) > 0)
						{

							echo "<h2>Documentos adjuntos:</h2>
							<ul class=\"descarga\">\n";

							while($fila = mysql_fetch_assoc($rss))
							{

								$urlDescarga = $urlOri."descarga.php?file=uploads/$idparroquia/".$fila['archivo'];

								echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['numero']."</a><br><span>Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."</li>\n";
							}

							echo "</ul>\n";

						}

					} ?>

				<?php } ?>



			</div><!--#post-content-->

				<?=$imagenes;?>
	</article>

	</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>
