<?php

include('../_includes/config.php');

$anyo = "2021";

$urlLiturgia = "https://www.ciudadredonda.org/calendario-lecturas/evangelio-del-dia/liturgia-viva/?f=$anyo-[MES]-[DIA]";
$urlLectura = "https://www.ciudadredonda.org/calendario-lecturas/evangelio-del-dia/?f=$anyo-[MES]-[DIA]";

for ($i = 1; $i <= 12; $i++) 
{

	if($i >=1 && $i <= 9) $i = "0".$i;

	$urlLiturgia2 = str_replace("[MES]",$i,$urlLiturgia);
	$urlLectura2 = str_replace("[MES]",$i,$urlLectura);

	for ($a = 1; $a <= 31; $a++) 
	{

		if($a >=1 && $a <= 9) $a = "0".$a;

		$fecha = $anyo."-".$i."-".$a;

		$urlNewL = str_replace("[DIA]",$a,$urlLiturgia2);
		$urlNewLe = str_replace("[DIA]",$a,$urlLectura2);

		// LECTURAS

	    $ch      = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $urlNewLe);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    //curl_setopt_array( $ch, $options );
	    $htm_listado = curl_exec( $ch );
	    $err     = curl_errno( $ch );
	    $errmsg  = curl_error( $ch );
	    $header  = curl_getinfo( $ch );
	    curl_close( $ch );

		$titulo = addslashes(recuperar($htm_listado, "<h1 class=\"ar_titulo\">","</h1>"));
		$texto = addslashes(strip_tags(recuperar($htm_listado, "<div class=\"ar_marco\">","<div class=\"row row-enlaces\">"),"<p><b><b><strong><h1><h2><h3><h4><h5><ul><li><br>"));
		$titulo = utf8_decode($titulo);
		$texto = utf8_decode($texto);

		if($titulo != "" && $texto == "")
		{
			echo '<h3>Título sin texto en lecturas: '.$titulo.' - '.$fecha.'<br></h3>';
			echo '<br>'.$urlNewLe;
		}
		else{
			echo '<h3>Título con texto en lecturas: '.$titulo.' - '.$fecha.'<br></h3>';
			echo '<hr>'.$texto.'<hr>';
			echo '<br>'.$urlNewLe;
		}

		if($texto != "" && substr_count($htm_listado, "Error 500") == 0)
		{

			$texto = strip_tags(trim($texto),"<b><p><br><i><u><strong>");

			if(getValue("SELECT id FROM pastoral_lecturas WHERE fecha = '$fecha' LIMIT 1",1) == "")
			{
				mysql_query("INSERT INTO pastoral_lecturas (titulo, texto, fecha) VALUES ('$titulo', '$texto', '$fecha')",$conex) or die (mysql_error());
			}
			else{
				mysql_query("UPDATE pastoral_lecturas SET titulo = '$titulo', texto = '$texto' WHERE fecha = '$fecha'",$conex) or die (mysql_error());
			}
		}

		// LITURGIAS
/*
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $urlNewL);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$htm_listado = curl_exec($ch);
		curl_close ($ch);

		$titulo = addslashes(recuperar($htm_listado, "title = '","'"));
		$texto = addslashes(recuperar($htm_listado, "<div class='ar_marco'>","<div class=\"roundedcornr_bottom_"));

		if($titulo != "" && $texto == "")
		{
			echo '<h3>Título sin texto en liturgia: '.$titulo.' - '.$fecha.'<br></h3>';
		}

		$titulo = utf8_decode($titulo);
		$texto = utf8_decode($texto);

		if($texto != "" && substr_count($htm_listado, "Error 500") == 0)
		{

			$texto = strip_tags(trim($texto),"<b><p><br><i><u><strong>");

			if(getValue("SELECT id FROM pastoral_liturgia WHERE fecha = '$fecha' LIMIT 1",1) == "")
			{
				mysql_query("INSERT INTO pastoral_liturgia (titulo, texto, fecha) VALUES ('$titulo', '$texto', '$fecha')",$conex) or die (mysql_error());
			}
			else{
				mysql_query("UPDATE pastoral_liturgia SET titulo = '$titulo', texto = '$texto' WHERE fecha = '$fecha'",$conex) or die (mysql_error());
			}
		}
*/
	}
}

?>