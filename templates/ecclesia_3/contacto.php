<?php

	$destinatario = getDestinos($idparroquia, 'form-control');


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
					$msg = "El mensaje ha sido enviado correctamente, la parroquia se pondrá en contacto con usted lo más pronto posible."; 
				break;
			} 

			$msg = '<h5>'.$msg.'</h5>';

		}


?>

<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Contacto</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Contacto</a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  contact form  -->

<section id="contact-form" class="form-main-block form-two form-three">

      <?php if(isset($msg) && $msg != ""){ ?>
      <div align="center" class="error">
        <span style="font-size: 20px;"><strong><span style="color: rgb(255, 0, 0);"><?=$msg;?></span></strong></span></p>
      </div>
      <?php } ?>

    <div class="section">

     <h4 class="section-heading">Contacta con la <?php if($idparroquia == 102) echo "Hermandad"; else echo "Parroquia"; ?></h4>

    </div>
    <div class="container">
      <div class="row">
            <div class="contact-form-block">
              
              <form class="contact-form" method="post" action="dev_contacto.php" name="formContacto" id="formContacto">
               <div class="col-sm-12">          
                  <div class="form-group">
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required />
                  </div>
                </div>

               <div class="col-sm-12">          
                  <div class="form-group">
                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" />
                  </div>
                </div>

               <div class="col-sm-12">          
                  <div class="form-group">
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" />
                  </div>
                </div>

               <div class="col-sm-12">          
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico"/>
                  </div>
                </div>

        				<?php if($destinatario != ""){ ?>

        					<div class="col-sm-12"> 
        						<div class="form-group">
        								<?=$destinatario;?>
        							</div>
        						</div>

        				<?php } ?>

                <div class="col-sm-12">          
                  <div class="form-group">           
                   <textarea id="mensaje" class="form-control" name="mensaje" placeholder="Mensaje"></textarea>
                  </div>
                </div>

            <div class="col-sm-12">
                <?php			
                			if($idparroquia == 30){ ?>
                				<p>Al enviar este formulario, acepta las condiciones generales del servicio,
                					<a href="<?=$urlRecursos;?>/uploads/30/Informacion_de_privacidad.pdf" title="Información de privacidad">Información de privacidad</a></p>
                			<?php } ?>

          		  <div class="col-sm-12 text-left">

                      <span><a href="#">    
                        
						
								<p><button class="g-recaptcha btn btn-default"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button></p>
						     
                        </a></span>

                </div>

              <input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />
            </div>
      </form>  
        </div>
      </div>
    </div>
  </section> 
<!-- end contact form -->