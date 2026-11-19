<?php require_once(__DIR__ . '/_includes/php8_compat.php'); // Compatibilidad PHP 8

	include('_includes/config.php');

	if(isset($_POST['idparroquia']) && $_POST['idparroquia'] > 0)
	{

		if(isset($_POST['nombre']) && $_POST['nombre'] != "" && isset($_POST['mensaje']) && $_POST['mensaje'] != "" && isset($_POST['email']) && $_POST['email'] != "")
		{

			if(isset($_POST['contactoGrupos']) && $_POST['contactoGrupos'] == 1) $contactoGrupos = true;
			else $contactoGrupos = false;

			$nombre = addslashes($_POST['nombre']);
			$mensaje = addslashes($_POST['mensaje']);
			$email = addslashes($_POST['email']);
			
			if(isset($_POST['apellidos'])) $apellidos = addslashes($_POST['apellidos']); else $apellidos = "";
			if(isset($_POST['telefono'])) $telefono = addslashes($_POST['telefono']); else $telefono = "No facilitado";

			if($email == "cleon41@hotmail.com" || $nombre == "carlos leon") 
			{
				header('Location:'.utf8_encode($urlOri).'contacto.html?msg=3');
				exit();
			}

			$idparroquia = intval($_POST['idparroquia']);

			if(getValue("SELECT acepta_contacto FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
			{

				$ip = $_SERVER['REMOTE_ADDR'];
				$secret = getValue("SELECT clave_api_secreta FROM configuracion_base WHERE parroquia = '$idparroquia'",1);
				$google_url = "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha = $_POST['g-recaptcha-response'];

				$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;

				$verifyResponse = file_get_contents($url);
				$responseData = json_decode($verifyResponse);

				if ($responseData->success != "1") 
				{
					header('Location:'.utf8_encode($urlOri).'contacto.html?msg=1');
					exit();
				}
				else{

					// **********************************
					// ****** ENVIAMOS MAIL DE CONTACTO *
					// **********************************
					$extra = "";
					$extraSimple = "";
					$registroentrada = false;

					if($idparroquia == 602 && isset($_POST['jmj2023lisboa']) && $_POST['jmj2023lisboa'] == "1"){ // Formulario JMJ Lisboa 2023
						if(isset($_POST['fechanacimiento']) && $_POST['fechanacimiento'] != "") 
						{
							$extra .= "<li style=\"margin-bottom:7px;\">Fecha de nacimiento: <b>".addslashes($_POST['fechanacimiento'])."</b></li>\n";
							$extraSimple .= "Fecha de nacimiento: <b>".addslashes($_POST['fechanacimiento'])."</b>";
						}
						
						if(isset($_POST['direccion']) && $_POST['direccion'] != "")
						{
							$extra .= "<li style=\"margin-bottom:7px;\">Dirección: <b>".addslashes($_POST['direccion'])."</b></li>\n";
							$extraSimple .= "Dirección: <b>".addslashes($_POST['direccion'])."</b>";
						}
						
						$mensajeLabel = "Porqué desea ir a la JMJ Lisboa 2023";
						$jmj = true;
					}
					else if($idparroquia == 1078 && isset($_POST['registroentrada']) && $_POST['registroentrada'] == "1"){ // Formulario Registro entrada (FALTA ADJUNTO)
						if(isset($_POST['dni']) && $_POST['dni'] != "") 
						{
							$extra .= "<li style=\"margin-bottom:7px;\">DNI: <b>".addslashes($_POST['dni'])."</b></li>\n";
							$extraSimple .= "DNI: <b>".addslashes($_POST['dni'])."</b>";
						}
						
						if(isset($_POST['direccion']) && $_POST['direccion'] != "")
						{
							$extra .= "<li style=\"margin-bottom:7px;\">Dirección: <b>".addslashes($_POST['direccion'])."</b></li>\n";
							$extraSimple .= "Dirección: <b>".addslashes($_POST['direccion'])."</b>";
						}

						if(isset($_FILES['adjunto']['name']) && $_FILES['adjunto']['tmp_name'] != ""){
							$fileAdjunto = time().$_FILES['adjunto']['name'];
							$folderUpload = "uploads/".$idparroquia."/";
							$extension = sacarExt($fileAdjunto);

							$extPermitidas[] = ".pdf";
							if(in_array($extension, $extPermitidas)){
								if(copy($_FILES['adjunto']['tmp_name'], $folderUpload.$fileAdjunto)){
									$extra .= "<li style=\"margin-bottom:7px;\"><a href=\"https://xn--parroquiadelcarmencardea-nlc.ecclesiared.es/".$folderUpload.$fileAdjunto."\">Ver fichero adjunto</a></li>\n";
									$extraSimple .= "Fichero adjunto: <a target=\"_blank\" href=\"https://xn--parroquiadelcarmencardea-nlc.ecclesiared.es/".$folderUpload.$fileAdjunto."\">https://xn--parroquiadelcarmencardea-nlc.ecclesiared.es/".$folderUpload.$fileAdjunto."</a></b>";
								}
							}
						}
						
						$mensajeLabel = "Expone";
						$registroentrada = true;

						$extraMensaje = "<li style=\"margin-bottom:7px;\">Solicita: <b>".stripslashes($_POST['solicita'])."</b></li>";
					}
					else{
						$mensajeLabel = "Mensaje";
						$jmj = false;
						$extraMensaje = "";
					}

					$ip = $_SERVER['REMOTE_ADDR'];

					if($contactoGrupos) $txt1 = "Los datos de la persona que ha contactado con su grupo parroquial son";
					else $txt1 = "Los datos de la persona que ha contactado con usted son";
	
					$asunto = "Nuevo formulario de contacto desde la pagina web de ".$nombreParroquia;
					if($registroentrada) $asunto = "Registro de Entrada - Formulario desde la pagina web";

					$msg = "<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Ha recibido un nuevo formulario de contacto desde la  página web de <b>$nombreParroquia</b>.</p>

					<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">$txt1:</p>

					<ul style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">
						<li style=\"margin-bottom:7px;\">Nombre: <b>$nombre $apellidos</b></li>
						<li style=\"margin-bottom:7px;\">Correo electrónico: <b>$email</b></li>
						<li style=\"margin-bottom:7px;\">Teléfono: <b>$telefono</b></li>
						<li style=\"margin-bottom:7px;\">".$mensajeLabel.": <b>$mensaje</b></li>
						$extraMensaje
						$extra
					</ul>

					<p style=\"font-size:10px;font-family:arial,verdana,sans-serif;\">Formulario generado por la aplicación EcclesiaRed</p>";

					if($contactoGrupos){

						$idGrupo = addslashes($_POST['idGrupo']);

						$emailContacto = getValue("SELECT email_contacto, nombre FROM grupos_pastorales WHERE id = '$idGrupo'",0);
						$nombreGrupo = $emailContacto[1];
						$emailContacto = $emailContacto[0];

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
	
						if(correo_mail($emailContacto, $asunto, $msg,$cabeceras)){
							mysql_query("INSERT INTO contactos_grupos (email, parroquia, mensaje, telefono, nombre, ip, destino) VALUES ('$email', '$idparroquia', '$mensaje', '$telefono', '$nombre', '$ip', '$idGrupo')",$conex) or die (mysql_error());

							$txtIntGrupo = limpiarCadena($nombreGrupo, 'archivo')."_".$idGrupo.".html";

							header('Location:'.utf8_encode($urlOri).'grupos/'.$txtIntGrupo.'?msg=3');
							exit();
						}

					}else{

						if(isset($_POST['destino']) && $_POST['destino'] > 0)
						{
							$destino = getValue("SELECT email FROM contactos_destino WHERE id = '".intval($_POST['destino'])."' AND parroquia = '$idparroquia'",1);
	
							if($destino == "") $emailParroquia = getValue("SELECT mail_contacto FROM configuracion_base WHERE parroquia = $idparroquia",1);
							else $emailParroquia = $destino;
						}
						else $emailParroquia = getValue("SELECT mail_contacto FROM configuracion_base WHERE parroquia = $idparroquia",1);
						
						if($jmj) $emailParroquia = "jmjpsje2020@hotmail.com";
						else if($registroentrada) $emailParroquia = "parroquiacardena@gmail.com";
						
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
							mysql_query("INSERT INTO contactos (email, parroquia, mensaje, telefono, nombre, apellidos, ip) VALUES ('$email', '$idparroquia', '$mensaje', '$telefono', '$nombre', '$apellidos', '$ip')",$conex) or die (mysql_error());
	
							// **************************************************
							// **** NUEVA MOVIDA MENSAJE INTERNO FORM CONTACTO
							// **************************************************
	
							include('datosConex.php');
							$conex = mysql_connect('localhost',$mysqlUser, $mysqlPwd);
							mysql_select_db($dbname,$conex);
	
							$sql = "SELECT id FROM usuarios WHERE admin_parroquia = 1 AND parroquia = $idparroquia";
							$rs = mysql_query($sql,$conex) or die (mysql_error());
	
							if(mysql_num_rows($rs) > 0)
							{
	
								if($registroentrada){
									$msg = "Registro de entrada - Ha recibido un nuevo formulario.
	
									<p>Los datos de la persona que ha contactado con usted son:</p>
	
									<p>Nombre: <b>$nombre $apellidos</b><br>
									Correo electrónico: <b>$email</b><br>
									Teléfono: <b>$telefono</b><br>								
									$extraSimple
									".$mensajeLabel.": <b>$mensaje</b><br>
									Solicita: <b>".stripslashes($_POST['solicita'])."</b><br>
									</p>";
								}
								else{
									$msg = "Ha recibido un nuevo formulario de contacto desde la  página web de <b>$nombreParroquia</b>.
	
									<p>Los datos de la persona que ha contactado con usted  son:</p>
	
									<p>Nombre: <b>$nombre $apellidos</b><br>
									Correo electrónico: <b>$email</b><br>
									Teléfono: <b>$telefono</b><br>								
									$extraSimple
									".$mensajeLabel.": <b>$mensaje</b><br>
									</p>";
								}
	
								while($rw = mysql_fetch_assoc($rs))
								{
									$idusuario = $rw['id'];
									mysql_query("INSERT INTO comunicacion (de, para, asunto, mensaje, fecha, msg_web) VALUES (6, '$idusuario', 'Nuevo formulario de contacto desde tu página web', '$msg', NOW(), 1)",$conex);
								}						
							}
	
							// **************************************************
							// ********* FIN MOVIDA MENSAJE INTERNO FORM CONTACTO
							// **************************************************

							if($jmj) header('Location:'.utf8_encode($urlOri).'jmj-parroquial-lisboa-2023/1143/?msg=3');
							else if($registroentrada) header('Location:'.utf8_encode($urlOri).'registro-entrada/2169/?msg=3');
							else header('Location:'.utf8_encode($urlOri).'contacto.html?msg=3');
							exit();
						}
					}

				}
			}
			else exit();
		}
		else{
			header('Location:'.utf8_encode($urlOri).'contacto.html?msg=2');
			exit();
		}
	}
	else exit();


?>