<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

include_once ('php/clases.php');
include_once ('php/funciones.php');
include_once('header.php');
include_once ('aside_cliente.php');

$base = new BD;
$conexion = $base->Conectar();


$id_cliente  = $_SESSION['cliente']['id'];

$query  = "SELECT estado 
		   FROM PERFILES A 
		   INNER JOIN ALARMA_CLIENTE B ON A.id_perfil = B.id_cliente
		   WHERE A.id_perfil = $id_cliente";

$result = mysql_query($query);

while($line = mysql_fetch_array($result)) {
		$estado_alarma = $line['estado']; 

}

?>
<div id='content' class='app-content' role='main'>
    <div class='app-content-body '>
	    <div class='bg-light lter b-b wrapper-md'>
	  		<h1 class='m-n font-thin h3'> Disparar alarma</h1>
	    </div>
   		<div class='panel-body'>
			<div class='col-sm-7'>
			 	
				
			 	<?php
			 		switch ($estado_alarma){
			 			case 'E': echo "<h3>Estado actual: En Reposo</h3><br><a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=A&tipo_rol=3&id_cliente=$id_cliente' style='background-color: rgb(101, 186, 74);border-color: rgb(101, 186, 74);'>ACTIVAR</a>";
			 					  break;
			 			case 'A': echo "<h3>Estado actual: Alarmada</h3><br><a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=3&id_cliente=$id_cliente' style='background-color: rgb(188, 188, 188);border-color: rgb(188, 188, 188);'>DESACTIVAR</a>";
			 					  echo "<br><br><a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=C&tipo_rol=3&id_cliente=$id_cliente' style='background-color: rgb(224, 46, 30);border-color: rgb(224, 46, 30);'>DISPARAR</a>";
			 					  break;
			 			case 'C': echo "<h3>Estado actual: Activada - Cliente</h3><br><a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=3&id_cliente=$id_cliente' style='background-color: rgb(47, 184, 47);border-color: rgb(47, 184, 47);'>DESACTIVAR</a>";
			 					  break;
			 			case 'M': echo "<h3>Estado actual: Activada - Monitoreador</h3><br><a class='btn btn-info' href='php/cambiarEstadoAlarmaCliente.php?cambiar_estado=E&tipo_rol=3&id_cliente=$id_cliente' style='background-color: rgb(47, 184, 47);border-color: rgb(47, 184, 47);'>DESACTIVAR</a>";
		 					  	  break;		  		  
				    }

				   
				?>
				
			</div>
		</div>	
	</div>
</div>	
<?php include_once('footer.php') ?>