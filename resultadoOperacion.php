<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

include_once ("php/clases.php");
include_once ("php/funciones.php");

unset($_SESSION['noEliminarValores']);

$base = new BD;
$conexion = $base->Conectar();


if (isset($_SESSION['msjResultadoOperacion'])) {
				$msjResultadoOperacion = $_SESSION['msjResultadoOperacion'];
			}

if (isset($_SESSION['tituloResultado'])) {
	$tituloResultado = $_SESSION['tituloResultado'];
}	


if (isset($_GET['volverPagina'])){
	$volverPagina = $_GET['volverPagina'];
}


if (isset($_GET['errorOperacion'])){
	$errorOperacion = $_GET['errorOperacion'];
}
else{
	$errorOperacion = 0;
}


include_once('header.php');
include_once ('aside.php');
?>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3"><?php echo $tituloResultado; ?></h1>
	    </div>
   		<div class="panel-body">
			<div class='col-sm-7'>
			 	<?php  
				 	echo "<h4>$msjResultadoOperacion</h4>";
				 	
				 	if (isset($_SESSION['alta']['tipo_rol'])) {
				 		if ($_SESSION['alta']['tipo_rol'] !=3 && $errorOperacion == 0){
				 			echo "<div  style='padding-bottom: 15px;'><a class='btn btn-info'  href='administrador.php'>Volver</a></div>";
				 		}
				 	 elseif ($_SESSION['alta']['tipo_rol'] ==3 && $errorOperacion == 0){  // Esta validacion cotempla que sea tipo rol 1 o 2, y errorOperacion = 0 es decir que no tiene errores.Si no la pongo entra siempre cuando error es 1.
						echo "<h4>Ingresar productos del sistema.</h4>";
					 	echo "<div  style='padding-bottom: 15px;'><a class='btn btn-info'  href='productosInstalacionSistema.php'>Continuar</a></div>";
				 		}
				 	}
				 	
				 	if ( (isset($_SESSION['modificar']['tipo_rol']) || isset($_SESSION['baja']['tipo_rol']))  && $errorOperacion == 0 ){
							echo "<div  style='padding-bottom: 15px;'><a class='btn btn-info'  href='administrador.php'>Volver</a></div>";
				 	}

				 	
				 	if ($errorOperacion == 1){
				 		echo "<div class='col-sm-2' style='padding-bottom: 15px;'><a class='btn btn-primary' href='$volverPagina.php'>Volver</a></div>";
				 	} 

				 ?>
			</div>
		</div>	
	</div>
</div>	
<?php include_once('footer.php') ?>


