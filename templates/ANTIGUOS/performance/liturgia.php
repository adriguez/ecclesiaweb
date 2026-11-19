<link href="<?=$urlOri;?>templates/performance/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

				<h2 class="title" style="margin-bottom:4px;">Liturgia</h2>
				<p class="byline"><?=$nombreParroquia;?></p>

<div id="calendar">

<div id="calendar_wrap">

<?php

	if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
	if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

	$eventosMes = getArrayLiturgias($mes, $anyo);

	$devuelve = generateBig_calendarLiturgia($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array());

	echo $devuelve;

?>

</div>
</div>

<?php if(isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['anyo'])){ 

	if($_GET['dia'] >= 1 && $_GET['dia'] <= 9) $dia = "0".intval($_GET['dia']); else $dia = intval($_GET['dia']);
	if(isset($_GET['mes']) && $_GET['mes'] != "") $mes = intval($_GET['mes']);
	if(isset($_GET['anyo']) && $_GET['anyo'] != "") $anyo = intval($_GET['anyo']);

	$fecha = $anyo."-".$mes."-".$dia;

	$liturgias = getLiturgias($fecha);

?>

<div id="eventos-dia">

	<a id="liturgia"></a>

	<?=$liturgias;?>

</div>

<?php }elseif(isset($_GET['idtexto']) && $_GET['idtexto'] > 0){

	$idtexto = intval($_GET['idtexto']);

	$liturgias = getLiturgiaUna($idtexto);

?>

<div id="eventos-dia">

	<a id="liturgia"></a>

	<?=$liturgias;?>

</div>

<?php } ?>