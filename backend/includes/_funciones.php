<?php 
require_once("_db.php");
switch ($_POST["accion"]) {
	case 'login':
	login();
	break;

	case 'consultar_usuarios':
	consultar_usuarios();
	break;

	case 'insertar_usuarios':
		insertar_usuarios();
		break;

	default:
			# code...
	break;
}
function consultar_usuarios(){
	global $mysqli;
	$consulta = "SELECT * FROM usuarios";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}

function login(){
		// Conectar a la base de datos
	global $mysqli;
		// Si usuario y contraseña están vacíos imprimir 3 
	$consulta = "SELECT * FROM USUARIOS WHERE correo_usr='$correo'";
	$resultado = mysqli($mysqli, $consulta);
	$fila = mysqli_fetch_array($resultado);
	if($fila["pswd_usr"] == "$password" ){
	}
		// Consultar a la base de datos que el usuario exista
			// Si el usuario existe, consultar que el password, sea correcto
				// Si el password es correcto, imprimir 1
				// Si el password no es correcto, imprimir 0
			// Si el Usuario no existe, Imprimir 2
}

function insertar_usuarios(){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    global $mysqli;
    if ($nombre!=''&&$correo!=''&&$telefono!=''&&$password!='') {
        $verif = "SELECT * FROM usuarios WHERE correo_usr = '$correo'";
        $resultado = $mysqli->query($verif);
        if ($resultado->num_rows == 0) {
            $query = "INSERT INTO usuarios VALUES('','$nombre','$correo','$telefono','$password','1')";
            $data = $mysqli->query($query);
            echo "Usuario agregado correctamente";
        } else{
            echo "correo ya existente";
        }
    }
}
