<?php

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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?=$valores[0];?></title>
<meta name="description" content="<?=$valores[1];?>" />

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/base.css" media="screen" />
		
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ledger">

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/css/superfish.css" />
<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo2/js/superfish.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo2/js/preview.js.php?id=<?=$idparroquia;?>"></script>
<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/css/wt-rotator.css" />

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

<?php $foot = $valores[2]; ?>

<base href="<?=$urlOri;?>" />

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">



	<div id="todo">
	
		<div id="header">
			
			<div id="subheader" <?php if($idparroquia == 14) echo "class=\"unitatcosta\""; ?>>


			<div id="anagrama">
				<?php if($idparroquia == 1){ ?>
					<img src="<?=$urlOri;?>templates/nuevo2/images/moreneta_logo.png" alt="<?=$valores[2];?>" />
				<?php }elseif($idparroquia == 2){ ?>
					<img src="<?=$urlOri;?>templates/nuevo2/images/elbuenpastor.png" alt="<?=$valores[2];?>" />
				<?php } ?>
			</div>

			<?php if($idparroquia == 14){ ?>
				<a href="<?=$urlOri;?>" class="escon"><?=$valores[0];?></a>
				<div class="subtitle"><i><?=$valores[2];?></i></div>
			<?php }else{ ?>
				<a href="<?=$urlOri;?>"><?=$valores[2];?></a>
				<div class="subtitle"><i><?=$valores[5];?></i></div>
			<?php } ?>
				
			</div>
		
		</div>
		<!-- # header -->

		<div id="contenido">

		<div style="clear:both;"></div>


			<div id="top-menu">
			
	<ul id="superfish" class="sf-menu">
			<li class="current_page_item"><a href="<?=$urlOri;?>">Inicio</a></li>
        <?php

if($idparroquia == 14)
{
			echo "<li><a href=\"javascript:void(0);\">Parroquias</a>\n";
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


			echo "<ul>";

			if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
			if($id > 0) echo "<li><a href=\"".$urlOri."santa-maria-de-portals/".$id."/\">".$titulo1."</a></li>\n";
			if($id2 > 0) echo "<li><a href=\"".$urlOri."san-lorenzo-de-palma-nova/".$id2."/\">".$titulo2."</a></li>\n";  
			if($id3 > 0) echo "<li><a href=\"".$urlOri."stella-maris-de-magalluf/".$id3."/\">".$titulo3."</a></li>\n"; 
			if($id4 > 0) echo "<li><a href=\"".$urlOri."beato-junipero-serra-de-son-ferrer/".$id4."/\">".$titulo4."</a></li>\n"; 
			if($id5 > 0) echo "<li><a href=\"".$urlOri."nuestra-senora-de-toro/".$id5."/\">".$titulo5."</a></li>\n"; 
			echo "</ul></li>";

			echo "<li><a href=\"javascript:void(0);\">Destacamos</a>\n";
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

			echo "<ul>";

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
					<li style="width:300px;"><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li style="width:300px;"><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
				</ul>
			</li>
<?php } ?>
			<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales">Grupos Parroquiales</a>

<?php if($idparroquia == 14){ ?>

			<li><a href="#" title="Oración y Liturgia">Textos Litúrgicos</a>
			
				<ul style="width:300px;">
					<li style="width:300px;"><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li style="width:300px;"><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Ordo Missae en idiomas">Ordo missae en idiomas</a></li>
				</ul>
			</li>

<?php } ?>

<?php /*
		<ul class="submenu">

	<?php
		
		$sql = "SELECT DISTINCT(categoria) AS 'categoria' FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria > 0 ORDER BY nombre ASC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{

			while($fila = mysql_fetch_assoc($rs))
			{

			echo "<li class=\"menu-item menu-item-type-custom\"><a href=\"javascript:void(0);\">".getValue("SELECT grupo FROM grupos_categorias WHERE id = ".$fila['categoria'],1)." &raquo;</a>
					<ul class=\"submenu\">";

				$css = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria = ".$fila['categoria']." ORDER BY nombre ASC";
				$rss = mysql_query($css,$conex);

				while($rw = mysql_fetch_assoc($rss))
				{
					echo "<li class=\"menu-item menu-item-type-custom extraa\"><a href=\"".$urlOri."grupos/".limpiarCadena($rw['nombre'],'archivo')."_".$rw['id'].".html\">".$rw['nombre']."</a></li>\n";
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
				echo "<li><a href=\"".$urlOri."grupos/".limpiarCadena($fila['nombre'],'archivo')."_".$fila['id'].".html\">".$fila['nombre']."</a></li>\n";
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
			
			</div>

<?php 
if(!isset($_GET['sec']))
{
	include('featured.php');
} ?>

<div style="clear:both;"></div>
