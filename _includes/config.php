<?php

if($_SERVER['REMOTE_ADDR'] == "81.203.80.2171")
{
	ini_set('display_errors','1');
	ini_set("error_reporting",E_ALL);
}
else error_reporting(0);

session_start();

$thisphp = basename($_SERVER['PHP_SELF']);
$thisphp = str_replace(".php","",$thisphp);

include('conex.php');

// **************************************************************************
// *** VAMOS A HACER LAS COMPROBACIONES PARA LAS WWW
// *** OPCIÓN 1: www.dominio.com -> Correcto. Extraemos datos si existe.
// *** OPCIÓN 2: dominio.com -> Deberemos redigir a WWW de ese dominio, SÓLO si existe.
// *** OPCIÓN 3: parroquia-demostracion.ecclesiared.es -> Comprobamos si existe el dominio y la parroquia y extraemos datos.
// **************************************************************************


$host = $_SERVER['HTTP_HOST'];
$exp = explode(".",$host);

if($exp[0] == "www")
{
	// OPCIÓN 1, ESTAMOS EN WWW.

	$rs = mysql_query("SELECT parroquia, notis_home, titulo, donativos_url FROM configuracion_base WHERE dominio_original = '$host'",$conex);

	if(mysql_num_rows($rs) > 0)
	{
		$idparroquia = mysql_result($rs,0,'parroquia');
		// if(in_array($idparroquia, $httpsParroquias)) 
		$urlOri = "https://".$host."/";
		$urlRedir = $urlOri;
		$numNotis = mysql_result($rs,0,'notis_home');
		$nombreParroquia = mysql_result($rs,0,'titulo');
		$donativosUrl = mysql_result($rs, 0, 'donativos_url');
		
		// && in_array($idparroquia, $httpsParroquias)
		if(!isset($_SERVER['HTTPS'])){
			header('Location: '.$urlOri);
			exit();
		}
		
	}
	else exit();
}
else if($exp[1] == "ecclesiared" || $exp[1] == "parroquiasandiego" || $exp[0] == "smaria" || $exp[1] == "diocesisdeacariguaaraure" || $exp[1] == "diocesisdecaguas" || $exp[1] == "parroquiapatriarcasanjose" || $exp[1] == "diocesisdecartagocostarica" || $exp[1] == "iglesiadecalama" || $exp[1] == "vicariatoesmeraldas" || $exp[1] == "diocesisdecoatzacoalcos" || $exp[1] == "diocesisdesoacha" || $exp[1] == "diocesisdelimon" || $exp[1] == "arquidiocesisdeportoviejo" || $exp[1] == "diocesisdegirardota" || $exp[1] == "parroquiadecartagena" || $exp[1] == "xn--vicariatouflodechavez-kbc" || $exp[1] == "dehonianos" || $exp[1] == "diocesisdelaceiba")
{
	// OPCIÓN 3, ESTAMOS EN SUBDOMINIO DE ECCLESIA.

	$rs = mysql_query("SELECT parroquia, notis_home, titulo, donativos_url FROM configuracion_base WHERE dominio_original = '$host'",$conex);

	if(mysql_num_rows($rs) > 0)
	{
		$idparroquia = mysql_result($rs,0,'parroquia');
		//if(in_array($idparroquia, $httpsParroquias)) $urlOri = "https://".$host."/";
		//else
		$urlOri = "https://".$host."/";
		$urlRedir = $urlOri;
		$numNotis = mysql_result($rs,0,'notis_home');
		$nombreParroquia = mysql_result($rs,0,'titulo');
		$donativosUrl = mysql_result($rs, 0, 'donativos_url');
		
		// && in_array($idparroquia, $httpsParroquias)
		if(!isset($_SERVER['HTTPS'])){
			header('Location: '.$urlOri);
			exit();
		}
	}
	else exit();
	
}else if(isset($exp[0]) && $exp[0] != "web" && isset($exp[1]) && $exp[1] != "mintrared"){
	// OPCIÓN 2, HAY QUE COMPROBAR Y REDIRIGIR.
	if(isset($exp[0]) && $exp[0] != "" && isset($exp[1]) && $exp[1] != "")
	{
		$dominioComprobar = "www.".$exp[0].".".$exp[1];

		if(isset($exp[2]) && $exp[2] != "") $dominioComprobar .= ".".$exp[2];
		
		$rs = mysql_query("SELECT dominio FROM configuracion_base WHERE dominio_original = '$dominioComprobar'",$conex);

		if(mysql_num_rows($rs) > 0)
		{
			// 301 Moved Permanently
			//if(in_array($idparroquia, $httpsParroquias)) 
			//else header("Location: http://".$dominioComprobar."/",TRUE,301);
			header("Location: https://".$dominioComprobar."/",TRUE,301);
			exit();
		}
		else exit();
	}
	else exit();
}

$extPermitidas = array(".jpg",".jpeg",".png",".gif", ".bmp");
//if(in_array($idparroquia, $httpsParroquias))
$urlRecursos = "https://web.mintrared.com/";
//else $urlRecursos = "http://web.mintrared.com/";

// ****** DATOS CONEXIÓN MAIL PARA ENVIAR.

$host = "mail.ecclesiared.es";
$usermail = "contacto@ecclesiared.es";
$passwdmail = "wAAfWaeU";

// **************************************

// ****** INCLUDES IMPORTANTES

include('func_strPlus.php');
include('func_bda.php');
include('imageresize.php');

$coloresEventos = array("-1" => "#b373b3",
"0" => "#aaaaaa", 
"1" => "#d96666", 
"2" => "#e67399", 
"3" => "#b373b3", 
"4" => "#8c66d9", 
"5" => "#668cb3", 
"6" => "#668cd9", 
"7" => "#59bfb3", 
"8" => "#65ad89", 
"9" => "#4cb052", 
"10" => "#8cbf40", 
"11" => "#bfbf4d", 
"12" => "#e0c240", 
"13" => "#f2a640", 
"14" => "#e6804d", 
"15" => "#be9494", 
"16" => "#a992a9", 
"17" => "#8997a5", 
"18" => "#94a2be", 
"19" => "#85aaa5", 
"20" => "#a7a77d", 
"21" => "#c4a883");

?>