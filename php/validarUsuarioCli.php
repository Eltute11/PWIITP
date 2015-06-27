<?php 


session_start();

include_once ("clases.php");
include_once ("funciones.php");

$base = new BD;
$conexion = $base->Conectar();

if (isset($_GET['error-val'])){
	$error_val = $_GET['error-val'];
}
else
{
	$error_val ='';

}


if (isset($_GET['nError'])) {
	$nError = $_GET['nError'];
	switch ($nError) {
		case 1: $campo_obligatorio = "<span style='color: red;'> *Campo obligatorio </span>";
				break;
		case 4: $usuario_existente = "<span style='color: red;'> *El usuario ya existe </span>";	
				break;
		case 7: $pass_error =  "<span style='color: red;'>*Las contraseñas no coinciden</span>";		
				break;	
	}
}
else{
	$nError = 0;
}





if (!isset($_SESSION['valido_cli'])){  # ESTE TRATAMIENTO SE APLICA PARA EL CASO EN QUE SI EL CLIENTE YA FUE VALIDADO,
	$valido_cli = 1;				   # Y SE INTENTA INGRESAR UN USUARIO, SI EXISTE UNA VALIDACION POR CAMPO_OBLIGATORIO O USUARIO EXISTENTE			
}									   # NO VUELVA A REALIZAR LAS VALIDACIONES HECHAS PARA EL CLIENTE, YA QUE VUELVE A SU PAGINA (regUsuarioCliente.php)
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
		$_SESSION['tipo_doc']=$tipo_doc;

		$nro_doc = $_POST['nro_doc'];
		$_SESSION['nro_doc']=$nro_doc;
		
		$val = new validacion;
		
		$val->val_campo_obligatorio('regUsuarioCliente.php',$_POST['tipo_doc'],'tipo_doc',0);
		
		$val->val_campo_obligatorio('regUsuarioCliente.php',$_POST['nro_doc'], 'nro_doc',1);
		
		$val->val_campo_numerico('regUsuarioCliente.php',$_POST['nro_doc'], 'nro_doc',1);

		$val->val_cliente_inexistente ('regUsuarioCliente.php',$tipo_doc,$nro_doc,'nro_doc');
	}


    ?>

    <form action="aplicarAltaUsuario.php" method="POST">

	    <label for="newUser">Usuario</label>
	    <input type="text" name="newUser" value=<?php validar_var_session('newUser') ?>> 
	    <?php 
		    if (strpos($error_val,'newUser')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 4: echo "$usuario_existente";
			 				break;	
			 	}
			 }
    	?>

	  		<br>
		<br>
		
		<label for="pass">Contraseña:</label>
	    <input type="password" name="pass1" value=<?php validar_var_session('pass1') ?>>
	     <?php 
	    	if ($nError == 1 && strpos($error_val,'pass1')) {
				echo "$campo_obligatorio";
			}
	     ?>

	    <br>
	    <br>
	    
	    <label for="pass2">Repetir Contraseña: </label>
	    <input type="password" name="pass2" value=<?php validar_var_session('pass2') ?>>
	     <?php 
		    if (strpos($error_val,'pass2') || $nError == 7 ){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 7: echo "$pass_error";
			 				break;	
			 	}
			 }
	    ?>

	    <br>
	    <br>
	    <input type="hidden" name="cod_tiporol" value="3"> 
		<input type="submit" value="Enviar">
	
	</form>

</body>
</html>