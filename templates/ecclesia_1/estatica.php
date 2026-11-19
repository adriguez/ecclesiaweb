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
			else $codYoutube = "";
			
			$cuerpo = stripslashes($val['cuerpo']);
			?>

	<div class="row">
		<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia">
						<h1>Misa online</h1>
					</div>

					<div style="clear:both;"></div>

					<div class="text-noticia">						
						<?php if($codYoutube != ""){ ?>
							<br><iframe width="100%" height="400" border="0" src="https://www.youtube.com/embed/<?=$codYoutube;?>"></iframe>
						<?php } ?>
						
						<p><?=$cuerpo;?></p>
					</div>
			</div>
		</div>
	</div>

			<?php 
			
			}else{

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

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];

						$imagenPrimera = "<img class=\"thumbnail\" style=\"width:100%;\" src=\"$urlFoto\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class\"thumbnail\" src=\"$urlFoto\" /></a>";
							else{
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class\"thumbnail\" src=\"$foto\" /></a>";

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
						<h1><?=$rw['titulo'];?></h1>
					</div>

					<div style="clear:both;"></div>

					<?php if($mapa){ ?>

					<div class="text-noticia mapaa">
						<?=stripslashes($rw['texto']);?>
					</div>

					<div class="titular-noticia">
						<?php if($idparroquia == 14 || $idparroquia == 322){ ?>
							<span>Cómo llegar a <?=str_replace("Ubicación","",$rw['titulo']);?></span>
						<?php }else{ ?>
							<span>Cómo llegar a la <?php if($idparroquia == 587) echo "Parroquia de"; ?> <?=$nombreParroquia;?></span>
						<?php } ?>
					</div>
											<?php if($imagenPrimera != "") echo $imagenPrimera;
						else echo $imagenes;?>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<div id="map_canvas" style="width: 100%; margin:0 auto 0 auto;margin-top:15px;height: 380px;text-align:center;border:solid 1px #ccc;padding:2px;" align="center">Cargando mapa...</div>
    					<div style="clear:both;"></div><br />
					<div id="control">
						<strong>Cómo llegar desde:</strong>
						<input type="text" class="smallInput small" name="start" id="start" value="" />
						<p class="links" style="padding-top:5px;float:right;margin-right:10px;font-size:11px;"><a href="javascript:calcRoute();" style="padding-top:5px;" class="more">Calcular ruta</a></p>
					</div>

					<div id="directions-panel"></div>

				<?php }elseif($rw['txt_int'] == "donativos"){ 

					if($idparroquia == 73){ 

						echo "<h3>DONATIVO EXTRAORDINARIO AYUDA REHABILITACIÓN CUBIERTA ARCIPRESTAL</h3>
						<img src=\"https://web.mintrared.com/uploads/73/cupula_obispo.jpg\" style=\"width:100%;\" /><br>
						<div class=\"text-noticia\"><p style=\"font-weight:bold;text-align: justify;\">Ha dado comienzo la primera fase de la rehabilitación de la cubierta de la Arciprestal, ahora más que nunca, necesitamos tu ayuda. Haz tu donativo único extraordinario para dicha causa en el siguiente botón.</p></div>";

						echo '<div align="center">
						<form method="get" action"" name="dona" id="dona">
							<input type="hidden" name="donar" id="donar" value="1" />
							<input type="submit" name="boton" id="boton" value="Haz aquí tu donativo" class="buttonNew redNew" />
						</form>
					</div><hr/>';

					}
					
					$donativosHtml = getDonativosBotones(1);

      				if($donativosHtml != "") $donativosHtml = "<div class=\"row\">".$donativosHtml."</div>";
					
					?>

					<?php if((isset($_GET['donar']) && $_GET['donar'] == 1) || ($idparroquia == 587)){ ?>

					<div class="text-noticia">
						<?php if($idparroquia == 587) echo stripslashes($rw['texto']);?>
						<?php include('form_donativos.php'); ?>
					</div>

					<?php }else{ ?>
						<div class="text-noticia">

							<?=stripslashes($rw['texto']);?>

							<?=$donativosHtml;?>

						<?php if($idparroquia != 329){ ?>

							<div align="center">
								<form method="get" action"" name="dona" id="dona">
									<input type="hidden" name="donar" id="donar" value="1" />
									<input type="submit" name="boton" id="boton" value="Haz aquí tu donativo" class="buttonNew redNew" />
								</form>
							</div>

						<?php } ?>
							<?php if($imagenPrimera != "") echo "<div class=\"donativosImg\" align=\"center\">".$imagenPrimera."</div>\n" ;?>

						</div>
					<?php } ?>

				<?php }elseif($rw['txt_int'] == "revista_parroquial"){ 


					if(isset($_GET['carpeta']) && $_GET['carpeta'] > 0){
						$idCategoria = intval($_GET['carpeta']);
						$extraTxt = "<b style=\"font-size:24px;\">".getValue("SELECT nombre FROM revista_numeros_categorias WHERE id = ".$idCategoria,1)."</b>";
					}
					else $idCategoria = 0;

					?>

					<div class="text-noticia">
						<?=stripslashes($rw['texto']);?> <?=$extraTxt;?>
					</div>

				<?php


					if(getValue("SELECT id FROM revista_numeros_categorias WHERE parroquia = $idparroquia LIMIT 1",1) > 0 && !isset($_GET['carpeta'])){

						$sql = "SELECT * FROM revista_numeros_categorias WHERE parroquia = $idparroquia ORDER BY nombre ASC";
						$rs = mysql_query($sql,$conex);

						echo "<ul class=\"descarga folderNew\">\n";

						while($rw=mysql_fetch_assoc($rs)){
							$urlCategoria = $urlOri.substr($_SERVER['REQUEST_URI'],1)."/carpeta-".$rw['id']."/";
							echo "<li><a href=\"$urlCategoria\" title=\"Acceder a la carpeta\">".$rw['nombre']."</a><br></li>\n";
						}
						echo "</ul>\n";
					}

					$css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = 0 AND categoria = $idCategoria ORDER BY fecha DESC";
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

				<?php if($imagenPrimera != ""){ ?>
					<div class="photo-article">
						<?=$imagenPrimera;?>	
					</div>
				<?php } ?>


					<div class="text-noticia">


						<?php if($idpagina == 1461){
							
							$fichero = file_get_contents('https://web.mintrared.com/uploads/852/secciones/historia.html', true);
							echo $fichero;
						?>
						
						<?php }else{ ?>

						<?=stripslashes(convertYoutube($rw['texto']));?>
						
						<?php } ?>
					</div>

					<div class="clearfix"></div>

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
					
					<?php
					echo getAdjuntosSeccion($rw['id']);
				?>

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
