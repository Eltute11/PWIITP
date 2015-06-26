<?php 
session_start();
//session_destroy();
		
if(!isset($_SESSION['usuario'])){
			session_destroy();
			header('location: index.php?error=loguearse');
			
}
include_once ("php/clases.php");
include_once ("php/funciones.php");

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
		case 2: $solo_numeros =  "<span style='color: red;'> *Solo numeros</span>";		
				break;		
		case 3: $solo_letras =  "<span style='color: red;'> *Solo letras</span>";		
				break;	
		case 6: $perfil_inexistente =  "<span style='color: red;'> <h3>PERFIL INEXISTENTE</h3></span>";		
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
    <title>MODIFICACION</title>
	</head>
	<body>
		<h2>MODIFICACION</h2>
		<h3>Datos del usuario a modificar</h3>
		
		<form action='frmModificacionPerfil.php' method='POST'>
	 	
	 	<?php 
	 	 
	 	 if ($nError == 6) {
	 	 	echo $perfil_inexistente;
	 	 	echo "<br>";
	 	 }

	 	?>

	 	<label>Seleccionar tipo de perfil: </label>
		<input id="adm" name="tipo_rol" type="radio" value="1" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 1) echo "checked"; ?> /><label for="adm">Administrador</label>
		<input id="mon" name="tipo_rol" type="radio" value="2" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 2) echo "checked"; ?> /><label for="mon">Monitoreador</label>
		<input id="cli" name="tipo_rol" type="radio" value="3" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 3) echo "checked"; ?> /><label for="cli">Cliente</label>
		<?php 
		if ($nError == 1 && strpos($error_val,'tipo_rol')) {
			echo "$campo_obligatorio";
		}
		?>
		<br>
		<br>

	 	<label for='tipo_doc'>Tipo de Documento:</label>
		<?php
		$formulario = new formulario;
		$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
		if ($nError == 1 && strpos($error_val,'tipo_doc')) {
					echo "$campo_obligatorio";
				}
	  	 ?>
	  	<label for='nro_doc'>Número Documento:</label>
		<input type='text' id='nro_doc'name='nro_doc' value=<?php validar_var_session('nro_doc') ?>>
		<?php 
			if (strpos($error_val,'nro_doc')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 2: echo "$solo_numeros";
			 				break;	
			 	}
			 }
		?>
		<br><br>
		<input type="hidden" name="valido_perfil" value="1"> 

		<input type="hidden" name="resultado_busqueda" value="1"> 
		
		<input type='submit' value='Consultar datos'>
		<br>
		<br>
		


		<a href="administrador.php">Volver</a>
		</form>
	</body>
</html>