<?php 
session_start();
//session_destroy();
// if(!isset($_SESSION['usuario'])){
// 	session_destroy();
// 	header('location: index.php?nError=10');		
// }

include_once ("php/clases.php");
// CONEXION A BASE DE DATOS
$base = new BD;
$conexion = $base->Conectar();

$id_cliente = $_SESSION['cliente']['id'];


$query = "	SELECT B.id_camara
			FROM PERFILES A
			INNER JOIN CAMARAS B ON B.id_cliente = A.id_perfil
			WHERE A.id_perfil = $id_cliente" or die(mysql_error());


$result= mysql_query($query) or die(mysql_error());


include_once('header.php');
include_once ('aside_cliente.php');


?>
<head>
	<link rel="stylesheet" href="css/lightbox.css">
</head>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Monitoreo de Camaras</h1>
	    </div>
   		<div class="wrapper-md">
   			<div class="panel panel-default">
   				<div class="panel-heading">
   					Todas los registros
   				</div>
   				<div class="panel-body b-b b-light">
			    	<form class="col-sm-5" action="monitoreo_camaras.php" method="GET">
			    		Filtrar por ID de cliente: <input id="filter" type="text" name="filtro" class="form-control input-sm w-sm inline m-r">
			    	</form>
			    	<a href="monitoreo_camaras.php" class="col-sm-3"><button class="btn btn-sm btn-default">Restablecer</button></a>
			    </div>
   				<div class="table-responsive">
   					<table class="table table-striped b-t b-ligth">
   						<thead>
   							<tr style="background-color: #f7f7f7;">
   								<th style="width: 200px;">ID Camara</th>
   								<th style="width: 200px;"></th>
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   								$tabla = '';
								while($row = mysql_fetch_array($result)){
									
									$tabla = $tabla."	<tr>
															<td>$row[id_camara]</td>
															<td> <a class='btn btn-info' href='http://webcam.hotelbibionepalace.it/mjpg/video.mjpg' data-lightbox='Mi ipCam 1' data-title='Mi ipCam 1'>VER</a> 
														</tr>";
								}
								echo $tabla;	
							?>
   						</tbody>
   					</table>
   				</div>
   			</div>
   		</div>
	</div>
</div>	
<script src="js/lightbox-plus-jquery.min.js"></script>
<?php include_once('footer.php') ?>