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
          <h3 class="section-heading">Misa en Varios idiomas</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Misa en Varios idiomas</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  blog  -->
<section id="news" class="news-main-block news-three">
  <div class="container">

        <h2>Misa en Varios idiomas<h2>

        <?php if(!isset($_GET['ciclo'])){ ?>  

          <div style="clear:both;"></div>
          <p>Le ofrecemos la posibilidad de descargar en formato PDF todas las lecturas de las misas en los diferentes idiomas disponibles, primero seleccione un ciclo.</p>

          <div align="center">
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-A/';" value="Ciclo A" />
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-B/';" value="Ciclo B" />
            <input type="button" class="btn btn-default" onclick="document.location.href='<?=$urlOri;?>/misa-en-varios-idiomas/ciclo-C/';" value="Ciclo C" />

          </div>
        <?php }else{ ?>
          <?=getMisas(addslashes($_GET['ciclo']));?>
        <?php } ?>

  </div>
</section>
