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

	if(!isset($seo['title']) || $seo['title'] == "") $seo['title'] = $valores[0];
	if(!isset($seo['description']) || $seo['description'] == "") $seo['description'] = "Bienvenidos a la página web de ".$valores[0];
	
	
	$misaonline = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
	if($misaonline['urlmisa'] != "") $showmisa = true;
	else $showmisa = false;

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

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/jquery.qtip.css" />
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.fancybox.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?=$urlOri;?>js/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.cycle.all.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=$urlOri;?>css/base.css" />

	<script type="text/javascript" src="<?=$urlOri;?>js/funciones.js"></script>

	<script type="text/javascript" src="<?=$urlOri;?>js/jquery.easing.1.3.js"></script>

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ1PxaClZBYnZx3nK9eDuK44MzO7BF7M4&sensor=false&language=es"></script>

	<link rel="stylesheet" type="text/css" media="all" href="<?=$urlOri;?>templates/mintra/css/style_resp.css?t=<?=date('Y-m-d');?>">

	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/superfish.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/jquery.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/jquery_002.js"></script>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/cufon-yui.js"></script>
	<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>
	<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/Trebuchet_MS_700.js"></script>

	<?php if($idparroquia == 1 && isset($_GET['sec']) && $_GET['sec'] == "noticia")
	{
		$sql = "SELECT * FROM noticias_fotos WHERE parroquia = $idparroquia AND idnoticia = ".intval($_GET['m'])." ORDER BY idfoto ASC LIMIT 1";
		$rs = mysql_query($sql,$conex) or die (mysql_error());

		$imagenes = "";
		$imagenPrimera = "";
		$conta = 0;

		if(mysql_num_rows($rs) == 1)
		{
			$fila = mysql_fetch_assoc($rs);

			$urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

			echo "<meta name=\"og:image\" content=\"$urlFoto\" />";
		}
	}
	?>

  	<script type="text/javascript">
  	// initialise plugins
		jQuery(function(){
			
			//tpsy
				if(jQuery('.lnktit').length > 0){
					jQuery('.lnktit').tipsy({gravity:'sw'});
				}

			jQuery('#fade').cycle();

			jQuery('#events').cycle({
				fx:        'turnDown',
				direction: 'down',
				speed: 1200,
				timeout: 3000,
				pauseOnPagerHover: true
			});

		});


  	</script>
	<?php if($idparroquia != 697){ ?>
	<script type="text/javascript">
			Cufon.replace('.logoFondo h1 a, .logoFondo h2 a', { fontFamily: 'Trebuchet MS', textShadow:"0 2px rgba(0, 0, 0, .5)", color: '-linear-gradient(#fdfbf7 #fdfbf7 #fdfbf7, #F5CD96 #F5CD96 #F5CD96)' });
	</script>
	<?php } ?>

	<base href="<?=$urlOri;?>" />

	<script src='https://www.google.com/recaptcha/api.js'></script>
	
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

<link rel="alternate" type="application/rss+xml" title="<?=$seo['title'];?> &raquo; Feed" href="<?=$urlOri;?>feed/" />

</head>
<body <?=$onload;?> class="parroquia-<?=$idparroquia;?>">

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
				<?php if($idparroquia != 1 && $idparroquia != 408 && $idparroquia != 2300){ ?><li><a href="<?=$urlOri;?>">Inicio</a></li><?php }else{

				if($idparroquia == 1){ ?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sacramentos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=$urlOri;?>bautismo/141/" title="Bautismo">Bautismo</a></li>
						<li><a href="<?=$urlOri;?>confirmacion/140/" title="Confirmación">Confirmación</a></li>
						<li><a href="<?=$urlOri;?>primera-comunion/199/" title="Primera Comunión">Primera Comunión</a></li>
						<li><a href="<?=$urlOri;?>confesion/201/" title="Confesión">Confesión</a></li>
						<li><a href="<?=$urlOri;?>matrimonio/195/" title="Matrimonio">Matrimonio</a></li>
						<li><a href="<?=$urlOri;?>uncion-de-enfermos/200/" title="Unción de enfermos">Unción de enfermos</a></li>
					</ul>
				</li>

				<?php }else if($idparroquia == 2300){ ?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inicio <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=$urlOri;?>" title="Inicio">Inicio</a></li>
						<li><a href="<?=$urlOri;?>historia/3253/" title="Historia">Historia</a></li>
						<li><a href="<?=$urlOri;?>horario-misas/3255/" title="Horario de Misas">Horario de Misas</a></li>
						<li><a href="<?=$urlOri;?>ubicacion/3254/" title="Ubicación">Ubicación</a></li>
					</ul>
				</li>


				<?php }else if($idparroquia == 408){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sacramentos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=$urlOri;?>bautismo/655/" title="Bautismo">Bautismo</a></li>
						<li><a href="<?=$urlOri;?>confirmacion/656/" title="Confirmación">Confirmación</a></li>
						<li><a href="<?=$urlOri;?>primera-comunion/657/" title="Primera Comunión">Primera Comunión</a></li>
						<li><a href="<?=$urlOri;?>confesion/658/" title="Confesión">Confesión</a></li>
						<li><a href="<?=$urlOri;?>matrimonio/659/" title="Matrimonio">Matrimonio</a></li>
						<li><a href="<?=$urlOri;?>uncion-de-enfermos/660/" title="Unción de enfermos">Unción de enfermos</a></li>
						<?php //(OM)15/10/2018 añadir esta pafina ?>
						<li><a href="<?=$urlOri;?>intenciones-de-misa-851/663/" title="Intenciones de Misa">Intenciones de Misa</a></li>
					</ul>
				</li>
				
				<?php } } ?>
				<?php

					$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda' OR txt_int = 'parroquia-sant-jordi' OR txt_int = 'parroquia-san-francisco-de-paula') AND parroquia = $idparroquia LIMIT 1",1);

					if($id > 0 && $idparroquia != 2300)
					{
						echo "<li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">La parroquia <span class=\"caret\"></span></a>\n
						<ul class=\"dropdown-menu\">\n";

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

						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-sant-jordi' AND parroquia = $idparroquia",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-francisco-de-paula' AND parroquia = $idparroquia",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];

							if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>\n";

						if($idparroquia == 697){
							echo "<li><a href=\"".$urlOri."nuestros-sacerdotes/2074/\">Nuestros sacerdotes</a></li>\n";
						}

							if($id2 > 0 && $idparroquia != 697) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
							if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
							if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>\n"; 
							if($id5 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id5."/\">".$titulo5."</a></li>\n"; 
							if($id6 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id6."/\">".$titulo6."</a></li>\n"; 

							if($idparroquia == 697){
								echo "<li><a href=\"".$urlOri."notaria-parroquial/2073/\">Notaria Parroquial</a></li>\n";
								echo "<li><a href=\"".$urlOri."servicios-caritas/2075/\">Servicios caritas</a></li>\n";
								echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>\n";  
							}

							if($idparroquia == 13) echo "<li><a href=\"".$urlOri."santuario-de-la-virgen-del-remedio/171/\">SANTUARIO DE LA VIRGEN DEL REMEDIO</a></li>\n"; 

						echo "</ul></li>";
					}
					else{
						echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>\n";
				
						echo "<ul class=\"dropdown-menu\">";

						$sql = "SELECT id, titulo, txt_int FROM paginas WHERE parroquia = 2300 AND ((id <= 3270 AND id >= 3259) OR id = 3281) ORDER BY orden DESC";
						$rs = mysql_query($sql,$conex);

						while($rw = mysql_fetch_assoc($rs)){
							echo "<li><a href=\"".$urlOri."".$rw['txt_int']."/".$rw['id']."/\">".$rw['titulo']."</a></li>\n"; 
						}

						echo "</ul></li>";

					}

				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oración y Liturgia <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<?php if($idparroquia == 599){ ?>
						<li><a href="<?=$urlOri;?>adviento-navidad/1711/" title="Adviento y Navidad">Adviento y Navidad</a></li>
					<?php } ?>
					<?php if($showmisa){ ?>
						<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
					<?php } ?>
						<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
					
						<?php if($idparroquia <> 986){
							//(OM) 23/07/2018 En la seccion de Oracion y Liturgia deshabilitar la "LEctura de la misa en varios idiomas" 
							//  PARROQUIA SANTA MARÍA DE GUADALUPE - MEXICO
						?>
						<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
						<?php } ?>

					</ul>
				</li>
				<?php if($idparroquia == 2300){ ?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Grupos Parroquiales <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php $arrayPags = array(3276, 3274, 3272, 3277, 3273, 3280, 3271, 3275, 3282, 3279);
						foreach($arrayPags as $i=>$id){
							$val = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '$id'",0);
							echo "<li><a href=\"".$urlOri."".$val['txt_int']."/$id/\" title=\"".$val['titulo']."\">".$val['titulo']."</a></li>";
						}
						?>
					</ul>
				</li>
				<?php }else{ ?>

				<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos Parroquiales">Grupos Parroquiales</a></li>

				<?php } ?>

				<?php if($idparroquia == 697){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sacramentos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=$urlOri;?>bautismo/2083/" title="Bautismo">Bautismo</a></li>
						<li><a href="<?=$urlOri;?>matrimonio/2084/" title="Matrimonio">Matrimonio</a></li>
						<li><a href="<?=$urlOri;?>confirmacion/2085/" title="Confirmación">Confirmación</a></li>
						<li><a href="<?=$urlOri;?>eucaristia/2086/" title="Eucaristia">Eucaristía</a></li>
						<li><a href="<?=$urlOri;?>uncion-enfermos/2087/" title="Unción de enfermos">Unción de enfermos</a></li>
						<li><a href="<?=$urlOri;?>xv-anos/2088/" title="XV Años">XV Años</a></li>
						<li><a href="<?=$urlOri;?>fervorines-3-anos/2089/" title="Fervorines (3 años)">Fervorines (3 años)</a></li>
						<li><a href="<?=$urlOri;?>graduaciones/2090/" title="Graduaciones">Graduaciones</a></li>
					</ul>
				</li>
				<?php } ?>
				
				<?php if($idparroquia != 697){ ?><li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li><?php } ?>
				<?php if($idparroquia == 2300){ ?>				
				<li><a href="<?=$urlOri;?>/categoria-esquelas/929" title="Esquelas">Esquelas</a></li>
				<?php }else{ ?>
				<li><a href="<?=$urlOri;?>documentos/" title="Documentos">Documentos</a></li>
				<?php } ?>
				<?php

 if($idparroquia != 697){

				if($idparroquia == 1 || $idparroquia == 408){
					echo "<li><a href=\"https://www.donoamiiglesia.es/san/Home#!/donar/650e58ca-ed3e-e611-80e8-005056b101e1\" target=\"_blank\" title=\"Dono a mi Iglesia\">Dono a mi Iglesia</a></li>\n";
				}else if($idparroquia != 570){
					$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);
					if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
					else if($id > 0) echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>\n";
				}

				if($idparroquia == 599){
					echo "<li><a href=\"".$urlOri."sinodo-2021-2023/1709/\" title=\"SÍNODO 2021-2023\">SÍNODO 2021-2023</a></li>\n";
				}
}

				?>
				<?php if($idparroquia == 986){ ?>
				<li><a href="<?=$urlOri;?>sacramentos/1144/" title="Sacramentos">Sacramentos</a></li>
				<?php } ?>

				<?php if($idparroquia == 697){ ?>
				<li><a href="<?=$urlOri;?>criptas/2082/" title="Criptas">Criptas</a></li>
				<?php } ?>

				<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>


<div class="container">

    		<div class="row logoFondo">
    			<div class="col-md-2 hidden-sm hidden-xs">

    				<img class="jes" src="<?=$urlOri;?>templates/mintra/images/<?php if($idparroquia == 697) echo "pablo-logo.png"; else echo "jes-mintra.png"; ?>" />

    			</div>
    			<div class="col-md-<?php if($idparroquia != 1 && $idparroquia != 408) echo "10"; else echo "8"; ?>">
    				<?php if($idparroquia == 408){ ?>
	      	         <h1 style="margin-left:60px;font-size:40px;line-height:70px;text-align:center;margin-top:25px;letter-spacing:10px;<?php if($idparroquia == 1) echo "margin-left:20px;"; ?>"><a href="<?=$urlOri;?>" title="<?=$valores[2];?> - <?=$valores[5];?>">Parroquia<br><span style="margin-top:20px;position: relative;top:12px;">Patriarca San José</span></a></h1>
    				<?php }else{ ?>
    					<h1 style="line-height:42px;text-align:center;margin-top:20px;letter-spacing:12px;<?php if($idparroquia == 1) echo "margin-left:20px;"; ?>"><a href="<?=$urlOri;?>" title="<?=$valores[2];?> - <?=$valores[5];?>"><?=$valores[2];?></a></h1>
    				<?php } ?>
    			</div>
    			<?php if($idparroquia == 1){ ?>
    			<div class="col-md-2 hidden-sm hidden-xs">				
						<img style="float:right;margin-right:35px;" src="http://www.nuestraseñorademontserrat.es/templates/nuevo2/images/moreneta_logo.png" />
    			</div>
    			<?php }else if($idparroquia == 408){ ?>
    			<div class="col-md-2 hidden-sm hidden-xs">				
						<img style="float:right;position:relative;left:15px;" src="http://www.parroquiapatriarcasanjose.com/templates/nuevo2/images/sanjose.png" />
    			</div>
    			<?php } ?>
				<?php if($idparroquia == 697) echo "<p class=\"subdiocesis\">- ARQUIDIÓCESIS DE LEÓN -</p>"; ?>
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