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

		case 'consultar_test':
		consultar_test($_POST['id']);
		break;

		case 'editar_slider':
		editar_slider($_POST['id']);
		break;

		case 'insertar_slider':
		insertar_slider();
		break;

		case 'eliminar_slider':
		eliminar_slider($_POST['id']);
		break;

		case 'eliminar_registro':
		eliminar_usuario($_POST['id']);
		break;

		case 'editar_usuarios':
		editar_usuarios($_POST['id']);
		break;

		case 'consultar_registro':
		consultar_registro($_POST['id']);
		break;

		case 'carga_foto':
		carga_foto();
		break;

	default:
			# code...
	break;
}

function carga_foto(){
	if (isset($_FILES["foto"])) {
		$file = $_FILES["foto"];
		$nombre = $_FILES["foto"]["name"];
		$temporal = $_FILES["foto"]["tmp_name"];
		$tipo = $_FILES["foto"]["type"];
		$tam = $_FILES["foto"]["size"];
		$dir = "../../img/usuarios/";
		$respuesta = [
			"archivo" => "../img/usuarios/logotipo.png",
			"status" => 0
		];
		if(move_uploaded_file($temporal, $dir.$nombre)){
			$respuesta["archivo"] = "../img/usuarios/".$nombre;
			$respuesta["status"] = 1;
		}
		echo json_encode($respuesta);
	}
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

function editar_usuarios(){
	global $mysqli;
	extract($_POST);
	$consulta = "UPDATE usuarios SET nombre_usr = '$nombre', correo_usr = '$correo', 
	pswd_usr = '$password', telefono_usr = '$telefono' WHERE id_usr = '$id' ";
	$resultado = mysqli_query($mysqli, $consulta);
	if($resultado){
		echo "Se editó correctamente";
	}else{
		echo "Se generó un error, intentalo nuevamente";
	}
}


function consultar_registro($id){
	global $mysqli;
	$consulta = "SELECT * FROM usuarios where id_usr = $id LIMIT 1";
	$resultado = mysqli_query($mysqli, $consulta);
	$fila = mysqli_fetch_array($resultado);
	echo json_encode($fila); 
}

function eliminar_usuario($id){
	global $mysqli;
	$query = "DELETE FROM usuarios WHERE id_usr = $id";
	$resultado = mysqli_query($mysqli, $query);
	if ($resultado) {
		echo "1";
	} else {
		echo "0";
	}
}

function login(){
		// Conectar a la base de datos
	global $mysqli;
		// Si usuario y contraseña están vacíos imprimir 3
	$correo = $_POST['correo']; 
	$password = $_POST['pswd'];
	$consulta = "SELECT * FROM usuarios WHERE correo_usr ='$correo'";
	$resultado = mysqli_query($mysqli, $consulta);
	$fila = mysqli_fetch_array($resultado);
	if($fila["pswd_usr"] == "$password" ){
		
		session_start();
        error_reporting(0);
        $_SESSION['usuario'] = $correo;
  
        echo "1"; 
      }
    else 
      {
        echo "Error en la contraseña o usuario";
      }
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

function consultar_test($id){
	global $mysqli;
	$consulta = "SELECT * FROM slider WHERE id_slider = $id  LIMIT 1";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}

function insertar_slider(){
	global $mysqli;
	$img_slider = $_POST["ruta"];
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

 function eliminar_slider($id){
  global $mysqli;
  $query = "DELETE FROM slider WHERE id_slider = $id";
  $resultado = mysqli_query($mysqli, $query);
  if ($resultado) {
    echo "1";
  } else {
    echo "0";
  }
}

function editar_slider($id){
  global $mysqli;
  extract($_POST);
  $consulta = "UPDATE slider SET img_slider = '$ruta', quote_slider = '$texto', 
  name_slider = '$nombre' WHERE id_slider = '$id' ";
  $resultado = mysqli_query($mysqli, $consulta);
  if($resultado){
    echo "Se editó correctamente";
  }else{
    echo "Se generó un error, intentalo nuevamente";
  }
}
	  
?>