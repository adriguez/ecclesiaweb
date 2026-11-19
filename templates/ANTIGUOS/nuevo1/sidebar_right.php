<div class="sidebar right">

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
		<a rel="nofollow" target="_blank" href="https://twitter.com/purisimaquart"><img src="/templates/nuevo1/images/twitter.png" /></a>
	</div>
	
					</div>

</div>

<div class="bloque">
					<div class="titulo"><a class="linkBloque" href="http://www.purisimaconcepcionquart.es/iglesia-en-quart-de-poblet/106/">Iglesia en Quart de Poblet</a></div>
					

</div>

<?php } ?>

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2 OR tipo = 4 OR tipo = 5) ORDER BY tipo ASC";
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

?>


	<?=getBloques("derecha", 4);?>

</div>
<!-- #sidebar right -->