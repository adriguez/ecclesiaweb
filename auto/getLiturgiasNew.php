<?php

include('/var/www/vhosts/mintrared.com/subdomains/web/httpdocs/_includes/config.php');

$arrayDias = array("01" => 31, "02" => 29, "03" => 31, "04" => 30, "05" => 31, "06" => 30, "07" => 31, "08" => 31, "09" => 30, "10" => 31, "11" => 30, "12" => 31);
//$arrayDias = array("01" => 31);
foreach($arrayDias as $mes=> $numDias){

	for ($i = 1; $i <= $numDias; $i++) {

		$ch = curl_init('http://www.ibreviary.com/m2/opzioni.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// get headers too with this line
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "lang=es&giorno=".$i."&mese=".$mes."&anno=2026&ok=ok");
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$result = curl_exec($ch);
		// get cookie
		// multi-cookie variant contributed by @Combuster in comments
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
		    parse_str($item, $cookie);
		    $cookies = array_merge($cookies, $cookie);
		}

		$urlLiturgias = "http://www.ibreviary.com/m2/breviario.php";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $urlLiturgias);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Accept-Language: es-ES,es;q=0.9'
		));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=".$cookies['PHPSESSID']));
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$htm_listado = utf8_decode(curl_exec($ch));
		curl_close ($ch);

		$fecha = recuperar($htm_listado, '<h1>Breviario</h1>', '</p>');

		if($fecha != "") $fechaEx = explode(",",$fecha);

		if($fechaEx[1] != ""){

			$fechaEx = str_replace("Enero", "January",$fechaEx[1]);
			$fechaEx = str_replace("Febrero", "February",$fechaEx);
			$fechaEx = str_replace("Marzo", "March",$fechaEx);
			$fechaEx = str_replace("Abril", "April",$fechaEx);
			$fechaEx = str_replace("Mayo", "May",$fechaEx);
			$fechaEx = str_replace("Junio", "June",$fechaEx);
			$fechaEx = str_replace("Julio", "July",$fechaEx);
			$fechaEx = str_replace("Agosto", "August",$fechaEx);
			$fechaEx = str_replace("Septiembre", "September",$fechaEx);
			$fechaEx = str_replace("Octubre", "October",$fechaEx);
			$fechaEx = str_replace("Noviembre", "November",$fechaEx);
			$fechaEx = str_replace("Diciembre", "December",$fechaEx);

			$fecha = trim(date('Y-m-d',strtotime($fechaEx)));

		    $linkficha_ini = "<p><a href=\"/m2/breviario";
		    $linkficha_fin = "</p>";

		    while ((substr_count ($htm_listado, $linkficha_ini) != 0) && (substr_count ($htm_listado, $linkficha_fin) != 0))
		    {
		        $sublink = recuperar($htm_listado, $linkficha_ini, $linkficha_fin);
		        $htm_listado = recortar($htm_listado, $linkficha_ini.$sublink);

		        $nombreCat = trim(strip_tags(recuperar($sublink, '">', '</a>')));

				$coletilla = recuperar($sublink, '.php','">');

				if($coletilla != ""){

					$urlOri = "http://www.ibreviary.com/m2/breviario.php".$coletilla;

					$chh = curl_init();

					curl_setopt($chh, CURLOPT_URL, $urlOri);
					curl_setopt($chh, CURLOPT_HTTPHEADER, array(
					    'Accept-Language: es-ES,es;q=0.9'
					));
					curl_setopt($chh, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=".$cookies['PHPSESSID']));
					curl_setopt ($chh, CURLOPT_RETURNTRANSFER, 1);
					$htm_listadoNew = utf8_decode(curl_exec($chh));
					curl_close ($chh);

					if(getValue("SELECT id FROM liturgia_categorias WHERE categoria = '$nombreCat' LIMIT 1",1) == "")
					{
						mysql_query("INSERT INTO liturgia_categorias (categoria) VALUES ('$nombreCat')",$conex) or die (mysql_error());
						$idcat = mysql_insert_id($conex);
					}
					else $idcat = getValue("SELECT id FROM liturgia_categorias WHERE categoria = '$nombreCat' LIMIT 1",1);

					$texto = addslashes(recuperar($htm_listadoNew,'<div id="contenuto"><div class="inner"><h1>Breviario</h1>','<p><a href="#menu">- Menú -</a></p>'));

					if($texto != "" && $idcat > 0)
					{
						if(getValue("SELECT id FROM liturgia_textos WHERE fecha = '$fecha' AND categoria = '$idcat'",1) == "") mysql_query("INSERT INTO liturgia_textos (fecha, texto, categoria, url) VALUES ('$fecha', '$texto', '$idcat', '$urlOri')",$conex) or die (mysql_error());
						else mysql_query("UPDATE liturgia_textos SET texto = '$texto' WHERE fecha = '$fecha' AND categoria = '$idcat'",$conex);
					}

				}
		    }
		}
	}
}


exit();

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