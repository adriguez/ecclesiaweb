
<!--  slider -->
<header id="home-slider" class="slider-main-block">
<?php


if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 


  $sqWhere = "";
  // if($idparroquia == 14) $sqWhere = " AND galeria_fotos.categoria = 40 ";

  $sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.parroquia = 0 AND galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." ORDER BY rand() LIMIT 10";
  $result = mysql_query($sql,$conex) or die (mysql_error());

  if(mysql_num_rows($result) == 0)
  {
    

    $sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." AND galeria_fotos.horizontal = 1 ORDER BY rand() LIMIT 10";
    $result = mysql_query($sql,$conex) or die (mysql_error());
  }

  $featured = "";

  $i=0;

  while($rw = mysql_fetch_assoc($result))
  {
    $urlFoto = "";

    $foto = $urlRecursos."uploads/".$idparroquia."/big_".$rw['foto'];

   
  
/*
  $featured .= "<div class=\"item $active\">
                <div class=\"fill\" style=\"background-image:url('".$foto."');\"></div>
                <div class=\"carousel-caption\">
                    <h2>".$rw['titulo']."</h2>
                </div>
            </div>";
*/

    $item= "<div class=\"item home-slider-img\" style=\"background-image: url('".$foto."')\">";
    // Opacidad --> $featured .= '<div class="overlay-bg"></div>';
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
  
    $featured.=$item;
    $i++;
  }

if ($i==1) { $featured.=$item; }

echo $featured;
}

?>
</header>
<!--  end slider -->

<?php 
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
            <img src="<?=$urlOriBase;?>images/abt/about-img.jpg" class="img-responsive" alt="about-img">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-content">
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


<?php 
$i=1; 
 
              $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2) ORDER BY tipo ASC";
              $result = mysql_query($sql,$conex);
              if(mysql_num_rows($result) > 0) {
                $rw = mysql_fetch_assoc($result);
                echo dameBloqueItemManual("#despacho", $rw['titulo'], "flaticon-prayers");
                $i++; 
              }

              $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3) ORDER BY tipo ASC";
              $result = mysql_query($sql,$conex);
              if(mysql_num_rows($result) > 0) {
                $rw = mysql_fetch_assoc($result);
                echo dameBloqueItemManual("#caritas", $rw['titulo'], "flaticon-prayers");
                $i++; 
              }

              $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 4) ORDER BY tipo ASC";
              $result = mysql_query($sql,$conex);
              if(mysql_num_rows($result) > 0) {
                $rw = mysql_fetch_assoc($result);
                echo dameBloqueItemManual("#cementerio", $rw['titulo'], "flaticon-prayers");
                $i++; 
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

                echo dameBloqueItemManual($enlace, 'Revista paroquial', "flaticon-sermons");
                $i++;
               } 


               echo temp13_getBloques($i);


/*
<br><br>
          <div class="abt-tab-icons">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">                  
                  <a href="#">  
                    <div class="abt-tab-icon">
                      <i class="flaticon-events"></i>
                    </div>
                    <h6 class="abt-icon-name">Proximos eventos</h6>
                  </a>
                </div>
              </div>

              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">                  
                  <a href="#">  
                    <div class="abt-tab-icon">
                      <i class="flaticon-events"></i>
                    </div>
                    <h6 class="abt-icon-name">Proximos eventos</h6>
                  </a>
                </div>
              </div>
            </div>
           </div>

           */
           ?>
          </div>  
        </div>  
      </div>    
    </div>
  </section>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-dtlOne">
                <a href="<?=$urlOri;?>oraciones-y-liturgia/"><h4 class="who-heading">Liturgia de las horas y Palabra de Dios Hoy.</h4></a>
                <p>¿Que dice el Evangelio hoy? Encuentra toda la info que necesitas a continuación.</p>
                <a class="read-more" href="<?=$urlOri;?>oraciones-y-liturgia/">Leer más<i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-imgOne">
                <img src="<?=$urlOriBase;?>images/abt/who-img-01.jpg" class="img-responsive" alt="who-img-1">
              </div>
            </div>
          </div>
          <div class="row">  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-imgTwo img-spacing">
                <img src="<?=$urlOriBase;?>images/abt/who-img-02.jpg" class="img-responsive" alt="who-img-2">
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
        <?php  
        /*
        <div class="item who-block">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-dtlOne">
                <a href="about.html"><h4 class="who-heading">tres.</h4></a>
                <p>Aliquam laoreet orci quis risus vulputate tempor. Quisque aliquet, ipsum at mattis mattis, tortor nibh cursus lorem, ac iaculis metus sem vitae purus. Vivamus suscipit velit nec maximus interdum.</p>
                <a class="read-more" href="about.html">Read More<i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-imgOne">
                <img src="<?=$urlOriBase;?>images/abt/who-img-03.jpg" class="img-responsive" alt="who-img-3">
              </div>
            </div>
          </div>
          <div class="row">  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-imgTwo img-spacing">
                <img src="<?=$urlOriBase;?>images/abt/who-img-04.jpg" class="img-responsive" alt="who-img-4">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="who-dtlTwo">
                <a href="about.html"><h4 class="who-heading">cuatro.</h4></a>
                <p>Aliquam laoreet orci quis risus vulputate tempor. Quisque aliquet, ipsum at mattis mattis, tortor nibh cursus lorem, ac iaculis metus sem vitae purus. Vivamus suscipit velit nec maximus interdum.</p>
                <a class="read-more" href="about.html">Read More<i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
       */
       //</div>
      //<div id="who-count" class="who-count"></div>
      ?>
    </div>
  </section>
<!--  end who are we -->



<?php  
/*
<!--  latest sermons -->
  <section id="sermons" class="sermons-horizontal-main-block sermons-hOne">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading">Latest Sermons</h3>
        <h5 class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at euismod ex, Maeceans sit amet sollicitudin ex.</h5>
      </div>
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="sermons-block">
            <div class="sermons-img">
              <img src="<?=$urlOriBase;?>images/sermons/sermons-01.jpg" class="img-responsive" alt="sermons-img-1">
            </div>
            <div class="item sermons-horizontal-block">
              <div class="sermons-content">
                <a href="sermons-details.html"><h4 class="sermons-heading">Praesent elementum ante.</h4></a>
                <div class="sermons-desc">
                  <p class="sermons-speaker">Speaker : <a href="sermons-details.html">Johan Tom</a></p>
                  <p class="sermons-date">Date : 02 - 01 - 2017</p>
                </div>
                <p class="sermons-dtl">Aliquam laoreet orci quis risus vulputate tem Quisque aliquet, ipsum at mattis mattis</p>
                <a class="read-more" href="sermons-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
              </div>
              <div class="sermons-icon">
                <ul>
                  <li>
                      <a class="popup-video" href="https://video-vh.s3.envato.com/h264-video-previews/e0657980-289f-4c5a-9ba0-2c730b9c990a/19398708.mp4"><i class="flaticon-video-player"></i></a>
                  </li>
                  <li>
                      <a class="popup-video" href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/72365194&#038;auto_play=false&#038;hide_related=false&#038;show_comments=true&#038;show_user=true&#038;show_reposts=false&#038;visual=true"><i class="flaticon-headphones"></i></a>
                  </li>
                  <li><a href="uploads/demo.zip" target="_blank" class="cloud"><i class="flaticon-cloud-computing"></i></a></li>
                  <li><a href="uploads/demo.pdf" class="pdf"><i class="flaticon-pdf"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="sermons-block">
            <div class="sermons-img">
              <img src="<?=$urlOriBase;?>images/sermons/sermons-02.jpg" class="img-responsive" alt="sermons-img-2">
            </div>
            <div class="item sermons-horizontal-block">
              <div class="sermons-content">
                <a href="sermons-details.html"><h4 class="sermons-heading">Praesent elementum ante.</h4></a>
                <div class="sermons-desc">
                  <p class="sermons-speaker">Speaker : <a href="sermons-details.html">Johan Tom</a></p>
                  <p class="sermons-date">Date : 02 - 01 - 2017</p>
                </div>
                <p class="sermons-dtl">Aliquam laoreet orci quis risus vulputate tem Quisque aliquet, ipsum at mattis mattis</p>
                <a class="read-more" href="sermons-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
              </div>
              <div class="sermons-icon">
                <ul>
                  <li>
                      <a class="popup-video" href="https://vimeo.com/1084537"><i class="flaticon-video-player"></i></a>
                  </li>
                  <li>
                      <a class="popup-video" href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/597953&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"><i class="flaticon-headphones"></i></a>
                  </li>
                  <li><a href="uploads/demo.zip" target="_blank" class="cloud"><i class="flaticon-cloud-computing"></i></a></li>
                  <li><a href="uploads/demo.pdf" class="pdf"><i class="flaticon-pdf"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end latest sermons -->
*/
?>

<!--  latest news -->
 <?php
  $idnoticia = 0;

  $mes = "";
  $anyo = "";

  if(isset($_GET['cat']) && $_GET['cat'] > 0) $idcategoria = intval($_GET['cat']); else $idcategoria = "";
        
  if(isset($_GET['archivo']) && $_GET['archivo'] == 1 && isset($_GET['mes']) && isset($_GET['anyo']) && $_GET['mes'] != "" && $_GET['anyo'] != "")
  {
    $mes = addslashes($_GET['mes']);
    $anyo = addslashes($_GET['anyo']);
  }

  $rs = dameBucle($idparroquia, $numNotis, $idnoticia, $idcategoria, $mes, $anyo);

  $bucle = $rs[0];
  $numRes = $rs[1];
  $nPags = $rs[2];
  $pg = $rs[3];

  if(mysql_num_rows($bucle) > 0)
  {

?>
 <section id="news" class="news-main-block">
    <div class="container">
      <div class="section text-center">
        <h3 class="section-heading">Últimas noticias</h3>
      </div>

<?php
    include_once "noticias.php";
?>

    </div>
  </section>

  <?php
    }
  ?>
<!--  end latest news -->

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

<?php 
  $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2) ORDER BY tipo ASC";
  $result = mysql_query($sql,$conex);
  if(mysql_num_rows($result) > 0) {
    $rw = mysql_fetch_assoc($result);
?>
<!--  about  -->
  <section id="despacho" class="about-main-block">

     <div class="section text-center">
      <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
    </div>
    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="<?=$urlOriBase;?>images/abt/despacho-img.jpg" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
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
<!--  end about -->
<?php
   }
 ?>


<?php 
  $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 4) ORDER BY tipo ASC";
  $result = mysql_query($sql,$conex);
  if(mysql_num_rows($result) > 0) {
     $rw = mysql_fetch_assoc($result);
?>
<!--  about  -->
  <section id="cementerio" class="about-main-block">

     <div class="section text-center">
      <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
    </div>
    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="<?=$urlOriBase;?>images/abt/cementerio.jpg" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
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
<!--  end about -->
<?php
   }
 ?>


<!--  upcoming events -->
  <?php
 
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

    }


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
?>
<!--  about  -->
  <section id="caritas" class="about-main-block">

     <div class="section text-center">
      <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
    </div>
    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="<?=$urlOriBase;?>images/abt/caritas.png" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
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
<!--  end about -->
<?php
   }
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

            $foto = $urlRecursos."uploads/$idparroquia/mid_".$foto;

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
              <div class="portfolio-overlay"><a href="'.$urlGal.'"><i class="fa fa-search"></i></a></div>
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