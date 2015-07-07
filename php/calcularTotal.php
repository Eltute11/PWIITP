<?php 
session_start();


include_once ("clases.php");
$base = new BD;
$conexion = $base->Conectar();

if (isset($_SESSION['sCamposVal'])) {
	unset($_SESSION['sCamposVal']);
}

if (isset($_SESSION['nError'])) {
	unset($_SESSION['nError']);
}

// Guardo en una variable de sesion el valor de si esta o no disponible el monitor par visualziar las camaras
// para utilizarlo luego en generarPrimerFactura.php.

if (isset($_POST['disp_monitor'])) {
	$_SESSION['producto']['disp_monitor']= $_POST['disp_monitor'];
}
else{
  $_SESSION['producto']['disp_monitor']= 0;
} 


$cod_prod_5  = $_POST['cod_prod_5'];
$_SESSION['producto']['cod_prod_5']=$cod_prod_5; // Los guardo ahora en una variable de session ahora, por el hecho que si
												 // es rechazado  en las validaciones por uno de los productos, se obtenga el valor del ingreasdo.
$cod_prod_6  = $_POST['cod_prod_6'];
$_SESSION['producto']['cod_prod_6']=$cod_prod_6; 

$val = new validacion;
$val->val_campo_obligatorio('../productosInstalacionSistema.php',$cod_prod_5,'cod_prod_5',0);
$val->val_campo_obligatorio('../productosInstalacionSistema.php',$cod_prod_6,'cod_prod_6',1);

$totalFactura = 0; 

$sQuery="select * from PRODUCTOS_SISTEMA";
$result= mysql_query($sQuery) or die(mysql_error());
if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

while($row=mysql_fetch_array($result)){
    
    $_SESSION['producto']['cod_prod_'.$row['cod_prod']] = $_POST['cod_prod_'.$row['cod_prod']];	// Creo variable session ['producto'][cod_prod_1],...[cod_prod_2],...[cod_prod_N] de cada producto.
	$totalFactura = $totalFactura + ($row['precio'] * $_POST['cod_prod_'.$row['cod_prod']]);  // El name cantidad ingresa el es codigo de producto.
}	

$_SESSION['producto']['totalFactura'] = $totalFactura;
header("location: ../productosInstalacionSistema.php");

?>