<link href="<?=$urlOri;?>templates/mintra/css_calendar/stylesheet.css" rel="stylesheet" type="text/css" media="all" />

<?php

	if(isset($_GET['mes']) && $_GET['mes'] > 0) $mes = intval($_GET['mes']); else $mes = date('m');
	if(isset($_GET['anyo']) && $_GET['anyo'] > 0) $anyo = intval($_GET['anyo']); else $anyo = date('Y');

	if(isset($_GET['only']) && $_GET['only'] != "")
	{

		switch($_GET['only'])
		{
			case "lectura"; $tituloSeccion = "Lectura diaria"; break;
			case "comentario"; $tituloSeccion = "Comentario diario"; break;
			case "santoral"; $tituloSeccion = "Santoral"; break;
			case "hoydomingo"; $tituloSeccion = "Hoy Domingo"; break;
		}

	}
	else $tituloSeccion = "Liturgia de las horas";

?>

				<h2 class="title" style="margin-bottom:4px;"><?=$tituloSeccion;?></h2>
				<p class="byline"><?=$nombreParroquia;?></p>
<?php /*
<div id="calendar">

<div id="calendar_wrap">

<?php

	$eventosMes = getArrayLiturgias($mes, $anyo);

	$devuelve = generateBig_calendarLiturgia($anyo, $mes, $eventosMes, 3, $month_href = NULL, $first_day = 1, $pn=array());

	echo $devuelve;

?>

</div>
</div>
*/ ?>

<?php if(isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['anyo'])){ 

	if($_GET['dia'] >= 1 && $_GET['dia'] <= 9) $dia = "0".intval($_GET['dia']); else $dia = intval($_GET['dia']);
	if(isset($_GET['mes']) && $_GET['mes'] != "") $mes = intval($_GET['mes']);
	if(isset($_GET['anyo']) && $_GET['anyo'] != "") $anyo = intval($_GET['anyo']);

	if($mes <= 9) $mes = "0".$mes;

	$fecha = $anyo."-".$mes."-".$dia;

	if(isset($_GET['only']) && $_GET['only'] != "")
	{
		switch($_GET['only'])
		{
			case "santoral";

				$valores = getValue("SELECT titulo, contenido FROM santoral WHERE dia = '$fecha' LIMIT 1",0);

				$contenido = "";

				if(isset($valores[0]) && isset($valores[1]))
				{
					$titulo = $valores[0];
					$contenido = strip_tags($valores[1],"<b><p><strong><i><u><ul><li><em><ol><br>");
				} 
				else $titulo = "No existen datos.";

				$liturgias = "<div class='title_bar'>
							<h2 class='month'>
								".$titulo."
							</h2>
						</div>
						<p class=\"intro\">".$contenido."</p>";

			break;

			case "lectura";


				$valores = getValue("SELECT titulo, texto FROM pastoral_lecturas WHERE fecha = '$fecha' LIMIT 1",0);

				$contenido = "";

				if(isset($valores[0]) && isset($valores[1]))
				{
					$titulo = $valores[0];
					$contenido = strip_tags($valores[1],"<b><p><strong><i><u><ul><li><em><ol><br>");
				} 
				else $titulo = "No existen datos.";

				$liturgias = "<div class='title_bar'>
							<h2 class='month'>
								".$titulo."
							</h2>
						</div>
						<p class=\"intro\">".$contenido."</p>";

			break;

			case "comentario";


				$valores = getValue("SELECT titulo, texto FROM comentarios_lecturas WHERE fecha = '$fecha' LIMIT 1",0);

				$contenido = "";

				if(isset($valores[0]) && isset($valores[1]))
				{
					$titulo = $valores[0];
					$contenido = strip_tags($valores[1],"<b><p><strong><i><u><ul><li><em><ol><br>");
				} 
				else $titulo = "No existen datos.";

				$liturgias = "<div class='title_bar'>
							<h2 class='month'>
								".$titulo."
							</h2>
						</div>
						<p class=\"intro\">".$contenido."</p>";

			break;

			case "hoydomingo";


				$valores = getValue("SELECT titulo, texto FROM hoy_domingo WHERE fecha = '$fecha' LIMIT 1",0);

				$contenido = "";

				if(isset($valores[0]) && isset($valores[1]))
				{
					$titulo = $valores[0];
					$contenido = strip_tags($valores[1],"<b><p><strong><i><u><ul><li><em><ol><br>");
				} 
				else $titulo = "No existen datos.";

				$liturgias = "<div class='title_bar'>
							<h2 class='month'>
								".$titulo."
							</h2>
						</div>
						<p class=\"intro\">".$contenido."</p>";

			break;
		}
	}
	else{
		$liturgias = getLiturgias($fecha);
	}
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