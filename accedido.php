<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Accedido</title>
</head>
<body>
	<?php 
	session_start();

		if(isset($_SESSION['usuario'])){
			echo 'Bienvenido seas ', $_SESSION['usuario'], ' a esta nueva sesion.';
	
		}else{
			#session_start(); // Si no hay sesion definida, comprobar datos de sesion #Ya esta siendo llamada arriba
			session_destroy();
			header('location: index.php?error=loguearse');
		}
		
	?>
</body>
</html>