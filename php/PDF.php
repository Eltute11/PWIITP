<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

$grafico = $_GET['grafico'];

include_once("..\dompdf\dompdf_config.inc.php");

$html = "	
			<head>
		  	<meta charset='UTF-8'>
			</head>
			<body>
				<img src='$grafico' alt='grafico'>
			</body>
			</html>
			";
//exit($html);
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Grafico.pdf");


?>