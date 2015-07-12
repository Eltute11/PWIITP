<?php 
session_start();
include ("../php/clases.php");
// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();


$id_cliente = $_SESSION['cliente']['id'];
$cod = $_POST['nvo_cod'];

$query = "	UPDATE alarma_cliente
			SET cod_desbloqueo = md5($cod)
			WHERE id_cliente = $id_cliente;" or die(mysql_error());

mysql_query($query); 
header('location: ../codDesbloqueoQR.php');


 ?>