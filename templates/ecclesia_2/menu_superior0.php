<?php
//*******************************************************************************************************
//** (OM) INCLUDE CON EL MENU SUPERIOR
//** COPIADO DEL TEMPLATE ecclesia_1 y adaptado el html de los menus 

//*******************************************************************************************************
//** MENU INICIO
//*******************************************************************************************************

if($idparroquia != 1 && $idparroquia != 408){ ?>

    <li><a href="<?=$urlOri;?>">Inicio</a></li><?php 

} else { 

if($idparroquia == 1){ ?>

    <li><a href="#">Sacramentos</a>
        <ul>
            <li><a href="<?=$urlOri;?>bautismo/141/" title="Bautismo">Bautismo</a></li>
            <li><a href="<?=$urlOri;?>confirmacion/140/" title="Confirmación">Confirmación</a></li>
            <li><a href="<?=$urlOri;?>primera-comunion/199/" title="Primera Comunión">Primera Comunión</a></li>
            <li><a href="<?=$urlOri;?>confesion/201/" title="Confesión">Confesión</a></li>
            <li><a href="<?=$urlOri;?>matrimonio/195/" title="Matrimonio">Matrimonio</a></li>
            <li><a href="<?=$urlOri;?>uncion-de-enfermos/200/" title="Unción de enfermos">Unción de enfermos</a></li>
        </ul>
        </li>
<?php } else if($idparroquia == 408){ ?>
	<li><a href="#">Sacramentos</a>
		<ul>
			<li><a href="<?=$urlOri;?>bautismo/655/" title="Bautismo">Bautismo</a></li>
			<li><a href="<?=$urlOri;?>confirmacion/656/" title="Confirmación">Confirmación</a></li>
			<li><a href="<?=$urlOri;?>primera-comunion/657/" title="Primera Comunión">Primera Comunión</a></li>
			<li><a href="<?=$urlOri;?>confesion/658/" title="Confesión">Confesión</a></li>
			<li><a href="<?=$urlOri;?>matrimonio/659/" title="Matrimonio">Matrimonio</a></li>
			<li><a href="<?=$urlOri;?>uncion-de-enfermos/660/" title="Unción de enfermos">Unción de enfermos</a></li>
			<?php //(OM)15/10/2018 añadir esta pafina ?>
			<li><a href="<?=$urlOri;?>intenciones-de-misa-851/663/" title="Intenciones de Misa">Intenciones de Misa</a></li>
		</ul>
<?php } 

} 


//*******************************************************************************************************
//** MENU LA PARROQUIA
//*******************************************************************************************************

if($idparroquia == 426){

				echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-sant-jaume-apostol' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-sant-miquel-arcangel' AND parroquia = $idparroquia",0);
					$txtint2 = $id[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
					echo "</ul></li>";

}
 else if($idparroquia == 421){

					echo '<li><a href="#">Parroquias</a>';
					
					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'natividad-de-nuestra-senora-xalo' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'natividad-de-nuestra-senora-alcalali' AND parroquia = $idparroquia",0);
					$txtint2 = $id[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'santos-cosme-damian-lliber' AND parroquia = $idparroquia",0);
					$txtint3 = $id[2];
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'purisima-concepcion-parcent' AND parroquia = $idparroquia",0);
					$txtint4 = $id4[2];
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
					echo "</ul></li>";

	}


    else if($idparroquia == 234){

					//echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Parroquias <span class=\"caret\"></span></a>";

					echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-senes' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$guid1 = $id[2];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-velefique' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$guid2 = $id2[2];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-santa-maria-turrillas' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$guid3 = $id3[2];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-maria-del-rosario' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$guid4 = $id4[2];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-la-encarnacion' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$guid5 = $id5[2];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];



					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					if($id5 > 0) echo "<li><a href=\"".$urlOri.$guid5."/".$id5."/\">".$titulo5."</a></li>"; 
					if($id > 0) echo "<li><a href=\"".$urlOri.$guid1."/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$guid2."/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri.$guid3."/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$guid4."/".$id4."/\">".$titulo4."</a></li>"; 
					echo "</ul></li>";

					?>

					<li><a href="#">Oración y Liturgia</a>';
						<ul>
							<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
							<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
						</ul>
					</li>

					<?php

		}else if($idparroquia == 126){

				  echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-julian' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-pedro' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santiago' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-eulalia-manzaneda' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];



					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					if($id > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-julian/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-pedro/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."parroquia-santiago/".$id4."/\">".$titulo4."</a></li>"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-eulalia-manzaneda/".$id5."/\">".$titulo5."</a></li>"; 
					if($id7 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id7."/\">".$titulo7."</a></li>"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id6."/\">".$titulo6."</a></li>"; 
					echo "</ul></li>";

		} else if($idparroquia == 156){

					echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-gines-jara' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-somontin' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-urracal' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-roque-sufli' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-sebastian-sierro' AND parroquia = $idparroquia",0);
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					echo "<ul>";

					if($id3 > 0) echo "<li><a href=\"".$urlOri."historia/".$id3."/\">".$titulo3."</a></li>";
					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					if($id > 0) echo "<li><a href=\"".$urlOri."san-gines-jara/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."santa-maria-somontin/".$id2."/\">".$titulo2."</a></li>";  
					if($id4 > 0) echo "<li><a href=\"".$urlOri."santa-maria-urracal/".$id4."/\">".$titulo4."</a></li>";  
					if($id5 > 0) echo "<li><a href=\"".$urlOri."san-roque-sufli/".$id5."/\">".$titulo5."</a></li>";  
					if($id6 > 0) echo "<li><a href=\"".$urlOri."san-sebastian-sierro/".$id6."/\">".$titulo6."</a></li>";  
										echo "</ul></li>";

		}else if($idparroquia == 80){

					echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-la-mayor' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-pedro-martir' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-de-las-nieves' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];


					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					if($id > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria-la-mayor/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-pedro-martir/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."parroquia-santa-maria-de-las-nieves/".$id3."/\">".$titulo3."</a></li>"; 
					echo "</ul></li>";


		}else if($idparroquia == 14)
		{

					echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santa-maria-de-portals' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-lorenzo-de-palma-nova' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'stella-maris-de-magalluf' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'beato-junipero-serra-de-son-ferrer' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'nuestra-senora-de-toro' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					if($id > 0) echo "<li><a href=\"".$urlOri."santa-maria-de-portals/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."san-lorenzo-de-palma-nova/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."stella-maris-de-magalluf/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."beato-junipero-serra-de-son-ferrer/".$id4."/\">".$titulo4."</a></li>"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."nuestra-senora-de-toro/".$id5."/\">".$titulo5."</a></li>"; 
					echo "</ul></li>";

					echo '<li><a href="#">Destacamos</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'dia-de-silencio' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'carida' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'celebraciones' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'iniciacion-vida-cristiana' AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$id4 = $id4[0];

					$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'fundamento-vida-cristiana' AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$id5 = $id5[0];

					$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'casal-del-toro' AND parroquia = $idparroquia",0);
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					$id7 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'centro-espiritualidad-solidaria' AND parroquia = $idparroquia",0);
					$titulo7 = $id7[1];
					$id7 = $id7[0];

					echo "<ul>";

					if($id > 0) echo "<li><a href=\"".$urlOri."dia-de-silencio/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."carida/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."celebraciones/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."iniciacion-vida-cristiana/".$id4."/\">".$titulo4."</a></li>"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri."fundamento-vida-cristiana/".$id5."/\">".$titulo5."</a></li>"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri."casal-del-toro/".$id6."/\">".$titulo6."</a></li>"; 
					if($id7 > 0) echo "<li><a href=\"".$urlOri."centro-espiritualidad-solidaria/".$id7."/\">".$titulo7."</a></li>"; 
					echo "</ul></li>";
		}
		else{
			/* mintra
			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda' OR txt_int = 'parroquia-sant-jordi' OR txt_int = 'parroquia-san-francisco-de-paula') AND parroquia = $idparroquia LIMIT 1",1);

			/* nuevo1
			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda') AND parroquia = $idparroquia LIMIT 1",1);

			/* nuevo2
       		$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda') AND parroquia = $idparroquia LIMIT 1",1);
            */

       		/* ecclesia_!
			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda' OR txt_int = 'cementerio-parroquial' OR txt_int = 'excursiones-salidas-parroquiales') AND parroquia = $idparroquia LIMIT 1",1);
            */

			$id = getValue("SELECT id FROM paginas WHERE (txt_int = 'historia' OR txt_int = 'donde-esta' OR txt_int = 'horarios' OR txt_int = 'saluda' 
				OR txt_int = 'cementerio-parroquial' OR txt_int = 'excursiones-salidas-parroquiales') AND parroquia = $idparroquia LIMIT 1",1);


			if($id > 0)
			{

					if($idparroquia == 62) $txtP = "La Cofradía";
					else if($idparroquia == 119) $txtP = "Las parroquias";
					else $txtP = "La parroquia";
					
					echo '<li><a href="#">'.$txtP.'</a>';

					$id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'donde-esta' AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'saluda' AND parroquia = $idparroquia",0);
					if (isset($id4)) { 
						$titulo4 = $id4[1]; $id4 = $id4[0]; 
					} else { 
						$titulo4 = ""; $id4 = 0; 
					}

					if($idparroquia == 21)
					{
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'cementerio-parroquial' AND parroquia = $idparroquia",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];				

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'excursiones-salidas-parroquiales' AND parroquia = $idparroquia",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];										
					}
					else if($idparroquia == 24)
					{
						$id7 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sacramentos' AND parroquia = $idparroquia",0);
						$titulo7 = $id7[1];
						$id7 = $id7[0];		
					}
					else if($idparroquia == 139)
					{
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santiago-apostol' AND parroquia = $idparroquia",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];				

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-santa-maria-la-blanca' AND parroquia = $idparroquia",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];	
						
					}else if($idparroquia == 229){
						$id8 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-sant-jordi' AND parroquia = $idparroquia",0);
						$titulo8 = $id8[1];
						$id8 = $id8[0];

						$id9 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'parroquia-san-francisco-de-paula' AND parroquia = $idparroquia",0);
						$titulo9 = $id9[1];
						$id9 = $id9[0];
					}


					if($idparroquia == 84){
						$idSacerdote = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 384 AND parroquia = $idparroquia",0);
						$tituloSacerdotes = $idSacerdote[1];
						$guid = $idSacerdote[2];
						$idSacerdote = $idSacerdote[0];
					}

					if ($idparroquia == 336) {

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sacramentos' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];
					}

					if ($idparroquia == 19) {
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'capilla-de-adoracion' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'sistema-de-celulas-de-evangelizacion-parroquial' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];
					}

					//echo "<ul class=\"dropdown-menu\">";


					if($idparroquia == 9)
					{
						echo "<ul>";
						if($id2 > 0) echo "<li><a href=\"".$urlOri."on-estem/".$id2."/\">ON ESTEM</a></li>\n";  
						if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">SALUDA</a></li>\n"; 
						if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>\n"; 
						echo "<li><a href=\"".$urlOri."grupos-parroquiales.html\" title=\"Grups Parroquials\">GRUPS PARROQUIALS</a></li>\n";
						echo "<li><a href=\"".$urlOri."economia/55/\">ECONOMÍA</a></li>\n";
						echo "<li><a href=\"".$urlOri."historia/39/\">HISTÒRIA</a></li>\n";
						echo "</ul>";
					} else {	

					echo "<ul>";


					if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>";
					
					if($idparroquia == 19){
						if($id5 > 0) echo "<li><a href=\"".$urlOri."capilla-de-adoracion/".$id5."/\">".$titulo5."</a></li>\n"; 
						if($id6 > 0) echo "<li><a href=\"".$urlOri."sistema-de-celulas-de-evangelizacion-parroquial/".$id6."/\">".$titulo6."</a></li>\n"; 
						echo "<li><a href=\"http://www.salmerondrons360.com/parroquiavirgendelloretopuertodexabia2016ok/\" target=\"_blank\">Visita virtual</a></li>";
					}


					if($idSacerdote > 0) echo "<li><a href=\"".$urlOri.$guid."/".$idSacerdote."/\">".$tituloSacerdotes."</a></li>\n";

					if($id8 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id8."/\">".$titulo8."</a></li>"; 
					if($id9 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id9."/\">".$titulo9."</a></li>"; 

					if(isset($id5) && $id5 > 0) echo "<li><a href=\"".$urlOri."cementerio-parroquial/".$id5."/\">".$titulo5."</a></li>";
					if(isset($id6) && $id6 > 0) echo "<li><a href=\"".$urlOri."excursiones-salidas-parroquiales/".$id6."/\">".$titulo6."</a></li>";
					if(isset($id7) && $id7 > 0) echo "<li><a href=\"".$urlOri."sacramentos/".$id7."/\">".$titulo7."</a></li>";

					if($idparroquia == 25) echo "<li><a href=\"".$urlOri."/categoria-actualidad/65/\">Reflexión semanal</a></li>";
					if($idparroquia == 21) echo "<li><a href=\"".$urlOri."oraciones.html\">Petición de oraciones</a></li>";

					//(OM) 12/06/2018 Pestañas para Parroquias la pobla de Vallbona
					if($idparroquia == 31) {
						
						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'ermita-sant-sebastia' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."ermita-sant-sebastia/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'ermita-mas-de-tous' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."ermita-mas-de-tous/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santiago-apostol' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."santiago-apostol/".$id10."/\">".$titulo10."</a></li>\n"; 

						$id10 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'santisima-trinidad-y-san-jose' AND parroquia = $idparroquia",0);
						$titulo10 = $id10[1];
						$id10 = $id10[0];

						echo "<li><a href=\"".$urlOri."santisima-trinidad-y-san-jose/".$id10."/\">".$titulo10."</a></li>\n"; 

					}

					echo "</ul>"; }

					echo "</li>";
			}


			?>


<?php
//*******************************************************************************************************
//** MENU ORACION Y LITURGIA
//*******************************************************************************************************
?>
	<li><a href="#">Oración y Liturgia</a>
		<ul>
			<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
		<?php if($idparroquia <> 339){
		//(OM) 23/07/2018 En la seccion de Oracion y Liturgia deshabilitar la "LEctura de la misa en varios idiomas" 
		//  PARROQUIA SANTA MARÍA DE GUADALUPE - MEXICO
		?>
			<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
		<?php } ?>
		</ul>
	</li>

<?php 
} ?>

<?php
//*******************************************************************************************************
//** MENU GRUPOS PARROQUIALES
//*******************************************************************************************************

if($idparroquia != 9){ 

	if($idparroquia == 233) $txtGrupos = "Pastoral Castrense"; else $txtGrupos = "Grupos Parroquiales"; ?>

	<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="<?=$txtGrupos;?>"><?=$txtGrupos;?></a></li>

<?php } else {

	echo "<li><a href=\"".$urlOri."caritas/158/\" title=\"Cáritas\">Cáritas</a></li>";

} 
?>

<?php
//*******************************************************************************************************
//** MENU Textos Litúrgicos
//*******************************************************************************************************

if($idparroquia == 14){ ?>

	<li><a href="#">Textos Litúrgicos</a>
		<ul>
			<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas">Liturgia de las horas y Palabra de Dios hoy</a></li>
			<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Ordo Missae en idiomas">Ordo missae en idiomas</a></li>
		</ul>
	</li>

<?php } 
?>


<?php
//*******************************************************************************************************
//** MENU AGENDA
//*******************************************************************************************************
?>

		<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
			


<?php
//*******************************************************************************************************
//** MENU DOCUMENTOS
//*******************************************************************************************************

		if($idparroquia == 68){
			$valores = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 337",0);
			$tituloGuid = $valores[1];
				
			$guidPag = $valores[2];
			$idPag = $valores[0];

			echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>";
		}else{

			echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";	
		} 
?>
			
<?php
//*******************************************************************************************************
//** MENU DOCUMENTOS
//*******************************************************************************************************

		$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

		if($idparroquia == 1 || $idparroquia == 408)
			echo "<li><a href=\"https://www.donoamiiglesia.es/es\" target=\"_blank\" title=\"Dono a mi Iglesia\">Dono a mi Iglesia</a></li>\n";
		else if($idparroquia == 30) 
			echo "<li><a href=\"http://www.donoamiiglesia.es/\" target=\"_blank\">Donativos</a></li>";
		else if($id > 0) 
			echo "<li><a href=\"".$urlOri."donativos/".$id."/\">Donativos</a></li>";
?>
<?php
//*******************************************************************************************************
//** MENU CONTACTO
//*******************************************************************************************************
?>
		<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>
