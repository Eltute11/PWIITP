<?php 
session_start();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}
$conexion = mysql_connect("localhost","root","");
mysql_select_db("Seguridadlandia");
	
	$query = "	SELECT COUNT(*) cantidad, real_falsa
				FROM hist_alarma_cliente
				GROUP BY real_falsa;" or die(mysql_error());
	
	$result = mysql_query($query);
	$total = 0;
	while ($row = mysql_fetch_array($result)) {
		$array_cant[] = $row['cantidad'];
	}

require_once ('../jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('../jpgraph-3.5.0b1/src/jpgraph_bar.php');

//$datos = array(1,2,3,2,5,6);
$datos = array($array_cant[0]+$array_cant[1],$array_cant[0],$array_cant[1]);
//print_r($datos);die();
$ancho = 600; $alto = 250;
$graph = new Graph($ancho,$alto,'auto');
$graph->SetScale('textlin');
$curva = new BarPlot($datos);

$curva->SetColor("#0000CD");
$curva->SetFillColor("#0000CD");
$curva->SetLegend("Cantidad de alarmas");

//titulo eje X
$graph->xaxis->SetTickLabels(array('Total','Reales','Falsas'));
//$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->Add($curva);
$graph->Stroke();
?> 