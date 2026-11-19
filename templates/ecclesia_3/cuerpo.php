
<!--  slider -->
<header id="home-slider" class="slider-main-block">
<?php


if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 


  $sqWhere = "";
  // if($idparroquia == 14) $sqWhere = " AND galeria_fotos.categoria = 40 ";

  $sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto, galeria_fotos.id FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.parroquia = 0 AND galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." ORDER BY orden ASC LIMIT 10";
  $result = mysql_query($sql,$conex) or die (mysql_error());

  if(mysql_num_rows($result) == 0)
  {
    

    $sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto, galeria_fotos.id FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." AND galeria_fotos.horizontal = 1 ORDER BY orden ASC LIMIT 10";
    $result = mysql_query($sql,$conex) or die (mysql_error());
  }

  $featured = "";

  $i=0;

  while($rw = mysql_fetch_assoc($result))
  {
    $urlFoto = "";

    $foto = $urlRecursos."uploads/".$idparroquia."/".$rw['foto'];

   
  
/*
  $featured .= "<div class=\"item $active\">
                <div class=\"fill\" style=\"background-image:url('".$foto."');\"></div>
                <div class=\"carousel-caption\">
                    <h2>".$rw['titulo']."</h2>
                </div>
            </div>";
*/

    $item = "";

    if($rw['id'] == 16027) $item .= "<a href=\"https://www.youtube.com/playlist?list=PLMNxyAGtFIxWybVCpDk1_cj3CKu1Yg-PM\" target=\"_blank\">";

    $item .= "<div class=\"item home-slider-img\" style=\"background-image: url('".$foto."')\">";
    // Opacidad --> $featured .= '<div class="overlay-bg"></div>';
    if($idparroquia == 1319) $valores['titulo_logo'] = '';
    $item .= '
      <div class="container">
        <div class="slider-dtl">
          <h1 class="slider-heading">'.$valores['titulo_logo'].'</h1>
          <h5 class="slider-subheading"></h5>';
          
/*
          <div class="slider-countdown">
            <div class="coming-countdown" data-countdown="2017/9/30"></div>
          </div>
          */

      $item .= '</div>
      </div>     
    </div>';

    if($rw['id'] == 16027) $item .= "</a>";
  
    $featured.=$item;
    $i++;
  }

if ($i==1) { $featured.=$item; }

echo $featured;
}

?>
</header>
<!--  end slider -->

<?php if($idparroquia == 978){ ?>
  <img src="<?=$urlOri;?>templates/ecclesia_3/images/corazon_guadalupe.png" style="position: relative;
    float: right;
    bottom: 266px;
    right:50px;
    z-index: 100000;" />
<?php } ?>

<?php 



	include('noticias_top.php');
	
?>


<!--  testimonial -->
<?php

$t1="Orar a Cristo es amarlo y amarlo significa cumplir sus palabras. La oración significa para mí la posibilidad de unirme a Cristo las 24 horas del
 día para vivir con Él, en Él y para Él. Si oramos, creemos. Si creemos, amaremos. Si amamos, serviremos.<br>";
$tn1="Madre Teresa de Calcuta";
$t2="La familia está llamada a ser templo, o sea, casa de oración: una oración sencilla, llena de esfuerzo y ternura. Una oración que se hace vida,
 para que toda la vida se convierta en oración.<br>";
$tn2="Papa Juan Pablo II";
$t3="Jesús está contigo, incluso cuando no sientes su presencia. Él nunca está tan cerca de ti como lo está durante tus batallas espirituales. 
Él siempre está ahí, cerca de ti, te anima a luchar tu batalla con valentía. Él está allí para protegerte de los golpes del enemigo, para que no puedas ser lastimado.";
$tn3="Padre Pío";

?>


  <section id="pastor" class="pastor-main-block block-spacing">
    <div class="parallax" style="background-image: url('<?=$urlOriBase;?>images/Pastor/pastor-bg.jpg')">
      <div class="overlay-bg"></div>
      <div id="pastor-slider" class="pastor-slider">
        <div class="item pastor-block">  
          <div class="container">
            <div class="pastor-content">
              <span class="quotes-icon"><i class="fa fa-2x fa-quote-left"></i></span>
              <h2 class="pastor-dtl"><?=$t1;?></h2>              
              <div class="pastor-id"><p><?=$tn1;?></p></div>
              <h2 class="pastor-dtl"><br></h2>
            </div> 
          </div>
        </div>
        <div class="item pastor-block">  
          <div class="container">
            <div class="pastor-content">
              <h2 class="pastor-dtl"><br></h2>
              <span class="quotes-icon"><i class="fa fa-2x fa-quote-left"></i></span>
              <h2 class="pastor-dtl"><?=$t2;?></h2>                
              <div class="pastor-id"><p><?=$tn2;?></p></div>
              <h2 class="pastor-dtl"><br></h2>           
            </div>
          </div>
        </div>
        <div class="item pastor-block">  
          <div class="container">
            <div class="pastor-content">
              <span class="quotes-icon"><i class="fa fa-2x fa-quote-left"></i></span>
              <h2 class="pastor-dtl"><?=$t3;?></h2>              
              <div class="pastor-id"><p><?=$tn3;?></p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>     
<!--  end pastor -->



<!--  parallax  -->
<section id="abt-tab" class="tab-main-block">
    <div class="parallax" style="background-image: url('<?=$urlOriBase;?>images/bg-img.jpg')">
      <div class="overlay-bg"></div>
      <div class="abt-tab-block">
        <div class="container">     
          <div class="abt-tab-content text-center">
            <h3 class="abt-tab-heading">"Quien no vive para servir no sirve para vivir"</h3>
            <h5 class="abt-tab-subheading">Papa Francisco.</h5>
          </div>


          <div class="abt-tab-icons text-center">
            <div class="row">

<?php if($idparroquia == 538){ ?>

<?=dameBloqueItemManual($urlOri."radio/897/", "Radio", "flaticon-video-player"); ?>
<?=dameBloqueItemManual($urlOri."/eventos.html", "Agenda", "flaticon-events");?>
<?php } ?>

<?php 

if($idparroquia != 102){
$i=1; 
 
              $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2) ORDER BY tipo ASC";
              $result = mysql_query($sql,$conex);
              if(mysql_num_rows($result) > 0) {
                $rw = mysql_fetch_assoc($result);
                echo dameBloqueItemManual("#despacho", $rw['titulo'], "flaticon-prayers");
                $i++; 
              }

              if($idparroquia != 588){
					 $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3) ORDER BY tipo ASC";
				  $result = mysql_query($sql,$conex);
				  if(mysql_num_rows($result) > 0) {
					$rw = mysql_fetch_assoc($result);
					if ($rw['texto']<>'') {
					  echo dameBloqueItemManual("#caritas", $rw['titulo'], "flaticon-prayers");
					  $i++; 
					}
				  }
			  }

              $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 4) ORDER BY tipo ASC";
              $result = mysql_query($sql,$conex);
              if(mysql_num_rows($result) > 0) {
                $rw = mysql_fetch_assoc($result);
                if ($rw['texto']<>'') {
                  echo dameBloqueItemManual("#cementerio", $rw['titulo'], "flaticon-prayers");
                  $i++; 
                }
              }

              if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1) {
                
                $titulo = 'Petición de oraciones';
                $enlace=$urlOri."oraciones.html";

                if ($idparroquia==14) { $titulo = "Oramos contigo"; }

                echo dameBloqueItemManual($enlace, $titulo, "flaticon-teaching");

                $i++;
              }

              if (getValue("SELECT activar FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = $idparroquia",1) == 1) {
                
                $idP = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = ".$idparroquia,0);
                $nP = $idP[1];
                $idP = $idP[0];
                $enlace=$urlOri."revista-parroquial/".$idP;

                echo dameBloqueItemManual($enlace, 'Revista parroquial', "flaticon-sermons");
                $i++;
               } 


               echo temp13_getBloques($i);

              }

           ?>

               <?php if($idparroquia == 102){ ?>
              
                <div class="abt-tab-content text-center" style="clear:both; padding-top:40px !important;padding-bottom:30px !important;">
                  <h3 class="abt-tab-heading">Síguenos en Redes sociales</h3>
                </div>

                <div class="row"> 
                  <div class="col-md-4">
                    <a href="https://www.instagram.com/prendimiento_torrent" target="_blank" title="Síguenos en Instagram">
                      <img src="<?=$urlOri;?>templates/ecclesia_3/images/redes/logo_instagram.png" />
                    </a>  
                  </div>

                  <div class="col-md-4">
                    <a href="https://www.facebook.com/Hermandad-del-Prendimiento-de-Jesus-Torrent-336474514071/" target="_blank" title="Síguenos en Facebook">
                      <img src="<?=$urlOri;?>templates/ecclesia_3/images/redes/logo_facebook.png" />
                    </a>
                  </div>

                  <div class="col-md-4">
                    <a href="https://twitter.com/elprendimiento" target="_blank" title="Síguenos en Twitter">
                      <img src="<?=$urlOri;?>templates/ecclesia_3/images/redes/logo_twitter.png" />
                    </a>
                  </div>
               </div>

               <div style="clear:both;"></div>
               <br><br>
                <div class="row">
                  <div class="col-md-4">
                    <div style="position:relative;max-width:400px;min-width:100px;"><blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/Ca6nyjeNofA/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:400px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/Ca6nyjeNofA/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">Ver este post en Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/Ca6nyjeNofA/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">Prendimiento De Jesús -Torrent (@prendimiento_torrent)</a></p></div></blockquote><script async src="//platform.instagram.com/es_ES/embeds.js"></script><div style="position: absolute;width: 80%;bottom:2px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;"></div></div>
                  </div>
                  <div class="col-md-4">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FHermandad-del-Prendimiento-de-Jesus-Torrent-336474514071&tabs=timeline&width=340&height=708&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=617391558314340" width="340" height="708" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                  </div>
                  <div class="col-md-4">
                    <a class="twitter-timeline" data-lang="es" data-width="500" data-height="708" href="https://twitter.com/elprendimiento?ref_src=twsrc%5Etfw">Tweets by elprendimiento</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                  </div>
               </div>

              <?php } ?>

              
<?php if($idparroquia == 1264){ ?>


<?=dameBloqueItemManual($urlOri."misa-online.html", "Misa online", "flaticon-video-player"); ?>

<?php } ?>

          </div>  
        </div>  
      </div>    
    </div>
  </section>

<?php 

// BLOQUES HORARIO MISAS ETC

	if(!isset($_GET['cat'])){

  $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 1) ORDER BY tipo ASC";
  $result = mysql_query($sql,$conex);
  if(mysql_num_rows($result) > 0) {
?>
<!--  about  -->
  <section id="about" class="about-main-block">

     <div class="section text-center">
      <h3 class="section-heading">Horario de Misas</h3>
    </div>


    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="<?=$urlOriBase;?>images/abt/<?php if($idparroquia == 1011) echo "basilica/_MG_8305.jpg"; 
            else if($idparroquia == 1110) echo "padua/biblia.jpg";
            else if($idparroquia == 1264) echo "america/misa.png";
            else echo "about-img.jpg";?>" class="img-responsive" alt="about-img">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-content">
		  
		<?php if($idparroquia == 540){ ?>
		
		<div class="text-center"><b>Traducir página</b>: <br>
			<div id="google_translate_element" class="text-center"></div>
		</div><br><br><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'ca,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<?php } ?>
		  
          <?php

            while($rw = mysql_fetch_assoc($result))
            { 
              if($rw['texto'] != "")
              {
                echo $rw['texto'];
              }
           }
          ?>

          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end about -->

<?php } ?>
  
<!--  end parallax -->
<!--  who are we -->
  <section id="who" class="who-main-block hidden-xs">
    <div class="container">
      <div class="section text-center">
        <h3 class="section-heading">Oración y liturgia</h3>
        <h5 class="sub-heading">"Es muy hermoso rezar, alzar la mirada hacia el cielo, dirigir la mirada a nuestro corazón y saber que tenemos un padre bueno que es Dios".</h5>
        <p>Papa Francisco.</p>
      </div>
      <?php
      //<div id="who-slider" class="who-slider">
      ?>
        <div class="item who-block">
          <div class="row">  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height:450px;">
              <div class="who-dtlOne">
                <a href="<?=$urlOri;?>oraciones-y-liturgia/"><h4 class="who-heading">Liturgia de las horas y Palabra de Dios Hoy.</h4></a>
                <p>¿Que dice el Evangelio hoy? Encuentra toda la info que necesitas a continuación.</p>
                <a class="read-more" href="<?=$urlOri;?>oraciones-y-liturgia/">Leer más<i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin:0;padding:0;">
              <div class="who-imgOne">
                <img src="<?=$urlOriBase;?>images/abt/<?php if($idparroquia == 1110) echo "padua/oracion_liturgia.png"; else echo "who-img-01.jpg"; ?>" class="img-responsive" alt="who-img-1">
              </div>
            </div>
          </div>
          <div class="row">  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin:0;padding:0;">
              <div class="who-imgTwo img-spacing">
                <img src="<?=$urlOriBase;?>images/abt/<?php if($idparroquia == 1110) echo "padua/misa_varios_idiomas.png"; else if($idparroquia == 1264) echo "america/biblia_america.png"; else echo "who-img-02.jpg"; ?>" class="img-responsive" alt="who-img-2">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-dtlTwo">
                <a href="<?=$urlOri;?>misa-en-varios-idiomas/"><h4 class="who-heading">Lectura de la misa en diferentes idiomas</h4></a>
                <p>Le ofrecemos la posibilidad de descargar en formato PDF todas las lecturas de las misas en los diferentes idiomas disponibles.</p>
                <a class="read-more" href="<?=$urlOri;?>misa-en-varios-idiomas/">Leer más<i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
       
    </div>
  </section>
<!--  end who are we -->

<!--  latest news -->
 <?php
 
 
	} // IF isset cat noticias
	
 ?>

<!--  end latest news -->


<?php include('bloques.php'); ?>


<!--  upcoming events -->
  <?php
 /*
    $event = temp13_proximosEventos(6);

    if ($event) {

      echo ' <section id="eventos" name="eventos" class="events-main-block">
    <div class="section text-center">
      <h3 class="section-heading">Próximos eventos</h3>
    </div>
    <div id="event-slider" class="event-slider">';

      echo $event;

      echo '
      </div>  
      </section>';

    }*/


  ?>
<!--  end upcoming events -->



<!--  donation -->
<?php
/*
  <section id="donation" class="donation-main-block">
    <div class="parallax" style="background-image: url('<?=$urlOriBase;?>images/bg-img.jpg')">
      <div class="overlay-bg"></div>
      <div class="section text-center">
        <h3 class="section-heading">Urgent Donation Required</h3>
        <h5 class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at euismod ex, Maeceans sit amet sollicitudin ex.</h5>
      </div>  
      <div class="donation-block">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="donation-item">
                <div class="donation-img block-effect">
                  <a href="donation-details.html"><img src="<?=$urlOriBase;?>images/donation/donation-02.jpg" class="img-responsive" alt="donation-img-1"></a>
                  <span class="donation-btn"><a href="donation-details.html" class="btn btn-default">Donate</a></span>
                </div>
                <div class="donation-content">
                  <p class="social-media-heading">Share Post :</p>
                   <div class="social-icon">
                    <ul>
                      <li><a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="https://www.twitter.com/" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="https://plus.google.com/" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                      <li><a href="https://dribbble.com/" target="_blank" class="dribble"><i class="fa fa-dribbble"></i></a></li>                    
                      <li><a href="https://www.behance.net/" target="_blank" class="behance"><i class="fa fa-behance"></i></a></li>
                    </ul>
                  </div>
                  <a href="donation-details.html"><h4 class="donation-heading">Lorem ipsum dolor sit amet.</h4></a>
                  <p class="donation-dtl">Aliquam laoreet orci quis risus vulputate tem Quisque aliquet, ipsum at mattis mattis</p>
                  <a class="read-more" href="donation-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="donation-item">              
                <div class="donation-img block-effect">
                  <a href="donation-details.html"><img src="<?=$urlOriBase;?>images/donation/donation-01.jpg" class="img-responsive" alt="donation-img-2"></a>
                  <span class="donation-btn"><a href="donation-details.html" class="btn btn-default">Donate</a></span>
                </div>
                <div class="donation-content">
                  <p class="social-media-heading">Share Post :</p>
                  <div class="social-icon">
                    <ul>
                      <li><a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="https://www.twitter.com/" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="https://plus.google.com/" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                      <li><a href="https://dribbble.com/" target="_blank" class="dribble"><i class="fa fa-dribbble"></i></a></li>                    
                      <li><a href="https://www.behance.net/" target="_blank" class="behance"><i class="fa fa-behance"></i></a></li>
                    </ul>
                  </div>
                  <a href="donation-details.html"><h4 class="donation-heading">Lorem ipsum dolor sit amet.</h4></a>
                  <p class="donation-dtl">Aliquam laoreet orci quis risus vulputate tem Quisque aliquet, ipsum at mattis mattis</p>
                  <a class="read-more" href="donation-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 donation-top-mgn">
              <div class="donation-item">                
                <div class="donation-img block-effect">
                  <a href="donation-details.html"><img src="<?=$urlOriBase;?>images/donation/donation-03.jpg" class="img-responsive" alt="donation-img-3"></a>
                  <span class="donation-btn"><a href="donation-details.html" class="btn btn-default">Donate</a></span>
                </div>
                <div class="donation-content">
                  <p class="social-media-heading">Share Post :</p>
                   <div class="social-icon">
                    <ul>
                      <li><a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="https://www.twitter.com/" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="https://plus.google.com/" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                      <li><a href="https://dribbble.com/" target="_blank" class="dribble"><i class="fa fa-dribbble"></i></a></li>                    
                      <li><a href="https://www.behance.net/" target="_blank" class="behance"><i class="fa fa-behance"></i></a></li>
                    </ul>
                  </div>
                  <a href="donation-details.html"><h4 class="donation-heading">Lorem ipsum dolor sit amet.</h4></a>
                  <p class="donation-dtl">Aliquam laoreet orci quis risus vulputate tem Quisque aliquet, ipsum at mattis mattis</p>
                  <a class="read-more" href="donation-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
*/
  ?>
<!--  end donation -->

<?php


  $n_patrocinadores = 6;


  $sql = "SELECT n.* FROM patrocinadores n WHERE n.parroquia = $idparroquia AND n.activar = 1 ORDER BY n.id DESC limit $n_patrocinadores";
              
  //echo $sql;

  $error='';

  $rs = mysql_query($sql,$conex) or $error=(mysql_error());

  $i=0;
  if(mysql_num_rows($rs) > 0)
  {

?>

<!--  causes -->
  <section id="causes" class="causes-main-block">
    <div class="container">
      <div class="section text-center">
        <h3 class="section-heading">Patrocinadores</h3>
      </div>
      <div class="row">

    <?php
    while($rw = mysql_fetch_assoc($rs))
    {
      $idpatrocinador=$rw["id"];
      $foto = getValue("SELECT foto FROM patrocinadores_fotos WHERE foto != '' AND idpatrocinador = $idpatrocinador ORDER BY idfoto ASC LIMIT 1",1);

      $foto = $urlRecursos."uploads/$idparroquia/patrocinadores/thb_".$foto;

      echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="causes-item">
            <div class="cause-img">';
      echo '   <a href="'.$rw["enlace"].'" target="_blank"> <img src="'.$foto.'" class="img-responsive" alt="'.$rw["patrocinador"].'"></a>
            </div>
            <div class="causes-content">
              <a class="causes-heading" href="'.$rw["enlace"]. '" target="_blank"> <h5 class="causes-heading">'.$rw["patrocinador"].'</h5></a>
            </div>
          </div>
        </div>';
    }

    ?>    

      </div>
    </div>
  </section>
<?php } ?>
<!--  end causes -->


<?php 
  $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3) ORDER BY tipo ASC";
  $result = mysql_query($sql,$conex);
  if(mysql_num_rows($result) > 0) {
     $rw = mysql_fetch_assoc($result);
     if($rw['texto'] != ""){
?>
<!--  about  -->
<?php if($idparroquia != 588){ ?>
  <section id="caritas" class="about-main-block">

     <div class="section text-center">
      <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
    </div>
    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="<?=$urlOriBase;?>images/abt/<?php if($idparroquia == 855) echo "caritas2.png"; else echo "caritas.png"; ?>" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-content">


        <?php
            if($rw['texto'] != ""){ echo $rw['texto']; }
            while($rw = mysql_fetch_assoc($result))
            { 
              if($rw['texto'] != ""){ echo $rw['texto']; }
            }
        ?>

          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
<!--  end about -->
<?php
   }}
 ?>

<!--  portfolio -->
<?php
  $bucle = getGalerias($idparroquia);
  $conta = 0;

  if(mysql_num_rows($bucle) > 0) {
    ?>
 <section id="portfolio" class="portfolio-main-block portfolio-one">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading">Galería</h3>

        <?php //<h5 class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at  euismod ex, Maeceans sit amet sollicitudin ex.</h5>
         
        ?>
      </div>
      <div class="row">';
      <div id="portfolio-block" class="portfolio-popup">
      <?php

        while($rw = mysql_fetch_assoc($bucle))
        {
            $idgal = $rw['id'];
            $categoria = stripslashes($rw['categoria']);
            $fecha = date('d/m/Y G:i',strtotime($rw['fecha']));
            $numfotos = intval($rw['numfotos']);

            $foto = getValue("SELECT foto FROM galeria_fotos WHERE foto != '' AND categoria = $idgal ORDER BY orden ASC LIMIT 1",1);

            $foto = $urlRecursos."uploads/$idparroquia/big_".$foto;

            $urlGal = $urlOri."galeria-".limpiarCadena($categoria,'archivo')."_".$idgal.".html";

            $conta++;

            $columnas='col-lg-3 col-md-3 col-sm-6 col-xs-6';
            //$size_ima=' height="490" width="477"';
            if ($conta==1 or $conta==6) { $columnas='col-lg-6 col-md-6 col-sm-12 col-xs-12'; }
            //$size_ima=' height="468" width="933"';}


            echo '<div class="'.$columnas.' portfolio-item portfolio-btm-mrgn">
            <div class="portfolio-img">  
              <img src="'.$foto.'" class="img-responsive" alt="'.$categoria.'">';
            echo '<div class="portfolio-overlay"><a href="'.$urlGal.'"><i class="fa fa-search"></i></a></div>
              <div class="portfolio-overlay"><a href="'.$urlGal.'"><i class="fa fa-search"></i> '.$categoria.'</a></div>
            </div>
          </div>';

        }
        ?>
        </div>
      </div>
    </div>
  </section>
<?php 
  }
?>
<!--  end portfolio -->