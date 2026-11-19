<?php

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$onload = "";
	$mapa = false;

	// *********************************
	// *** MAPA DE GOOGLE PARA CONTACTO
	// *********************************

	if(isset($_GET['sec']) && $_GET['sec'] == "estaticas" && isset($_GET['m']) && $_GET['m'] > 0)
	{
		$txtint = getValue("SELECT txt_int FROM paginas WHERE id = ".intval($_GET['m']),1);

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
<meta name="metadescription" content="<?=$valores[1];?>" />
<link href="<?=$urlOri;?>templates/external/default.css" rel="stylesheet" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/base.css" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/preview.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/wt-rotator.css" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>
<script type="text/javascript" language="javascript">

		$().ready(function() {

			//tpsy
				if($('.lnktit').length > 0){
					$('.lnktit').tipsy({gravity:'sw'});
				}

		});

	</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=es"></script>

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?>>

<!-- start header -->
<div id="wrapper">
<div id="header">
	<div id="logo">
		<h1 style="font-size:38px;"><a href="<?=$urlOri;?>"><?=$valores[2];?></a>
			<br />
			<span>
				<?=$valores[5];?> - <?=$valores[6];?>
			</span>
		</h1>
	</div>

	<div id="sublogo">

		<img src="<?=$urlOri;?>uploads/<?=$idparroquia;?>/moreneta-sombra2.png" />

	</div>

</div>
<!-- end header -->

<!-- star menu -->
<div id="menu">
	<ul>
			<li class="current_page_item"><a href="<?=$urlOri;?>">Inicio</a></li>
        <?php

	$id = getValue("SELECT id FROM paginas WHERE txt_int = 'la-parroquia'",1);

	if($id > 0)
	{
			echo "<li><a href=\"".$urlOri."la-parroquia/".$id."/\">La parroquia</a></li>";
	}

	?>
			<li><a href="<?=$urlOri;?>santos/" title="Santoral">Santoral</a></li>
			<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
	</ul>
</div>
<!-- end menu -->

	<!-- start page -->
	<div id="page">