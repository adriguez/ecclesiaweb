
<?php

include('../_includes/config.php');

ini_set('display_errors','1');
	ini_set("error_reporting",E_ALL);

$archivo = "cartago.csv";
exit();

/* BAUTISMOS BASE */
if(file_exists($archivo))
{

	$nombre_fichero = $archivo;
	$gestor = fopen($nombre_fichero, "r");
	$contenido = fread($gestor, filesize($nombre_fichero));
	fclose($gestor);
		
	$datosRecorre = explode("\n",$contenido);
	
	foreach($datosRecorre as $id=>$fila)
	{
		$datos = explode(";",$fila);
		
		$idParroquia = $datos[2];
		$nombreParroquia = $datos[0];
		$subdominio = $datos[1];
		
		echo '<hr>';
		echo $idParroquia.'<br>'.$nombreParroquia.'<br>'.$subdominio;
		
		
$sql = "
INSERT INTO `configuracion_base` (`parroquia`, `activar`, `titulo`, `titulo_logo`, `descripcion`, `dominio`, `dominio_original`, `template`, `notis_home`, `mail_contacto`, `acepta_contacto`, `lat`, `lng`, `poblacion`, `diocesis`, `diocesis_id`, `carpeta_stats`, `comentarios`, `acepta_oraciones`, `pre_oraciones`, `moneda`, `clave_api`, `clave_api_secreta`) VALUES
('".$idParroquia."', 1, '".$nombreParroquia."', '".$nombreParroquia."', '', 'https://".$subdominio.".diocesisdecartagocostarica.com/', '".$subdominio.".diocesisdecartagocostarica.com', 13, 5, '', 1, '', '', '', '', 759, '/var/www/vhosts/system/".$subdominio.".diocesisdecartagocostarica.com/statistics/webstat', 1, 0, '', 'Dólares', '6Lc3fkAaAAAAAGOrdBoNgrJELKz__197CX90SMBt', '6Lc3fkAaAAAAAKmz_aqla_7WDlhJz8PKOqfKV-UB');";

$sql1 = "INSERT INTO `bloques` (`parroquia`, `orden`, `parte`, `bloque`, `titulo_bloque`, `activar`, `comentario`) VALUES
(".$idParroquia.", 4, 'izquierda', 'ultimos_documentos', 'Documentos', 1, 'Bloque donde muetra los últimos documentos interesantes añadidos.'),
(".$idParroquia.", 2, 'izquierda', 'calendario_eventos', 'Agenda', 1, 'Calendario de Eventos'),
(".$idParroquia.", 1, 'izquierda', 'revista_parroquial', 'Revista Parroquial', 1, 'Bloque de Revista Parroquial'),
(".$idParroquia.", 2, 'derecha', 'galeria', 'Galería', 1, 'Bloque que muestra fotografías al azar'),
(".$idParroquia.", 5, 'izquierda', 'enlaces_amigos', 'Enlaces Amigos', 1, 'Enlaces Amigos'),
(".$idParroquia.", 3, 'izquierda', 'ultimas_noticias', 'Últimas Noticias', 1, 'Bloque de últimas Noticias'),
(".$idParroquia.", 3, 'derecha', 'ultimas_noticias_diocesis', 'Últimas noticias de la Diócesis', 0, 'Últimas noticias de la Diócesis'),
(".$idParroquia.", 1, 'derecha', 'proximos_eventos', 'Próximos Eventos', 1, 'Bloque con próximos eventos');";

$sql2 = "INSERT INTO `bloques_home` (`parroquia`, `titulo`, `texto`, `tipo`) VALUES
(".$idParroquia.", 'Horarios de Misa', '', 1),
(".$idParroquia.", 'Despacho Parroquial', '', 2),
(".$idParroquia.", 'Cáritas Parroquial', '', 3);";

$sql3 = "INSERT INTO `paginas` (`parroquia`, `titulo`, `texto`, `activar`, `txt_int`, `especial`, `arbol`, `geolocalizada`, `latitud`, `longitud`, `adjuntar_documentos`) VALUES
(".$idParroquia.", 'Donativos', '', 1, 'donativos', 0, 0, 0, '', '', 0),
(".$idParroquia.", 'Revista Parroquial', '', 0, 'revista_parroquial', 0, 0, 0, '', '', 0),
(".$idParroquia.", 'Historia', '', 1, 'historia', 0, 0, 0, '', '', 0),
(".$idParroquia.", 'Ubicación', '', 1, 'donde-esta', 0, 0, 0, '', '', 0),
(".$idParroquia.", 'Horarios de Misa', '', 1, 'horarios', 0, 0, 0, '', '', 0);";

//echo $sql.'<hr>'.$sql1.'<hr>'.$sql2.'<hr>'.$sql3;
		
		mysql_query($sql,$conex) or die (mysql_error());
		mysql_query($sql1,$conex) or die (mysql_error());
		mysql_query($sql2,$conex) or die (mysql_error());
		mysql_query($sql3,$conex) or die (mysql_error());
	}
}


?>