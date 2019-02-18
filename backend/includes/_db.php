<?php 
$server = "smoothoperators.com.mx";
 $db = "smoothop_segundo_parcial";
 $user = "smoothop_db" ;
 $password = "Goodluck13";

$mysqli = new mysqli($server, $user, $password, $db);
	if($mysqli-connect_errno){
		echo "Lo sentimos este sitio web está experimentando problemas";
		echo "Error: Fallo al conectarse a MySQL debido a: \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		exit;
	}
 ?>