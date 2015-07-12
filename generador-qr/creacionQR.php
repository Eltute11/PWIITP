<?php  
$cod = $_GET['cod'];
	include_once('qrlib.php');
	QRcode::png("Tu codigo de desbloqueo de alarma es: $cod"); // creates file 
?>