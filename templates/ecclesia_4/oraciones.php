<link href="<?=$urlOri;?>templates/ecclesia_4/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

<?php

  if(isset($_GET['mes']) && isset($_GET['anyo']) && isset($_GET['dia'])) $fecha = addslashes($_GET['dia'])."-".addslashes($_GET['mes'])."-".addslashes($_GET['anyo']); else $fecha = date('d-m-Y');

  $fechaFormato = date('d',strtotime($fecha))." de ".getMes(date('m',strtotime($fecha))).", ".date('Y',strtotime($fecha));

?>



<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Oraciones y Liturgia</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Oraciones y Liturgia</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  blog  -->
   <section id="news" class="news-main-block news-three">
    <div class="container">



<?php

    // **********************************
    // ********** LITURGIA DE LAS HORAS
    // **********************************

    $intro = getValue("SELECT intro FROM liturgia_urls WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",1);
    $intro = strip_tags($intro);

    $intro = RecortaStr($intro,240,'..');

    if($intro == "") $intro = "Accede desde el enlace de abajo a la liturgia.";
  ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="news-block">

            <div id="eventos-dia">
              <h4>Liturgia de las horas</h4>

                <b><?=$fechaFormato;?></b>

                <p><?=$intro;?></p>
                <a href="<?=$urlOri;?>liturgia/<?=$fecha;?>/" class="completo more">Ver oraciones &raquo;</a>
            </div>
          
          </div>
        </div>
      </div>

<?php
    // **********************************
    // ********** LECTURA DIARIA
    // **********************************

    $valores = getValue("SELECT titulo, texto FROM pastoral_lecturas WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

    if(!isset($valores[0])) $titulo = ""; else $titulo = stripslashes($valores[0]);
    if(!isset($valores[1])) $texto = ""; else $texto = RecortaStr(strip_tags($valores[1]),160,'..');

    $urlLectura = $urlOri."lectura-diaria/".$fecha."/";

  ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="news-block">

        <div id="eventos-dia">
      
          <h4>Lectura diaria</h4>
          <?php if($texto != ""){ ?>

            <a href="<?=$urlOri;?>lectura-diaria/<?=$fecha;?>/" class="completo"><?=$titulo;?></a>
            <b><?=$fechaFormato;?></b>
            <p><?=$texto;?></p>
            <a href="<?=$urlLectura;?>" class="completo more">Leer completo &raquo;</a>
          <?php } else { ?>
            <p>En breve.</p>

          <?php } ?>

        </div>
      
      </div>
    </div>
  </div>


  <?php

    // **********************************
    // ********** COMENTARIO DIARIO
    // **********************************

    $valores = getValue("SELECT titulo, texto FROM comentarios_lecturas WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

    if(isset($valores[0]) && isset($valores[1]))
    {

      $titulo = stripslashes($valores[0]);
      $texto = RecortaStr(strip_tags($valores[1]),160,'..');

      $urlComentario = $urlOri."comentario/".$fecha."/";
    }
    else{
      $titulo = "No existe todavía comentario diario para este día";
      $texto = "";
      $urlComentario = "";
    }

  ?>

    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="news-block">
        <div id="eventos-dia">
        <h4>Comentario diario</h4>
          <?php if($urlComentario != ""){ ?>
            <a href="<?=$urlComentario;?>" class="completo"><?=$titulo;?></a>
          <?php }else{ ?>
            <span class="completo"><?=$titulo;?></span>
          <?php } ?>

          <b><?=$fechaFormato;?></b>

          <p><?=$texto;?></p>
          <?php if($urlComentario != ""){ ?>
            <a href="<?=$urlComentario;?>" class="completo more">Leer completo &raquo;</a>
          <?php } ?>
        </div>
     </div>
    </div>
  </div>


  <?php
    // **********************************
    // ********** SANTORAL **************
    // **********************************

    $valores = getValue("SELECT titulo, contenido FROM santoral WHERE dia = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

    $titulo = stripslashes($valores[0]);
    $titulo = RecortaStr($titulo,60,'..');
    $texto = RecortaStr(strip_tags($valores[1]),120,'..');

    $urlSantoral = $urlOri."santoral/".$fecha."/";
  ?>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="news-block">
        <div id="eventos-dia">
         <h4>Santoral</h4>

          <a href="<?=$urlSantoral;?>" class="completo"><?=$titulo;?></a>

          <b><?=$fechaFormato;?></b>

          <p><?=$texto;?></p>
          <a href="<?=$urlSantoral;?>" class="completo more">Leer completo &raquo;</a>
        </div>
     </div>
    </div>
  </div>

  <?php
    // **********************************
    // ********** HOY DOMINGO ***********
    // **********************************

    $valores = getValue("SELECT titulo, texto, fecha FROM hoy_domingo WHERE fecha >= '".date('Y-m-d',strtotime($fecha))."' ORDER BY fecha ASC LIMIT 1",0);

    if(isset($valores[0]) && isset($valores[1]))
    {

      $titulo = stripslashes($valores[0]);
      $texto = RecortaStr(strip_tags($valores[1]),110,'..');

      $fechaDomingo = date('d-m-Y',strtotime($valores[2]));

      $urlDomingo = $urlOri."hoy-domingo/".$fechaDomingo."/";

      $fechaFormatoDomingo = date('d',strtotime($valores[2]))." de ".getMes(date('m',strtotime($valores[2]))).", ".date('Y',strtotime($valores[2]));
    }
    else{
      $titulo = "Todavía no existe texto de Hoy Domingo para la fecha seleccionada";
      $texto = "";
      $urlDomingo = "";
      $fechaFormatoDomingo = "";
    }
  ?>

    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="news-block">

        <div id="eventos-dia">

        <h4><?php if($idparroquia == 1) echo "Hoy Domingo"; else echo "Pr&oacute;ximo domingo"; ?></h4>

          <?php if($urlDomingo != ""){ ?>
            <a href="<?=$urlDomingo;?>" class="completo"><?=$titulo;?></a>
          <?php }else{ ?>
            <span class="completo"><?=$titulo;?></span>
          <?php } ?>

          <?php if($fechaFormatoDomingo != "01 de Enero, 1970"){ ?>
            <b><?=$fechaFormatoDomingo;?></b>
          <?php } ?>

          <p><?=$texto;?></p>
          <?php if($urlDomingo != ""){ ?><a href="<?=$urlDomingo;?>" class="completo more">Leer completo &raquo;</a><?php } ?>
        </div>
     </div>
    </div>
  </div>

    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="news-block">

      <div id="calendar">

      <div id="calendar_wrap">

        <?php

          if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
          if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

          $eventosMes = getArrayOraciones($mes, $anyo);

          $devuelve = generateBig_calendarLiturgiaOracion($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array());

          echo $devuelve;

        ?>

          </div>
      </div>


     </div>
    </div>
  </div>



  </div>
</section>
