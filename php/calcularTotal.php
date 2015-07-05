<?php 
session_start();

include_once ("clases.php");
$base = new BD;
$conexion = $base->Conectar();

$sQuery="select * from PRODUCTOS_SISTEMA";
$result= mysql_query($sQuery) or die(mysql_error());
if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

$total = 0; 
while($row=mysql_fetch_array($result)){	
	$total = $total + ($row['precio'] * $_POST[$row['cod_prod']]);  // El name cantidad ingresa el es codigo de producto.
}	

echo "$total";

?>