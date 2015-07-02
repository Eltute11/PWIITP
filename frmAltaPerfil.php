<?php 
session_start();
// session_destroy();
		if(!isset($_SESSION['usuario'])){
			session_destroy();
			header('location: index.php?error=loguearse');
			
		}

unset($_SESSION['baja']);
unset($_SESSION['consultar']);
unset($_SESSION['modificacion']);

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
		case 4: $usuario_existente = "<span style='color: red;'> *El usuario ya existe </span>";	
				break;
		case 3: $solo_letras =  "<span class='help-block m-b-none' style='color: red;'> *Solo letras</span>";		
				break;	
		case 6: $perfil_existente =  "<span style='color: red;'> <h3>El perfil que esta intentando dar de alta ya existe </h3></span>";		
				break;
		case 8: $pass_error =  "<span style='color: red;'>*Las contraseñas no coinciden</span>";		
				break;		
	}
}
else{
	$nError = 0;
}
	
include_once('header.php');
include_once ('aside.php');

?>
<!-- Main -->
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<!-- Titulo -->
	   	<div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Alta de perfil</h1>
		</div>

		<div class="wrapper-md" ng-cotroller="FormDemoCtrl">		
		       		<div class="panel panel-default">
		       			<!-- Formulario -->
		       			<div class="panel-body">
		       				<form action="php/aplicarAltaPerfil.php" class="form-horizontal" id="alta" name="alta" method="POST">
								<?php 
							 	 if ($nError == 6) {
							 	 	echo $perfil_existente;
							 	 	echo "<br>";
							 	 }
							 	?>
							 	<div class="form-group">
						          <label class="col-sm-2 control-label">Tipo de alta:</label>
						          <div class="col-sm-10 radio">
						            <label class="i-checks i-checks-sm" for="adm">
						            	<input id="adm" name="tipo_rol" type="radio" value="1" <?php if (isset($_SESSION['alta']["tipo_rol"]) && $_SESSION['alta']["tipo_rol"] == 1) echo "checked"; ?>>
						            	<i></i>Administrador
						            </label>
						            <label class="i-checks i-checks-sm" for="mon">
						            	<input id="mon" name="tipo_rol" type="radio" value="2" <?php if (isset($_SESSION['alta']["tipo_rol"]) && $_SESSION['alta']["tipo_rol"] == 2) echo "checked"; ?>>
						            	<i></i>Monitoreador
						            </label>
						            <label class="i-checks i-checks-sm" for="cli">
						            	<input id="cli" name="tipo_rol" type="radio" value="3" <?php if (isset($_SESSION['alta']["tipo_rol"]) && $_SESSION['alta']["tipo_rol"] == 3) echo "checked"; ?>>
						            	<i></i>Cliente
						            </label>
												
										<?php 
											if ($nError == 1 && strpos($error_val,'tipo_rol')) {
												echo "$campo_obligatorio";
											}
										?>
												 
						           </div>
						     </div>
								 
								 <div class="line line-dashed b-b line-lg pull-in"></div>
								 <div class="form-group">
						      		<label class="col-sm-2 control-label" for="tipo_doc">Tipo de Documento: </label>
										<div class="col-sm-10">
											<?php 
												$formulario = new formulario;
												$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc','alta');
											    if ($nError == 1 && strpos($error_val,'tipo_doc')) {
													echo "$campo_obligatorio";
												}
											?>
										 </div>	
									</div>
									
									<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label for="nro_doc" class="col-sm-2 control-label">Número Documento:</label>
											<div class="col-sm-10">
												<input type="text" id="nro_doc" name="nro_doc" class='form-control' value=<?php validar_var_session('alta','nro_doc') ?>>
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
											 </div>
									 </div>

									<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="nombres">Nombres:</label>
											<div class="col-sm-10">
												<input type="text" name="nombres" id="nombres" class='form-control' value=<?php validar_var_session('alta','nombres') ?>> 
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
					
									<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="apellidos">Apellidos:</label>
											<div class="col-sm-10">
												<input type="text" name="apellidos" id="apellidos" class='form-control' value=<?php validar_var_session('alta','apellidos') ?>> 
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
							
									<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="fecha_nac">Fecha de nacimiento:</label>
											<div class="col-sm-10"> 
												<input id="fecha_nac" name="fecha_nac" class='form-control' type="date" value=<?php validar_var_session('alta','fecha_nac') ?> >
											    <?php 
													if ($nError == 1 && strpos($error_val,'fecha_nac')){
														echo "$campo_obligatorio";
													}
												?>
												</div>
									 </div>

							  <div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="pais">País:</label>
											<div class="col-sm-10">   
												<?php 
													$formulario = new formulario;
													$formulario->LlenarCombos('cod_pais','descr_pais','PAISES','pais','alta');
											     
											    	if ($nError == 1 && strpos($error_val,'pais')){
														echo "$campo_obligatorio";
													}
												?>
							     		 </div>
									 </div>

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for='provincia'>Provincia:</label>
											<div class="col-sm-10"> 
											    <?php 
													$formulario = new formulario;
													$formulario->LlenarCombos('cod_prov','descr_prov','PROVINCIAS','provincia','alta');
										     		
										     		if ($nError == 1 && strpos($error_val,'pais')){
															echo "$campo_obligatorio";
														}
												?>
							    			</div>
									 </div>

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for='localidad'>Localidad:</label>
											<div class="col-sm-10"> 
											    <?php 
											    	$formulario = new formulario;
											    	$formulario->LlenarCombos('cod_loc','descr_loc','LOCALIDADES','localidad','alta');
											    
													if ($nError == 1 && strpos($error_val,'localidad')) {
															echo "$campo_obligatorio";
														}
												?>
												</div>
									 </div>

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" <label for="direccion">Dirección: </label>
											<div class="col-sm-10">
												<input class='form-control' type="text" name="direccion" id="direccion" value=<?php validar_var_session('alta','direccion') ?>>
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

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="num_direc">Numero:</label>
											<div class="col-sm-10">
												<input class='form-control' type="text" name="num_direc" id="num_direc" value=<?php validar_var_session('alta','num_direc') ?>>
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
								
								<div class="line line-dashed b-b line-lg pull-in"></div>
								<div class="form-group">
						      <label class="col-sm-2 control-label">Sexo:</label>
						      <div class="col-sm-10 radio">
						      	<label for="fem" class="i-checks i-checks-sm">
										<input id="fem" name="sexo" type="radio" value="F" <?php if (isset($_SESSION['alta']["sexo"]) && $_SESSION['alta']["sexo"] == 'F') echo "checked"; ?> />
										<i></i>Femenino </label>
										<label for="mas" class="i-checks i-checks-sm">
										<input id="mas" name="sexo" type="radio" value="M" <?php if (isset($_SESSION['alta']["sexo"]) && $_SESSION['alta']["sexo"] == 'M') echo "checked"; ?>/>
										<i></i>Masculino</label>
										<?php 
										if ($nError == 1 && strpos($error_val,'sexo')){
												echo "$campo_obligatorio";
										}
										?>
								   </div>
								 </div>

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" label for="telefono1">Teléfono 1:</label>
											<div class="col-sm-10">
												<input class='form-control' type="text" name="telefono1" id="telefono1" value=<?php validar_var_session('alta','telefono1') ?>>
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
								
								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" label for="telefono2">Teléfono 2:</label>
											<div class="col-sm-10">
												<input class='form-control' type="text" name="telefono2" id="telefono2" value=<?php validar_var_session('alta','telefono2') ?>>
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

								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="email">Dirección E-mail:</label>
											<div class="col-sm-10">
												<input class='form-control' type="text" name="email" id="email" value=<?php validar_var_session('alta','email') ?>>
											</div>
									 </div>

								 <!-- =====================  ALTA USUARIO	================================== -->
								<div id="usuario">
								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" label for="newUser">Usuario:</label>
											<div class="col-sm-10">
											    <input type="text" class='form-control' id="newUser" name="newUser" value=<?php validar_var_session('alta','newUser') ?>> 
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
										     </div>
									 </div>
					
								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" label for="pass">Contraseña:</label>
											<div class="col-sm-10">
											    <input type="password" id="pass" class='form-control' name="pass1" value=<?php validar_var_session('alta','pass1') ?>>
											     <?php 
											    	if ($nError == 1 && strpos($error_val,'pass1')) {
														echo "$campo_obligatorio";
													}
											     ?>
											     </div>
									 </div>
									
								<div class="line line-dashed b-b line-lg pull-in"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label" label for="pass2">Confirmar Contraseña:</label>
											<div class="col-sm-10">
												<input type="password" id="pass2" class='form-control' name="pass2" value=<?php validar_var_session('alta','pass2') ?>>
											    <?php 
												    if (strpos($error_val,'newUser') || $nError == 7 ){
													 	switch ($nError) {
													 		case 1: echo "$campo_obligatorio";
													 				break;
													 		case 7: echo "$pass_error";
													 				break;	
													 	}
													 }
										    	?>
												</div>
									 </div>
									</div> <!-- Usuario -->


								<div class="line line-dashed b-b line-lg pull-in"></div>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<input type="submit" value="Enviar" class="btn btn-info">
										<input id="resetButton" name="reset" type="reset" class="btn btn-default">
									</div>
								</div>
								
							 </form>
		       			</div>
		       		</div>
		</div>
       	


		<!-- <div class="col-sm-2" style="padding-bottom: 15px;"><a class="btn btn-primary" href="profile.php">Volver</a></div> -->
		<div class="col-sm-2" style="padding-bottom: 15px;"><a class="btn btn-primary" href="administrador.php">Volver</a></div>
		
	</div>
</div>
<!-- / content -->

<?php include'footer.php' ?>
