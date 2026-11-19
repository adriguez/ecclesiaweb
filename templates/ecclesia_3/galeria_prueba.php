<?php require_once(__DIR__ . '/../../_includes/php8_compat.php'); // Compatibilidad PHP 8
ini_set('display_errors','1');
ini_set("error_reporting",E_ALL);


$mysqlUser = "web_user";
$mysqlPwd = "4z5G13l%r";

$dbname = "web";

$conex = mysql_connect('localhost',$mysqlUser,$mysqlPwd);
mysql_select_db($dbname, $conex);

$idparroquia=3;


function getGalerias($idparroquia)
{
  global $conex, $urlOri, $_GET;

  // SACAMOS DATOS DE LAS GALERÍAS

  $sqlWhere = "";

  $sql = "SELECT g.* FROM galeria_categorias g WHERE g.parroquia = ".$idparroquia." $sqlWhere ORDER BY g.fecha DESC ";
  $rs = mysql_query($sql,$conex) or die (mysql_error());

  return $rs;
}

function getValue ($SQL, $aux=0)
    {
        global $conex;
        $vfila = "";
        $vresultado=mysql_query($SQL, $conex) or die (mysql_error());

        if (isset($_GET['showCode'])) echo $SQL."<BR>";

        if (mysql_num_rows($vresultado)==1)
            {
  $vfila = mysql_fetch_array($vresultado);
  mysql_free_result($vresultado);
  if ($aux==0) return $vfila; else return $vfila[0];
            }
        else return $vfila;
    }

echo 'hola';

?>

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

            $urlGal = $urlOri."galeria-".$categoria."_".$idgal.".html";

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

        if(mysql_num_rows($bucle) > 0)
        {

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

            $fotoThumb = $urlOri."uploads/$idparroquia/thb_".$foto;

            $urlFoto = "uploads/$idparroquia/big_".$foto;

            $urlDescarga = $urlOri."descarga.php?file=".$urlFoto;
            $urlPrint = $urlOri."print.php?tipo=imagen&file=".$urlFoto;


            //if($conta%2==0) echo "<div class=\"row\">";

            $conta++;

      ?>

            <div class="col-md-4 col-sm-6 portfolio-item">
              <div class="portfolio-img">      
                <img src="<?=$fotoThumb;?>" class="img-responsive" alt="<?=$tituloFoto;?>">
                <div class="portfolio-overlay"><a href="<?=$urlFoto;?>"><i class="fa fa-plus"></i></a></div>
              </div>
            </div>


          <?php
          }

          echo '</div>';
          echo '</div>';

          echo '<div class="row">';
          echo '<div class="col-md-12 text-center">';
           echo '<h3>Todos los derechos de imágenes quedan reservados al ser propiedad de la parroquia'.getValue("SELECT titulo_logo FROM configuracion_base 
            WHERE parroquia = $idparroquia",1).'</h3>';
          echo '</div>';
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

?php } ?>