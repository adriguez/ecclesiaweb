<?php

include('_includes/config.php');

$template = getValue("SELECT template FROM configuracion_base WHERE parroquia = $idparroquia",1);

if($template == 0) $template = 1;
//if($_SERVER['REMOTE_ADDR'] == "81.203.67.131") $template = 13;
//if($_SERVER['REMOTE_ADDR'] == "90.74.202.31" && !isset($_GET['ant'])) $template = 12;

if ($idparroquia==3 && $_SERVER['REMOTE_ADDR'] == "81.203.80.217") {
/*	if(isset($_GET['showError'])){
		ini_set('display_errors','1');
		ini_set("error_reporting",E_ALL);
	}
   $template=16;
   //echo $idparroquia;*/
} 

//if ($_SERVER['REMOTE_ADDR'] == "90.173.201.22" || $_SERVER['REMOTE_ADDR'] == "84.79.141.24" || $_SERVER['REMOTE_ADDR'] == "80.103.13.231") {

if ($_SERVER['REMOTE_ADDR'] == "90.173.201.22" || $_SERVER['REMOTE_ADDR'] == "90.174.5.98" || $_SERVER['REMOTE_ADDR'] == "91.215.65.18" || $_SERVER['REMOTE_ADDR'] == "80.103.13.231") {
  //ini_set('display_errors','1');
  //ini_set("error_reporting",E_ALL);
  //$template=13;
  //echo $template;
  //echo $idparroquia;
  //exit();
}

if ($_SERVER['REMOTE_ADDR'] == "93.105.163.176") {
  //ini_set('display_errors','1');
  //ini_set("error_reporting",E_ALL);
  //$template=13;
}


if ($template==13 || $template==15 || $template == 16) {
	include('_includes/func_bda_extra.php');	
}

$archivos = getValue("SELECT archivos, color FROM templates WHERE id = $template",0);

if($archivos[1] == 1) $color = $template; else $color = 0;

$archivos = $archivos[0];

$archivos = explode(";",$archivos);

foreach($archivos as $id=>$archivo)
{
	include($archivo);
	if(substr_count($archivo, "_header.php") > 0){

		switch($idparroquia)
		{
			case 25;
				$idAnalytics = "UA-80548760-1";
			break;
			case 1;
				$idAnalytics = "UA-80548760-2";
			break;
			default: $idAnalytics = ""; break;
		}

		if($idAnalytics != ""){

			echo "<script>
	 				 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');	

	  				ga('create', '".$idAnalytics."', 'auto');
	  				ga('send', 'pageview');

				</script>";

		}
	}
}

?>