<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Peticiones de Oraciones</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Peticiones de Oraciones</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  contact form  -->
<section id="contact-form" class="form-main-block form-two form-three">
      <div class="container">
          <div class="row">
            <div class="contact-form-block">
              
            <form id="contactoForm" name="contactoForm" method="post" action="dev_oraciones.php">
            
            <?php 

              if(isset($_GET['msg']) && $_GET['msg'] > 0){ 

                switch(intval($_GET['msg']))
                {
                  case 1;
                    $tipo = "error";
                    $msg = "El código de seguridad introducido es incorrecto";
                  break;

                  case 2; 
                    $tipo = "error"; 
                    $msg = "Faltan campos obligatorios por rellenar."; 
                  break;

                  case 3; 
                    $tipo = "exito";
                    $msg = "La petición de oración ha sido enviada correctamente. Muchas gracias."; 
                  break;
                } ?>

                <div class="section text-center">
                  <div class="col-md-12 text-center">
                    <h5 class="sub-heading"><?=$msg;?></h5>
                  </div>
                </div>

            <?php } ?>

            <?php $pre = getValue("SELECT pre_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1);

            if($pre != "")
            {
              echo '<div class="col-md-12 text-center">';
              echo convertYoutube($pre);
              echo '</div>';
            }
            ?>

      <?php /*if($idparroquia==14){ ?>
        <div align="center">
          <img class="thumbnail" style="width:100%;" src="http://www.unitatcostacalvia.com/images/unitatpeticion.jpg" />
        </div>
      <?php }*/ ?>


            <div class="col-sm-12">          
              <div class="form-group">
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required />
              </div>
            </div>

            <div class="col-sm-12">          
              <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico" required />
              </div>
            </div>

            <div class="col-sm-12">          
              <div class="form-group">
                  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" />
              </div>
            </div>

            <div class="col-sm-12">          
              <div class="form-group">
                  <input type="text" class="form-control" name="edad" id="edad" placeholder="Edad" />
              </div>
            </div>

            <div class="col-sm-12">          
              <div class="form-group">
                  <input type="text" class="form-control" name="lugar" id="lugar" placeholder="De donde escribes" />
              </div>
            </div>

            <div class="col-sm-12">          
              <div class="form-group">           
                <textarea id="mensaje" class="form-control" name="mensaje" placeholder="Escribe la intención por la que deseas que oremos"></textarea>
              </div>
            </div>
 
            <input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />

              <div class="col-sm-12"> 
                <span><a href="#">  
				<button class="g-recaptcha btn btn-default"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitOraciones' 
								data-action='submit'>Enviar mensaje</button>     
                </a></span>

              </div>

            </form>  
        </div>
      </div>
    </div>
  </section> 
<!-- end contact form -->