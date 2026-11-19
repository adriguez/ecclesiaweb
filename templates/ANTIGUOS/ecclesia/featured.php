<?php 

if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 

$sql = "SELECT titulo, foto FROM galeria_fotos WHERE parroquia = ".$idparroquia." AND horizontal = 1 ORDER BY rand() LIMIT 10";
$result = mysql_query($sql,$conex) or die (mysql_error());

$featured = "";

while($rw = mysql_fetch_assoc($result))
{
	$urlFoto = "";

	$foto = $urlOri."uploads/".$idparroquia."/big_".$rw['foto'];

	$featured .= "<div class=\"slide\">
			<a href=\"$urlFoto\"><img src=\"$foto\" alt=\"".$rw['titulo']."\" width=\"612\" height=\"290\"/></a>
		</div>";
}

?>

	<div style="clear:both;"></div>

	<!-- Slider -->
	<div id="front-slider" class="front-slider">
		<div class="slides_container">
			<?=$featured;?>
		</div>         

		<a href="#" class="prev">Anterior</a>
		<a href="#" class="next">Siguiente</a>
	</div>
	<!-- End of Slider -->

<?php }else{

echo getBienvenida();

 } ?>