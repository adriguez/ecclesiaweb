
	<div class="col-lg-3 col-sm-6 col-md-4 col-lg-pull-6 col-md-pull-8 col-xsl-6">

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
	if($idparroquia == 697){
		echo "<div class=\"box-alt\">
		<h2 class=\"boxtitle\">Petición de oraciones</h2>
		<p>".getValue("SELECT pre_oraciones FROM configuracion_base WHERE parroquia = '$idparroquia'",1)."</p>	
		<p><a href=\"".$urlOri."oraciones.html\" class=\"buttonNew pabloNew\" title=\"Petición de oraciones\">Acceder a la petición de oraciones</a></p>
	</div>\n";
	}
	else{

		echo "<div class=\"box-alt\">
		<h2 class=\"boxtitle\">Petición de oraciones</h2>
		<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"width:100%;margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."images/oracion.jpg\" /></a></p>	
	</div>\n";
	}
}

?>

		<div class="box">
			<div class="indent">
					<?=getBloques("izquierda", 2);?>
	            	</div>
		</div> 

	</div>