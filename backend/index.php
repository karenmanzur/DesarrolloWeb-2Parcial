<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Active Box</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
</head>
<body class="text-center">
	<form class="form-signin">
		  <img class="mb-4" src="../img/logotipo.png">
		  <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
		  <label for="inputEmail" class="sr-only">Correo Electrónico</label>
		  <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required autofocus>
		  <label for="inputPassword" class="sr-only">Password</label>
		  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		  <div class="checkbox mb-3">
		    <label>
		      <input type="checkbox" value="remember-me"> Recordar
		    </label>
		  </div>
		  <button class="btn btn-lg btn-primary btn-block" id="buttonSign" type="button">Iniciar</button>
		  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
		</form>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>	
	<script>
			$("#buttonSign").click(function(){
				//1. Obtener el valor del email
				let correo = $("#inputEmail").val();
				//2. Obtener el valor del password
				let password = $("#inputPassword").val();
				let obj = {
					"accion" : "login",
					"usuario" : correo,
					"password" : password
				};
				$.post("includes/_funciones.php", obj, function(e){
						alert(e);
					
				});
				//3. Enviar a validar esos valores

				//4. En caso de ser valido, redireccionar a usuarios.php
				//5. En caso de no ser válido, enviar mensaje de error 
			});
	</script>











</body>
</html>