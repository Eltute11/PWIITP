<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<?php
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$sesion = $_POST['sesion'];
	
	if (isset($user) && isset($pass)) { // Si estan definidas (si apretaron el boton "login")
		if (empty($user) || empty($pass)) {  // Si estan vacias
				#echo "Los dos campos tienen que estar llenos, no puede haber campos vacios";
				header('location: index.php?error=campos_vacios');//Redirecciona la pagina 
		}else{
			include('clases.php');
			$login = new acceso($user, $pass);
			$login->login();
			$_SESSION['usuario'] = $user;
		}
 	}else{
 		// No estan definidas
 		// Esto pasa cuando intentamos acceder a la URL sin antes habernos logeado
 		header('location: index.php?error=loguearse');
 	}
 ?>
</body>
</html>

