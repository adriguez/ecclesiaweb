<?php

include('/var/www/vhosts/mintrared.com/subdomains/web/httpdocs/_includes/config.php');

/*
$sql = "SELECT id, titulo, contenido, dia FROM santoral WHERE dia >= '2025-01-01' AND dia <= '2025-12-31' ORDER BY dia ASC";
$rs = mysql_query($sql,$conex) or die (mysql_error());

while($rw = mysql_fetch_assoc($rs))
{
	$titulo = addslashes($rw['titulo']);
	$contenido = addslashes($rw['contenido']);
	$dia = str_replace("2014-","2015-",$rw['dia']);

	if(getValue("SELECT id FROM santoral WHERE dia = '$dia' LIMIT 1",1) == "")
	{
		mysql_query("INSERT INTO santoral (titulo, contenido, dia) VALUES ('$titulo', '$contenido', '$dia')",$conex) or die (mysql_error());
	}
}

echo 'Ok';
exit();
*/

$sql = "SELECT * FROM santoral_urls WHERE url != '' AND fecha >= '2026-01-01' ORDER BY fecha ASC";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs))
{

	$url = $rw['url'];
	$url = str_replace("http://","https://",$url);
	$fecha = $rw['fecha'];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$htm_listado = curl_exec($ch);
	curl_close ($ch);

	//$htm_listado = recuperar($htm_listado, "<strong>Celebran hoy:</strong>","<!-- Footer -->");

	$linkficha_ini = "<a href=\"https://www.santopedia.com/santos/";
	$linkficha_fin = "\"";

	while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
    	{
		$sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin);

		$htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		$urlSanto = "https://www.santopedia.com/santos/".$sublink;

		if(getValue("SELECT id FROM santos WHERE fecha = '$fecha' AND url = '$urlSanto'",1) == "")
		{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $urlSanto);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$htm_listadoNew = curl_exec($ch);
		curl_close ($ch);

		$nombreSanto = addslashes(recuperar($htm_listadoNew, "<title>Santopedia - ","</title>"));
		$tipoSanto = recuperar($htm_listadoNew, 'class="badge text-bg-primary text-decoration-none">','</a>');

		if($tipoSanto != "") $tipoSanto = addslashes(strip_tags($tipoSanto));

		$nombre = strip_tags(recuperar($htm_listadoNew, "<th>Nombre</th>","</strong>"));
		$genero = strip_tags(recuperar($htm_listadoNew, "<dt>G&eacute;nero:</dt>","</dd>"));
		$muerte = strip_tags(recuperar($htm_listadoNew, "<dt>Muerte:</dt>","</dd>"));

		$resumen = strip_tags(recuperar($htm_listadoNew, "<th>Nombre</th>","</tr>"));

		$nombre = addslashes(trim(html_entity_decode($nombre)));
		$genero = addslashes(trim(html_entity_decode($genero)));
		$muerte = addslashes(trim(html_entity_decode($muerte)));
		$resumen = addslashes(trim(html_entity_decode($resumen)));
		$tipoSanto = addslashes(trim(html_entity_decode($tipoSanto)));

		mysql_query(utf8_decode("INSERT INTO santos (fecha, nombre, nombre_santo, muerte, genero, texto, url, tipo_santo) VALUES ('$fecha', '$nombre', '$nombreSanto', '$muerte', '$genero', '$resumen', '$url', '$tipoSanto')"),$conex) or die (mysql_error());
		}

	}
}

exit();

$arrayMeses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$conta = 0;

foreach($arrayMeses as $id=>$mes)
{

	$conta++;

	$fechaDias = "2014-".$conta."-01";

	$numDias = date('t',strtotime($fechaDias));

	for ($i = 1; $i <= $numDias; $i++) 
	{

		$url = "http://www.santopedia.com/santoral/".$i."-de-".$mes;

		if($conta >= 1 && $conta <= 9) $mesA = "0".$conta; else $mesA = $conta;
		if($i >= 1 && $i <= 9) $dia = "0".$i; else $dia = $i;

		$fecha = "2014-".$mesA."-".$dia;

		mysql_query("INSERT INTO santoral_urls (fecha, url) VALUES ('$fecha', '$url')",$conex);
	}
}

exit();

$anyo = 2014;

$url = "http://www.archimadrid.eu/index.php?option=com_lecturas&controller=lecturasController&no_html=1&task=santos&id=$anyo-[MES]-[DIA]";

for ($i = 1; $i <= 12; $i++) 
{

	if($i >=1 && $i <= 9) $i = "0".$i;

	$urlADT = str_replace("[MES]",$i,$url);

	for ($a = 1; $a <= 31; $a++) 
	{

		if($a >=1 && $a <= 9) $a = "0".$a;

		$fecha = $anyo."-".$i."-".$a;

		echo $fecha.'<br>';

		if($fecha != "0000-00-00")
		{

			$urlADT2 = str_replace("[DIA]",$a,$urlADT);

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $urlADT2);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$htm_listado = curl_exec($ch);
			curl_close ($ch);

			$titulo = recuperar($htm_listado, "[{\"titulo\" : \"","\",");
			$contenido = recuperar($htm_listado, "\"contenido\" : \"","\",\"");

			if($titulo != "" && $contenido != "")
			{

				$contenido = strip_tags($contenido, "<strong><p><b><a><i><u><em><br>");
				$contenido = stripslashes($contenido);
				$contenido = str_replace("</p>n","</p>",$contenido);

				$contenido = addslashes(utf8_decode($contenido));
				$titulo = addslashes(strip_tags(utf8_decode($titulo)));
				if(getValue("SELECT id FROM santoral WHERE dia = '$fecha' LIMIT 1",1) > 0)
				{
					mysql_query("UPDATE santoral SET titulo = '$titulo', contenido = '$contenido' WHERE dia = '$fecha'",$conex) or die (mysql_error());
				}
				else{
					mysql_query("INSERT INTO santoral (titulo, contenido, dia) VALUES ('$titulo', '$contenido', '$fecha')",$conex) or die (mysql_error());
				}
			}

		}

	}

}

exit();

$sql = "SELECT * FROM santoral_urls WHERE url != '' AND fecha != '0000-00-00' ORDER BY fecha ASC";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs))
{

	$url = $rw['url'];
	$fecha = $rw['fecha'];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$htm_listado = curl_exec($ch);
	curl_close ($ch);

	$htm_listado = recuperar($htm_listado, "<ul class=\"santos_list\">","</ul>");

	$linkficha_ini = "<strong><a href=\"http://www.santopedia.com/santos/";
	$linkficha_fin = "\"";

	while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
    	{
		$sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin);

		$htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		$urlSanto = "http://www.santopedia.com/santos/".$sublink;

		if(getValue("SELECT id FROM santos WHERE fecha = '$fecha' AND url = '$urlSanto'",1) == "")
		{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $urlSanto);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$htm_listadoNew = curl_exec($ch);
		curl_close ($ch);

		$nombreSanto = addslashes(recuperar($htm_listadoNew, "<title>","</title>"));
		$tipoSanto = recuperar($htm_listadoNew, "<h3>","</h3>");

		if($tipoSanto != "") $tipoSanto = addslashes(strip_tags($tipoSanto));

		$nombre = strip_tags(recuperar($htm_listadoNew, "<dt>Nombre:</dt>","</dd>"));
		$genero = strip_tags(recuperar($htm_listadoNew, "<dt>G&eacute;nero:</dt>","</dd>"));
		$muerte = strip_tags(recuperar($htm_listadoNew, "<dt>Muerte:</dt>","</dd>"));

		$resumen = strip_tags(recuperar($htm_listadoNew, "<div class=\"resumen\">","</div>"));

		$nombre = addslashes(trim(html_entity_decode($nombre)));
		$genero = addslashes(trim(html_entity_decode($genero)));
		$muerte = addslashes(trim(html_entity_decode($muerte)));
		$resumen = addslashes(trim(html_entity_decode($resumen)));
		$tipoSanto = addslashes(trim(html_entity_decode($tipoSanto)));

		mysql_query("INSERT INTO santos (fecha, nombre, nombre_santo, muerte, genero, texto, url, tipo_santo) VALUES ('$fecha', '$nombre', '$nombreSanto', '$muerte', '$genero', '$resumen', '$url', '$tipoSanto')",$conex) or die (mysql_error());
		
		}

	}
}

// **** SACAR TODAS LAS URLS
exit();

/*$sql = "SELECT * FROM liturgia_urls WHERE padre = 0  AND fecha != '0000-00-00' ORDER BY fecha ASC";
$rs = mysql_query($sql,$conex);


$arrayMeses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$conta = 0;

foreach($arrayMeses as $id=>$mes)
{

	$conta++;

	$fechaDias = "2012-".$conta."-01";

	$numDias = date('t',strtotime($fechaDias));

	for ($i = 1; $i <= $numDias; $i++) 
	{

		$url = "http://www.santopedia.com/santoral/".$i."-de-".$mes;

		if($conta >= 1 && $conta <= 9) $mesA = "0".$conta; else $mesA = $conta;
		if($i >= 1 && $i <= 9) $dia = "0".$i; else $dia = $i;

		$fecha = "2012-".$mesA."-".$dia;

		mysql_query("INSERT INTO santoral_urls (fecha, url) VALUES ('$fecha', '$url')",$conex);
	}
}*/



$sql = "SELECT * FROM liturgia_urls WHERE padre = 0  AND fecha != '0000-00-00' ORDER BY fecha ASC";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs))
{

	$url = $rw['url'];
	$fecha = $rw['fecha'];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$htm_listado = curl_exec($ch);
	curl_close ($ch);

	$almenos = false;

	$links = recuperar($htm_listado, "<FONT SIZE=2 FACE=\"Verdana, Arial\" COLOR= \"#000000\">","</FONT>");

	if(substr_count($htm_listado, "<!LITHORAS>") > 0)
	{
		$enlaces = explode("<A href=\"",$links);

		foreach($enlaces as $id=>$valor)
		{
			if($valor != "" && $valor != "<BR>")
			{
				$nombreCat = recuperar($valor,"\">","</A>");
				if($nombreCat != "")
				{
					$pos = strpos($valor, "\">");
					if($pos !== false) $urlCat = substr($valor,0,$pos);

					if($nombreCat != "" && $urlCat != "")
					{

						if(getValue("SELECT id FROM liturgia_categorias WHERE categoria = '$nombreCat' LIMIT 1",1) == "")
						{
							mysql_query("INSERT INTO liturgia_categorias (categoria) VALUES ('$nombreCat')",$conex) or die (mysql_error());
							$idcat = mysql_insert_id($conex);
						}
						else $idcat = getValue("SELECT id FROM liturgia_categorias WHERE categoria = '$nombreCat' LIMIT 1",1);

						$urlOri = str_replace(basename($url),"",$url).$urlCat;
						
						$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, $urlOri);
						curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
						$htm2_listado = curl_exec($ch);
						curl_close ($ch);

						$texto = trim(recuperar($htm2_listado, "<!LITHORAS>","<A href= \""));
						
						$texto = strip_tags($texto,"<b><strong><br><p><font>");
						$texto = addslashes($texto);
						
						if($texto != "" && $idcat > 0)
						{
							$almenos = true;
							if(getValue("SELECT id FROM liturgia_textos WHERE fecha = '$fecha' AND categoria = '$idcat'",1) == "") mysql_query("INSERT INTO liturgia_textos (fecha, texto, categoria, url) VALUES ('$fecha', '$texto', '$idcat', '$urlOri')",$conex) or die (mysql_error());
							else mysql_query("UPDATE liturgia_textos SET texto = '$texto' WHERE fecha = '$fecha' AND categoria = '$idcat'",$conex);
						}
					}

				}
			}
		}
	}

	if(!$almenos) mysql_query("INSERT INTO liturgia_textos (fecha, categoria, manual) VALUES ('$fecha', '$url', 1)",$conex);

}










exit();

// **************************************
// ***** ZONA PARA CAPTAR NUEVOS MESES.
// **************************************

$sql = "SELECT * FROM liturgia_urls WHERE padre = 1 ORDER BY anyo ASC, mes ASC ";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs))
{

	$mes = $rw['mes'];
	$anyo = $rw['anyo'];

	if($mes >= 1 && $mes <= 9) $mes = "0".$mes;

	$url = $rw['url'];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$htm_listado = curl_exec($ch);
	curl_close ($ch);

	$calendario = recuperar($htm_listado, "<TABLE width=70% border=1 align=\"center\">","</TABLE>");

	$calendario = explode("<TD>",$calendario);

	foreach($calendario as $id=>$valor)
	{

		if(substr_count($valor, "<A href=") > 0)
		{
			$urlNew = recuperar($valor, "<A href= \"","\"");
			
			$dia = explode("/",$urlNew);
			$dia = $dia[0];

			$urlOk = str_replace(basename($url),$urlNew,$url);

			$fecha = $anyo."-".$mes."-".$dia;

			if(getValue("SELECT id FROM liturgia_urls WHERE padre = 0 AND fecha = '$fecha'",1) == "")
			{
				mysql_query("INSERT INTO liturgia_urls (url, padre, fecha) VALUES ('$urlOk', 0, '$fecha')",$conex) or die (mysql_error());
			}

		}

	}

}

?>