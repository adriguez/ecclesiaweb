<?php

function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\" width=\"100%\" height=\"600\" ></iframe>",
        $string
    );
}

function deleteUrls($txt_content) {       
    $regex = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,6}(\/\S*)+?/";
    if(preg_match($regex, $txt_content,$matches)) {
       return preg_replace($regex, '', $txt_content);
    } 
    else {
       return $txt_content;
    }
}

function quitarAcentos($text)
	{
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
		$text = strtolower($text);
		$patron = array (
			// Espacios, puntos y comas por guion
			'/[\., ]+/' => '-',
 
			// Vocales
			'/&agrave;/' => 'a',
			'/&egrave;/' => 'e',
			'/&igrave;/' => 'i',
			'/&ograve;/' => 'o',
			'/&ugrave;/' => 'u',
 
			'/&aacute;/' => 'a',
			'/&eacute;/' => 'e',
			'/&iacute;/' => 'i',
			'/&oacute;/' => 'o',
			'/&uacute;/' => 'u',
 
			'/&acirc;/' => 'a',
			'/&ecirc;/' => 'e',
			'/&icirc;/' => 'i',
			'/&ocirc;/' => 'o',
			'/&ucirc;/' => 'u',
 
			'/&atilde;/' => 'a',
			'/&etilde;/' => 'e',
			'/&itilde;/' => 'i',
			'/&otilde;/' => 'o',
			'/&utilde;/' => 'u',
 
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
 
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
 
			// Otras letras y caracteres especiales
			'/&aring;/' => 'a',
			'/&ntilde;/' => 'n',
 
			// Agregar aqui mas caracteres si es necesario
 
		);
 
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		return $text;
}

function sacarExt($string)
{
	$donde = strrchr($string,".");
	if($donde != false)
	{
		return $donde;
	}else{ 
		return false; 
	}
}

function limpiarcadena($cadena,$tipo)
{
	$resultado=$cadena;
	switch($tipo){
		case "archivo": case "sinmovidas":
			$vectorinc=array();
			$cadenaincorrectos="\\(#\\)#&#\\$#·#%#!#'#¡#\\+#`#´#\.#Ç#ç#{#}#,#=#º#ª#¨#¿#€#\\[#\\]#/#°#\*#–#:#;# #_";
			$vectorinc=explode("#",$cadenaincorrectos);
			for($i=0;$i<count($vectorinc);$i++){
				$caracter=($vectorinc[$i]);
				$resultado=str_replace($caracter," ",$resultado);
			}

			$resultado = trim(strtolower($resultado));
			while (substr_count($resultado, "  ") != 0) $resultado = str_replace("  "," ",$resultado);
			if ($tipo == 'archivo') $resultado = str_replace(" ","-",$resultado);
			$resultado=str_replace("á","a",$resultado);
			$resultado=str_replace("à","a",$resultado);
			$resultado=str_replace("ä","a",$resultado);
			$resultado=str_replace("À","a",$resultado);
			$resultado = str_replace("Á","a",$resultado);
			$resultado = str_replace("Ä","a",$resultado);
			$resultado = str_replace("A","a",$resultado);
			$resultado = str_replace("â","a",$resultado);

			$resultado = str_replace('"',"",$resultado);
			$resultado = str_replace("'","",$resultado);
			$resultado = str_replace(".","",$resultado);

			$resultado=str_replace("é","e",$resultado);
			$resultado=str_replace("è","e",$resultado);
			$resultado=str_replace("ë","e",$resultado);
			$resultado=str_replace("È","e",$resultado);
			$resultado = str_replace("É","e",$resultado);
			$resultado = str_replace("Ë","e",$resultado);
			$resultado = str_replace("E","e",$resultado);
			$resultado = str_replace("ê","e",$resultado);

			$resultado=str_replace("í","i",$resultado);
			$resultado=str_replace("ì","i",$resultado);
			$resultado=str_replace("ï","i",$resultado);
			$resultado=str_replace("Ì","i",$resultado);
			$resultado = str_replace("Í","i",$resultado);
			$resultado = str_replace("Ï","i",$resultado);
			$resultado = str_replace("I","i",$resultado);
			$resultado = str_replace("î","i",$resultado);

			$resultado=str_replace("ó","o",$resultado);
			$resultado=str_replace("ò","o",$resultado);
			$resultado=str_replace("ö","o",$resultado);
			$resultado=str_replace("Ò","o",$resultado);
			$resultado = str_replace("Ó","o",$resultado);
			$resultado = str_replace("Ö","o",$resultado);
			$resultado = str_replace("O","o",$resultado);
			$resultado = str_replace("ô","o",$resultado);

			$resultado=str_replace("ú","u",$resultado);
			$resultado=str_replace("ù","u",$resultado);
			$resultado=str_replace("ü","u",$resultado);
			$resultado=str_replace("Ù","u",$resultado);
			$resultado = str_replace("Ú","u",$resultado);
			$resultado = str_replace("Ü","u",$resultado);
			$resultado = str_replace("U","u",$resultado);
			$resultado = str_replace("û","u",$resultado);

			$resultado=str_replace("²","2",$resultado);
			$resultado=str_replace("³","3",$resultado);
			$resultado=str_replace("ñ","n",$resultado);
			$resultado = str_replace("Ñ","n",$resultado);
			$resultado=str_replace("ß","b",$resultado);
			$resultado=str_replace("#","-",$resultado);
			$resultado = str_replace("?","",$resultado);
			$resultado = str_replace("@","",$resultado);

			$resultado = str_replace("(","",$resultado);
			$resultado = str_replace(")","",$resultado);
		break;
	}
	
	return $resultado;
}

// ********************** FUNCION PARA RECORTAR TEXTO

function RecortaStr ($string, $maxlen, $extra="")
    {
        if (strlen($string) >$maxlen)
            {
	$string = substr($string, 0, $maxlen);
	if ($extra!="") $string .= $extra;
            }
        return $string;
    }


function recortar($string, $stringini)
    {
        $posini = 0; $posfin = strpos ($string, $stringini);
        $longitud = ($posfin - $posini) + strlen($stringini);
        $string = substr_replace($string, '', $posini, $longitud);
        return $string;
    }

function recuperar ($buffer, $txtini, $txtfin)
    {
        if($txtini == "")
            {
	$posini = strpos ($buffer, $txtfin);
	$longitud = strlen($buffer) - $posini;
	$valor = substr_replace($buffer, '', $posini, $longitud);
            }
        else if($txtfin == "")
            {
	$posini = 0; $posfin = strpos ($buffer, $txtini);
	$longitud = strlen($buffer) - $posfin;
	$valor = substr_replace($buffer, '', $posini, $longitud);
            }
        else
            {
	$valor = "";
	if ((substr_count ("$buffer", "$txtini") != 0) && (substr_count ("$buffer", "$txtfin") != 0))
	    {
	        $array1 = explode($txtini, $buffer);
	        $array2 = explode($txtfin, $array1[1]);
	        $valor = $array2[0];
	    }
	else $valor = "";
            }
        return $valor;
    }


?>