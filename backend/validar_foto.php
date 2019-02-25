<?php 
global $mysqli;
$nombre = $_REQUEST["nombre"];
$imagen = $_REQUEST["imagen"]["nombre"];
$ruta = $_REQUEST["imagen"]["tmp_name"];
$destino = "upload/".$imagen;
copy($ruta, $destino);


 ?>