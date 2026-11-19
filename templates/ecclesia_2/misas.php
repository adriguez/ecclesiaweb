<?php
/******************************************************************
***** (OM) Creada 04/10/2018
******************************************************************/
?>

<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?php if($idioma == "en") echo "Mass in Various Languages"; else echo "Misa en Varios idiomas"; ?></h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>"><?php if($idioma == "en") echo "Home"; else echo "Inicio"; ?></a></li>
            <li class="active"><a><?php if($idioma == "en") echo "Mass in Various Languages"; else echo "Misa en Varios idiomas"; ?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  blog  -->
<section id="news" class="news-main-block news-three">
  <div class="container">

        <h2><?php if($idioma == "en") echo "Mass in Various Languages"; else echo "Misa en Varios idiomas"; ?><h2>

        <?php if(!isset($_GET['ciclo'])){ ?>  

          <div style="clear:both;"></div>
          <p><?php if($idioma == "en") echo "We offer you the possibility to download in PDF format all the Mass readings in the different languages available, first select a cycle."; else echo "Le ofrecemos la posibilidad de descargar en formato PDF todas las lecturas de las misas en los diferentes idiomas disponibles, primero seleccione un ciclo."; ?></p>

          <div align="center">
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-A/';" value="<?php if($idioma == "en") echo "Cycle A"; else echo "Ciclo A"; ?>" />
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-B/';" value="<?php if($idioma == "en") echo "Cycle B"; else echo "Ciclo B"; ?>" />
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-C/';" value="<?php if($idioma == "en") echo "Cycle C"; else echo "Ciclo C"; ?>" />

          </div>
        <?php }else{ ?>
          <?=getMisas(addslashes($_GET['ciclo']));?>
        <?php } ?>

  </div>
</section>
