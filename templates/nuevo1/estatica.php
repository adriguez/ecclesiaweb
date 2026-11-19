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
			
			if(isset($_GET['m']) && $_GET['m'] == "misaonline"){
			
			$val = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
			
			$codYoutube = explode("?v=", $val['urlmisa']);
			if(isset($codYoutube[1]) && $codYoutube[1] != "")
			{
				$codYoutube = $codYoutube[1];
			}
			else if(substr_count($val['urlmisa'], 'youtu.be') > 0){
				$codYoutube = explode("/",$val['urlmisa']);
				if(isset($codYoutube[3]) && strlen(trim($codYoutube[3])) == 11) $codYoutube = trim($codYoutube[3]);
				else $codYoutube = "";
			}
			else if(substr_count($val['urlmisa'], '.com/live/') > 0){
				$codYoutube = explode("/",$val['urlmisa']);
				if(isset($codYoutube[4]) && strlen(trim($codYoutube[4])) == 11) $codYoutube = trim($codYoutube[4]);
				else $codYoutube = "";
			}
			else $codYoutube = "";
			
			$cuerpo = stripslashes($val['cuerpo']);
			?>
			
			
	<div class="row">
		<div class="col-lg-12">

			<div class="noticia">

					<div class="titular-noticia">
						<span>Misa online</span>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<div class="text-noticia">						
						<?php if($codYoutube != ""){ ?>
							<br><iframe width="100%" height="400" border="0" src="https://www.youtube.com/embed/<?=$codYoutube;?>"></iframe>
						<?php } ?>
						
						<p><?=$cuerpo;?></p>
					</div>
			</div>
		</div>
	</div>
			
			<?php }else{

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

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/mid_".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/big_".$fila['foto'];

						if($fila['parroquia'] == 19){
							$imagenPrimera = "<img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;width:100%;\" src=\"$urlFoto\" />
							<div style=\"clear:both;\"></div>\n";
						}else{
							$imagenPrimera = "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img style=\"width:100%;float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$urlFoto\" /></a>";
						}

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/mid_".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/big_".$fila['foto'];

							if($conta == 1)
							{
								if($fila['parroquia'] == 19){
									$imagenPrimera = "<img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;width:100%;\" src=\"$urlFoto\" />
									<div style=\"clear:both;\"></div>\n";
								}else{
									$imagenPrimera = "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";
								}
							}else{
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img style=\"float:left;border:solid 1px #333;padding:1px;margin:10px;\" src=\"$foto\" /></a>";

							}
						}
					}


					// **********************
					// **********************
					// **********************

				?>

	<div class="row">
		<div class="col-lg-12">

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
						<span><?=$rw['titulo'];?></span>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<?php if($mapa){ ?>

					<div class="text-noticia <?php if($rw['geolocalizada'] != 1) echo "mapaa"; ?>">
						<?=stripslashes($rw['texto']);?>
					</div>

					<?php if($rw['geolocalizada'] != 1){ ?>
						<div class="titular-noticia">
							<span>Cómo llegar a la <?=$nombreParroquia;?></span>
						</div>	
					<?php } ?>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<div id="map_canvas" style="width: 100%; margin:0 auto 0 auto;margin-top:15px;height: 380px;text-align:center;border:solid 1px #AA945B;padding:2px;" align="center">Cargando mapa...</div>
    					<div style="clear:both;"></div><br />
					<?php if($rw['geolocalizada'] != 1){ ?>
						<div id="control">
							<strong>Cómo llegar desde:</strong>
							<input type="text" class="smallInput small" name="start" id="start" value="" />
							<p class="links" style="padding-top:0px;float:right;margin-right:10px;font-size:11px;"><a href="javascript:calcRoute();" class="more" style="padding-top:9px;">Calcular ruta</a></p>
						</div>
					<?php }else{ ?>
						<div id="control" style="visibility:hidden;"></div>
					<?php } ?>

					<div id="directions-panel"></div>

					<?=$imagenPrimera;?>

				<?php }elseif($rw['txt_int'] == "donativos"){ 
					
					$donativosHtml = getDonativosBotones(1);

      				if($donativosHtml != "") $donativosHtml = "<div class=\"row\">".$donativosHtml."</div>";

					?>

					<?php if(isset($_GET['donar']) && $_GET['donar'] == 1){ ?>

					<div class="text-noticia">
						<?php include('form_donativos.php'); ?>
					</div>

					<?php }else{ ?>
						<div class="text-noticia">

							<?=stripslashes($rw['texto']);?>

							<?=$donativosHtml;?>

							<?php if($idparroquia != 376){ ?>

							<div align="center">
								<form method="get" action"" name="dona" id="dona">
									<input type="hidden" name="donar" id="donar" value="1" />
									<input type="submit" name="boton" id="boton" value="Haz aquí tu donativo" class="buttonNew redNew" />
								</form>
							</div>

							<?php } ?>
							
						</div>
					<?php } ?>

				<?php }elseif($rw['txt_int'] == "revista_parroquial"){ ?>

					<div class="text-noticia">
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

							$urlDescarga = $urlRecursos."descarga.php?file=uploads/$idparroquia/".$fila['archivo'];

							echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['numero']."</a><br><span>Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."</li>\n";
						}

						echo "</ul>\n";

					}

				?>

				<?php }else{ ?>

					<div class="text-noticia">
						<?=$imagenPrimera;?>
						<?=stripslashes($rw['texto']);?>
					</div>

					<div style="clear:both;"></div>
					
					
				<?php
					echo getAdjuntosSeccion($rw['id']);
				?>


					<?php if($rw['adjuntar_documentos'] == 1){

						$css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = ".$rw['id']." ORDER BY fecha DESC";
						$rss = mysql_query($css,$conex) or die (mysql_error());

						if(mysql_num_rows($rss) > 0)
						{

							echo "<h2>Documentos adjuntos:</h2>
							<ul class=\"descarga\">\n";

							while($fila = mysql_fetch_assoc($rss))
							{

								$urlDescarga = $urlRecursos."descarga.php?file=uploads/$idparroquia/".$fila['archivo'];

								echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['numero']."</a><br><span>Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."</li>\n";
							}

							echo "</ul>\n";

						}

					} ?>

				<?php } ?>

				<?=$imagenes;?>


			</div><!--#noticia-->
		</div>
	</div>


				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

				
				}
				
			?>
