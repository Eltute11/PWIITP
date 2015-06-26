<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if (isset($user) && isset($pass)) { // Si estan definidas
	if (empty($user) || empty(pass)) {  // Si estan vacias
		header('location: ../index.php?error=campos_vacios');
		exit();
	}else{
	/*	$user = $_POST['user'];
		$pass = $_POST['pass'];
	*/	
		include('clases.php');
		$base = new BD;
		$base->Conectar();

		$login = new acceso();
		if (isset($_POST['sesion'])) {
			$sesion = $_POST['sesion'];
			$login->login($user, $pass, $sesion);
		}else{
			$login->login($user, $pass, '');
		}
	}
}else{
	// No estan definidas
 	// Esto pasa cuando intentamos acceder a la URL sin antes habernos logeado
 	header('location: ../index.php?error=loguearse');
}
?>


