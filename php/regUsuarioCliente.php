<?php 

session_start();
// session_destroy();
<<<<<<< HEAD:seguridadlandia/php/regUsuarioCliente.php
=======

>>>>>>> origin/master:php/regUsuarioCliente.php
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
<<<<<<< HEAD:seguridadlandia/php/regUsuarioCliente.php
=======

>>>>>>> origin/master:php/regUsuarioCliente.php
}


if (isset($_GET['nError'])) {
	$nError = $_GET['nError'];
	switch ($nError) {
		case 1: $campo_obligatorio = "<span style='color: red;'> *Campo obligatorio </span>";
				break;
		case 2: $solo_numeros =  "<span style='color: red;'> *Solo numeros</span>";		
				break;	
		case 5: $cliente_inexistente =  "<span style='color: red;'> *Cliente inexistente</span>";		
				break;
	}
}
else{
	$nError = 0;
}

?>


<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<form action="validarUsuarioCli.php" method="POST">
	<label for="tipo_doc">Tipo de Documento:</label>
	<?php 
		$formulario = new formulario;
		$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
<<<<<<< HEAD:seguridadlandia/php/regUsuarioCliente.php
	 	if ($nError == 1 && strpos($error_val,'tipo_doc') {
			echo "$campo_obligatorio";
		}
=======
	 	if ($nError == 1 && strpos($error_val,'tipo_doc')) {
					echo "$campo_obligatorio";
				}
>>>>>>> origin/master:php/regUsuarioCliente.php
	?>

	
	<label for="nro_doc">Número Documento:</label>
	<input type="text" id="nro_doc"name="nro_doc" value=<?php validar_var_session('nro_doc') ?>>
	<?php 
<<<<<<< HEAD:seguridadlandia/php/regUsuarioCliente.php
	 	if (strpos($error_val,'nro_doc')){
=======
		if (strpos($error_val,'nro_doc')){
>>>>>>> origin/master:php/regUsuarioCliente.php
		 	switch ($nError) {
		 		case 1: echo "$campo_obligatorio";
		 				break;
		 		case 2: echo "$solo_numeros";
		 				break;	
		 		case 5: echo "$cliente_inexistente";
		 				break;		
		 	}
		 }
<<<<<<< HEAD:seguridadlandia/php/regUsuarioCliente.php

	?>		
=======
	?>	
>>>>>>> origin/master:php/regUsuarioCliente.php

	 <input type="submit" value="Enviar">
	</form>


</body>
</html>