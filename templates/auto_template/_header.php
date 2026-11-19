<?php
  if (isset($_GET['sec'])) {
    $seo = getDatosSeo($_GET['sec']);
  } else { $seo = array(); /* PHP 8: '' ya no se convierte en array */ }

  $valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis FROM configuracion_base WHERE parroquia = $idparroquia",0);

  $onload = "";
  $mapa = false;

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
      $onload = "onload=\"initialize()\"";
    }
  }

  // *********************************
  // *********************************
  // *********************************

  if(!isset($seo['title']) || $seo['title'] == "") $seo['title'] = $valores[0];
  if(!isset($seo['description']) || $seo['description'] == "") $seo['description'] = "Bienvenidos a la página web de ".$valores[0];

  //echo 
  $urlOriBase=$urlOri.'templates/auto_template/';

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
    
    <!-- Loading Bootstrap -->
    <link href="<?=$urlOriBase;?>css/bootstrap.css" rel="stylesheet">

    <link href="<?=$urlOriBase;?>css/style.css" rel="stylesheet">
    <link href="<?=$urlOriBase;?>css/style-magnific-popup.css" rel="stylesheet">
    
    <!-- Loading Layer Slider -->
    <link href="<?=$urlOriBase;?>css/layerslider.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="<?=$urlOriBase;?>css/font-awesome.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="<?=$urlOriBase;?>css/css.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="<?=$urlOriBase;?>js/html5shiv.js"></script>
      <script src="<?=$urlOriBase;?>js/respond.min.js"></script>
    <![endif]-->
    
    <!--headerIncludes-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnrLkAyZNt03zQiObnaKb5jJi9ry6s3vo&sensor=false&language=es"></script>

<link rel="stylesheet" href="<?=$urlOriBase;?>css/skin.css" type="text/css"></head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">
    
    <div id="page" class="page">
        
		<header class="item header margin-top-0 padding-bottom-70" id="header1">
    
    		<div class="wrapper">
    	
    			<div class="container">
    		
    				<nav role="navigation" class="navbar navbar-default navbar-lg navbar-fixed-top">
    					
    					<div class="container">
    				
    						<div class="navbar-header">
    							<button data-target="#navbar" data-toggle="collapse" class="navbar-toggle" type="button">
    								<span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
    							</button>
                                                                
    							<a href="<?=$urlOri;?>" class="navbar-brand brand"><?=$valores["titulo_logo"];?></a>
   							</div>
    								
    						
				        <div id="navbar" class="navbar-collapse collapse">
				          <ul class="nav navbar-nav menuSuperior">
								<?php include_once('menu_superior.php'); ?>
							</ul>	      
    						</div><!-- /.navbar-collapse -->
    			
    					</div><!-- /.container -->
    					
    				</nav>
    			
    			</div><!-- /.container -->
    	
    		</div><!-- /.wrapper -->
			
    	</header><!-- /.item -->