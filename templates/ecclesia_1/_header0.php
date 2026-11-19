<?php

	$seo = getDatosSeo($_GET['sec']);

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <link href="<?=$urlOri;?>css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=$urlOri;?>js/bootstrap.min.js"></script>  

    <link rel="stylesheet" href="<?=$urlOri;?>css/font-awesome.min.css">

	<?php if($idparroquia == 24)
	{ ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto|Cinzel+Decorative|Marmelad' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/style_resp_24.css" media="screen" />
	<?php }else{ ?>		
		<link href='https://fonts.googleapis.com/css?family=Roboto|Cinzel+Decorative' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia_1/css/style_resp.css" media="screen" />
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

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDnrLkAyZNt03zQiObnaKb5jJi9ry6s3vo&sensor=false&language=es"></script>

<?php $foot = $valores[2]; ?>

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">

<div class="container">

    <div class="row">
    	<div id="subheader" class="col-md-12 <?php if($idparroquia == 14) echo "unitatcosta"; else echo "nostyle"; ?>">


    			<?php if($idparroquia == 73){ ?>
    				<img src="<?=$urlOri;?>templates/ecclesia_1/images/anagrama_73.png" class="cruz anagrama73" />
    			<?php }else{ ?>
    				<img src="<?=$urlOri;?>templates/ecclesia_1/images/anagrama.png" class="cruz" />
    			<?php } ?>
    			<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?></a>
    			<div class="subtitulo"><?=$valores[5];?></div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" class="header" src="<?=$urlOri;?>templates/ecclesia_1/images/header_top.png" />

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
							<li><a href="<?=$urlOri;?>">Inicio</a></li>
		        <?php

		if($idparroquia == 234){

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

					?>


					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
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

			if($id > 0)
			{
					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">La parroquia <span class=\"caret\"></span></a>\n";

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

					echo "<ul class=\"dropdown-menu\">";

					if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n";

					if($id8 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id8."/\">".$titulo8."</a></li>\n"; 
					if($id9 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id9."/\">".$titulo9."</a></li>\n"; 

					if(isset($id5) && $id5 > 0) echo "<li><a href=\"".$urlOri."cementerio-parroquial/".$id5."/\">".$titulo5."</a></li>\n";
					if(isset($id6) && $id6 > 0) echo "<li><a href=\"".$urlOri."excursiones-salidas-parroquiales/".$id6."/\">".$titulo6."</a></li>\n";
					if(isset($id7) && $id7 > 0) echo "<li><a href=\"".$urlOri."sacramentos/".$id7."/\">".$titulo7."</a></li>\n";

					if($idparroquia == 25) echo "<li><a href=\"".$urlOri."/categoria-actualidad/65/\">Reflexión semanal</a></li>\n";
					if($idparroquia == 21) echo "<li><a href=\"".$urlOri."oraciones.html\">Petición de oraciones</a></li>\n";

					echo "</ul></li>";
			}


			?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
						</ul>
					</li>

		<?php } ?>

		<?php if($idparroquia == 233) $txtGrupos = "Pastoral Castrense"; else $txtGrupos = "Grupos Parroquiales"; ?>

					<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="<?=$txtGrupos;?>"><?=$txtGrupos;?></a></li>

		<?php if($idparroquia == 14){ ?>

					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Textos Litúrgicos <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Ordo Missae en idiomas">Ordo missae en idiomas</a></li>
						</ul>
					</li>

		<?php } ?>
					<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			<?php if($idparroquia == 68){
				$valores = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 337",0);
				$tituloGuid = $valores[1];
				
				$guidPag = $valores[2];
				$idPag = $valores[0];

				echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>\n";
			}else{
				echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";	
			} ?>
			<?php

					$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

					if($idparroquia == 30) echo "<li><a href=\"http://www.donoamiiglesia.es/\" target=\"_blank\">Donativos</a></li>\n";
					else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>\n";

			?>
					<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
							
				</ul>
			       </div>
		      </div>
		    </nav>

   </div>
</div>

<div class="row">
	<div class="col-lg-12" id="todo">

<?php 
if(!isset($_GET['sec']))
{
	include('featured.php');
} ?>

