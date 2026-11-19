
<?php 


$mysqlUser = "gestion_user";
$mysqlPwd = "ges569";
$dbname = "gestion";
$conexGestion = mysql_connect('localhost', $mysqlUser, $mysqlPwd);
mysql_select_db($dbname,$conexGestion);

$rw['titulo'] = "Política de Privacidad"; 

$valores = getValue("SELECT titulo, mail_contacto FROM configuracion_base WHERE parroquia = '$idparroquia'",0);

$mail_contacto = $valores['mail_contacto'];
$titulo = $valores['titulo'];

$cs = mysql_query("SELECT cif, direccion, email_contacto, telefono FROM parroquias WHERE id = '$idparroquia'",$conexGestion);

$rw['texto'] = file_get_contents('politica.html', true);

$rw['texto'] = str_replace("[DIRECCION_WEB]", $urlOri,$rw['texto']);
$rw['texto'] = str_replace("[NOMBRE_PARROQUIA]", $titulo, $rw['texto']);
$rw['texto'] = str_replace("xxxnombretitularxxx", $titulo, $rw['texto']);

$rw['texto'] = str_replace("[NIF_PARROQUIA]", mysql_result($cs, 0, 'cif'), $rw['texto']);
$rw['texto'] = str_replace("[DIRECCION_PARROQUIA]", mysql_result($cs, 0, 'direccion'), $rw['texto']);
$rw['texto'] = str_replace("[EMAIL_PARROQUIA]", $mail_contacto, $rw['texto']);
$rw['texto'] = str_replace("[TELEFONO_PARROQUIA]", mysql_result($cs, 0, 'telefono'), $rw['texto']);

?>

<!--  page banner -->
<header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?=$rw['titulo'];?></h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a><?=$rw['titulo'];?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->


<section id="news" class="news-main-block news-three">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="news-block">
                    <div class="news-content">
                    
                        <?=stripslashes($rw['texto']);?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>