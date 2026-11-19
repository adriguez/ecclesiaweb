<link href="<?=$urlOri;?>templates/mintra/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

<?php

	if(isset($_GET['mes']) && isset($_GET['anyo']) && isset($_GET['dia'])) $fecha = addslashes($_GET['dia'])."-".addslashes($_GET['mes'])."-".addslashes($_GET['anyo']); else $fecha = date('d-m-Y');

	$fechaFormato = date('d',strtotime($fecha))." de ".getMes(date('m',strtotime($fecha))).", ".date('Y',strtotime($fecha));

?>

				<h2 class="title" style="margin-bottom:4px;">Oraciones y Liturgia</h2>
				<p class="byline"><?=$nombreParroquia;?></p>

	<?php

		// **********************************
		// ********** LITURGIA DE LAS HORAS
		// **********************************

		$intro = getValue("SELECT intro FROM liturgia_urls WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",1);
		$intro = strip_tags($intro);

		$intro = RecortaStr($intro,240,'..');

		if($intro == "") $intro = "Accede desde el enlace de abajo a la liturgia.";
	?>

	<div class="bloqueLiturgia" style="margin-top:15px;position:relative;left:-5px;">

		<div class="topBloque">Liturgia de las horas</div>

		<div class="horas content">

			<b><?=$fechaFormato;?></b>

			<p><?=$intro;?></p>
			<a href="<?=$urlOri;?>liturgia/<?=$fecha;?>/" class="completo more">Ver oraciones &raquo;</a>

		</div>

	</div>

	<?php

		// **********************************
		// ********** LECTURA DIARIA
		// **********************************

		$valores = getValue("SELECT titulo, texto FROM pastoral_lecturas WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

		if(!isset($valores[0])) $titulo = ""; else $titulo = stripslashes($valores[0]);
		if(!isset($valores[1])) $texto = ""; else $texto = RecortaStr(strip_tags($valores[1]),160,'..');

		$urlLectura = $urlOri."lectura-diaria/".$fecha."/";

	?>

	<?php if($texto != ""){ ?>

	<div class="bloqueLiturgia" style="margin-left:3px;margin-top:15px;position:relative;right:-5px;">

		<div class="topBloque">Lectura diaria</div>

		<div class="liturgia content">

			<a href="<?=$urlOri;?>lectura-diaria/<?=$fecha;?>/" class="completo"><?=$titulo;?></a>

			<b><?=$fechaFormato;?></b>

			<p><?=$texto;?></p>
			<a href="<?=$urlLectura;?>" class="completo more">Leer completo &raquo;</a>

		</div>

	</div>



	<?php }else{ ?>

	<div class="bloqueLiturgia" style="margin-left:3px;margin-top:15px;position:relative;right:-5px;">

		<div class="topBloque">Lectura diaria</div>

		<div class="liturgia content">

			<p>En breve.</p>

		</div>

	</div>

	<?php } ?>

	<?php

		// **********************************
		// ********** COMENTARIO DIARIO
		// **********************************

		$valores = getValue("SELECT titulo, texto FROM comentarios_lecturas WHERE fecha = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

		if(isset($valores[0]) && isset($valores[1]))
		{

			$titulo = stripslashes($valores[0]);
			$texto = RecortaStr(strip_tags($valores[1]),160,'..');

			$urlComentario = $urlOri."comentario/".$fecha."/";
		}
		else{
			$titulo = "No existe todavía comentario diario para este día";
			$texto = "";
			$urlComentario = "";
		}

	?>

	<div class="bloqueLiturgia" style="position:relative;left:-5px;">

		<div class="topBloque">Comentario diario</div>

		<div class="comentario content">

			<?php if($urlComentario != ""){ ?>
				<a href="<?=$urlComentario;?>" class="completo"><?=$titulo;?></a>
			<?php }else{ ?>
				<span class="completo"><?=$titulo;?></span>
			<?php } ?>

			<b><?=$fechaFormato;?></b>

			<p><?=$texto;?></p>
			<?php if($urlComentario != ""){ ?>
				<a href="<?=$urlComentario;?>" class="completo more">Leer completo &raquo;</a>
			<?php } ?>

		</div>

	</div>

	<?php
		// **********************************
		// ********** SANTORAL **************
		// **********************************

		$valores = getValue("SELECT titulo, contenido FROM santoral WHERE dia = '".date('Y-m-d',strtotime($fecha))."' LIMIT 1",0);

		$titulo = stripslashes($valores[0]);
		$titulo = RecortaStr($titulo,60,'..');
		$texto = RecortaStr(strip_tags($valores[1]),120,'..');

		$urlSantoral = $urlOri."santoral/".$fecha."/";
	?>

	<div class="bloqueLiturgia" style="margin-left:3px;position:relative;right:-5px;">

		<div class="topBloque">Santoral</div>

		<div class="santoral content">

			<a href="<?=$urlSantoral;?>" class="completo"><?=$titulo;?></a>

			<b><?=$fechaFormato;?></b>

			<p><?=$texto;?></p>
			<a href="<?=$urlSantoral;?>" class="completo more">Leer completo &raquo;</a>

		</div>

	</div>

	<?php
		// **********************************
		// ********** HOY DOMINGO ***********
		// **********************************

		$valores = getValue("SELECT titulo, texto, fecha FROM hoy_domingo WHERE fecha >= '".date('Y-m-d',strtotime($fecha))."' ORDER BY fecha ASC LIMIT 1",0);

		if(isset($valores[0]) && isset($valores[1]))
		{

			$titulo = stripslashes($valores[0]);
			$texto = RecortaStr(strip_tags($valores[1]),110,'..');

			$fechaDomingo = date('d-m-Y',strtotime($valores[2]));

			$urlDomingo = $urlOri."hoy-domingo/".$fechaDomingo."/";

			$fechaFormatoDomingo = date('d',strtotime($valores[2]))." de ".getMes(date('m',strtotime($valores[2]))).", ".date('Y',strtotime($valores[2]));
		}
		else{
			$titulo = "Todavía no existe texto de Hoy Domingo para la fecha seleccionada";
			$texto = "";
			$urlDomingo = "";
			$fechaFormatoDomingo = "";
		}
	?>

	<div class="bloqueLiturgia" style="margin-left:110px;">

		<div class="topBloque"><?php if($idparroquia == 1) echo "Hoy Domingo"; else echo "Pr&oacute;ximo domingo"; ?></div>

		<div class="hoydomingo content">

			<?php if($urlDomingo != ""){ ?>
				<a href="<?=$urlDomingo;?>" class="completo"><?=$titulo;?></a>
			<?php }else{ ?>
				<span class="completo"><?=$titulo;?></span>
			<?php } ?>

			<?php if($fechaFormatoDomingo != "01 de Enero, 1970"){ ?>
				<b><?=$fechaFormatoDomingo;?></b>
			<?php } ?>

			<p><?=$texto;?></p>
			<?php if($urlDomingo != ""){ ?><a href="<?=$urlDomingo;?>" class="completo more">Leer completo &raquo;</a><?php } ?>

		</div>

	</div>

	<div style="clear:both;"></div>


<div id="calendar">

<div id="calendar_wrap">

<?php

	if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
	if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

	$eventosMes = getArrayOraciones($mes, $anyo);

	$devuelve = generateBig_calendarLiturgiaOracion($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array());

	echo $devuelve;

?>

</div>
</div>