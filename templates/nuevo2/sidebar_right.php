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
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/santjaumealmoines/" title="Facebook">
					<img style="width:100%;" src="<?=$urlOri;?>/templates/mintra/images/facebook-red.jpg" />
				</a>
			</div>
		</div>
</div>

<?php }  

if($idparroquia == 84){ ?>

<div class="bloque">
	<div class="icono redes_sociales">Youtube</div>
					
		<div class="content-bloque">
			<div align="center">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.youtube.com/channel/UC8gO55pu1crnKYZYVzxdrZA/live" title="Facebook">
					<img style="width:100%;" src="<?=$urlOri;?>/templates/nuevo2/images/logo_youtube.jpg" />
				</a>
			</div>
		</div>
</div>

<?php }

if($idparroquia == 427){

?>

<div class="bloque">
	<div class="icono redes_sociales">Redes Sociales</div>
					
		<div class="content-bloque">
			<div align="center">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/parroquiabellreguard/" title="Facebook">
					<img style="width:100%;" src="<?=$urlOri;?>/templates/mintra/images/facebook-red.jpg" />
				</a>
			</div>
		</div>
</div>

<?php } ?> 

<?php if($idparroquia == 602){ ?>

<div class="bloque bloqueOsc">
	<div class="titulo boxtitle2">Redes sociales</div>
	
	<div class="content-bloque bloqueshome">
	
	<p style="font-size: 18px;text-align: center;">Parroquia San Juan Evangelista</p>
	
<div class="fb-page" data-href="https://www.facebook.com/parroquiasanjuanevangelistasantiagoveraguas/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/parroquiasanjuanevangelistasantiagoveraguas/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/parroquiasanjuanevangelistasantiagoveraguas/">Parroquia San Juan Evangelista</a></blockquote></div>

<p style="font-size: 18px;text-align: center;">Juventud Evangelista</p>

<div class="fb-page" data-href="https://www.facebook.com/PSanJuanEvangelista2020/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/PSanJuanEvangelista2020/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/PSanJuanEvangelista2020/">Juventud Evangelista</a></blockquote></div>

	<p style="font-size: 18px;text-align: center;"><br>Instagram Juventud Evangelista</p>

	<a href="https://www.instagram.com/juventud_evangelista/" target="_blank"><img src="https://web.mintrared.com/images/instagram_logo.png" /></a>

	<p style="font-size: 18px;text-align: center;"><br>Instagram San Juan Evangelista</p>

	<a href="https://www.instagram.com/psan.juanevangelista" target="_blank"><img src="https://web.mintrared.com/images/instagram_logo.png" /></a>


	</div>

	<div class="bottom-home-osc"></div>
</div> 

<?php } ?>



<?php /*if($idparroquia == 613){ ?>

<div class="bloque bloqueOsc">

<div class="titulo">Podcast</div>

<iframe src="https://co.ivoox.com/es/player_es_podcast_881606_1.html" width="100%" style="border: 1px solid #D7D7D7;" height="440" frameborder="0" allowfullscreen="0" scrolling="no" ></iframe>

</div>

<?php }*/ ?>


	<?=getBloques("derecha", 5);?>

<?php if($idparroquia == 1131){ ?>

<div class="bloque">
	<div class="icono galeria">Santoral</div><br>
<script src="https://cdn.jsdelivr.net/gh/CursoCatolico/wikitolica-widgets@main/calendario.js" defer></script>
<div class="wikitolica-calendario" data-days="14"> </div>

</div>

<?php } ?>
</div>
<!-- #sidebar right -->