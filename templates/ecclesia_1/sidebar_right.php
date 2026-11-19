<?php if($idparroquia != 1667){ ?>
	
<div class="col-lg-3 col-sm-6 col-md-4 col-xsl-6 col-pull-fix sidebar right">

<?php if($idparroquia == 587){ ?>

<div class="bloque bloqueOsc">
					<div class="titulo boxtitle2">Informaci&oacute;</div>
					
					<div class="content-bloque bloqueshome" style="caret-color: rgb(118, 118, 118); color: rgb(118, 118, 118); font-family: Lato, sans-serif;">
					
					<p style="font-size:14px;color:#000;">Rector:<br>
Mn. Ram&oacute;n Maria Vila</p>

<p style="font-size:14px;color:#000;">Vicari:<br>
P. Ram&oacute;n Cusid&oacute; SDB</p>

<p style="font-size:14px;color:#000;">Telf: 93.656.16.55<br>
Pla&ccedil;a: Carme Llin&aacute;s, 1<br>
Sant Vicen&ccedil; dels Horts
08620 Barcelona</p>
	
					</div>

				<div class="bottom-home-osc"></div></div>	

<?php } ?>

<?php if($idparroquia == 73){ ?>

<div class="bloques">
					<div class="titulo">Traducir p&aacute;gina</div>
					
					<div class="content-bloque bloqueshome" style="text-align:center;">

<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'es,en,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					</div>
					<div class="bottom-home-osc"></div>
</div>

<?php } ?>

<?php if($idparroquia == 14){ ?>

<div class="bloque bloqueOsc">
					<div class="titulo"><a href="http://www.unitatcostacalvia.com/dia-de-silencio/71/" style="font-family:'Ledger',arial,verdana,sans-serif;font-weight: normal;font-size: 16px;color: #FEDD00;height: 39px;padding-top: 20px;text-align: center;">Centro Espiritualidad Solidaria Maria de Nazaret</a></div>
					
					<div class="content-bloque bloqueshome">
						<div class="redes" style="text-align:center;margin-top:15px;">

							<a href="http://www.unitatcostacalvia.com/dia-de-silencio/71/"><img width="180" src="http://www.unitatcostacalvia.com/templates/nuevo2/images/unitatcosta_centro.jpg" /></a>
							<?php /*
							<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/pages/Unitat-Costa-Calvi%C3%A0/413930552086683?ref=bookmarks" title="Facebook"><img src="/templates/nuevo1/images/facebook.png" /></a>
							<a rel="nofollow" target="_blank" href="https://twitter.com/unicostacalvia"><img src="/templates/nuevo1/images/twitter.png" /></a>
							*/ ?>
							<div class="clear:both;"></div>
						</div>
	
					</div>
					<div class="bottom-home-osc"></div>

</div>

<?php }else if($idparroquia == 73){ /*

<div class="bloque bloqueOsc">
					<div class="titulo">Redes sociales</div>
					
					<div class="content-bloque bloqueshome">
						<div class="redes" style="text-align:center;margin-top:15px;">

							<h4>Parroquia San Mart&iacute;n Obispo</h4>
							<div class="row">
								<div class="col-md-6">
									<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/sanmartinobispo" title="Facebook"><img src="/templates/nuevo1/images/facebook.png" /></a>
								</div>
								<div class="col-md-6">
									<a rel="nofollow" target="_blank" href="https://twitter.com/CementerioCDS"><img src="/templates/nuevo1/images/twitter.png" /></a>							
								</div>
							</div>

							<h4>Cementerio</h4>
							<div class="row">
								<div class="col-md-6">
									<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/cementerioparroquial.callosadesegura" title="Facebook"><img src="/templates/nuevo1/images/facebook.png" /></a>
								</div>
								<div class="col-md-6">
									<a rel="nofollow" target="_blank" href="https://twitter.com/ParroquiaCDS"><img src="/templates/nuevo1/images/twitter.png" /></a>
								</div>
							</div>

							<div class="clear:both;"></div>
						</div>
	
					</div>
					<div class="bottom-home-osc"></div>
					
</div>*/ ?>
<?php }else if($idparroquia == 599){ ?>


	<div class="bloque bloqueOsc">
					<div class="titulo">Redes sociales</div>
					
					<div class="content-bloque bloqueshome">

						<div class="row">
							<div class="col-md-6">
								<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/PSanJorgeBogota" title="Facebook"><img src="/templates/nuevo2/images/facebook.png" /></a>
							</div>
							<div class="col-md-6">							
								<a rel="nofollow" target="_blank" href="https://www.youtube.com/c/ParroquiadeSanJorgeBogotá"><img src="/templates/nuevo2/images/youtube.jpg" /></a>
							</div>
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
			if($rw['id'] == 198){
				$imagenT = getValue("SELECT foto FROM secciones_fotos WHERE idseccion = '441' LIMIT 1",1);
				$rw['texto'] = str_replace("[IMAGEN]", $imagenT, $rw['texto']);
			}

			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">".$rw['titulo']."</div>
					
					<div class=\"content-bloque bloqueshome\">
						".$rw['texto']."	
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
	}
}

?>



<?php if($idparroquia == 613){ ?>

<div class="bloque bloqueOsc">

<div class="titulo">Podcast</div>

<iframe src="https://co.ivoox.com/es/player_es_podcast_881606_1.html" width="100%" style="border: 1px solid #D7D7D7;" height="440" frameborder="0" allowfullscreen="0" scrolling="no" ></iframe>

</div>

<?php } ?>

	<?=getBloques("derecha", 5);?>

</div>
<!-- #sidebar right -->

<?php } ?>