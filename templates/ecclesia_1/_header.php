<?php

	$seo = getDatosSeo($_GET['sec']);

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis, whatsapp FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$whatsappTel = str_replace(")","",str_replace("(","", str_replace("-","",$valores['whatsapp'])));

	$onload = "";
	$mapa = false;

	// *********************************
	// *** MAPA DE GOOGLE PARA CONTACTO
	// *********************************

	if(isset($_GET['sec']) && $_GET['sec'] == "estaticas" && isset($_GET['m']) && $_GET['m'] > 0)
	{
		$txtint = getValue("SELECT txt_int, geolocalizada, latitud, longitud FROM paginas WHERE parroquia = $idparroquia AND id = ".intval($_GET['m']),0);

		$idEstatica = intval($_GET['m']);
		
		$geolocalizada = $txtint[1];
		$lat = $txtint[2];
		$lng = $txtint[3];
		$txtint = $txtint[0];

		if($txtint == "donde-esta" || ($idEstatica == 1440 || $idEstatica == 1439 || $idEstatica == 1438 || $idEstatica == 1437 || $idEstatica == 1436))
		{
			
			// Ubicaciones CARIÑO
			
			switch($idEstatica){
				case 1440;
					$valores[3] = "-7.867560094618685";
					$valores[4] = "43.74349836686716";
				break;
				case 1439;				
					$valores[3] = "-7.893540615348786";
					$valores[4] = "43.68275805729693";
				break;
				case 1438;
					$valores[3] = "-7.897884452722718";
					$valores[4] = "43.63479027716037";
				break;
				case 1437;
					$valores[3] = "-7.903696791285792";
					$valores[4] = "43.66288141174066";
				break;
				case 1436;
					$valores[3] = "-7.863303378533305";
					$valores[4] = "43.76088230413368";
				break;
			}
			
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


	$misaonline = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
	if($misaonline['urlmisa'] != "") $showmisa = true;
	else $showmisa = false;

	$fotoNoticia = "";

	if(isset($_GET['sec']) && $_GET['sec'] == "noticia" && isset($_GET['m']) && $_GET['m'] > 0){
		$fotoNoticia = getValue("SELECT foto FROM noticias_fotos WHERE idnoticia = '".intval($_GET['m'])."' AND parroquia = '$idparroquia' ORDER BY idfoto ASC LIMIT 1",1);
		if($fotoNoticia != ""){
			$fotoNoticia = $urlRecursos."uploads/".$idparroquia."/noticias/big_".$fotoNoticia;
		}
	}
	else if(isset($_GET['sec']) && $_GET['sec'] == "estaticas" && isset($_GET['m']) && $_GET['m'] > 0){
		$fotoNoticia = getValue("SELECT foto FROM secciones_fotos WHERE idseccion = '".intval($_GET['m'])."' AND parroquia = '$idparroquia' ORDER BY idfoto ASC LIMIT 1",1);
		if($fotoNoticia != ""){
			$fotoNoticia = $urlRecursos."uploads/".$idparroquia."/secciones/big_".$fotoNoticia;
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$seo['title'];?></title>
	<meta name="description" content="<?=$seo['description'];?>" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" href="<?=$urlOri;?>css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8" />
	
	<?php if($fotoNoticia != ""){ ?>
		<meta property="og:image" content="<?=$fotoNoticia;?>" />
	<?php } ?>
		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	
    <link href="<?=$urlOri;?>css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=$urlOri;?>js/bootstrap.min.js"></script>  
	
    <link rel="stylesheet" href="<?=$urlOri;?>css/font-awesome.min.css">

	<?php if($idparroquia == 24)
	{ ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto|Cinzel+Decorative|Marmelad' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/style_resp_24.css" media="screen" />
	<?php }else{ ?>		
		<link href='https://fonts.googleapis.com/css?family=Roboto|Cinzel+Decorative' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/style_resp.css?t=<?=time();?>" media="screen" />
	<?php } ?>

	<meta name="google-translate-customization" content="b30e296fc927b86c-a1c826f2ddf43a05-gefb6036019326bbd-1f" />

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/superfish.css" />
	<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>


	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.fancybox.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>	

	<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_1/js/superfish.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia_1/js/preview.js.php?id=<?=$idparroquia;?>"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

	<script src='https://www.google.com/recaptcha/api.js'></script>

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/wt-rotator.css" />

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
	<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>
	<script type="text/javascript" language="javascript">

		$().ready(function() {

			//tpsy
				if($('.lnktit').length > 0){
					$('.lnktit').tipsy({gravity:'sw'});
				}

       		$("ul.sf-menu").superfish(); 

			$('#fade').cycle(
				{
					fx: 'scrollDown'
				});

			$('#events').cycle({
				fx:        'turnDown',
				direction: 'down',
				speed: 1200,
				timeout: 3000,
				pauseOnPagerHover: true
			});

		});

	</script>
	
	 <script>
	   function onSubmit(token) {
		 document.getElementById("formComentario").submit();
	   }
	   
	   function onSubmitContacto(token) {
		 document.getElementById("contactoForm").submit();
	   }
	   function onSubmitDonativos(token) {
		 document.getElementById("donativosForm").submit();
	   }
	 </script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ1PxaClZBYnZx3nK9eDuK44MzO7BF7M4&sensor=false&language=es"></script>

<?php $foot = $valores[2]; ?>

<base href="<?=$urlOri;?>" />

<link rel="alternate" type="application/rss+xml" title="<?=$seo['title'];?> &raquo; Feed" href="<?=$urlOri;?>feed/" />

<?php if($idparroquia == 1667){ ?>

<style tyle="text/css">
@import url('https://fonts.googleapis.com/css2?family=Acme&display=swap');
@import url('https://fonts.googleapis.com/css2?family=LXGW+WenKai+TC&display=swap');

#subheader .titulo{
	font-family: "Acme";
  	font-weight: 400;
  	font-style: normal;
	font-size:50px;
}

@media (max-width: 480px) {
    #subheader .titulo {
		font-size:16px;
	}
}

#contenido-central .noticia .titular-noticia a, #contenido-central .noticia .titular-noticia h1, #contenido-central .noticia .titular-noticia span{
	font-family: "LXGW WenKai TC", cursive;
  	font-weight: bold;
  	font-style: normal;
}

</style>

<?php } ?>

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">



<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	
}); // jquery end
</script>

<style type="text/css">
	@media (min-width: 992px){
		.dropdown-menu .dropdown-toggle:after{
			border-top: .3em solid transparent;
		    border-right: 0;
		    border-bottom: .3em solid transparent;
		    border-left: .3em solid;
		}

		.dropdown-menu .dropdown-menu{
			margin-left:0; margin-right: 0;
		}

		.dropdown-menu li{
			position: relative;
		}
		.nav-item .submenu{ 
			display: none;
			position: absolute;
			left:100%; top:-7px;
		}
		.nav-item .submenu-left{ 
			right:100%; left:auto;
		}

		.dropdown-menu > li:hover{ background-color: #f1f1f1 }
		.dropdown-menu > li:hover > .submenu{
			display: block;
		}
	}
</style>


<div class="container">

    <div class="row">
    	<div id="subheader" class="col-md-12 <?php if($idparroquia == 14) echo "unitatcosta"; else echo "nostyle"; ?>">


			<?php if($idparroquia == 639){ ?>
					<img onclick="document.location.href='<?=$urlOri;?>';" class="header" src="<?=$urlOri;?>templates/ecclesia_1/images/divina_cabecera_2.jpg" />
			<?php }else{ ?>

    			<?php if($idparroquia == 73){ ?>
    				<img src="<?=$urlOri;?>templates/ecclesia_1/images/anagrama_73.png" class="cruz anagrama73" />
    			<?php }else{ ?>
    				<img src="<?=$urlOri;?>templates/ecclesia_1/images/anagrama.png" class="cruz" />
    			<?php } ?>
    			<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?></a>
    			<div class="subtitulo"><?=$valores[5];?></div>
				<img onclick="document.location.href='<?=$urlOri;?>';" class="header" src="<?=$urlOri;?>templates/ecclesia_1/images/header_top.png" />
			<?php } ?>

		</div>
	</div>

	<div class="row">
		<div class="col-lg-12" style="padding-left: 4px;padding-right: 5px;">	

			<nav class="navbar navbar-mintra navbar-static-top">
				      <div class="container">
				        <div class="navbar-header">
				          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				          </button>
				        </div>
				        <div id="navbar" class="navbar-collapse collapse">
				          <ul class="nav navbar-nav menuSuperior">
							<li><a href="<?=$urlOri;?>"><?php if($idparroquia == 587) echo "Inici"; else echo "Inicio"; ?></a></li>
		        <?php

		if($idparroquia == 322){ 
		
		/*
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Parroquias  </a>
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#"> Dropdown item 2 &raquo </a>
				 <ul class="submenu dropdown-menu">
					<li><a class="dropdown-item" href="">Submenu item 1</a></li>
					<li><a class="dropdown-item" href="">Submenu item 2</a></li>
					<li><a class="dropdown-item" href="">Submenu item 4</a></li>
					<li><a class="dropdown-item" href="">Submenu item 5</a></li>
				 </ul>
			  </li>
			</ul>
		</li>
		*/
		
				
					//echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";
					
					echo "<li class=\"nav-item dropdown\">
			<a class=\"nav-link dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\">  Parroquias <span class=\"caret\"></span></a>";

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-bartolome-de-carino' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-adrian-de-veiga' AND parroquia = $idparroquia",0);
					$txtint2 = $id2[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];
					
					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santa-maria-de-mera' AND parroquia = $idparroquia",0);
					$txtint4 = $id4[2];
					$titulo4 = $id4[1];
					$id4 = $id4[0];
					
					$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santiago-de-mera' AND parroquia = $idparroquia",0);
					$txtint5 = $id5[2];
					$titulo5 = $id5[1];
					$id5 = $id5[0];
					
					$id6 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'capilla-de-xiao-do-trebo' AND parroquia = $idparroquia",0);
					$txtint6 = $id6[2];
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li class=\"dropdown-item\"><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0){
						echo "<li><a class=\"dropdown-item\" href=\"#\"> ".$titulo1." &raquo </a>
								 <ul class=\"submenu dropdown-menu\" style=\"margin-left:5px;\">
									<li><a class=\"dropdown-item\" href=\"".$urlOri."/ubicacion-san-bartolome-de-carino/1440/\">Ubicación</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri.$txtint1."/".$id."/\">Historia</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri."categoria-parroquia-san-bartolome-de-carino/482/\">Noticias</a></li>
								 </ul>
							  </li>";
					}
					
					if($id2 > 0){
						
						echo "<li><a class=\"dropdown-item\" href=\"#\"> ".$titulo2." &raquo </a>
								 <ul class=\"submenu dropdown-menu\" style=\"margin-left:5px;\">
									<li><a class=\"dropdown-item\" href=\"".$urlOri."/ubicacion-san-adrian-de-veiga/1439/\">Ubicación</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri.$txtint2."/".$id2."/\">Historia</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri."categoria-san-adrian-de-veiga/481/\">Noticias</a></li>
								 </ul>
							  </li>";
					}
					
					if($id4 > 0){
						
						echo "<li><a class=\"dropdown-item\" href=\"#\"> ".$titulo4." &raquo </a>
								 <ul class=\"submenu dropdown-menu\" style=\"margin-left:5px;\">
									<li><a class=\"dropdown-item\" href=\"".$urlOri."/ubicacion-santa-maria-de-mera/1438/\">Ubicación</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri.$txtint4."/".$id4."/\">Historia</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri."categoria-parroquia-santa-maria-de-mera/480/\">Noticias</a></li>
								 </ul>
							  </li>";
						
					}
					
					if($id5 > 0){
						
						echo "<li><a class=\"dropdown-item\" href=\"#\"> ".$titulo5." &raquo </a>
								 <ul class=\"submenu dropdown-menu\" style=\"margin-left:5px;\">
									<li><a class=\"dropdown-item\" href=\"".$urlOri."/ubicacion-santiago-de-mera/1437/\">Ubicación</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri.$txtint5."/".$id5."/\">Historia</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri."categoria-santiago-de-mera/479/\">Noticias</a></li>
								 </ul>
							  </li>";
					}
					
					if($id6 > 0){
						
						echo "<li><a class=\"dropdown-item\" href=\"#\"> ".$titulo6." &raquo </a>
								 <ul class=\"submenu dropdown-menu\" style=\"margin-left:5px;\">
									<li><a class=\"dropdown-item\" href=\"".$urlOri."/ubicacion-capilla-de-xiao-do-trebo/1436/\">Ubicación</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri.$txtint6."/".$id6."/\">Historia</a></li>
									<li><a class=\"dropdown-item\" href=\"".$urlOri."categoria-capilla-de-xiao-do-trebo/478/\">Noticias</a></li>
								 </ul>
							  </li>";
						
					}
					echo "</ul></li>";
					
					$oracionTxt = "Oración y Liturgia";
					$liturgiaTxt = "Liturgia de las horas y Palabra de Dios hoy";
					$lecturamisaTxt = "Lectura de la misa en diferentes idiomas";
				
		?>
		
		
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$oracionTxt;?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa Online">Misa online</a></li>
						<?php } ?>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy"><?=$liturgiaTxt;?></a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas"><?=$lecturamisaTxt;?></a></li>
						</ul>
					</li>
		
		<?php
		
		}
		else if($idparroquia == 234){

					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-senes' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$guid1 = $id[2];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-velefique' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$guid2 = $id2[2];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-turrillas' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$guid3 = $id3[2];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-maria-del-rosario' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$guid4 = $id4[2];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-la-encarnacion' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$guid5 = $id5[2];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];



					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id5 > 0) echo "<li><a href=\"".$urlOri.$guid5."/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id > 0) echo "<li><a href=\"".$urlOri.$guid1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$guid2."/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri.$guid3."/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$guid4."/".$id4."/\">".$titulo4."</a></li>\n"; 
					echo "</ul></li>";

					if($idparroquia == 587){
						$oracionTxt = "Pregària i Litúrgia";
						$liturgiaTxt = "Litúrgia de les Hores";
						$lecturamisaTxt = "Lecturas y Evangelio del día ";
					}else{
						$oracionTxt = "Oración y Liturgia";
						$liturgiaTxt = "Liturgia de las horas y Palabra de Dios hoy";
						$lecturamisaTxt = "Lectura de la misa en diferentes idiomas";
					}

					?>


					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$oracionTxt;?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa Online">Misa online</a></li>
						<?php } ?>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy"><?=$liturgiaTxt;?></a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas"><?=$lecturamisaTxt;?></a></li>
						</ul>
					</li>

					<?php

		}else if($idparroquia == 126){


					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-julian' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-pedro' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santiago' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-eulalia-manzaneda' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];



					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-julian/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-pedro/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."parroquia-santiago/".$id4."/\">".$titulo4."</a></li>\n"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-eulalia-manzaneda/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id7 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id7."/\">".$titulo7."</a></li>\n"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id6."/\">".$titulo6."</a></li>\n"; 
					echo "</ul></li>";

		} else if($idparroquia == 156){


					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-gines-jara' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-somontin' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-urracal' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-roque-sufli' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-sebastian-sierro' AND parroquia = $idparroquia",0);
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					echo "<ul class=\"dropdown-menu\">";

					if($id3 > 0) echo "<li><a href=\"".$urlOri."historia/".$id3."/\">".$titulo3."</a></li>\n";
					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."san-gines-jara/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."santa-maria-somontin/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id4 > 0) echo "<li><a href=\"".$urlOri."santa-maria-urracal/".$id4."/\">".$titulo4."</a></li>\n";  
					if($id5 > 0) echo "<li><a href=\"".$urlOri."san-roque-sufli/".$id5."/\">".$titulo5."</a></li>\n";  
					if($id6 > 0) echo "<li><a href=\"".$urlOri."san-sebastian-sierro/".$id6."/\">".$titulo6."</a></li>\n";  
										echo "</ul></li>";

		}else if($idparroquia == 80){


					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-la-mayor' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-pedro-martir' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-de-las-nieves' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];


					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria-la-mayor/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-pedro-martir/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria-de-las-nieves/".$id3."/\">".$titulo3."</a></li>\n"; 
					echo "</ul></li>";


		}else if($idparroquia == 14)
		{
					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-de-portals' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-lorenzo-de-palma-nova' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'stella-maris-de-magalluf' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'beato-junipero-serra-de-son-ferrer' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'nuestra-senora-de-toro' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."santa-maria-de-portals/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."san-lorenzo-de-palma-nova/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."stella-maris-de-magalluf/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."beato-junipero-serra-de-son-ferrer/".$id4."/\">".$titulo4."</a></li>\n"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."nuestra-senora-de-toro/".$id5."/\">".$titulo5."</a></li>\n"; 
					echo "</ul></li>";

					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Destacamos <span class=\"caret\"></span></a>\n";
					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'dia-de-silencio' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'carida' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'celebraciones' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'iniciacion-vida-cristiana' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'fundamento-vida-cristiana' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'casal-del-toro' AND parroquia = $idparroquia",0);
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					$id7 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'centro-espiritualidad-solidaria' AND parroquia = $idparroquia",0);
					$titulo7 = $id7[1];
					$id7 = $id7[0];

					echo "<ul class=\"dropdown-menu\">";

					if($id > 0) echo "<li><a href=\"".$urlOri."dia-de-silencio/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."carida/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."celebraciones/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."iniciacion-vida-cristiana/".$id4."/\">".$titulo4."</a></li>\n"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."fundamento-vida-cristiana/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri."casal-del-toro/".$id6."/\">".$titulo6."</a></li>\n"; 
					if($id7 > 0) echo "<li><a href=\"".$urlOri."centro-espiritualidad-solidaria/".$id7."/\">".$titulo7."</a></li>\n"; 
					echo "</ul></li>";
		}
		else{

			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda' OR txt_int = 'cementerio-parroquial' OR txt_int = 'excursiones-salidas-parroquiales') AND parroquia = $idparroquia LIMIT 1",1);

			if($id > 0 && $idparroquia != 2300)
			{
					if($idparroquia == 587) $txtParroquia = "La parròquia"; else $txtParroquia = "La parroquia";
					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">".$txtParroquia." <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'donde-esta' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'saluda' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					if($idparroquia == 21)
					{
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'cementerio-parroquial' AND parroquia = $idparroquia",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];				

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'excursiones-salidas-parroquiales' AND parroquia = $idparroquia",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];										
					}
					else if($idparroquia == 24)
					{
						$id7 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sacramentos' AND parroquia = $idparroquia",0);
						$titulo7 = $id7[1];
						$id7 = $id7[0];		
					}
					else if($idparroquia == 139)
					{
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santiago-apostol' AND parroquia = $idparroquia",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];				

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-la-blanca' AND parroquia = $idparroquia",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];	
						
					}else if($idparroquia == 229){
						$id8 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-sant-jordi' AND parroquia = $idparroquia",0);
						$titulo8 = $id8[1];
						$id8 = $id8[0];

						$id9 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-francisco-de-paula' AND parroquia = $idparroquia",0);
						$titulo9 = $id9[1];
						$id9 = $id9[0];
					} 
					else if($idparroquia == 852){
						$id10 = getValue("SELECT id, titulo FROM paginas WHERE id = 1477 AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];
					}

					echo "<ul class=\"dropdown-menu\">";

					if($id > 0) echo "<li onclick=\"location.href='".$urlOri."historia/".$id."/'\"><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li onclick=\"location.href='".$urlOri."donde-esta/".$id2."/'\"><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li onclick=\"location.href='".$urlOri."horarios/".$id3."/'\"><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li onclick=\"location.href='".$urlOri."saluda/".$id4."/'\"><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n";

					if($id8 > 0) echo "<li onclick=\"location.href='".$urlOri."parroquia-sant-jordi/".$id8."/'\"><a href=\"".$urlOri."parroquia-sant-jordi/".$id8."/\">".$titulo8."</a></li>\n"; 
					if($id9 > 0) echo "<li onclick=\"location.href='".$urlOri."parroquia-san-francisco-de-paula/".$id9."/'\"><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id9."/\">".$titulo9."</a></li>\n"; 

					if(isset($id5) && $id5 > 0) echo "<li onclick=\"location.href='".$urlOri."cementerio-parroquial/".$id5."/'\"><a href=\"".$urlOri."cementerio-parroquial/".$id5."/\">".$titulo5."</a></li>\n";
					if(isset($id6) && $id6 > 0) echo "<li onclick=\"location.href='".$urlOri."excursiones-salidas-parroquiales/".$id6."/'\"><a href=\"".$urlOri."excursiones-salidas-parroquiales/".$id6."/\">".$titulo6."</a></li>\n";
					if(isset($id7) && $id7 > 0) echo "<li onclick=\"location.href='".$urlOri."sacramentos/".$id7."/'\"><a href=\"".$urlOri."sacramentos/".$id7."/\">".$titulo7."</a></li>\n";
					//if(isset($id10) && $id10 > 0) echo "<li onclick=\"location.href='".$urlOri."columbario-parroquial/".$id10."/'\"><a href=\"".$urlOri."columbario-parroquial/".$id10."/\">".$titulo10."</a></li>\n";

					if($idparroquia == 2220)
					{
						echo "<li onclick=\"location.href='".$urlOri."historia-parrocos-cartagena/3120/'\"><a href=\"".$urlOri."historia-parrocos-cartagena/3120/\">".getValue("SELECT titulo FROM paginas WHERE id = '3120'",1)."</a></li>\n";
					}

					if($idparroquia == 1724){
						echo "<li onclick=\"location.href='".$urlOri."nuestro-arzobispo-metropolitano/2664/'\"><a href=\"".$urlOri."nuestr-arzobispo-metropolitano/2664/\">".getValue("SELECT titulo FROM paginas WHERE id = 2664",1)."</a></li>\n"; 
						echo "<li onclick=\"location.href='".$urlOri."columbario-parroquial/2666/'\"><a href=\"".$urlOri."columbario-parroquial/2666/\">".getValue("SELECT titulo FROM paginas WHERE id = 2666",1)."</a></li>\n"; 
						echo "<li onclick=\"location.href='".$urlOri."redes-sociales/2665/'\"><a href=\"".$urlOri."redes-sociales/2665/\">".getValue("SELECT titulo FROM paginas WHERE id = 2665",1)."</a></li>\n"; 
					}

					if($idparroquia == 25) echo "<li onclick=\"location.href='".$urlOri."/categoria-actualidad/65/'\"><a href=\"".$urlOri."/categoria-actualidad/65/\">Reflexión semanal</a></li>\n";
					if($idparroquia == 21) echo "<li onclick=\"location.href='".$urlOri."oraciones.html'\"><a href=\"".$urlOri."oraciones.html\">Petición de oraciones</a></li>\n";

					if($idparroquia == 390) echo "<li onclick=\"location.href='".$urlOri."oraciones.html'\"><a href=\"".$urlOri."/la-voz-del-parroco/1527/\">La voz del Párroco</a></li>\n";
					if($idparroquia == 591)
					{
						echo "<li onclick=\"location.href='".$urlOri."/bautismo/1582/'\"><a href=\"".$urlOri."/bautismo/1582/\">Bautismo</a></li>\n
						<li onclick=\"location.href='".$urlOri."/confirmacion/1581/'\"><a href=\"".$urlOri."/confirmacion/1581/\">Confirmación</a></li>\n
						<li onclick=\"location.href='".$urlOri."/primera-comunion/1537/'\"><a href=\"".$urlOri."/primera-comunion/1537/\">Primera Comunión</a></li>\n";
					}

					//(OM) 12/06/2018 Pestañas para Parroquias la pobla de Vallbona
					if($idparroquia == 31) {
						
						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'ermita-sant-sebastia' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."ermita-sant-sebastia/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'ermita-mas-de-tous' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."ermita-mas-de-tous/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santiago-apostol' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."santiago-apostol/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santisima-trinidad-y-san-jose' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."santisima-trinidad-y-san-jose/".$id10."/\">".$titulo10."</a></li>\n"; 

					}



					echo "</ul></li>";
			}
			else{
				echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";
				
				echo "<ul class=\"dropdown-menu\">";

				$sql = "SELECT id, titulo, txt_int FROM paginas WHERE parroquia = 2300 AND id <= 3270 AND id >= 3259 ORDER BY orden DESC";
				$rs = mysql_query($sql,$conex);

				while($rw = mysql_fetch_assoc($rs)){
					echo "<li><a href=\"".$urlOri."".$rw['txt_int']."/".$rw['id']."/\">".$rw['titulo']."</a></li>\n"; 
				}

				echo "</ul></li>";
			}
			
			if($idparroquia == 587){
			
			?>
			
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informacions parroquials <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>categoria-noticies-varies/443/" title="Noticies varies">Noticies Varies</a></li>
							<li><a href="<?=$urlOri;?>categoria-decessos/442/" title="Decessos">Decessos</a></li>
						</ul>
					</li>
			
			<?php 
			
			}
			
			
					if($idparroquia == 587){
						$oracionTxt = "Pregària i Litúrgia";
						$liturgiaTxt = "Litúrgia de les Hores";
						$lecturamisaTxt = "Lecturas y Evangelio del día ";
					}else{
						$oracionTxt = "Oración y Liturgia";
						$liturgiaTxt = "Liturgia de las horas y Palabra de Dios hoy";
						$lecturamisaTxt = "Lectura de la misa en diferentes idiomas";
					}


			?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$oracionTxt;?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php if($showmisa){ ?>
							<li onclick="location.href='<?=$urlOri;?>misa-online.html'"><a href="<?=$urlOri;?>misa-online.html" title="Misa Online">Misa online</a></li>
						<?php } ?>
							<li onclick="location.href='<?=$urlOri;?>oraciones-y-liturgia/'"><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy"><?=$liturgiaTxt;?></a></li>
							<?php if($idparroquia != 587){ ?><li onclick="location.href='<?=$urlOri;?>misa-en-varios-idiomas/'"><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas"><?=$lecturamisaTxt;?></a></li><?php } ?>
							
							<?php if($idparroquia == 599){ ?>
							<li><a href="<?=$urlOri;?>pascua-2024/2038/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2038",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2038",1);?></a></li>
							<?php } ?>
							
							<?php if($idparroquia == 1667){ ?>
								<li><a href="<?=$urlOri;?>exposicion-santisimo/2207/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2207",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2207",1);?></a></li>
							<?php } ?>
						</ul>
					</li>
					
					
					
					<?php if($idparroquia == 544){ ?>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Comunidades Parroquiales <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="<?=$urlOri;?>santiago-tenango/1018/" title="Santiago Tenango">Santiago Tenango</a></li>
						<li><a href="<?=$urlOri;?>santa-catalina-villanueva/1019/" title="Santa Catalina Villanueva">Santa Catalina Villanueva</a></li>
						<li><a href="<?=$urlOri;?>divina-providencia/1027/" title="Divina Providencia">Divina Providencia</a></li>
						<li><a href="<?=$urlOri;?>guadalupe-analco/1024/" title="Guadalupe Analco">Guadalupe Analco</a></li>
						<li><a href="<?=$urlOri;?>san-juan/1026/" title="San Juan">San Juan</a></li>
						<li><a href="<?=$urlOri;?>la-compania/1020/" title="La Compañía">La Compañia</a></li>
						<li><a href="<?=$urlOri;?>progreso-de-madero/1022/" title="Progreso de Madero">Progreso de Madero</a></li>
						<li><a href="<?=$urlOri;?>colonia-madero/1023/" title="Colonia Madero">Colonia Madero</a></li>
						<li><a href="<?=$urlOri;?>san-jose-buenavista/1025/" title="San José Buenavista">San José Buenavista</a></li>
						<li><a href="<?=$urlOri;?>san-pedro-candelaria/1021/" title="San Pedro Candelaria">San Pedro Candelaria</a></li>
						</ul>
					</li>
						
					<?php } ?>

		<?php } ?>

		<?php if($idparroquia == 233) $txtGrupos = "Pastoral Castrense"; else if($idparroquia == 5) $txtGrupos = "Grupos"; else if($idparroquia == 1667) $txtGrupos = "Iniciación Cristiana"; else $txtGrupos = "Grupos Parroquiales"; ?>

		<?php if($idparroquia == 587){ ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Realitat Parroquial <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>categoria-capella-sant-antoni/432/" title="Capella Sant Antoni">Capella Sant Antoni</a></li>
							<li><a href="<?=$urlOri;?>categoria-centro-de-amigos/433/" title="Centro de amigos">Centro de amigos</a></li>
							<li><a href="<?=$urlOri;?>categoria-comunitats-neocatecumenals/434/" title="Comunitats Neocatecumenals">Comunitats Neocatecumenals</a></li>
							<li><a href="<?=$urlOri;?>categoria-visitador-de-malalts/435/" title="Visitador de malalts">Visitador de malalts</a></li>
							<li><a href="<?=$urlOri;?>categoria-filles-de-maria-auxiliadora/431/" title="Filles de María Auxiliadora">Filles de María Auxiliadora</a></li>
							<li><a href="<?=$urlOri;?>categoria-germantes-franciscanes/430/" title="Germantes Franciscanes">Germantes Franciscanes</a></li>
							<li><a href="<?=$urlOri;?>categoria-caritas/436/" title="Cáritas">Cáritas</a></li>
						</ul>
					</li>
		<?php }else if($idparroquia == 1667){ ?>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$txtGrupos;?> <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>iniciacion-cristiana-ninos/2208/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2208",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2208",1);?></a></li>
							<li><a href="<?=$urlOri;?>iniciacion-cristiana-adultos/2209/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2209",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2209",1);?></a></li>
						</ul>
					</li>
		<?php }else{ ?>
		
					<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="<?=$txtGrupos;?>"><?=$txtGrupos;?></a></li>
		<?php } ?>


		<?php if($idparroquia == 14){ ?>

					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Textos Litúrgicos <span class="caret"></span></a>
					
						<ul class="dropdown-menu">						
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa Online">Misa online</a></li>
						<?php } ?>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Ordo Missae en idiomas">Ordo missae en idiomas</a></li>
						</ul>
					</li>

		<?php } ?>
					<?php if($idparroquia == 1667){ ?>
						<li><a href="<?=$urlOri;?>hoja-parroquial/2210/" title="Hoja Parroquial">Hoja Parroquial</a></li>	
					<?php }else{ ?>
							<li><a href="<?=$urlOri;?>eventos.html" title="Agenda"><?php if($idparroquia == 1667) echo "Hoja Parroquial"; else echo "Agenda"; ?></a></li>
					<?php } ?>

					<?php if($idparroquia == 1869){ ?>
						<li><a href="<?=$urlOri;?>cultura-cuidado/2982/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2982",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2982",1);?></a></li>	
					<?php } ?>
					
					<?php if($idparroquia == 587){ ?>
					
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pastoral de Sagraments <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>protocol-per-baptismes/1107/" title="Baptismes">Protocol per Baptismes</a></li>
							<li><a href="<?=$urlOri;?>protocol-per-casaments/1106/" title="Casaments">Protocol per Casaments</a></li>
							<li><a href="<?=$urlOri;?>slicitud-d-inscripcio-a-catequesi/1114/" title="Sol·licitud d'Inscripció a Catequesi">Sol·licitud d'Inscripció a Catequesi</a></li>
							<li><a href="<?=$urlOri;?>categoria-baptismes/449/" title="Baptismes">Baptismes</a></li>
							<li><a href="<?=$urlOri;?>categoria-comunions/438/" title="Comunió">Comunió</a></li>
							<li><a href="<?=$urlOri;?>categoria-post-comunio/439/" title="Post Comunió">Post Comunió</a></li>
							<li><a href="<?=$urlOri;?>categoria-confirmacio/440/" title="Confirmació">Confirmació</a></li>
							<li><a href="<?=$urlOri;?>categoria-matrimonis/441/" title="Matrimoni">Matrimoni</a></li>
						</ul>
					</li>
					
					<?php } ?>
					
			<?php if($idparroquia == 68){
				$valores = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 337",0);
				$tituloGuid = $valores[1];
				
				$guidPag = $valores[2];
				$idPag = $valores[0];

				echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>\n";
			}else{
				if($idparroquia == 587) $documentosTxt = "Documents";
				else $documentosTxt = "Documentos";
				
				if($idparroquia == 587){

					echo "<li><a href=\"".$urlOri."categoria-creacio-del-nou-temple/657/\">Nou temple</a></li>\n";
					
					/*
					$sql = "SELECT id, nombre, categoria, descripcion, documento, url FROM documentos WHERE (parroquia = 0 OR parroquia = $idparroquia) AND id != 8 AND id != 7 ORDER BY categoria ASC, fecha DESC";
					$rs = mysql_query($sql,$conex);
					
					$documentos = "";
					
					while($fila = mysql_fetch_assoc($rs)){
						
						if($fila['url'] != "") $urlDoc = $fila['url']; else $urlDoc = $urlRecursos."descarga.php?file=".$fila['documento'];
						
						$documentos .= "<li><a href=\"".$urlDoc."\" title=\"".$fila['nombre']."\">".$fila['nombre']."</a></li>";
					}
					
					
			?>
			
				
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Documents <span class="caret"></span></a>
					<ul class="dropdown-menu">
						</ul>
					</li>
			<?php*/

					
			
				}else{
					echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">".$documentosTxt."</a></li>";	
				}
			} ?>
			<?php

					$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

					if($idparroquia == 587) $donativosTxt = "Donatius";
					else $donativosTxt = "Donativos";

					if($idparroquia == 30 || $idparroquia == 852) echo "<li><a href=\"http://www.donoamiiglesia.es/\" target=\"_blank\">Donativos</a></li>\n";
					else if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
					else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">".$donativosTxt."</a></li>\n";

					if($idparroquia == 5){
						$valores = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 775",0);
						$tituloGuid = $valores[1];
						
						$guidPag = $valores[2];
						$idPag = $valores[0];

						echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>\n";			
					}

			?>

					<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia"><?php if($idparroquia == 587) echo "Contacte"; else echo "Contacto"; ?></a></li>
					
					<?php
					
					if($idparroquia == 852){
					
						$id10 = getValue("SELECT id, titulo FROM paginas WHERE id = 1477 AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];
						
						if(isset($id10) && $id10 > 0) echo "<li onclick=\"location.href='".$urlOri."columbario-parroquial/".$id10."/'\"><a href=\"".$urlOri."columbario-parroquial/".$id10."/\">".$titulo10."</a></li>\n";
					}
						
					?>
							
				</ul>
			       </div>
		      </div>
		    </nav>

   </div>
</div>


<?php if($whatsappTel != ""){ ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<a href="https://wa.me/<?=$whatsappTel;?>?text=Hola!%20Me%20pongo%20en%20contacto%20con%20usted%20a%20travÃ©s%20del%20formulario%20de%20contacto%20de%20Whastapp%20de%20su%20pÃ¡gina%20web%20porque..." class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
<?php } ?>

<div class="row">
	<div class="col-lg-12" id="todo">

<?php 
if(!isset($_GET['sec']))
{
	include('featured.php');
} ?>

