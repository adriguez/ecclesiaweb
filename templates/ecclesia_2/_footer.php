<!-- footer -->
  <footer id="footer" class="footer-main-block">
    <div class="bg-img" style="background-image: url('<?=$urlOriBase;?>images/footer-bg.jpg')">


      <div class="overlay-bg"></div>
      <div class="container">

<?php /*


        <div class="row footer-block">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-logo">
              <a href="index.html"><img src="<?=$urlOriBase;?>images/footer-logo.png" class="img-responsive" alt="footer-logo"></a>
            </div>
            <div class="row footer-content">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><p>Santa Cruz Office:</p></div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"><p>Wporganic Themes<br>Block 145 Antela Road<br>Bredsbin Austrlia </p></div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><p>Phone:</p></div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"><p class="contact-no"><a href="tel:012123456789">012 123 456 789</a><br><a href="tel:012123456789">012 123 456 789</a></p></div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><p>Email:</p></div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <p class="mail-to"><a href="mailto:wporganic@example.com?Subject=Hello%20again" target="_top">demo@ecclesiared.es</a></p>
              </div>
            </div>
          </div> 
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">  
            <div class="footer-section">
              <h6 class="footer-heading">Últimas noticias</h6>
            </div>
            <div class="footer-content">

            <?php

            
              $n_noticias=2;

              //$idparroquia=3;
              
              $sqlWhere = "";
              $sqlWhere .= " AND n.categoria != 39 ";

              $hoy = date('Y-m-d ');

              $sqlWhere .= " AND fecha <= '".$hoy." 00:00:00' ";

              $sql = "SELECT n.* FROM noticias n WHERE n.parroquia = $idparroquia AND n.activar = 1 
              $sqlWhere ORDER BY n.fecha DESC, n.id DESC limit $n_noticias";
              
              //echo $sql;

              $rs = mysql_query($sql,$conex) or die (mysql_error());

              $i=0;
              if(mysql_num_rows($rs) > 0)
              {

                  while($rw = mysql_fetch_assoc($rs))
                  {

                    $fecha = date('Y-m-d',strtotime($rw['fecha']));
                    $fecha = explode("-",$fecha);

                    $anyo = $fecha[0];
                    $dia = $fecha[2];
                    $mes = $fecha[1];

                    //$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;
                    $fechaPublicada = $dia.' '.substr(strtoupper(getMes($mes)),0,3)." ".$anyo;

                    $tieneFoto = getValue("SELECT foto FROM noticias_fotos WHERE idnoticia = ".$rw['id']." LIMIT 1",1);

                    if($tieneFoto != "")
                    {
                      $urlFoto = $urlOri."uploads/".$rw['parroquia']."/noticias/thb_".$tieneFoto;
                    }
                    else{
                      $urlFoto = $urlOriBase."images/footer/post-thumb-01.jpg";
                    }           

                    $urlNoti = $urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html";

                    $noticias[$i]=array($rw["titular"], $fechaPublicada, $urlNoti, $urlFoto);
                  
                    $i++;
                  }

              }

              
              //$noticias[0]=array('noticia1', '25-5-2018');
              //$noticias[1]=array('noticia2', '20-5-2018');
            ?>

            <?php if (isset($noticias[0]) ) { ?>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 footer-post"><a href="<?php echo $noticias[0][2];?>"><img src="<?php echo $noticias[0][3];?>" class="img-responsive" alt="<?php echo $noticias[0][0];?>"></a></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9 footer-post"><a href="<?php echo $noticias[0][2];?>"><p><?php echo $noticias[0][0];?><br><span class="footer-post-date"><?php echo $noticias[0][1];?></span></p></a></div>
              </div>

            <?php }
            if (isset($noticias[1])) { ?>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 footer-post"><a href="<?php echo $noticias[1][2];?>"><img src="<?php echo $noticias[1][3];?>" class="img-responsive" alt="<?php echo $noticias[1][0];?>"></a></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9 footer-post"><a href="<?php echo $noticias[1][2];?>"><p><?php echo $noticias[1][0];?><br><span class="footer-post-date"><?php echo $noticias[1][1];?></span></p></a></div>
              </div> 
            <?php } ?>  
            </div>          
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="footer-section">
              <h6 class="footer-heading">Enlaces Amigos</h6>
            </div>
            <div class="accor-widget footer-cause-block">
              <div class="panel-group cause-panel" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <p class="panel-title question-heading">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="btn btn-default cause-btn cause-btn-minus"><i class="fa fa-minus"></i></span>
                        <span class="btn btn-default cause-btn cause-btn-plus"><i class="fa fa-plus"></i></span>
                        Do you have an installation service?
                      </a>
                    </p>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <p>Dramatically redefine effective users for synergistic e-business.</p>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <p class="panel-title question-heading">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <span class="btn btn-default cause-btn cause-btn-minus"><i class="fa fa-minus"></i></span>
                        <span class="btn btn-default cause-btn cause-btn-plus"><i class="fa fa-plus"></i></span>
                        Are updates free of charge?
                      </a>
                    </p>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                      <p>Dramatically redefine effective users for synergistic e-business.</p>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <p class="panel-title question-heading">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <span class="btn btn-default cause-btn cause-btn-minus"><i class="fa fa-minus"></i></span>
                        <span class="btn btn-default cause-btn cause-btn-plus"><i class="fa fa-plus"></i></span>
                        Can i use Semona on all projects?
                      </a>
                    </p>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                      <p>Dramatically redefine effective users for synergistic e-business.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>      



          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">          
            <div class="footer-section">
              <h6 class="footer-heading">Galería</h6>
            </div>
            <div class="footer-content portfolio-popup">

            <?php
              $bucle = getGalerias($idparroquia);
              $conta = 0;

              if(mysql_num_rows($bucle) > 0) {

                while($rw = mysql_fetch_assoc($bucle))
                {
                  $idgal = $rw['id'];
                  $categoria = stripslashes($rw['categoria']);
                  $fecha = date('d/m/Y G:i',strtotime($rw['fecha']));
                  $numfotos = intval($rw['numfotos']);

                  $foto = getValue("SELECT foto FROM galeria_fotos WHERE foto != '' AND categoria = $idgal ORDER BY orden ASC LIMIT 1",1);

                  $foto = $urlOri."uploads/$idparroquia/thb_".$foto;

                  $urlGal = $urlOri."galeria-".limpiarCadena($categoria,'archivo')."_".$idgal.".html";

                  $conta++;

                  if ($conta<7) {

                  echo'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 portfolio-item">
                         <div class="portfolio-img">
                          <img src="'.$foto.'" class="img-responsive" alt="'.$categoria.'">';
                          //<img src="images/footer/gallery-thumb-01.jpg" class="img-responsive" alt="gallery-thumb-01">
                  echo'<div class="portfolio-overlay"><a href="'.$urlGal.'"><i class="fa fa-plus"></i></a></div>
                          </div>           
                      </div>';


                  }
                }
              }
      

        ?>                
            </div>
          </div>
        </div>  



*/?>


        <div class="row">     
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-dtl text-center">

            <p></p>
          </div> 
        </div>


        <div class="row">     
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-dtl text-center">

            <?php if($idioma == "en"){ ?>
              <p>Website developed with <a href="https://www.ecclesiared.es/" title="Ecclesiared" 
              target="_blank">Ecclesiared</a> software.</p>

              <p><a href="<?=$urlOri;?>aviso-legal.html" title="Legal notice">Legal notice</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Privacy policy">Privacy policy</a> | <a href="<?=$urlOri;?>cookies.html" title="Cookies policy">Cookies policy</a></p>
              
              <?php }else{ ?>
                
                <p>Página web desarrollada con el sistema de <a href="https://www.ecclesiared.es/" title="Plataforma de gestión parroquial online" 
              target="_blank">Ecclesiared</a></p>

              <p><a href="<?=$urlOri;?>aviso-legal.html" title="Aviso legal">Aviso legal</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Política de privacidad">Política de privacidad</a>
            | <a href="<?=$urlOri;?>cookies.html" title="Política de Cookies">Política de Cookies</a></p>
              <?php } ?>

              <?php if($idparroquia == 1264){ ?>
              <ul>
                <li>
                  <a href="https://www.facebook.com/Nuestrasradeamerica" target="_blank"><i style="font-size:30px;margin-right:20px;" class="fa fa-facebook fa-sm"></i></a>
                  <a href="https://www.youtube.com/channel/UCHqvmuDv-N0-bJ4n4YV_tSg" target="_blank"><i style="font-size:30px;margin-right:20px;"  class="fa fa-youtube fa-sm"></i></a>
                  <a href="https://www.instagram.com/parroquiaamerica/" target="_blank"><i style="font-size:30px;margin-right:20px;"  class="fa fa-instagram fa-sm"></i></a>
                </li>
              </ul>
              <?php } ?>


          </div> 


        </div>
      
      </div> 
    </div>
  </footer>
<!-- end footer -->
<!-- jquery -->
<!-- jquery library js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/jquery.min.js"></script> 
<!-- bootstrap js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/bootstrap.min.js"></script> 
 <!-- owl carousel js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/owl.carousel.js"></script>
<!-- mail chimp js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/jquery.ajaxchimp.js"></script> 
<!-- smooth scroll js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/smooth-scroll.js"></script>
<!-- magnify popup js-->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/jquery.magnific-popup.min.js"></script> 
<!-- menu js--> 
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/menumaker.js"></script> 
<!-- price slider js -->
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/price-slider.js"></script> 
 <!-- event countdown js --> 
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/jquery.countdown.js"></script> 
<!-- custom js -->  
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/theme.js"></script> 
<!-- end jquery -->


<!-- <script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_2/js/jquery.scrollTo.js"></script>-->


<script type="text/javascript" language="javascript">
  

$(document)
  .ready(function () {
    let modalId = $('#image-gallery');
    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Este portal web únicamente utiliza cookies propias con finalidad técnica, no recaba ni cede datos de carácter personal de los usuarios sin su conocimiento. Sin embargo, contiene enlaces a sitios web de terceros con políticas de privacidad ajenas este portal web que usted podrá decidir si acepta o no cuando acceda a ellos.",
    "dismiss": "Aceptar",
    "link": "Configuración e información",
    "href": "<?php if($idparroquia == 69) echo $urlRecursos."/uploads/69/Politica_de_proteccion_de_datos.pdf"; else echo $urlOri."/politica-privacidad.html"; ?>"
  }
});
</script>

</body>
<!--body end -->
</html>
