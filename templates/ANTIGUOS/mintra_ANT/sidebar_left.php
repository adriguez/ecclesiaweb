<div id="sidebar">

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 1 OR tipo = 3) ORDER BY tipo ASC";
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

if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{
			echo "<div class=\"box-alt\">
					<h2 class=\"boxtitle\">Petición de oraciones</h2>
					<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."images/oracion.jpg\" /></a></p>	
				</div>\n";
}

?>

	<div class="box">
		<div class="indent">
				<?=getBloques("izquierda", 2);?>
            	</div>
	</div> 

</div>
<!-- #sidebar -->