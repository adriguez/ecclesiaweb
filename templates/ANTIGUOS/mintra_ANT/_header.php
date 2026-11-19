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
<meta name="description" content="Bienvenidos a la página web de <?=$valores[0];?>" />



<style type="text/css" media="screen">
@import url(css/ec3.css);
.ec3_ec {
 background-image:url(images/ec.png) !IMPORTANT;
 background-image:none;
 filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$urlOri;?>templates/mintra/images/ec.png');
}
#ec3_shadow0 {
 background-image:url(images/shadow0.png) !IMPORTANT;
 background-image:none;
}
#ec3_shadow0 div {
 filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$urlOri;?>templates/mintra/images/shadow0.png',sizingMethod='scale');
}
#ec3_shadow1 {
 background-image:url(images/shadow1.png) !IMPORTANT;
 background-image:none;
 filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$urlOri;?>templates/mintra/images/shadow1.png',sizingMethod='crop');
}
#ec3_shadow2 {
 background-image:url(images/shadow2.png) !IMPORTANT;
 background-image:none;
}
#ec3_shadow2 div {
 filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$urlOri;?>templates/mintra/images/shadow2.png',sizingMethod='scale');
}
</style>
  <style type="text/css">
  	
	nav.oldernewer a, .box-alt, .box, .box .indent, #content, #content .indent, .read-more a, .wpcf7-form input[type=submit] {
			behavior:url(<?=$urlOri;?>templates/mintra/PIE.php)
			}
		
  </style>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/base.css" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/preview.js"></script>
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


	<!-- The HTML5 Shim is required for older browsers, mainly older versions IE -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>templates/mintra/css/style.css">

	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/superfish.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/jquery.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/jquery_002.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/cufon-yui.js"></script>
	<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/Trebuchet_MS_700.js"></script>


  <script type="text/javascript">
  	// initialise plugins
		jQuery(function(){
			// main navigation init
			jQuery('ul.sf-menu').superfish({
				animation:   {opacity:'show', height:'show'},
				autoArrows:    false,
    		dropShadows:   false
			});
			
		});
		

  </script>
  <script type="text/javascript">
		Cufon.replace('.logo h1 a, .logo h2 a', { fontFamily: 'Trebuchet MS', textShadow:"0 2px rgba(0, 0, 0, .5)", color: '-linear-gradient(#fdfbf7 #fdfbf7 #fdfbf7, #F5CD96 #F5CD96 #F5CD96)' });
  </script>

<base href="<?=$urlOri;?>" />

</head>
<body class="home blog cat-12-id" <?=$onload;?>>

	<div id="main"><!-- this encompasses the entire Web site -->
		<header>
			<div class="container">
    				<nav class="primary">
        				<ul id="topnav" class="sf-menu sf-js-enabled">
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

			echo "<ul>";
			if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";
			if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
			if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
			if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n"; 
			echo "</ul></li>";
	}

	?>
			<li><a href="#" title="Oración y Liturgia">Oración y Liturgia</a>
			
				<ul style="width:300px;">
					<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
				</ul>
			</li>
			<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales">Grupos Parroquiales</a>
	<?php /*	<ul class="submenu">

	<?php
		
		$sql = "SELECT DISTINCT(categoria) AS 'categoria' FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria > 0 ORDER BY nombre ASC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{

			while($fila = mysql_fetch_assoc($rs))
			{

			echo "<li class=\"menu-item menu-item-type-custom\" style=\"width:200px;\"><a href=\"javascript:void(0);\">".getValue("SELECT grupo FROM grupos_categorias WHERE id = ".$fila['categoria'],1)." &raquo;</a>
					<ul class=\"submenu\">";

				$css = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria = ".$fila['categoria']." ORDER BY nombre ASC";
				$rss = mysql_query($css,$conex);

				while($rw = mysql_fetch_assoc($rss))
				{
					echo "<li style=\"width:200px;margin-left:90px;\" class=\"menu-item menu-item-type-custom\"><a href=\"".$urlOri."grupos/".limpiarCadena($rw['nombre'],'archivo')."_".$rw['id'].".html\">".$rw['nombre']."</a></li>\n";
				}

			echo "</ul>\n";

			echo "</li>\n";

			}

		}
		
	?>

	<?php
		$sql = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria = 0 ORDER BY nombre ASC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{
			while($fila = mysql_fetch_assoc($rs))
			{
				echo "<li style=\"width:200px;\"><a href=\"".$urlOri."grupos/".limpiarCadena($fila['nombre'],'archivo')."_".$fila['id'].".html\">".$fila['nombre']."</a></li>\n";
			}
		}
	?>
		</ul> */ ?>
		</li>
			<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			<li><a href="<?=$urlOri;?>documentos/" title="Documentos">Documentos</a></li>
	<?php

			$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

			if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>\n";

	?>
			<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
					</ul>

					<?php /*<div id="search-3" class="widget-header">

						<form method="get" id="searchform" action="<?=$urlOri;?>">
							<input class="searching" name="s" id="s" type="text"><input class="submit" value="Buscar" type="submit">
						</form>

					</div> */ ?>

				</nav><!--.primary-->
			
				<div class="logo">
      	         			 <h1 style="float:left;<?php if($idparroquia == 1) echo "width:470px;line-height:38px;text-align:center;margin-top:20px;letter-spacing:12px;font-size:30px;margin-left:280px;"; ?>"><a href="<?=$urlOri;?>" title="<?=$valores[2];?> - <?=$valores[5];?>"><?=$valores[2];?></a></h1>
					<?php if($idparroquia == 1){ ?>
						<img style="float:right;margin-right:75px;" src="http://www.nuestraseñorademontserrat.es/templates/nuevo2/images/moreneta_logo.png" />
					<?php } ?>
              		</div>
			
			</div><!--.container-->
		</header>

<div id="todo">