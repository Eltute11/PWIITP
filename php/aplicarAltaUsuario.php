<?php 

include_once ("clases.php");

$base = new BD;
$conexion = $base->Conectar();

 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<?php
session_start();	
	
	$newUser  = $_POST['newUser'];
	$_SESSION['newUser']=$newUser;

	$pass1 = $_POST['pass1'];
	$_SESSION['pass1']=$pass1;

	$pass2 = $_POST['pass2'];
	$_SESSION['pass2']=$pass2;	

   	$_SESSION['valido_cli']= 0;
 	
 	$cod_tiporol = $_POST['cod_tiporol'];

 	$id_perfil = $_SESSION['id_perfil'];
    
	$val = new validacion;

	$val->val_campo_obligatorio('validarUsuarioCli.php',$_POST['newUser'],'newUser',0);
	
	$val->val_campo_obligatorio('validarUsuarioCli.php',$_POST['pass1'], 'pass1', 0);
	
	$val->val_campo_obligatorio('validarUsuarioCli.php',$_POST['pass2'], 'pass2',1);

	$val->val_usuario('validarUsuarioCli.php', $newUser, 'newUser');

	$val->val_passwords('validarUsuarioCli.php',$pass1, $pass2);	

	$passEncrip = md5($pass1);
	
	$sMySQL = "INSERT INTO USUARIOS (cod_tiporol, id_perfil, usuario, password)
			  VALUES ( $cod_tiporol ,$id_perfil , '$newUser', '$passEncrip')";

	$rQuery = mysql_query($sMySQL);


	if (mysql_affected_rows() == 1) {
		echo "<h3>El usuario $newUser se dio de Alta exitosamente.</h3>";	        
		session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer dar de alta al usuario $newUser :<br><br>" . mysql_error()."</h3>";

 ?>

</body>
</html>