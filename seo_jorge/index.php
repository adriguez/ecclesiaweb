<?php

include('../_includes/config.php');

if(isset($_POST['idmod']) && $_POST['idmod'] > 0 && isset($_POST['titulo']) && isset($_POST['descripcion']))
{
	$idmod = intval($_POST['idmod']);

	$titulo = addslashes($_POST['titulo']);
	$desc = addslashes($_POST['descripcion']);

	mysql_query("UPDATE seo_datos SET titulo = '$titulo', descripcion = '$desc', modificado = 1 WHERE id = $idmod",$conex);
}

$sql = "SELECT * FROM seo_datos ORDER BY txt_int ASC";
$rs = mysql_query($sql,$conex) or die (mysql_error());

$tabla = "";

while($fila = mysql_fetch_assoc($rs))
{

	$tabla .= "	<tr>
        			<td>".$fila['txt_int']."</td>
            			<td style=\"text-align:center;\"><img src=\"".$fila['modificado'].".png\" /></td>
            			<td style=\"text-align:center;\"><a href=\"index.php?mod=".$fila['id']."\" title=\"Modificar\"><img src=\"modificar.png\" /></a></td>
       		</tr>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SEO Web EcclesiaRed</title>
<style type="text/css">
<!--
@import url("style.css");
-->

body{font-family:verdana,sans-serif;}
h2{font-weight:normal;}

</style>
</head>
<body>

	<h2>Textos SEO</h2>

<?php if(isset($_GET['mod']) && $_GET['mod'] > 0){ 

$idmod = intval($_GET['mod']);

$sql = "SELECT * FROM seo_datos WHERE id = $idmod";
$rs = mysql_query($sql,$conex);

$fila = mysql_fetch_assoc($rs);

?>

<div id="mod-seo">

<form method="post" name="seo" id="seo" action="index.php">

<fieldset><legend>Modificar texto SEO</legend>

<label>Título</label>
<p><input type="text" name="titulo" id="titulo" value="<?=stripslashes($fila['titulo']);?>" /></p>

<label>Metadescripción</label>
<p><textarea name="descripcion" id="descripcion"><?=stripslashes($fila['descripcion']);?></textarea></p>

<p><input type="submit" name="enviar" id="enviar" value="Guardar datos" /></p>

</fieldset>

<input type="hidden" name="idmod" value="<?=$idmod;?>" id="idmod" />

</form>

</div>

<?php } ?>

<table id="gradient-style" summary="Meeting Results" width="100%" style="width:800px">
    <thead>
    	<tr>
        	<th scope="col">Sección</th>
            <th scope="col" style="text-align:center;">Modificado</th>
            <th scope="col" style="text-align:center;">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?=$tabla;?>
    </tbody>
</table>

</body>
</html>