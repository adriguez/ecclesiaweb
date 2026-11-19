
<div class="col-lg-3 col-sm-6 col-md-4 col-xsl-6 col-pull-fix">

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2 OR tipo = 4 OR tipo = 5) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($rw['id'] == 886) $rw['texto'] = getValue("SELECT texto FROM paginas WHERE id = 1862",1);

		if($rw['texto'] != "")
		{
			echo "<div class=\"box-alt\">
					<h2 class=\"boxtitle".$rw['tipo']."\">".$rw['titulo']."</h2>
					<p>".$rw['texto']."</p>	
				</div>\n";
		}
	}
}

if($idparroquia == 13){

?>

<div class="box-alt">
	<h2 class="boxtitle"><?=getValue("SELECT titulo FROM paginas WHERE id = 1828",1);?></h2>
	<p><?=getValue("SELECT texto FROM paginas WHERE id = 1828",1);?></p>
</div>

<div class="box">
	<div class="indent">
		<div class="widget"><h3>Redes Sociales</h3></div>
					
		<div class="content-bloque bloqueshome">
			<div class="redes" style="text-align:center;margin-top:10px;">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/parroquiaUtiel/" title="Facebook"><img style="width:100%;" src="<?=$urlOri;?>/templates/mintra/images/facebook-red.jpg" /></a>
			</div>
		</div>
	</div>

</div>

<?php }else if($idparroquia == 599){ ?>

	<div class="box">
	<div class="indent">
		<div class="widget"><h3>Redes sociales</h3>
					
		<div class="content-bloque bloqueshome">
			<div class="redes" style="text-align:center;margin-top:10px;">
				
			<div class="row">
							<div class="col-md-6">
								<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/PSanJorgeBogota" title="Facebook"><img src="/templates/nuevo2/images/facebook.png" /></a>
							</div>
							<div class="col-md-6">							
								<a rel="nofollow" target="_blank" href="https://www.youtube.com/c/ParroquiadeSanJorgeBogotá"><img src="/templates/nuevo2/images/youtube.jpg" /></a>
							</div>
						</div>
			</div><br>
		</div>

</div>

<?php }


if($idparroquia == 211){

?>

<div class="box">
	<div class="indent">
		<div class="widget"><h3>Radio Santiago</h3></div>
					
		<div class="content-bloque bloqueshome">
			<div class="redes" style="text-align:center;margin-top:10px;">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="http://www.radiosantiago.com.ec" title="Radio Santiago"><img style="width:100%;" src="<?=$urlOri;?>/templates/mintra/images/radio_santiago.png" /></a>
			</div>
		</div>
	</div>

</div>

<?php } ?>

	<div class="box">
		<div class="indent">
				<?=getBloques("derecha", 2);?>
            	</div>
	</div> 

</div>