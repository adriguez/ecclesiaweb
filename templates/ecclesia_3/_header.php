<?php

 // ini_set('display_errors','1');
 // ini_set("error_reporting",E_ALL);

  if (isset($_GET['sec'])) {
    $seo = getDatosSeo($_GET['sec']);
  } else { $seo='';}

  $valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis, whatsapp FROM configuracion_base WHERE parroquia = $idparroquia",0);

  $whatsappTel = str_replace(")","",str_replace("(","", str_replace("-","",$valores['whatsapp'])));

  $onload = "";
  $mapa = false;
  $geolocalizada = false;

  // *********************************
  // *** MAPA DE GOOGLE PARA CONTACTO
  // *********************************

  if(isset($_GET['sec']) && $_GET['sec'] == "estaticas" && isset($_GET['m']) && $_GET['m'] > 0)
  {
    $txtint = getValue("SELECT txt_int, geolocalizada, latitud, longitud FROM paginas WHERE parroquia = $idparroquia AND id = ".intval($_GET['m']),0);

    $geolocalizada = $txtint[1];
    $lat = $txtint[2];
    $lng = $txtint[3];
    $txtint = $txtint[0];

    if($txtint == "donde-esta")
    {
      if($valores[3] != "" && $valores[4] != "")
      {
        $lat = $valores[4];
        $lng = $valores[3];
        $mapa = true;
        $onload = "onload=\"initialize()\"";
      }
    }
    else if($geolocalizada == 1 && $lat != "" && $lng != "")
    {
      $mapa = true;
      $geolocalizada = true;
      $onload = "onload=\"initialize()\"";
    }
  }

  // *********************************
  // *********************************
  // *********************************

  if(!isset($seo['title']) || $seo['title'] == "") $seo['title'] = $valores[0];
  if(!isset($seo['description']) || $seo['description'] == "") $seo['description'] = "Bienvenidos a la p�gina web de ".$valores[0];

  //echo 
  $urlOriBase=$urlOri.'templates/ecclesia_3/';

  //exit();
  
 
	$misaonline = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
	if($misaonline['urlmisa'] != "") $showmisa = true;
	else $showmisa = false;

?>



<!DOCTYPE html>
<html lang="es">
<head>
<title><?=$seo['title'];?></title>
<meta charset="iso-8859-1" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="description" content="<?=$seo['description'];?>" />

<?php if($idparroquia == 1319){ ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XELBY7F1YL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XELBY7F1YL');
</script>

<?php } ?>

<?php
/*
<meta name="keywords" content="Church HTML Template, church, html template, html theme, church theme,bible, charity, christ, christian, church, churches, events, mosque, non profit, religion, religious, sermon">
<meta name="author" content="wp-organic" />
<meta name="MobileOptimized" content="320" />
*/
?>

<!-- favicon-icon -->
<link rel="icon" type="image/icon" href="images/favicon/favicon.ico"> 
<!-- theme style -->
<!-- bootstrap css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
<!-- fontawesome css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> 
<!-- flat icons css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/flaticon.css" rel="stylesheet" type="text/css"/> 
<!-- google font -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,900|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<!-- menu css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/menumaker.css.php" rel="stylesheet" type="text/css"/> 
<!-- owl carousel css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/owl.carousel.css" rel="stylesheet" type="text/css"/> 
<!-- magnify popup css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/magnific-popup.css" rel="stylesheet" type="text/css"/> 
<!-- datepicker css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/datepicker.css" rel="stylesheet" type="text/css"/> 
<!-- custom css -->
<link href="<?=$urlOri;?>templates/ecclesia_3/css/style.css.php?t=<?=time();?>" rel="stylesheet" type="text/css"/> 
<!-- end theme style -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ1PxaClZBYnZx3nK9eDuK44MzO7BF7M4&sensor=false&language=es"></script>


	 <script>
	   function onSubmit(token) {
		 document.getElementById("formComentario").submit();
	   }
	   
	   function onSubmitContacto(token) {
		 document.getElementById("formContacto").submit();
	   }
	   
	   function onSubmitDonativos(token) {
		 document.getElementById("donativosForm").submit();
	   }

     function onSubmitOraciones(token) {
      document.getElementById("contactoForm").submit();
     }
	 </script>

<link rel="alternate" type="application/rss+xml" title="<?=$seo['title'];?> &raquo; Feed" href="<?=$urlOri;?>feed/" />

<?php if($idparroquia == 855){ ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-M0H7MKPZF4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-M0H7MKPZF4');
</script>

<!-- Hotjar Tracking Code for https://www.iglesialasoledad.org/ -->
  <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2475218,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<?php } ?>

</head>
<!-- end head -->
<!--body start-->
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">




<!-- preloader --> 
  <div class="preloader">
    <div class="status">
      <div class="status-message">
      </div>
    </div>
  </div>
<!-- end preloader --> 
<!--  navigation -->
  <div class="nav-bar navbar-fixed-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="navigation-menu">
 
            <div id="cssmenu">
              <ul>
              <li>
                <div class="logo">
                <a href="<?=$urlOri;?>">
                  <?php if($idparroquia == 73){ ?>
                    <img src="<?=$urlOri;?>templates/ecclesia_3/images_1/anagrama_73.png" class="cruz anagrama73" title="<?=$valores["titulo_logo"];?>" />
                  <?php }else if($idparroquia == 1102){ ?>
                  <img src="<?=$urlOri;?>templates/ecclesia_3/images_1/anagrama_calatrava.png" class="cruz anagrama73" title="<?=$valores["titulo_logo"];?>" />
                  <?php }else if($idparroquia == 1319){ ?>
                    <img src="<?=$urlOri;?>templates/ecclesia_3/images_1/anagrama_diego.png" class="cruz anagrama73" title="<?=$valores["titulo_logo"];?>" />
                    <?php }else if($idparroquia == 1264){ ?>
                      <img src="<?=$urlOri;?>templates/ecclesia_3/images/anagrama_arg.png" class="cruz anagrama73" title="<?=$valores["titulo_logo"];?>" />
                  <?php }else if($idparroquia == 588){ ?>
					<img src="<?=$urlOri;?>templates/ecclesia_3/images/anagrama_lourdes.png" class="cruz" title="<?=$valores["titulo_logo"];?>"/>
          <?php }else if($idparroquia == 102){ ?>
					<img src="<?=$urlOri;?>templates/ecclesia_3/images/logo_hermandad.png" class="cruz" title="<?=$valores["titulo_logo"];?>"/>
				  <?php }else{ ?>
                    <img src="<?=$urlOri;?>templates/ecclesia_3/images_1/<?php if($idparroquia == 376) echo "anagrama_paula.png"; else if($idparroquia == 855) echo "logo-soledad.png"; else if($idparroquia == 978) echo "anagrama_guadalupe.png"; else echo "anagrama.png"; ?>" class="cruz" title="<?=$valores["titulo_logo"];?>"/>
                  <?php } ?>
                </a>
                </div>
              </li> 



                <?php include_once "menu_superior.php" ?>

               
              </ul>

              <?php if($idparroquia == 978){ ?>
                <img src="<?=$urlOri;?>templates/ecclesia_3/images/guadalupe_2.png" class="anagrama-2" style="float: right;
    position: absolute;right:-60px;" title="<?=$valores["titulo_logo"];?>"/>
              <?php } ?>

            </div>
          </div>
        </div>        
      </div>
    </div>
  </div> 
<!--  end navigation -->

<?php
/*
<!-- search -->
  <div class="search">
    <div class="container clearfix">
      <input type="search" class="search-box" placeholder="Type anything here...."/>
      <a href="#" class="fa fa-times search-close"></a>
    </div>
  </div>
<!-- end search -->
*/ ?>


<?php if($whatsappTel != ""){ ?>
	
<style type="text/css">
  .whatsapp {
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  z-index:100;
}

.whatsapp-icon {
  margin-top:13px;
}
</style>
<a href="https://wa.me/<?=$whatsappTel;?>?text=Hola!%20Me%20pongo%20en%20contacto%20con%20usted%20a%20través%20del%20formulario%20de%20contacto%20de%20Whastapp%20de%20su%20página%20web%20porque..." class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
<?php } ?>


<?php if($idparroquia == 408 || $idparroquia == 2126){ ?>
	
<style type="text/css">
  .tienda {
  position:fixed;
  width:140px;
  height:50px;
  bottom:40px;
  right:40px;
  background-color:#FF0630;
  color:#FFF;
  border-radius:23px;
  text-align:center;
  font-size:24px;
  z-index:100;
}

.whatsapp-icon {
  margin-top:13px;
}
</style>
<a href="https://tienda.parroquiapatriarcasanjose.com/" class="tienda" target="_blank"> <i class="fa fa-shopping-cart whatsapp-icon"></i> Tienda</a>
<?php } ?>

