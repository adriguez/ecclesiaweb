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

<link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>templates/ecclesia/css/template.css">

<link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>css/base.css">

<!-- Load CSS fixes for IE7 -->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>templates/ecclesia/css/ie7.css" />
<![endif]-->

<?php if($color > 0)
	{

		switch($color)
		{
			case 6; $css = "red-teal.css"; break;
			case 7; $css = "gold.css"; break;
			case 8; $css = "green.css"; break;
			case 9; $css = "purple.css"; break;
			default: $css = ""; break;
		}

	}
	else $css = "";

?>    

<?php if($css != ""){ ?><link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>templates/ecclesia/css/<?=$css;?>"> <?php } ?>

<!-- Load font from Google Fonts API -->
<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/ecclesia/css/css.css">

<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia/js/comment-reply.js"></script>

<script type="text/javascript">
    if (top != self) {
        top.location = location;
    }
    </script>

<style type="text/css">
    /* Frontpage "join us" widget */
#mw-widget-custom-content-4 .widget-boxed { height: 160px; text-align:center; }
#mw-widget-custom-content-4 h2 { border-color: #bfbcac; }
#mw-widget-custom-content-4 p { font-style:normal; text-shadow: 0 1px 0 #f6f6f6; line-height: 24px; padding-top:5px; }


#mw-widget-custom-content-5 .widget-boxed { height: 35px; }

/* Frontpage features widget */
#mw-widget-wp-page-3 ul { margin-bottom: 22px; }</style>


<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/mintra/css/wt-rotator.css" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>
<script type="text/javascript" language="javascript">

		$().ready(function() {

			//tpsy
				if($('.lnktit').length > 0){
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

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=es"></script>

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?>>

<div class="page-wrap" id="page-wrap">

<div class="content-wrap" id="content-wrap">
<div class="content-wrap-inner bgg" id="content-wrap-inner">

    <!-- Header -->

    <div class="grid-wrap" id="header">

        <div class="grid-6 inner">

		<img src="<?=$urlOri;?>templates/ecclesia/images/paloma_top.png" style="float:left;margin-right:10px;" />

		<h1 style="border:none;"><a href="<?=$urlOri;?>" class="logoo" title="<?=$valores[1];?>"><?=$valores[0];?></a></h1>        

		<div id="main-nav" class="main-nav">
		<ul id="menu-main-navigation" class="main-nav-list root">
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home"><a href="<?=$urlOri;?>">Inicio</a></li>

        <?php

	$id = getValue("SELECT id FROM paginas WHERE txt_int = 'historia' OR txt_int = 'donde-esta' LIMIT 1",1);

	if($id > 0)
	{
			echo "<li class=\"main-nav-list-item menu-item menu-item-type-post_type menu-item-object-page\"><a href=\"javascript:void(0);\">La parroquia</a>\n";
			$id = getValue("SELECT id FROM paginas WHERE txt_int = 'historia'",1);
			$id2 = getValue("SELECT id FROM paginas WHERE txt_int = 'donde-esta'",1);

			echo "<ul class=\"main-nav-list subnav-list level-1\">";
			if($id > 0) echo "<li class=\"main-nav-list-item menu-item menu-item-type-post_type menu-item-object-page\"><a href=\"".$urlOri."historia/".$id."/\">Historia</a></li>\n";
			if($id2 > 0) echo "<li class=\"main-nav-list-item menu-item menu-item-type-post_type menu-item-object-page\"><a href=\"".$urlOri."donde-esta/".$id2."/\">Dónde está</a></li>\n";  
			echo "</li></ul>";
	}

	?>
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Oración y Liturgia">Oración y Liturgia</a></li>
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Agenda">Grupos Parroquiales</a>
	<?php
		$sql = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia ORDER BY nombre ASC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{
			echo "<ul class=\"main-nav-list subnav-list level-1\">\n";

			while($fila = mysql_fetch_assoc($rs))
			{
				echo "<li class=\"main-nav-list-item menu-item menu-item-type-post_type menu-item-object-page\"><a href=\"".$urlOri."grupos/".limpiarCadena($fila['nombre'],'archivo')."_".$fila['id'].".html\">".$fila['nombre']."</a></li>\n";
			}

			echo "</ul>\n";
		}
	?>
			</li>
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=$urlOri;?>documentos/" title="Documentos">Documentos</a></li>
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			<li class="main-nav-list-item menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
					
		</ul>

		</div>        

	</div>

</div>
    <!-- End of header -->

    <b class="grid-divider"></b>