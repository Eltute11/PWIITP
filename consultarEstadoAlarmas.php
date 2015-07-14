<?php  
include_once('php/clases.php');
$base = new BD;
$conexion = $base->Conectar();


$query = "SELECT nombres,apellidos, latitud, longitud, direccion, num_direccion, estado
		  
		  FROM PERFILES A
		  
		  INNER JOIN ALARMA_CLIENTE B ON A.id_perfil = B.id_cliente
		  
		  WHERE A.cod_tiporol = 3";
		    

$result = mysql_query($query);
$array = array();
while($data = mysql_fetch_assoc($result)){
	$array[]=$data;
}

echo json_encode($array); //Devuelve un string con la representación JSON.

?>
