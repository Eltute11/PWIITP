<?php 
	// Si se envio error='x' 
	if (isset($_GET['error'])) {
		if ($_GET['error'] == 1) {
			echo "Los dos campos tienen que estar llenos, no puede haber campos vacios";
		}else{
			if ($_GET['error'] == 2) {
				echo "El usuario y/o contraseña son incorrecto";
			}else{
				if ($_GET['error'] == 3) {
				echo "No debes saltearte el formulario";
				}else{
					if ($_GET['error'] == 4) {
						echo "No debes acceder sin iniciar sesion";
					}
				}
			}
		}
			unset($_GET['error']); //Borramos de memoria para optimizar PHP
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sesiones</title>
</head>
<body>

	<form action="login.php" method="POST">
		<label for="user">Usuario: </label><input type="text" name="user">
		<label for="pass">Contraseña: </label><input type="pass" name="pass"><br>
		<label>Deseo recordar mis datos <input type="checkbox" name="sesion" value="1"></label>
		<input type="submit" value="Login">

	</form>
	
</body>
</html>