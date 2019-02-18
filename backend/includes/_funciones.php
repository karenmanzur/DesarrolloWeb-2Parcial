<?php 
	require_once("_db.php");
	switch ($_POST["accion"]) {
		case 'login':
			login();
			break;
		
		default:
			# code...
			break;
	}

	function login(){
		//Conectar a la base de datos
			global $mysqli;
			$user = $_POST["usuario"];
			$password = $_POST["password"];

			//Si usuario y contraseña estan vacíos, imprimir 3
			if ($user == ''||$password == '') {
			echo "Usuario & Password vacíos: 3";
			} 
		//Consultar a la bd que el usuario exista
			//Si existe, consultar que el password sea correcto
			 else {
			  $query = "SELECT * FROM usuarios WHERE pswd_usr = '$password'";
			  $result = $mysqli->query($query);
			  $row_count = $result->rowCount();
			//Si el password es incorrecto, imprimir 1
				if ($result == 0) {
					echo "Contraseña incorrecta: 1";
				} 
					//Si el password es correcto, imprimir 0
					else  {
						echo "Contraseña correcta: 0";
					}
			//Si el usuario no existe, Imprimir 2
			else{
				$query2 = "SELECT * FROM usuarios WHERE correo_usr = '$user'";
				$result2 = $mysqli->query($query2);
				$row_count2 = $result2->rowCount();
				if ($row_count2 == 0) {
					echo "El usuario no existe: 2";
				} 
			}
		}	
	}
 ?>	