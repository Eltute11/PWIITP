<?php 
session_start();
// session_destroy();

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
		case 6: $perfil_existente =  "<span style='color: red;'> <h3>El perfil que esta intentando dar de alta ya existe </h3></span>";		
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
        <title>ALTA PERFIL</title>
    </head>
    <body>

        <h2>ALTA PERFIL</h2>
        	
        <form action="php/aplicarAltaPerfil.php" method="POST">
		<?php 
	 	 
	 	 if ($nError == 6) {
	 	 	echo $perfil_existente;
	 	 	echo "<br>";
	 	 }

	 	?>
			<label>Seleccionar tipo de alta:</label>
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
			
			<label for="tipo_doc">Tipo de Documento:</label>
			<?php 
				$formulario = new formulario;
				$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
			 
				if ($nError == 1 && strpos($error_val,'tipo_doc')) {
					echo "$campo_obligatorio";
				}
			
			?>
			 
			<label for="nro_doc">Número Documento:</label>
			<input type="text" id="nro_doc"name="nro_doc" value=<?php validar_var_session('nro_doc') ?>>
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
			<br>
			<br>
			
			<label for="nombres">Nombres: </label>
			<input type="text" name="nombres" id="nombres" value=<?php validar_var_session('nombres') ?>> 
			<?php 
			 	if (strpos($error_val,'nombres')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 3: echo "$solo_letras";
			 				break;	
			 	}
			 }
			
			?>
			<label for="apellidos">Apellidos: </label>
			<input type="text" name="apellidos" id="apellidos" value=<?php validar_var_session('apellidos') ?>> 
			<?php 
			 	if (strpos($error_val,'apellidos')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 3: echo "$solo_letras";
			 				break;	
			 	}
			 }
			 ?>
			<br>
			<br>

			<label for="fecha_nac">Fecha de nacimiento: </label>
		    <input id="fecha_nac" name="fecha_nac" type="date" value=<?php validar_var_session('fecha_nac') ?> >
		    <?php 
				if ($nError == 1 && strpos($error_val,'fecha_nac')){
					echo "$campo_obligatorio";
				}
			?>
			<br>
			<br>

		    
			<label for="pais">País: </label>
			<?php 
				$formulario = new formulario;
				$formulario->LlenarCombos('cod_pais','descr_pais','PAISES','pais');
		     
		    	if ($nError == 1 && strpos($error_val,'pais')){
					echo "$campo_obligatorio";
				}
			?>
		     <br>
		     <br>
			
			<label for='provincias'>Provincia: </label>
		    <?php 
				$formulario = new formulario;
				$formulario->LlenarCombos('cod_prov','descr_prov','PROVINCIAS','provincia');
	     		
	     		if ($nError == 1 && strpos($error_val,'pais')){
						echo "$campo_obligatorio";
					}
			?>
		    <br>
		    <br>
			
			<label for='localidades'>Localidad: </label>
		    <?php 
		    	$formulario = new formulario;
		    	$formulario->LlenarCombos('cod_loc','descr_loc','LOCALIDADES','localidad');
		    
				if ($nError == 1 && strpos($error_val,'localidad')) {
						echo "$campo_obligatorio";
					}
			?>
			<br>
			<br>

			<label for="direccion">Dirección: </label>
			<input type="text" name="direccion" id="direccion" value=<?php validar_var_session('direccion') ?>>
			<?php 
			 	if (strpos($error_val,'direccion')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 3: echo "$solo_letras";
			 				break;	
			 	}
			 }
			 ?>

			
			<label for="num_direc">Numero: </label>
			<input type="text" name="num_direc" id="num_direc" value=<?php validar_var_session('num_direc') ?>>
			<?php 
			 	if (strpos($error_val,'num_direc')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 2: echo "$solo_numeros";
			 				break;	
			 	}
			 }
    		?>
			<br>
			<br>

			<label>Sexo</label>
			<input id="fem" name="sexo" type="radio" value="F" <?php if (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'F') echo "checked"; ?> /><label for="fem">Femenino</label>
			<input id="mas" name="sexo" type="radio" value="M" <?php if (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'M') echo "checked"; ?>/><label for="mas">Masculino</label>
			<?php 
				if ($nError == 1 && strpos($error_val,'sexo')){
						echo "$campo_obligatorio";
				}
			?>
			<br>
			<br>

			<label for="telefono1">Teléfono 1:</label>
			<input type="text" name="telefono1" id="telefono1" value=<?php validar_var_session('telefono1') ?>>
			<?php 
			 	if (strpos($error_val,'telefono1')){
			 	switch ($nError) {
			 		case 1: echo "$campo_obligatorio";
			 				break;
			 		case 2: echo "$solo_numeros";
			 				break;	
			 	}
			 }
    		?>
			
			<label for="telefono2">Teléfono 2:</label>
			<input type="text" name="telefono2" id="telefono2" value=<?php validar_var_session('telefono2') ?>>
			<?php 
			 	if (strpos($error_val,'telefono2')){
			 	switch ($nError) {
			 		case 2: echo "$solo_numeros";
			 				break;	
			 	}
			 }
    		?>
			<br>
			<br>

			<label for="email">Dirección E-mail:</label>
			<input type="text" name="email" id="email" value=<?php validar_var_session('email') ?>>
			<br>
			<br>
			
			<br>
			<br>

			<input type="submit" value="Enviar">
			<input id="resetButton" name="reset" type="reset">
		</form>
		
		<a href="administrador.php">Volver</a>

	</body>
</html>
