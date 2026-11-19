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
					<div class=\"titulo boxtitle".$rw['tipo']."\"><i>".$rw['titulo']."</i></div>
					
					<div class=\"content-bloque bloqueshome\">
						".$rw['texto']."
					</div>\n
				</div>";
		}
	}
}

?>


	<?=getBloques("izquierda", 4);?>

</div>
<!-- #sidebar left -->