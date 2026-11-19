
<?php require_once(__DIR__ . '/../../_includes/php8_compat.php'); // Compatibilidad PHP 8 


$mysqlUser = "gestion_user";
$mysqlPwd = "ges569";
$dbname = "gestion";
$conexGestion = mysql_connect('localhost', $mysqlUser, $mysqlPwd);
mysql_select_db($dbname,$conexGestion);

$rw['titulo'] = "Política de Privacidad"; 

$valores = getValue("SELECT titulo, mail_contacto FROM configuracion_base WHERE parroquia = '$idparroquia'",0);

$mail_contacto = $valores['mail_contacto'];
$titulo = $valores['titulo'];

$cs = mysql_query("SELECT cif, direccion, email_contacto, telefono FROM parroquias WHERE id = '$idparroquia'",$conexGestion);

$rw['texto'] = file_get_contents('politica.html', true);

$rw['texto'] = str_replace("[DIRECCION_WEB]", $urlOri,$rw['texto']);
$rw['texto'] = str_replace("[NOMBRE_PARROQUIA]", $titulo, $rw['texto']);
$rw['texto'] = str_replace("xxxnombretitularxxx", $titulo, $rw['texto']);

$rw['texto'] = str_replace("[NIF_PARROQUIA]", mysql_result($cs, 0, 'cif'), $rw['texto']);
$rw['texto'] = str_replace("[DIRECCION_PARROQUIA]", mysql_result($cs, 0, 'direccion'), $rw['texto']);
$rw['texto'] = str_replace("[EMAIL_PARROQUIA]", $mail_contacto, $rw['texto']);
$rw['texto'] = str_replace("[TELEFONO_PARROQUIA]", mysql_result($cs, 0, 'telefono'), $rw['texto']);

?>

<div class="row">
		<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia">
						<h1>Política de privacidad</h1>
					</div>

					<div style="clear:both;"></div>

					<div class="text-noticia">
						
						<p><?=$rw['texto'];?></p>
					</div>
			</div>
		</div>
	</div>
