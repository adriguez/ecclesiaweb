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

				?>

			<div class="post">
				<h2 class="title"><?=$rw['titulo'];?></h2>
				<p class="byline"><?=$nombreParroquia;?></p>

				<?php if($mapa){ ?>

					<div class="entry mapaa">
						<?=stripslashes($rw['texto']);?>
					</div>

				<h2 class="title">Cómo llegar</h2>
				<p class="byline">Mapa de cómo llegar a la <?=$nombreParroquia;?></p>

					<div id="map_canvas" style="width: 450px; margin-left:10px;height: 380px;text-align:center;border:solid 1px #AA945B;padding:2px;" align="center">Cargando mapa...</div>
    <div id="control">
      <strong>Cómo llegar desde:</strong>
      	<input type="text" class="smallInput small" name="start" id="start" value="" />
	<p class="links calculaRuta" ><a href="javascript:calcRoute();" class="more">Calcular ruta</a></p>
    </div>
    <div id="directions-panel"></div>

				<?php }elseif($rw['txt_int'] == "revista_parroquial"){ ?>

					<div class="entry">
						<?=stripslashes($rw['texto']);?>
					</div>

				<?php

					$css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia ORDER BY fecha DESC";
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

					<div class="entry">
						<?=stripslashes($rw['texto']);?>
					</div>

				<?php } ?>
			</div>

				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>
