<?php require_once(__DIR__ . '/_includes/php8_compat.php'); // Compatibilidad PHP 8

	include('_includes/config.php');
	require_once 'xpertmailer/MAIL.php'; // path to 'MAIL.php' file from XPM4 package

	if(isset($_POST['idparroquia']) && $_POST['idparroquia'] > 0)
	{
		
				$idpag = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

		if(isset($_POST['nombre']) && $_POST['nombre'] != "" && isset($_POST['donativo']) && $_POST['donativo'] != "")
		{

			$nombre = addslashes($_POST['nombre']);
			$cuenta = addslashes($_POST['cuenta_bancaria']);
			$donativo = addslashes($_POST['donativo']);

			if(isset($_POST['nif']) && $_POST['nif'] != "") $nif = addslashes($_POST['nif']); else $nif = "No aportado";
			if(isset($_POST['domicilio']) && $_POST['domicilio'] != "") $domicilio = addslashes($_POST['domicilio']); else $domicilio = "No aportado";
			if(isset($_POST['codigo_postal']) && $_POST['codigo_postal'] != "") $codigo_postal = addslashes($_POST['codigo_postal']); else $codigo_postal = "No aportado";
			if(isset($_POST['poblacion']) && $_POST['poblacion'] != "") $poblacion = addslashes($_POST['poblacion']); else $poblacion = "No aportada";
			if(isset($_POST['provincia']) && $_POST['provincia'] != "") $provincia = addslashes($_POST['provincia']); else $provincia = "No aportada";
			if(isset($_POST['email']) && $_POST['email'] != "") $email = addslashes($_POST['email']); else $email = "No aportado";
			if(isset($_POST['telefono']) && $_POST['telefono'] != "") $telefono = addslashes($_POST['telefono']); else $telefono = "No aportado";
			if(isset($_POST['caracter']) && $_POST['caracter'] != "") $caracter = intval($_POST['caracter']); else $caracter = "No seleccionado";
			if(isset($_POST['mensaje']) && $_POST['mensaje'] != "") $mensaje = addslashes($_POST['mensaje']); else $mensaje = "Sin mensaje";

			$idparroquia = intval($_POST['idparroquia']);

			if(getValue("SELECT activar FROM paginas WHERE parroquia = $idparroquia AND txt_int = 'donativos'",1) == 1)
			{

				$secret = getValue("SELECT clave_api_secreta FROM configuracion_base WHERE parroquia = '$idparroquia'",1);
				$google_url = "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha = $_POST['g-recaptcha-response'];

				$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
				$verifyResponse = file_get_contents($url);
				$responseData = json_decode($verifyResponse);

				$idpag = getValue("SELECT id FROM paginas WHERE txt_int = 'donativos' AND parroquia = $idparroquia LIMIT 1",1);

				if ($responseData->success != "1") 
				{
					header('Location:'.$urlRedir.'donativos/'.$idpag.'/?donar=1&msg=1');
					exit();
				}
				else{

					// ***********************************
					// ****** ENVIAMOS MAIL DE DONATIVOS *
					// ***********************************

					$ip = $_SERVER['REMOTE_ADDR'];
	
					$asunto = "Nuevo donativo desde la página web de ".$nombreParroquia;

					if($caracter > 0) $caracterTxt = getValue("SELECT caracter FROM donativos_caracteres WHERE id = ".$caracter,1); else $caracterTxt = "No seleccionado";

					if($idparroquia == 1920) $nif = "<li style=\"margin-bottom:7px;\">Apellido: <b>$nif</b></li>\n";
					else $nif = "<li style=\"margin-bottom:7px;\">NIF: <b>$nif</b></li>\n";

					$msg = "<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Ha recibido un formulario de donativos para su parroquia.</p>

					<p  style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Los datos de la persona interesada en aportar el donativo son:</p>

					<ul style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">
						<li style=\"margin-bottom:7px;\">Nombre: <b>$nombre</b></li>\n
						$nif
						<li style=\"margin-bottom:7px;\">Domicilio: <b>$domicilio</b></li>\n
						<li style=\"margin-bottom:7px;\">Código Postal: <b>$codigo_postal</b></li>\n
						<li style=\"margin-bottom:7px;\">Población: <b>$poblacion</b></li>\n
						<li style=\"margin-bottom:7px;\">Provincia: <b>$provincia</b></li>\n
						<li style=\"margin-bottom:7px;\">Correo electrónico: <b>$email</b></li>\n
						<li style=\"margin-bottom:7px;\">Teléfono: <b>$telefono</b></li>\n
						<li style=\"margin-bottom:7px;\">Cuenta Bancaria: <b>$cuenta</b></li>\n
						<li style=\"margin-bottom:7px;\">Carácter: <b>$caracterTxt</b></li>\n
						<li style=\"margin-bottom:7px;\">Donativo: <b>$donativo €</b></li>\n
						<li style=\"margin-bottom:7px;\">Mensaje: <b>$mensaje</b></li>\n
					</ul>

					<p  style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Los datos también quedan registrados en su cuenta de EcclesiaRed para futuras consultas en la sección: <b>Página Web &raquo; Donativos.</b></p>

					<p style=\"font-size:10px;font-family:arial,verdana,sans-serif;\">Formulario generado por la aplicación EcclesiaRed</p> ";

					$emailParroquia = getValue("SELECT mail_contacto FROM configuracion_base WHERE parroquia = $idparroquia",1);

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

						mysql_query("INSERT INTO donativos (nombre, nif, domicilio, provincia, poblacion, codigo_postal, email, telefono, donativo, cuenta_bancaria, parroquia, caracter, mensaje, ip) VALUES ('$nombre', '$nif', '$domicilio', '$provincia', '$poblacion', '$codigo_postal', '$email', '$telefono', '$donativo', '$cuenta', '$idparroquia', '$caracter', '$mensaje', '$ip')",$conex) or die (mysql_error());


						// **************************************************
						// **** NUEVA MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

						include('datosConex.php');
						$conex = mysql_connect('localhost',$mysqlUser, $mysqlPwd);
						mysql_select_db($dbname,$conex);

						$sql = "SELECT id, email FROM usuarios WHERE modulos LIKE '%9;%' AND parroquia = $idparroquia";
						$rs = mysql_query($sql,$conex) or die (mysql_error());

						if(mysql_num_rows($rs) > 0)
						{

							if($idparroquia == 1920) $nif = "<li>Apellido: <b>$nif</b></li>\n";
							else $nif = "<li>NIF: <b>$nif</b></li>\n";

							$msg = "<p>Nuevo donativo desde la página web de <b>$nombreParroquia</b>.</p>

									<p>Ha recibido un formulario de donativos para su parroquia.</p>
									<p>Los datos de la persona interesada en aportar el donativo son:</p>

									<ul>
										<li>Nombre: <b>$nombre</b></li>\n
										$nif
										<li>Domicilio: <b>$domicilio</b></li>\n
										<li>Código Postal: <b>$codigo_postal</b></li>\n
										<li>Población: <b>$poblacion</b></li>\n
										<li>Provincia: <b>$provincia</b></li>\n
										<li>Correo electrónico: <b>$email</b></li>\n
										<li>Teléfono: <b>$telefono</b></li>\n
										<li>Cuenta Bancaria: <b>$cuenta</b></li>\n
										<li>Carácter: <b>$caracterTxt</b></li>\n
										<li>Donativo: <b>$donativo €</b></li>\n
										<li>Mensaje: <b>$mensaje</b></li>\n
									</ul>";

							while($rw = mysql_fetch_assoc($rs))
							{
								$idusuario = $rw['id'];
								$email = $rw['email'];

								if($email != "" && $email != $emailParroquia) correo_mail($email, $asunto, $msg,$cabeceras);

								mysql_query("INSERT INTO comunicacion (de, para, asunto, mensaje, fecha, msg_web) VALUES (6, '$idusuario', 'Nuevo donativo desde su página web', '$msg', NOW(), 1)",$conex);
							}						
						}

						// **************************************************
						// ********* FIN MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

					}

					header('Location:'.$urlRedir.'donativos/'.$idpag.'/?donar=1&msg=3');
					exit();
				}
			}
			else exit();
		}
		else{
			header('Location:'.$urlRedir.'donativos/'.$idpag.'/?donar=1&msg=2');
			exit();
		}
	}
	else exit();


?>