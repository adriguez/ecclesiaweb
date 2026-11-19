<?php require_once(__DIR__ . '/_includes/php8_compat.php'); // Compatibilidad PHP 8

	include('_includes/config.php');

	$urlViene = $_SERVER['HTTP_REFERER'];

	$urlViene = str_replace("?msg=1","",$urlViene);
	$urlViene = str_replace("?msg=2","",$urlViene);
	$urlViene = str_replace("?msg=3","",$urlViene);
	
	$urlNoticia = $urlViene;

	$debug=false;
	if ($_SERVER['REMOTE_ADDR'] == "89.129.149.148") {
      ini_set('display_errors','1');
	  ini_set("error_reporting",E_ALL);
	  print_r($_POST);
	  $debug=true;
      //exit();
	}


	if(isset($_POST['idnoticia']) && $_POST['idnoticia'] > 0 && isset($_POST['idparroquia']) && $_POST['idparroquia'] > 0)
	{

		if(isset($_POST['nombre']) && $_POST['nombre'] != "" && isset($_POST['comentario']) && $_POST['comentario'] != "")
		{

			if ($debug) echo 'hola<br>';
			$nombre = addslashes($_POST['nombre']);
			$comentario = addslashes($_POST['comentario']);

			$idparroquia = intval($_POST['idparroquia']);
			$idnoticia = intval($_POST['idnoticia']);

			if(getValue("SELECT comentarios FROM configuracion_base WHERE parroquia = $idparroquia",1) == 1)
			{

				if ($debug) echo 'hola2<br>';
				$secret = getValue("SELECT clave_api_secreta FROM configuracion_base WHERE parroquia = '$idparroquia'",1);
				$google_url = "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha = $_POST['g-recaptcha-response'];

				$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
				$verifyResponse = file_get_contents($url);
				$responseData = json_decode($verifyResponse);
				
				if ($debug){ 
					echo $responseData->success; 
					exit();
				}


				if ($responseData->success != "1") 
				{
					header('Location:'.utf8_encode($urlViene).'?msg=1#comentarios');
					exit();
				}
				else{

					// **********************************
					// ****** ENVIAMOS MAIL DE CONTACTO *
					// **********************************

					$ip = $_SERVER['REMOTE_ADDR'];
	
					$asunto = "Nuevo comentario en su página web ".$nombreParroquia;

					$msg = "<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Ha recibido un nuevo comentario desde la  página web de <b>$nombreParroquia</b>.</p>

					<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Los datos de la persona que ha escrito el comentario son:</p>

					<ul style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">
						<li style=\"margin-bottom:7px;\">Sobre la noticia: <b><a href=\"$urlNoticia\" target=\"_blank\">$urlNoticia</a></b></li>
						<li style=\"margin-bottom:7px;\">Nombre: <b>$nombre</b></li>
						<li style=\"margin-bottom:7px;\">Comentario: <b>$comentario</b></li>
					</ul>

					<p style=\"font-family:arial,verdana,sans-serif;font-size:12px;\">Le recordamos que para que el comentario sea visible en la página web, debe acceder a su panel de control de Ecclesiared y validar el comentario.</p>

					<p style=\"font-size:10px;font-family:arial,verdana,sans-serif;\">Formulario generado por la aplicación EcclesiaRed</p>";

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
						mysql_query("INSERT INTO comentarios_noticias (noticia, parroquia, ip, comentario, nombre, activar) VALUES ('$idnoticia', '$idparroquia', '$ip', '$comentario', '$nombre', 0 )",$conex) or die (mysql_error());
						$idCom = mysql_insert_id($conex);

						// **************************************************
						// **** NUEVA MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

						include('datosConex.php');
						$conex = mysql_connect('localhost',$mysqlUser, $mysqlPwd);
						mysql_select_db($dbname,$conex);

						$sql = "SELECT id, email FROM usuarios WHERE modulos LIKE '%9;%' AND parroquia = $idparroquia";
						$rs = mysql_query($sql,$conex) or die (mysql_error());

						$urlValida = "https://gestion.mintrared.es/new/web.php?sec=comentarios&act=1&id=".$idCom;

						if(mysql_num_rows($rs) > 0)
						{

							$msg = "Ha recibido un nuevo comentario desde la  página web de <b>$nombreParroquia</b>.

							<p>Los datos de la persona que ha escrito el comentario son:</p>

								<p>Nombre: <b>$nombre</b><br>
								Comentario: <b>$comentario</b><br>
								Sobre la noticia: <b><a href=\"$urlNoticia\" target=\"_blank\">$urlNoticia</a></b><br>
								</p>

							<p>Le recordamos que para que el comentario sea visible en la página web, debe validarlo desde el apartado <b>Comentarios</b> de su panel de página web o haciendo click en el siguiente enlace:</p>
							<p><a href=\"$urlValida\">Validar comentario</a></p>";

							while($rw = mysql_fetch_assoc($rs))
							{
								$idusuario = $rw['id'];
								$email = $rw['email'];

								if($email != "" && $email != $emailParroquia) correo_mail($email, $asunto, $msg,$cabeceras);

								mysql_query("INSERT INTO comunicacion (de, para, asunto, mensaje, fecha, msg_web) VALUES (6, '$idusuario', 'Nuevo comentario en tu página web', '$msg', NOW(), 1)",$conex);
							}						
						}

						// **************************************************
						// ********* FIN MOVIDA MENSAJE INTERNO FORM CONTACTO
						// **************************************************

						header('Location:'.utf8_encode($urlViene).'?msg=3#comentarios');
						exit();
					}
				}
			}
			else exit();
		}
		else{
			header('Location:'.utf8_encode($urlViene).'?msg=2#comentarios');
			exit();
		}
	}
	else exit();


?>