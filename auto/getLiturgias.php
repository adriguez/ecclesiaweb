<?php

include('../_includes/config.php');



if(isset($_GET['nuevomes']))
{


	// **************************************
	// ***** ZONA PARA CAPTAR NUEVOS MESES.
	// **************************************

	$sql = "SELECT * FROM liturgia_urls WHERE padre = 1 AND anyo = 2019 AND mes = 9 ORDER BY anyo DESC, mes DESC ";
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

		$calendario = explode("<TD",$calendario);

		foreach($calendario as $id=>$valor)
		{

			if(substr_count($valor, "<A href=") > 0)
			{
				$urlNew = recuperar($valor, "<A href= \"","\"");
			
				$dia = explode("/",$urlNew);
				$dia = $dia[2];

				$urlOk = str_replace(basename($url),$urlNew,$url);

				$fecha = $anyo."-".$mes."-".$dia;

				if(getValue("SELECT id FROM liturgia_urls WHERE padre = 0 AND fecha = '$fecha'",1) == "")
				{
					mysql_query("INSERT INTO liturgia_urls (url, padre, fecha) VALUES ('$urlOk', 0, '$fecha')",$conex) or die (mysql_error());
				}

			}

		}

	}

	echo 'Acabo';
	exit();

}



$sql = "SELECT * FROM liturgia_urls WHERE padre = 0  AND fecha != '0000-00-00' AND fecha <= '2019-09-01' ORDER BY fecha DESC";
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

	if($links == "") $links = recuperar($htm_listado, "<TABLE WIDTH=\"100%\"","</TABLE>");


	if(substr_count($htm_listado, "oficio") > 0)
	{
		$enlaces = explode("<A HREF=\"",$links);

		foreach($enlaces as $id=>$valor)
		{
			if($valor != "" && $valor != "<BR>" && substr_count($valor, ".htm") > 0)
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

						$texto = trim(recuperar($htm2_listado, "<!LITHORAS>","<!FINLITHORAS>"));
						if($texto == "") $texto = trim(recuperar($htm2_listado, "<!PALM>","<!FINMOVILES>"));
						
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

echo 'Terminé';

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

	$htm_listado = recuperar($htm_listado, "</HEAD>","<A href=");
	$htm_listado = strip_tags($htm_listado, "<strong><i><u><p><br>");
	$htm_listado = trim($htm_listado);
	$htm_listado = addslashes($htm_listado);

	if($htm_listado != "") mysql_query("UPDATE liturgia_urls SET intro = '$htm_listado' WHERE url = '".$rw['url']."'",$conex) or die (mysql_error());

}


exit();






exit();

?>