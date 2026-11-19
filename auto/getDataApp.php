<?php

include('../_includes/conex.php');
include('../_includes/func_app.php');
include('../_includes/func_bda.php');
include('../_includes/func_strPlus.php');

if(isset($_GET['zona']) && $_GET['zona'] != "")
{

	if(isset($_GET['par']) && $_GET['par'] > 0)
	{

		$urlOri = getValue("SELECT dominio FROM configuracion_base WHERE parroquia = ".intval($_GET['par']),1);

		switch($_GET['zona'])
		{
			case "noticias";

				$arrayDatos = getNoticiasApp(intval($_GET['par']));

				header('Cache-Control: no-cache, must-revalidate');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Access-Control-Allow-Origin: *');
				header('Content-type: application/json');
				echo json_encode($arrayDatos);
				//echo $arrayDatos;

			break;
		}
	}
}
?>