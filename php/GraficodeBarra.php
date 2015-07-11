<?php 
session_start();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}
include ("clases.php");
// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();

$query = "	SELECT B.descr_loc, COUNT(*) cantidad
			FROM PERFILES A
			INNER JOIN LOCALIDADES B ON A.cod_loc = B.cod_loc	
			-- WHERE cod_tiporol = 3
			GROUP BY A.cod_loc;"

$result = mysql_query($query);
	while($line = mysql_fetch_array($result)) {
		$localidad = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera
		$cantidad = $line[1];
	}


require_once ('../jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('../jpgraph-3.5.0b1/src/jpgraph_bar.php');

$datos = array(2,4,5,9);
$ancho = 600; $alto = 250;
$graph = new Graph($ancho,$alto,'auto');
$graph->SetScale('intint');
$curva = new BarPlot($datos);
$graph->Add($curva);
$graph->Stroke();

?> 