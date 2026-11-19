
<?php if(!isset($_GET['m'])){ ?>

<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Galerías Fotográficas</h3>
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active"><a>Galerías Fotográficas</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end banner -->

<!-- gallery -->
  <section id="portfolio" class="portfolio-main-block portfolio-three">
    <div class="container-fluid">

<?php

        $bucle = getGalerias($idparroquia);
        $conta = 0;

        if(mysql_num_rows($bucle) > 0)
        {
?>

      <div class="portfolio-content">     
        <div id="portfolio-block" class="portfolio-popup">
          <div class="row row-full-spacing">
<?php



          while($rw = mysql_fetch_assoc($bucle))
          {

            $idgal = $rw['id'];
            $categoria = stripslashes($rw['categoria']);
            $fecha = date('d/m/Y G:i',strtotime($rw['fecha']));
            $numfotos = intval($rw['numfotos']);

            $foto = getValue("SELECT foto FROM galeria_fotos WHERE foto != '' AND categoria = $idgal ORDER BY orden ASC LIMIT 1",1);

            $foto = $urlOri."uploads/$idparroquia/thb_".$foto;

            $urlGal = $urlOri."galeria-".limpiarCadena($categoria,'archivo')."_".$idgal.".html";

            //if($conta%2==0) echo "<div class=\"row\">";

            $conta++;
      ?>
            
            <div class="col-md-4 col-sm-6 portfolio-item">
              <div class="portfolio-img">      
                <img src="<?=$foto;?>" class="img-responsive" alt="<?=$categoria;?>">
                <div class="portfolio-overlay"><a href="<?=$urlGal;?>"><i class="fa fa-plus"></i></a></div>
              </div>
            </div>

          <?php
          }

          echo '</div>';
          echo '</div>';


            /*
              <div class="row">     
                <div class="col-md-12 load-more text-center">
                  <span class="load-more-btn"><a href="#" class="btn btn-default">View More</a></span>
                </div>
              </div>
             */
          
          echo '</div>';

        } 
         else { 

          echo '<div class="section text-center">';
          echo '<h3 class="section-heading">No existen galerías</h3>';
          echo '</div>';

        }

?>


      
    </div>
  </section>
<!--  end gallery -->

<?php }else{ 

  $idgaleria = intval($_GET['m']);

  $titulo = getValue("SELECT categoria, especial FROM galeria_categorias WHERE parroquia = $idparroquia AND id = $idgaleria",0);
  $especial = $titulo[1];
  $titulo = $titulo[0];

?>

<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?=$titulo;?></h3>
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active"><a><?=$titulo;?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end banner -->

<!-- gallery -->
  <section id="portfolio" class="portfolio-main-block portfolio-three">
    <div class="container-fluid">

<?php
        $bucle = getGaleria($idparroquia, $idgaleria);

        //echo 'hola<br>';

        if(mysql_num_rows($bucle) > 0)
        {

        //echo 'hay<br>';


?>
      <div class="portfolio-content">     
        <div id="portfolio-block" class="portfolio-popup">
          <div class="row row-full-spacing">
<?php

          $conta = 0;

          while($rw = mysql_fetch_assoc($bucle))
          {

            $idgal = $rw['id'];
            $tituloFoto = stripslashes($rw['titulo']);
            $fecha = date('d/m/Y G:i',strtotime($rw['fecha']));

            $foto = $rw['foto'];

            $urlOrigen='http://web.mintrared.es/';

            $fotoThumb = $urlOrigen."uploads/$idparroquia/big_".$foto;

            $urlFoto = $urlOrigen."uploads/$idparroquia/big_".$foto;

            $urlDescarga = $urlOri."descarga.php?file=".$urlFoto;
            $urlPrint = $urlOri."print.php?tipo=imagen&file=".$urlFoto;


            //if($conta%2==0) echo "<div class=\"row\">";

            $conta++;

      ?>

            <div class="col-md-4 col-sm-6 portfolio-item">
              <div class="portfolio-img">      

              <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?=$tituloFoto;?>" data-image="<?=$urlFoto;?>" data-target="#image-gallery">

                  <img src="<?=$fotoThumb;?>" class="img-responsive" alt="<?=$tituloFoto;?>" />
                  <div class="portfolio-overlay"><i class="fa fa-plus"></i></div>

              </a>
              </div>
                <div class="text-center">
                  <span class="titulo" style="font-size:20px;font-weight:bold;"><?=$tituloFoto;?></span><br><br>
                </div>
            </div>


          <?php
          }

          echo '</div>';
          echo '</div>';

          //echo '<div class="row">';
           echo '<div class="section text-center">';
          //echo '<div class="col-md-12 text-center">';
           echo '<h5 class="sub-heading">Todos los derechos de imágenes quedan reservados al ser propiedad de la parroquia '.getValue("SELECT titulo_logo FROM configuracion_base 
            WHERE parroquia = $idparroquia",1).'</h5>';
          //echo '</div>';
          echo '</div>';
          
          echo '</div>';


        } 
         else { 

          echo '<div class="section text-center">';
          echo '<h3 class="section-heading">No existen galerías</h3>';
          echo '</div>';
        }
?>
      
      
</div>
</section>
<!--  end gallery -->
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>