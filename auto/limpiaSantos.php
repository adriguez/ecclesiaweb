<?php

include('../_includes/config.php');

$sql = "SELECT id,nombre FROM santos";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs))
{

	$valor = html_entity_decode($rw['nombre']);

	$valor = str_replace("&nbsp;","",$valor);
	$valor = addslashes($valor);

	mysql_query("UPDATE santos SET nombre = '$valor' WHERE id = ".$rw['id'],$conex);

}
?>