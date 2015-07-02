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
		case 1: $campo_obligatorio = "<span class='help-block m-b-none' style='color: red;'> *Campo obligatorio </span>";
				break;
		case 2: $solo_numeros =  "<span class='help-block m-b-none' style='color: red;'> *Solo numeros</span>";		
				break;		
		case 3: $solo_letras =  "<span class='help-block m-b-none' style='color: red;'> *Solo letras</span>";		
				break;	
		case 7: $perfil_inexistente =  "<span style='color: red;'> <h3>Perfil inexistente</h3></span>";		
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
	  		<h1 class="m-n font-thin h3">Modificacion de perfil</h1>
		</div>
		<div class="wrapper-md" ng-cotroller="FormDemoCtrl">		
		    <div class="panel panel-default">
		    <!-- Formulario -->
		    <div class="panel-body">
			<form action='frmModificacionPerfil.php' class="form-horizontal" method='POST'>
		 	<?php 
		 	 if ($nError == 7) {
		 	 	echo $perfil_inexistente;
		 	 	echo "<br>";
		 	 }
		 	?>

 			<div class="form-group">
	          <label class="col-sm-2 control-label">Tipo de alta:</label>
	          <div class="col-sm-10 radio">
	            <label class="i-checks i-checks-sm" for="adm">
	            	<input id="adm" name="tipo_rol" type="radio" value="1" <?php if (isset($_SESSION['consultar']["tipo_rol"]) && $_SESSION['consultar']["tipo_rol"] == 1) echo "checked"; ?>>
	            	<i></i>Administrador
	            </label>
	            <label class="i-checks i-checks-sm" for="mon">
	            	<input id="mon" name="tipo_rol" type="radio" value="2" <?php if (isset($_SESSION['consultar']["tipo_rol"]) && $_SESSION['consultar']["tipo_rol"] == 2) echo "checked"; ?>>
	            	<i></i>Monitoreador
	            </label>
	            <label class="i-checks i-checks-sm" for="cli">
	            	<input id="cli" name="tipo_rol" type="radio" value="3" <?php if (isset($_SESSION['consultar']["tipo_rol"]) && $_SESSION['consultar']["tipo_rol"] == 3) echo "checked"; ?>>
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
					<label class="col-sm-2 control-label" for="tipo_doc">Tipo de Documento:</label>
						<div class="col-sm-10">
								<?php 
									$formulario = new formulario;
									$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc','consultar');
								 
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
							<input type="text" id="nro_doc"name="nro_doc" class='form-control' value=<?php validar_var_session('consultar','nro_doc') ?>>
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


		<input type="hidden" name="valido_perfil" value="1"> 

		<input type="hidden" name="resultado_busqueda" value="1"> 
		
		<div class="line line-dashed b-b line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<input type="submit" value="Consultar datos" class="btn btn-info">
					<a class="btn btn-default" href="administrador.php">Volver</a>
		 		 </div>
			</div>

		
		</form>

		</div>
		</div>
		</div>
 	 </div>
 </div>

<?php include'footer.php' ?>