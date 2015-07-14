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

$query = "	SELECT cod_alarma
			FROM ALARMA_CLIENTE
			WHERE id_cliente = $id_cliente" or die(mysql_error());

$result = mysql_query($query);

while($line = mysql_fetch_array($result)) {
		$cod_alarma = $line['cod_alarma']; 

}
$hoy = date("Y-m-d H:i:s");
if ($cambiar_estado_alarma == 'M' || $cambiar_estado_alarma == 'C') {
	$query = "	INSERT INTO HIST_ALARMA_CLIENTE (cod_alarma,id_cliente,fecha_hora,real_falsa) 
				VALUES ($cod_alarma, $id_cliente, '$hoy', 'R')" or die(mysql_error());

	mysql_query($query);
}

if ($tipo_rol==2) {
	header("location: ../monitoreo_camaras.php");
}
if ($tipo_rol==3) {
	header("location: ../dispararAlarmaCliente.php");
}
?>
