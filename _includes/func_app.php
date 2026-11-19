<?php


function getNoticiasApp($idparroquia)
{
	global $urlOri, $conex;

	$sql = "SELECT id, titular, fecha, noticia, parroquia FROM noticias WHERE activar = 1 AND parroquia = $idparroquia ORDER BY fecha DESC LIMIT 5";
	$result = mysql_query($sql,$conex) or die (mysql_error());

	$devuelve = array();

	if(mysql_num_rows($result) > 0)
	{
		while($rw = mysql_fetch_assoc($result))
		{
			$urlNoti = trim($urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html");

			$titular = trim(addslashes(utf8_encode($rw['titular'])));

			$tieneFoto = getValue("SELECT foto FROM noticias_fotos WHERE idnoticia = ".$rw['id'],1);

			if($tieneFoto != "")
			{
				$foto = $urlOri."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;
				$urlFoto = $urlOri."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;

				$foto = "<div class=\"photo-article\"><img class=\"thumbnail\" src=\"".$foto."\" /></a></div>";

			}
			else{
				$foto = "";
				$urlFoto = "";
			}		

			switch(date('m',strtotime($rw['fecha'])))
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

			$fecha = date('d',strtotime($rw['fecha'])).' de '.$mes.' '.date('Y',strtotime($rw['fecha']));

			$devuelve['noticias'][] = array('fecha' => $fecha, 'foto' => utf8_encode($foto), 'defid' => intval($rw['id']), 'titular' => $titular, 'url_noticia' => utf8_encode($urlNoti), 'noticia' => strip_tags(stripslashes(RecortaStr($rw['noticia'], 250,'..'))));
		}
	}
	
	return $devuelve;

}

?>