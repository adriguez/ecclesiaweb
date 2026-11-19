<link href="<?=$urlOri;?>templates/external/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

				<h2 class="title" style="margin-bottom:4px;">Santos</h2>
				<p class="byline"><?=$nombreParroquia;?></p>

<div id="calendar">

<div id="calendar_wrap">

<?php

	if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
	if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

	$eventosMes = getArraySantos($mes, $anyo);

	$devuelve = generateBig_calendarLiturgia($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array(), $santos=true);

	echo $devuelve;

?>

</div>
</div>

<?php if(isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['anyo'])){ 

	if($_GET['dia'] >= 1 && $_GET['dia'] <= 9) $dia = "0".intval($_GET['dia']); else $dia = intval($_GET['dia']);
	if(isset($_GET['mes']) && $_GET['mes'] != "") $mes = intval($_GET['mes']);
	if(isset($_GET['anyo']) && $_GET['anyo'] != "") $anyo = intval($_GET['anyo']);

	$fecha = $anyo."-".$mes."-".$dia;

	$santos = getSantos($fecha);

		switch($mes)
		{
			case "01"; $mes = "Enero"; break;
			case "02"; $mes = "Febrero"; break;
			case "03"; $mes = "Marzo"; break;
			case "04"; $mes = "Abril"; break;
			case "05"; $mes = "Mayo"; break;
			case "06"; $mes = "Junio"; break;
			case "07"; $mes = "Julio"; break;
			case "08"; $mes = "Agosto"; break;
			case "09"; $mes = "Septiembre"; break;
			case "10"; $mes = "Octubre"; break;
			case "11"; $mes = "Noviembre"; break;
			case "12"; $mes = "Diciembre"; break;
		}

?>

<div id="eventos-dia">

	<a id="santos"></a>


<div class="santos">

	<div class="post">
		<h2 class="title">Los santos del <?=$dia;?> de <?=$mes;?></h2>
	</div>

	<?=$santos;?>

</div>

</div>

<?php } ?>