<?php

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$onload = "";
	$mapa = false;

	// *********************************
	// *** MAPA DE GOOGLE PARA CONTACTO
	// *********************************

	if(isset($_GET['sec']) && $_GET['sec'] == "estaticas" && isset($_GET['m']) && $_GET['m'] > 0)
	{
		$txtint = getValue("SELECT txt_int FROM paginas WHERE parroquia = $idparroquia AND id = ".intval($_GET['m']),1);

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
	}

	// *********************************
	// *********************************
	// *********************************

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?=$valores[0];?></title>
<meta name="description" content="<?=$valores[1];?>" />

<?php if($idparroquia == 9){ ?>

<meta name="google-translate-customization" content="b30e296fc927b86c-a1c826f2ddf43a05-gefb6036019326bbd-1f" />

<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/base.css.php" media="screen" />
		
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tinos">

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/superfish.css" />
<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo1/js/superfish.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo1/js/preview.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/wt-rotator.css" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>
<script type="text/javascript" language="javascript">

		$().ready(function() {

			//tpsy
				if($('.lnktit').length > 0){
					$('.lnktit').tipsy({gravity:'sw'});
				}

       		$("ul.sf-menu").superfish(); 

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

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=es"></script>

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">



	<div id="todo">
	
		<div id="header">
		
			<div id="top-menu">
			
	<ul id="superfish" class="sf-menu">
			<li class="current_page_item"><a href="<?=$urlOri;?>">Inicio</a></li>
        <?php

	$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda') AND parroquia = $idparroquia LIMIT 1",1);

	if($id > 0)
	{
			echo "<li><a href=\"javascript:void(0);\">La parroquia</a>\n";
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

			if($idparroquia == 9)
			{
				echo "<ul>";
				if($id2 > 0) echo "<li><a href=\"".$urlOri."on-estem/".$id2."/\">ON ESTEM</a></li>\n";  
				if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">SALUDA</a></li>\n"; 
				if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
				echo "<li><a href=\"".$urlOri."grupos-parroquiales.html\" title=\"Grups Parroquials\">GRUPS PARROQUIALS</a></li>\n";
				echo "<li><a href=\"".$urlOri."economia/55/\">ECONOMÍA</a></li>\n";

				echo "</ul></li>";
			}
			else{

				echo "<ul>";
				if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
				if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
				if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n"; 
				echo "</ul></li>";
			}
	}

	?>
			<li><a href="#" title="Oración y Liturgia">Oración y Liturgia</a>
			
				<ul style="width:300px;">
					<li style="width:300px;"><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li style="width:300px;"><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
				</ul>
			</li>
			<?php if($idparroquia != 9){ ?>
				<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales">Grupos Parroquiales</a></li>
			<?php }else{
				echo "<li><a href=\"".$urlOri."#\" title=\"Patrimoni\">Patrimoni</a>\n";
					echo "<ul><li><a href=\"".$urlOri."categoria-biografias/18/\">BIOGRAFÍES</a></li>\n";
				echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li></ul>\n";
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
			
			<div id="subheader">
			
				<div style="clear:both;"></div>
				<a href="<?=$urlOri;?>"><?=$valores[2];?></a>
				<div class="subtitle"><i><?=$valores[5];?></i></div>
				
			</div>
		
		</div>
		<!-- # header -->

<?php 
if(!isset($_GET['sec']))
{
	include('featured.php');
} ?>

		<div id="contenido">