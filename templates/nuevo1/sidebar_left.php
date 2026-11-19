<div class="col-lg-3 col-sm-6 col-md-4 col-lg-pull-6 col-md-pull-8 col-xsl-6 sidebar left">

<?php

if($idparroquia == 503){


			$val = getValue("SELECT * FROM misa_datos WHERE parroquia = '$idparroquia'",0);
			
			$codYoutube = explode("?v=", $val['urlmisa']);
			if(isset($codYoutube[1]) && $codYoutube[1] != "")
			{
				$codYoutube = $codYoutube[1];
			}
			else if(substr_count($val['urlmisa'], 'youtu.be') > 0){
				$codYoutube = explode("/",$val['urlmisa']);
				if(isset($codYoutube[3]) && strlen(trim($codYoutube[3])) == 11) $codYoutube = trim($codYoutube[3]);
				else $codYoutube = "";
			}
			else if(substr_count($val['urlmisa'], '.com/live/') > 0){
				$codYoutube = explode("/",$val['urlmisa']);
				if(isset($codYoutube[4]) && strlen(trim($codYoutube[4])) == 11) $codYoutube = trim($codYoutube[4]);
				else $codYoutube = "";
			}
			else $codYoutube = "";

			echo "<div class=\"bloque\">
					<div class=\"titulo boxtitle".$rw['tipo']."\"><i>Misa online</i></div>
					
					<div class=\"content-bloque bloqueshome\">
						<br><iframe width=\"100%\" height=\"200\" border=\"0\" src=\"https://www.youtube.com/embed/".$codYoutube."\"></iframe>
					</div>\n
				</div>";

}

if($idparroquia == 538){
	
			echo "<div class=\"bloque\">
					<div class=\"titulo boxtitle".$rw['tipo']."\"><i>Emisora Parroquial</i></div>
					
					<div class=\"content-bloque bloqueshome\">
						<iframe src=\"https://players.emitironline.com/v6/index.php?url=https%3A%2F%2Fserver8.emitironline.com%3A18480%2Fradio&codec=mp3&volume=90&autoplay=true&user=esperanza&server=server8&title=Radio+Esperanza\" width=\"220\" height=\"220\" align=\"center\" frameborder=\"0\" scrolling=\"no\" allow=\"autoplay *\">Su navegador no soporta iframes, <a href=\"https://players.emitironline.com/v6/index.php?url=https%3A%2F%2Fserver8.emitironline.com%3A18480%2Fradio&codec=mp3&volume=90&autoplay=true&user=esperanza&server=server8&title=Radio+Esperanza\">CLICK AQUÍ</a> para escuchar la emisora en una nueva ventana.</iframe>
					</div>\n
				</div>";
}

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($rw['texto'] != "")
		{
			echo "<div class=\"bloque\">
					<div class=\"titulo boxtitle".$rw['tipo']."\"><i>".$rw['titulo']."</i></div>
					
					<div class=\"content-bloque bloqueshome\">
						".$rw['texto']."
					</div>\n
				</div>";
		}
	}
}

if($idparroquia != 538 && getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{
		$imagen=$urlOri."images/oracion.jpg";

		if ($idparroquia==65) { $imagen=$urlOri."images/oracion_65.jpg";}

			echo "<div class=\"bloque\">
					<h2 class=\"titulo boxtitle\">Petici&oacute;n de oraciones</h2>
					<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"width:100%;margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$imagen."\" /></a></p>	
				</div>\n";

		if($idparroquia == 65){
			echo "<div align=\"center bloque\"><img src=\"".$urlOri."templates/nuevo1/images/recogida_alimentos_santa_gema.jpg\" style=\"width:100%;\" /></div>";
			
			//echo "<br><div align=\"center bloque\"><a href=\"http://parrosantagema.blogspot.com/\" target=\"_blank\"><img src=\"".$urlOri."templates/nuevo1/images/despedida.jpg\" style=\"width:100%;\" /></a></div>";
		}
}
?>


	<?=getBloques("izquierda", 4);?>

</div>
<!-- #sidebar left -->