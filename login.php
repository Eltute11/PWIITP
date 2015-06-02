<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<?php
	//Usuario: 		matias
	//Contraseña: 	1234

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$sesion = $_POST['sesion'];

	if (isset($user) && isset($pass)) { // Si estan definidas
		if (empty($user) || empty($pass)) {  // Si estan vacias
			//echo "Los dos campos tienen que estar llenos, no puede haber campos vacios";
			header('location: index.php?error=1');//Redirecciona la pagina 
		} else {
			if ($user == 'matias' && $pass == 1234) {
				session_start(); //Crea una nueva sesion cuando no haya ninguna activa. En caso de que ya estemos logeado, controla los datos.
				if ($_POST['sesion'] == 1) { // Si el checkbox esta activado
					ini_set(session.cookie_lifetime,time() + (60*60));//Seteamos el tiempo que durara la sesion
				}
				$_SESSION['usuario'] = $user;
				header('location: accedido.php');//Redirecciona la pagina 
			} else {
				//echo "El usuario y/o contraseña son incorrecto";
				header('location: index.php?error=2');//Redirecciona la pagina 
			}
		}
 	}else{
 		// No estan definidas
 		// Esto pasa cuando intentamos acceder a la URL sin antes habernos logeado
 		header('location: index.php?error=3');
 	}
 ?>
</body>
</html>

