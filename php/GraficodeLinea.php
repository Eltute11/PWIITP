<?php 
session_start();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}
$conexion = mysql_connect("localhost","root","");
mysql_select_db("Seguridadlandia");
	
	$query = "	SELECT COUNT(*) cantidad, fecha_hora
				FROM hist_alarma_cliente
				GROUP BY fecha_hora;" or die(mysql_error());
	
	$result = mysql_query($query);

	while ($row = mysql_fetch_array($result)) {
		$array_cant[] = $row['cantidad'];
		$array_fecha_hora[] = $row['fecha_hora'];
	}
//print_r($array_fecha_hora);die();

require_once ('../jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('../jpgraph-3.5.0b1/src/jpgraph_line.php');
$datos = $array_cant;
$ancho = 600; $alto = 250;
$graph = new Graph($ancho,$alto,'auto');
$graph->SetScale('intint');
$curva = new LinePlot($datos);
$graph->xaxis->SetTickLabels($array_fecha_hora);
$graph->Add($curva);
$graph->Stroke();
?>