<link href="<?=$urlOri;?>templates/transient/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

				<h2 class="title" style="margin-bottom:4px;">Eventos</h2>
				<p class="byline"><?=$nombreParroquia;?></p>
<div id="calendar">

<div id="calendar_wrap">

<?php

					if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
					if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

					$eventosMes = getArrayEventos($mes, $anyo);

					$devuelve = generateBig_calendar($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array());

echo $devuelve;

?>

</div>
</div>

<?php if(isset($_GET['act']) && $_GET['act'] == "viewevents" && isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['anyo']))
	{

	switch(addslashes($_GET['mes']))
	{
		case "01"; $month_name = "Enero"; break;
		case "02"; $month_name = "Febrero"; break;
		case "03"; $month_name = "Marzo"; break;
		case "04"; $month_name = "Abril"; break;
		case "05"; $month_name = "Mayo"; break;
		case "06"; $month_name = "Junio"; break;
		case "07"; $month_name = "Julio"; break;
		case "08"; $month_name = "Agosto"; break;
		case "09"; $month_name = "Septiembre"; break;
		case "10"; $month_name = "Octubre"; break;
		case "11"; $month_name = "Noviembre"; break;
		case "12"; $month_name = "Diciembre"; break;
		default: break;
	}

?>

<div id="eventos-dia">

	<div class='title_bar'>

		<h2 class='month'><img src="<?=$urlOri;?>images/calendar.png" /> Eventos para el día <?=intval($_GET['dia']);?> de <?=$month_name;?> de <?=intval($_GET['anyo']);?></h2>

	</div>

		<?=getEventos(addslashes($_GET['dia']),addslashes($_GET['mes']),addslashes($_GET['anyo']));?>
</div>

<?php } ?>

