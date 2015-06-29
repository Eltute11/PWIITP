<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if (isset($_POST['sesion'])) {
	$sesion = $_POST['sesion'];
}
else {
	$sesion = '';
}

<<<<<<< HEAD:seguridadlandia/php/login.php
=======

>>>>>>> origin/master:php/login.php
if (isset($user) && isset($pass)) { // Si estan definidas
	if (empty($user) || empty($pass)) {  // Si estan vacias
		header('location: ../index.php?error=campos_vacios');
		exit();
<<<<<<< HEAD:seguridadlandia/php/login.php
	}else{	
=======
	}else{
		
>>>>>>> origin/master:php/login.php
		include('clases.php');
		$base = new BD;
		$base->Conectar();

		$login = new acceso();
<<<<<<< HEAD:seguridadlandia/php/login.php
		$passEncrip = md5($pass); //Obtengo clave enscriptada
		$login->login($user, $passEncrip, $sesion);
=======

		$passEncrip = md5($pass); //Obtengo clave enscriptada
		
		$login->login($user, $passEncrip, $sesion);
		
>>>>>>> origin/master:php/login.php
	}
}else{
	// No estan definidas
 	// Esto pasa cuando intentamos acceder a la URL sin antes habernos logeado
 	header('location: ../index.php?error=loguearse');
}
?>


