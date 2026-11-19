<?php require_once(__DIR__ . '/_includes/php8_compat.php'); // Compatibilidad PHP 8

if ($_SERVER['REMOTE_ADDR'] == "90.173.201.22") {
  ini_set('display_errors','1');
  ini_set("error_reporting",E_ALL);
  print_r($_POST);
}

	include('_includes/config.php');

	if(isset($_POST['idparroquia']) && $_POST['idparroquia'] > 0)
	{

		if(isset($_POST['mensaje']) && $_POST['mensaje'] != "")
		{

			if(isset($_POST['nombre']) && $_POST['nombre'] != "") $nombre = addslashes($_POST['nombre']); else $nombre = "";
			if(isset($_POST['email']) && $_POST['email'] != "") $email = addslashes($_POST['email']); else $email = "";
			if(isset($_POST['edad'])) $edad = addslashes($_POST['edad']); else $edad = "";
			if(isset($_POST['lugar'])) $lugar = addslashes($_POST['lugar']); else $lugar = "";
			if(isset($_POST['telefono'])) $telefono = addslashes($_POST['telefono']); else $telefono = "";


			if($email == "cleon41@hotmail.com" || $nombre == "carlos leon") 
			{
				header('Location:'.utf8_encode($urlOri).'oraciones.html?msg=3');
				exit();
			}

			$mensaje = addslashes($_POST['mensaje']);			

			$idparroquia = intval($_POST['idparroquia']);

			if(getValue("SELECT acepta_oraciones FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
			{

				$secret = getValue("SELECT clave_api_secreta FROM configuracion_base WHERE parroquia = '$idparroquia'",1);
				$google_url = "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha = $_POST['g-recaptcha-response'];

				$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
				$verifyResponse = file_get_contents($url);
				$responseData = json_decode($verifyResponse);
				
				if ($responseData->success != "1") 
				{
					header('Location:'.utf8_encode($urlOri).'oraciones.html?msg=1');
					exit();
				}
				else{

					// **********************************
					// ****** ENVIAMOS MAIL DE CONTACTO *
					// **********************************

					$ip = $_SERVER['REMOTE_ADDR'];
	
					$asunto = "Nueva petición de oración desde la página web de ".$nombreParroquia;

					$msg = "<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Ha recibido una nueva petición de oración desde la  página web de <b>$nombreParroquia</b>.</p>

					<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Los datos de la persona que ha hecho la petición son:</p>

					<ul style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">
						<li style=\"margin-bottom:7px;\">Nombre: <b>$nombre</b></li>
						<li style=\"margin-bottom:7px;\">Correo electrónico: <b>$email</b></li>
						<li style=\"margin-bottom:7px;\">Teléfono: <b>$telefono</b></li>
						<li style=\"margin-bottom:7px;\">Edad: <b>$edad</b></li>
						<li style=\"margin-bottom:7px;\">Lugar desde el que nos escribe: <b>$lugar</b></li>
						<li style=\"margin-bottom:7px;\">Petición: <b>$mensaje</b></li>
					</ul>

					<p style=\"font-size:10px;font-family:arial,verdana,sans-serif;\">Formulario generado por la aplicación EcclesiaRed</p>";

					// ** Al párroco.
					if($idparroquia == 1) $emailParroquia = "peticionesdeoracion@parroquiapicanya.com"; else $emailParroquia = getValue("SELECT mail_contacto FROM configuracion_base WHERE parroquia = $idparroquia",1);

					$remitente = "contacto@ecclesiared.es";
					$remite = "contacto@ecclesiared.es";
					$responder = $email;

					$cabeceras = "Date: ".date("l j F Y, G:i")."\n";
					$cabeceras .="MIME-Version: 1.0\n";
					$cabeceras .= "From: ".$remitente."\n";
					$cabeceras .= "Return-path: ". $remite."\n";
					$cabeceras .= "Reply-To: ".$responder."\n";
					$cabeceras .= "X-Mailer: PHP/". phpversion()."\n";
					$cabeceras .= "Content-type: text/html\r\n";

					if(correo_mail($emailParroquia, $asunto, $msg,$cabeceras))
					{
						mysql_query("INSERT INTO contactos (email, parroquia, mensaje, nombre, apellidos, ip, telefono) VALUES ('$email', '$idparroquia', '$mensaje', '$nombre', '$apellidos', '$ip', '$telefono')",$conex) or die (mysql_error());

						// **************************************************
						// **** NUEVA MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

						include('datosConex.php');
						$conex = mysql_connect('localhost',$mysqlUser, $mysqlPwd);
						mysql_select_db($dbname,$conex);

						// QUE LAS PETICIONES NO LE LLEGUEN A LOS USUARIOS DE ALFONSO.
						// DESACTIVAMOS PETICIONES DE ORACION PARA PARROQUIA EUGENIO INES VALENCIA
						$sql = "SELECT id, email FROM usuarios WHERE (admin_parroquia = 1 OR modulos LIKE '%;9%') AND parroquia = $idparroquia AND parroquia != 61 AND id != 1440 AND id != 3052 AND id != 4505";
						$rs = mysql_query($sql,$conex) or die (mysql_error());

						if(mysql_num_rows($rs) > 0)
						{

							$msg = "Ha recibido una nueva petición de oración desde la  página web de <b>$nombreParroquia</b>.

							<p>Los datos de la persona que ha hecho la petición son:</p>

								<p>Nombre: <b>$nombre</b><br>
								Correo electrónico: <b>$email</b><br>
								Teléfono: <b>$telefono</b><br>
								Edad: <b>$edad</b><br>
								Lugar desde el que nos escribe: <b>$lugar</b><br>
								Petición: <b>$mensaje</b><br>
								</p>";

							while($rw = mysql_fetch_assoc($rs))
							{
								$idusuario = $rw['id'];
								$email = $rw['email'];
								if($email != "" && $email != $emailParroquia) correo_mail($email, $asunto, $msg,$cabeceras);
								mysql_query("INSERT INTO comunicacion (de, para, asunto, mensaje, fecha, msg_web) VALUES (6, '$idusuario', 'Nueva petición de oración desde tu página web', '$msg', NOW(), 1)",$conex);
							}						
						}
						// **************************************************
						// ********* FIN MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

						header('Location:'.utf8_encode($urlOri).'oraciones.html?msg=3');
						exit();
					}else{
						header('Location:'.utf8_encode($urlOri).'oraciones.html?msg=3');
						exit();
					}
				}
			}
			else exit();
		}
		else{
			header('Location:'.utf8_encode($urlOri).'oraciones.html?msg=2');
			exit();
		}
	}
	else exit();


?>