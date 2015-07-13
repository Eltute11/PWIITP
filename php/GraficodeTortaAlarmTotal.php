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
require_once ('../jpgraph-3.5.0b1/src/jpgraph_pie.php');

$datos = array($array_cant[0]+$array_cant[1],$array_cant[0],$array_cant[1]);
$ancho = 350; $alto = 350;
$graph = new PieGraph($ancho,$alto);
$graph->SetScale('intint');
$curva = new PiePlot($datos);

// Legends
$curva->SetLegends(array('Total','Reales','Falsas'));
$graph->legend->SetPos(0.5,0.97,'center','bottom');
$graph->legend->SetColumns(3);

$graph->Add($curva);
//$graph->title->Set("Clientes por zona");
// Display the graph
$graph->Stroke();
?>

