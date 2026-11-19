<?php

function UR_exists($url){
	$headers=get_headers($url);
	return stripos($headers[0],"200 OK")?true:false;
 }

function getDonativosBotones($template=0){

	global $idparroquia, $conex;
      $sql = "SELECT * FROM donativos_urls WHERE parroquia = ".$idparroquia;
      $rs = mysql_query($sql,$conex) or die (mysql_error());

      $donativosHtml = "";
	  $styleExtra = "";
	  $linkStyle = "";

	  if($template == 1)
	  {
		$col = "12";
		$styleExtra = "style=\"text-align:center;\"";
	  }	  
	  else{
		  $col = "4";
		  $linkStyle = "style=\"font-size:16px;color:#333;\"";
	  }

      while($fila = mysql_fetch_assoc($rs)){
          if($fila['tipo'] == "bizum" && $fila['valor'] != ""){
            $donativosHtml .= "<div class=\"col-md-".$col."\" $styleExtra>\n";
			if($idparroquia == 376)
			{
				$bizumImg = "yappy_img";
			}
			else if($idparroquia == 1319){
				$bizumImg = "sinpe_img";
			}
			else if($idparroquia == 1110){
				$bizumImg = "pago_movil_padua";
			}
			else if($idparroquia == 1264 || $idparroquia == 1920){
				$bizumImg = "mercado_pago_jo";
			}
			else{
				$bizumImg = "bizum_img";
			}

			if($idparroquia == 1920) $donativosHtml .= "<img src=\"https://web.mintrared.com/images/donativos/$paypalImg\" /><br><a href=\"".$fila['valor']."\" class=\"btn btn-default\"  style=\"color:#fff !important;\" target=\"_blank\">Suscribirme</a></div>";
			else{

				$url = $fila['valor'];
				if(substr($fila['valor'], 0, 6) == "https:") $fila['valor'] = "<a href=\"".$fila['valor']."\" target=\"_blank\">".$fila['valor']."</a>";

				if(substr($url, 0, 6) == "https:") $donativosHtml .= "<a href=\"".$url."\" target=\"_blank\"><img src=\"https://web.mintrared.com/images/donativos/".$bizumImg.".png\" /></a><br>".$fila['valor'];
				else $donativosHtml .= "<img src=\"https://web.mintrared.com/images/donativos/".$bizumImg.".png\" /><br>".$fila['valor'];
				$donativosHtml .= "</div>\n";
			}

           
          }
          else if($fila['tipo'] == "transferencia" && $fila['valor'] != ""){

            $donativosHtml .= "<div class=\"col-md-".$col."\" $styleExtra>\n";
			if($idparroquia == 376) $transImg = "banco_general";
			else if($idparroquia == 1110) $transImg = "banco_mercantil_padua";
			else $transImg = "transferencia_img";
            $donativosHtml .= "<img src=\"https://web.mintrared.com/images/donativos/".$transImg.".png\" /><br>".$fila['valor'];
            $donativosHtml .= "</div>\n";
          }
          else if($fila['tipo'] == "paypal" && $fila['valor'] != ""){

			if($idparroquia == 851){
				$paypalImg = "banco_social.png";
			}
			else if($idparroquia == 1110){
				$paypalImg = "padua_otro_2.png";
			}
			else if($idparroquia == 1920) $paypalImg = "mercado_pago_jo.png";
			else $paypalImg = "paypal_img.png";

            $donativosHtml .= "<div class=\"col-md-".$col."\" $styleExtra>\n";
            if($idparroquia == 1110) $donativosHtml .= "<img src=\"https://web.mintrared.com/images/donativos/$paypalImg\" /><br>".$fila['valor']."";
			else if($idparroquia == 1920) $donativosHtml .= "<img src=\"https://web.mintrared.com/images/donativos/$paypalImg\" /></a><br><a href=\"".$fila['valor']."\" style=\"color:#fff !important;\" class=\"btn btn-default\" target=\"_blank\">Suscribirme</a>";
			else $donativosHtml .= "<a href=\"".$fila['valor']."\" target=\"_blank\"><img src=\"https://web.mintrared.com/images/donativos/$paypalImg\" /></a><br><a $linkStyle href=\"".$fila['valor']."\" target=\"_blank\">".$fila['valor']."</a>";
            $donativosHtml .= "</div>\n";
          }
      }

	  return $donativosHtml;
}

function getCurlData($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
}

function getDatosSeo($thisphp)
{
	global $conex, $idparroquia, $_GET;

	$valores = getValue("SELECT titulo, descripcion, titulo_logo, lat, lng, poblacion, diocesis FROM configuracion_base WHERE parroquia = $idparroquia",0);

	$seo = array();

	$seo['title'] = "";
	$seo['description'] = "";

	switch($thisphp)
	{
		case "noticia";

			if(isset($_GET['m']) && $_GET['m'] > 0)
			{
				$val = getValue("SELECT titular, noticia FROM noticias WHERE id = ".intval($_GET['m'])." AND parroquia = ".$idparroquia,0);

				$seo['title'] = $val[0]." - ".$valores[0];
				$seo['description'] = "Noticias de la ".$valores[0];
			}

		break;

		case "avisolegal";
			$seo['title'] = "Aviso legal - ".$valores[0];
		break;

		case "politica";
			$seo['title'] = "Política de Privacidad - ".$valores[0];
		break;

		case "noticias";

			if(isset($_GET['cat']) && $_GET['cat'] > 0)
			{
				$idcategoria = intval($_GET['cat']);

				$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = $idcategoria AND parroquia = ".$idparroquia,1);

				$seo['title'] = "Noticias en la categoría de ".$catTxt;
				$seo['description'] = "Archivo de noticias de la ".$valores[0];
			}

		break;

		case "estaticas";

			if(isset($_GET['m']) && $_GET['m'] > 0)
			{
				$idpagina = intval($_GET['m']); 

				$titulo = getValue("SELECT titulo FROM paginas WHERE id = $idpagina AND parroquia = $idparroquia",1);

				$seo['title'] = $titulo." - ".$valores[0];
				$seo['description'] = $titulo." - ".$valores[0];
			}

		break;

		case "galeria";

			if(isset($_GET['m']) && $_GET['m'] > 0)
			{
				$idgaleria = intval($_GET['m']);

				$titulo = getValue("SELECT categoria FROM galeria_categorias WHERE id = $idgaleria AND parroquia = $idparroquia LIMIT 1",1);

				$seo['title'] = $titulo." - ".$valores[0];
			}
			else{
				$seo['title'] = "Galería de imágenes - ".$valores[0];
				$seo['description'] = "Galería de imágenes - ".$valores[0];
			}

		break;

		case "eventos";

				if(!isset($_GET['dia'])) $dia = ""; else $dia = addslashes($_GET['dia']);
				if(!isset($_GET['mes'])) $mes = date('m'); else $mes = addslashes($_GET['mes']);
				if(!isset($_GET['anyo'])) $anyo = date('Y'); else $anyo = addslashes($_GET['anyo']);

				if($dia != "" && $mes != "" && $anyo != "") $fechaEvento = $dia."-".$mes."-".$anyo;

				if($fechaEvento != "") $seo['title'] = "Agenda de eventos para el día ".$fechaEvento;
				else $seo['title'] = "Agenda de eventos - ".$valores[0];

				$seo['description'] = "Agenda de eventos de ".$valores[0];

		break;

		case "liturgia"; case "oraciones";

				if(isset($_GET['mes']) && isset($_GET['anyo']) && isset($_GET['dia'])) $fecha = addslashes($_GET['dia'])."-".addslashes($_GET['mes'])."-".addslashes($_GET['anyo']);
				else $fecha = "";

				if($fecha != "") $extra = " para el día ".$fecha;
				else $extra = " - ".$valores[0];

				if(isset($_GET['only']) && $_GET['only'] != "")
				{

					switch($_GET['only'])
					{
						case "lectura"; 
							$seo['title'] = "Lectura diaria ".$extra;
							$seo['description'] = "Lectura diaria ".$extra;
						break;

						case "comentario";
							$seo['title'] = "Comentario diario ".$extra;
							$seo['description'] = "Comentario diario ".$extra;
						break;

						case "santoral";
							$seo['title'] = "Santoral ".$extra;
							$seo['description'] = "Santoral ".$extra;
						break;
						case "hoydomingo"; 
							if($idparroquia == 1)
							{
								$seo['title'] = "Hoy Domingo - ".$valores[0];
								$seo['description'] = "Hoy Domingo - ".$valores[0];
							}
							else{
								$seo['title'] = "Pr&oacute;ximo Domingo - ".$valores[0];
								$seo['description'] = "Pr&oacute;ximo Domingo - ".$valores[0];
							}
						break;
					}
				}
				else{
					$seo['title'] = "Oración y Liturgia de las horas ".$extra;
					$seo['description'] = "Oración y Liturgia ".$extra;
				}

		break;

		case "grupos";

			if($idparroquia == 233) $txtGrupos = "Pastoral Castrense";
			else if($idparroquia == 989) $txtGrupos = "Grupos y actividades"; 
			else if($idparroquia == 1011) $txtGrupos = "Actividad Pastoral";
			else $txtGrupos = "Grupos Parroquiales";

			if(isset($_GET['m']) && $_GET['m'] > 0)
			{
				$idgrupo = intval($_GET['m']);

				$val = getValue("SELECT nombre FROM grupos_pastorales WHERE id = $idgrupo AND parroquia = $idparroquia",0);

				$seo['title'] = $val[0]." - ".$valores[0];
				$seo['description'] = $val[0]." | ".$txtGrupos." de ".$valores[0];
			}
			else{
				if($idparroquia == 53) $txtG = "Apostolados Parroquiales"; 
				else if($idparroquia == 233) $txtG = "Pastoral Castrense";
				else if($idparroquia == 989) $txtG = "Grupos y actividades"; 
				else if($idparroquia == 1011) $txtG = "Actividad Pastoral";
				else $txtG = "Grupos Parroquiales";
				$seo['title'] = $txtG." - ".$valores[0];
				$seo['description'] = "Listado de ".$txtG." de ".$valores[0];
			}

		break;

		case "contacto";

			$seo['title'] = "Contacta con ".$valores[0];
			$seo['description'] = "Contacta con ".$valores[0];

		break;

		case "misas";
			$seo['title'] = "Misas en diferentes idiomas - ".$valores[0];
			$seo['description'] = "Encuentra las misas de todos los ciclos en los diferentes idiomas.";
		break;

		case "documentos";
			$seo['title'] = "Documentos para descargar - ".$valores[0];
			$seo['description'] = "Todos los documentos disponibles de ".$valores[0];
		break;

		case "especial";
			$seo['title'] = "Auxiliares Parroquiales de Cristo Sacerdote - ".$valores[0];
			$seo['description'] = "Auxiliares Parroquiales de Cristo Sacerdote - ".$valores[0];
		break;

		default: break;
	}

	return $seo;
}

function getEspecial()
{
	global $conex, $idparroquia, $_GET;

	$sql = "SELECT id, titulo, especial, arbol FROM paginas WHERE parroquia = $idparroquia AND activar = 1 AND especial = 1 ORDER BY id ASC";
	$rs = mysql_query($sql,$conex);

	$servicios = false;

	if(mysql_num_rows($rs) > 0)
	{

		$datos = "<ul style=\"margin-left:0px;\">\n";

		while($rw = mysql_fetch_assoc($rs))
		{
			$urlSeccion = $urlOri.limpiarCadena($rw['titulo'],'archivo')."/".$rw['id']."/";

			if($rw['id'] == 46) $datos .= "</ul><h2 style=\"font-size:18px;\">Escuela Infantil Ntra. Sra. de Montserrat</h2><ul>\n";

			if($rw['arbol'] == 1 && $servicios === false)
			{
				$datos .= "<li><b class=\"enlacee\" style=\"font-weight:normal;\">Servicios</b>\n
						<ul style=\"margin-left:0px;margin-top:15px;\">\n";
				$servicios = true;
			}

			$datos .= "<li><a href=\"$urlSeccion\" title=\"".$rw['titulo']."\">".$rw['titulo']."</a></li>\n";
		}

		$val = getValue("SELECT id, categoria FROM galeria_categorias WHERE parroquia = $idparroquia AND especial = 1 LIMIT 1",0);
		$nameGaleria = $val[1];
		$idGaleria = $val[0];

		$val = getValue("SELECT id, categoria FROM noticias_categorias WHERE parroquia = $idparroquia AND especial = 1 LIMIT 1",0);
		$nameNoti = $val[1];
		$idNoti = $val[0];

		$urlGaleria = $urlOri."galeria-".limpiarCadena($nameGaleria,'archivo')."_".$idGaleria.".html";
		$urlNoticias = $urlOri."categoria-".limpiarCadena($nameNoti,'archivo')."/".$idNoti."/";
		$urlContacto = $urlOri."contacto.html";

		$datos .= "</ul>\n
		</li>
		<li><a href=\"$urlGaleria\" title=\"Galería de Fotos\">Galería de fotos</a></li>\n
		<li><a href=\"$urlNoticias\" title=\"Noticias\">Noticias</a></li>\n
		<li><a href=\"$urlContacto\" title=\"Contacto\">Contacto</a></li>\n
		</ul>\n";

	}

	return $datos;
}

function getComentarios_plantilla2($idnoticia)
{
	global $conex, $idparroquia, $_GET;
	
	$permite = getValue("SELECT comentarios FROM configuracion_base WHERE parroquia = $idparroquia",1);

	if($permite == 1)
	{
		$sql = "SELECT * FROM comentarios_noticias WHERE noticia = $idnoticia AND parroquia = $idparroquia AND activar = 1 ORDER BY fecha DESC";
		$rs = mysql_query($sql,$conex);

		$devuelve = "";

		if(mysql_num_rows($rs) > 0)
		{

			if(mysql_num_rows($rs) == 1) $s = ""; else $s = "s";
			$devuelve .= "<h2>".mysql_num_rows($rs)." comentario".$s."</h2>";

			while($rw = mysql_fetch_assoc($rs))
			{

				$dia = date('d/m/Y',strtotime($rw['fecha']));
				$hora = date('G:i',strtotime($rw['fecha']));

				$devuelve .= "<div class=\"comentario\">
							<span class=\"escrito\">Escrito por <b>".$rw['nombre']."</b> el <b>".$dia."</b> a las <b>".$hora."</b></span>\n
							<p class=\"comm\">".$rw['comentario']."</p>
						</div>\n";
			}
		}

		if(isset($_GET['msg']))
		{
			switch($_GET['msg'])
			{
				case 1; $msg = "El código de seguridad introducido es incorrecto."; break;
				case 2; $msg = "Faltan campos obligatorios por rellenar"; break;
				case 3; $msg = "En breve se visualizara su comentario en pantalla. ¡Gracias por participar!"; break;
			}

			$msg = "<div style=\"font-weight:bold;color:#aa0000;margin-bottom:10px;display:block;\">$msg</div>";

		}

		$devuelve .= "<h2>Escribir un comentario</h2>

				$msg

				<form method=\"post\" action=\"dev_comentarios.php\" name=\"formComentario\" id=\"formComentario\">

					<div style=\"clear:both;\"></div>
					<div class=\"entry contacto\">
			
						<label class=\"labelcomentario\">Nombre <span>*</span>:</label>
						<p><input type=\"text\" class=\"input inputcomentario form-control\" name=\"nombre\" id=\"nombre\" value=\"\" /></p>

						<div style=\"clear:both;\"></div>
						<label class=\"labelcomentario\">Comentario <span>*</span>:</label>
						<p><textarea name=\"comentario\" class=\"form-control\" id=\"comentario\"></textarea></p>";


		if($idparroquia == 1319) $tex = "costarricense";
		else $tex = "española";

		$devuelve .= "<p style=\"margin:4px;padding:4px;text-align:justify;\">No se aceptan los comentarios ajenos al tema, sin sentido, repetidos o que contengan publicidad o spam. Tampoco comentarios insultantes, blasfemos o que inciten a la violencia, discriminación o a cualesquiera otros actos contrarios a la legislación ".$tex.", así como aquéllos que contengan ataques o insultos a los otros comentaristas. </p>
				<input type=\"hidden\" name=\"idparroquia\" id=\"idparroquia\" value=\"".$idparroquia."\" />
						<input type=\"hidden\" name=\"idnoticia\" id=\"idnoticia\" value=\"".$idnoticia."\" />
						<p>
		";
		
		//$devuelve .= "<input type=\"submit\" class=\"btn btn-success\" style=\"margin-top:10px;\" name=\"enviar\" id=\"enviar\" value=\"Enviar comentario\" />";
		
		$devuelve .= "<button class=\"g-recaptcha btn btn-success\" 
        data-sitekey=\"".getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1)."\" 
        data-callback=\"onSubmit\" style=\"margin-top:10px;\"
        data-action='submit'>Enviar comentario</button>";
		
		$devuelve .= "</p>

					</div>\n
					<a id=\"comentarios\"></a>		

			</form>\n";

		return $devuelve;

	}
	else return false;
}

function getComentarios($idnoticia)
{
	global $conex, $idparroquia, $_GET;
	
	$permite = getValue("SELECT comentarios FROM configuracion_base WHERE parroquia = $idparroquia",1);

	if($permite == 1)
	{
		$sql = "SELECT * FROM comentarios_noticias WHERE noticia = $idnoticia AND parroquia = $idparroquia AND activar = 1 ORDER BY fecha DESC";
		$rs = mysql_query($sql,$conex);

		$devuelve = "";

		if(mysql_num_rows($rs) > 0)
		{

			if(mysql_num_rows($rs) == 1) $s = ""; else $s = "s";
			$devuelve .= "<h2>".mysql_num_rows($rs)." comentario".$s."</h2>";

			while($rw = mysql_fetch_assoc($rs))
			{

				$dia = date('d/m/Y',strtotime($rw['fecha']));
				$hora = date('G:i',strtotime($rw['fecha']));

				$devuelve .= "<div class=\"comentario\">
							<span class=\"escrito\">Escrito por <b>".$rw['nombre']."</b> el <b>".$dia."</b> a las <b>".$hora."</b></span>\n
							<p class=\"comm\">".$rw['comentario']."</p>
						</div>\n";
			}
		}

		if(isset($_GET['msg']))
		{
			switch($_GET['msg'])
			{
				case 1; $msg = "El código de seguridad introducido es incorrecto."; break;
				case 2; $msg = "Faltan campos obligatorios por rellenar"; break;
				case 3; $msg = "En breve se visualizara su comentario en pantalla. ¡Gracias por participar!"; break;
			}

			$msg = "<div style=\"font-weight:bold;color:#aa0000;margin-bottom:10px;display:block;\">$msg</div>";

		}

		$devuelve .= "<h2>Escribir un comentario</h2>

				$msg

				<form method=\"post\" action=\"dev_comentarios.php\" name=\"formComentario\" id=\"formComentario\">

					<div style=\"clear:both;\"></div>
					<div class=\"entry contacto\">
			
						<label class=\"labelcomentario\">Nombre <span>*</span>:</label>
						<p><input type=\"text\" class=\"input inputcomentario form-control\" name=\"nombre\" id=\"nombre\" value=\"\" /></p>

						<div style=\"clear:both;\"></div>
						<label class=\"labelcomentario\">Comentario <span>*</span>:</label>
						<p><textarea name=\"comentario\" class=\"form-control\" id=\"comentario\"></textarea></p>";

							//$devuelve .= "<div class=\"g-recaptcha\" data-sitekey=\"".getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1)."\"></div>";


		if($idparroquia == 1319) $tex = "costarricense";
		else $tex = "española";

		$devuelve .= "<p style=\"margin:4px;padding:4px;text-align:justify;\">No se aceptan los comentarios ajenos al tema, sin sentido, repetidos o que contengan publicidad o spam. Tampoco comentarios insultantes, blasfemos o que inciten a la violencia, discriminación o a cualesquiera otros actos contrarios a la legislación ".$tex.", así como aquéllos que contengan ataques o insultos a los otros comentaristas. </p>
				<input type=\"hidden\" name=\"idparroquia\" id=\"idparroquia\" value=\"".$idparroquia."\" />
						<input type=\"hidden\" name=\"idnoticia\" id=\"idnoticia\" value=\"".$idnoticia."\" />
						<p>";
						
		
		//<input type=\"submit\" class=\"btn btn-success\" style=\"margin-top:10px;\" name=\"enviar\" id=\"enviar\" value=\"Enviar comentario\" /></p>
							
							$devuelve .= "<button class=\"g-recaptcha btn btn-success\" 
        data-sitekey=\"".getValue("SELECT clave_api FROM configuracion_base WHERE parroquia = '$idparroquia'",1)."\" 
        data-callback=\"onSubmit\" style=\"margin-top:10px;\"
        data-action='submit'>Enviar comentario</button>
		

					</div>\n
					<a id=\"comentarios\"></a>		

			</form>\n";

		return $devuelve;

	}
	else return false;
}

function getMisas($ciclo)
{
	global $conex, $urlOri, $urlRecursos;

	$ciclo = "Ciclo ".$ciclo;
	
	$cs = "SELECT categoria FROM doc_tmp WHERE ciclo = '$ciclo' GROUP BY categoria ORDER BY categoria ASC";
	$rs = mysql_query($cs,$conex);
	
	$resultado = "";

	while($rw = mysql_fetch_assoc($rs))
	{

		$resultado .= "<table width=\"435\" cellspacing=\"0\" cellpadding=\"0\" class=\"misas table table-bordered\" align=\"center\">\n";

		$categoria = $rw['categoria'];

		if($categoria == "ORDINARIO DE LA MISA")
		{
			$latin = "<td style=\"padding:0px;\">Latín</td>\n";
			$colspan = 11;
		}
		else
		{
			$latin = "";
			$colspan = 10;
		}

		$resultado .= "<tr>
					<th colspan=\"$colspan\" style=\"font-size:14px;\"><b>".$categoria."</b></th>\n
				</tr>\n";

		$resultado .= "<tr>\n
					$latin
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/de.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/es.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/cat.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/eus.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/fr.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/gal.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/nt.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/gb.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/it.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/pl.png\" /></td>\n
					<td style=\"padding:0px;\"><img src=\"".$urlOri."images/flags/pt.png\" /></td>\n
				</tr>\n";

		$cons = "SELECT DISTINCT(nombre) AS 'nombre' FROM doc_tmp WHERE ciclo = '$ciclo' AND categoria = '$categoria' ORDER BY nombre ASC";

		$resu = mysql_query($cons,$conex);

		while($fila = mysql_fetch_assoc($resu))
		{

			$documento = array();

			$nombre = $fila['nombre'];

			if($nombre == "ORDINARIO DE LA MISA")
			{
				$colspan = 11;
				$documento['latin'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'latin'",1);
			}
			else $colspan = 10;

			$documento['aleman'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'aleman'",1);
			$documento['castellano'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'castellano'",1);
			$documento['catalan'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'catalan'",1);
			$documento['euskera'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'euskera'",1);
			$documento['frances'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'frances'",1);
			$documento['gallego'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'gallego'",1);
			$documento['holandes'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'holandes'",1);
			$documento['ingles'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'ingles'",1);
			$documento['italiano'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'italiano'",1);
			$documento['polaco'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'polaco'",1);
			$documento['portugues'] = getValue("SELECT documento FROM doc_tmp WHERE ciclo = '$ciclo' AND nombre = '$nombre' AND idioma = 'portugues'",1);

			$docs = "";
			foreach($documento as $id=>$doc)
			{

				if($ciclo == "Ciclo B") $cic = "B/"; elseif($ciclo == "Ciclo C") $cic = "C/"; else $cic = "";

				if($doc != "") $da = "<a href=\"".$urlRecursos."documentos/misas/".trim($cic)."".trim(str_replace(" ","",$doc))."\" title=\"$nombre en ".ucfirst($id)."\" target=\"_blank\"><img src=\"".$urlOri."images/pdf.png\" style=\"border:none;\" class=\"lnktit\" /></a>"; else $da = "&nbsp;";
				$docs .= "<td style=\"padding:2px;\">".$da."</td>\n";
			}

			$resultado .= "<tr>
						<td style=\"font-size:12px;\" colspan=\"$colspan\"><b>".$fila['nombre']."</b></td>
					</tr>
					<tr>
						$docs
					</tr>\n";
		}

		$resultado .= "</table>\n";
	}

	return $resultado;

}

function getDestinos($idparroquia, $clase="input", $row=true)
{
	global $conex, $_SESSION;

	$sql = "SELECT id, nombre FROM contactos_destino WHERE parroquia = '$idparroquia' ORDER BY nombre ASC";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{
		$select ="<select name=\"destino\" id=\"destino\" style=\"background:#fff;\" class=\"$clase\">\n
					<option value=\"\">- Seleccione un destinatario -</option>\n";
						while($fila = mysql_fetch_assoc($rs))
						{
							$select .= "<option value=\"".$fila['id']."\">".$fila['nombre']."</option>\n";
						}	
				$select .= "</select>\n";

		if($row)
		{
			$datos = "<div class=\"row\">
							<div class=\"col-xs-4\"><label>Destino:</label></div>
							<div class=\"col-xs-8\">";
			$datos .= $select;
			$datos .= "</div></div>";
		}
		else{
						$datos = "<label>Destino:</label>";
			$datos .= $select;
		}
		return $datos;

	}
	else return false;
}

function punycode_to_unicode($input) {
	$prefix = 'xn--'; $safe_char = 0xFFFC;  $base = 36; $tmin = 1; $tmax = 26; $skew = 38; $damp = 700; $output_parts=array(); 

	$enco_parts=(array)explode('.',$input);  
	foreach ($enco_parts as $encoded) {	// loop through each part of a host domain,  ie. subdomain.subdomain.domain.tld

	if (strpos($encoded,$prefix)!==0 || strlen(trim(str_replace($prefix,'',$encoded)))==0) { $output_parts[]=$encoded; continue; }

	$is_first = true; $bias = 72; $idx = 0;  $char = 0x80; $decoded = array();	$output='';

	$delim_pos = strrpos($encoded, '-');
	if ($delim_pos > strlen($prefix)) { for ($k = strlen($prefix); $k < $delim_pos; ++$k) { $decoded[] = ord($encoded{$k}); } }
	$deco_len = count($decoded);
	$enco_len = strlen($encoded);

	for ($enco_idx = $delim_pos ? ($delim_pos + 1) : 0; $enco_idx < $enco_len; ++$deco_len) {        
		for ($old_idx = $idx, $w = 1, $k = $base; 1 ; $k += $base) {
			$cp = ord($encoded{$enco_idx++});
        			$digit = ($cp - 48 < 10) ? $cp - 22 : (($cp - 65 < 26) ? $cp - 65 : (($cp - 97 < 26) ? $cp - 97 : $base));
                		$idx += $digit * $w;
                		$t = ($k <= $bias) ? $tmin : (($k >= $bias + $tmax) ? $tmax : ($k - $bias));
                		if ($digit < $t) { break; }
                		$w = (int) ($w * ($base - $t));
            		}
		$delta = $idx - $old_idx;		
		$delta = intval($is_first ? ($delta / $damp) : ($delta / 2));
		$delta += intval($delta / ($deco_len + 1));
		for ($k = 0; $delta > (($base - $tmin) * $tmax) / 2; $k += $base) { $delta = intval($delta / ($base - $tmin)); }
		$bias = intval($k + ($base - $tmin + 1) * $delta / ($delta + $skew));
		$is_first = false;
		$char += (int) ($idx / ($deco_len + 1));
		$idx %= ($deco_len + 1);
		if ($deco_len > 0) { for ($i = $deco_len; $i > $idx; $i--) { $decoded[$i] = $decoded[($i - 1)]; } }
            		$decoded[$idx++] = $char;
        	}

        	foreach ($decoded as $k => $v) {
            		if ($v < 128) { $output .= chr($v); } // 7bit are transferred literally
		elseif ($v < (1 << 11)) { $output .= chr(192+($v >> 6)).chr(128+($v & 63)); } // 2 bytes
		elseif ($v < (1 << 16)) { $output .= chr(224+($v >> 12)).chr(128+(($v >> 6) & 63)).chr(128+($v & 63)); } // 3 bytes
		elseif ($v < (1 << 21)) { $output .= chr(240+($v >> 18)).chr(128+(($v >> 12) & 63)).chr(128+(($v >> 6) & 63)).chr(128+($v & 63)); } // 4 bytes
		else { $output .= $safe_char; } //  'Conversion from UCS-4 to UTF-8 failed: malformed input at byte '.$k
	}
	$output_parts[]=$output;
	
	}  // $enco_parts loop

	return implode('.',$output_parts);
}

function getAdjuntosGrupo($idgrupo)
{
	global $conex, $_SESSION, $idparroquia, $urlOri;

	$css = "SELECT * FROM grupos_adjuntos WHERE grupo = $idgrupo AND parroquia = $idparroquia ORDER BY fecha DESC";
	$rss = mysql_query($css,$conex) or die (mysql_error());

	if(mysql_num_rows($rss) > 0)
	{

		echo "<div style=\"clear:both;\"></div>\n";

		echo "<ul class=\"folder\">\n";
		echo "<span class=\"catego\">Documentos adjuntos</span>\n";

		while($fila = mysql_fetch_assoc($rss))
		{
			$urlDescarga = $urlOri."descarga.php?file=$idparroquia/grupos/".$fila['archivo'];
			echo "<li><a href=\"$urlDescarga\" title=\"Descargar número\">".$fila['nombre']."</a></li>\n";
			//<span class=\"desc\">Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."
		}

		echo "</ul>\n";

	}

}


function getAdjuntosSeccion($idgrupo)
{
	global $conex, $_SESSION, $idparroquia, $urlOri;

	$css = "SELECT * FROM secciones_adjuntos WHERE seccion = '$idgrupo' AND parroquia = $idparroquia ORDER BY id DESC";
	$rss = mysql_query($css,$conex) or die (mysql_error());

	if(mysql_num_rows($rss) > 0)
	{

		echo "<div style=\"clear:both;\"></div>\n";

		echo "<ul class=\"folder\">\n";
		echo "<span class=\"catego\">Documentos adjuntos</span>\n";

		while($fila = mysql_fetch_assoc($rss))
		{
			$urlDescarga = $urlOri."descarga.php?file=$idparroquia/noticias/".$fila['archivo'];
			echo "<li><a href=\"$urlDescarga\" title=\"Descargar\">".$fila['nombre']."</a></li>\n";
			//<span class=\"desc\">Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."
		}

		echo "</ul>\n";

	}

}


function getAdjuntosNoticia($idnoticia)
{
	global $conex, $_SESSION, $idparroquia, $urlOri;

	$css = "SELECT * FROM noticias_adjuntos WHERE noticia = $idnoticia AND parroquia = $idparroquia ORDER BY fecha DESC";
	$rss = mysql_query($css,$conex) or die (mysql_error());

	if(mysql_num_rows($rss) > 0)
	{

		echo "<div style=\"clear:both;\"></div>\n";

		echo "<ul class=\"folder\">\n";
		echo "<span class=\"catego\">Documentos adjuntos</span>\n";

		while($fila = mysql_fetch_assoc($rss))
		{
			$urlDescarga = $urlOri."descarga.php?file=$idparroquia/noticias/".$fila['archivo'];
			echo "<li><a href=\"$urlDescarga\" title=\"Descargar\">".$fila['nombre']."</a></li>\n";
			//<span class=\"desc\">Añadido el ".date('d/m/Y',strtotime($fila['fecha']))."
		}

		echo "</ul>\n";

	}

}

function getMes($mes)
{
	switch($mes)
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
	
	return $mes;

}

function getDocsPage($idparroquia)
{

	global $urlOri, $conex, $urlRecursos;

	$sqlWhereParroquia = " ( parroquia = 0 OR parroquia = $idparroquia) ";

	if($idparroquia == 65 || $idparroquia == 316) $sqlWhereParroquia = " ( parroquia = $idparroquia OR id = 5 ) ";

	$sqlWhere = "";
	
	//(OM) 07/08/2018 PARROQUIA SANTA MARÍA DE GUADALUPE quitar documentos por defecto
	if($idparroquia == 339) $sqlWhereParroquia = " parroquia = $idparroquia ";
	if($idparroquia == 1110 || $idparroquia == 1264 || $idparroquia == 1627) $sqlWhere = " AND id != 8";
	if($idparroquia == 2021) $sqlWhere = " AND id != 7 ";
	if($idparroquia == 587) $sqlWhere = " AND id != 8 AND id != 7 ";

	if($idparroquia == 1078) $sqlOrder = " orden_personalizado ASC, ";
	else if($idparroquia == 1131) $sqlOrder = " categoria ASC, nombre ASC, ";


	$sql = "SELECT id, nombre, categoria, descripcion, documento, url FROM documentos WHERE $sqlWhereParroquia $sqlWhere ORDER BY $sqlOrder categoria ASC, fecha DESC";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

	$antCat = "";
	$datos = "";

		/*$datos .= "<ul class=\"folder\"><span class=\"catego\">Lecturas de la misa en diferentes idiomas</span>\n";
		$datos .= "<li><a href=\"/misa-en-varios-idiomas/\">Ver documentos</a><span class=\"desc\">Misa en diferentes idiomas</span></li>\n";
		$datos .= "</ul>\n";*/

		while($fila = mysql_fetch_assoc($rs))
		{

			if($antCat == "")
			{

				$categoria = getValue("SELECT categoria FROM documentos_categorias WHERE id = ".$fila['categoria'],1);

				$datos .= "<ul class=\"folder\" id=\"cat-".$fila['categoria']."\"><span class=\"catego\">$categoria</span>\n";
			}	
			elseif($antCat != $fila['categoria'])
			{

				$categoria = getValue("SELECT categoria FROM documentos_categorias WHERE id = ".$fila['categoria'],1);

				$datos .= "</ul>
						<ul class=\"folder\" id=\"cat-".$fila['categoria']."\"><span class=\"catego\">$categoria</span>\n";
			}

			if($fila['url'] != "") $urlDoc = $fila['url']; else $urlDoc = $urlRecursos."descarga.php?file=".$fila['documento'];

			if(sacarExt($urlDoc) == ".pdf"){
				$datos .= "<li>".$fila['nombre'];
				if($fila['descripcion'] != "") $datos .= "<span class=\"desc\">".$fila['descripcion']."</span>";
				else $datos .= "<br>";
				$datos .= "<i class=\"fa fa-file-pdf-o\" style=\"color:#aa0000;\"></i> <a style=\"background:none;padding-left:0px;\" href=\"$urlDoc&ver=1\" target=\"_blank\">[ Ver ]</a> | <i class=\"fa fa-file-pdf-o\" style=\"color:#aa0000;\"></i> <a style=\"background:none;padding-left:0px;\" href=\"$urlDoc\" target=\"_blank\">[ Descargar ]</a>";
				$datos .= "</li>\n";
			}
			else $datos .= "<li><i class=\"fa fa-file\"></i> <a style=\"background:none;padding-left:0px;\"  href=\"$urlDoc\" target=\"_blank\">".$fila['nombre']."</a><span class=\"desc\">".$fila['descripcion']."</span></li>\n";

			$antCat = $fila['categoria'];

		}

		$datos .= "</ul>\n";

		$sql = "SELECT id, numero, archivo FROM revista_numeros WHERE parroquia = $idparroquia ORDER BY id DESC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{
			if($idparroquia == 24) $titleRevista = "Hoja Parroquial";
			else $titleRevista = "Revista Parroquial";

			$datos .= "<ul class=\"folder\"><span class=\"catego\">".$titleRevista."</span>\n";

			while($rw = mysql_fetch_assoc($rs))
			{

				if($rw['archivo'] != "") $urlDoc = $urlRecursos."descarga.php?file=uploads/".$idparroquia."/".$rw['archivo']; else $urlDoc = "";

				if(sacarExt($urlDoc) == ".pdf"){
					$datos .= "<li>".$rw['numero'];
					$datos .= "<br><i class=\"fa fa-file-pdf-o\" style=\"color:#aa0000;\"></i> <a style=\"background:none;padding-left:0px;\" href=\"$urlDoc&ver=1\" target=\"_blank\">[ Ver ]</a> | <i class=\"fa fa-file-pdf-o\" style=\"color:#aa0000;\"></i> <a style=\"background:none;padding-left:0px;\" href=\"$urlDoc\" target=\"_blank\">[ Descargar ]</a>";
					$datos .= "</li>\n";
				}
				else $datos .= "<li><i class=\"fa fa-file\"></i> <a style=\"background:none;padding-left:0px;\"  href=\"$urlDoc\" target=\"_blank\">".$rw['numero']."</a></li>\n";

				//$datos .= "<li><a href=\"$urlDoc\" target=\"_blank\">".$rw['numero']."</a></li>\n";
			}
		}

		$datos .= "</ul>\n";

		return $datos;

	}
	else return "<h2 align=\"center\" style=\"font-size:12px;margin:0;padding:0;\">No existen documentos a–adidos.</h3>";
}

function getDocumentos($idparroquia)
{
	global $urlOri,$conex;

	if($idparroquia == 65 || $idparroquia == 316) $sqlWhereParroquia = " ( parroquia = $idparroquia OR id = 5 ) ";
	else $sqlWhereParroquia = " ( parroquia = 0 OR parroquia = $idparroquia) ";

	$sqlWhere = "";
	if($idparroquia == 587) $sqlWhere = " AND id != 8 AND id != 7 ";
	else if($idparroquia == 2021) $sqlWhere = " AND id != 7 ";
	else if($idparroquia == 1627) $sqlWhere = " AND id != 8 ";


	$sql = "SELECT id, nombre, categoria, documento, url FROM documentos WHERE $sqlWhereParroquia $sqlWhere ORDER BY fecha DESC LIMIT 5";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$datos = "";

		while($rw = mysql_fetch_assoc($rs))
		{

			$categoria = getValue("SELECT categoria FROM documentos_categorias WHERE id = ".$rw['categoria'],1);

			if($rw['url'] != "") $urlDocumento = $rw['url']; else $urlDocumento = $urlOri."descarga.php?file=".$rw['documento'];

			$datos .= "<li class=\"documents\"><a href=\"$urlDocumento\" title=\"Descargar documento\" target=\"_blank\">".$rw['nombre']."</a></li>\n";
		}

		$datos .= "<li><a href=\"".$urlOri."documentos/\" style=\"text-align:center;\" title=\"Ver todos los documentos\"><b>Ver todos los documentos</b></a></li>\n";

		return $datos;

	}
	else return "<h3 align=\"center\" style=\"font-size:12px;margin:0;padding:0;\">No existen documentos añadidos.</h3>";
}

function getDatosSanto($idsanto)
{
	global $urlOri, $conex;

	$sql = "SELECT * FROM santos WHERE id = $idsanto";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$fila = mysql_fetch_assoc($rs);

		$datos = "<div class=\"post\"><h2 class=\"title\">".$fila['nombre_santo'].", ".$fila['tipo_santo']."</h2></div>\n";

		$dia = date('d',strtotime($fila['fecha']));
		$mes = date('m',strtotime($fila['fecha']));

		switch($mes)
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

		$fecha = $dia." de ".$mes;

		$datos .= "<div class=\"datosSanto\">
				<ul>
					<li>Fecha: <b>".$fecha."</b></li>\n
					<li>Nombre: <b>".$fila['nombre']."</b></li>\n
					<li>Muerte: <b>".$fila['muerte']."</b></li>\n
					<li>Género: <b>".$fila['genero']."</b></li>\n
				</ul>
			</div>";

		$datos .= "<div class=\"entry mapaa\" style=\"line-height:24px;text-align:justify;\">
				<b>".stripslashes($fila['texto'])."</b>
			</div>";

		return $datos;

	}
	else exit();
}

function getSantos($hoy)
{
	global $urlOri, $conex;

	$sql = "SELECT id, nombre, tipo_santo FROM santos WHERE fecha = '$hoy' GROUP BY nombre_santo ORDER BY nombre ASC";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$datos = "<ul class=\"santosUL\">\n";
		$conta = 0;

		while($rw = mysql_fetch_assoc($rs))
		{
			if($conta%2) $clase = "class=\"alterna\""; else $clase = "";

			$conta++;

			$urlSanto = $urlOri."santos/santo-".limpiarCadena(trim(str_replace(" ","",$rw['nombre'])),'archivo')."_".$rw['id'].".html";

			$datos .= "<li $clase><a href=\"$urlSanto\" title=\"Santo de ".$rw['nombre']."\">".stripslashes(trim($rw['nombre']))."</a>
					<span>".trim(stripslashes($rw['tipo_santo']))."</span></li>\n";
		}

		$datos .= "</ul>\n";

		return $datos;

	}
	else return "No existen santos hoy.";
}

function breadCumbs()
{
	global $conex, $urlOri, $idparroquia, $_GET, $thisphp, $nombreParroquia;

	$bread = "<div id=\"breadcumbs\">";
	$bread .= "<ul>\n";

			$bread .= "<li><a href=\"$urlOri\" title=\"$nombreParroquia\">Inicio</a></li>\n";

	switch($_GET['sec'])
	{

		case "noticias";

		if(isset($_GET['archivo']) && $_GET['archivo'] == 1 && isset($_GET['mes']) && isset($_GET['anyo']))
		{

					switch(addslashes($_GET['mes']))
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

			$namecat = $mes." de ".intval($_GET['anyo']);

			$urlNoticias = $urlOri."archivo/".addslashes($_GET['mes'])."/".addslashes($_GET['anyo'])."/";

			$bread .= "<li><a href=\"$urlNoticias\" title=\"Noticias\">Noticias de ".$namecat."</a></li>\n";
		}
		else{

			$namecat = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".intval($_GET['cat'])." AND parroquia = ".$idparroquia,1);
			$urlNoticias = $urlOri."categoria-".limpiarCadena($namecat,'archivo')."/".intval($_GET['cat'])."/";

			$bread .= "<li><a href=\"$urlNoticias\" title=\"Noticias\">Noticias de ".$namecat."</a></li>\n";

		}

		break;

		case "santos"; case "todo-santos";
			$bread .= "<li><a href=\"".$urlOri."santos/\" title=\"Santos\">Santos</a></li>\n";
		break;

		case "documentos";
			$bread .= "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>\n";
		break;

		case "galeria";
			$bread .= "<li><a href=\"".$urlOri."galeria-fotografica.html\" title=\"Galer&iacute;a fotogr&aacute;fica\">Galer&iacute;a fotogr&aacute;fica</a></li>\n";

			if(isset($_GET['m']) && $_GET['m'] > 0)
			{

				$idgaleria = intval($_GET['m']);
				$categoria = getValue("SELECT categoria FROM galeria_categorias WHERE id = ".intval($_GET['m']),1);

				$bread .= "<li><a href=\"".$urlOri."galeria-".limpiarCadena($categoria,'archivo')."_".$idgaleria.".html\" title=\"$categoria\">$categoria</a></li>\n";
			}

		break;

		case "liturgia";

			$bread .= "<li><a href=\"".$urlOri."liturgia.html\" title=\"Liturgia\">Liturgia</a></li>\n";

		break;

		case "eventos";

			$bread .= "<li><a href=\"".$urlOri."eventos.html\" title=\"Eventos de la Parroquia\">Eventos</a></li>\n";

			if(isset($_GET['act']) && $_GET['act'] == "viewevents")
			{

				$urlEventos = $urlOri."eventos/".intval($_GET['dia'])."-".intval($_GET['mes'])."-".intval($_GET['anyo'])."/";

				switch(intval($_GET['mes']))
				{
				case "01"; $mes = "enero"; break;
				case "02"; $mes = "febrero"; break;
				case "03"; $mes = "marzo"; break;
				case "04"; $mes = "abril"; break;
				case "05"; $mes = "mayo"; break;
				case "06"; $mes = "junio"; break;
				case "07"; $mes = "julio"; break;
				case "08"; $mes = "agosto"; break;
				case "09"; $mes = "septiembre"; break;
				case "10"; $mes = "octubre"; break;
				case "11"; $mes = "noviembre"; break;
				case "12"; $mes = "diciembre"; break;
				}

				$fechaAC = intval($_GET['dia'])." de ".$mes." del ".intval($_GET['anyo']);

				$bread .= "<li><a href=\"".$urlEventos."\" title=\"Eventos de la Parroquia\">$fechaAC</a></li>\n";
			}


		break;

		case "noticia";

			$sql = "SELECT id, titular, categoria FROM noticias WHERE id = ".intval($_GET['m'])." AND parroquia = ".$idparroquia;
			$rs = mysql_query($sql,$conex);

			$fila = mysql_fetch_assoc($rs);

			$namecat = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".intval($fila['categoria'])." AND parroquia = ".$idparroquia,1);
			$urlNoticias = $urlOri."categoria-".limpiarCadena($namecat,'archivo')."/".intval($fila['categoria'])."/";

			$urlNoticia = $urlOri.limpiarCadena($fila['titular'],'archivo')."-".$fila['id'].".html";

			$bread .= "<li><a href=\"$urlNoticias\" title=\"Noticias\">".$namecat."</a></li>\n";
			$bread .= "<li><a href=\"$urlNoticia\" title=\"".$fila['titular']."\">".$fila['titular']."</a></li>\n";

		break;

		case "estaticas";

			$sql = "SELECT id, titulo FROM paginas WHERE id = ".intval($_GET['m'])." AND parroquia = ".$idparroquia;
			$rs = mysql_query($sql,$conex);

			$fila = mysql_fetch_assoc($rs);

			$urlPagina = $urlOri.limpiarCadena($fila['titulo'],'archivo')."/".$fila['id']."/";

			$bread .= "<li><a href=\"$urlPagina\" title=\"".$fila['titulo']."\">".$fila['titulo']."</a></li>\n";

		break;

	}

	$bread .= "</ul>\n";
	$bread .= "</div>\n";

	return $bread;
}

function getGaleria($idparroquia, $idgaleria)
{
	global $conex, $urlOri, $_GET;

	// SACAMOS DATOS DE LA GALERÍA

	$sqlWhere = " AND g.categoria = ".intval($idgaleria)." ";

	$sql = "SELECT g.* FROM galeria_fotos g WHERE g.parroquia = ".$idparroquia." $sqlWhere ORDER BY orden ASC ";
	$rs = mysql_query($sql,$conex) or die (mysql_error());

	return $rs;
}

function allGroups($icono='')
{
	global $conex, $urlOri, $_GET, $idparroquia;
		
	if($idparroquia == 73) $sqlOrder = " ORDER BY `categoria` DESC ";
	else $sqlOrder = " ORDER BY `categoria` ASC ";

		$sql = "SELECT DISTINCT(categoria) AS 'categoria' FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria > 0 $sqlOrder ";
		$rs = mysql_query($sql,$conex);

		if($icono != "") $icono = "<i class=\"fa ".$icono."\"></i> ";
		else $icono = "";

		$relacionJaen = array(1321 => array(1851, 1850, 1849, 1196),
		1262 => array(1745, 1746, 1747, 1168),
		1268 => array(1748, 1749, 1750, 1169),
		1272 => array(1751, 1752, 1753, 1170),
		1267 => array(1754, 1755, 1756, 1171),
		1263 => array(1757, 1758, 1759, 1172),
		1271 => array(1760, 1761, 1762, 1173),
		1264 => array(1763, 1764, 1765, 1174),
		1266 => array(1766, 1767, 1768, 1175),
		1270 => array(1769, 1770, 1771, 1176),
		1265 => array(1772, 1773, 1774, 1177),
		1269 => array(1775, 1776, 1777, 1178));

		if(mysql_num_rows($rs) > 0)
		{

			$datos = "<ul class=\"grupos\">\n";

			while($fila = mysql_fetch_assoc($rs))
			{

				$datos .= "<li>".$icono.getValue("SELECT grupo FROM grupos_categorias WHERE id = ".$fila['categoria'],1)."
					<ul class=\"submenu\">";

				$css = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria = ".$fila['categoria']." ORDER BY nombre ASC";
				$rss = mysql_query($css,$conex);

				while($rw = mysql_fetch_assoc($rss))
				{
					$datos .= "<li>".$icono."<a href=\"".$urlOri."grupos/".limpiarCadena($rw['nombre'],'archivo')."_".$rw['id'].".html\">".$rw['nombre']."</a></li>\n";
					if($idparroquia == 1013){

						$urlHistoria = $urlOri."historia/".$relacionJaen[$rw['id']][0]."/";
						$urlGaleria = $urlOri."galeria-".limpiarCadena($rw['nombre'], 'archivo')."_".$relacionJaen[$rw['id']][3].".html";
						$urlAgenda = $urlOri."agenda-cofrade/".$relacionJaen[$rw['id']][1]."/";
						$urlActividades = $urlOri."actividades-eventos/".$relacionJaen[$rw['id']][2]."/";

						$datos .= "<ul>";
							$datos .= "<li>".$icono."<a href=\"".$urlHistoria."\">Historia</a></li>\n";
							$datos .= "<li>".$icono."<a href=\"".$urlGaleria."\">Galería de imágenes</a></li>\n";
							$datos .= "<li>".$icono."<a href=\"".$urlAgenda."\">Agenda Cofrade</a></li>\n";
							$datos .= "<li>".$icono."<a href=\"".$urlActividades."\">Actividades y Eventos</a></li>\n";
						$datos .= "</ul>";
					}
				}

				$datos .= "</ul></li>\n";
			}

				$datos .= "</ul>\n";


		}

		if($idparroquia == 73) $sqlOrder = " ORDER BY `nombre` DESC ";
		else $sqlOrder = " ORDER BY `nombre` ASC ";
		
		$sql = "SELECT id, nombre FROM grupos_pastorales WHERE parroquia = $idparroquia AND categoria = 0 $sqlOrder";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{
			$datos .= "<ul class=\"grupos\">\n";

			while($fila = mysql_fetch_assoc($rs))
			{
				$datos .= "<li>".$icono."<a href=\"".$urlOri."grupos/".limpiarCadena($fila['nombre'],'archivo')."_".$fila['id'].".html\">".$fila['nombre']."</a></li>\n";
			}
			$datos .= "</ul>\n";
		}

	return $datos;

}

function getGalerias($idparroquia)
{
	global $conex, $urlOri, $_GET;

	// SACAMOS DATOS DE LAS GALERÍAS

	$sqlWhere = "";

	$sql = "SELECT g.* FROM galeria_categorias g WHERE g.parroquia = ".$idparroquia." $sqlWhere ORDER BY g.fecha DESC ";
	$rs = mysql_query($sql,$conex) or die (mysql_error());

	return $rs;
}

function getGrupos($idparroquia, $idpagina)
{
	global $conex, $urlOri, $_GET;

	// SACAMOS DATOS DE LA PÁGINA ESTÁTICA

	$sqlWhere = "";

	if($idpagina > 0) $sqlWhere .= " AND p.id = ".intval($idpagina)." ";

	$sql = "SELECT p.* FROM grupos_pastorales p WHERE p.parroquia = ".$idparroquia." $sqlWhere ORDER BY p.nombre ASC";
	$rs = mysql_query($sql,$conex) or die (mysql_error());

	return $rs;
}


function getEstatica($idparroquia, $idpagina)
{
	global $conex, $urlOri, $_GET;

	// SACAMOS DATOS DE LA PÁGINA ESTÁTICA

	$sqlWhere = "";

	if($idpagina > 0) $sqlWhere .= " AND p.id = ".intval($idpagina)." ";

	$sql = "SELECT p.* FROM paginas p WHERE p.activar = 1 AND p.parroquia = ".$idparroquia." $sqlWhere ";
	$rs = mysql_query($sql,$conex) or die (mysql_error());

	return $rs;
}

function dameBucle($idparroquia, $numList=4, $idnoticia=0, $idcategoria=0,$mes="",$anyo="", $zona="")
{
	global $conex, $urlOri, $_GET, $idparroquia, $_SERVER;

	// SACAMOS LISTADO DE NOTICIAS

	$sqlWhere = "";

	$subtitle = "";

	if($idparroquia == 989 && $idcategoria == 0) $sqlWhere .= " AND n.categoria != 909 ";

	if($idnoticia > 0) $sqlWhere .= " AND n.id = ".intval($idnoticia)." ";
	if($idcategoria > 0)
	{
		$sqlWhere .= " AND n.categoria = ".intval($idcategoria)." ";
		$subtitle = "Archivo de la categoría ".getValue("SELECT categoria FROM noticias_categorias WHERE id = $idcategoria",1);
	}
	else if($zona != "single") $sqlWhere .= " AND n.categoria != 39 ";
	
	if($idparroquia == 538 && $idcategoria == 0 && $zona != "single") $sqlWhere .= " AND n.categoria != 376 AND n.categoria != 377 AND n.categoria != 380";
	else if($idparroquia == 14 && $idcategoria == 0 && $zona != "single") $sqlWhere .= " AND n.categoria != 399 ";

	if($mes != "") $sqlWhere .= " AND mes = '$mes' ";
	if($anyo != "") $sqlWhere .= " AND anyo = '$anyo' ";

	$hoy = date('Y-m-d ');

	$sqlWhere .= " AND fecha <= '".$hoy." 23:59:59' ";

	$numRes = getValue("SELECT COUNT(n.id) FROM noticias n WHERE n.parroquia = $idparroquia AND n.activar = 1 $sqlWhere ORDER BY n.fijada DESC, n.fecha DESC, n.id DESC",1);

	$maxPags = 9;

	if (isset($_GET['pg']) && intval($_GET['pg']) > 0) $pg = $_GET['pg']; else $pg = 1;

	$nPags = ceil ( $numRes / $numList );
	$sqlLimit = " LIMIT ".($numList*($pg-1)).", $numList";

	$sql = "SELECT n.* FROM noticias n WHERE n.parroquia = $idparroquia AND n.activar = 1 $sqlWhere ORDER BY n.fijada DESC, n.fecha DESC, n.id DESC $sqlLimit";

	$rs = mysql_query($sql,$conex) or die (mysql_error());

	$rs = array($rs,$numRes,$nPags, $pg, $subtitle);

	return $rs;
}


function getNumerosRevista($idparroquia, $destino_pagina=0)
{
	global $idparroquia, $conex, $urlOri, $urlRecursos;

		$sql = "SELECT id, numero, archivo FROM revista_numeros WHERE parroquia = $idparroquia AND destino_pagina = 0 ORDER BY fecha DESC, id DESC LIMIT 5 ";
		$result = mysql_query($sql,$conex);

		if($destino_pagina == 0)
		{
			$idP = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = ".$idparroquia,0);
			$nP = $idP[1];
			$idP = $idP[0];
			
			$devuelve = "<ul>
				<li><a href=\"".$urlOri."revista-parroquial/".$idP."\">".$nP."</a>
				<ul>\n";
		}
		else $devuelve = "<ul><li>Documentos adjuntos:</ul>\n";

		if(mysql_num_rows($result) > 0)
		{
			while($rw = mysql_fetch_assoc($result))
			{
				$urlDescarga = $urlRecursos."descarga.php?file=uploads/$idparroquia/".$rw['archivo'];

				$titCorto = $rw['numero'];

				$devuelve .= "<li class=\"cat-item\"><a href=\"$urlDescarga\" title=\"$titCorto\">".$titCorto."</a></li>\n";
			}

			$devuelve .= "</ul></li><li><a href=\"".$urlOri."revista-parroquial/".getValue("SELECT id FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = ".$idparroquia,1)."\">Ver todos los n&uacute;meros</a></li></ul>\n";


			return $devuelve;

		}
		else return "<li><b>No existen números</b></li>\n";
}


function getNoticias($tipo, $diocesis=false,$tipo=0)
{
	global $idparroquia, $conex, $urlOri;

	$arrayTipos = array();

	if($diocesis)
	{

		$diocesisParroquia = getValue("SELECT diocesis_id FROM configuracion_base WHERE parroquia = $idparroquia",1);

		if($idparroquia == 1462) $diocesisParroquia = 9910;

		$sql = "SELECT id, titular, fecha, url_ori FROM adt_noticias WHERE activar = 1 AND diocesis = $diocesisParroquia ORDER BY fecha DESC, id DESC LIMIT 4";
		$result = mysql_query($sql,$conex);

		$devuelve = "";

		if(mysql_num_rows($result) > 0)
		{
			while($rw = mysql_fetch_assoc($result))
			{
				$urlNoti = $rw['url_ori'];

				//$titCorto = RecortaStr($rw['titular'],70,'..');
				$titCorto = $rw['titular'];

				$devuelve .= "<li class=\"cat-item\"><a href=\"$urlNoti\" title=\"$titCorto\" target=\"_blank\">".$titCorto."</a></li>\n";
				$arrayTipos[] = array('titular' => $titCorto, 'url' => $urlNoti, 'fecha' => $rw['fecha']);
			}

			if($tipo == 1) return $arrayTipos;
			else return $devuelve;

		}
		else{
			if($tipo == 1) return array();
			else return "<li><b>No existen Noticias</b></li>\n";
		}
	}
	else{
		//(OM) Añadir fecha <= NOW()
		$sql = "SELECT id, titular, fecha FROM noticias WHERE activar = 1 AND parroquia = $idparroquia and fecha <= NOW() ORDER BY fijada DESC, fecha DESC, id DESC LIMIT 5";
		$result = mysql_query($sql,$conex);

		$devuelve = "";

		if(mysql_num_rows($result) > 0)
		{
			while($rw = mysql_fetch_assoc($result))
			{
				$urlNoti = $urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html";

				$titCorto = $rw['titular'];

				$devuelve .= "<li class=\"cat-item\"><a href=\"$urlNoti\" title=\"$titCorto\">".$titCorto."</a></li>\n";
				$arrayTipos[] = array('titular' => $titCorto, 'url' => $urlNoti, 'fecha' => $rw['fecha']);
			}

			if($tipo == 1) return $arrayTipos;
			else return $devuelve;

		}
		else{
			if($tipo == 1) return array();
			else return "<li><b>No existen Noticias</b></li>\n";
		} 
	}
}

function getEventos($dia,$mes,$anyo)
{
	global $conex, $urlOri, $_SESSION, $idparroquia, $coloresEventos;

	if($dia != "")
	{

		$fecha = $anyo."-".$mes."-".$dia;
		$diaMin = $fecha." 00:00:00";
		$diaMax = $fecha." 23:59:59";
	}
	else{

		$fecha = $anyo."-".$mes;
		$diaMin = $fecha."-01 00:00:00";
		$diaMax = $fecha."-31 23:59:59";
	}

	//$sql = "SELECT * FROM jqcalendar WHERE StartTime >= '$diaMin' AND EndTime <= '$diaMax' AND parroquia = ".$idparroquia." ORDER BY StartTime ASC";
	$sql = "SELECT * FROM jqcalendar WHERE ((StartTime BETWEEN '$diaMin' AND '$diaMax') OR (EndTime BETWEEN '$diaMin' AND '$diaMax')) AND parroquia = '$idparroquia' ORDER BY StartTime ASC";
	$rs = mysql_query($sql,$conex) or die (mysql_error());

	if(mysql_num_rows($rs) > 0)
	{

		$eventos = "";

		while($rw = mysql_fetch_assoc($rs))
		{

		$horaEvento = date('G:i',strtotime($rw['StartTime']));
		$diaEvento = date('d/m/Y',strtotime($rw['StartTime']));

			if($horaEvento == "0:00") $horaEvento = "Todo el día";

			if($rw['StartTime'] != $rw['EndTime']){
				$desde = date('d/m/Y',strtotime($rw['StartTime']));
				$hasta = date('d/m/Y',strtotime($rw['EndTime']));
				$dia = "<div class=\"diaEvento\">Desde: <b>".$desde."</b> hasta <b>".$hasta."</b></div>";
			}else{
				$dia = "<div class=\"diaEvento\">Día: <b>".$diaEvento."</b></div>";
			}

			if($idparroquia == 1131){
				if($rw['Color'] != ""){
					$color = $coloresEventos[$rw['Color']];
					$claseExtra = " style=\"padding:5px;background:".$color."\"";
				}
				else $claseExtra = "";
			}
			else $claseExtra = "";

			$eventos .= "<div class=\"evento\" $claseExtra>
						<div class=\"nombreEvento\"><b>".utf8_decode($rw['Subject'])."</b></div>
						<div class=\"lugarEvento\">Lugar: <b>".utf8_decode($rw['Location'])."</b></div>
						".$dia."
						<div class=\"horaEvento\">Hora: <b>".$horaEvento."</b></div>
						<div class=\"descEvento\">Más información: <p>".utf8_decode(stripslashes($rw['Description']))."</p></div>
					</div>";
		}

		return $eventos;

	}
	else return "<h2 align=\"center\" style=\"font-weight:normal;margin-top:10px;\">No existen eventos programados.</h2>";
}

function getBienvenida()
{
	global $idparroquia, $conex;

	$cs = "SELECT * FROM bloque_bienvenida WHERE parroquia = $idparroquia";
	$rs = mysql_query($cs,$conex);

	if(mysql_num_rows($rs) > 0)
	{
		$fila = mysql_fetch_assoc($rs);

		$titulo = stripslashes(strip_tags($fila['titulo']));
		$texto = stripslashes($fila['texto']);

		$post = "<div class=\"post bienvenida\">
				<h1 class=\"title\">".$titulo."</h1>
				<p class=\"byline\">&nbsp;</p>
				<div class=\"entry\" style=\"font-size:12px;\">
					<p>".$texto."</p>
				</div>
			</div>";

		return $post;
	}
	else return false;
}

function getPaginas($idparroquia)
{

	global $conex, $urlOri;

	if($idparroquia == 0) exit();

	$sql = "SELECT * FROM paginas WHERE parroquia = $idparroquia AND activar = 1 ORDER BY titulo ASC";
	$result = mysql_query($sql,$conex);

	$devuelve = "";

	if(mysql_num_rows($result))
	{

		while($rw = mysql_fetch_assoc($result))
		{
			$urlPag = $urlOri.limpiarCadena($rw['titulo'],'archivo')."/".$rw['id']."/";

			$devuelve .= "<li><a href=\"$urlPag\" title=\"Ir a la sección de ".$rw['titulo']."\">".$rw['titulo']."</a></li>\n";
		}

		return $devuelve;

	}
	else return "<li><b>No existen páginas creadas</b></li>\n";
}

function getCategorias($idparroquia)
{

	global $conex, $urlOri;

	if($idparroquia == 0) exit();

	$sql = "SELECT * FROM noticias_categorias WHERE parroquia = $idparroquia AND activar = 1 ORDER BY categoria ASC";
	$result = mysql_query($sql,$conex);

	$devuelve = "";

	if(mysql_num_rows($result))
	{

		while($rw = mysql_fetch_assoc($result))
		{
			$urlCat = $urlOri."categoria-".limpiarCadena($rw['categoria'],'archivo')."/".$rw['id']."/";

			$devuelve .= "<li class=\"cat-item\"><a href=\"$urlCat\" title=\"Noticias en la categoría de ".$rw['categoria']."\">".$rw['categoria']." (".getValue("SELECT COUNT(id) FROM noticias WHERE categoria = ".$rw['id']." AND parroquia = ".$idparroquia." AND activar = 1",1).")</a></li>\n";
		}

		return $devuelve;

	}
	else return "<li><b>No existen Categorías creadas</b></li>\n";
}

function getLinks($idparroquia)
{
	global $conex;

	$sql = "SELECT * FROM enlaces_amigos WHERE parroquia = $idparroquia AND activar = 1 ORDER BY orden ASC";
	$result = mysql_query($sql,$conex) or die (mysql_error());

	$links = "";

	if(mysql_num_rows($result) > 0)
	{
		while($fila = mysql_fetch_assoc($result))
		{

			if(substr_count($fila['enlace'], "http://") == 0 && substr_count($fila['enlace'], 'https://') == 0) $link = "http://".$fila['enlace']; else $link = $fila['enlace'];

			$links .= "<li><a href=\"$link\" target=\"_blank\" title=\"".$fila['texto']."\">".$fila['texto']."</a></li>\n";
		}

		return $links;

	}
	else return "<li><b>No existen enlaces amigos</b></li>\n";
}

function getBuscador()
{
	global $conex;

	$devuelve = "<li>
				<form id=\"searchform\" method=\"get\" action=\"#\">
						<input type=\"text\" name=\"s\" id=\"s\" style=\"width:130px;float:left;\" value=\"Buscador...\" onclick=\"if(this.value=='Buscador...') this.value = '';\" />
						<input type=\"submit\" class=\"buscar\" value=\"\" />
				</form>
				<div style=\"clear:both;\"></div>
			</li>";

	return $devuelve;
}

function getArrayEventos($mes=0, $anyo=0)
{
	global $conex, $urlOri, $idparroquia;

	if($mes > 0)
	{

		$diaMin = $anyo."-".$mes."-01 00:00:00";
		$diaMax = $anyo."-".$mes."-31 23:59:59";

		//$sql = "SELECT * FROM jqcalendar WHERE parroquia = $idparroquia AND StartTime >= '$diaMin' AND StartTime <= '$diaMax' AND visible = 1 ORDER BY StartTime ASC";
		$sql = "SELECT * FROM jqcalendar WHERE ((StartTime BETWEEN '$diaMin' AND '$diaMax') OR (EndTime BETWEEN '$diaMin' AND '$diaMax')) AND parroquia = '$idparroquia' AND visible = 1 ORDER BY StartTime ASC";
		$rs = mysql_query($sql,$conex);

		if(mysql_num_rows($rs) > 0)
		{
			while($rw = mysql_fetch_assoc($rs))
			{

				$dia = date('d',strtotime($rw['StartTime']));

				if($dia >= "01" && $dia <= "09") $dia = str_replace(0,'',$dia);

				if(isset($days[$dia][2]) && $days[$dia][2] != "")
				{
					$horaEvento = date('G:i',strtotime($rw['StartTime']));

					if($horaEvento == "0:00") $horaEvento = "Todo el día"; else $horaEvento = $horaEvento."  horas"; 

					$contenido = "<hr />Evento: ".utf8_decode(stripslashes($rw['Subject']))."<br />Hora: $horaEvento<br />Lugar: ".utf8_decode(stripslashes($rw['Location']))."";

					$contenido = $days[$dia][2].$contenido;

					$days[$dia][2] = $contenido;
				}
				else{

					$horaEvento = date('G:i',strtotime($rw['StartTime']));

					if($horaEvento == "0:00") $horaEvento = "Todo el día"; else $horaEvento = $horaEvento."  horas"; 

					$contenido = "Evento: ".utf8_decode(stripslashes($rw['Subject']))."<br />Hora: $horaEvento<br />Lugar: ".utf8_decode(stripslashes($rw['Location']))."";

					$url = $urlOri."eventos/$dia-$mes-$anyo/";

					$arrayDatos = array($url,"linked-day",$contenido);

					$days[$dia] = $arrayDatos;
				}
			}
		}
		else $days = array();

		return $days;

	}
	else return false;
}

function proximosEventos($limite)
{

	global $conex, $urlOri, $idparroquia;

	$ahora = date('Y-m-d G:i:s');
	$despues = $ahora;

	if($idparroquia == 1017){
		$despues = date("Y-m-d G:i:s",strtotime($ahora."+ 5 days")); 
	}
	//  

	$sql = "SELECT * FROM jqcalendar WHERE parroquia = ".$idparroquia." AND (StartTime >= '$ahora' OR EndTime >= '$despues') ORDER BY StartTime ASC";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$datos = "<div id=\"events\">";

		while($rw = mysql_fetch_assoc($rs))
		{

		$hora = date('G:i',strtotime($rw['StartTime']));

		if($hora != "" && $hora != "0:00") $hora = "<div class=\"hora\">".$hora." horas</div>"; else $hora = "";

		$dia = date('d',strtotime($rw['StartTime']));
		$anyo = date('Y',strtotime($rw['StartTime']));
		$mes = getMes(date('m',strtotime($rw['StartTime'])));


		$diaSemana = date('D',strtotime($rw['StartTime']));

		switch($diaSemana)
		{
			case "Mon"; $diaSemana = "Lunes"; break;
			case "Tue"; $diaSemana = "Martes"; break;
			case "Wed"; $diaSemana = "Miércoles"; break;
			case "Thu"; $diaSemana = "Jueves"; break;
			case "Fri"; $diaSemana = "Viernes"; break;
			case "Sat"; $diaSemana = "Sábado"; break;
			case "Sun"; $diaSemana = "Domingo"; break;
			default: break;
		}

		$datos .= "<div class=\"evento-proximo\">
			<div class=\"tituloEvento\">".utf8_decode($rw['Subject'])."</div>
			<div class=\"dia\">$diaSemana,  ".$dia." de ".$mes." de ".$anyo."</div>
			<div class=\"lugar\">".utf8_decode($rw['Location'])."</div>
			$hora
			</div>";


		}

		$datos .= "</div>";

	}
	else $datos = false;


	return $datos;
}

function getBloques($zona, $tipo=1)
{
	global $conex, $idparroquia, $urlOri, $urlRecursos;

	$sql = "SELECT * FROM bloques WHERE parroquia = $idparroquia AND parte = '$zona' and activar=1 ORDER BY orden ASC";
	$result = mysql_query($sql,$conex);

	$devuelve = "";

	if(mysql_num_rows($result) > 0)
	{

		while($fila = mysql_fetch_assoc($result))
		{

		if($fila['bloque'] != "revista_parroquial" || getValue("SELECT activar FROM paginas WHERE txt_int = 'revista_parroquial' AND parroquia = $idparroquia",1) == 1)
		{

			if($fila['bloque'] == "rincon_lectura") $fila['titulo_bloque'] = "Noticias";

			if($tipo == 1)
			{
				$devuelve .= "<li>
					<h2>".$fila['titulo_bloque']."</h2>\n
					<ul>";
			}
			elseif($tipo == 3)
			{
				$devuelve .= "<div class=\"widget sidebar-widget mw-widget-recent-posts\">
				<div class=\"widget-unboxed has-head\">
					<div class=\"widget-head\"><h3>".$fila['titulo_bloque']."</h3></div>
						<div class=\"widget-body\">
							<ul class=\"mw-widget-recent-posts-list with-thumbnails\">";
			}
			elseif($tipo == 4)
			{
				$devuelve .= "<div class=\"bloque\">
					<div class=\"icono ".$fila['bloque']."\"><i>".$fila['titulo_bloque']."</i></div>
					
					<div class=\"content-bloque\">";

			}
			elseif($tipo == 5)
			{
				$devuelve .= "<div class=\"bloque\">
					<div class=\"icono ".$fila['bloque']."\">".$fila['titulo_bloque']."</div>
					
					<div class=\"content-bloque\">";
			}
			else{
				$devuelve .= "<div id=\"widget_".$fila['bloque']."\" class=\"widget\">
							<h3>".$fila['titulo_bloque']."</h3>
					<ul>";
			}

			switch($fila['bloque'])
			{
				case "ultimos_documentos";
					if($tipo == 4 || $tipo == 5) $devuelve .= "<ul class=\"listado\">\n";
					$devuelve .= getDocumentos($idparroquia);
					if($tipo == 4 || $tipo == 5) $devuelve .= "</ul>\n";
				break;

				case "ultimas_noticias_diocesis";
					if($tipo == 4 || $tipo == 5) $devuelve .= "<ul class=\"listado\">\n";

					$devuelve .= getNoticias("ultimas", true);

					if($tipo == 4 || $tipo == 5) $devuelve .= "</ul>\n";
				break;

				case "contador_visitas";

					$mysqlUser = "gestion_user";
					$mysqlPwd = "ges569";
					$dbname = "gestion";
					$conexGestion = mysql_connect('localhost', $mysqlUser, $mysqlPwd);
					mysql_select_db($dbname,$conexGestion);

					$rs = mysql_query("SELECT SUM(visitas) FROM estadisticas_web WHERE fecha >= '2022-01-01' AND parroquia = $idparroquia",$conexGestion);
					$valor = mysql_result($rs,0);

					$devuelve .= "<div style=\"text-align:center;\"><span style=\"font-size:18px;text-align:center;\">".number_format($valor, 0, '','.')."</span></div>\n";
				break;

				case "proximos_eventos";

					$event = proximosEventos(5);

					if(!$event) $event = "<p>No existen próximos eventos</p>\n";
					else{

						$evento = "<div class=\"top-eventos\"></div>\n";
						$evento .= "<div class=\"content-eventos\">".$event."</div>\n";
						$evento .= "<div class=\"bottom-eventos\"></div>
						<div class=\"clearfix\"></div>\n";

						$event = $evento;

					}

					$devuelve .= $event;
				break;

				case "ultimas_noticias"; 

					if($tipo == 4 || $tipo == 5) $devuelve .= "<ul class=\"listado\">\n";

					$devuelve .= getNoticias("ultimas");

					if($tipo == 4 || $tipo == 5) $devuelve .= "</ul>\n";

				break;
				case "paginas"; 

					if($tipo == 4 || $tipo == 5) $devuelve .= "<ul class=\"listado\">\n";

					$devuelve .= getPaginas($idparroquia);

					if($tipo == 4 || $tipo == 5) $devuelve .= "</ul>\n";
				break;

				case "liturgia";

					$urlLiturgiaHoy = $urlOri."oraciones-y-liturgia/";
					$urlLiturgias = $urlOri."liturgia.html";

					$diaSemana = date('D');

					switch($diaSemana)
					{
						case "Mon"; $diaSemana = "Lunes"; break;
						case "Tue"; $diaSemana = "Martes"; break;
						case "Wed"; $diaSemana = "Miércoles"; break;
						case "Thu"; $diaSemana = "Jueves"; break;
						case "Fri"; $diaSemana = "Viernes"; break;
						case "Sat"; $diaSemana = "Sábado"; break;
						case "Sun"; $diaSemana = "Domingo"; break;
						default: break;
					}

					$mes = date('m');

					switch($mes)
					{
						case "01"; $mes = "enero"; break;
						case "02"; $mes = "febrero"; break;
						case "03"; $mes = "marzo"; break;
						case "04"; $mes = "abril"; break;
						case "05"; $mes = "mayo"; break;
						case "06"; $mes = "junio"; break;
						case "07"; $mes = "julio"; break;
						case "08"; $mes = "agosto"; break;
						case "09"; $mes = "septiembre"; break;
						case "10"; $mes = "octubre"; break;
						case "11"; $mes = "noviembre"; break;
						case "12"; $mes = "diciembre"; break;
					}		

					$hoy = $diaSemana." ".date('d')." de $mes de ".date('Y');

					$devuelve .= "<li class=\"liturgiahoy\" style=\"text-align:center;\"><a href=\"$urlLiturgiaHoy\" title=\"Liturgia de hoy\"><img src=\"".$urlOri."images/libro_liturgia.png\" style=\"margin-bottom:4px;\" /><br />$hoy</a></li>\n";

				break;

				case "grupos_parroquiales";
					$devuelve .= '<p class="links linksgal" style="margin-bottom:0;"><a href="/grupos-parroquiales.html" class="more moregal">Acceder</a></p>';
				break;

				case "buscador"; 
					$devuelve .= getBuscador();
				break;

				case "revista_parroquial";
					$devuelve .= getNumerosRevista($idparroquia);
				break;

				case "calendario_eventos"; 

					$eventosMes = getArrayEventos(date('m'), date('Y'));

					$devuelve .= generate_calendar(date('Y'), date('m'), $eventosMes, 2, $month_href = NULL, $first_day = 1, $pn=array());

					$devuelve .= "<div style=\"text-align:center;\" class=\"vereventos\">
								<a href=\"".$urlOri."eventos.html\" title=\"Ver todos los eventos\">Ver el resto del calendario</a>
							</div>\n";

				break;

				case "calendario_pastoral";

					$devuelve .= "<div class=\"calendario\">
								<a href=\"".$urlOri."documentos/2012Calendario.pdf\" title=\"Descargar Calendario Pastoral\">
									<img src=\"".$urlOri."images/calendario-pastoral.jpg\" alt=\"Descargar Calendario Pastoral\" />
									<span>Calendario Pastoral 2011/2012</span>
								</a>
								<div style=\"clear:both;\"></div>
							</div>";

				break;

				 case "catequesis_t";

				 $devuelve .= "<div class=\"calendario\" style=\"text-align:center;\">
								<a href=\"http://www.parroquiasanfernandocuenca.es/catequesis/835/\" title=\"Catequésis\">
									<img style=\"width:100%;\" src=\"".$urlRecursos."uploads/216/secciones/mid_1573302485catequesis-de-infancia.jpg\" alt=\"Catequésis\" />
								</a>
								<div style=\"clear:both;\"></div>
							</div>";

				 break;

				case "misa_tv";

					if ($idparroquia==339) {
						//(OM) 23/07/2018 quiere que aprezca esta radio en vez de radio maria
						//  PARROQUIA SANTA MARÍA DE GUADALUPE - MEXICO
						//(OM) 06/08/2018 cambio de enlace enlace aterior http://www.radiomaria.es/directo						
						$devuelve .= "<div align=\"center\">
								<a href=\"https://www.mariavision.com/programacion-horarios/tus-programas-favoritos.html\" target=\"_blank\" title=\"María Visión\">
									<img class=\"popular\" src=\"".$urlOri."images/maria_vision.jpg\" alt=\"Escuchar Misa en María Visión\" />
								</a>
							</div>\n";

					} else {
						//(OM) enlace aterior http://www.radiomaria.es/directo
						$devuelve .= "<div align=\"center\">
								<a href=\"http://www.radiomaria.es/directo\" target=\"_blank\" title=\"Radio María\">
									<img class=\"popular\" src=\"".$urlOri."images/popular-tv.jpg\" alt=\"Escuchar Misa en Radio María\" />
								</a>
							</div>\n";
					}

				break;

				case "radio_pastoral";

				$devuelve .= "<div align=\"center\">
						<a href=\"http://pastorenafm.com.ve/?i=2\" target=\"_blank\" title=\"Radio Pastoreña\">
							<img class=\"popular\" src=\"".$urlOri."images/pastorena_radio.png\" alt=\"Escuchar Radio Pastoreña\" />
						</a>
					</div>\n";

				break;

				case "galeria"; 
					$devuelve .= getImgAleatoriaGaleria($idparroquia);
				break;

				case "archivos";
					$devuelve .= getArchivo($idparroquia);
				break;
				case "categorias"; 
					$devuelve .= getCategorias($idparroquia);
				break;
				case "enlaces_amigos"; 
					if($tipo == 4 || $tipo == 5) $devuelve .= "<ul class=\"listado\">\n";
					$devuelve .= getLinks($idparroquia);
					if($tipo == 4 || $tipo == 5) $devuelve .= "</ul>\n";
				break;
				case "rincon_lectura"; case "tiempo_reflexion"; case "hermandades_parroquiales"; case "campamento_juan_pablo"; case "comunidades_neocatecumenales"; case "lazos_amor_mariano"; case "pastoral_de_la_familia"; case "congregacion_marta"; case "bono_parroquial_2018"; case "caritas_protomartir"; case "bautismos_bautismos_senor"; case "partidas_bautismo"; case "resenyas_bibliograficas"; case "animacion_pastoral"; case "50_aniversario";
					case "SMGF"; case "sacramentos"; case "amonestaciones"; case "pildora_fe"; case "espacio_interior"; case "videos"; case "inscripcion_de_sacramentos"; case "canal_youtube"; case "linea_editorial_cope"; case "cursillos"; case "horario_catequesis"; case "formacion_montesion"; case "lunes_san_nicolas"; case "actividades_parroquiales"; case "requisitos_para_sacramentos";
					case "sacramento-de-la-confirmacion-1"; case "sacramento-de-la-eucaristia-1"; case "sacramento-del-matrimonio-1"; case "carta_semanal_parroco-1"; case "sacramento-del-bautismo-1"; case "oratorio-parroquial-1"; case "nuestro-patrono-1"; case "santa-patrona-chiquinquira"; case "bloque_biblia"; case "camarin_virgen"; case "visita_guiada_virgen"; case "mejoras_salvador"; case "mejoras_cristo"; case "bautismos_gema"; case "horarios_santa"; case "actividades_solidarias_vc"; case "video_podcast_vc"; case "planificacion_vicarial_vc"; case "directorio_vc"; case "comentario_del_dia"; case "horario_cementerio_parroquial"; case "velatorio_parroquial";
					$devuelve .= getInfoPagina($fila['bloque']);
				break;
				case "contacto";  case "nuestro_papa"; case "nuestro_obispo";
				    //(OM)
					$devuelve .= getInfoSeccion($fila['bloque']);
				break;
				case "reflexiones"; case "oraciones"; case "pensamientos-de-santa-gema"; case "misas_en_comunidades"; case "grupo_oracion_gema";
					$devuelve .= getInfoSeccionImagen($fila['bloque']);
				break;
				case "butlletins"; case "bloque_catequesis";
					$devuelve .= getInfoPagina($fila['bloque']);
				break;

				case "casa_comun";
					$devuelve .= "<a href=\"https://parroquiaespiritusanto.ecclesiared.com/casa-comun/2233/\"><img src=\"https://web.mintrared.com/uploads/316/casa_comun.jpeg\" /></a>\n";
				break;

				case "ubicacion_parroquia";
					$devuelve .= "<div style=\"padding:10px;text-align:center;background:#fff;border-radius: 10px;\"><a href=\"https://www.parroquiasanjuanpabloleon.com/donde-esta/2069/\"><img src=\"templates/mintra/images/ubicacion-pablo.png\" /></a>
					<a href=\"https://www.parroquiasanjuanpabloleon.com/donde-esta/2069/\" class=\"buttonNew pabloNew\">Ver ubicación</a></div>";
				break;

				case "despacho_parroquial";
					$devuelve .= "						
						<div class=\"content-bloque bloqueshome\">
							".getValue("SELECT texto FROM bloques_home WHERE tipo = 2 AND parroquia = 989",1)."	
						</div>\n";
				break;

				case "donativos";
					$devuelve .= "<div style=\"padding:10px;text-align:center;background:#fff;border-radius: 10px;\">
					".getValue("SELECT texto FROM paginas WHERE id = 2071 AND parroquia = 697",1)."
									<a href=\"https://www.parroquiasanjuanpabloleon.com/donativos/2071/\" class=\"buttonNew pabloNew\">Haz aquí tu donativo</a>
								</div>";


				break;

				default: break;
			}

			if($tipo == 1)
			{
				$devuelve .= "</ul>
				</li>";
			}
			elseif($tipo == 3)
			{
				$devuelve .= "</div>
					</div>
				</div>";
			}
			elseif($tipo == 4)
			{
				$devuelve .= "</div>
				</div>";
			}
			elseif($tipo == 5)
			{
				$devuelve .= "</div><div class=\"bottom-bloque\"></div>
				</div>";
			}
			elseif($tipo == 2)
			{
				$devuelve .= "</ul></div>";
			}
		}

		} // IF revista
	
		return $devuelve;

	}
	else return false;
}

//(OM)
function getInfoSeccionImagen($bloque){
	//(OM) FUNCIÓN PARA SACAR INFO DE UNA PAGINA solo primera imagen de la seccion
	global $conex, $idparroquia, $urlOri, $urlRecursos;

	$html = "";

	switch($bloque){
		case "reflexiones": $idPagina = 616; break;
		case "oraciones": $idPagina = 615; break;
		case "pensamientos-de-santa-gema": $idPagina=680; break;
		case "misas_en_comunidades"; $idPagina = 981; break;
		case "grupo_oracion_gema"; $idPagina = 1710; break;
		default: break;
	}

	if($idPagina > 0){
		$val = getValue("SELECT texto, txt_int FROM paginas WHERE id = $idPagina",0);
		$texto = $val[0];
		$txtInt = $val[1];

		$val2 = getValue("SELECT foto FROM secciones_fotos where idfoto=1 and idseccion= $idPagina",0);
		$foto = $urlRecursos.'/uploads/'.$idparroquia.'/secciones/thb_'.$val2[0];
		$linkPagina = $urlOri.$txtInt."/".$idPagina."/";

		if($idPagina == 616) $linkPagina = "http://parrosantagema.blogspot.com/";

		if($idPagina != 981) $target = "target=\"_blank\"";
		else $target = "";

		$fotoDiv = "<div style=\"width:100%;\">
			<a href=\"$linkPagina\" $target title=\"$txtInt\">
					<img src=\"$foto\" style=\"width:95%;\" class=\"thumbnail\" align=\"center\" />
				</a>
			</div>";

		$html = "<div align=\"center\">$fotoDiv</div><div style=\"clear:both;\"></div>";
	}

	return $html;

}

//(OM)
function getInfoSeccion($bloque){
	//(OM) FUNCIÓN PARA SACAR INFO DE UNA PAGINA sin enlace a leer mas
	global $conex, $urlOri;

	$html = "";

	switch($bloque){
		case "contacto": $idPagina = 599; break;
		case "nuestro_papa"; $idPagina = 2754; break;
		case "nuestro_obispo"; $idPagina = 2753; break;
		default: break;
	}

	if($idPagina > 0){
		$val = getValue("SELECT texto, txt_int FROM paginas WHERE id = $idPagina",0);
		$texto = $val[0];
		
		
		$html = "<div style=\"padding:8px;\"><p>".$texto."</p></div>
		<div style=\"clear:both;\"></div>";
	}

	return $html;

}


function getInfoPagina($bloque){
	// FUNCIÓN PARA SACAR INFO DE UNA PAGINA CON LINK LEER MÁS
	global $conex, $urlOri;

	$html = "";

	switch($bloque){
		case "tiempo_reflexion"; $idPagina = 383; break;
		case "rincon_lectura"; $idPagina = 382; break;
		case "butlletins"; $idPagina = 397; break;
		case "campamento_juan_pablo"; $idPagina = 490; break;
		case "hermandades_parroquiales"; $idPagina = 505; break;
		case "lazos_amor_mariano"; $idPagina = 532; break;
		case "congregacion_marta"; $idPagina = 574; break;
		case "pastoral_de_la_familia"; $idPagina = 573; break;
		case "comunidades_neocatecumenales"; $idPagina = 531; break;
		case "bono_parroquial_2018": $idPagina = 582; break;
		case "caritas_protomartir": $idPagina = 597; break;
		case "bautismos_bautismos_senor": $idPagina = 596; break;
		case "partidas_bautismo": $idPagina = 598; break;
		case "resenyas_bibliograficas": $idPagina = 628; break;
		case "SMGF": $idPagina = 629; break;
		case "sacramentos": $idPagina = 630; break;
		case "amonestaciones": $idPagina = 631; break;
		case "animacion_pastoral": $idPagina = 673; break;
		case "catequesis_t"; $idPagina = 835; break;
		case "50_aniversario"; $idPagina = 872; break;
		case "pildora_fe"; $idPagina = 893; break;
		case "espacio_interior"; $idPagina = 894; break;
		case "videos"; $idPagina = 944; break;
		case "inscripcion_de_sacramentos"; $idPagina = 952; break;
		case "canal_youtube"; $idPagina = 972; break;
		case "misas_en_comunidades"; $idPagina = 981; break;
		case "linea_editorial_cope"; $idPagina = 1086; break;
		case "bloque_catequesis"; $idPagina = 1133; break;
		case "horario_catequesis"; $idPagina = 1150; break;
		case "cursillos"; $idPagina = 1152; break;
		case "formacion_montesion"; $idPagina = 1159; break;
		case "lunes_san_nicolas"; $idPagina = 1208; break;
		case "requisitos_para_sacramentos"; $idPagina = 1528; break;
		case "actividades_parroquiales"; $idPagina = 1526; break;
		case "sacramento-del-bautismo-1"; $idPagina = 1532; break;
		case "sacramento-de-la-confirmacion-1"; $idPagina = 1533; break;
		case "sacramento-de-la-eucaristia-1"; $idPagina = 1534; break;
		case "sacramento-del-matrimonio-1"; $idPagina = 1535; break;
		case "carta_semanal_parroco-1"; $idPagina = 1543; break;
		case "oratorio-parroquial-1"; $idPagina = 1544; break;
		case "nuestro-patrono-1"; $idPagina = 1545; break;
		case "santa-patrona-chiquinquira"; $idPagina = 1579; break;
		case "bloque_biblia"; $idPagina = 1664; break;
		case "camarin_virgen"; $idPagina = 1671; break;
		case "visita_guiada_virgen"; $idPagina = 1673; break;
		case "mejoras_cristo"; $idPagina = 1870; break;
		case "mejoras_salvador"; $idPagina = 1869; break;
		case "bautismos_gema"; $idPagina = 1946; break;
		case "actividades_solidarias_vc"; $idPagina = 2749; break;
		case "video_podcast_vc"; $idPagina = 2750; break;
		case "planificacion_vicarial_vc"; $idPagina = 2752; break;
		case "directorio_vc"; $idPagina = 2751; break;
		case "comentario_del_dia"; $idPagina = 3119; break;
		case "horario_cementerio_parroquial"; $idPagina = 3118; break;
		case "velatorio_parroquial"; $idPagina = 3121; break;
		default: break;
	}

	if($idPagina > 0){

		$val = getValue("SELECT texto, txt_int FROM paginas WHERE id = $idPagina",0);
		$texto = RecortaStr(strip_tags($val[0]), 300, '..');
		$txtInt = $val[1];

		$linkPagina = $urlOri.$txtInt."/".$idPagina."/";

		if($idPagina == 673) $texto = "<br><br>".$texto;

		if($idPagina == 1946) $texto = "<a href=\"$linkPagina\"><img src=\"https://web.mintrared.com/uploads/65/bautismos_gema.jpg\" style=\"width:100%;\" /></a>";
		else if($idPagina == 1133) $texto = "<a href=\"$linkPagina\"><img src=\"https://web.mintrared.com/uploads/65/catequesis_gema.jpg\" style=\"width:100%;\" /></a>";

		$html = "<p style=\"text-align:justify;padding:8px;\">".$texto."</p>
		<div style=\"clear:both;\"></div><p class=\"links linksgal\"><a href=\"$linkPagina\" class=\"more moregal\">Seguir leyendo</a></p><div style=\"clear:both;\"></div>";
	}

	return $html;
}

function getArchivo($idparroquia)
{
	global $urlOri, $conex;

	// *** FUNCIÓN PARA SACAR LAS NOTICIAS X MES.

	$sql = "SELECT mes, anyo FROM noticias WHERE parroquia = $idparroquia GROUP BY anyo, mes ORDER BY anyo DESC, mes DESC";
	$rs = mysql_query($sql,$conex);

	$datos = "";

	if(mysql_num_rows($rs) > 0)
	{
		while($rw = mysql_fetch_assoc($rs))
		{

			$mes = $rw['mes']; 
			$anyo = $rw['anyo'];
			$urlArchivo = $urlOri."archivo/".$mes."/".$anyo."/";

					switch($mes)
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

			$datos .= "<li><a href=\"$urlArchivo\" title=\"Noticias de $mes de $anyo\">$mes ($anyo)</a></li>\n";
		}
	}
	else $datos = "<li>No existen noticias en los archivos.</li>\n";

	return $datos;
}

function getImgAleatoriaGaleria($idparroquia)
{
	global $_SESSION, $urlOri, $conex, $urlRecursos;

	$sql = "SELECT * FROM galeria_fotos WHERE parroquia = '".$idparroquia."' AND foto != '' ORDER BY rand() LIMIT 5";

	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$fotoDiv = "<div id=\"fade\" style=\"text-align:center;margin:0 auto 0 auto;min-height:220px;\">\n";

		while($rw = mysql_fetch_assoc($rs))
		{

			$titulo = stripslashes($rw['titulo']);
			$fecha = date('d-m-Y G:i',strtotime($rw['fecha']));
			$foto = $rw['foto'];

			$catTx = getValue("SELECT categoria FROM galeria_categorias WHERE id = ".$rw['categoria'],1);

			$urlGal = $urlOri."galeria-".limpiarCadena($catTx,'archivo')."_".$rw['categoria'].".html";

			$fotoDiv .= "<div class=\"fotoGaleria\" style=\"width:100%;\">
				<a href=\"$urlGal\">
					<img src=\"$urlRecursos/uploads/".$idparroquia."/thb_$foto\" style=\"width:95%;\" class=\"thumbnail\" align=\"center\" />
				</a>
			</div>";
		}

		$fotoDiv .= "</div>\n";

		if($idparroquia == 587) $txtVer = "Veure galer&iacute;es";
		else $txtVer = "Ver galer&iacute;as";

		$fotoDiv .= "<div style=\"border-bottom: 1px #fff dashed;margin-top:5px;\"></div>
				<p class=\"links linksgal\" style=\"margin-bottom:0;\"><a href=\"".$urlOri."galeria-fotografica.html\" class=\"more moregal\">".$txtVer."</a></p>
				<div style=\"clear:both;\"></div>";

		return $fotoDiv;
	}
	else return false;
}

function getMayusculas($string)
{

	$string = strtoupper($string);
	$string = str_replace("á","Á",$string);
	$string = str_replace("é","É",$string);
	$string = str_replace("í","Í",$string);
	$string = str_replace("ó","Ó",$string);
	$string = str_replace("ú","Ú",$string);
	$string = str_replace("à","À",$string);
	$string = str_replace("è","È",$string);
	$string = str_replace("ì","Ì",$string);
	$string = str_replace("ò","Ò",$string);
	$string = str_replace("ù","Ù",$string);
	$string = str_replace("ñ","Ñ",$string);

	return $string;

}

// **********************************
// ***** FUNCION PARA SACAR PAGINADOR
// **********************************


function getPaginacion($urlPagAux, $numRes, $nPags, $numList = 20, $maxPags = 9, $only=false)
{
	global $_GET; global $pg;
	// $numRes = NUMERO DE RESULTADOS
	// $numList = NUMERO DE RESULTADOS POR PAGINA
	// $maxPags = NUMERO MÁXIMO DE PÁGINAS A MOSTRAR
	// $nPags = NUMERO DE PÁGINAS

	if($only==true) $extra = "extraBoton"; else $extra = "";

	$paginador = "<div class=\"wp-pagenavi\">\n";

	if($nPags > 1)
	{
		$paginador .= "<span class=\"pages\">Página ".intval($pg)." de $nPags</span>\n";
	}

	if ($maxPags > $nPags || $maxPags ==0) $maxPags = $nPags;

	$pgini = $pg; $pgfin = $pg; 
	while (($pgfin-$pgini) < ($maxPags-1))
	    {
		if ($pgini > 1) $pgini--;
		if (($pgfin < $nPags) && (($pgfin-$pgini) < ($maxPags-1))) $pgfin++;
	    }
	if ($pg > 1)
	{
		if($pg-1 == 1) $paginador.="<a href=\"".str_replace("?pg=[PAG]", "", $urlPagAux)."\" class=\"first\">&laquo; Anteriores</a>";
		else $paginador.="<a href=\"".str_replace('[PAG]', ($pg-1), $urlPagAux)."\" class=\"last\">&laquo;Anteriores</a>";
	}

	if(!$only)
	{

		for ($i=$pgini;$i<=$pgfin;$i++)
	    	{
			if ($i == $pg) $paginador.="\n\t\t\t\t\t\t\t<span class=\"current\">".$i."</span>\n"; 
			else if($i == 1) $paginador.="\t\t\t\t\t\t\t<a class=\"page\" href=\"".str_replace("?pg=[PAG]", "", $urlPagAux)."\">".$i."</a>\n";
			else $paginador.="\t\t\t\t\t\t\t<a class=\"page\" href=\"".str_replace("[PAG]", $i, $urlPagAux)."\">".$i."</a>\n";
	    	}

	}

	if ($pg < ($nPags)) $paginador.='<a href="'.str_replace("[PAG]", ($pg+1), $urlPagAux).'" class="last">Siguientes &raquo;</a>';

	$paginador.="</div>";

	return $paginador;

}


// *********************** FUNCION PARA EXTRAER LOS VALORES DE UN SQL ($aux=0: array, $aux=1: 1 valor)

function getValue ($SQL, $aux=0)
    {
        global $conex;
        $vfila = "";
        $vresultado=mysql_query($SQL, $conex) or die (mysql_error());

        if (isset($_GET['showCode'])) echo $SQL."<BR>";

        if (mysql_num_rows($vresultado)==1)
            {
	$vfila = mysql_fetch_array($vresultado);
	mysql_free_result($vresultado);
	if ($aux==0) return $vfila; else return $vfila[0];
            }
        else return $vfila;
    }

function transformaFecha($fecha,$formato)
{
	if($fecha != "")
	{
		$strfecha = strtotime($fecha);

		if($formato == "") $formato = "d-m-Y";

		$fechaNew = date($formato,$strfecha);

		return $fechaNew;
	}
	else return false;
}

function dameFecha($str,$formato=1)
{
	$diaSemana = date('D',$str);
	$dia = date('d',$str);
	$mes = date('m',$str);
	$anyo = date('Y',$str);

	switch($diaSemana)
	{
		case "Mon"; $diaSemana = "Lunes"; break;
		case "Tue"; $diaSemana = "Martes"; break;
		case "Wed"; $diaSemana = "Miércoles"; break;
		case "Thu"; $diaSemana = "Jueves"; break;
		case "Fri"; $diaSemana = "Viernes"; break;
		case "Sat"; $diaSemana = "Sábado"; break;
		case "Sun"; $diaSemana = "Domingo"; break;
		default: break;
	}

	switch($mes)
	{
		case "01"; $mes = "Enero"; $mesCorto = "ene"; break;
		case "02"; $mes = "Febrero"; $mesCorto = "feb"; break;
		case "03"; $mes = "Marzo"; $mesCorto = "mar"; break;
		case "04"; $mes = "Abril"; $mesCorto = "abr"; break;
		case "05"; $mes = "Mayo"; $mesCorto = "may"; break;
		case "06"; $mes = "Junio"; $mesCorto = "jun"; break;
		case "07"; $mes = "Julio"; $mesCorto = "jul"; break;
		case "08"; $mes = "Agosto"; $mesCorto = "ago"; break;
		case "09"; $mes = "Septiembre"; $mesCorto = "sep"; break;
		case "10"; $mes = "Octubre"; $mesCorto = "oct"; break;
		case "11"; $mes = "Noviembre"; $mesCorto = "nov"; break;
		case "12"; $mes = "Diciembre"; $mesCorto = "dic"; break;
		default: break;
	}

	if($formato == 1) return $diaSemana.", $dia de $mes de $anyo"; 
	else if($formato == 2) return "$dia - $mesCorto - $anyo"; 
	else if($formato == 3) return "$dia de $mes de $anyo";
	else if($formato == 4) return "$dia de $mes de $anyo, ".$diaSemana; 
}

function dameMes($mes)
{
	switch($mes)
	{
		case 01; $mes = "Enero"; $mesCorto = "ene"; break;
		case 02; $mes = "Febrero"; $mesCorto = "feb"; break;
		case 03; $mes = "Marzo"; $mesCorto = "mar"; break;
		case 04; $mes = "Abril"; $mesCorto = "abr"; break;
		case 05; $mes = "Mayo"; $mesCorto = "may"; break;
		case 06; $mes = "Junio"; $mesCorto = "jun"; break;
		case 07; $mes = "Julio"; $mesCorto = "jul"; break;
		case 08; $mes = "Agosto"; $mesCorto = "ago"; break;
		case 09; $mes = "Septiembre"; $mesCorto = "sep"; break;
		case 10; $mes = "Octubre"; $mesCorto = "oct"; break;
		case 11; $mes = "Noviembre"; $mesCorto = "nov"; break;
		case 12; $mes = "Diciembre"; $mesCorto = "dic"; break;
		default: break;
	}

	return $mes;
}

# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license

function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 1, $pn = array())
{
	global $idparroquia;
    $first_of_month = gmmktime(0,0,0,$month,1,$year);
    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day

	switch($month_name)
	{
		case "January"; $month_name = "Enero"; break;
		case "February"; $month_name = "Febrero"; break;
		case "March"; $month_name = "Marzo"; break;
		case "April"; $month_name = "Abril"; break;
		case "May"; $month_name = "Mayo"; break;
		case "June"; $month_name = "Junio"; break;
		case "July"; $month_name = "Julio"; break;
		case "August"; $month_name = "Agosto"; break;
		case "September"; $month_name = "Septiembre"; break;
		case "October"; $month_name = "Octubre"; break;
		case "November"; $month_name = "Noviembre"; break;
		case "December"; $month_name = "Diciembre"; break;
		default: break;
	}

    $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

	$newnames = array();

foreach($day_names as $d)
{
	
	/*if($idparroquia == 587){
		switch($d){ 
			case "Monday"; $newnames[] = "Dilluns"; break;
			case "Tuesday"; $newnames[] = "Dimarts"; break;
			case "Wednesday"; $newnames[] = "Dimecres"; break;
			case "Thursday"; $newnames[] = "Dijous"; break;
			case "Friday"; $newnames[] = "Divendres"; break;
			case "Saturday"; $newnames[] = "Dissabte"; break;
			case "Sunday"; $newnames[] = "Diumenge"; break;
			default: break;
		}
	}
	else{*/
		switch($d){ 
			case "Monday"; $newnames[] = "Lunes"; break;
			case "Tuesday"; $newnames[] = "Martes"; break;
			case "Wednesday"; $newnames[] = "Miércoles"; break;
			case "Thursday"; $newnames[] = "Jueves"; break;
			case "Friday"; $newnames[] = "Viernes"; break;
			case "Saturday"; $newnames[] = "Sabado"; break;
			case "Sunday"; $newnames[] = "Domingo"; break;
			default: break;
		}
	//}
}

	$day_names = array();
	$day_names = $newnames;

    #Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
    @list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
    if($p) $p = '<span class="calendar-prev">'.($pl ? '<a href="'.htmlspecialchars($pl).'">'.$p.'</a>' : $p).'</span>&nbsp;';
    if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? '<a href="'.htmlspecialchars($nl).'">'.$n.'</a>' : $n).'</span>';
    $calendar = '<table class="calendar" cellspacing="0" cellpadding="0" align="center">'."\n".
        '<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

    if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
        #if day_name_length is >3, the full name of the day will be printed
        foreach($day_names as $d)
            $calendar .= '<th abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
        $calendar .= "</tr>\n<tr>";
    }

    if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }




		if($day == date('d')) $hoy = "hoyy";
		else $hoy = "";

        if(isset($days[$day]) and is_array($days[$day]))
		{
            @list($link, $classes, $content) = $days[$day];
            
			$dia = $day;

            $calendar .= '<td'.($classes ? ' class="'.htmlspecialchars($classes).' '.$hoy.'">' : '>').
                ($link ? '<a href="'.htmlspecialchars($link).'" class="event" title="'.str_replace("\"","",$content).'">'.$dia.'</a>' : $dia).'</td>';
        }
        else $calendar .= "<td class=\"".$hoy."\">$day</td>";
    }
    if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

   $calendar = $calendar."</tr>\n</table>\n";

	$calendar .= "<script type=\"text/javascript\" language=\"javascript\">
		$(document).ready(function()
		{
			// Match all <A/> links with a title tag and use it as the content (default).
			$('.event').qtip({position: {at:'bottom left', my: 'top left'}});
		});
	</script>";

	return $calendar;

}


function generateBig_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 1, $pn = array())
{

	global $urlOri, $idparroquia;

    $first_of_month = gmmktime(0,0,0,$month,1,$year);
    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day

	if($idparroquia == 587){
		switch($month_name)
		{
			case "January"; $month_name = "Gener"; break;
			case "February"; $month_name = "Febrer"; break;
			case "March"; $month_name = "Març"; break;
			case "April"; $month_name = "Abril"; break;
			case "May"; $month_name = "Maig"; break;
			case "June"; $month_name = "Juny"; break;
			case "July"; $month_name = "Juliol"; break;
			case "August"; $month_name = "Agost"; break;
			case "September"; $month_name = "Setembre"; break;
			case "October"; $month_name = "Octubre"; break;
			case "November"; $month_name = "Novembre"; break;
			case "December"; $month_name = "Desembre"; break;
			default: break;
		}
	}else{
		switch($month_name)
		{
			case "January"; $month_name = "Enero"; break;
			case "February"; $month_name = "Febrero"; break;
			case "March"; $month_name = "Marzo"; break;
			case "April"; $month_name = "Abril"; break;
			case "May"; $month_name = "Mayo"; break;
			case "June"; $month_name = "Junio"; break;
			case "July"; $month_name = "Julio"; break;
			case "August"; $month_name = "Agosto"; break;
			case "September"; $month_name = "Septiembre"; break;
			case "October"; $month_name = "Octubre"; break;
			case "November"; $month_name = "Noviembre"; break;
			case "December"; $month_name = "Diciembre"; break;
			default: break;
		}
	}

    $title   = ucfirst($month_name).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

	$newnames = array();

	if($idparroquia == 587){
		foreach($day_names as $d)
		{
			switch($d){ 
				case "Monday"; $newnames[] = "Dilluns"; break;
				case "Tuesday"; $newnames[] = "Dimarts"; break;
				case "Wednesday"; $newnames[] = "Dimecres"; break;
				case "Thursday"; $newnames[] = "Dijous"; break;
				case "Friday"; $newnames[] = "Divendres"; break;
				case "Saturday"; $newnames[] = "Dissabte"; break;
				case "Sunday"; $newnames[] = "Diumenge"; break;
				default: break;
			}
		}
	}else{

		foreach($day_names as $d)
		{
			switch($d){ 
				case "Monday"; $newnames[] = "Lunes"; break;
				case "Tuesday"; $newnames[] = "Martes"; break;
				case "Wednesday"; $newnames[] = "Miércoles"; break;
				case "Thursday"; $newnames[] = "Jueves"; break;
				case "Friday"; $newnames[] = "Viernes"; break;
				case "Saturday"; $newnames[] = "Sábado"; break;
				case "Sunday"; $newnames[] = "Domingo"; break;
				default: break;
			}
		}
	}

	$day_names = array();
	$day_names = $newnames;

	if($month == 12)
	{
		$mesMas = 1;
		$anyoMas = $year+1;
	}else{
		$mesMas = $month+1;
		$anyoMas = $year;
	}

	if($month == 1)
	{
		$mes = 12;
		$anyo = $year-1;
	}else{
		$mes = $month-1;
		$anyo = $year;
	}


	$urlAnt = $urlOri."eventos.html?mes=".$mes."&anyo=".$anyo;
	$urlNext = $urlOri."eventos.html?mes=".$mesMas."&anyo=".$anyoMas;

 $calendar = '<div class=\'title_bar\'>
	<a href=\''.$urlAnt.'\'>
		<div class=\'previous\'></div>
	</a>
	
	<a href=\''.$urlNext.'\'>
		<div class=\'next\'></div>
	</a>
	
	<h2 class=\'month\'>'.$title.'</h2>
		</div>';



	$px = $weekday-1*67;

	if($weekday > 0)
	{

		$espacios = "";

		for ($i = 1; $i <= $weekday; $i++) {
    			//$espacios .= "<div class=\"espacio\"></div>\n";

			$espacios .= "<div class='cal_dayespacio'>

					</div>";
		}

	}
	else $espacios = "";

    if($weekday > 0) $calendar .= $espacios; #initial 'empty' days

    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        /*if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }*/

	$fecha = date('Y-m-d');
	$fechaRecorre = $year."-".$month."-".$day;

	$style = "";

	if($fecha == $fechaRecorre)
	{
		$hoy = "hoyy"; 
		$style = "style=\"color:#000;\"";
	}
	else $hoy = "";

        if(isset($days[$day]) and is_array($days[$day]))
	{
            @list($link, $classes, $content) = $days[$day];
            
		$dia = $day;

		if($idparroquia == 587) $dias = array('Diu', 'Dil', 'Dim', 'Dime', 'Dij', 'Div', 'Dis');
		else $dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<a href='$link' title='Ver eventos para el $day $title' rel='day_view'>
	<div class='cal_day $hoy'>
		<div class='day_heading'>".$diaSemana."</div>
		<div class='day_number today' $style>$day</div>
	</div>
</a>";

        }
        else
	{

		$dia = $day;

		if($idparroquia == 587) $dias = array('Diu', 'Dil', 'Dim', 'Dime', 'Dij', 'Div', 'Dis');
		else $dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<div class='cal_day $hoy'>
			<div class='day_heading'>".$diaSemana."</div>
			<div class='day_number' $style>$day</div>
		</div>";

	}
    }

   // if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

	return $calendar;

}



// **********************************************************
// ************* SANTOS **********************
// **********************************************************


function getArraySantos($mes=0, $anyo=0)
{
	global $conex, $urlOri, $idparroquia;

	if($mes > 0)
	{

		$diaMin = $anyo."-".$mes."-01";
		$diaMax = $anyo."-".$mes."-31";

		$sql = "SELECT fecha FROM santos WHERE fecha >= '$diaMin' AND fecha <= '$diaMax' GROUP BY fecha ORDER BY fecha ASC";
		$rs = mysql_query($sql,$conex) or die (mysql_error());

		if(mysql_num_rows($rs) > 0)
		{
			while($rw = mysql_fetch_assoc($rs))
			{

				$dia = date('d',strtotime($rw['fecha']));

				if($dia >= "01" && $dia <= "09") $dia = str_replace(0,'',$dia);

				$url = $urlOri."santos/$dia-$mes-$anyo/#santos";

				$arrayDatos = array($url,"linked-day","");

				$days[$dia] = $arrayDatos;
			}
		}
		else $days = array();

		return $days;

	}
	else return false;
}



// **********************************************************
// ************* LITURGIA DE LAS HORAS **********************
// **********************************************************


function getArrayOraciones($mes=0, $anyo=0)
{
	global $conex, $urlOri, $idparroquia;

	if($mes > 0)
	{

		$fecha = $anyo."-".$mes."-01";

		for ($i = 1; $i <= date('t',strtotime($fecha)); $i++) 
		{

			$dia = $i;

			if($dia >= "01" && $dia <= "09") $dia = str_replace(0,'',$dia);

			$url = $urlOri."oraciones-y-liturgia/$dia-$mes-$anyo/";

			$arrayDatos = array($url,"linked-day","");

			$days[$dia] = $arrayDatos;
		}

		return $days;

	}
	else return false;
}


function getArrayLiturgias($mes=0, $anyo=0)
{
	global $conex, $urlOri, $idparroquia;

	if($mes > 0)
	{

		$diaMin = $anyo."-".$mes."-01";
		$diaMax = $anyo."-".$mes."-31";

		$sql = "SELECT fecha FROM `liturgia_textos` WHERE fecha >= '$diaMin' AND fecha <= '$diaMax' AND categoria > 0 AND manual = 0 GROUP BY fecha ORDER BY fecha ASC";
		$rs = mysql_query($sql,$conex) or die (mysql_error());

		if(mysql_num_rows($rs) > 0)
		{
			while($rw = mysql_fetch_assoc($rs))
			{

				$dia = date('d',strtotime($rw['fecha']));

				if($dia >= "01" && $dia <= "09") $dia = str_replace(0,'',$dia);

				$url = $urlOri."liturgia/$dia-$mes-$anyo/#liturgia";

				$arrayDatos = array($url,"linked-day","");

				$days[$dia] = $arrayDatos;
			}
		}
		else $days = array();

		return $days;

	}
	else return false;
}

function generateBig_calendarLiturgia($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 1, $pn = array(),$santos=false)
{

	global $urlOri;

    $first_of_month = gmmktime(0,0,0,$month,1,$year);
    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day

	switch($month_name)
	{
		case "January"; $month_name = "Enero"; break;
		case "February"; $month_name = "Febrero"; break;
		case "March"; $month_name = "Marzo"; break;
		case "April"; $month_name = "Abril"; break;
		case "May"; $month_name = "Mayo"; break;
		case "June"; $month_name = "Junio"; break;
		case "July"; $month_name = "Julio"; break;
		case "August"; $month_name = "Agosto"; break;
		case "September"; $month_name = "Septiembre"; break;
		case "October"; $month_name = "Octubre"; break;
		case "November"; $month_name = "Noviembre"; break;
		case "December"; $month_name = "Diciembre"; break;
		default: break;
	}

    $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

	$newnames = array();

foreach($day_names as $d)
{
	switch($d){ 
		case "Monday"; $newnames[] = "Lunes"; break;
		case "Tuesday"; $newnames[] = "Martes"; break;
		case "Wednesday"; $newnames[] = "Miércoles"; break;
		case "Thursday"; $newnames[] = "Jueves"; break;
		case "Friday"; $newnames[] = "Viernes"; break;
		case "Saturday"; $newnames[] = "Sábado"; break;
		case "Sunday"; $newnames[] = "Domingo"; break;
		default: break;
	}
}

	$day_names = array();
	$day_names = $newnames;

	if($month == 12)
	{
		$mesMas = 1;
		$anyoMas = $year+1;
	}else{
		$mesMas = $month+1;
		$anyoMas = $year;
	}

	if($month == 1)
	{
		$mes = 12;
		$anyo = $year-1;
	}else{
		$mes = $month-1;
		$anyo = $year;
	}

if($santos)
{
	$urlAnt = $urlOri."santos/?mes=".$mes."&anyo=".$anyo;
	$urlNext = $urlOri."santos/?mes=".$mesMas."&anyo=".$anyoMas;
}
else{
	$urlAnt = $urlOri."liturgia.html?mes=".$mes."&anyo=".$anyo;
	$urlNext = $urlOri."liturgia.html?mes=".$mesMas."&anyo=".$anyoMas;
}

 $calendar = '<div class=\'title_bar\'>
	<a href=\''.$urlAnt.'\'>
		<div class=\'previous\'></div>
	</a>
	
	<a href=\''.$urlNext.'\'>
		<div class=\'next\'></div>
	</a>
	
	<h2 class=\'month\'>'.$title.'</h2>
		</div>';



	$px = $weekday-1*67;

	if($weekday > 0)
	{

		$espacios = "";

		for ($i = 1; $i <= $weekday; $i++) {
    			//$espacios .= "<div class=\"espacio\"></div>\n";

			$espacios .= "<div class='cal_dayespacio'>

					</div>";
		}

	}
	else $espacios = "";

    if($weekday > 0) $calendar .= $espacios; #initial 'empty' days

    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        /*if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }*/

	$fecha = date('Y-m-d');
	$fechaRecorre = $year."-".$month."-".$day;

	$style = "";

	if($fecha == $fechaRecorre)
	{
		$hoy = "hoyy"; 
		$style = "style=\"color:#000;\"";
	}
	else $hoy = "";

        if(isset($days[$day]) and is_array($days[$day]))
	{
            @list($link, $classes, $content) = $days[$day];
            
		$dia = $day;

		$dias = array('Dom', 'L', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<a href='$link' title='Ver liturgia para el $day $title' rel='day_view'>
	<div class='cal_day $hoy'>
		<div class='day_heading'>".$diaSemana."</div>
		<div class='day_number today' $style>$day</div>
	</div>
</a>";

        }
        else
	{

		$dia = $day;

		$dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<div class='cal_day $hoy'>
			<div class='day_heading'>".$diaSemana."</div>
			<div class='day_number' $style>$day</div>
		</div>";

	}
    }

   // if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

	return $calendar;

}


function generateBig_calendarLiturgiaOracion($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 1, $pn = array())
{

	global $urlOri;

    $first_of_month = gmmktime(0,0,0,$month,1,$year);
    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day

	switch($month_name)
	{
		case "January"; $month_name = "Enero"; break;
		case "February"; $month_name = "Febrero"; break;
		case "March"; $month_name = "Marzo"; break;
		case "April"; $month_name = "Abril"; break;
		case "May"; $month_name = "Mayo"; break;
		case "June"; $month_name = "Junio"; break;
		case "July"; $month_name = "Julio"; break;
		case "August"; $month_name = "Agosto"; break;
		case "September"; $month_name = "Septiembre"; break;
		case "October"; $month_name = "Octubre"; break;
		case "November"; $month_name = "Noviembre"; break;
		case "December"; $month_name = "Diciembre"; break;
		default: break;
	}

    $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

	$newnames = array();

foreach($day_names as $d)
{
	switch($d){ 
		case "Monday"; $newnames[] = "Lunes"; break;
		case "Tuesday"; $newnames[] = "Martes"; break;
		case "Wednesday"; $newnames[] = "Miércoles"; break;
		case "Thursday"; $newnames[] = "Jueves"; break;
		case "Friday"; $newnames[] = "Viernes"; break;
		case "Saturday"; $newnames[] = "Sábado"; break;
		case "Sunday"; $newnames[] = "Domingo"; break;
		default: break;
	}
}

	$day_names = array();
	$day_names = $newnames;

	if($month == 12)
	{
		$mesMas = 1;
		$anyoMas = $year+1;
	}else{
		$mesMas = $month+1;
		$anyoMas = $year;
	}

	if($month == 1)
	{
		$mes = 12;
		$anyo = $year-1;
	}else{
		$mes = $month-1;
		$anyo = $year;
	}

	$urlAnt = $urlOri."oraciones-y-liturgia/?mes=".$mes."&anyo=".$anyo."#calendar_wrap";
	$urlNext = $urlOri."oraciones-y-liturgia/?mes=".$mesMas."&anyo=".$anyoMas."#calendar_wrap";

 $calendar = '<div class=\'title_bar\'>
	<a href=\''.$urlAnt.'\'>
		<div class=\'previous\'></div>
	</a>
	
	<a href=\''.$urlNext.'\'>
		<div class=\'next\'></div>
	</a>
	
	<h2 class=\'month\'>'.$title.'</h2>
		</div>';



	$px = $weekday-1*67;

	if($weekday > 0)
	{

		$espacios = "";

		for ($i = 1; $i <= $weekday; $i++) {
    			//$espacios .= "<div class=\"espacio\"></div>\n";

			$espacios .= "<div class='cal_dayespacio'>

					</div>";
		}

	}
	else $espacios = "";

    if($weekday > 0) $calendar .= $espacios; #initial 'empty' days

    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        /*if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }*/

	$fecha = date('Y-m-d');
	$fechaRecorre = $year."-".$month."-".$day;

	$style = "";

	if($fecha == $fechaRecorre)
	{
		$hoy = "hoyy"; 
		$style = "style=\"color:#000;\"";
	}
	else $hoy = "";

        if(isset($days[$day]) and is_array($days[$day]))
	{
            @list($link, $classes, $content) = $days[$day];
            
		$dia = $day;

		$dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<a href='$link' title='Ver Oraciones y Liturgia para el $day $title' rel='day_view'>
	<div class='cal_day $hoy'>
		<div class='day_heading'>".$diaSemana."</div>
		<div class='day_number today' $style>$day</div>
	</div>
</a>";

        }
        else
	{

		$dia = $day;

		$dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
		$diaSemana = $dias[date("w", mktime(0, 0, 0, $month, $dia, $year))];

$calendar .= "<div class='cal_day $hoy'>
			<div class='day_heading'>".$diaSemana."</div>
			<div class='day_number' $style>$day</div>
		</div>";

	}
    }

   // if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

	return $calendar;

}


function getLiturgias($fecha)
{

	global $urlOri, $conex;

	if($fecha != "")
	{
		if(getValue("SELECT COUNT(id) FROM liturgia_textos WHERE fecha = '$fecha' AND categoria > 0 AND manual = 0",1) > 0)
		{

			$sql = "SELECT id, categoria FROM liturgia_textos WHERE fecha = '$fecha' AND categoria > 0 AND manual = 0";
			$rs = mysql_query($sql,$conex);

			$dia = date('d',strtotime($fecha));
			$mes = date('m',strtotime($fecha));
			$anyo = date('Y',strtotime($fecha));

			switch($mes)
			{
				case "01"; $mes = "enero"; break;
				case "02"; $mes = "febrero"; break;
				case "03"; $mes = "marzo"; break;
				case "04"; $mes = "abril"; break;
				case "05"; $mes = "mayo"; break;
				case "06"; $mes = "junio"; break;
				case "07"; $mes = "julio"; break;
				case "08"; $mes = "agosto"; break;
				case "09"; $mes = "septiembre"; break;
				case "10"; $mes = "octubre"; break;
				case "11"; $mes = "noviembre"; break;
				case "12"; $mes = "diciembre"; break;
			}

			$titulo = "Liturgia del ".$dia." de ".$mes." de ".$anyo;

			$datos = "<div class='title_bar'>
					<h2 class='month'>
						".$titulo."
					</h2>
				</div>";

			$intro = getValue("SELECT intro FROM liturgia_urls WHERE fecha = '$fecha' AND padre = 0",1);

			if($intro != "")
			{
				$datos .= "<p class=\"intro\">".stripslashes($intro)."<hr class=\"hr\"/></p>\n";
			}

			$datos .= "<ul class=\"tipoLiturgias\">\n";

				while($rw = mysql_fetch_assoc($rs))
				{

					$nombreLiturgia = getValue("SELECT categoria FROM liturgia_categorias WHERE id = ".$rw['categoria'],1);
					$linkLiturgia = $urlOri."liturgia/".$fecha."/".limpiarCadena($nombreLiturgia,'archivo')."_".$rw['id']."/#liturgia";

					$datos .= "<li><a href=\"$linkLiturgia\">".$nombreLiturgia."</a></li>\n";
				}

			$datos .= "</ul>\n";

			return $datos;

		}
		else return "<h2 style=\"font-weight:normal;\" align=\"center\">No existen datos para mostrar.</h2>";
	}
	else exit();

}

function getLiturgiaUna($idtexto)
{

	global $urlOri, $conex;

	if($idtexto > 0)
	{
		if(getValue("SELECT COUNT(id) FROM liturgia_textos WHERE id = $idtexto AND categoria > 0 AND manual = 0",1) > 0)
		{

			$sql = "SELECT id, categoria, texto, fecha FROM liturgia_textos WHERE id = $idtexto AND categoria > 0 AND manual = 0";
			$rs = mysql_query($sql,$conex);

			$rw = mysql_fetch_assoc($rs);

			$fecha = $rw['fecha'];

			$categorias = "SELECT id, categoria FROM liturgia_textos WHERE fecha = '$fecha' AND categoria > 0 AND manual = 0";
			$resultado = mysql_query($categorias,$conex);

			$titulo = "<div class=\"otras-litur\">\n";

			while($fila = mysql_fetch_assoc($resultado))
			{

				$nombreLiturgia = getValue("SELECT categoria FROM liturgia_categorias WHERE id = ".$fila['categoria'],1);
				$linkLiturgia = $urlOri."liturgia/".$fecha."/".limpiarCadena($nombreLiturgia,'archivo')."_".$fila['id']."/#liturgia";

				if($fila['id'] == $idtexto) $act = "class=\"actual\""; else $act = "";

				$titulo .= "<a href=\"$linkLiturgia\" $act>".$nombreLiturgia."</a> | ";
			}

			$titulo = substr($titulo,0,strlen($titulo)-2);

			$titulo .= "</div>\n";

			$datos = "<div class='title_bar'>
					<h2 class='month'>
						".$titulo."
					</h2>
				</div>";

			$texto = $rw['texto']."</FONT></FONT></FONT>";

			$datos .= "<p class=\"liturgia\">".stripslashes($texto)."</p>\n";

			return $datos;

		}
		else return "<h2 style=\"font-weight:normal;\" align=\"center\">No existen datos para mostrar.</h2>";
	}
	else exit();

}

?>