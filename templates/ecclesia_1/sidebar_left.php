<?php if($idparroquia == 1667) $clase = "col-lg-3 col-sm-6 col-md-4 col-xsl-6 sidebar left";
else $clase = "col-lg-3 col-sm-6 col-md-4 col-lg-pull-6 col-md-pull-8 col-xsl-6 sidebar left"; ?>
<div class="<?=$clase;?>">

<?php if($idparroquia == 73){ ?>
		<div class="bloque bloqueOsc">
			<div class="titulo boxtitle3">Cementerio Parroquial</div>
			
			<div class="content-bloque bloqueshome">
				<p><a href="http://www.parroquiasanmartinobispo.com/cementerio/398/">CEMENTERIO PARROQUIAL</a></p>
			</div>
		</div>
<?php } ?>

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3 OR (tipo = 1 AND parroquia = 19) OR (tipo = 0 AND parroquia = 2009) OR (tipo = 0 AND parroquia = 1667) OR (tipo = 2 AND parroquia = 1667) OR (tipo = 1 AND parroquia = 1667) OR (tipo = 0 AND parroquia = 73) OR (tipo = 0 AND parroquia = 1017)) ORDER BY tipo ASC, id DESC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($idparroquia == 571 && $rw['tipo'] == 3){
			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">PASTORAL PROFÉTICA</div>
					
					<div class=\"content-bloque bloqueshome\">
						<a href=\"".$urlOri."categoria-pastoral-profetica/422/\"><img src=\"https://web.mintrared.es/uploads/571/profetica.jpg\" /></a>
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
		else if($idparroquia == 2009 && $rw['tipo'] == 0){
			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">".getValue("SELECT titulo FROM paginas WHERE id = 2624",1)."</div>
					
					<div class=\"content-bloque bloqueshome\">
						".getValue("SELECT texto FROM paginas WHERE id = 2624",1)."

						<p class=\"links linksgal\" style=\"margin-bottom:0;\"><a href=\"".$urlOri."doxa-radio/2624/\" class=\"more moregal\">Acceder</a></p>
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
		else if($idparroquia == 1017 && $rw['tipo'] == 0){

			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">".getValue("SELECT titulo FROM paginas WHERE id = 3117",1)."</div>
					
					<div class=\"content-bloque bloqueshome\">
						".getValue("SELECT texto FROM paginas WHERE id = 3117",1)."
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";

			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle".$rw['tipo']."\">Jueves Eucarístico</div>
					
					<div class=\"content-bloque bloqueshome\">
						".getValue("SELECT texto FROM paginas WHERE id = 2234",1)."
					</div>\n
				<div class=\"bottom-home-osc\"></div></div>";
		}
		else if($rw['tipo'] == 0){
		
				echo "<div class=\"bloque bloqueOsc\">
				<div class=\"titulo boxtitle".$rw['tipo']."\">Facebook</div>
				
				<div class=\"content-bloque bloqueshome\">
				".$rw['texto']."
				</div>\n
				<div class=\"bottom-home-osc\"></div></div>";

		}
		else if($rw['texto'] != "")
		{

			if($idparroquia == 1667 && $rw['id'] == 943){
				echo "<div class=\"bloque bloqueOsc\">
				<div class=\"titulo boxtitle".$rw['tipo']."\">Hoja Parroquial</div>
				
				<div class=\"content-bloque bloqueshome\">
				<a href=\"https://www.xn--ascensionseorsesea-x0bg.com/hoja-parroquial/2210/\">
					<img src=\"https://web.mintrared.es/uploads/1667/secciones/".getValue("SELECT foto FROM secciones_fotos WHERE idseccion = 2210 ORDER BY idfoto ASC LIMIT 1",1)."\" />
				</a>
				</div>\n
			<div class=\"bottom-home-osc\"></div></div>";
			}
			else{
				echo "<div class=\"bloque bloqueOsc\">
						<div class=\"titulo boxtitle".$rw['tipo']."\">".$rw['titulo']."</div>
						
						<div class=\"content-bloque bloqueshome\">
							".$rw['texto']."
						</div>\n
					<div class=\"bottom-home-osc\"></div></div>";
			}
		}
	}
}

if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{

	switch($idparroquia)
	{

		case 30;
			$txt = "Petición de oraciones";
			$nameImagen = "adoracion_eucaristica.jpg";
		break;
		case 14;

			$txt = "Oramos contigo";
			$nameImagen = "oraciones3.jpg";

		break;
		default:
			$txt = "Petición de oraciones";
			$nameImagen = "oraciones2.jpg";
		break;
	}

			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle \">".$txt."</div>

					<div class=\"content-bloque bloqueshome\">

						<p><a href=\"".$urlOri."oraciones.html\" title=\"Petición de oraciones\"><img style=\"margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."images/".$nameImagen."\" /></a></p>	
				
					</div>

				</div>\n";
}

?>


	<?=getBloques("izquierda", 5);?>

</div>
<!-- #sidebar left -->