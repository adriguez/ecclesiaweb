<?php

include('../_includes/config.php');

function domingos_del_mes($mes, $anho){
    
    $fecha1 = strtotime($anho.'-'.$mes.'-01'); 
    $fecha2 = strtotime($anho.'-'.$mes.'-'.date("t",mktime(0,0,0,$mes,1,$anho))); 
    
    for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
        if((strcmp(date('D',$fecha1),'Sun')==0)){
            $do[] = date('Y-m-d',$fecha1);
        }
    }

    return $do;
}

$meses = array(4, 5, 6, 7, 8, 9, 10);
$sql = array();

foreach($meses as $i=>$mes)
{

	$anyo = "2016";

	if($mes <= 9) $mes = "0".$mes;

	$domingos = domingos_del_mes($mes, $anyo);
	
	foreach($domingos as $a=>$fecha)
	{

		$sql[] = "INSERT INTO misal_intenciones (parroquia, hora, fecha, intencion, tipo) VALUES ('17', '1405', '$fecha', 'MISA', '4')";
		$sql[] = "INSERT INTO misal_intenciones (parroquia, hora, fecha, intencion, tipo) VALUES ('17', '1407', '$fecha', 'MISA', '4')";

	}
}

foreach($sql as $i=>$cons)
{
	mysql_query($cons,$conex) or die (mysql_error());
}

/*

$meses = array(4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31);
$sql = array();

foreach($meses as $mes=>$diaTope)
{

	if($mes <= 9) $mes = "0".$mes;

	$anyo = "2016";

	for ($i = 1; $i <= $diaTope; $i++)
	{
		if($i <= 9) $i = "0".$i;
		$fecha = $anyo."-".$mes."-".$i;
	
		$sql[] = "INSERT INTO misal_intenciones (parroquia, hora, fecha, intencion, tipo) VALUES ('17', '1403', '$fecha', 'MISA', '4')";
		$sql[] = "INSERT INTO misal_intenciones (parroquia, hora, fecha, intencion, tipo) VALUES ('17', '1404', '$fecha', 'MISA', '4')";

	}

}
/*
foreach($sql as $i=>$cons)
{
	mysql_query($cons,$conex) or die (mysql_error());
}
*/
echo 'ok';

exit();

//recorer todos los meses del año

$meses = array(5, 4, 3, 2, 1, 12, 11);

for($d=6;$d<=10;$d++)
{

    $arrayFechas = domingos_del_mes($d,2015);

	$sql = array();
	$sql[] = "INSERT INTO misal_intenciones (parroquia, hora, fecha, intencion, tipo) VALUES ('17', '1020', '[FECHA]', 'MISA', '4')";

	foreach($arrayFechas as $i=>$fecha)
	{
	
		foreach($sql as $a=>$sqlNew)
		{
			$sqlNew = str_replace("[FECHA]", $fecha, $sqlNew);

			// mysql_query($sqlNew,$conex) or die (mysql_error());

			echo $sqlNew.'<hr>';
		}

	}

echo "<hr/>";
}

?>