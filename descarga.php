<?php

		include('_includes/config.php');

		if(isset($_GET['file']) && $_GET['file'] != "")
		{

			$archivo = addslashes($_GET['file']);
			$withUrl = false;

			$archivoToSearch = basename($archivo);

			$parroquia = getValue("SELECT parroquia FROM documentos WHERE documento = '$archivoToSearch' LIMIT 1",1);
			if($parroquia == "") $parroquia = getValue("SELECT parroquia FROM galeria_fotos WHERE foto = '".str_replace("big_","",$archivoToSearch)."' LIMIT 1",1);

			$targetDirAlt = "/var/www/vhosts/mintrared.com/subdomains/web/httpdocs/documentos/";
			$targetDir = "/var/www/vhosts/mintrared.com/subdomains/web/httpdocs/uploads/".$parroquia."/";

			if(substr_count($archivo, "uploads/") > 0)
			{
				$archivo = str_replace("uploads/","",$archivo);
			}

			if(substr_count($archivo, "web.mintrared.com/") > 0)
			{
				$archivo = explode("/",$archivo);
				$archivo = $targetDir.$archivo[4]."/".$archivo[5];
				$withUrl = true;
			}
			else{
				$archivo = "http://web.mintrared.com/".str_replace("/var/www/vhosts/mintrared.com/subdomains/web/httpdocs/","",$targetDir).$archivo;
			}

			$archivo = trim($archivo);
			$lastChar = substr($archivo, -1);
			if($lastChar == "/") $archivo = substr($archivo, 0, strlen($archivo)-1);

			if(!file_exists($archivo) && substr_count($archivo, "/uploads") == 0)
			{
				$dir = "documentos";
				$archivo = str_replace($targetDir,$targetDirAlt,$archivo);
			}else{
				$dir = "uploads";
			}

			if($withUrl){
				$archivo = str_replace($targetDir, "", $archivo);
				$archivo = str_replace($targetDirAlt, "", $archivo);
				switch($dir){
					case "documentos";
						$archivo = "http://web.mintrared.com/documentos/".$archivo;
					break;
					case "uploads";
						$archivo = "http://web.mintrared.com/uploads/".$parroquia."/".$archivo;
					break;
				}
			}
			if(!isset($_GET['ver'])){
				header("Content-disposition: attachment; filename=".basename(str_replace(",",".",str_replace("Ñ","n",str_replace("ñ","n",$archivo))))."");
				header("Content-type: application/octet-stream");
				readfile($archivo);
			}
			else header('Location:'.$archivo);

			exit();

		}
?>