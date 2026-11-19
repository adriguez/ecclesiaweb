<?php

	ini_set('display_errors','1');
	ini_set("error_reporting",E_ALL);

include('../_includes/config.php');



function getMesComentarios($mes)
{
	switch($mes) 
	{
		case "enero"; $mes = "01"; break;
		case "febrero"; $mes = "02"; break;
		case "marzo"; $mes = "03"; break;
		case "abril"; $mes = "04"; break;
		case "mayo"; $mes = "05"; break;
		case "junio"; $mes = "06"; break;
		case "julio"; $mes = "07"; break;
		case "agosto"; $mes = "08"; break;
		case "septiembre"; $mes = "09"; break;
		case "octubre"; $mes = "10"; break;
		case "noviembre"; $mes = "11"; break;
		case "diciembre"; $mes = "12"; break;
	}

	return $mes;
}

$url = "https://oracionyliturgia.archimadrid.org/category/lecturas-de-misa/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$htm_listado = curl_exec($ch);
curl_close ($ch);

$linkficha_ini = '<h2 class="entry-title"><a href="';
$linkficha_fin = "\"";

	while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
    {
		$sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin);
		$htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		$chh = curl_init();
		curl_setopt($chh, CURLOPT_URL, $sublink);
		curl_setopt ($chh, CURLOPT_RETURNTRANSFER, 1);
		$htm_listadoNew = curl_exec($chh);
		curl_close ($chh);

		$fecha = trim(recuperar($htm_listadoNew, '<title>', '&#8211;'));

		$ogTitle = recuperar($htm_listadoNew, '<meta property="og:type" content="article" />', '"og:locale" content="es_ES"');
		$title = utf8_decode(recuperar($ogTitle, '<meta property="og:title" content="','"'));
		$title = str_replace(" &#8211; ","",$title);
		$title = trim(str_replace($fecha, "", $title));

		$fechaEx = explode("/",$fecha);
		
		$fecha = $fechaEx[2]."-".$fechaEx[1]."-".$fechaEx[0];

		$texto = utf8_decode(recuperar($htm_listadoNew, '<div class="entry-content">', '<div class="et_post_meta_wrapper">'));
		
		if(getValue("SELECT id FROM pastoral_lecturas WHERE fecha = '$fecha'",1) == ""){
			mysql_query("INSERT INTO pastoral_lecturas (fecha, texto, titulo) VALUES ('$fecha', '$texto', '$title')",$conex);
		}
		else{
			mysql_query("UPDATE pastoral_lecturas SET titulo = '$title', texto = '$texto' WHERE fecha = '$fecha'",$conex);
		}
	}

$url = "https://oracionyliturgia.archimadrid.org/category/comentario-a-las-lecturas/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$htm_listado = curl_exec($ch);
curl_close ($ch);

// $htm_listado = recuperar($htm_listado, "<h2 class=\"pagetitle\">Archivo de la categor","<div class=\"art-Footer\">");

$linkficha_ini = "<h2 class=\"entry-title\"><a href=\"";
$linkficha_fin = "\"";

	while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
    	{
		$sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin);

		$htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		$chh = curl_init();
		curl_setopt($chh, CURLOPT_URL, $sublink);
		curl_setopt ($chh, CURLOPT_RETURNTRANSFER, 1);
		$htm_listado2 = curl_exec($chh);
		curl_close ($chh);

		$title = recuperar($htm_listado2, '<meta property="og:title" content="',"\"");
		
		$fecha = recuperar($htm_listado2, '<span class="published">', '</span>');
		$fechaEx = explode(",",$fecha);

		$fechaEx[1] = str_replace(" enero ","-01-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" febrero ","-02-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" marzo ","-03-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" abril ","-04-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" mayo ","-05-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" junio ","-06-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" julio ","-07-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" agosto ","-08-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" septiembre ","-09-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" octubre ","-10-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" noviembre ","-11-",$fechaEx[1]);
		$fechaEx[1] = str_replace(" diciembre ","-12-",$fechaEx[1]);

		$fecha = date('Y-m-d',strtotime($fechaEx[1]));

		$contenido = recuperar($htm_listado2, '<div class="entry-content">','<div class="et_post_meta_wrapper">');

		$titulo = addslashes(utf8_decode(trim($title)));
		$contenido = addslashes(utf8_decode(trim($contenido)));

/*
		$fecha = explode("/",$fecha);
		
		$dia = $fecha[0];
		$anyo = $fecha[2];
		$mes = $fecha[1];

		$fecha = trim(str_replace("-","",$anyo))."-".$mes."-".$dia;
*/


		if(getValue("SELECT id FROM comentarios_lecturas WHERE url_ori = '$sublink'",1) != "")
		{
			mysql_query("UPDATE comentarios_lecturas SET titulo = '$titulo', texto = '$contenido', fecha = '$fecha' WHERE url_ori = '$sublink'",$conex) or die (mysql_error());
		}
		else{
			echo "INSERT INTO comentarios_lecturas (fecha, titulo, texto, url_ori) VALUES ('$fecha', '$titulo', '$contenido', '$sublink')<br>";
			mysql_query("INSERT INTO comentarios_lecturas (fecha, titulo, texto, url_ori) VALUES ('$fecha', '$titulo', '$contenido', '$sublink')",$conex) or die (mysql_error());
		}
	}

exit();

$url = "https://oracionyliturgia.archimadrid.org/category/hoy-domingo/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$htm_listado = curl_exec($ch);
curl_close ($ch);

//$htm_listado = recuperar($htm_listado, "<h2 class=\"pagetitle\">Archivo de la categor","<div class=\"art-Footer\">");

$linkficha_ini = '<h2 class="entry-title"><a href="';
$linkficha_fin = "\"";

	while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
    	{
		$sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin); 

		$htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		$chh = curl_init();
		curl_setopt($chh, CURLOPT_URL, $sublink);
		curl_setopt ($chh, CURLOPT_RETURNTRANSFER, 1);
		$htm_listado2 = curl_exec($chh);
		curl_close ($chh);

		$title = recuperar($htm_listado2, '<h1 class="title">',"</h1>");
		$titleEx = explode("&#8211;",$title);

		if(isset($titleEx[1]))
		{
			$title = trim(strip_tags($titleEx[0]));
			$fecha = trim(strip_tags($titleEx[1]));
		}

		$contenido = recuperar($htm_listado2, '<div class="content clearfix">','<p class="taxonomy">Etiquetas');

		$titulo = addslashes(utf8_decode(trim($title)));
		$contenido = addslashes(utf8_decode(trim($contenido)));

		$fecha = explode("/",$fecha);
		
		$dia = $fecha[0];
		$anyo = $fecha[2];
		$mes = $fecha[1];

		$fecha = $anyo."-".$mes."-".$dia;

		/* NUEVA FECHA */
		// $ex = explode("&#8211;",$title);

		// $fecha = $ex[count($ex)-1];

		if($fecha != "")
		{
			/*
			$fecha = explode("/",$fecha);
			$fecha = trim($fecha[2])."-".trim($fecha[1])."-".trim($fecha[0]);

				$fecha = recuperar($htm_listado2, "<title>","</title>");
				$fecha = explode("&#8211;",$fecha);
			
				if($fecha[1] != "")
				{
					$fecha = explode("/",$fecha[1]);
					$fecha = trim($fecha[2])."-".trim($fecha[1])."-".trim($fecha[0]);
				}
			*/

			if(getValue("SELECT id FROM hoy_domingo WHERE url_ori = '$sublink'",1) != "")
			{
				mysql_query("UPDATE hoy_domingo SET titulo = '$titulo', fecha = '$fecha', texto = '$contenido' WHERE url_ori = '$sublink'",$conex) or die (mysql_error());
			}
			else{
				mysql_query("INSERT INTO hoy_domingo (fecha, titulo, texto, url_ori) VALUES ('$fecha', '$titulo', '$contenido', '$sublink')",$conex) or die (mysql_error());
			}

		}
	}

?>