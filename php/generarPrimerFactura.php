<?php 
session_start();

include_once('clases.php');

$base = new BD;
$conexion = $base->Conectar();

$id_perfil = $_SESSION['alta']['id_perfil']; // Obtengo de aplicarAltaPerfil.php
$totalFactura = $_SESSION['producto']['totalFactura'];
$cant_total_sen_presencia = $_SESSION['producto']['cod_prod_5']; // Obtengo de calcularTotal.php
$cant_total_sen_apertura = $_SESSION['producto']['cod_prod_6']; // Obtengo de calcularTotal.php


//  POR MAS QUE SEA AUTONUMERICO EL CODIGO DE ALARMA, OBTENGO MAXIMO Y LE SUMO 1 PARA ASIGNARLO 
//	COMO NUEVO CODIGO, QUE EL MISMO VA A SER UTILIAZDO EN OTRAS OPERACIONES.

$query  = "SELECT IFNULL(MAX(cod_alarma),0) +1 FROM ALARMA_CLIENTE";
$result = mysql_query($query);


while($line = mysql_fetch_array($result)) {
	$cod_alarma = $line[0]; 
}

$cod_desbloqueo = md5('12345'); //GUARDO INSCRIPTADA LA PASSWORD POR DEFAULT DE LA ALARMA.
								// EL CLIENTE PDORA CAMBIARLA LUEGO. (SI NOS DA EL TIEMPO)

$query="INSERT INTO ALARMA_CLIENTE (id_cliente,                cod_alarma,                  
									cod_desbloqueo,             estado)

							VALUES ($id_perfil,                  $cod_alarma,                  
								   '$cod_desbloqueo',           'E')"; //ESTADO E: REPOSO COMO DEFAULT

$result= mysql_query($query) or die(mysql_error());

// if(mysql_num_rows($result)==1){
// 	$_SESSION['msjResultadoOperacion'] 
// }


//CAMARAS
// SI $_SESSION['cod_prod_7'] es porque el cliente solicito CAMARAS IP.
// ENVIAR DE PRODUCTOS LA  DISPONIBILIDAD PARA VER SI EL MONITOREADOR PEUDE VER LAS CAMARAS
// $disponibilidad
// NO INSERTO Id_Camara porque es AUTONUMERICO.

if (isset($_SESSION['producto']['cod_prod_7'])){
	
	$cant_total_sen_apertura = $_SESSION['producto']['cod_prod_7'];
	$disp_monitor = $_SESSION['producto']['disp_monitor'];

	$i=1;
	while ($i <= $cant_total_sen_apertura ){

		$query = "INSERT INTO CAMARAS (id_cliente,	    descripcion,
									   disponibilidad)	

							VALUES    ($id_perfil, 	'$i',
									   $disp_monitor)";

$result= mysql_query($query) or die(mysql_error());

	$i++; // AUMENTO I 
}


}

/******************************************************************************/
/*								GENERACION DE FACTURAS						  */	
/******************************************************************************/

$query  = "SELECT IFNULL(MAX(nro_fact),0) +1 FROM FACTURA_CAB";
$result = mysql_query($query);


while($line = mysql_fetch_array($result)) {
	$nro_fact = $line[0]; 
}

$_SESSION['factura']['nro_fact'] = $nro_fact;

$query="INSERT INTO FACTURA_CAB (id_cliente,                nro_fact,                  
								 fecha_vencimiento,         estado_pago,
								 total_fact)

						VALUES ( $id_perfil,                  		$cod_alarma,                  
								 DATE_ADD(CURDATE(),INTERVAL 10 DAY),  0,
							     $totalFactura) "; //ESTADO E: REPOSO COMO DEFAULT

$result= mysql_query($query) or die(mysql_error());



$sQuery="SELECT  COUNT(cod_prod) AS 'cant_total_productos' FROM PRODUCTOS_SISTEMA";
$result= mysql_query($sQuery) or die(mysql_error());

if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

while($row=mysql_fetch_array($result)){
	$cant_total_productos = $row['cant_total_productos'];
}

/*								GENERACION DE PRIMER RESUMEN						  */	
$query = "	INSERT INTO FACTURA_RES (id_cliente, fecha_vencimiento, estado_pago, total_fact)
			VALUES	($id_perfil, DATE_ADD(CURDATE(),INTERVAL 30 DAY), 0, 200)";
$result= mysql_query($query) or die(mysql_error());


$sQuery="SELECT * FROM PRODUCTOS_SISTEMA";
$result1= mysql_query($sQuery) or die(mysql_error());

if(mysql_num_rows($result1)==0) die("No hay registros para mostrar");

$i=1;
$nro_subfact= 1;
while($row=mysql_fetch_array($result1)){
	
	if (!empty($_SESSION['producto']['cod_prod_'.$i])){
		$precio = $row['precio'];
		$cod_prod = $row['cod_prod'];
		$cant = $_SESSION['producto']['cod_prod_'.$i];


		$query="INSERT INTO FACTURA_DET (nro_fact,  nro_subfact,
										 cod_prod,   cantidad,  
										 imp_total,  id_cliente )

								VALUES ( $nro_fact,  $nro_subfact,
									     $cod_prod,  $cant, 		
							       		 $precio * $cant,$id_perfil ) "; //ESTADO E: REPOSO COMO DEFAULT

$result2= mysql_query($query) or die(mysql_error());

$nro_subfact++;

}	

$i++;	

}

/******************************************************************************/
/*								GENERACION DE FACTURAS						  */	
/******************************************************************************/


header("location: pdfFactura.php");

?>
