<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

$id_cliente = $_SESSION['cliente']['id'];

include_once("..\dompdf\dompdf_config.inc.php");
include_once('clases.php');

$base = new BD;
$conexion = $base->Conectar();

// ========================= DATOS PERSONALES DEL CLIENTE ========================= 

$query= "SELECT B.descr_tipdoc,    A.nro_doc,         A.nombres,         
				A.apellidos,       C.descr_pais,      D.descr_prov,      
				E.descr_loc,	   A.direccion , 	  A.num_direccion
		 
		FROM PERFILES A

		INNER JOIN TIPOS_DOCUMENTOS B ON B.cod_tipdoc = A.cod_tipdoc

		INNER JOIN PAISES C ON C.cod_pais = A.cod_pais

		INNER JOIN PROVINCIAS D ON D.cod_prov = A.cod_prov

		INNER JOIN LOCALIDADES E ON E.cod_loc = A.cod_loc

		WHERE id_perfil = $id_cliente";

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	$descr_tipdoc = $row['descr_tipdoc']; 
	     $nro_doc = $row['nro_doc']; 
		 $nombres = $row['nombres']; 
	   $apellidos = $row['apellidos']; 
	  $descr_pais = $row['descr_pais']; 
	  $descr_prov = $row['descr_prov']; 
	   $descr_loc = $row['descr_loc'];
	   $direccion = $row['direccion'];
   $num_direccion = $row['num_direccion']; 

}

// ========================= CABECERA DE FACTURA ========================= 

$query= "SELECT  nro_fact, fecha_vencimiento, total_fact 
	
		 FROM FACTURA_RES 

		 WHERE id_cliente = $id_cliente 

		 AND estado_pago = 0";

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	$fecha_vencimiento = $row['fecha_vencimiento']; 
    $total_fact = $row['total_fact']; 
    $nro_fact = $row['nro_fact'];
}

$html = "	
			<head>
		  	<meta charset='UTF-8'>
			</head>
			<body>
				<table>
					<tbody>
						<tr>
							<td>Nro. Factura: $nro_fact</td>
								<td>Vencimiento: $fecha_vencimiento</td>
						</tr>
						<tr>
							<td>Cliente: $id_cliente</td>
							<td>$nombres</td>
							<td>$apellidos</td>
						</tr>
						<tr>
							<td>$descr_tipdoc</td>
							<td> $nro_doc</td>
						</tr>
						<tr>
							<td>Pais: $descr_pais,</td>
							<td>$descr_prov,</td>
							<td>$descr_loc, </td>
							<td>$direccion $num_direccion </td>
						</tr>
						<tr>
						<td>Detalle: Servicio de monitoreo</td>
						<td>Total: $total_fact</td>
						</tr>
					</tbody>
				</table>


			</body>
			</html>
			";
//exit($html);
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");


?>