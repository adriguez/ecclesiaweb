
<?php

	$mes = date('m');

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

	if(!isset($otraFecha)) $otraFecha = date('Y-m-d');

?>

<div class="santos">

	<div class="post" style="padding:0;">
		<h2 class="title">Los santos del <?=date('d');?> de <?=$mes;?></h2>
	</div>

	<?=getSantos($otraFecha);?>

</div>