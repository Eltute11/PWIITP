<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
	
}


include_once('clases.php');
$base = new BD;
$conexion = $base->Conectar();

$id_cliente  = $_GET['id_cliente'];
$cambiar_estado_alarma = $_GET['cambiar_estado'];
$tipo_rol = $_GET['tipo_rol'];




$query  = "UPDATE ALARMA_CLIENTE
		   SET estado = '$cambiar_estado_alarma'
		   WHERE id_cliente = $id_cliente"or die(mysql_error());

mysql_query($query);

if ($tipo_rol==2) {
	header("location: ../monitoreo_camaras.php");
}
if ($tipo_rol==3) {
	header("location: ../dispararAlarmaCliente.php");
}
?>
