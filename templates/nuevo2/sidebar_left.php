	<div class="col-lg-3 col-sm-6 col-md-4 col-lg-pull-6 col-md-pull-8 col-xsl-6 sidebar left">

<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 3 OR (tipo = 1 AND parroquia = 19)) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{

		if($rw['id'] == 434) $rw['texto'] = getValue("SELECT texto FROM paginas WHERE id = 1886",1);

		if($rw['texto'] != "" || $rw['id'] == 434)
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

if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
{

	$extra = "";

	switch($idparroquia)
	{
		case 14;

			$txt = "Oramos contigo";
			$nameImagen = "unitatpeticion.jpg";
			$linkPeticion = $urlOri."oraciones.html";

		break;
		case 191;
			$txt = "Intenciones de Misa";
			$nameImagen = "intenciones_margarita.jpg";
			$linkPeticion = "https://api.whatsapp.com/send/?phone=0050764342002";
			$extra = " target=\"_blank\" ";
		break;
		default:
			$txt = "Petición de oraciones";
			$nameImagen = "oraciones2.jpg";
			$linkPeticion = $urlOri."oraciones.html";
		break;
	}

			echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle \">".$txt."</div>

					<div class=\"content-bloque bloqueshome\">

						<p><a href=\"".$linkPeticion."\" $extra title=\"".$txt."\"><img style=\"margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."images/".$nameImagen."\" /></a></p>	
				
					</div>

				</div>\n";
}

?>

<?php if($idparroquia == 191){


	echo "<div class=\"bloque bloqueOsc\">
					<div class=\"titulo boxtitle \">Reserve una cita</div>

					<div class=\"content-bloque bloqueshome\">

						<p><a href=\"https://outlook.office365.com/owa/calendar/ParroquiaSagradaFamiliadeMargarita@diocesiscolonkuna.org/bookings/\" target=\"_blank\" title=\"Reserve una cita con su sacerdote\"><img style=\"margin-top:5px;padding:1px;border:solid 1px #000;\" src=\"".$urlOri."templates/nuevo2/images/reservas_margarita_2.jpg\" /></a></p>	
				
					</div>

				</div>\n";

 } ?>


	<?=getBloques("izquierda", 5);?>

</div>
<!-- #sidebar left -->