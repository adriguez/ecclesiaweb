<div class="sidebar left">

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($rw['texto'] != "")
		{
			echo "<div class=\"bloque\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">".$rw['titulo']."</div>
					
					<div class=\"content-bloque bloqueshome\">
						".$rw['texto']."
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
	}
}

if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{

	switch($idparroquia)
	{
		case 14;

			$txt = "Oramos contigo";
			$nameImagen = "oraciones3.jpg";

		break;
		default:
			$txt = "Petición de oraciones";
			$nameImagen = "oraciones2.jpg";
		break;
	}

			echo "<div class=\"bloque\">
					<div class=\"titulo boxtitle\">".$txt."</div>

					<div class=\"content-bloque bloqueshome\">

						<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."images/".$nameImagen."\" /></a></p>	
				
					</div>

				</div>\n";
}

?>


	<?=getBloques("izquierda", 5);?>

</div>
<!-- #sidebar left -->