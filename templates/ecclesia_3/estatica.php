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

              if($conta == 1) $imagenPrimera = "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class=\"thumbnail\" src=\"$foto\" /></a>";
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

<?php if($imagenPrimera != ""){ ?>
    <div class="news-img">
        <?=$imagenPrimera;?>
      <?php if($imagenes != ""){ ?>
        <?=$imagenes;?>
      <?php } ?>
      </div>
<?php } ?>

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
                <input type="submit" name="boton" id="boton" value="Haz aquí tu <?=substr($donativosTxt, 0, strlen($donativosTxt)-1);?>" class="btn btn-default" />
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
