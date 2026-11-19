<div id="sidebar2">


<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2 OR tipo = 4 OR tipo = 5) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
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

<div class="box">
	<div class="indent">
		<div class="widget"><h3>Redes Sociales</h3></div>
					
		<div class="content-bloque bloqueshome">
			<div class="redes" style="text-align:center;margin-top:10px;">
				<a rel="nofollow" target="_blank" style="margin-right:15px;" href="https://www.facebook.com/asuncion.nuestrasenora?fref=ts" title="Facebook"><img style="width:100%;" src="/templates/mintra/images/facebook-red.jpg" /></a>
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
<!-- #sidebar -->