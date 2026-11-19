<?php

	$seo = getDatosSeo($_GET['sec']);

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$nombreParroquia = $valores[2];

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

	<?php if($idparroquia == 9){ ?>

	<meta name="google-translate-customization" content="b30e296fc927b86c-a1c826f2ddf43a05-gefb6036019326bbd-1f" />

	<?php } ?>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" href="<?=$urlOri;?>css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <link href="<?=$urlOri;?>css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=$urlOri;?>js/bootstrap.min.js"></script>    

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/style_resp.css" media="screen" />
		
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tinos">

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/superfish.css" />
	<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.fancybox.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>	

	<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo1/js/superfish.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo1/js/preview.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/wt-rotator.css" />

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
	<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>

	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	<script type="text/javascript" language="javascript">

		$().ready(function() {

			//tpsy
				if($('.lnktit').length > 0)
				{
					$('.lnktit').tipsy({gravity:'sw'});
				}

			$('#fade').cycle();

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

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>" style="margin:0;padding:0;">


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

	$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda') AND parroquia = $idparroquia LIMIT 1",1);

	if($id > 0)
	{

		if($idparroquia == 21)
		{

					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'purisima-concepcion-de-la-vileta' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'son-roca' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."santa-maria-de-portals/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."san-lorenzo-de-palma-nova/".$id2."/\">".$titulo2."</a></li>\n";  
					echo "</ul></li>";
		}
		else{

			echo "<li class=\"dropdown\">
					<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"#\">La parroquia <span class=\"caret\"></span></a>\n";

			$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo1 = $id[1];
			$id = $id[0];

			$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'donde-esta' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo2 = $id2[1];
			$id2 = $id2[0];

			$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo3 = $id3[1];
			$id3 = $id3[0];

			$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'saluda' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo4 = $id4[1];
			$id4 = $id4[0];

			$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'capilla-de-adoracion' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo5 = $id5[1];
			$id5 = $id5[0];

			$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sistema-de-celulas-de-evangelizacion-parroquial' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo6 = $id6[1];
			$id6 = $id6[0];

			$id7 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horario-de-actividades-parroquiales-ordinarias' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo7 = $id7[1];
			$id7 = $id7[0];

			$id8 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo8 = $id8[1];
			$id8 = $id8[0];

			$id9 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'columbario' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo9 = $id9[1];
			$id9 = $id9[0];

			if($idparroquia == 9)
			{
				echo "<ul class=\"dropdown-menu\">";
				if($id2 > 0) echo "<li><a href=\"".$urlOri."on-estem/".$id2."/\">ON ESTEM</a></li>\n";  
				if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">SALUDA</a></li>\n"; 
				if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
				echo "<li><a href=\"".$urlOri."grupos-parroquiales.html\" title=\"Grups Parroquials\">GRUPS PARROQUIALS</a></li>\n";
				echo "<li><a href=\"".$urlOri."economia/55/\">ECONOMÍA</a></li>\n";
				echo "<li><a href=\"".$urlOri."historia/39/\">HISTÒRIA</a></li>\n";

				echo "</ul>";
			}
			else{

				echo "<ul class=\"dropdown-menu\">";
				if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";  
				if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
				if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
				if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n"; 
				if($id5 > 0) echo "<li><a href=\"".$urlOri."capilla-de-adoracion/".$id5."/\">".$titulo5."</a></li>\n"; 
				if($id6 > 0) echo "<li><a href=\"".$urlOri."sistema-de-celulas-de-evangelizacion-parroquial/".$id6."/\">".$titulo6."</a></li>\n"; 
				if($idparroquia == 19){
					echo "<li><a href=\"http://www.salmerondrons360.com/parroquiavirgendelloretopuertodexabia2016ok/\" target=\"_blank\">Visita virtual</a></li>";
				}
				if($idparroquia == 216){
					if($id8 > 0) echo "<li><a href=\"".$urlOri."revista-parroquial/".$id8."/\">".$titulo8."</a></li>\n"; 
				}
				if($id7 > 0) echo "<li><a href=\"".$urlOri."horario-de-actividades-parroquiales-ordinarias/".$id7."/\">".$titulo7."</a></li>\n"; 
				
				if($id9 > 0 && $idparroquia == 19) echo "<li><a href=\"".$urlOri."columbario/".$id9."/\">".$titulo9."</a></li>\n"; 
				
				echo "</ul>";

			}

			echo "</li>\n";

		}
	}

	?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
			
				<ul class="dropdown-menu">
					<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
				</ul>

			</li>
			<?php if($idparroquia != 9){ ?>
				<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales">Grupos Parroquiales</a></li>
			<?php }else{
				/*
				echo "<li class=\"dropdown\">
					<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"".$urlOri."#\" title=\"Patrimoni\">Patrimoni <span class=\"caret\"></span></a>\n";
				echo "<ul class=\"dropdown-menu\">
						<li><a href=\"".$urlOri."categoria-biografias/18/\">BIOGRAFÍES</a></li>
						<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>
					</ul>
				</li>\n";*/

				echo "<li><a href=\"".$urlOri."caritas/158/\" title=\"Cáritas\">Cáritas</a></li>";

			 } ?>

			<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			<li><a href="<?=$urlOri;?>documentos/" title="Documentos">Documentos</a></li>
	<?php

			$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

			if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>\n";

	?>
			<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>

	
<div class="container">
    <div class="row">			
		<div id="subheader" class="col-md-12" style="margin:0;padding:0;">
			
			<a href="<?=$urlOri;?>"><?=$valores[2];?></a>
			<div class="subtitle"><i><?=$valores[5];?></i></div>
			<img src="<?=$urlOri;?>templates/nuevo1/images/<?php if($idparroquia == 9) echo "header_top_quart_2.png"; else echo "header_top.png"; ?>" />
				
		</div>
	</div>

<div class="row">
	<div class="col-lg-12" id="todo">

<?php 
if(!isset($_GET['sec']))
{
	include('featured.php');
} ?>