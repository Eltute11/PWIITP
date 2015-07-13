<?php 
session_start();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}
$conexion = mysql_connect("localhost","root","");
mysql_select_db("Seguridadlandia");
	
	$query = "	SELECT B.descr_loc, COUNT(*) cantidad
				FROM PERFILES A
				INNER JOIN LOCALIDADES B ON A.cod_loc = B.cod_loc	
				-- WHERE cod_tiporol = 3
				GROUP BY A.cod_loc" or die(mysql_error());
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)) {
		$array[] = $row['cantidad'];
		$array_descr_loc[] = $row['descr_loc'];
	}

require_once ('../jpgraph-3.5.0b1/src/jpgraph.php');
require_once ('../jpgraph-3.5.0b1/src/jpgraph_pie.php');

$datos = $array;
$ancho = 350; $alto = 350;
$graph = new PieGraph($ancho,$alto);
$graph->SetScale('intint');
$curva = new PiePlot($datos);

// Legends
$curva->SetLegends($array_descr_loc);
$graph->legend->SetPos(0.5,0.97,'center','bottom');
$graph->legend->SetColumns(3);

$graph->Add($curva);
//$graph->title->Set("Clientes por zona");
// Display the graph
$graph->Stroke();
?>

