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
require_once ('../jpgraph-3.5.0b1/src/jpgraph_bar.php');

//$datos = array(1,2,3,2,5,6);
$datos = $array;
$ancho = 600; $alto = 250;
$graph = new Graph($ancho,$alto,'auto');
$graph->SetScale('textlin');
$curva = new BarPlot($datos);

$curva->SetColor("#0000CD");
$curva->SetFillColor("#0000CD");
$curva->SetLegend("Clientes por zona");

//titulo eje X
$graph->xaxis->SetTickLabels($array_descr_loc);
//$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->Add($curva);
$graph->Stroke();
?> 