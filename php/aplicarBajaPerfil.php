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
	$nombres = $_SESSION['baja']['nombres'];
    $apellidos = $_SESSION['baja']['apellidos'];
    $descr_tipdoc = $_SESSION['baja']['descr_tipdoc'];
    $tipo_rol = $_SESSION['baja']['tipo_rol'];
    $id_perfil = $_SESSION['baja']['id_perfil'];
	$tipo_rol_desc = $_SESSION['baja']['tipo_rol_desc'];

	
	$base = new BD;
	$conexion = $base->Conectar();

	//Elimino primero usuario. Si no tiene, no arroja error el SQL. Caso ejemplo. Un cliente que no se haya dado de alta como usuario. 

	$sQuery="DELETE FROM USUARIOS WHERE id_perfil = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla USUARIOS: ".mysql_error());

	//SI ES UN CLIENTE DEBO BORRAR LOS DATOS QUE HAY EN TABLAS QUE HACEN REFERENCIA A PERFIL
	
	

	if ($tipo_rol == 3) { 

	$sQuery = "DELETE FROM FACTURA_DET WHERE id_cliente = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla FACTURA_DET: ".mysql_error());

	$sQuery = "DELETE FROM FACTURA_CAB WHERE id_cliente = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla FACTURA_CAB: ".mysql_error());		

	$sQuery = "DELETE FROM CAMARAS WHERE id_cliente = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla CAMARAS: ".mysql_error());		

	$sQuery = "DELETE FROM HIST_ALARMA_CLIENTE WHERE id_cliente = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla HIST_ALARMA_CLIENTE: ".mysql_error());		

	$sQuery = "DELETE FROM ALARMA_CLIENTE WHERE id_cliente = $id_perfil";
	mysql_query($sQuery)or die("Error al querer eliminar registros de tabla ALARMA_CLIENTE: ".mysql_error());		
		
	}

	//Elimino el perfil.
	$sQuery = "DELETE FROM PERFILES WHERE id_perfil = $id_perfil";
	mysql_query($sQuery) or die("Error al querer eliminar registros de tabla PERFILES: ".mysql_error());		

     $_SESSION['tituloResultado'] = "Baja de perfil"; // Guardo en esta variable session el titulo que se va a mostrar en la pagina resultadoOperacion.php

	if (mysql_affected_rows() == 1) {
		// echo "<h3>El $tipo_rol_desc $nombres $apellidos ha sido eliminado exitosamente.</h3>";	        
		$_SESSION['msjResultadoOperacion'] = "El $tipo_rol_desc $nombres $apellidos ha sido eliminado exitosamente.";
		header("location: ../resultadoOperacion.php");
		//session_destroy();
		}
	else{
		// echo "<h3>Ha ocurrido un problema al querer eliminar al $tipo_rol_desc $nombres $apellidos <br><br>" .mysql_error()."</h3>";
		$_SESSION['msjResultadoOperacion'] = "Ha ocurrido un problema al querer eliminar al $tipo_rol_desc $nombres $apellidos: ".mysql_error();	
		header("location: ../resultadoOperacion.php?errorOperacion=1&volverPagina=frmBajaPerfil");
	} 	

	?>
</body>
</html>