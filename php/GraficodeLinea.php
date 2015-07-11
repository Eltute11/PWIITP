<?php 
require_once ('jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('jpgraph-3.5.0b1/src/jpgraph_line.php');
$datos = array(1,8,12);
$ancho = 600; $alto = 250;
$graph = new Graph($ancho,$alto,'auto');
$graph->SetScale('intint');
$curva = new LinePlot($datos);
$graph->Add($curva);
$graph->Stroke();
?>