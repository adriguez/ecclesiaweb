<?php
//*******************************************************************************************************
//** (OM) INCLUDE CON EL MENU SUPERIOR
//** COPIADO DEL TEMPLATE ecclesia_1 y adaptado el html de los menus 

//*******************************************************************************************************
//** MENU INICIO
//*******************************************************************************************************

if($idparroquia == 1294){
?>

<li><a href="<?=$urlOri;?>">Inicio</a></li>
<?php


$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
$tituloHorario = $idHorario[1];
$idHorario = $idHorario[0];

if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";

echo '<li><a href="#">La Parroquia</a>';

$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2004 AND parroquia = $idparroquia",0);
$txtint1 = $id[2];
$titulo1 = $id[1];
$id = $id[0];

$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2000 AND parroquia = $idparroquia",0);
$txtint2 = $id2[2];
$titulo2 = $id2[1];
$id2 = $id2[0];

$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2001 AND parroquia = $idparroquia",0);
$txtint3 = $id3[2];
$titulo3 = $id3[1];
$id3 = $id3[0];

$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2002 AND parroquia = $idparroquia",0);
$txtint4 = $id4[2];
$titulo4 = $id4[1];
$id4 = $id4[0];

echo "<ul>";

if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 

echo "</ul></li>";


echo '<li><a href="#">Vida sacramental</a>';

$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2015 AND parroquia = $idparroquia",0);
$txtint1 = $id[2];
$titulo1 = $id[1];
$id = $id[0];

$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2016 AND parroquia = $idparroquia",0);
$txtint2 = $id2[2];
$titulo2 = $id2[1];
$id2 = $id2[0];

$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2018 AND parroquia = $idparroquia",0);
$txtint3 = $id3[2];
$titulo3 = $id3[1];
$id3 = $id3[0];

$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2019 AND parroquia = $idparroquia",0);
$txtint4 = $id4[2];
$titulo4 = $id4[1];
$id4 = $id4[0];

$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2020 AND parroquia = $idparroquia",0);
$txtint5 = $id5[2];
$titulo5 = $id5[1];
$id5 = $id5[0];

$id6 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2021 AND parroquia = $idparroquia",0);
$txtint6 = $id6[2];
$titulo6 = $id6[1];
$id6 = $id6[0];

echo "<ul>";

if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
if($id5 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id5."/\">".$titulo5."</a></li>\n"; 
if($id6 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id6."/\">".$titulo6."</a></li>\n"; 
echo "</ul></li>";


echo '<li><a href="#">Economía y transparencia</a>';

$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2022 AND parroquia = $idparroquia",0);
$txtint1 = $id[2];
$titulo1 = $id[1];
$id = $id[0];

$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2003 AND parroquia = $idparroquia",0);
$txtint2 = $id2[2];
$titulo2 = $id2[1];
$id2 = $id2[0];


echo "<ul>";

if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
echo "</ul></li>";


$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 2023 AND parroquia = $idparroquia",0);
$txtint1 = $id[2];
$titulo1 = $id[1];
$id = $id[0];

if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";



echo '<li><a href="#">Grupos parroquiales</a>';


$id = getValue("SELECT id, nombre FROM grupos_pastorales WHERE id = 1552 AND parroquia = $idparroquia",0);
$titulo1 = $id[1];
$id = $id[0];

$id2 = getValue("SELECT id, nombre FROM grupos_pastorales WHERE id = 1553 AND parroquia = $idparroquia",0);
$titulo2 = $id2[1];
$id2 = $id2[0];

$id3 = getValue("SELECT id, nombre FROM grupos_pastorales WHERE id = 1554 AND parroquia = $idparroquia",0);
$titulo3 = $id3[1];
$id3 = $id3[0];

echo "<ul>";

if($id > 0) echo "<li><a href=\"".$urlOri.limpiarCadena($titulo1,'archivo')."_".$id.".html\">".$titulo1."</a></li>\n";
if($id2 > 0) echo "<li><a href=\"".$urlOri.limpiarCadena($titulo2,'archivo')."_".$id2.".html\">".$titulo2."</a></li>\n"; 
if($id2 > 0) echo "<li><a href=\"".$urlOri.limpiarCadena($titulo3,'archivo')."_".$id3.".html\">".$titulo3."</a></li>\n"; 
echo "</ul></li>";

?>
<li><a href="<?=$urlOri;?>#news" title="Noticias">Noticias</a></li>
<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia">Contacto</a></li>

<?php 

}
else{

if($idparroquia != 1 && $idparroquia != 408){ ?>

    <li><a href="<?=$urlOri;?>"><?php if($idioma=="en") echo "Home"; else echo "Inicio"; ?></a></li>

	<?php if($idparroquia == 540){ ?>
	
		<li><a href="<?=$urlOri;?><?=getValue("SELECT txt_int FROM paginas WHERE id = 2140",1);?>/2140/"><?=getValue("SELECT titulo FROM paginas WHERE id = 2140",1);?></a></li>

	<?php } ?>

<?php 

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

if($idparroquia == 805){?>

	<li><a href="<?=$urlOri;?>parroquias/1435/" title="Parroquias de la Diócesis de Cartago">Parroquias</a></li>
	
<?php } ?>

<?php if($idparroquia == 588){ ?>
	<li><a href="#">Sacramentos</a>
		<ul>
			<li><a href="<?=$urlOri;?>santa-eucaristia/1165/" title="Santa Eucaristía">Santa Eucaristía</a></li>
			<li><a href="<?=$urlOri;?>adoracion-al-santisimo/1158/" title="Adoración al Santísimo ">Adoración al Santísimo</a></li>
			<li><a href="<?=$urlOri;?>sacramento-reconciliacion/1166/" title="Sacramento de la Reconciliación">Sacramento de la Reconciliación</a></li>
			<li><a href="<?=$urlOri;?>uncion-enfermos/1167/" title="Unción de los Enfermos">Unción de los Enfermos</a></li>
			<li><a href="<?=$urlOri;?>exequias-misas-cuerpo-presente/1168/" title="Exequias o misas de cuerpo presente">Exequias o misas de "cuerpo presente"</a></li>
			<li><a href="<?=$urlOri;?>sacramento-bautismo/1169/" title="Sacramento del Bautismo">Sacramento del Bautismo</a></li>
			<li><a href="<?=$urlOri;?>sacramento-matrimonio/1170/" title="Sacramento del Matrimonio">Sacramento del Matrimonio</a></li>
		</ul>
<?php }



//*******************************************************************************************************
//** MENU LA PARROQUIA
//*******************************************************************************************************

if($idparroquia == 102){
	echo '<li><a href="https://parroquiamontesion.ecclesiared.es/" target="_blank">La parroquia</a>';
}
else if($idparroquia == 1294){

	echo '<li><a href="#">Parroquias</a>';

		$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
		$txtint1 = $id[2];
		$titulo1 = $id[1];
		$id = $id[0];

		$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'san-vicente-ferrer-paterna' AND parroquia = $idparroquia",0);
		$txtint2 = $id2[2];
		$titulo2 = $id2[1];
		$id2 = $id2[0];

		$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'nuestra-senora-terramelar' AND parroquia = $idparroquia",0);
		$txtint3 = $id3[2];
		$titulo3 = $id3[1];
		$id3 = $id3[0];

		$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
		$tituloHorario = $idHorario[1];
		$idHorario = $idHorario[0];

		echo "<ul>";

		if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
		if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
		if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
		if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
		echo "</ul></li>";
}

else if($idparroquia == 1732){

	echo '<li><a href="#">La Parroquia</a>';

		$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
		$txtint1 = $id[2];
		$titulo1 = $id[1];
		$id = $id[0];

		$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-nuestra-sra-de-fatima' AND parroquia = $idparroquia",0);
		$txtint2 = $id2[2];
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
else if($idparroquia == 1712){

	echo '<li><a href="#">Parroquias</a>';

		$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
		$txtint1 = $id[2];
		$titulo1 = $id[1];
		$id = $id[0];

		$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-sant-joan-baptista' AND parroquia = $idparroquia",0);
		$txtint2 = $id2[2];
		$titulo2 = $id2[1];
		$id2 = $id2[0];

		$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-crist-rei' AND parroquia = $idparroquia",0);
		$txtint3 = $id3[2];
		$titulo3 = $id3[1];
		$id3 = $id3[0];

		$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-sant-vicens-martir' AND parroquia = $idparroquia",0);
		$txtint4 = $id4[2];
		$titulo4 = $id4[1];
		$id4 = $id4[0];

		$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-l-assumpcio' AND parroquia = $idparroquia",0);
		$txtint5 = $id5[2];
		$titulo5 = $id5[1];
		$id5 = $id5[0];	
		

		$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
		$tituloHorario = $idHorario[1];
		$idHorario = $idHorario[0];

		echo "<ul>";

		if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
		if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
		if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
		if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
		if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
		if($id5 > 0) echo "<li><a href=\"".$urlOri.$txtint5."/".$id5."/\">".$titulo5."</a></li>\n"; 
		echo "</ul></li>";
}

else if($idparroquia == 1718){

	echo '<li><a href="#">Parroquias</a>';

		$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
		$txtint1 = $id[2];
		$titulo1 = $id[1];
		$id = $id[0];

		$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'nuestra-sra-dolores-dalcahue' AND parroquia = $idparroquia",0);
		$txtint2 = $id2[2];
		$titulo2 = $id2[1];
		$id2 = $id2[0];

		$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'nuestra-sra-patrocinio' AND parroquia = $idparroquia",0);
		$txtint3 = $id3[2];
		$titulo3 = $id3[1];
		$id3 = $id3[0];
		

		$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
		$tituloHorario = $idHorario[1];
		$idHorario = $idHorario[0];

		echo "<ul>";

		if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
		if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
		if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
		if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
		echo "</ul></li>";
}
else if($idparroquia == 1091){

				echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santa-ana' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santisima-trinidad' AND parroquia = $idparroquia",0);
					$txtint2 = $id2[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];

					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-jose' AND parroquia = $idparroquia",0);
					$txtint3 = $id3[2];
					$titulo3 = $id3[1];
					$id3 = $id3[0];

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santa-maria-magdalena' AND parroquia = $idparroquia",0);
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
else if($idparroquia == 1281){

	echo '<li><a href="#">Parroquias</a>';

		$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'santa-maria-la-mayor' AND parroquia = $idparroquia",0);
		$txtint1 = $id[2];
		$titulo1 = $id[1];
		$id = $id[0];

		$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'asuncion-de-nuestra-senora' AND parroquia = $idparroquia",0);
		$txtint2 = $id2[2];
		$titulo2 = $id2[1];
		$id2 = $id2[0];

		$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'asuncion-de-nuestra-senora-tormillo' AND parroquia = $idparroquia",0);
		$txtint3 = $id3[2];
		$titulo3 = $id3[1];
		$id3 = $id3[0];

		$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'la-inmaculada' AND parroquia = $idparroquia",0);
		$txtint4 = $id4[2];
		$titulo4 = $id4[1];
		$id4 = $id4[0];

		$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'san-andres-apostol' AND parroquia = $idparroquia",0);
		$txtint5 = $id5[2];
		$titulo5 = $id5[1];
		$id5 = $id5[0];

		$id6 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'san-gil' AND parroquia = $idparroquia",0);
		$txtint6 = $id6[2];
		$titulo6 = $id6[1];
		$id6 = $id6[0];

		$id7 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'san-pedro-y-san-pablo' AND parroquia = $idparroquia",0);
		$txtint7 = $id7[2];
		$titulo7 = $id7[1];
		$id7 = $id7[0];

		$id8 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'santa-maria-magdalena' AND parroquia = $idparroquia",0);
		$txtint8 = $id8[2];
		$titulo8 = $id8[1];
		$id8 = $id8[0];

		$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
		$tituloHorario = $idHorario[1];
		$idHorario = $idHorario[0];


		echo "<ul>";

		if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
		if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
		if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
		if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
		if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
		if($id5 > 0) echo "<li><a href=\"".$urlOri.$txtint5."/".$id5."/\">".$titulo5."</a></li>\n"; 
		if($id6 > 0) echo "<li><a href=\"".$urlOri.$txtint6."/".$id6."/\">".$titulo6."</a></li>\n"; 
		if($id7 > 0) echo "<li><a href=\"".$urlOri.$txtint7."/".$id7."/\">".$titulo7."</a></li>\n"; 
		if($id8 > 0) echo "<li><a href=\"".$urlOri.$txtint8."/".$id8."/\">".$titulo8."</a></li>\n"; 
		echo "</ul></li>";
}else if($idparroquia == 426){

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
else if($idparroquia == 322){

				echo '<li><a href="#">Parroquias</a>';

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-bartolome-de-carino' AND parroquia = $idparroquia",0);
					$txtint1 = $id[2];
					$titulo1 = $id[1];
					$id = $id[0];

					$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-adrian-de-veiga' AND parroquia = $idparroquia",0);
					$txtint2 = $id[2];
					$titulo2 = $id2[1];
					$id2 = $id2[0];
					
					$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-san-adrian-de-veiga' AND parroquia = $idparroquia",0);
					$txtint3 = $id[2];
					$titulo3 = $id3[1];
					$id3 = $id3[0];
					
					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santa-maria-de-mera' AND parroquia = $idparroquia",0);
					$txtint4 = $id[2];
					$titulo4 = $id4[1];
					$id4 = $id4[0];
					
					$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'parroquia-de-santiago-de-mera' AND parroquia = $idparroquia",0);
					$txtint5 = $id[2];
					$titulo5 = $id5[1];
					$id5 = $id5[0];
					
					$id6 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE txt_int = 'capilla-de-xiao-do-trebo' AND parroquia = $idparroquia",0);
					$txtint6 = $id[2];
					$titulo6 = $id6[1];
					$id6 = $id6[0];

					$idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					$tituloHorario = $idHorario[1];
					$idHorario = $idHorario[0];


					echo "<ul>";

					if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>\n";
					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n"; 
					if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
					if($id5 > 0) echo "<li><a href=\"".$urlOri.$txtint5."/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri.$txtint6."/".$id6."/\">".$titulo6."</a></li>\n"; 
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
						<?php if($showmisa){ ?>
							<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
						<?php } ?>
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

		}else if($idparroquia == 1974){

					echo '<li><a href="#">Parroquias</a>';
  
					  $id = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-miguel-catholic-church' AND parroquia = $idparroquia",0);
					  $titulo1 = $id[1];
					  $id = $id[0];
  
					  $id2 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-jose-catholic-church' AND parroquia = $idparroquia",0);
					  $titulo2 = $id2[1];
					  $id2 = $id2[0];
  
					  $id3 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'our-lady-of-perpetual-help-catholic-church' AND parroquia = $idparroquia",0);
					  $titulo3 = $id3[1];
					  $id3 = $id3[0];
  
					  $id4 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-pedro-mission' AND parroquia = $idparroquia",0);
					  $titulo4 = $id4[1];
					  $id4 = $id4[0];
  
					  $id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'san-luis-rey-mission' AND parroquia = $idparroquia",0);
					  $titulo5 = $id5[1];
					  $id5 = $id5[0];
  
					  $idHorario = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'horarios' AND parroquia = $idparroquia",0);
					  $tituloHorario = $idHorario[1];
					  $idHorario = $idHorario[0];

					  $idHistoria = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'historia' AND parroquia = $idparroquia",0);
					  $tituloHistoria = $idHistoria[1];
					  $idHistoria = $idHistoria[0];
    
					  echo "<ul>";
  
					  if($idHorario > 0) echo "<li><a href=\"".$urlOri."horario/".$idHorario."/\">".$tituloHorario."</a></li>";
					  if($idHistoria > 0) echo "<li><a href=\"".$urlOri."historia/".$idHistoria."/\">".$tituloHistoria."</a></li>";
					  if($id > 0) echo "<li><a href=\"".$urlOri."san-miguel-catholic-church/".$id."/\">".$titulo1."</a></li>";
					  if($id2 > 0) echo "<li><a href=\"".$urlOri."san-jose-catholic-church/".$id2."/\">".$titulo2."</a></li>";  
					  if($id3 > 0) echo "<li><a href=\"".$urlOri."our-lady-of-perpetual-help-catholic-church/".$id3."/\">".$titulo3."</a></li>"; 
					  if($id4 > 0) echo "<li><a href=\"".$urlOri."san-pedro-mission/".$id4."/\">".$titulo4."</a></li>"; 
					  if($id5 > 0) echo "<li><a href=\"".$urlOri."san-luis-rey-mission/".$id5."/\">".$titulo5."</a></li>"; 
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

					$id = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 84 AND parroquia = $idparroquia",0);
					$titulo1 = $id[1];
					$txtint1 = $id[2];
					$id = $id[0];

					/*$id2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 739 AND parroquia = $idparroquia",0);
					$titulo2 = $id2[1];
					$txtint2 = $id2[2];
					$id2 = $id2[0];*/

					/*$id3 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 738 AND parroquia = $idparroquia",0);
					$titulo3 = $id3[1];
					$txtint3 = $id3[2];
					$id3 = $id3[0];*/

					$id4 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 737 AND parroquia = $idparroquia",0);
					$titulo4 = $id4[1];
					$txtint4 = $id4[2];
					$id4 = $id4[0];

					/*$id5 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 736 AND parroquia = $idparroquia",0);
					$titulo5 = $id5[1];
					$txtint5 = $id5[2];
					$id5 = $id5[0];*/

					$id6 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 129 AND parroquia = $idparroquia",0);
					$titulo6 = $id6[1];
					$txtint6 = $id6[2];
					$id6 = $id6[0];

					echo "<ul>";

					if($id > 0) echo "<li><a href=\"".$urlOri.$txtint1."/".$id."/\">".$titulo1."</a></li>\n";
					//if($id2 > 0) echo "<li><a href=\"".$urlOri.$txtint2."/".$id2."/\">".$titulo2."</a></li>\n";  
					//if($id3 > 0) echo "<li><a href=\"".$urlOri.$txtint3."/".$id3."/\">".$titulo3."</a></li>\n"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri.$txtint4."/".$id4."/\">".$titulo4."</a></li>\n"; 
					//if($id5 > 0) echo "<li><a href=\"".$urlOri.$txtint5."/".$id5."/\">".$titulo5."</a></li>\n"; 
					if($id6 > 0) echo "<li><a href=\"".$urlOri.$txtint6."/".$id6."/\">".$titulo6."</a></li>\n"; 
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
					else if($idparroquia == 119 || $idparroquia == 1071) $txtP = "Las parroquias";
					else if($idioma == "en") $txtP = "The parish";
					else if($idparroquia == 2055 || $idparroquia == 2159 || $idparroquia == 2324 || $idparroquia == 2586 || $idparroquia == 2814) $txtP = "La Diócesis";
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

						$id9 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'columbario' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo9 = $id9[1];
						$id9 = $id9[0];
					}

					//echo "<ul class=\"dropdown-menu\">";
					

					if($idparroquia == 1011){

						$arraySecciones = array();
						$arraySecciones[] = array("id" => 1726, "titulo" => "Horarios", "slug" => "horarios");
						$arraySecciones[] = array("id" => 1725, "titulo" => "Ubicación", "slug" => "ubicacion");
						$arraySecciones[] = array("id" => 1724, "titulo" => "Historia", "slug" => "historia");
						$arraySecciones[] = array("id" => 1738, "titulo" => "Descripción", "slug" => "descripcion");
						$arraySecciones[] = array("id" => 3247, "titulo" => "Guía de visita y galería fotográfica", "slug" => "guia-visita-galeria-fotografica");
						$arraySecciones[] = array("id" => 1740, "titulo" => "Concesión del título de Basílica", "slug" => "concesion-titulo-basilica");
						$arraySecciones[] = array("id" => 1742, "titulo" => "Celebraciones propias e indulgencias concedidas", "slug" => "celebraciones-propias-indulgencias-concedidas");

						foreach($arraySecciones as $i=>$val){
							$seccionesHtml .= "<li><a href=\"".$urlOri.$val['slug']."/".$val['id']."/\">".$val['titulo']."</a></li>\n";
						}

						echo "<ul>";
						echo $seccionesHtml;
						echo "</ul>";
					}
					else if($idparroquia == 9)
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

					if ($idparroquia == 501) {
						$id5 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'consagrados' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo5 = $id5[1];
						$id5 = $id5[0];

						echo "<li><a href=\"".$urlOri."consagrados/".$id5."/\">".$titulo5."</a></li>";

						$id5 = 0;
						$titulo5 = "";

						$id6 = getValue("SELECT id, titulo FROM paginas WHERE txt_int = 'pastorales-parroquiales' AND parroquia = $idparroquia LIMIT 1",0);
						$titulo6 = $id6[1];
						$id6 = $id6[0];

						echo "<li><a href=\"".$urlOri."pastorales-parroquiales/".$id6."/\">".$titulo6."</a></li>";

						$id6 = 0;
						$titulo6 = "";

					}

					
					if($idparroquia == 2055) echo "<li><a href=\"".$urlOri."parroquias/2940/\" title=\"Parroquias de la Diócesis de Caguas\">Parroquias</a></li>\n";
					else if($idparroquia == 2159) echo "<li><a href=\"".$urlOri."parroquias/3095/\" title=\"Parroquias de la Diócesis de Acarigua - Araure\">Parroquias</a></li>\n";

					if($id > 0) echo "<li><a href=\"".$urlOri."historia/".$id."/\">".$titulo1."</a></li>";
					if($id2 > 0) echo "<li><a href=\"".$urlOri."donde-esta/".$id2."/\">".$titulo2."</a></li>";  
					if($id3 > 0) echo "<li><a href=\"".$urlOri."horarios/".$id3."/\">".$titulo3."</a></li>"; 
					if($id4 > 0) echo "<li><a href=\"".$urlOri."saluda/".$id4."/\">".$titulo4."</a></li>";
					
					if($idparroquia == 817) echo "<li><a href=\"".$urlOri."oficina-parroquial/1684/\">Oficina parroquial</a></li>\n";
					if($idparroquia == 2021) echo "<li><a href=\"".$urlOri."difuntos/2645/\">Difuntos</a></li>\n";

					if($idparroquia == 877){
						$tituloEvans = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '1511' AND parroquia = $idparroquia LIMIT 1",0);
						$txtInt = $tituloEvans[1];
						$tituloEvans = $tituloEvans[0];
						echo "<li><a href=\"".$urlOri."".$txtInt."/1511/\">".$tituloEvans."</a></li>";
					}
					
					if($idparroquia == 1134){
						echo "<li><a href=\"".$urlOri."donativos/1943/\" title=\"Donativos\">Donativos</a></li>";
						echo "<li><a href=\"".$urlOri."contacto.html\" title=\"Contactar con la parroquia\">Contactanos</a></li>";
						echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";	
					}

					if($idparroquia == 19){
						if($id5 > 0) echo "<li><a href=\"".$urlOri."capilla-de-adoracion/".$id5."/\">".$titulo5."</a></li>\n"; 
						if($id6 > 0) echo "<li><a href=\"".$urlOri."sistema-de-celulas-de-evangelizacion-parroquial/".$id6."/\">".$titulo6."</a></li>\n"; 
						echo "<li><a href=\"http://www.salmerondrons360.com/parroquiavirgendelloretopuertodexabia2016ok/\" target=\"_blank\">Visita virtual</a></li>";
					}

					if($idparroquia == 1071){
						echo "<li><a href=\"".$urlOri."nuestra-senora-de-la-asuncion/1813/\">".getValue("SELECT titulo FROM paginas WHERE id = 1813",1)."</a></li>\n";
						echo "<li><a href=\"".$urlOri."san-miguel-de-arcangel/1814/\">".getValue("SELECT titulo FROM paginas WHERE id = 1814",1)."</a></li>\n";
						echo "<li><a href=\"".$urlOri."san-esteban/1815/\">".getValue("SELECT titulo FROM paginas WHERE id = 1815",1)."</a></li>\n";
						echo "<li><a href=\"".$urlOri."santa-maria-magdalena/1816/\">".getValue("SELECT titulo FROM paginas WHERE id = 1816",1)."</a></li>\n";
					}

					if($idSacerdote > 0) echo "<li><a href=\"".$urlOri.$guid."/".$idSacerdote."/\">".$tituloSacerdotes."</a></li>\n";

					if($id8 > 0) echo "<li><a href=\"".$urlOri."parroquia-sant-jordi/".$id8."/\">".$titulo8."</a></li>"; 
					if($id9 > 0) echo "<li><a href=\"".$urlOri."parroquia-san-francisco-de-paula/".$id9."/\">".$titulo9."</a></li>"; 

					if(isset($id5) && $id5 > 0) echo "<li><a href=\"".$urlOri."cementerio-parroquial/".$id5."/\">".$titulo5."</a></li>";
					if(isset($id6) && $id6 > 0) echo "<li><a href=\"".$urlOri."excursiones-salidas-parroquiales/".$id6."/\">".$titulo6."</a></li>";
					if(isset($id7) && $id7 > 0) echo "<li><a href=\"".$urlOri."sacramentos/".$id7."/\">".$titulo7."</a></li>";

					if($idparroquia == 25) echo "<li><a href=\"".$urlOri."/categoria-actualidad/65/\">Reflexión semanal</a></li>";
					if($idparroquia == 21) echo "<li><a href=\"".$urlOri."oraciones.html\">Petición de oraciones</a></li>";

					if(isset($id9) && $id9 > 0 && $idparroquia == 19) echo "<li><a href=\"".$urlOri."columbario/".$id9."/\">".$titulo9."</a></li>\n"; 

					if(isset($id10) && $id10 > 0 && $idparroquia == 336) echo "<li><a href=\"".$urlOri."sacramentos/".$id10."/\">".$titulo10."</a></li>\n"; 

					if($idparroquia == 376){
						echo "<li><a href=\"".$urlOri."criptas-parroquial/1784/\">".getValue("SELECT titulo FROM paginas WHERE id = 1784",1)."</a></li>";
						echo "<li><a href=\"".$urlOri."solicitud-de-certificados/1783/\">".getValue("SELECT titulo FROM paginas WHERE id = 1783",1)."</a></li>";
					}					
					
					if($idparroquia == 1264){
						echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";
						echo "<li><a href=\"".$urlOri."sacramentos/1962/\" title=\"Sacramentos\">Sacramentos</a></li>";
					}

					if($idparroquia == 1627){
						echo "<li><a href=\"".$urlOri."corpus-sacerdotal/2163/\" title=\"Corpus Sacerdotal\">Corpus Sacerdotal</a></li>";
						echo "<li><a href=\"".$urlOri."censo-parroquial/3174/\" title=\"Censo parroquial\">Censo parroquial</a></li>";
					}

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

					if($idparroquia == 588) echo "<li><a href=\"".$urlOri."segmentos-formativos/1171/\">Segmentos Formativos</a></li>\n"; 

					if($idparroquia == 1319){
						echo "<li><a href=\"".$urlOri."horario-de-confesiones/2048/\">".getValue("SELECT titulo FROM paginas WHERE id = 2048",1)."</a></li>\n";
					}
					
					echo "</ul>"; }

					echo "</li>";

					if($idparroquia == 1627){
						
						echo "<li><a href=\"#\">Sacramentos</a><ul>
						<li>
						<a href=\"".$urlOri."bautismo/3188\">Bautismo</a>
						</li></ul>";
					}
			}

			if($idparroquia == 1319){

				$arraySecciones = array();
				$arraySecciones[] = array("id" => 2049, "titulo" => "Santiago del Monte", "slug" => "santiago-del-monte");
				$arraySecciones[] = array("id" => 2050, "titulo" => "Montúfar", "slug" => "montufar");
				$arraySecciones[] = array("id" => 2051, "titulo" => "Calle Mesén", "slug" => "calle-mesen");
				$arraySecciones[] = array("id" => 2052, "titulo" => "Girales", "slug" => "girales");
				$arraySecciones[] = array("id" => 2053, "titulo" => "San Juan", "slug" => "san-juan");
				$arraySecciones[] = array("id" => 2054, "titulo" => "Villas de Ayarco", "slug" => "villas-de-ayarco");

				foreach($arraySecciones as $i=>$val){
					$seccionesHtml .= "<li><a href=\"".$urlOri.$val['slug']."/".$val['id']."/\">".$val['titulo']."</a></li>\n";
				}

				echo "<li><a href=\"#\">Filiales</a><ul>";
				echo $seccionesHtml;
				echo "</ul></li>";
		
			}

			

			if($idparroquia == 2055){
				echo "<li><a href=\"".$urlOri."tribunal-ecclesiastico/3115/\">TRIBUNAL</a></li>\n";
				echo "<li><a href=\"".$urlOri."libreria-corpus-christi/3116/\">LIBRERIA</a></li>\n";
				echo "<li><a href=\"".$urlOri."obra-vocacional-san-andres/2939/\">VOCACIONES</a></li>\n";
			}
			
			if($idparroquia == 1134){
				echo "<li><a href=\"#\">Sacramentos</a>";
				echo "<ul><li><a href=\"".$urlOri."bautismos/1955/\">Bautismos</a></li>";
				echo "<li><a href=\"".$urlOri."primera-comunion/2633/\">Primera comunión</a></li>";
				echo "<li><a href=\"".$urlOri."confirmacion/2634/\">Confirmación</a></li>";
				echo "<li><a href=\"".$urlOri."matrimonio/2632/\">Matrimonio</a></li>";
				echo "<li><a href=\"".$urlOri."catequesis-de-adultos/2635/\">Catequesis de adultos</a></li>";
				echo "<li><a href=\"".$urlOri."catequesis-de-ninos/2625/\">Catequesis de niños</a></li>";
				echo "</ul></li>";
				
				echo "<li><a href=\"".$urlOri."despacho-parroquial/2642/\">Despacho parroquial</a></li>";
			}


			?>


<?php
//*******************************************************************************************************
//** MENU ORACION Y LITURGIA
//*******************************************************************************************************

			if($idparroquia == 978){
				echo "<li><a href=\"".$urlOri."agustino-soy/1685/\" title=\"Agustino Soy\">Agustino Soy</a></li>\n";
			}

			if($idparroquia == 1115){
				echo "<li><a href=\"".$urlOri."capillas-oratorios/1912/\" title=\"Capillas y Oratorios\">Capillas y Oratorios</a></li>\n";
			}

			if($idparroquia == 2052){
				echo "<li><a href=\"".$urlOri."fiestas-patronales-2025/2963/\" title=\"Fiestas patronales 2025\">".getValue("SELECT titulo FROM paginas WHERE id = '2963'",1)."</a></li>\n";
			}

?>
	<li><a href="#"><?php if($idioma == "en") echo "Prayer and Liturgy"; else echo "Oración y Liturgia"; ?></a>
	
		<ul>
			<?php if($showmisa){ ?>
				<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
			<?php } ?>
			
			<?php if($idparroquia == 855){
				$val = getValue("SELECT titulo, txt_int FROM paginas WHERE id = '1531'",0); ?>
				<li><a href="<?=$urlOri;?><?=$val['txt_int'];?>/1531/" title="<?=$val['titulo'];?>"><?=$val['titulo'];?></a></li>
			<?php } ?>

			<?php if($idparroquia == 538){ 
			
				//$valores3 = getValue("SELECT id, titulo, activar, txt_int FROM paginas WHERE id = 893",0);
				//$valores2 = getValue("SELECT id, titulo, activar, txt_int FROM paginas WHERE id = 894",0);
				
				echo "<li><a href=\"".$urlOri."categoria-pildoras-de-fe/377/\" title=\"".$valores3['titulo']."\">P&iacute;ldoras de Fe</a></li>\n";
				echo "<li><a href=\"".$urlOri."categoria-espacio-interior/376/\" title=\"".$valores2['titulo']."\">Espacio Interior</a></li>\n";
			?>
			
			
			
			<?php } ?>
			<?php if($idioma == "en"){ ?>
				<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgy of the Hours and the Word of God Today">Liturgy of the Hours and the Word of God Today</a></li>
			<?php }else{ ?>
				<li><a href="<?=$urlOri;?>oraciones-y-liturgia/" title="Liturgia de las horas y Palabra de Dios hoy">Liturgia de las horas y Palabra de Dios hoy</a></li>
			<?php } ?>
		<?php if($idparroquia <> 339){
		//(OM) 23/07/2018 En la seccion de Oracion y Liturgia deshabilitar la "LEctura de la misa en varios idiomas" 
		//  PARROQUIA SANTA MARÍA DE GUADALUPE - MEXICO
		if($idioma == "en"){ ?>
			<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Reading of the mass in different languages">Reading of the mass in different languages</a></li>
		<?php }else{ ?>
			<li><a href="<?=$urlOri;?>misa-en-varios-idiomas/" title="Lectura de la misa en diferentes idiomas">Lectura de la misa en diferentes idiomas</a></li>
		<?php } ?>
		<?php } ?>
		
		</ul>
	</li>

					<?php if($idparroquia == 588){ ?>
					<li><a href="<?=$urlOri;?>catequesis/1085/" title="Catequesis">Catequesis</a></li>
					<?php } ?>
<?php 
} ?>

<?php
//*******************************************************************************************************
//** MENU GRUPOS PARROQUIALES
//*******************************************************************************************************

if($idparroquia == 487){
	
	?>
	
	<li><a href="#">Equipos de animación</a>
		<ul>
			<li><a href="#" title="Catequesis">Catequesis</a>
				<ul>
					<li><a href="<?=$urlOri;?>catequesis-bautismal/1172/" title="Catequesis Bautismal">Catequesis Bautismal</a></li>
					<li><a href="<?=$urlOri;?>catequesis-ninos-y-ninas/1173/" title="Catequesis de niños y niñas">Catequesis de niños y niñas</a></li>
					<li><a href="<?=$urlOri;?>catequesis-confirmacion/1174/" title="Catequesis de Confirmación">Catequesis de Confirmación</a></li>
					<li><a href="<?=$urlOri;?>catequesis-iniciacion-cristiana/1175/" title="Catequesis de Iniciación Cristiana">Catequesis de Iniciación Cristiana</a></li>
					<li><a href="<?=$urlOri;?>catequesis-matrimonial/1176/" title="Catequesis Matrimonial">Catequesis Matrimonial</a></li>
				</ul>
			</li>
			<li><a href="#" title="Liturgia">Liturgia</a>
				<ul>
					<li><a href="<?=$urlOri;?>ministros-extraordinarios-comunion/1177/" title="Ministros Extraordinarios de la Comunión">Ministros Extraordinarios de la Comunión</a></li>
					<li><a href="<?=$urlOri;?>lectores/1178/" title="Lectores">Lectores</a></li>
					<li><a href="<?=$urlOri;?>ornato/1179/" title="Ornato">Ornato</a></li>
					<li><a href="<?=$urlOri;?>animadores-canto/1180/" title="Animadores del canto">Animadores del canto</a></li>
					<li><a href="<?=$urlOri;?>servidores-del-altar/1181/" title="Servidores del Altar">Servidores del Altar</a></li>
				</ul>
			</li>
			<li><a href="#" title="Pastorales">Pastorales</a>
				<ul>
					<li><a href="<?=$urlOri;?>pastoral-juvenil/1182/" title="Pastoral Juvenil">Pastoral Juvenil</a></li>
					<li><a href="<?=$urlOri;?>pastoral-social/1183/" title="Pastoral Social">Pastoral Social</a></li>
					<li><a href="<?=$urlOri;?>pastoral-comunidades/1184/" title="Pastoral de Comunidades">Pastoral de Comunidades</a></li>
					<li><a href="<?=$urlOri;?>pastoral-evangelizacion/1185/" title="Pastoral de Evangelización">Pastoral de Evangelización</a></li>
					<li><a href="<?=$urlOri;?>pastoral-familiar/1186/" title="Pastoral Familiar">Pastoral Familiar</a></li>
					<li><a href="<?=$urlOri;?>pastoral-josefina/1187/" title="Pastoral Josefina">Pastoral Josefina</a></li>
				</ul>
			</li>
			<li><a href="#" title="Asociaciones y Grupos de Servicio">Asociaciones y Grupos de Servicio</a>
				<ul>
					<li><a href="<?=$urlOri;?>sagrada-familia/1188/" title="Sagrada Familia">Sagrada Familia</a></li>
					<li><a href="<?=$urlOri;?>apostolado-oracion-sagrado-corazon-jesus/1189/" title="Apostolado de la Oración del Sagrado Corazón de Jesús">Apostolado de la Oración del Sagrado Corazón de Jesús</a></li>
					<li><a href="<?=$urlOri;?>amigos-san-jose/1190/" title="Amigos de San José">Amigos de San José</a></li>
					<li><a href="<?=$urlOri;?>guardia-santisimo/1191/" title="Guardia del Santísimo">Guardia del Santísimo</a></li>
				</ul>
			</li>
			<li><a href="<?=$urlOri;?>camino-neocateumenal/1192/" title="Camino neocatecumenal">Camino neocatecumenal</a></li>
			<li><a href="<?=$urlOri;?>plan-pastoral-sistema-integral-nueva-evangelizacion/1193/" title="Plan Pastoral - Sistema Integral de la nueva Evangelización">Plan Pastoral - Sistema Integral de la nueva Evangelización</a></li>
		</ul>
	</li>
	
	<?php
	
} else if($idparroquia != 9){ 

	if($idparroquia == 233) $txtGrupos = "Pastoral Castrense"; 
	else if($idparroquia == 14 || $idparroquia == 7) $txtGrupos = "Grupos";
	else if($idparroquia == 538) $txtGrupos = "Actividades";
	else if($idparroquia == 1011) $txtGrupos = "Actividad Pastoral";
	else if($idparroquia == 102) $txtGrupos = "Hermandad";
	else if($idioma == "en") $txtGrupos = "Parish groups";
	else if($idparroquia == 2055) $txtGrupos = "Grupos Apostólicos";
	else $txtGrupos = "Grupos Parroquiales";
	
	if($idparroquia == 538){

		$titulo1 = getValue("SELECT titulo, txt_int FROM paginas WHERE id = 895",0);
		$txtint1 = $titulo1[1];
		$titulo1 = $titulo1[0];
		
		$titulo2 = getValue("SELECT titulo, txt_int FROM paginas WHERE id = 896",0);
		$txtint2 = $titulo2[1];
		$titulo2 = $titulo2[0];
		
		?>
	
	<li><a href="#" title="<?=$txtGrupos;?>"><?=$txtGrupos;?></a>
			<ul>
				<li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li>
				<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="Grupos parroquiales">Grupos parroquiales</a></li>
				<li><a href="<?=$urlOri;?>sacramentos/898/" title="Sacramentos">Sacramentos</a></li>
				<li><a href="<?=$urlOri;?>categoria-catequesis/380/" title="<?=$titulo1;?>"><?=$titulo1;?></a></li>
				<li><a href="<?=$urlOri;?><?=$txtint2;?>/896/" title="<?=$titulo2;?>"><?=$titulo2;?></a></li>
			</ul>
	</li>
	
	<?php
		
	}else{
	
	?>

	<li><a href="<?=$urlOri;?>grupos-parroquiales.html" title="<?=$txtGrupos;?>"><?=$txtGrupos;?></a></li>

	<?php if($idparroquia == 1319){ ?>
		<li><a href="#" title="Sacramentos">Sacramentos</a>
			<ul>
				<li><a href="<?=$urlOri;?>bautismo/2077/" title="Bautismo">Bautismo</a></li>
				<li><a href="<?=$urlOri;?>primera-comunion/2079/" title="Primera comunión">Primera comunión</a></li>
				<li><a href="<?=$urlOri;?>confirmacion/2078/" title="Confirmación">Confirmación</a></li>
				<li><a href="<?=$urlOri;?>matrimonio/2080/" title="Matrimonio">Matrimonio</a></li>
			</ul>
	</li>
	<?php } ?>
	
	<?php } ?>

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
			<?php if($showmisa){ ?>
			<li><a href="<?=$urlOri;?>misa-online.html" title="Misa online">Misa online</a></li>
			<?php } ?>
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

		<?php if($idparroquia == 538){ ?><li><a href="<?=$urlOri;?>radio/897/" title="Radio">Radio</a></li><?php } ?>
		<?php if($idparroquia != 1134){ ?><li><a href="<?=$urlOri;?>eventos.html" title="Agenda">Agenda</a></li><?php } ?>
			
		<?php if($idparroquia == 1011){ ?>
			<li><a href="#">Nuestros santos</a>
				<ul>
					<li><a href="<?=$urlOri;?>san-pedro-poveda/3248/" title="San Pedro Poveda">San Pedro Poveda</a></li>
					<li><a href="<?=$urlOri;?>beato-manuel-lozano-lolo/3249/" title="Beato Manuel Lozano LOLO">Beato Manuel Lozano "LOLO"</a></li>
					<li><a href="<?=$urlOri;?>beatos-martires-1936/3250/" title="Beatos Mártires 1936">Beatos Mártires 1936</a></li>
				</ul>
			</li>
		<?php } ?>

<?php
//*******************************************************************************************************
//** MENU DOCUMENTOS
//*******************************************************************************************************

if($idparroquia != 1264){
		if($idparroquia == 68){
			$valores2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 337",0);
			$tituloGuid = $valores2[1];
				
			$guidPag = $valores2[2];
			$idPag = $valores2[0];

			echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>";
		}else{

			if($idioma == "en") echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documents\">Documents</a></li>";	
			else if($idparroquia != 1319 && $idparroquia != 1134) echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";	
			else if($idparroquia == 1319 && date('Y-m-d') >= '2023-11-14') echo "<li><a href=\"".$urlOri."documentos/\" title=\"Documentos\">Documentos</a></li>";	

			if($idparroquia == 1134){
				echo "<li><a href=\"".$urlOri."eventos.html\" title=\"Eventos\">Eventos</a></li>";
			}
		} 
}
else{
	echo "<li><a href=\"".$urlOri."#\" title=\"Casa de Encuentro\">Casa de Encuentro</a><ul>";

	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2036",1)."/2036/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2036'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2036'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2035",1)."/2035/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2035'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2035'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2034",1)."/2034/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2034'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2034'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2033",1)."/2033/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2033'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2033'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2032",1)."/2032/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2032'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2032'",1)."</a></li>";

	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2060",1)."/2060/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2060'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2060'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2061",1)."/2061/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2061'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2061'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2062",1)."/2062/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2062'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2062'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2063",1)."/2063/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2063'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2063'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2064",1)."/2064/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2064'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2064'",1)."</a></li>";
	echo "<li><a href=\"".$urlOri.getValue("SELECT txt_int FROM paginas WHERE id = 2065",1)."/2065/\" title=\"".getValue("SELECT titulo FROM paginas WHERE id = '2065'",1)."\">".getValue("SELECT titulo FROM paginas WHERE id = '2065'",1)."</a></li>";
	
	echo "</ul></li>";	
}
?>
			
<?php
//*******************************************************************************************************
//** MENU DOCUMENTOS
//*******************************************************************************************************

	if($idparroquia != 588 && $idparroquia != 1134 && $idparroquia != 2021){

		if($idparroquia == 974) $donativosTxt = "Ofrendas";
		else if($idioma == "en") $donativosTxt = "Donations";
		else $donativosTxt = "Donativos";

		$id = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

		if($idparroquia == 1 || $idparroquia == 408)
			echo "<li><a href=\"https://www.donoamiiglesia.es/es\" target=\"_blank\" title=\"Dono a mi Iglesia\">Dono a mi Iglesia</a></li>\n";
		else if($idparroquia == 30) 
			echo "<li><a href=\"https://www.donoamiiglesia.es/\" target=\"_blank\">Donativos</a></li>";
		else if($idparroquia == 5)
			echo "<li><a href=\"https://www.donoamiiglesia.es/san/Home#!/donar/b4fe0590-ed3e-e611-80e8-005056b101e1\" target=\"_blank\">Donativos</a></li>";
		else if($idparroquia == 7)
			echo "<li><a href=\"https://www.donoamiiglesia.es/san/Home#!/donar/d2fe0590-ed3e-e611-80e8-005056b101e1\" target=\"_blank\">Donativos</a></li>";
		else if($donativosUrl == "1") echo "<li><a href=\"https://www.ecclesiared.es/donativos/?donar=".$idparroquia."/\" target=\"_blank\">Donativos</a></li>\n";
		else if($id > 0) 
			echo "<li><a href=\"".$urlOri."donativos/".$id."/\">".$donativosTxt."</a></li>";

		if($idparroquia == 7){
			$valores2 = getValue("SELECT id, titulo, txt_int FROM paginas WHERE id = 774",0);
			$tituloGuid = $valores2[1];
				
			$guidPag = $valores2[2];
			$idPag = $valores2[0];
			echo "<li><a href=\"".$urlOri.$guidPag."/".$idPag."/\">".$tituloGuid."</a></li>";
		}
		
	}
?>

<?php if($idparroquia == 588){ ?>
					<li><a href="<?=$urlOri;?>recursos/1200/" title="Recursos">Recursos</a></li>
					<?php } ?>

<?php
//*******************************************************************************************************
//** MENU CONTACTO
//*******************************************************************************************************
?>

	<?php if($idparroquia == 1319){ ?>
	
		<li><a href="<?=$urlOri;?>bingo-2024/2293/" title="Bingo 2024">Bingo 2024</a></li>
	<?php } ?>

		<?php if($idparroquia != 1134 && $idparroquia != 2021){ ?>
			<li><a href="<?=$urlOri;?>contacto.html" title="Contactar con la parroquia"><?php if($idioma == "en") echo "Contact"; else echo "Contacto"; ?></a></li>
		<?php }else if($idparroquia == 2021){ ?>
			<li><a href="<?=$urlOri;?>sacramentos/2639/" title="SACRAMENTOS">SACRAMENTOS</a></li>
			<li><a href="<?=$urlOri;?>mausoleo/2651/" title="Mausoleo">MAUSOLEO</a></li>
		<?php } ?>

		<?php } // else parroquia valterna ?>