<div class="col-lg-3 col-sm-6 col-md-4 col-xsl-6 col-pull-fix sidebar right">

<?php if($idparroquia == 162){ ?>

<div class="bloque idioma">
					<div class="titulo"><i>Traducir página</i></div>
					
					<div class="content-bloque bloqueshome">

<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'ca,fr,en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        
        
	
					</div>

</div>

<?php } ?>

<?php if($idparroquia == 9){ ?>


<div class="bloque idioma">
					<div class="titulo"><i>Traducir página</i></div>
					
					<div class="content-bloque bloqueshome">

<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'ca,en,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
        
	
					</div>

</div>



<div class="bloque">
					<div class="titulo"><i>Redes Sociales</i></div>
					
					<div class="content-bloque bloqueshome">
	<div class="redes" style="text-align:center;margin-top:10px;">
		<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/parroquia.purissimaconcepcio?ref=tn_tnmn" title="Facebook"><img src="/templates/nuevo1/images/facebook.png" /></a>
		<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://twitter.com/purisimaquart"><img src="/templates/nuevo1/images/twitter.png" /></a>
		<a rel="nofollow" target="_blank" href="https://www.instagram.com/purissimaquart/"><img src="/templates/nuevo1/images/instagram.png" width="32" /></a>
	</div>
	
					</div>

</div>

<div class="bloque">
					<div class="titulo"><a class="linkBloque" href="http://www.purisimaconcepcionquart.es/iglesia-en-quart-de-poblet/106/">Iglesia en Quart de Poblet</a></div>
					

</div>

<?php } else if($idparroquia == 19){ ?>
<div class="bloque">
					<div class="titulo"><i>Visita Virtual</i></div>
					
					<div class="content-bloque bloqueshome" style="text-align:center;">
<div id="flashContent">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="240" height="600" id="banner" align="middle">
				<param name="movie" value="banner.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="http://www.parroquiadelmar.com/templates/nuevo1/banner/banner.swf" width="240" height="600">
					<param name="movie" value="banner.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
					<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" />
					</a>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
		</div>
					</div>

</div>
<?php } ?>

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2 OR tipo = 4 OR tipo = 5) AND parroquia != 989 ORDER BY tipo ASC";
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

			if($rw['titulo'] == "Despacho Parroquial" && $idparroquia == 65){
				
				echo "<div class=\"bloque\">
					<div class=\"titulo\"><i>Comunidad Pasionista</i></div>
					
					<div class=\"content-bloque\">
						".getValue("SELECT texto FROM paginas WHERE id = 1151",1)."<br><br>
						<p class=\"links linksgal\"><a href=\"".$urlWeb."/comunidad-pasionista/1151/\" class=\"more moregal\">Seguir leyendo</a></p>
					</div></div>";
				
				echo "<div class=\"bloque\">
					<div class=\"titulo\"><i>Redes Sociales</i></div>
					
					<div class=\"content-bloque bloqueshome\">
						<div class=\"redes\" style=\"text-align:center;margin-top:10px;\">
							<a rel=\"nofollow\" target=\"_blank\" style=\"margin-right:15px;\" href=\"https://www.facebook.com/pasionistasscor/\" title=\"Facebook\"><img src=\"/templates/nuevo1/images/facebook.png\" /></a>
							<a rel=\"nofollow\" target=\"_blank\" href=\"https://www.instagram.com/pasionistas_scor/\"><img src=\"/templates/nuevo1/images/instagram.png\" width=\"32\" /></a>
						</div>
					</div></div>";
			}

				
		}
	}
}

?>


	<?php 
	
	if($idparroquia == 538 && getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{
		$imagen=$urlOri."images/oracion.jpg";

		if ($idparroquia==65) { $imagen=$urlOri."images/oracion_65.jpg";}

			echo "<div class=\"bloque\">
					<h2 class=\"titulo boxtitle\">Petici&oacute;n de oraciones</h2>
					<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"width:100%;margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$imagen."\" /></a></p>	
				</div>\n";

		if($idparroquia == 65){
			echo "<div align=\"center bloque\"><img src=\"".$urlOri."templates/nuevo1/images/recogida_alimentos_santa_gema.jpg\" style=\"width:100%;\" /></div>";
		}
}

?>


	<?=getBloques("derecha", 4);?>
	

</div>
<!-- #sidebar right -->