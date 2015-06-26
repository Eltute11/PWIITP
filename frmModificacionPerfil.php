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
    <title>MODIFICACION</title>
	</head>
	<body>
		<h2>MODIFICACION</h2>
		<h3>Datos del usuario a modificar</h3>
		<?php

		 if ($nError == 6) {
	 	 	echo $perfil_existente;
	 	 	echo "<br>";
	 	 }

	 
		if (isset($_SESSION['sCamposVal'])) { //VACIO VARIABLES SI FUERON SETEADAS, PARA REALIZAR UNA NUEVA VALIDACION.
		unset($_SESSION['sCamposVal']);
		}

		if (isset($_SESSION['nError'])) {
			unset($_SESSION['nError']);
		}
		
		if (isset($_POST['tipo_rol'])){
				$_SESSION['tipo_rol']=$_POST['tipo_rol'];
		}

		if (isset($_POST['tipo_doc'])){
				$_SESSION['tipo_doc']=$_POST['tipo_doc'];
		}

		if (isset($_POST['nro_doc'])){
				$_SESSION['nro_doc']=$_POST['nro_doc'];
		}
	
		if (isset($_POST['valido_perfil'])){		
			$val = new validacion;
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['tipo_rol'],'tipo_rol',0);
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['tipo_doc'],'tipo_doc',0);
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['nro_doc'], 'nro_doc',1);
		}
		if (isset($_SESSION['tipo_doc'])){
			$tipo_doc = $_SESSION['tipo_doc'];	
		}	

		if (isset($_SESSION['nro_doc'])){
			$nro_doc = $_SESSION['nro_doc'];	
		}	

		if (isset($_SESSION['tipo_rol'])){
			$tipo_rol = $_SESSION['tipo_rol'];	
		}	

		if (isset($_SESSION['nuevo_nro_doc'])) {
			$nuevo_nro_doc = $_SESSION['nuevo_nro_doc'];
		}
		
		$cMySQL = "SELECT cod_tiporol,        cod_tipdoc,         nro_doc,            
						  nombres,            apellidos,          fecha_nac,          
						  cod_pais,           cod_prov,           cod_loc,            
						  direccion,          num_direccion,      sexo,               
						  telefono_1,         telefono_2,         direccion_email,    
						  id_perfil	    		   
		  		   FROM PERFILES 
		  		   WHERE cod_tiporol = $tipo_rol 
		  		   	 AND cod_tipdoc  = $tipo_doc
		  		   	 AND nro_doc     = $nro_doc ;"or die(mysql_error());

		 
	    $query = mysql_query($cMySQL);

		$resultado = mysql_num_rows($query);

		if ($resultado == 0){
			header('location: frmConsultarPerfil.php?nError=6');
		}


	   	while ($line = mysql_fetch_array($query)){
	   		$cod_tiporol	= $line['cod_tiporol'];
	        $nombres 		= $line['nombres'];
	        $apellidos 		= $line['apellidos'];
	        $fecha_nac 		= $line['fecha_nac'];
	        $cod_pais		= $line['cod_pais'];
	        $cod_prov		= $line['cod_prov'];
	        $cod_loc		= $line['cod_loc'];
	        $direccion 		= $line['direccion'];
	        $num_direccion	= $line['num_direccion'];
	        $sexo			= $line['sexo'];
	        $telefono_1		= $line['telefono_1'];
	        $telefono_2		= $line['telefono_2'];
	        $direccion_email= $line['direccion_email'];
	        $id_perfil		= $line['id_perfil'];
	    }


	    ?>
	    <form action='php/aplicarModificacionPerfil.php' method='POST'>
	    <!-- ID de Perfil -> para luego tomarlo en el UPDATE -->
	    
	   <input type="hidden" name="id_perfil" value=<?php echo $id_perfil ?>> 
	    
	    <!-- ============================= TIPO ROL ============================= -->
		

  		<label>Seleccionar tipo de rol</label>

    	<input id="adm" name="tipo_rol" type="radio" value="1" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 1) echo "checked"; ?> disabled /><label for="adm">Administrador</label>
		<input id="mon" name="tipo_rol" type="radio" value="2" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 2) echo "checked"; ?> disabled /><label for="mon">Monitoreador</label>
		<input id="cli" name="tipo_rol" type="radio" value="3" <?php if (isset($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == 3) echo "checked"; ?> disabled /><label for="cli">Cliente</label>

		<?php
		if ($nError == 1 && strpos($error_val,'tipo_rol')) {
			echo "$campo_obligatorio";
		}
	   	

	   	?>

	   	<br><br><label for='tipo_doc'>Tipo de Documento:</label>
		
		<?php
		if (isset($_POST['resultado_busqueda'])) {
		$formulario = new formulario;
		$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
		if ($nError == 1 && strpos($error_val,'tipo_doc')) {
					echo "$campo_obligatorio";
				}
	  	}
	  	else{

	  	$formulario = new formulario;
		$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','nuevo_tipo_doc');
		if ($nError == 1 && strpos($error_val,'nuevo_tipo_doc')) {
					echo "$campo_obligatorio";
				}
	  	}	

	  	?>	
	   	<!--============================= NUMERO DE DOCUMENTO ============================= -->
	   	<label for='nro_doc'> Número Documento:</label>
	   	<?php 
	   	if (isset($_POST['resultado_busqueda'])) {
	   		echo "<input type='text' id='nro_doc'name='nro_doc' value=  $nro_doc>";
	 	}
	 	else{	
	 		if (isset($_SESSION['nuevo_nro_doc'])){
	 			$nro_doc = $nuevo_nro_doc;
	 		}

	 		echo "<input type='text' id='nro_doc'name='nuevo_nro_doc' value= $nro_doc>";
	 		
	 	}
		if (isset($_POST['resultado_busqueda'])) {
			if (strpos($error_val,'nro_doc')){
				 	switch ($nError) {
				 		case 1: echo "$campo_obligatorio";
				 				break;
				 		case 2: echo "$solo_numeros";
				 				break;	
				 	}
				 }
				 
		}elseif(strpos($error_val,'nuevo_nro_doc')){
				 	switch ($nError) {
				 		case 1: echo "$campo_obligatorio";
				 				break;
				 		case 2: echo "$solo_numeros";
				 				break;	
				 	}
				 }	 
	   	// ============================= NOMBRE =============================
		?>
		<br><br>	
		<label for="nombres">Nombres: </label>
		<input type="text" name="nombres" id="nombres" value=<?php  $resultado = validar_var_session('nombres'); 
																 		if ($resultado == -1){ 
																 				echo $nombres;
																 			 }  ?>> 
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
		
	   <!-- ============================= APELLIDO ============================= -->
	   
	   <br><br>	
		<label for="apellidos">Apellidos: </label>
		<input type="text" name="apellidos" id="apellidos" value=<?php  $resultado = validar_var_session('apellidos'); 
																 		if ($resultado == -1){ 
																 				echo $apellidos;
																 			 }  ?>> 
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
		<!--============================= FECHA NACIMIENTO ============================= -->

		<br><br>
		<label for="fecha_nac">Fecha de nacimiento: </label>
		<input type="date" name="fecha_nac" id="fecha_nac" value=<?php  $resultado = validar_var_session('fecha_nac'); 
																 		if ($resultado == -1){ 
																 				echo $fecha_nac;
																 			 }  ?>> 
		<?php 
	    if ($nError == 1 && strpos($error_val,'fecha_nac')){
			echo "$campo_obligatorio";
		}
		?>
		
		<!-- ============================= PAIS ============================= -->
		
		<br>
	    <br>
		<label for='pais'>País: </label>

		<?php
		if (isset($_POST['resultado_busqueda'])) {
			$ObtenerTipodoc = new formulario;
			$ObtenerTipodoc-> ObtenerDatosBD ('cod_pais','descr_pais','PAISES','pais',$cod_pais);
		   	if ($nError == 1 && strpos($error_val,'pais')) {
				echo "$campo_obligatorio";
			}
		}

		else {

			$formulario = new formulario;
			$formulario->LlenarCombos('cod_pais','descr_pais','PAISES','pais');
			if ($nError == 1 && strpos($error_val,'pais')){
				echo "$campo_obligatorio";
			}
		}	

		?>		
	    <!-- ============================= PAIS ============================= -->
	    
	    <br><br>
	    <label for='prov'>Provincia: </label>
		<?php
		if (isset($_POST['resultado_busqueda'])) {
			$ObtenerTipodoc = new formulario;
			$ObtenerTipodoc-> ObtenerDatosBD ('cod_prov','descr_prov','PROVINCIAS','provincia',$cod_prov);
		   	if ($nError == 1 && strpos($error_val,'provincia')) {
				echo "$campo_obligatorio";
			}
		}
		else{
		    $formulario = new formulario;
			$formulario->LlenarCombos('cod_prov','descr_prov','PROVINCIAS','provincia');
		    if ($nError == 1 && strpos($error_val,'provincia')){
							echo "$campo_obligatorio";
						}
		}
		?>	

	    <!-- ============================= LOCALIDAD ============================= -->
	    <br><br>
		<label for='loc'>Localidad: </label>
		<?php
		if (isset($_POST['resultado_busqueda'])) {
			$ObtenerTipodoc = new formulario;
			$ObtenerTipodoc-> ObtenerDatosBD ('cod_loc','descr_loc','LOCALIDADES','localidad',$cod_loc);
		   	if ($nError == 1 && strpos($error_val,'localidad')) {
				echo "$campo_obligatorio";
			}
		}
		else{
		    $formulario = new formulario;
			$formulario->LlenarCombos('cod_loc','descr_loc','LOCALIDADES','localidad');
		    if ($nError == 1 && strpos($error_val,'localidad')) {
				echo "$campo_obligatorio";
			}
		}
		?>
	    <!-- ============================= DIRECCION ============================= -->
	    
	    <br><br>
		<label for='direccion'>Direccion:</label>
	    <input type='text' id='direccion' name='direccion' value=<?php  $resultado = validar_var_session('direccion'); 
																 		if ($resultado == -1){ 
																 			echo $direccion;
																 		}  ?>> 
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
	    <!-- ============================= DIRECCION ============================= -->

		<label for='num_direc'> Numero: </label>
		<input type='text' name='num_direc' id='num_direc' value=<?php  $resultado = validar_var_session('num_direc'); 
																 		if ($resultado == -1){ 
																 			echo $num_direccion;
																 		}  ?>> 
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
	    <!-- ============================= SEXO ============================= -->
	    <br><br>
	    <label>Sexo</label>
	    
	    <input id="fem" name="sexo" type="radio" value="F" <?php if ( (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'F') || $sexo=='F' )  echo "checked"; ?> /><label for="fem">Femenino</label>
		<input id="mas" name="sexo" type="radio" value="M" <?php if ( (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'M') || $sexo=='M' )  echo "checked"; ?> />	<label for="mas">Masculino</label>
	    
		<?php
		if ($nError == 1 && strpos($error_val,'sexo')){
						echo "$campo_obligatorio";
				}
		?>

		<!-- ============================= TELEFONO 1 ============================= -->
		<br><br><label for='telefono1'>Teléfono 1:</label>
		<input type='text' name='telefono1' id='telefono1' value=<?php  $resultado = validar_var_session('telefono1'); 
																 		if ($resultado == -1){ 
																 			echo $telefono_1;
																 		}  ?>> 

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
			 
		<!-- ============================= TELEFONO 2 ============================= -->

		<label for='telefono2'> Teléfono 2:</label>
		<input type='text' name='telefono2' id='telefono2' value=<?php  $resultado = validar_var_session('telefono2'); 
																 		if ($resultado == -1){ 
																 			echo $telefono_2;
																 		}  ?>> 
		<?php
		if (strpos($error_val,'telefono2')){
			 	switch ($nError) {
			 		case 2: echo "$solo_numeros";
			 				break;	
			 	}
			 }
		?>	 
		<!-- ============================= TELEFONO 2 ============================= -->
		<br><br><label for='email'>Dirección E-mail:</label>
		<input type='text' name='email' id='email' value=<?php  $resultado = validar_var_session('email'); 
														 		if ($resultado == -1){ 
														 			echo $direccion_email;
														 		}  ?>> 
 		
		   
		<br>
		<br>
		
		<a href="administrador.php">Volver</a>

		<input type="submit" value="Enviar"> 
		</form>
	</body>
</html>