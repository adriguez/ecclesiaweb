<?php require_once(__DIR__ . '/php8_compat.php'); // Compatibilidad PHP 8

$mysqlUser = "web_user";
$mysqlPwd = "4z5G13l%r";

$dbname = "web";

$conex = mysql_connect('localhost',$mysqlUser,$mysqlPwd);
mysql_select_db($dbname, $conex);

?>