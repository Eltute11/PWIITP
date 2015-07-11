<?php 
session_start();
//session_destroy();
	if(!isset($_SESSION['usuario'])){
		session_destroy();
		header('location: index.php?nError=10');
		
	}

unset($_SESSION['alta']);
unset($_SESSION['baja']);

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
		case 1: $campo_obligatorio = "<span class='help-block m-b-none' style='color: red;'> *Campo obligatorio </span>";
				break;
		case 2: $solo_numeros =  "<span class='help-block m-b-none' style='color: red;'> *Solo numeros</span>";		
				break;		
		case 3: $solo_letras =  "<span class='help-block m-b-none' style='color: red;'> *Solo letras</span>";		
				break;	
		case 6: $perfil_existente =  "<span style='color: red;'> <h3>Ya existe perfil con el mismo numero y tipo de documento</h3></span>";		
		break;					
	}
}
else{
	$nError = 0;
	
}
 

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
				$_SESSION['modificar']['tipo_rol']=$_POST['tipo_rol'];
		}

		if (isset($_POST['tipo_doc'])){
				$_SESSION['modificar']['tipo_doc']=$_POST['tipo_doc'];
		}

		if (isset($_POST['nro_doc'])){
				$_SESSION['modificar']['nro_doc']=$_POST['nro_doc'];
		}
	
		if (isset($_POST['valido_perfil'])){		
			$val = new validacion;
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['tipo_rol'],'tipo_rol',0);
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['tipo_doc'],'tipo_doc',0);
			$val->val_campo_obligatorio('frmConsultarPerfil.php',$_POST['nro_doc'], 'nro_doc',1);
		}
		if (isset($_SESSION['modificar']['tipo_doc'])){
			$tipo_doc = $_SESSION['modificar']['tipo_doc'];	
		}	

		if (isset($_SESSION['modificar']['nro_doc'])){
			$nro_doc = $_SESSION['modificar']['nro_doc'];	
		}	

		if (isset($_SESSION['modificar']['tipo_rol'])){
			$tipo_rol = $_SESSION['modificar']['tipo_rol'];	
		}	

		if (isset($_SESSION['modificar']['nuevo_nro_doc'])) {
			$nuevo_nro_doc = $_SESSION['modificar']['nuevo_nro_doc'];
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

		// VALIDO SI EL CLIENTE EXISTE; SI NO EXISTE ENVIO ERROR 7.
		if ($resultado == 0){
			header('location: frmConsultarPerfil.php?nError=7');
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
<!-- Main -->
<?php 
include_once('header.php');
include_once ('aside.php'); 
?>
<div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	<!-- Titulo -->
		<div class="bg-light lter b-b wrapper-md">
		  	<h1 class="m-n font-thin h3">Modificación perfil <small> Datos del usuario a modificar</small></h1>
		</div>
		<div class="wrapper-md" ng-cotroller="FormDemoCtrl">		
			<div class="panel panel-default">
			<!-- Formulario -->
				<div class="panel-body">
	   				 <form action='php/aplicarModificacionPerfil.php' class='form-horizontal' method='POST'>
	    			<!-- ID de Perfil -> para luego tomarlo en el UPDATE -->
	    
	  				 <input type="hidden" name="id_perfil" value=<?php echo $id_perfil ?>> 
	    
	    			<!-- ============================= TIPO ROL ============================= -->
  					<div class="form-group">
					    <label class="col-sm-2 control-label">Tipo de rol:</label>
					    <div class="col-sm-10 radio">
					        <label class="i-checks i-checks-sm" for="adm">
					       	<input id="adm" name="tipo_rol" type="radio" value="1" <?php if (isset($_SESSION['modificar']["tipo_rol"]) && $_SESSION['modificar']["tipo_rol"] == 1) echo "checked"; ?>>
					       	<i></i>Administrador
					        </label>
					        <label class="i-checks i-checks-sm" for="mon">
					       	<input id="mon" name="tipo_rol" type="radio" value="2" <?php if (isset($_SESSION['modificar']["tipo_rol"]) && $_SESSION['modificar']["tipo_rol"] == 2) echo "checked"; ?>>
					      	<i></i>Monitoreador
					        </label>
					        <label class="i-checks i-checks-sm" for="cli">
					      	<input id="cli" name="tipo_rol" type="radio" value="3" <?php if (isset($_SESSION['modificar']["tipo_rol"]) && $_SESSION['modificar']["tipo_rol"] == 3) echo "checked"; ?>>
					       	<i></i>Cliente
					        </label>
							<?php 
								if ($nError == 1 && strpos($error_val,'tipo_rol')) {
								echo "$campo_obligatorio";
								}
							?>			 
						 </div>
					 </div>
					<!-- ============================= TIPO DOC ============================= -->
	   	<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="tipo_doc">Tipo de Documento:</label>
					<div class="col-sm-10">
						<?php
						if (isset($_POST['resultado_busqueda'])) {
						$formulario = new formulario;
						$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc','modificar');
							if ($nError == 1 && strpos($error_val,'tipo_doc')) {
										echo "$campo_obligatorio";
							}
					  	}
					  	else{
					  	$formulario = new formulario;
						$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','nuevo_tipo_doc','modificar');
						if ($nError == 1 && strpos($error_val,'nuevo_tipo_doc')) {
									echo "$campo_obligatorio";
								}
					  	}	
					  	?>	
					 </div>
			 </div>

	   	<!--============================= NUMERO DE DOCUMENTO ============================= -->
	   <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label for="nro_doc" class="col-sm-2 control-label">Número Documento:</label>
					<div class="col-sm-10">
					   	<?php 
					   	if (isset($_POST['resultado_busqueda'])) {
					   		echo "<input type='text' id='nro_doc'name='nro_doc' class='form-control' value=$nro_doc>";
					 	}
					 	else{	
					 		if (isset($_SESSION['modificar']['nuevo_nro_doc'])){
					 			$nro_doc = $nuevo_nro_doc;
					 		}

					 		echo "<input type='text' id='nro_doc' name='nuevo_nro_doc' class='form-control' value= $nro_doc>";
					 		
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
								 ?>
				 	 </div>
			 </div>
	   	<!-- ============================= NOMBRE ============================= -->

		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="nombres">Nombres:</label>
				<div class="col-sm-10">
					<input type="text" name="nombres" class='form-control' id="nombres" value=<?php  $resultado = validar_var_session('modificar','nombres'); 
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
				 </div>
			 </div>
		
	   <!-- ============================= APELLIDO ============================= -->
	   
	   <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="apellidos">Apellido:</label>
				<div class="col-sm-10">
					<input type="text" name="apellidos"  class='form-control' id="apellidos" value=<?php  $resultado = validar_var_session('modificar','apellidos'); 
						if ($resultado == -1){ 
							echo $apellidos;
						}?>> 
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
				 </div>
			 </div>
		<!--============================= FECHA NACIMIENTO ============================= -->

		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="fecha_nac">Fecha de nacimiento:</label>
				<div class="col-sm-10">
					<input type="date" name="fecha_nac" class='form-control' id="fecha_nac" value=<?php  $resultado = validar_var_session('modificar','fecha_nac'); 
					if ($resultado == -1){ 
						echo $fecha_nac;
					}  ?>> 
					<?php 
				    if ($nError == 1 && strpos($error_val,'fecha_nac')){
						echo "$campo_obligatorio";
					}
					?>
				 </div>
			 </div>
		
		<!-- ============================= PAIS ============================= -->
		
		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="pais">Pais:</label>
				<div class="col-sm-10">
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
						$formulario->LlenarCombos('cod_pais','descr_pais','PAISES','pais','modificar');
						if ($nError == 1 && strpos($error_val,'pais')){
							echo "$campo_obligatorio";
						}
					}	

					?>
			 	 </div>
			 </div>		

	    <!-- ============================= PROVINCIA ============================= -->
	    
	    <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="prov">Provincia:</label>
				<div class="col-sm-10">
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
						$formulario->LlenarCombos('cod_prov','descr_prov','PROVINCIAS','provincia','modificar');
					    if ($nError == 1 && strpos($error_val,'provincia')){
										echo "$campo_obligatorio";
									}
					}
					?>
				 </div>	
			 </div>	

	    <!-- ============================= LOCALIDAD ============================= -->
	    <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="loc">Localidad:</label>
				<div class="col-sm-10">
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
						$formulario->LlenarCombos('cod_loc','descr_loc','LOCALIDADES','localidad','modificar');
					    if ($nError == 1 && strpos($error_val,'localidad')) {
							echo "$campo_obligatorio";
						}
					}
					?>
				 </div>
			 </div>

	    <!-- ============================= DIRECCION ============================= -->
	    <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="direccion">Direccion:</label>
				<div class="col-sm-10">
				    <input type='text' id='direccion' class='form-control' name='direccion' value=<?php  $resultado = validar_var_session('modificar','direccion'); 
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
				 </div>
			 </div>

	    <!-- ============================= NUM DIRECCION ============================= -->
		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="num_direc">Altura:</label>
				<div class="col-sm-10">
					<input type='text' name='num_direc' class='form-control' id='num_direc' value=<?php  $resultado = validar_var_session('modificar','num_direc'); 
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
				 </div>
			 </div>

	    <!-- ============================= SEXO ============================= -->
	    <div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="sexo">Sexo:</label>
				<div class="col-sm-10 radio">
					<label class="i-checks i-checks-sm" for="sexo">
				    <input id="fem" name="sexo" type="radio" value="F" <?php if ( (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'F') || $sexo=='F' )  echo "checked"; ?> />
					<i></i>Femenino
					</label>
					<label class="i-checks i-checks-sm" for="sexo">
					<input id="mas" name="sexo" type="radio" value="M" <?php if ( (isset($_SESSION["sexo"]) && $_SESSION["sexo"] == 'M') || $sexo=='M' )  echo "checked"; ?> />
					<i></i>Masculino
					</label>
					<?php
					if ($nError == 1 && strpos($error_val,'sexo')){
									echo "$campo_obligatorio";
							}
					?>
			 	 </div>
			 </div>

		<!-- ============================= TELEFONO 1 ============================= -->
		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="telefono1">Telefono 1:</label>
				<div class="col-sm-10">
					<input type='text' name='telefono1' class='form-control' id='telefono1' value=<?php  $resultado = validar_var_session('modificar','telefono1'); 
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
				 </div>
			 </div>
			 
		<!-- ============================= TELEFONO 2 ============================= -->

		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="telefono2">Telefono 2:</label>
				<div class="col-sm-10">
					<input type='text' name='telefono2' class='form-control' id='telefono2' value=<?php  $resultado = validar_var_session('modificar','telefono2'); 
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
				 </div>
			 </div>	 

		<!-- ============================= EMAIL ============================= -->
		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="email">Direccion E-mail:</label>
				<div class="col-sm-10">
					<input type='text' name='email' class='form-control' id='email' value=<?php  $resultado = validar_var_session('modificar','email'); 
					if ($resultado == -1){ 
					echo $direccion_email;
					}  
					?>> 
				 </div>
			 </div>
 		
 		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<input type="submit" class="btn btn-info" value="Enviar"> 
		 		</div>
			</div>
		
		</form>
	</div>
</div>
</div>
<div class="col-sm-2" style="padding-bottom: 15px;"><a class="btn btn-primary" href="frmConsultarPerfil.php">Volver</a></div>
</div>
</div>
<!-- / content -->

<?php include'footer.php' ?>