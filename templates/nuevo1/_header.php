<?php

	$seo = getDatosSeo($_GET['sec']);

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis, whatsapp FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$whatsappTel = str_replace(")","",str_replace("(","", str_replace("-","",$valores['whatsapp'])));

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
	
	
	$misaonline = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
	if($misaonline['urlmisa'] != "") $showmisa = true;
	else $showmisa = false;

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

	<?php if($idparroquia == 9){ ?>

	<meta name="google-translate-customization" content="b30e296fc927b86c-a1c826f2ddf43a05-gefb6036019326bbd-1f" />

	<?php } ?>

	<?php if($fotoNoticia != ""){ ?>
		<meta property="og:image" content="<?=$fotoNoticia;?>" />
	<?php } ?>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" href="<?=$urlOri;?>css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <link href="<?=$urlOri;?>css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=$urlOri;?>js/bootstrap.min.js"></script>    

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo1/css/style_resp.css" media="screen" />
		
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tinos">

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
	
	<?php if($idparroquia == 503){ ?>
		<link rel="shortcut icon" href="<?=$urlOri;?>templates/nuevo1/images/favicon/favicon-<?=$idparroquia;?>.ico" type="image/x-icon">
		<link rel="icon" href="<?=$urlOri;?>templates/nuevo1/images/favicon/favicon-<?=$idparroquia;?>.ico" type="image/x-icon">
	<?php } ?>
	
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

	<link rel="alternate" type="application/rss+xml" title="<?=$seo['title'];?> &raquo; Feed" href="<?=$urlOri;?>feed/" />
	
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

		if($idparroquia == 421){


					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'natividad-de-nuestra-senora-xalo' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'natividad-de-nuestra-senora-alcalali' AND parroquia = $idparroquia",0);
					$txtint2 = $id[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'santos-cosme-damian-lliber' AND parroquia = $idparroquia",0);
					$txtint3 = $id[2];
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'purisima-concepcion-parcent' AND parroquia = $idparroquia",0);
					$txtint4 = $id4[2];
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
					echo "</ul></li>";

		}else if($idparroquia == 21)
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

			if($idparroquia == 989) $parroquiaTxt = "La ermita";
			else $parroquiaTxt = "La parroquia";

			if($idparroquia == 1462){
				$linkParroquia = $urlOri."/la-parroquia/2106/";
				$extra = "";
			}
			else{
				$linkParroquia = "#";
				$extra = "data-toggle=\"dropdown\" ";
			}

			echo "<li class=\"dropdown\">
					<a class=\"dropdown-toggle\" $extra role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"$linkParroquia\">".$parroquiaTxt." <span class=\"caret\"></span></a>\n";

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
			

			if ($idparroquia == 336) {

			$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sacramentos' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo10 = $id10[1];
			$id10 = $id10[0];

			}


			$id11 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'nuestro-obispo-de-nuestra-diocesis' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo11 = $id11[1];
			$id11 = $id11[0];
			
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
				if($id > 0 && $idparroquia != 1462) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";  
				if($idparroquia == 1462) echo "<li><a href=\"".$urlOri."liturgia/2109/\">Liturgia</a></li>\n";
				if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
				if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
				if($idparroquia == 599) echo "<li><a href=\"".$urlOri."para-inscribirse-misas-presenciales/1134/\">Para inscribirse a las misas presenciales</a></li>\n"; 
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
				
				if($id10 > 0 && $idparroquia == 336) echo "<li><a href=\"".$urlOri."sacramentos/".$id10."/\">".$titulo10."</a></li>\n"; 
				
				if($id11 > 0 && $idparroquia == 535) echo "<li><a href=\"".$urlOri."nuestro-obispo-de-nuestra-diocesis/".$id11."/\">".$titulo11."</a></li>\n"; 
			
				if($idparroquia == 487){
					echo "<li><a href=\"".$urlOri."reserva-de-asistencia-para-misas/980/\">Reserva de asistencia para misas</a></li>\n"; 
				}

				if($idparroquia == 376){
					echo "<li><a href=\"".$urlOri."criptas-parroquial/1784/\">".getValue("SELECT titulo FROM paginas WHERE id = 1784",1)."</a></li>";
				//	echo "<li><a href=\"".$urlOri."solicitud-de-certificados/1783/\">".getValue("SELECT titulo FROM paginas WHERE id = 1783",1)."</a></li>";
					//echo "<li><a href=\"".$urlOri."sacramentos/1836/\">Sacramentos</a></li>";
				}

				if($idparroquia == 1462){
					echo "<li><a href=\"".$urlOri."consejo-parroquia/2101/\">".getValue("SELECT titulo FROM paginas WHERE id = 2101",1)."</a></li>";
					echo "<li><a href=\"".$urlOri."consejo-asuntos-economicos/2102/\">".getValue("SELECT titulo FROM paginas WHERE id = 2102",1)."</a></li>";
					echo "<li><a href=\"".$urlOri."consejo-sectorial/2103/\">".getValue("SELECT titulo FROM paginas WHERE id = 2103",1)."</a></li>";
					echo "<li><a href=\"".$urlOri."su-parroco/2105/\">".getValue("SELECT titulo FROM paginas WHERE id = 2105",1)."</a></li>";
					echo "<li><a href=\"".$urlOri."servicios-parroquiales/2110/\">".getValue("SELECT titulo FROM paginas WHERE id = 2110",1)."</a></li>";
					echo "<li><a href=\"".$urlOri."su-historia/2092/\">".getValue("SELECT titulo FROM paginas WHERE id = 2092",1)."</a></li>";
				}

				if($idparroquia == 544){
					$valBoletin = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 934 AND parroquia = $idparroquia",0);
					echo "<li><a href=\"".$urlOri."boletin-parroquial-mensual/934/\" title=\"".$valBoletin['titulo']."\">".$valBoletin['titulo']."</a></li>";
				}

			//	if($idparroquia == 376) echo "<li><a href=\"".$urlOri."calendario-parroquial/2151/\" title=\"Calendario Parroquial\">Calendario Parroquial</a></li>\n";

				echo "</ul>";

			}

			echo "</li>\n";

		}
	}

	if($idparroquia == 851){
		echo "<li class=\"dropdown\">
				<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Sacramentos <span class=\"caret\"></span></a>
			
				<ul class=\"dropdown-menu\">";

		$sql ="SELECT id, titulo FROM paginas WHERE id >= 1872 AND id <= 1877 AND parroquia = 851 ORDER BY id ASC";
		$rs = mysql_query($sql,$conex);

		while($rw=mysql_fetch_assoc($rs)){
			echo "<li><a href=\"".$urlOri."".limpiarCadena($rw['titulo'],'archivo')."/".$rw['id']."/\" title=\"".$rw['titulo']."\">".$rw['titulo']."</a></li>\n";
		}

		echo "</ul>
			</li>";
	}

	if($idparroquia == 376){
		echo "<li class=\"dropdown\">
				<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Capillas <span class=\"caret\"></span></a>
			
				<ul class=\"dropdown-menu\">";

		$sql ="SELECT id, titulo FROM paginas WHERE (id = 2983 OR (id >= 1790 AND id <= 1807)) AND parroquia = 376 ORDER BY id ASC";
		$rs = mysql_query($sql,$conex);

		while($rw=mysql_fetch_assoc($rs)){
			echo "<li><a href=\"".$urlOri."".limpiarCadena($rw['titulo'],'archivo')."/".$rw['id']."/\" title=\"".$rw['titulo']."\">".$rw['titulo']."</a></li>\n";
		}

		echo "</ul>
			</li>";


			$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sacramentos' AND parroquia = $idparroquia LIMIT 1",0);
			$titulo10 = $id10[1];
			$id10 = $id10[0];
		
			$arraySacramentos = array(1832, 1833, 1834, 1835, 1830, 1993);
			$sacramentos = "";
		
			foreach($arraySacramentos as $i=>$v){
				$val = getValue("SELECT id, txt_int, titulo AS 'guid' FROM paginas WHERE id = '$v'",0);
		
				$guid = $val[1];
				$titulo = $val[2];
		
				$sacramentos .= "<li><a href=\"".$urlOri.$guid."/".$v."/\">".$titulo."</a></li>";
			}
			
			echo "<li class=\"dropdown\">
				<a href=\"".$urlOri."sacramentos/$id10/\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">".$titulo10." <span class=\"caret\"></span></a>
		
				<ul class=\"dropdown-menu\">
					$sacramentos
				</ul>
			</li>";

	}

	?>
			<li class="dropdown">
				<a href="<?php if($idparroquia == 1462) echo $urlOri."oracion-y-liturgia/2107/"; else echo "#"; ?>" class="dropdown-toggle" <?php if($idparroquia != 1462) echo "data-toggle=\"dropdown\""; ?> role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
			
				<ul class="dropdown-menu">

				<?php if($idparroquia == 989){ ?>
					<li><a href="<?=$urlOri;?>categoria-mosaico-eucaristico-antifonas-de-entrada-y-comunion/909/" title="Mosaico Eucarístico. Antífonas de entrada y comunión">Mosaico Eucarístico. Antífonas de entrada y comunión</a></li>
				<?php } ?>
				
				<?php if($showmisa){ ?>
					<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
				<?php } ?>
				
			<?php if($idparroquia == 538){ 
			
				$valores3 = getValue("SELECT id, titulo, activar, txt_int FROM paginas WHERE id = 893",0);
				$valores2 = getValue("SELECT id, titulo, activar, txt_int FROM paginas WHERE id = 894",0);
				
				if($valores3['activar'] == 1) echo "<li><a href=\"".$urlOri.$valores3['txt_int']."/".$valores3['id']."\" title=\"".$valores3['titulo']."\">".$valores3['titulo']."</a></li>\n";
				if($valores2['activar'] == 1) echo "<li><a href=\"".$urlOri.$valores2['txt_int']."/".$valores2['id']."/\" title=\"".$valores2['titulo']."\">".$valores2['titulo']."</a></li>\n";
			}
			?>
					<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
				</ul>

			</li>
			<?php if($idparroquia == 503){ ?>
				<li><a href="<?=$urlOri;?>sacred-heart-connection/879/" title="Sacred Heart Connection">Sacred Heart Connection</a></li>
			<?php }else if($idparroquia != 9){ ?>
				<?php if($idparroquia == 538){ 
				
						$titulo1 = getValue("SELECT titulo, txt_int FROM paginas WHERE id = 895",0);
						$txtint1 = $titulo1[1];
						$titulo1 = $titulo1[0];
						
						$titulo2 = getValue("SELECT titulo, txt_int FROM paginas WHERE id = 896",0);
						$txtint2 = $titulo2[1];
						$titulo2 = $titulo2[0];
				
				
				?>
					<li>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actividades <span class="caret"></span></a>
			
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
							<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos parroquiales">Grupos parroquiales</a></li>
							<li><a href="<?=$urlOri;?><?=$txtint1;?>/895/" title="<?=$titulo1;?>"><?=$titulo1;?></a></li>
							<li><a href="<?=$urlOri;?><?=$txtint2;?>/896/" title="<?=$titulo2;?>"><?=$titulo2;?></a></li>
						</ul>
					</li>
				<?php }else if($idparroquia != 1462){ 
					
					if($idparroquia == 989) $gruposTxt = "Grupos y actividades";
					else if($idparroquia == 1462) $gruposTxt = "Comunidades Parroquiales";
					else $gruposTxt = "Grupos Parroquiales";
					
					?>
					<?php /*if($idparroquia == 376){
						echo "<li class=\"dropdown\">
								<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Grupos Parroquiales <span class=\"caret\"></span></a>
							
								<ul class=\"dropdown-menu\">";

						$sql ="SELECT id, nombre FROM grupos_pastorales WHERE parroquia = '$idparroquia' ORDER BY nombre ASC";
						$rs = mysql_query($sql,$conex);

						while($rw=mysql_fetch_assoc($rs)){
							echo "<li><a href=\"".$urlOri."grupos/".limpiarCadena($rw['nombre'],'archivo')."_".$rw['id'].".html\" title=\"".$rw['nombre']."\">".$rw['nombre']."</a></li>\n";
						}

						echo "</ul>
							</li>";

					}else*/
					if($idparroquia == 805){ ?>
						<li><a href="<?=$urlOri;?>templates/nuevo1/docs/Lista_parroquias_con_telefono.xlsx" target="_blank">Listado de Parroquias</a></li>
					<?php } ?>
					
					<?php if($idparroquia == 376){

							echo "<li class=\"dropdown\">
									<a href=\"".$urlOri."grupos-parroquiales.html\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Grupos Parroquiales <span class=\"caret\"></span></a>
								
									<ul class=\"dropdown-menu\">";

							$sql ="SELECT id, nombre FROM grupos_pastorales WHERE parroquia = '$idparroquia' ORDER BY nombre ASC";
							$rs = mysql_query($sql,$conex);

							while($rw=mysql_fetch_assoc($rs)){
								echo "<li><a href=\"".$urlOri."grupos/".limpiarCadena($rw['nombre'],'archivo')."_".$rw['id'].".html\" title=\"".$rw['nombre']."\">".$rw['nombre']."</a></li>\n";
							}

							echo "</ul>
								</li>";

						}else{
					?>
					<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="<?=$gruposTxt;?>"><?=$gruposTxt;?></a></li>
					<?php } ?>
				<?php } ?>

				<?php if($idparroquia == 1462){ ?>

					<li class="dropdown">
						<a href="<?=$urlOri;?>/plan-pastoral/2108/" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Plan Pastoral <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>/los-12-pasos-plan/2098/">Los 12 Pasos del Plan</a></li>
							<li><a href="<?=$urlOri;?>/itinerario-evangelizacion/2099/">Itinerario de Evangelización</a></li>
							<li><a href="<?=$urlOri;?>/guia-mensual/2100/">Guía Mensual</a></li>
							<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Com. Parroquiales">Com. Parroquiales</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="<?=$urlOri;?>/apologetica/2189/" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">APOLOGETICA <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>/apologetica-parroquial/2190/">APOLOGETICA PARROQUIAL</a></li>
						</ul>
					</li>
					
					<li><a href="<?=$urlOri;?>galeria-fotografica.html">Imágenes</a></li>

				<?php } ?>

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

			<?php if($idparroquia != 376){ ?><li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			<li><a href="<?=$urlOri;?>documentos/" title="Documentos">Documentos</a></li><?php } ?>
	<?php

			$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

			if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
			else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>\n";

	?>
			<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>

	
<div class="container">
    <div class="row">			
		<div id="subheader" class="col-md-12" style="margin:0;padding:0;">
			
			<a href="<?=$urlOri;?>"><?=$valores[2];?>
			<?php if($idparroquia == 376) echo "<br><span style=\"font-size:16px;position:relative;top:-20px;left:2px;\">Panamá Oeste, La Chorrera</span>"; ?></a>
			
			<?php if($idparroquia == 1788) echo "<br><span style=\"font-size:16px;position:absolute;top:61%;left:22%;font-size:20px;\">Diócesis Mao-Montecristi</span>"; ?></a>
			
			<?php if($idparroquia == 851) $valores[5] = "Calle 23 # 1A - 98 Paseo del Puente 2. Tel: 607 6654034 - Cel 321 5634693"; ?>
			<div class="subtitle"><i><?=$valores[5];?></i></div>
			<img src="<?=$urlOri;?>templates/nuevo1/images/<?php if($idparroquia == 9) echo "header_top_quart_2.png";
			else if($idparroquia == 1462) echo "header_top_presentacion.png";
			else if($idparroquia == 65) echo "header_top_gema_2.jpg";
			else if($idparroquia == 825) echo "header_top_javier.png";
			else if($idparroquia == 376) echo "header_top_paula.png";
			else if($idparroquia == 851) echo "header_top_montoya.png";
			else if($idparroquia == 989) echo "header_top_ermita.png";
			else echo "header_top.png"; ?>" />

				
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