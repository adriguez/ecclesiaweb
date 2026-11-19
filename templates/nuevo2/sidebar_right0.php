<div class="col-lg-3 col-sm-6 col-md-4 col-xsl-6 col-pull-fix sidebar right">


<?php if($idparroquia == 162){ ?>

<div class="bloque bloqueOsc">
					<div class="titulo">Traducir p&aacute;gina</div>
					
					<div class="content-bloque bloqueshome" style="text-align:center;color:#433B38;">

<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'ca,en,fr'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
<div class="clear:both;"></div>
					</div>
					<div class="bottom-home-osc"></div>

</div>
<style type="text/css">
.goog-logo-link{display: none;}
</style>

<?php } ?>


<?php if($idparroquia == 14){ ?>

<div class="bloque bloqueOsc">
					<div class="titulo"><a href="http://www.unitatcostacalvia.com/dia-de-silencio/71/" style="font-family:'Ledger',arial,verdana,sans-serif;font-weight: normal;font-size: 16px;color: #FEDD00;height: 39px;padding-top: 20px;text-align: center;">Centro Espiritualidad Solidaria Maria de Nazaret</a></div>
					
					<div class="content-bloque bloqueshome">
						<div class="redes" style="text-align:center;margin-top:15px;">

							<a href="http://www.unitatcostacalvia.com/dia-de-silencio/71/"><img width="180" src="http://www.unitatcostacalvia.com/images/centro_unitatcosta.png" /></a>
							<?php /*
							<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/pages/Unitat-Costa-Calvi%C3%A0/413930552086683?ref=bookmarks" title="Facebook"><img src="/templates/nuevo1/images/facebook.png" /></a>
							<a rel="nofollow" target="_blank" href="https://twitter.com/unicostacalvia"><img src="/templates/nuevo1/images/twitter.png" /></a>
							*/ ?>
							<div class="clear:both;"></div>
						</div>
	
					</div>
					<div class="bottom-home-osc"></div>

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
			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">".$rw['titulo']."</div>
					
					<div class=\"content-bloque bloqueshome\">
						".$rw['texto']."	
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
	}
}


if($idparroquia == 428){

?>

<div class="bloque">
	<div class="icono redes_sociales">Redes Sociales</div>
					
		<div class="content-bloque">
			<div align="center">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/parroquiabellreguard/?ref=settings" title="Facebook">
					<img style="width:100%;" src="<?=$urlOri;?>/templates/mintra/images/facebook-red.jpg" />
				</a>
			</div>
		</div>
</div>

<?php } ?> 

	<?=getBloques("derecha", 5);?>

</div>
<!-- #sidebar right -->