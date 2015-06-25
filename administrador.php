<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
  <a href="index.php">HOME</a>
  <br>
  <br>

  <?php  
  session_start();
		if(isset($_SESSION['usuario'])){
			echo 'Bienvenido seas ', $_SESSION['usuario'], ' a esta nueva sesion.';
		}else{
			#session_start(); // Si no hay sesion definida, comprobar datos de sesion #Ya esta siendo llamada arriba
			session_destroy();
			header('location: index.php?error=loguearse');
		}
  ?>


 <br>
 <br>
  <a href="frmAltaPerfil.php">Alta perfil</a>
  <a href="frmConsultarPerfil.php">Modificar perfil</a>
  <a href="frmBajaPerfil.php">Eliminar perfil</a>

  

</body>
</html>