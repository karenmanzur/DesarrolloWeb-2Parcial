<?php 
global $mysqli;
$imagen = $_REQUEST["imagen"]["name"];
$ruta = $_REQUEST["imagen"]["tmp_name"];
$destino = "./upload".$imagen;
copy($ruta, $destino);


 ?>