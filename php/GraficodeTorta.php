<?php 
require_once ('jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('jpgraph-3.5.0b1/src/jpgraph_pie.php');
$datos = array(20,20,20,20,20);
$ancho = 600; 
$alto = 600;
$graph = new PieGraph($ancho,$alto);
$graph->SetScale('intint');
$curva = new PiePlot($datos);
$graph->Add($curva);
$graph->Stroke();
?>

