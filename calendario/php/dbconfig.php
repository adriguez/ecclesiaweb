<?php require_once(__DIR__ . '/../../_includes/php8_compat.php'); // Compatibilidad PHP 8
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysql_connect("localhost","web_user","4z5G13l%r") or
         die("Could not connect: " . mysql_error());
    //change to your database name
		mysql_select_db("web") or 
		     die("Could not select database: " . mysql_error());
	}
}
?>