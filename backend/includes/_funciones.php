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

		case 'consultar_slider':
		consultar_slider();
		break;

		case 'insertar_slider':
		insertar_slider();
		break;

		case 'eliminar_usuarios':
		eliminar_registro($_POST['registro']);
		break;

		case 'editar_usuarios':
		editar_usuarios($_POST['id']);
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

function eliminar_usuarios($id){
	global $mysqli;
	$query = "DELETE FROM usuarios WHERE id_usr = $id";
	$resultado = mysqli_query($mysqli, $query);
	if ($resultado) {
		echo "Se eliminó correctamente";
	} else {
		echo "Se generó un error, intenta nuevamente";
	}
}

	function editar_usuarios($id){
		global $mysqli;
		$nombre = $_POST['nombre_usr'];
		$correo = $_POST['correo_usr'];
		$telefono = $_POST['telefono_usr'];
		$password = $_POST['password_usr'];
			$sql = "UPDATE usuarios SET nombre_usr = '$nombre', correo_usr = '$correo', telefono_usr = '$telefono', pswd_usr = '$password' WHERE id_usr = '$id'";
			$rsl = $mysqli->query($sql);
			if ($rsl) {
				echo "El usuario se editó correctamente";
			}else{
				echo "Se generó un error, intenta nuevamente";
			}
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

function consultar_slider(){
	global $mysqli;
	$consulta = "SELECT * FROM slider";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}

function insertar_slider(){
	global $mysqli;
	$img_slider = $_POST["imagen"];
	$quote_slider = $_POST["texto"];	
	$name_slider = $_POST["nombre"];	
	$consulta1 = "INSERT INTO slider VALUES('','$img_slider','$quote_slider','$name_slider')";
	$resultado1 = mysqli_query($mysqli, $consulta1);
	$array = [];
	while($fila1 = mysqli_fetch_array($resultado1)){
		array_push($arreglo1, $fila1);
	}
	echo json_encode($arreglo1); //Imprime el JSON ENCODEADO
}
	  
?>