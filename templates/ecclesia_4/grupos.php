<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?php if($idparroquia == 1011) echo "Actividad Pastoral"; else if($idparroquia == 102) echo "Hermandad"; else echo "Grupos Parroquiales"; ?></h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a><?php if($idparroquia == 1011) echo "Actividad Pastoral"; else if($idparroquia == 102) echo "Hermandad"; else echo "Grupos Parroquiales"; ?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  about  -->
<section id="about-block" class="about-main-block abt-two">
    <div class="container">
    	<div class="sectionCenter">
    		<div class="noticiaCenter">
   
			<?php 


				if(isset($_GET['m']) && $_GET['m'] > 0) $idgrupo = intval($_GET['m']); else $idgrupo = "";

				if($idgrupo > 0)
				{

				$bucle = getGrupos($idparroquia, $idgrupo);

				if(mysql_num_rows($bucle) > 0)
				{
					$rw = mysql_fetch_assoc($bucle);

					// **********************
					// **** IMAGENES ********
					// **********************

					$sql = "SELECT * FROM grupos_fotos WHERE parroquia = $idparroquia AND idgrupo = $idgrupo ORDER BY idfoto ASC";
					$rs = mysql_query($sql,$conex) or die (mysql_error());

					$imagenes = "";
					$imagenPrimera = "";
					$conta = 0;

					if(mysql_num_rows($rs) == 1)
					{
						$fila = mysql_fetch_assoc($rs);

						$foto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
						$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

						$imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";

					}
					elseif(mysql_num_rows($rs) > 1)
					{
						while($fila = mysql_fetch_assoc($rs))
						{
							$conta++;

							$foto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/mid_".$fila['foto'];
							$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/grupos/big_".$fila['foto'];

							if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";
							else{
								$imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img class=\"thumbnail\" src=\"$foto\" /></a>";

							}
						}
					}

					$valContacto = getValue("SELECT permitir_contacto, email_contacto FROM grupos_pastorales WHERE id = '$idgrupo'",0);
					$permiteContacto = $valContacto[0];
					$emailContacto = $valContacto[1];


					// **********************
					// **********************
					// **********************

				?>


				<script type="text/javascript" language="javascript">

				jQuery(document).ready(function() {
					jQuery(".fancybox-thumb").fancybox({
						prevEffect	: 'none',
						nextEffect	: 'none',
						helpers	: {
							title	: {
								type: 'inside'
							},
							thumbs	: {
								width	: 50,
								height	: 50
							}
						}
					});
				});

				</script>

		

 					<h2><?=$rw['nombre'];?></h2>
			
					

					<?php if($imagenPrimera != ""){ ?>
						<div class="photo-article">
							<?=$imagenPrimera;?>	
						</div>
					<?php } ?>	

						<?php 

						$dato = stripslashes($rw['contenido']);

						$dato = convertYoutube($dato);
						echo $dato;
						?>
				
						<?=$imagenes;?>

						<?php
							echo getAdjuntosGrupo($idgrupo);
						?>

					<?php if($permiteContacto == "1" && $emailContacto != ""){
						
						
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
									$msg = "El mensaje ha sido enviado correctamente."; 
								break;
							} 

							$msg = '<h5>'.$msg.'</h5>';

						}

						?>
					

						<?php if(isset($msg) && $msg != ""){ ?>
							<div align="center" class="error">
								<span style="font-size: 20px;"><strong><span style="color: rgb(255, 0, 0);"><?=$msg;?></span></strong></span></p>
							</div>
							<?php }else{ ?>

								<div class="success" style="font-weight:bold;background:#f3f3f3;padding:10px;margin-bottom:15px;">
									Le gustaría formar parte de nuestro grupo o desearía  tener más información, puede dejar su mensaje en el siguiente formulario:
								</div>

							<?php } ?>
							
      <div class="row">
            <div class="contact-form-block">
              
              <form class="contact-form" method="post" action="<?=$urlOri;?>dev_contacto.php" name="formContacto" id="formContacto">
               <div class="col-sm-12">          
                  <div class="form-group">
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required />
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

                <div class="col-sm-12">          
                  <div class="form-group">           
                   <textarea id="mensaje" class="form-control" name="mensaje" placeholder="Mensaje"></textarea>
                  </div>
                </div>

            <div class="col-sm-12">

          		  <div class="col-sm-12 text-left">

                      <span><a href="#">    
                        
						
								<p><button class="g-recaptcha btn btn-default"
								data-sitekey="<?=getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1);?>" 
								data-callback='onSubmitContacto' 
								data-action='submit'>Enviar contacto</button></p>
						     
                        </a></span>

                </div>

				<input type="hidden" name="idGrupo" id="idGrupo" value="<?=$idgrupo;?>" />
				<input type="hidden" name="contactoGrupos" id="contactoGrupos" value="1" />
              	<input type="hidden" name="idparroquia" id="idparroquia" value="<?=$idparroquia;?>" />
            </div>
      </form>  
        </div>
      </div>

					<?php  } ?>

			
				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen datos.</h2>";

			}
			else{

				if($idparroquia == 233) $txtGrupos = "Pastoral Castrense";
				else if($idparroquia == 102) $txtGrupos = "Hermandad";
				else $txtGrupos = "Grupos Parroquiales";

			?>
		

			<?=allGroups('fa-arrow-right');?>
					
			

			<?php } ?>
		</div>
</div>
</div>
</section>