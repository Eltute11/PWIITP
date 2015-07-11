<?php 


session_start();

include_once ("clases.php");
include_once ("funciones.php");

$base = new BD;
$conexion = $base->Conectar();

if (isset($_GET['error-val'])){
	$error_val  = $_GET['error-val'];
}
else
{
	$error_val  ='';
}


if (isset($_GET['nError'])) {
	$nError = $_GET['nError'];
	switch ($nError) {
		case 1: $campo_obligatorio = "<span style='color: red;'> *Campo obligatorio </span>";
				break;
		case 4: $usuario_existente = "<span style='color: red;'> *El usuario ya existe </span>";
				break;
		case 8: $pass_error =  "<span style='color: red;'>*Las contraseñas no coinciden</span>";		
				break;
	}
}
else{
	$nError = 0;
	
}


if (!isset($_SESSION['valido_cli'])){  # ESTE TRATAMIENTO SE APLICA PARA EL CASO EN QUE SI EL CLIENTE YA FUE 											 VALIDADO,
	$valido_cli = 1;				   # Y SE INTENTA INGRESAR UN USUARIO, SI EXISTE UNA VALIDACION POR 											 CAMPO_OBLIGATORIO O USUARIO EXISTENTE			
}									   # NO VUELVA A REALIZAR LAS VALIDACIONES HECHAS PARA EL CLIENTE, YA QUE 											 VUELVE A SU PAGINA (regUsuarioCliente.php)
else{								   
	$valido_cli = 0;
}

?>

<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 

	$existe = 0;
	//exit ("$nro_doc  $tipo_doc");
	//include_once ("clases.php");
	if (isset($_SESSION['sCamposVal'])) {
		unset($_SESSION['sCamposVal']);
	}

	if (isset($_SESSION['nError'])) {
		unset($_SESSION['nError']);
	}

	if ($valido_cli==1) {

		$tipo_doc  = $_POST['tipo_doc'];
		$_SESSION['alta_usuario_cliente']['tipo_doc']=$tipo_doc;

		$nro_doc = $_POST['nro_doc'];
		$_SESSION['alta_usuario_cliente']['nro_doc']=$nro_doc;

		$nuevoUsuario  = $_POST['nuevoUsuario'];
		$_SESSION['alta_usuario_cliente']['nuevoUsuario']=$nuevoUsuario;

		$pass1 = $_POST['pass1'];
		$_SESSION['alta_usuario_cliente']['pass1']=$pass1;

		$pass2 = $_POST['pass2'];
		$_SESSION['alta_usuario_cliente']['pass2']=$pass2; 
		
		$val = new validacion;
		
		$val->val_campo_obligatorio('../index.php',$_POST['tipo_doc'],'tipo_doc',0);
		
		$val->val_campo_obligatorio('../index.php',$_POST['nro_doc'], 'nro_doc',0);
		
		$val->val_campo_obligatorio('../index.php',$_POST['nuevoUsuario'], 'nuevoUsuario',0);
		
		$val->val_campo_obligatorio('../index.php',$_POST['pass1'], 'pass1',0);
		
		$val->val_campo_obligatorio('../index.php',$_POST['pass2'], 'pass2',1);
		
		$val->val_campo_numerico('../index.php',$_POST['nro_doc'], 'nro_doc',1);

		$val->val_cliente_inexistente ('../index.php',$tipo_doc,$nro_doc,'nro_doc');

		$val->val_usuario('../index.php', $nuevoUsuario, 'nuevoUsuario');

		$val->val_passwords('../index.php',$pass1, $pass2);
	}

	$passEncrip = md5($pass1);

	$id_perfil = $_SESSION['id_perfil']; // EL ID_PERFIL LO OBTENGO EN LA VALIDACION val_cliente_inexistente



	$sMySQL = "INSERT INTO USUARIOS (cod_tiporol, id_perfil, usuario, password)
			  VALUES ( 3 ,$id_perfil , '$nuevoUsuario', '$passEncrip')";

	$rQuery = mysql_query($sMySQL);


	if (mysql_affected_rows() == 1) {
		// echo "<h3>El usuario $nuevoUsuario se dio de Alta exitosamente.</h3>";	        
		// session_destroy();
		header('location: ../cliente.php');//Redirecciona la pagina
		}
	else
		echo "<h3>Ha ocurrido un problema al querer dar de alta al usuario $nuevoUsuario :<br><br>" . mysql_error()."</h3>";



    ?>

    
	

</body>
</html>