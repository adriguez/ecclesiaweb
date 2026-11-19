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

  //  $.scrollTo('#anclabaja',800);
    $("#directions-panel").show();

        var start = document.getElementById('start').value;
        var end = '<?=$lat;?>, <?=$lng;?>';
        var request = {
          origin: start,
          destination: end,
          travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        console.log(request);
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
      else if(substr_count($val['urlmisa'], 'youtube.com') > 0 && substr_count($val['urlmisa'], 'playlist') > 0){
        $codYoutube = explode("/",$val['urlmisa']);
				if(isset($codYoutube[3]))
        {
          $codYoutube = trim($codYoutube[3]);
          $codYoutube = str_replace("playlist?","videoseries?",$codYoutube);
        }
				else $codYoutube = "";
      }else if(substr_count($val['urlmisa'], '/live') > 0){
				$codYoutube = explode("/",$val['urlmisa']);
				$codYoutube = trim($codYoutube[4]);
			}
			else $codYoutube = "";
			
			$cuerpo = stripslashes($val['cuerpo']);
			?>




<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Misa online</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Misa online</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->

 <section id="contact-form" class="form-main-block form-two form-three">
    <div class="section">
      <h3 class="section-heading">Misa online</h3>
   </div>
    <div class="container">
        <div class="row">
          <div class="contact-form-block">

    <div class="news-content"><?php if($codYoutube != ""){ ?>
							<br><iframe width="100%" height="600" border="0" src="https://www.youtube.com/embed/<?=$codYoutube;?>"
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						<?php } ?>
						
						<p><?=$cuerpo;?></p>
    </div>
	</div>
</section>

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

            $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";

          }
          elseif(mysql_num_rows($rs) > 1)
          {
            while($fila = mysql_fetch_assoc($rs))
            {
              $conta++;

              $foto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];
              $urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/secciones/".$fila['foto'];

              if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" src=\"$foto\" />";
              else{
                $imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class=\"thumbnail\" src=\"$foto\" /></a>";

              }
            }
          }
		  
		  if($idpagina == 1435){
			  
			$parroquiasCartago = "Dulce Nombre de Jesús;Central;Cartago, Central, Tierra Blanca;pdulcenombre.diocesisdecartagocostarica.com
      María Auxiliadora;Central;Cartago, Central, Occidental;mariaauxiliadoracartago.org
      Nuestra Señora de Guadalupe;Central;Cartago, Central, Guadalupe;pguadalupe.diocesisdecartagocostarica.com
      Nuestra Señora de los Ángeles, Basílica;Central;Cartago, Central Oriental;santuarionacional.org
      Nuestra Señora del Carmen, Catedral;Central;Cartago, Central, Occidental;catedral.diocesisdecartagocostarica.com
      San Esteban Protomártir;Central;Cartago, Central, El Carmen;psanesteban.diocesisdecartagocostarica.com
      San Blas Obispo y Mártir;Central;Cartago, Central, El Carmen, San Blas;psanblas.diocesisdecartagocostarica.com
      San Nicolás de Tolentino;Central;Cartago, Cartago, San Nicolás;psannicolas.diocesisdecartagocostarica.com
      Inmaculada Concepción de María;Central;Cartago, San Nicolás, Quircot;pquircot.diocesisdecartagocostarica.com
      San Rafael Arcángel;Central;Cartago, Oreamuno, San Rafael;psanrafael.diocesisdecartagocostarica.com
      Santo Cristo de Esquipulas;El Guarco;Cartago, El Guarco, Tobosi;ptobosi.diocesisdecartagocostarica.com
      Inmaculada Concepción de María, Basílica;El Guarco;Cartago, El Guarco, Tejar;basilicatejar.diocesisdecartagocostarica.com
      Nuestra Señora de la Candelaria;El Guarco;Cartago, Central, Corralillo;pcorralillo.diocesisdecartagocostarica.com
      San Cristóbal;El Guarco;San José, Desamparados, San Cristóbal Norte;psancristobal.diocesisdecartagocostarica.com
      San Francisco de Asís;El Guarco;Cartago, San Francisco, Agua Caliente;paguacaliente.diocesisdecartagocostarica.com
      San Isidro Labrador;El Guarco;Cartago, El Guarco, San Isidro;psanisidroelguarco.diocesisdecartagocostarica.com
      Santa María Goretti;El Guarco;Cartago, San Francisco, La Pitahaya;pstamagoretti.diocesisdecartagocostarica.com
      San José Esposo de la Virgen;Ujarrás;Cartago, Paraíso, Orosi;porosi.diocesisdecartagocostarica.com
      Santa Lucía Virgen y Mártir;Ujarrás;Cartago, Paraíso, Llanos de Santa Lucía;psantalucia.diocesisdecartagocostarica.com
      San Francisco Javier;Ujarrás;Cartago, Alvarado, Cervantes;pcervantes.diocesisdecartagocostarica.com
      Nuestra Señora de Ujarrás;Ujarrás;Cartago, Paraíso, Paraíso;pparaiso.diocesisdecartagocostarica.com
      Santa Isabel de Portugal;Ujarrás;Cartago, Paraíso, Cachí;pstaisabel.diocesisdecartagocostarica.com
      Nuestra Señora de los Ángeles;Turrialba;Cartago, Turrialba, Pavones;ppavones.diocesisdecartagocostarica.com
      San Buenaventura;Turrialba;Cartago, Turrialba, San Buenaventura;psanbuenaventura.diocesisdecartagocostarica.com
      San Isidro Labrador;Turrialba;Cartago, Turrialba, La Suiza;psanisidrolasuiza.diocesisdecartagocostarica.com
      Inmaculado Corazón de María;Turrialba;Cartago, Turrialba, Santa Cruz;psantacruz.diocesisdecartagocostarica.com
      Santa Rosa de Lima;Turrialba;Cartago, Turrialba, Santa Rosa;pstarosaturrialba.diocesisdecartagocostarica.com
      Santa Teresita del Niño Jesús;Turrialba;Cartago, Turrialba, Santa Teresita;pstateresita.diocesisdecartagocostarica.com
      San Antonio de Padua;Turrialba;Cartago, Turrialba, Tayutic;ptayutic.diocesisdecartagocostarica.com
      San Miguel Arcángel;Turrialba;Cartago, Jiménez, Pejibaye;psanmiguelarcangel.diocesisdecartagocostarica.com
      Nuestra Señora del Carmen;Turrialba;Cartago, Alvarado, Juan Viñas;pjuanvinas.diocesisdecartagocostarica.com
      Inmaculada Concepción de María;Turrialba;Cartago, Jiménez, Tucurrique;ptucurrique.diocesisdecartagocostarica.com
      San José Esposo de la Virgen;Irazú;Cartago, Central, Llano Grande;pllanogrande.diocesisdecartagocostarica.com
      San Vicente de Paúl;Irazú;Cartago, Alvarado, Capellades;pcapellades.diocesisdecartagocostarica.com
      Santa Rosa de Lima;Irazú;Cartago, Oreamuno, Santa Rosa;pstarosaoreamuno.diocesisdecartagocostarica.com
      Dulce Nombre de Jesús;Irazú;Cartago, Oreamuno, Tierra Blanca;ptierrablanca.diocesisdecartagocostarica.com
      Nuestra Señora de los Ángeles;Irazú;Cartago, Oreamuno, Cipreses;pcipreses.diocesisdecartagocostarica.com
      Sagrado Corazón de Jesús;Irazú;Cartago, Alvarado, Pacayas;ppacayas.diocesisdecartagocostarica.com
      San Antonio de Padua;Irazú;Cartago, Oreamuno, Cot;psanantoniocot.diocesisdecartagocostarica.com";

				$rw['texto'] = '  <section id="portfolio" class="portfolio-main-block portfolio-two">
    <div class="container-fluid">
      <div class="portfolio-content">
        <div class="portfolio-filter">
          <ul class="filter-dtl text-center">  
              <li><a href="#all" class="filter-all btn btn-default active">Todas</a></li>
			  <li><a href="#central" class="filter-central btn btn-default">Central</a></li>
              <li><a href="#elguarco" class="filter-elguarco btn btn-default">El Guarco</a></li>
              <li><a href="#ujarras" class="filter-ujarras btn btn-default">Ujarrás</a></li>
              <li><a href="#irazu" class="filter-irazu btn btn-default">Irazú</a></li>
          </ul>
        </div> ';

              
	  
		$parroquiasCartagoEx = explode("\n",$parroquiasCartago);

				$conta = 0;
				foreach($parroquiasCartagoEx as $id=>$v){
					
					$valEx = explode(";",$v);
					
					$urlWeb = "https://".$valEx[3];
					
					switch(trim($valEx[1])){
						case "Central"; $vicaria = "central"; break;
						case "El Guarco"; $vicaria = "elguarco"; break;
						case "Ujarrás"; $vicaria = "ujarras"; break;
						case "Irazú"; $vicaria = "irazu"; break;
					}
					
					$rw['texto'] .= '
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 row-top-spacing portfolio-item '.$vicaria.'" style="min-height:410px;">
							  <div class="upcoming-block">
								<div class="upcoming-img block-effect">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><img src="'.$urlOriBase.'images/default_cartago.jpg" class="img-responsive" alt="'.$valEx[0].'"></a>
								</div>
								<div class="upcoming-content">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><h4 class="upcoming-heading">'.$valEx[0].'</h4></a>
								  <p class="upcoming-dtl"><b>Vicaría:</b> '.$valEx[1].'<br><b>Dirección:</b> '.$valEx[2].'</p>
								</div>
							  </div>
							</div>';
							
					$conta++;
					
					if($conta == 3){
						//$rw['texto'] .= "<div style=\"clear:both;\"></div>\n";
						$conta=0;
					}
				}
				
				$rw['texto'] .= '
						   </div>
					</div>
				  </section>';
			  
			 // $rw['texto'] = "Test";
      }else if($idpagina == 2940){
			  
			  $parroquiasCartago = "Divino Niño Jesús;divinoniño.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Espíritu Santo;espiritusanto.diocesisdecaguas.org;Aguas Buenas, Puerto Rico 00703
        San José - Aibonito;sanjoseaibonito.diocesisdecaguas.org;Aibonito, Puerto Rico 00705
        San Antonio de Padua;sanantoniodepadua.diocesisdecaguas.org;Barranquitas, Puerto Rico 00794
        El Salvador;elsalvador.diocesisdecaguas.org;Caguas, Puerto Rico 00725-9613
        María, Madre de la Iglesia;mariamadredelaiglesia.diocesisdecaguas.org;Caguas, Puerto Rico 00725
        Ntra. Sra. de la Providencia;nuestraseñoradelaprovidencia.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Ntra. Sra. del Perpetuo Socorro;perpetuosocorro.diocesisdecaguas.org;Caguas, Puerto Rico 00725
        Sagrado Corazón de Jesús;sagradocorazon.diocesisdecaguas.org;Caguas, Puerto Rico 00725-9723
        San Juan Apóstol y Evangelista;sanjuanapostol.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        San Pablo Apóstol;sanpablo.diocesisdecaguas.org;Caguas, Puerto Rico 00725
        San Pedro Apóstol;sanpedro.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Santísima Trinidad;santisimatrinidad.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Santísimo Sacramento;santisimosacramento.diocesisdecaguas.org;Caguas, Puerto Rico 00725
        Ntra. Sra. de la Asunción;nuestraseñoradelaasuncion.diocesisdecaguas.org;Cayey, Puerto Rico 00738-2887
        San Esteban Protomártir ;sanesteban.diocesisdecaguas.org;Cayey, Puerto Rico 00738-9522
        Catedral Dulce Nombre de Jesús;catedral.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Ntra. Sra. del Carmen - Cidra, P.R;nuestraseñoradelcarmencidra.diocesisdecaguas.org;Cidra, Puerto Rico 00739
        Nuestra Señora de Fátima;nuestraseñoradefatima.diocesisdecaguas.org;Cidra, Puerto Rico 00739
        San Andrés Apóstol;sanandres.diocesisdecaguas.org;Comerío, Puerto Rico 00782
        Santo Cristo de la Salud;santocristo.diocesisdecaguas.org;Comerío, Puerto Rico 00782
        San José - Gurabo, P.R;sanjosegurabo.diocesisdecaguas.org;Gurabo, Puerto Rico 00733
        Inmaculada Concepción  - Juncos;inmaculadaconcepcionjuncos.diocesisdecaguas.org;Juncos, Puerto Rico 00777
        Inmaculada Concepción  - Las Piedras;inmaculadaconcepcionlaspiedras.diocesisdecaguas.org;Las Piedras, Puerto Rico 00771
        San Juan Bautista;sanjuanbautista.diocesisdecaguas.org;Las Piedras, Puerto Rico 00771
        San Isidro Labrador;sanisidro.diocesisdecaguas.org;Maunabo, Puerto Rico 00707
        San Miguel Arcángel;sanmiguel.diocesisdecaguas.org;Naranjito, Puerto Rico 00719
        Sagrado Corazón de Jesús y los Doce Apóstoles;sagradocorazondejesus.diocesisdecaguas.org;San Lorenzo, Puerto Rico 00754
        Santos Ángeles Custodios;santosangelescustodios.diocesisdecaguas.org;Yabucoa, Puerto Rico 00767
        Nuestra Señora del Carmen - Santuiario Diocesano;santuarionuestraseñoradelcarmen.diocesisdecaguas.org;San Lorenzo, Puerto Rico 00754
        Los Tres Santos Reyes;lostressantosreyes.diocesisdecaguas.org;Aguas Buenas, Puerto Rico 00703
        Nuestra Señora de la Merced;nuestraseñoradelamerced.diocesisdecaguas.org;Cayey, Puerto Rico 00737-2798
        Nuestra Señora de las Mercedes;nuestraseñoradelasmercedes.diocesisdecaguas.org;San Lorenzo, Puerto Rico 00754
        San José - Caguas Villa Blanca;sanjosevillablanca.diocesisdecaguas.org;Caguas, Puerto Rico 00726
        Inmaculado Corazón de María;inmaculadocorazondemaria.diocesisdecaguas.org;Caguas, Puerto Rico 00725-9228";
              
	  
		    $parroquiasCartagoEx = explode("\n",$parroquiasCartago);

				$conta = 0;
				foreach($parroquiasCartagoEx as $id=>$v){
					
					$valEx = explode(";",$v);
					
					$urlWeb = "https://".$valEx[1];
					
					$rw['texto'] .= '
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 row-top-spacing portfolio-item" style="min-height:410px;">
							  <div class="upcoming-block">
								<div class="upcoming-img block-effect">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><img src="'.$urlOriBase.'images/default_cartago.jpg" class="img-responsive" alt="'.$valEx[0].'"></a>
								</div>
								<div class="upcoming-content">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><h4 class="upcoming-heading">'.$valEx[0].'</h4></a>
								  <p class="upcoming-dtl"><b>Dirección:</b> '.$valEx[2].'</p>
								</div>
							  </div>
							</div>';
							
					$conta++;
					
					if($conta == 3){
						//$rw['texto'] .= "<div style=\"clear:both;\"></div>\n";
						$conta=0;
					}
				}
				
				$rw['texto'] .= '
						   </div>
					</div>
				  </section>';
			  
			 // $rw['texto'] = "Test";
      }else if($idpagina == 3095){
			  
			  $parroquiasCartago = "Catedral Ntra. Sra. de la Corteza;Av. 20 con Av. Don Rómulo Gallegos, Paseo Metropolitano, Casa Parroquial S/N, Sector El Algarrobo, Acarigua.;catedral.diocesisdeacariguaaraure.com
Sant. Euc. Ntra. Sra. de Fátima;Calle Principal, Urb. Las Mesetas de Araure. Arure.;santuarioeucaristiconsf.diocesisdeacariguaaraure.com
Sant. Dioc. Ntra. Sra. del Pilar;Calle 5 entre Avdas. 23 y 24, Casa S/N, Sector Centro, Araure.;santuarioelpilar.diocesisdeacariguaaraure.com
Sagrado Corazón de Jesús;Calle 3 entre Avdas. 4 y 5, Local Sede Parroquia Sagrado Corazón de Jesús. Urb. Villa Araure 1, Araure.;sagradocorazondejesus.diocesisdeacariguaaraure.com
San Pablo Apóstol;Calle 5 entre Av. 9, Local S/N, Barrio Limoncito, Araure.;sanpabloapostol.diocesisdeacariguaaraure.com
La Sagrada Familia;Av. 2 entre Calles 8 y 14, Casa Parroquial S/N, Urb. Fundación Mendoza. Acarigua.;lasagradafamilia.diocesisdeacariguaaraure.com
Ntra. Sra. de Coromoto;Av. 35 con Calle 39, Rotaria, La Goajira Primera Etapa. Acarigua.;ntrasradecoromoto.diocesisdeacariguaaraure.com
Ntra. Sra. del Carmen;Av. 4 con Calle 6, Local S/N, Urb. Gonzalo Barrios, Sector 3. Acarigua.;nsdelcarmen.diocesisdeacariguaaraure.com
San Roque;Calle 27 entre Avdas. 37 y 38, Casa S/N, Barrio Paraguay. Acarigua.;sanroque.diocesisdeacariguaaraure.com
San Miguel Arcángel;Av. Libertador frente a la Plaza Bolívar, Casa Iglesia Parroquial San Miguel Arcángel, Sector Centro. Acarigua.;sanmiguelarcangel.diocesisdeacariguaaraure.com
Ntra. Sra. de la Milagrosa;Av. Los Cortijos, Local S/N, Urb. Los Cortijos.;ntrasradelamilagrosa.diocesisdeacariguaaraure.com
Santa Elena;Av. 1 Casa S/N, Barrio Santa Elena, Acarigua.;santaelena.diocesisdeacariguaaraure.com
Santa Bárbara;Av. 4 con Calle 15, Local Iglesia Católica, Sector Centro, Agua Blanca.;santabarbara.diocesisdeacariguaaraure.com
Ntra. Sra. del Rosario;Av. 3 Casa 07-35, Sector Centro, Villa Bruzual.;ntrasradelrosario.diocesisdeacariguaaraure.com
San Rafael Arcángel ;Carrera 8 entre Calles 9 y 10, Casa Sede Parroquial Píritu S/N, Sector Centro, Píritu.;sanrafael.diocesisdeacariguaaraure.com
San Antonio de Padua;Calle 7 entre Avdas. 1 y 2, Casa Parroquial S/N, Sector Centro, La Misión.;sanantoniodepadua.diocesisdeacariguaaraure.com
San José de Rio Acarigua;Calle Principal, Casa Parroquial S/N, Sector Rio Acarigua.;sanjose.diocesisdeacariguaaraure.com
Capellanía San Giuseppe;Av. Venezuela, frente al Monumento El Túmulo, Araure.;sangiuseppe.diocesisdeacariguaaraure.com";
              
	  
		    $parroquiasCartagoEx = explode("\n",$parroquiasCartago);

				$conta = 0;
				foreach($parroquiasCartagoEx as $id=>$v){
					
					$valEx = explode(";",$v);
					
					$urlWeb = "https://".$valEx[2];
					
					$rw['texto'] .= '
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 row-top-spacing portfolio-item" style="min-height:410px;">
							  <div class="upcoming-block">
								<div class="upcoming-img block-effect">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><img src="'.$urlOriBase.'images/default_cartago.jpg" class="img-responsive" alt="'.$valEx[0].'"></a>
								</div>
								<div class="upcoming-content">
								  <a href="'.$urlWeb.'" target="_blank" title="'.$valEx[0].'"><h4 class="upcoming-heading">'.$valEx[0].'</h4></a>
								  <p class="upcoming-dtl"><b>Dirección:</b> '.$valEx[2].'</p>
								</div>
							  </div>
							</div>';
							
					$conta++;
					
					if($conta == 3){
						//$rw['texto'] .= "<div style=\"clear:both;\"></div>\n";
						$conta=0;
					}
				}
				
				$rw['texto'] .= '
						   </div>
					</div>
				  </section>';
			  
			 // $rw['texto'] = "Test";
		  }


          // **********************
          // **********************
          // **********************


        ?>



<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?=$rw['titulo'];?></h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a><?=$rw['titulo'];?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<?php if($rw['txt_int'] != "donde-esta"){ ?>
        <script type="text/javascript" language="javascript">

        jQuery(document).ready(function() {
          jQuery(".fancybox-thumb").fancybox({
            prevEffect  : 'none',
            nextEffect  : 'none',
            helpers : {
              title : {
                type: 'inside'
              },
              thumbs  : {
                width : 50,
                height  : 50
              }
            }
          });
        });

        </script>
<?php } ?>

<?php
if($mapa){ ?>

 <section id="contact-form" class="form-main-block form-two form-three">
    <div class="section">
      <h3 class="section-heading"><?php if($geolocalizada) echo $rw['titulo']; else echo "Cómo llegar"; ?></h3>
   </div>
    <div class="container">
        <div class="row">
          <div class="contact-form-block">

    <div class="news-content">
      <?=stripslashes($rw['texto']);?>
    </div>

    <div class="news-content">
      <?php if($geolocalizada){ ?>
        <p>Mapa de cómo llegar a <?=$rw['titulo'];?></p>
      <?php }else{ ?>
        <p>Mapa de cómo llegar a la <?=$nombreParroquia;?></p>
      <?php } ?>
    
      <div id="map_canvas" style="width: 100%;height: 380px;text-align:center;border:solid 1px #AA945B;padding:2px;" align="center">Cargando mapa...</div>
      <div id="control" style="margin-top:20px;text-align:left;">
        <strong>Cómo llegar desde:</strong><br>
        <input type="text" class="form-control" style="width:200px;float:left;margin-top:20px;margin-right:20px;" placeholder="Llegar desde..." name="start" id="start" value="" />
        <p class="links" style="float:left;"><a href="javascript:calcRoute();" class="more btn btn-default">Calcular ruta</a></p>
      </div>
      <div id="directions-panel"></div>

    </div>
           
      </div>
    </div>
  </section> 

<?php }elseif($rw['txt_int'] == "donativos"){ 

    $donativosHtml = getDonativosBotones();

      if($donativosHtml != "") $donativosHtml = "<div class=\"row\">".$donativosHtml."</div>";

      if(isset($_GET['donar']) && $_GET['donar'] == 1){ 

         include('form_donativos.php');

      } else {

 
        ?>
 <section id="contact-form" class="form-main-block form-two form-three">
    <div class="container">
        <div class="row">
          <div class="contact-form-block">


          <h5 class="sub-heading" style="clear:both;<?php if($donativosHtml != "") echo ";padding-bottom:70px;\""; ?>"><?=stripslashes($rw['texto']);?></h5>

            <?=$donativosHtml;?>
            <div style="clear:both;margin-top:20px;"></div>

            <form method="get" action="" name="dona" id="dona">
              <input type="hidden" name="donar" id="donar" value="1" />
              <span style="clear:both;"><a href="#"> 
                <input type="submit" name="boton" id="boton" value="<?php if($idioma == "en") echo "Make here your"; else echo "Haz aquí tu"; ?> <?=substr($donativosTxt, 0, strlen($donativosTxt)-1);?>" class="btn btn-default" />
              </a></span>
            </form>

            <?php if($imagenPrimera != "") echo "<div class=\"donativosImg\" align=\"center\">".$imagenPrimera."</div>\n" ;?>
        


             </div>
      </div>
    </div>
  </section> 
  <?php
       }

 }elseif($rw['txt_int'] == "revista_parroquial"){ ?>

<!--  blog  -->
   <section id="news" class="news-main-block news-three">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="news-block">


    <div class="news-content">
		
      <?=stripslashes($rw['texto']);?>
    

    <?php
      $css = "SELECT * FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = 0 ORDER BY fecha DESC";
      $rss = mysql_query($css,$conex) or die (mysql_error());

      if(mysql_num_rows($rss) > 0)
      {

        echo "<ul class=\"descarga\">\n";

        while($fila = mysql_fetch_assoc($rss))
        {

          $urlDescarga = $urlRecursos."descarga.php?file=uploads/$idparroquia/".$fila['archivo'];

          echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['numero']."</a><span>Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."</li>\n";
         }

        echo "</ul>\n";

      }

    ?>

    </div>

              </div>
        </div>
      </div>
    </div>
  </section>


<?php } else {?>
            
<!--  blog  -->
   <section id="news" class="news-main-block news-three">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="news-block">

            <div class="news-img" <?php if($idparroquia == 588) echo "style=\"float:left;width:500px;margin-right:20px;\""; ?>>

              <?php if($imagenPrimera != ""){ ?>
                <?=$imagenPrimera;?>
              <?php } ?>


            </div>
   
            <div class="news-content">
			
			
	<?php if($idpagina == 898){

		$seccion1 = getValue("SELECT * FROM paginas WHERE id = 899",0);
		$seccion2 = getValue("SELECT * FROM paginas WHERE id = 900",0);
		$seccion3 = getValue("SELECT * FROM paginas WHERE id = 901",0);
		$seccion4 = getValue("SELECT * FROM paginas WHERE id = 902",0);


		?>
	<div class="row">
	
	
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">	
				<div class="abt-tab-item" style="height:180px;padding-top:20px;"><a href="<?=$urlOri;?><?=$seccion3['txt_int'];?>/901/"><div class="abt-tab-icon"></div><p class="abt-icon-name" style="font-size:30px;line-height: normal;padding-top:25px;"><?=$seccion3['titulo'];?></p></a></div>
		</div>
	
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">

                <div class="abt-tab-item" style="height:180px;padding-top:20px;">
					<a href="<?=$urlOri;?><?=$seccion1['txt_int'];?>/899/"><div class="abt-tab-icon"></div><p class="abt-icon-name" style="font-size:30px;line-height: normal;padding-top:25px;"><?=$seccion1['titulo'];?></p></a>
				</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">			
				<div class="abt-tab-item" style="height:180px;padding-top:20px;"><a href="<?=$urlOri;?><?=$seccion2['txt_int'];?>/900/"><div class="abt-tab-icon"></div><p class="abt-icon-name" style="font-size:30px;line-height: normal;padding-top:25px;"><?=$seccion2['titulo'];?></p></a></div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<div class="abt-tab-item" style="height:180px;padding-top:20px;"><a href="<?=$urlOri;?><?=$seccion4['txt_int'];?>/902/"><div class="abt-tab-icon"></div><p class="abt-icon-name" style="font-size:30px;line-height: normal;padding-top:25px;"><?=$seccion4['titulo'];?></p></a></div>
		</div>
</div>
	<?php } ?>
			
			
				<?php if($idparroquia == 538 && $idpagina == 897){ ?>
				
					<div style="text-align:center;">
						<iframe width="100%" height="220" src="https://liveradio.com.es:2000/AudioPlayer/RadioEsperanza?" border="0" style="border: 0;"></iframe>
					</div>
				
				<?php } ?>
			
              <?=stripslashes($rw['texto']);?>
            </div>

            <div class="news-img">
            <?php if($imagenes != ""){ ?>
              <?=$imagenes;?>
            <?php } ?>
            </div>
			
			
					
				<?php
					echo getAdjuntosSeccion($idpagina);
				?>


          </div>
        </div>
      </div>
    </div>
  </section>


<?php } ?>

<!--  end blog -->
<!--  quote slider -->
<?php 
/*
  <section id="quote" class="quote-main-block">
    <div class="container">
      <div class="bg-img" style="background-image: url('<?=$urlOriBase;?>images/blog/blog-dtl-02.jpg')">
        <div class="overlay-bg"></div>
        <div id="quote-slider" class="quote-slider">
          <div class="item quote-block">  
            <div class="container">
              <div class="quote-content">              
                <span class="quotes-icon quotes-left"><i class="fa fa-quote-left"></i></span>
                <p class="quote-dtl">Mauris nec tellus metus. Cras dapibus metus vel ipsum convallis semper. Nullam tristique neque at turpis lobortis pharetra fringilla vitae nibh. Nunc nec tristique ipsum. Suspendisse potenti. Curabitur non tortor metus. Suspendisse potenti. Vestibulum egestas ipsum a orci luctus, vitae interdum tortor sagittis. Curabitur pellentesque ipsum vitae ligula sollicitudin, vitae dictum dui volutpat. Aenean vitae scelerisque ipsum. </p>
                <span class="quotes-icon quotes-right"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
          </div>
          <div class="item quote-block">  
            <div class="container">
              <div class="quote-content">              
               <span class="quotes-icon quotes-left"><i class="fa fa-quote-left"></i></span>
                <p class="quote-dtl">Mauris nec tellus metus. Cras dapibus metus vel ipsum convallis semper. Nullam tristique neque at turpis lobortis pharetra fringilla vitae nibh. Nunc nec tristique ipsum. Suspendisse potenti. Curabitur non tortor metus. Suspendisse potenti. Vestibulum egestas ipsum a orci luctus, vitae interdum tortor sagittis. Curabitur pellentesque ipsum vitae ligula sollicitudin, vitae dictum dui volutpat. Aenean vitae scelerisque ipsum. </p>
                <span class="quotes-icon quotes-right"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
          </div>
          <div class="item quote-block">  
            <div class="container">
              <div class="quote-content">              
                <span class="quotes-icon quotes-left"><i class="fa fa-quote-left"></i></span>
                <p class="quote-dtl">Mauris nec tellus metus. Cras dapibus metus vel ipsum convallis semper. Nullam tristique neque at turpis lobortis pharetra fringilla vitae nibh. Nunc nec tristique ipsum. Suspendisse potenti. Curabitur non tortor metus. Suspendisse potenti. Vestibulum egestas ipsum a orci luctus, vitae interdum tortor sagittis. Curabitur pellentesque ipsum vitae ligula sollicitudin, vitae dictum dui volutpat. Aenean vitae scelerisque ipsum. </p>
                <span class="quotes-icon quotes-right"><i class="fa fa-quote-right"></i></span>
              </div>            
            </div>
          </div>
        </div>
      </div>
    </div>
 </section>     
 */
 ?>
<!--  end blog quote slider -->
<!--  blog slider -->
 <?php 
/*
  <section id="blog-slider-block" class="blog-slider-block">
    <div class="container">
      <div id="blog-slider" class="blog-slider">
        <div class="item blog-slider-One">
          <div class="row">
            <div Class="col-xs-6">
              <div class="blog-img">
                <img src="<?=$urlOriBase;?>images/blog/blog-slider-01.jpg" class="img-responsive" alt="blog-slider-01">
              </div>
            </div>
            <div Class="col-xs-6">
              <div class="blog-dtl">
                <a href="#"><h4 class="blog-heading">1-Fusce varius vulputate erat eu aliquam.</h4></a>
              </div>
            </div>
          </div>
        </div>
        <div class="item blog-slider-Two">
          <div class="row">
            <div Class="col-xs-6">
              <div class="blog-dtl">
                <a href="#"><h4 class="blog-heading">2-Fusce varius vulputate erat eu aliquam.</h4></a>
              </div>
            </div>
            <div Class="col-xs-6">
              <div class="blog-img">
                <img src="<?=$urlOriBase;?>images/blog/blog-slider-02.jpg" class="img-responsive" alt="blog-slider-02">
              </div>
            </div>
          </div>
        </div>
        <div class="item blog-slider-One">
          <div class="row">
            <div Class="col-xs-6">
              <div class="blog-img">
                <img src="<?=$urlOriBase;?>images/blog/blog-slider-01.jpg" class="img-responsive" alt="blog-slider-03">
              </div>
            </div>
            <div Class="col-xs-6">
              <div class="blog-dtl">
                <a href="#"><h4 class="blog-heading">3-Fusce varius vulputate erat eu aliquam.</h4></a>
              </div>
            </div>
          </div>
        </div>
        <div class="item blog-slider-Two">
          <div class="row">
            <div Class="col-xs-6">
              <div class="blog-dtl">
                <a href="#"><h4 class="blog-heading">4-Fusce varius vulputate erat eu aliquam.</h4></a>
              </div>
            </div>
            <div Class="col-xs-6">
              <div class="blog-img">
                <img src="<?=$urlOriBase;?>images/blog/blog-slider-02.jpg" class="img-responsive" alt="blog-slider-04">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end blog slider -->
*/?>

    <?php
        }
        else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";
		
			}
