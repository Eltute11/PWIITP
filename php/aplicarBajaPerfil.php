<?php
session_start();
//session_destroy();

		if(!isset($_SESSION['usuario'])){
			session_destroy();
			header('location: ../index.php?error=loguearse');
			#echo '<h1>Sesion: ',$_SESSION['usuario'],'</h1>';
			
		}


include ("clases.php");

 ?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>aplicarModificacionPerfil</title>
</head>
<body>

	<?php 
	$nombres = $_SESSION['nombres'];
    $apellidos = $_SESSION['apellidos'];
    $descr_tipdoc = $_SESSION['descr_tipdoc'];
    $id_perfil = $_SESSION['id_perfil'];
	$tipo_rol_desc = $_SESSION['tipo_rol_desc'];

	$base = new BD;
	$conexion = $base->Conectar();

	//Elimino primero usuario. Si no tiene, no arroja error el SQL. Caso ejemplo. Un cliente que no se haya dado de alta como usuario. 

	$sMySQL = "DELETE FROM USUARIOS WHERE id_perfil = $id_perfil";
	mysql_query($sMySQL);


	//Elimino el perfil.
	$sMySQL = "DELETE FROM PERFILES WHERE id_perfil = $id_perfil";
	mysql_query($sMySQL);


	if (mysql_affected_rows() == 1) {
		echo "<h3>El $tipo_rol_desc $nombres $apellidos ha sido eliminado exitosamente.</h3>";	        
		//session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer eliminar al $tipo_rol_desc $nombres $apellidos <br><br>" .mysql_error()."</h3>";







	?>
</body>
</html>