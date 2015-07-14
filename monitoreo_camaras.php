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

if(isset($_GET['filtro'])){
	$query = "	SELECT A.id_perfil, B.id_camara, CONCAT(nombres,' ' , apellidos) as 'Nom_Apel' ,
					   C.estado	 
				FROM PERFILES A
				INNER JOIN CAMARAS B ON B.id_cliente = A.id_perfil
				INNER JOIN ALARMA_CLIENTE C ON C.id_cliente = A.id_perfil 
				WHERE A.id_perfil = $_GET[filtro]" or die(mysql_error());
}else{
	$query = "	SELECT A.id_perfil, B.id_camara, CONCAT(nombres,' ' , apellidos) as 'Nom_Apel' ,
					   C.estado
				FROM PERFILES A
				INNER JOIN ALARMA_CLIENTE C ON C.id_cliente = A.id_perfil 
				INNER JOIN CAMARAS B ON B.id_cliente = A.id_perfil" or die(mysql_error());
}

$result= mysql_query($query) or die(mysql_error());

include_once('header.php');
include_once ('aside_monitoreador.php');
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
   								<th style="width: 100px;">Nº</th>
   								<th style="width: 200px;">ID Camara</th>
   								<th style="width: 200px;"></th>
   								<th>Cliente</th>
   								<th>Estado Alarma</th>
   								<th>Cambiar estado</th>		
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   								$tabla = '';
								while($row = mysql_fetch_array($result)){
									
									switch ($row['estado']) {
										case 'E': $estado = 'En reposo';
												  $cambiar_estado = "<a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=A&tipo_rol=2&id_cliente=$row[id_perfil]' style='background-color: rgb(101, 186, 74);border-color: rgb(101, 186, 74);'>ACTIVAR</a>";
												  break;
										case 'A': $estado = 'Alarmada';
												  $cambiar_estado = "<a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=2&id_cliente=$row[id_perfil]' style='background-color: rgb(188, 188, 188);border-color: rgb(188, 188, 188);'>DESACTIVAR</a>
												  					 <a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=M&tipo_rol=2&id_cliente=$row[id_perfil]' style='background-color: rgb(229, 219, 33);border-color: rgb(229, 219, 33);'>DISPARAR</a>";		
												  break;	
										case 'C': $estado = 'Activada - Cliente';
												  $cambiar_estado = "<a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=2&id_cliente=$row[id_perfil]' style='background-color: rgb(188, 188, 188);border-color: rgb(188, 188, 188);'>DESACTIVAR</a>";	 
												  break;	
										case 'M': $estado = 'Activada - Monitoreador';
												  $cambiar_estado = "<a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=2&id_cliente=$row[id_perfil]' style='background-color: rgb(188, 188, 188);border-color: rgb(188, 188, 188);'>DESACTIVAR</a>";
												  break;	
									}

									$tabla = $tabla."	<tr>
									<td>$row[id_perfil]</td>
									<td>$row[id_camara]</td>
									<td> <a class='btn btn-info' href='http://webcam.hotelbibionepalace.it/mjpg/video.mjpg' data-lightbox='Mi ipCam 1' data-title='Mi ipCam 1'>VER</a> 
									</td>
									<td>$row[Nom_Apel]</td>
								    <td>$estado</td>
								    <td>$cambiar_estado</td>

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