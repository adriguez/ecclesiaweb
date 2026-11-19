<?php

		
include('../_includes/config.php');
	ini_set('display_errors','1');
	ini_set("error_reporting",E_ALL);
		$nombre_fichero = "agenda_pep_toni.csv";
		$gestor = fopen($nombre_fichero, "r");
		$contenido = fread($gestor, filesize($nombre_fichero));
		fclose($gestor);

		$datosRecorre = explode("\n",$contenido);

		foreach($datosRecorre as $id=>$fila)
		{
			$fila = explode(";",$fila);
			// Num.	Nom	Telèfon	Població	Cens Parroquial
			$nombre = trim(addslashes($fila[1]));
			$telefono = trim(addslashes($fila[2]));
			$poblacion = trim(addslashes($fila[3]));
			$grupo = trim(addslashes($fila[4]));

			$idGrupo = 0;

			switch($grupo){
				case "ANGLESOS-PALMANOVA"; $idGrupo = 55; break;
				case "BAJA DEL CENSO"; $idGrupo = 56; break;
				case "CARITAS INTERPARROQUIAL"; $idGrupo = 57; break;
				case "INSTITUCIONS"; $idGrupo = 58; break;
				case "Unitat Costa Calvia"; $idGrupo = 59; break;
			}

			if($idGrupo != 0)
			{
				$existe = getValue("SELECT id FROM agentes_pastoral WHERE parroquia = 14 AND nombre = '$nombre' AND telefono = '$telefono' LIMIT 1",1);

				if($existe == "")
				{
					echo $nombre.'<br>'.$telefono.'<br>'.$poblacion.'<br>'.$grupo.'<hr>';
					mysql_query("INSERT INTO agentes_pastoral (nombre, telefono, poblacion, grupos, parroquia) VALUES ('$nombre', '$telefono', '$poblacion', ';".$idGrupo.";', '14')",$conex) or die (mysql_error());
				}
			}
		}

?>