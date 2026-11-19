      <?php 

        $urlActual = $urlOri.$_SERVER['REDIRECT_URL'];

        if(isset($_GET['m']) && $_GET['m'] > 0) $idnoticia = intval($_GET['m']); else $idnoticia = "";

        $bucle = dameBucle($idparroquia, $numNotis, $idnoticia, 0, '', '', 'single');

        $bucle = $bucle[0];

        if(mysql_num_rows($bucle) > 0)
        {
          $rw = mysql_fetch_assoc($bucle);

          $noticia = stripslashes($rw['noticia']);
          $noticia = convertYoutube($noticia);

          $fecha = date('Y-m-d',strtotime($rw['fecha']));
          $fecha = explode("-",$fecha);

          $anyo = $fecha[0];
          $dia = $fecha[2];
          $mes = $fecha[1];

          //$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;
          $fechaPublicada = $dia.' '.substr(strtoupper(getMes($mes)),0,3)." ".$anyo;

          $catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

          $urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";

          // **********************
          // **** IMAGENES ********
          // **********************

          $sql = "SELECT * FROM noticias_fotos WHERE parroquia = $idparroquia AND idnoticia = $idnoticia ORDER BY idfoto ASC";
          $rs = mysql_query($sql,$conex) or die (mysql_error());

          $imagenes = "";
          $imagenPrimera = "";
          $conta = 0;

          if(mysql_num_rows($rs) == 1)
          {
            $fila = mysql_fetch_assoc($rs);

            $foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];
            $urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];

            $imagenPrimera = "<img class=\"img-responsive\" src=\"$urlFoto\" />";

          }
          elseif(mysql_num_rows($rs) > 1)
          {
            while($fila = mysql_fetch_assoc($rs))
            {
              $conta++;

              $foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];
              $urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/".$fila['foto'];

              if($conta == 1) 

               // $imagenPrimera = "<img class=\"thumbnail\" alt=\"".$rw['titular']."\" src=\"$foto\" />";
               $imagenPrimera = '<img src="'.$foto.'" class="img-responsive" alt="'.$rw['titular'].'">';




              else{
                $imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img alt=\"".$rw['titular']."\" src=\"$foto\" /></a>";

              }
            }
          }


          // **********************
          // **********************
          // **********************

        ?>

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



<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Detalle de la noticia</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Detalle de la noticia</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  blog  -->
   <section id="news" class="news-main-block news-three">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="news-block">
            <div class="news-img">

              <?php if($imagenPrimera != ""){ ?>
                <?=$imagenPrimera;?>
              <?php } ?>


            </div>
   
            <div class="news-content">
              <div class="news-desc">
                  <ul class="redes">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlActual;?>" class="facebook"></a></li>
                    <li><a href="https://twitter.com/intent/tweet?text=<?=$rw['titular'];?> - <?=$urlActual;?>" class="twitter"></a></li>
                    <li><a href="https://plus.google.com/share?url=<?=$urlActual;?>" class="gplus"></a></li>
                   <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$urlActual;?>&title=<?=$rw['titular'];?>&summary=&source=" class="linkedin"></a></li>
                  </ul>
                  <div style="clear:both;"></div>
                <br>
                <p class="news-date"><i class="fa fa-calendar"></i><?=$fechaPublicada;?></p>
                <?php
                //<p class="news-by"><i class="fa fa-user"></i>Post By : <a href="#">Admin</a></p>
                ?>
              </div>
              <h4 class="news-heading"><?=$rw['titular'];?></h4>
              <p class="news-dtl"><?=$noticia;?></p>
            </div>

            <div class="news-img">
            <?php if($imagenes != ""){ ?>
              <?=$imagenes;?>
            <?php } ?>
            </div>

            <?php
              echo getAdjuntosNoticia($idnoticia);
            ?>



<!-- gallery -->
<section id="portfolio" class="portfolio-main-block portfolio-three">
    <div class="container-fluid">

<?php
if($idnoticia == 18871){
  
        $idgaleria = 1690;
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

            $urlOrigen='http://web.mintrared.com/';

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

          </div>
        </div>
      </div>
    </div>
  </section>
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
  //echo getComentarios_plantilla2($idnoticia);
  $devuelve ='';

  $permite = getValue("SELECT comentarios FROM configuracion_base WHERE parroquia = $idparroquia",1);

  if($permite == 1)
  {
    $sql = "SELECT * FROM comentarios_noticias WHERE noticia = $idnoticia AND parroquia = $idparroquia AND activar = 1 ORDER BY fecha DESC";
    $rs = mysql_query($sql,$conex);

    $devuelve = "";

    if(mysql_num_rows($rs) > 0)
    {

      $devuelve='<!--  blog comment  -->
        <section id="comment" class="comment-main-block">
          <div class="container">
            <div class="blog-comment">';

      if(mysql_num_rows($rs) == 1) $s = ""; else $s = "s";
      $devuelve .= '<h4 class="comment-heading">'.mysql_num_rows($rs).' comentario'.$s.'</h4>';

      while($rw = mysql_fetch_assoc($rs))
      {

        $dia = date('d/m/Y',strtotime($rw['fecha']));
        $hora = date('G:i',strtotime($rw['fecha']));

        //$devuelve .= "<div class=\"comentario\">
        //      <span class=\"escrito\">Escrito por <b>".$rw['nombre']."</b> el <b>".$dia."</b> a las <b>".$hora."</b></span>\n
        //      <p class=\"comm\">".$rw['comentario']."</p>
        //    </div>\n";

        $devuelve .= '
        <div class="media"> 
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
              <div class="media-left"> 
                <a href="#"><img src="'.$urlOriBase.'images/blog/comment-01.jpg" class="img-responsive media-object" alt="comment-01"></a> 
              </div> 
            </div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
              <div class="media-body"> 
                <div class="col-xs-12">
                  <a href="#"><h4 class="media-heading">'.$rw['nombre'].' <span>( '.$dia.' '.$hora.' )</span></h4></a>
                  <p>'.$rw['comentario'].'</p>
                </div>
               </div>
            </div>
          </div>
        </div> ';



      }

      $devuelve .= '</div>
      </div>
      </section>
      <!--  end comment  -->';
    }

    if(isset($_GET['msg']))
    {
      switch($_GET['msg'])
      {
        case 1; $msg = "El código de seguridad introducido es incorrecto."; break;
        case 2; $msg = "Faltan campos obligatorios por rellenar"; break;
        case 3; $msg = "En breve se visualizara su comentario en pantalla. ¡Gracias por participar!"; break;
      }

      $msg = '<h5 class="section-heading">'.$msg.'</h5>';

    }


    $devuelve .= '
      <!--  contact form  -->
      <section id="contact-form" class="form-main-block form-two form-three">
      <div class="section">';
      if ($msg<>'') {
        $devuelve .= $msg;
      }
      
      $devuelve .= '
        <h4 class="section-heading">Escribir un comentario</h4>
      </div>
      <div class="container">
          <div class="row">
            <div class="contact-form-block">
              
              <form class="contact-form" method="post" action="dev_comentarios.php" name="formComentario" id="formComentario">
               <div class="col-sm-4">          
                  <div class="form-group">
                    <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre" required>
                  </div>
                </div>
              <div class="col-sm-12">          
                <div class="form-group">           
                 <textarea id="comentario" class="form-control" name="comentario" placeholder="Comentario"></textarea>
                </div>
              </div>
              <input type="hidden" name="idparroquia" id="idparroquia" value="'.$idparroquia.'" />
              <input type="hidden" name="idnoticia" id="idnoticia" value="'.$idnoticia.'" />';
             

              if($idparroquia == 1319) $tex = "costarricense";
              else $tex = "española";

              $devuelve .= '<div class="col-sm-12">   
              <p>No se aceptan los comentarios ajenos al tema, sin sentido, repetidos o que contengan publicidad o spam. Tampoco comentarios insultantes, blasfemos o que inciten a la violencia, discriminación o a cualesquiera otros actos contrarios a la legislación '.$tex.', así como aquéllos que contengan ataques o insultos a los otros comentaristas.</p>
              <span><a href="#">    ';
			  
			  
		$devuelve .= "<button class=\"g-recaptcha btn btn-default\" 
        data-sitekey=\"".getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1)."\" 
        data-callback=\"onSubmit\"
        data-action='submit'>Enviar comentario</button>";

		$devuelve .= '		
              </a></span> 
              </div>
              </form>  
        </div>
      </div>
    </div>
  </section>';
 

    //return $devuelve;

  }
 

  echo $devuelve;

?>

    <?php
        }
        else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";
	?>