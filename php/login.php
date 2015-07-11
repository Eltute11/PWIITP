<?php


session_start();

include_once ("clases.php");

if (isset($_SESSION['sCamposVal'])) {
	unset($_SESSION['sCamposVal']);
}

if (isset($_SESSION['nError'])) {
	unset($_SESSION['nError']);
}


$user = $_POST['user'];
$_SESSION['acceso']['user'] = $user;

$pass = $_POST['pass'];
$_SESSION['acceso']['pass'] = $pass;

if (isset($_POST['sesion'])) {
	$sesion = $_POST['sesion'];
}
else {
	$sesion = '';
}

$val = new validacion;

$val->val_campo_obligatorio('../index.php',$_POST['user'],'user',0);
		
$val->val_campo_obligatorio('../index.php',$_POST['pass'], 'pass',1);

$base = new BD;
$base->Conectar();

$login = new acceso();
$passEncrip = md5($pass); //Obtengo clave enscriptada
$login->login($user, $passEncrip, $sesion);



?>


