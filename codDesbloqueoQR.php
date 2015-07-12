<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }
$id_cliente = $_SESSION['cliente']['id'];

include ("./php/clases.php");
// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();


$query = "	SELECT cod_desbloqueo
			FROM alarma_cliente
			WHERE id_cliente = $id_cliente";
//exit($query);
$result = mysql_query($query);

while($line = mysql_fetch_array($result)) {
	    $_SESSION['QR']['cod_des'] = $line[0];
	}

$cod =  $_SESSION['QR']['cod_des'];

include_once('header.php');
include_once ('aside_cliente.php');

?>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3"> Codigo desbloqueo QR</h1>
	    </div>
   		<div class="wrapper-md" ng-cotroller="FormDemoCtrl">		
		    <div class="panel panel-default">
		    <!-- Formulario -->
			    <div class="panel-body">
					<form action='generador-qr/modificarQR.php' class="form" method='POST'>
						<div class="form-group">
							<div class="col-sm-4">
								<p>Su codigo de desbloqueo es: </p>
							</div>
							<div class="col-sm-6">
								<?php echo '<img src="generador-qr/creacionQR.php?cod='.$cod.'"/>'; 
									//include_once("generador-qr/creacionQR.php");
								?>
							</div>
						 	
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label" for="cod">Ingrese su nuevo codigo de desbloqueo</label>
									<input type="text" class="col-sm-6 form-control" name="nvo_cod" id="cod" placeholder="Nuevo codigo de desbloqueo">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="submit" value="Modificar" class="btn btn-info">
						 		 </div>
						 	</div>

					 </form>
				 </div>
			 </div>
		 </div>
			
	</div>
</div>	
<?php include_once('footer.php') ?>