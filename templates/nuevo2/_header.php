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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <link href="<?=$urlOri;?>css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=$urlOri;?>js/bootstrap.min.js"></script>  

	<?php if($fotoNoticia != ""){ ?>
		<meta property="og:image" content="<?=$fotoNoticia;?>" />
	<?php } ?>

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/css/style_resp.css?t=<?=time();?>" media="screen" />
			
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ledger">

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/css/superfish.css" />
	<link rel="stylesheet" href="<?=$urlOri;?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>


	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.fancybox.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>	

	<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo2/js/superfish.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/nuevo2/js/preview.js.php?id=<?=$idparroquia;?>"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>templates/nuevo2/css/wt-rotator.css" />
	
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/tipsy.css" />
	<script type="text/javascript" src="<?=$urlOri;?>js/jtps.js"></script>
	<link rel="alternate" type="application/rss+xml" title="<?=$seo['title'];?> &raquo; Feed" href="<?=$urlOri;?>feed/" />
	<script type="text/javascript" language="javascript">


		$().ready(function() {

			<?php if($idparroquia == 1131){ ?>
				$(".folder").click(function(e){
					var id = $(this).attr('id');
					$("#"+id+" li").toggle();
				});
			<?php } ?>

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

	<?php if($idparroquia == 1131 && $_SERVER['REQUEST_URI'] == '/documentos/'){ ?>
	<style type="text/css">
		.folder li{display:none;}
		.folder:hover{cursor: pointer !important;}
	</style>
	<?php } ?>
	
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

	   function onSubmitEntrada(token) {

		var apellidos = $("#apellidos").val();
		var nombre = $("#nombre").val();
		var telefono = $("#telefono").val();
		var dni = $("#dni").val();
		var domicilio = $("#direccion").val();

		if(apellidos == "" || telefono == "" || dni == "" || domicilio == "" || nombre == ""){
			alert('Faltan campos obligatorios por rellenar.');
		}
		else{
		 	document.getElementById("contactoForm").submit();
		}
		
	   }

	 </script>
	
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ1PxaClZBYnZx3nK9eDuK44MzO7BF7M4&sensor=false&language=es"></script>

<?php $foot = $valores[2]; ?>

<base href="<?=$urlOri;?>" />
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0&appId=617391558314340" nonce="VpyH04X6"></script>
</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">

<div class="container">

    <div class="row">
    	<div id="subheader" class="col-md-12 <?php if($idparroquia == 14) echo "unitatcosta"; else echo "nostyle"; ?>">

    		<?php if($idparroquia == 14){ ?>
    			<div class="subtitulo"><?=$valores[2];?></div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top8.png" />
			<?php }else if($idparroquia == 1473){ ?>
    			<a href="<?=$urlOri;?>" class="titulo">&nbsp;</a>
    			<div class="subtitulo">&nbsp;</div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top_perpetuo.png" />
    		<?php }else if($idparroquia == 162){ ?>
    			<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?></a>
    			<div class="subtitulo"><?=$valores[5];?></div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top_7.png" />
    		<?php }else if($idparroquia == 191){ ?>
    			<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?></a>
    			<div class="subtitulo">Margarita - Espinar - Davis</div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top_10.png" />
			<?php }else if($idparroquia == 1078){ ?>
				<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?></a>
    			<div class="subtitulo"><?=$valores[5];?></div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top_20.png" />
    		<?php }else{ ?>
    			<a href="<?=$urlOri;?>" class="titulo"><?=$valores[2];?><?php if($idparroquia == 850) echo "<br><span style=\"font-size:20px;\">Las Palmas de Gran Canaria</span>"; ?></a>
    			<div class="subtitulo"><?=$valores[5];?></div>
    			<img onclick="document.location.href='<?=$urlOri;?>';" src="<?=$urlOri;?>/templates/nuevo2/images/header_top_5.png" />
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
							<li><a href="<?=$urlOri;?>">Inicio</a></li>
		        <?php

		if($idparroquia == 426){

				echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-sant-jaume-apostol' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-sant-miquel-arcangel' AND parroquia = $idparroquia",0);
					$txtint2 = $id[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul class=\"dropdown-menu\">";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
					echo "</ul></li>";

		}
		else if($idparroquia == 421){

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

		}
		else if($idparroquia == 14)
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

					$id8 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'ano-misericordia' AND parroquia = $idparroquia",0);
					$titulo8 = $id8[1];
					$id8 = $id8[0];

					echo "<ul class=\"dropdown-menu\">";

					if($id8 > 0) echo "<li><a href=\"".$urlOri."ano-misericordia/".$id8."/\">".$titulo8."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."dia-de-silencio/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."carida/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."celebraciones/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."iniciacion-vida-cristiana/".$id4."/\">".$titulo4."</a></li>\n"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."fundamento-vida-cristiana/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri."casal-del-toro/".$id6."/\">".$titulo6."</a></li>\n"; 
					if($id7 > 0) echo "<li><a href=\"".$urlOri."centro-espiritualidad-solidaria/".$id7."/\">".$titulo7."</a></li>\n"; 
					echo "</ul></li>";
		}
		else if($idparroquia == 31)
		{

					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santisima-trinidad-y-san-jose' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santiago-apostol' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];


					echo "<ul class=\"dropdown-menu\">";

					if($id3 > 0) echo "<li><a href=\"".$urlOri."historia/".$id3."/\">".$titulo3."</a></li>\n";
					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."purisima-concepcion-de-la-vileta/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."son-roca/".$id2."/\">".$titulo2."</a></li>\n";  
					echo "</ul></li>";
		}		
		else if($idparroquia == 21)
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

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];


					echo "<ul class=\"dropdown-menu\">";

					if($id3 > 0) echo "<li><a href=\"".$urlOri."historia/".$id3."/\">".$titulo3."</a></li>\n";
					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri."purisima-concepcion-de-la-vileta/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."son-roca/".$id2."/\">".$titulo2."</a></li>\n";  
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
		}
		else{

			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda') AND parroquia = $idparroquia LIMIT 1",1);

			if($id > 0)
			{

				if($idparroquia == 62) $txtP = "La Cofradía";
				else if($idparroquia == 119) $txtP = "Las parroquias";
				else if($idparroquia == 191) $txtP = "Nosotros";
				else if($idparroquia == 613) $txtP = "Parroquia";
				else $txtP = "La parroquia";

					echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">".$txtP." <span class=\"caret\"></span></a>\n";

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

					if($idparroquia == 84){
						$idSacerdote = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 384 AND parroquia = $idparroquia",0);
						$tituloSacerdotes = $idSacerdote[1];
						$guid = $idSacerdote[2];
						$idSacerdote = $idSacerdote[0];
					}

					echo "<ul class=\"dropdown-menu\">";


					if($id > 0) echo "<li><a href=\"".$urlOri."".limpiarCadena($titulo1,'archivo')."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n";
					if($idSacerdote > 0) echo "<li><a href=\"".$urlOri.$guid."/".$idSacerdote."/\">".$tituloSacerdotes."</a></li>\n";

					if($idparroquia == 1131){
						$txtInt = getValue("SELECT txt_int FROM paginas WHERE id = 2653",1);
						$tituloT = getValue("SELECT titulo FROM paginas WHERE id = 2653",1);
						echo "<li><a href=\"".$urlOri.$txtInt."/2653/\">".$tituloT."</a></li>\n";

						$txtInt = getValue("SELECT txt_int FROM paginas WHERE id = 2719",1);
						$tituloT = getValue("SELECT titulo FROM paginas WHERE id = 2719",1);
						echo "<li><a href=\"".$urlOri.$txtInt."/2719/\">".$tituloT."</a></li>\n";
					}
					

					if($idparroquia == 544){
						$valBoletin = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 934 AND parroquia = $idparroquia",0);
						echo "<li><a href=\"".$urlOri."boletin-parroquial-mensual/934/\" title=\"".$valBoletin['titulo']."\">".$valBoletin['titulo']."</a></li>";
					}

					
					if($idparroquia == 613){
						$idFelisa = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 1517 AND parroquia = $idparroquia",0);
						$tituloBautismo = $idFelisa[1];
						$guid = $idFelisa[2];
						$idFelisa = $idFelisa[0];

						$logros = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 1638 AND parroquia = $idparroquia",0);
						$tituloLogros = $logros[1];
						$guidLogros = $logros[2];
						$logros = $logros[0];
					}
					
					if($idFelisa > 0) echo "<li><a href=\"".$urlOri.$guid."/".$idFelisa."/\" title=\"".$tituloBautismo."\">".$tituloBautismo."</a></li>";
					if($logros > 0) echo "<li><a href=\"".$urlOri.$guidLogros."/".$logros."/\" title=\"".$tituloLogros."\">".$tituloLogros."</a></li>";

					if($idparroquia == 599){
						echo "<li><a href=\"".$urlOri."nuestro-santo-patrono/1545/\">Nuestro Santo patrono</a></li>\n";
						echo "<li><a href=\"".$urlOri."cuaresma-2022/1827/\">Cuaresma 2022</a></li>\n";
					}

					if($idparroquia == 1467){
						echo "<li><a href=\"".$urlOri."sacerdotes/2191/\">Sacerdotes</a></li>\n";
					}
					
					if($idparroquia == 850) echo "<li><a href=\"".$urlOri."galeria-fotografica.html\" title=\"Galería\">Galería</a></li>\n";

					if($idparroquia == 119)
					{
						$sql = "SELECT id, titulo, txt_int FROM paginas WHERE geolocalizada = 1 AND parroquia = 119 ORDER BY titulo ASC";
						$rs = mysql_query($sql,$conex);

						while($rw = mysql_fetch_array($rs)){
							echo "<li><a href=\"".$urlOri.$rw['txt_int']."/".$rw['id']."/\">".$rw['titulo']."</a></li>\n";
						}
					}

					if($idparroquia == 613) echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";

					if($idparroquia == 1078){
						echo "<li><a href=\"".$urlOri."tasas-administrativas-sacramentales/1968/\">Tasas Administrativas y Sacramentales</a></li>\n";
					}
					
					echo "</ul></li>";
			}

			if($idparroquia == 1078){ 

				echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Solicitudes <span class=\"caret\"></span></a>\n";

				echo "<ul class=\"dropdown-menu\">";
				echo "<li><a href=\"https://www.ecclesiared.es/solicitud-de-partidas/?destino=1078\" target=\"_blank\">Solicitud de partidas</a></li>\n";
				echo "<li><a href=\"".$urlOri."registro-entrada/2169/\">Registro de Entrada</a></li>\n";

				echo "</ul></li>";
				
				echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Transparencia <span class=\"caret\"></span></a>\n";

				echo "<ul class=\"dropdown-menu\">";

				echo "<li><a href=\"".$urlOri."estado-cuentas-mensuales/1972/\">Estados de Cuentas Mensuales</a></li>\n";
				echo "<li><a href=\"".$urlOri."informacion-economica/1969/\">Información Económica</a></li>\n";
				echo "<li><a href=\"".$urlOri."reglamentos-internos-parroquiales/1970/\">Reglamentos Internos Parroquiales</a></li>\n";
				echo "<li><a href=\"".$urlOri."resoluciones/1971/\">Resoluciones</a></li>\n";

				echo "</ul></li>";

			}

			?>

		<?php } ?>


		<?php if($idparroquia == 14){ ?>

					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Textos Litúrgicos <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
						<?php } ?>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Ordo Missae en idiomas">Ordo missae en idiomas</a></li>
						</ul>
					</li>

		<?php }else if($idparroquia == 53){ ?>

					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
						<?php } ?>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
							<li><a href="<?=$urlOri;?>faros-parroquiales/233/" title="Faros Parroquiales">Faros Parroquiales</a></li>
						</ul>
					</li>

		<?php }else{ ?>

			<?php 
					if($idparroquia == 84){
						$idBautismos = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 385 AND parroquia = $idparroquia",0);
						$tituloBautismo = $idBautismos[1];
						$guid = $idBautismos[2];
						$idBautismos = $idBautismos[0];
					}

					//(OM) Si la parroquia es 339 no sale la opcion de menu oracion y liturgia	
					if ($idparroquia != 339 && $idparroquia != 613) {
			?>

					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if($idparroquia == 191) echo "Lecturas"; else echo "Oración y Liturgia"; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
							<?php if($idparroquia == 599){ ?>
							<li><a href="<?=$urlOri;?>la-lectio-divina-lectura-orante-palabra-de-dios/1547/" title="La lectio divina o lectura orante de la Palabra de Dios">La lectio divina o lectura orante de la Palabra de Dios</a></li>
							<?php } ?>
							<?php if($idparroquia == 1131){ ?>
							<li><a href="<?=$urlOri;?>reflexiones-ayuda-oracion-diaria/2659/" title="<?=getValue("SELECT titulo FROM paginas WHERE id = 2659",1);?>"><?=getValue("SELECT titulo FROM paginas WHERE id = 2659",1);?></a></li>
							<?php } ?>
							<?php if($idBautismos > 0){ ?><li><a href="<?=$urlOri;?><?=$guid;?>/<?=$idBautismos;?>/" title="<?=$tituloBautismo;?>"><?=$tituloBautismo;?></a></li><?php } ?>
						</ul>
					</li>
					
					<?php if($idparroquia == 191){ ?>
					
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sacramentos <span class="caret"></span></a>
					
						<ul class="dropdown-menu">
							<li><a href="<?=$urlOri;?>bautismos/1070/" title="Bautismos">Bautismos</a></li>
							<li><a href="<?=$urlOri;?>primera-comunion/1078/" title="Primera comunión">Primera comunión</a></li>
							<li><a href="<?=$urlOri;?>confirmacion/1079/" title="Confirmación">Confirmación</a></li>
							<li><a href="<?=$urlOri;?>matrimonio/1080/" title="Matrimonio">Matrimonio</a></li>
							<li><a href="<?=$urlOri;?>uncion-de-enfermos/1081/" title="Unción de enfermos">Unción de enfermos</a></li>
							<li><a href="<?=$urlOri;?>confesion/1082/" title="Confesión">Confesión</a></li>
							<li><a href="<?=$urlOri;?>catequesis-para-adultos/1083/" title="Catequesis para adultos">Catequesis para adultos</a></li>
						</ul>
					</li>
					
					<?php } ?>

			
			<?php   } ?>
			<?php if($showmisa){ ?>
				<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online"><?php if($idparroquia == 613) echo "E-misión"; else echo "Misa online"; ?></a></li>
			<?php } ?>

				
			<?php
		       } ?>
					<?php if($idparroquia == 53 || $idparroquia == 142){ ?>
					<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Apostolados Parroquiales">Apostolados Parroquiales</a></li>
			
					<?php }else if($idparroquia != 62){ ?> 
					<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales"><?php if($idparroquia == 191) echo "Grupos"; else echo "Grupos Parroquiales"; ?></a></li>
			

					<?php if($idparroquia == 142){
					?>
					<li><a href="<?=$urlOri;?>diaconias/237/" title="Diaconías">Diaconías</a></li>
			
					<?php
					}
					?>

					<?php } ?>
					
					<?php if($idparroquia == 1467){
					
					$arraySacramentos = array(2213, 2214, 2215, 2231, 2216, 2218, 2219);
					$arrayFormacion = array(2212, 2220);
					$arrayOracion = array(2222, 2223, 2232, 2224, 2225, 2226, 2227);
						
					?>

						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sacramentos <span class="caret"></span></a>
					
							<ul class="dropdown-menu">
							<?php 
							foreach($arraySacramentos as $i=>$v){

								$val = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '$v'",0);

								echo "<li><a href=\"".$urlOri."".$val['txt_int']."/".$v."/\" title=\"".$val['txt_int']."\">".$val['titulo']."</a></li>";
							
							} 
							?>
							</ul>
						</li>

						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formación <span class="caret"></span></a>
					
							<ul class="dropdown-menu">
							<?php 
							foreach($arrayFormacion as $i=>$v){

								$val = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '$v'",0);

								echo "<li><a href=\"".$urlOri."".$val['txt_int']."/".$v."/\" title=\"".$val['txt_int']."\">".$val['titulo']."</a></li>";
							
							} 
							?>
							</ul>
						</li>

						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración <span class="caret"></span></a>
					
							<ul class="dropdown-menu">
							<?php 
							foreach($arrayOracion as $i=>$v){

								$val = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '$v'",0);

								echo "<li><a href=\"".$urlOri."".$val['txt_int']."/".$v."/\" title=\"".$val['txt_int']."\">".$val['titulo']."</a></li>";
							
							} 
							?>
							</ul>
						</li>

					<?php } ?>
					
					<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>

					<?php 
						//(OM) 07/08/2018 PARROQUIA SANTA MARÍA DE GUADALUPE quiere cambiar el nombre de documentos
						$titulo="Documentos"; 
						if($idparroquia == 339) { $titulo="Vídeos";}
					?>

				<?php if($idparroquia != 613){ ?>
					<li><a href="<?=$urlOri;?>documentos/" title="<?php echo $titulo;?>"><?php echo $titulo;?></a></li>
				<?php } ?>
					
					<?php if($idparroquia == 339){ ?>
						<li><a href="<?=$urlOri;?>colegio/1144/" title="Colegio">Colegio</a></li>
					<?php } ?>

			<?php

			if($idparroquia == 1078){
				$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

				if($idparroquia == 191) $txtDonativos = "Donaciones";
				else $txtDonativos = "Donativos";

				
			?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Donativos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php 	if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
									else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">".$txtDonativos."</a></li>\n"; ?>
							<li><a href="<?=$urlOri;?>suscripcion-economica/2160/\">Suscripción Económica</a></li>
							<?php /* <li><a href="https://forms.gle/rwHkBJSUTaHD3Ghi6" target="_blank" title="Solicitud certificado Donativo">Solicitud certificado Donativo</a></li>*/ ?>
						</ul>
					</li>
			<?php
			}
			else if($idparroquia != 1732){

					$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

					if($idparroquia == 191) $txtDonativos = "Donaciones";
					else $txtDonativos = "Donativos";
					
					if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
					else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">".$txtDonativos."</a></li>\n";
			}
			?>
			
			<?php if($idparroquia == 191){ ?>
			
			<li><a href="<?=$urlOri;?>nichos-funerarios/1207/" title="Nichos Funerarios">Nichos Funerarios</a></li>
			
			<?php } ?>
			
			<?php if($idparroquia == 602){ 
			
				$val = getValue("SELECT titulo FROM paginas WHERE id = 1143",1);
			
			?>
				<li><a href="<?=$urlOri;?>jmj-parroquial-lisboa-2023/1143/" title="<?=$val;?>"><?=$val;?></a></li>
			<?php } ?>

					<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia"><?php if($idparroquia == 191) echo "Contáctenos"; else echo "Contacto"; ?></a></li>
							
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

