<?php 
session_start();
include_once("..\dompdf\dompdf_config.inc.php");
include_once('clases.php');

$base = new BD;
$conexion = $base->Conectar();

$id_perfil = $_SESSION['alta']['id_perfil'];
$nro_fact = $_SESSION['factura']['nro_fact'];


// ========================= DATOS PERSONALES DEL CLIENTE ========================= 

$query= "SELECT B.descr_tipdoc,    A.nro_doc,         A.nombres,         
				A.apellidos,       C.descr_pais,      D.descr_prov,      
				E.descr_loc,	   A.direccion , 	  A.num_direccion
		 
		FROM PERFILES A

		INNER JOIN TIPOS_DOCUMENTOS B ON B.cod_tipdoc = A.cod_tipdoc

		INNER JOIN PAISES C ON C.cod_pais = A.cod_pais

		INNER JOIN PROVINCIAS D ON D.cod_prov = A.cod_prov

		INNER JOIN LOCALIDADES E ON E.cod_loc = A.cod_loc

		WHERE id_perfil = $id_perfil;";

$result= mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result)){
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

$query= "SELECT  fecha_vencimiento,		total_fact 
		 
		 FROM FACTURA_CAB WHERE nro_fact = $nro_fact";

$result= mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result)){
$fecha_vencimiento = $row['fecha_vencimiento']; 
       $total_fact = $row['total_fact']; 
	
}


// ========================= CABECERA DE FACTURA ========================= 

$query= "SELECT A.nro_subfact,    A.cod_prod,       B.descr_prod,     
				B.precio,         A.cantidad,       A.imp_total
		 
		 FROM FACTURA_DET  A

		 INNER JOIN  PRODUCTOS_SISTEMA B on B.cod_prod = A.cod_prod

		 WHERE A.nro_fact = $nro_fact";

$result= mysql_query($query) or die(mysql_error());




$deatelle= "<table border=1 cellpadding=4 cellspacing=0>";


while($row=mysql_fetch_array($result)){
	// $nro_subfact = $row['nro_subfact']; 
	//    $cod_prod = $row['cod_prod']; 
 // 	 $descr_prod = $row['descr_prod']; 
	//      $precio = $row['precio']; 
	//    $cantidad = $row['cantidad']; 
	//   $imp_total = $row['imp_total']; 

 // $deatelle =  $deatelle."$cod_prod       $descr_prod       $precio       $cantidad       $imp_total <br><br>";

 $deatelle = $deatelle."<tr>
					       <th colspan=5> Detalle de compra </th>
				       <tr>
				         <th> Cod.Producto </th>
				         <th> Descripcion  </th>
				         <th> Precio(u)    </th>
				         <th> Cantidad     </th>
				         <th> Total        </th>
				      </tr>";


while($row=mysql_fetch_array($result))
{
 $deatelle = $deatelle."<tr>
 							 <td> $row[cod_prod] </td>
					         <td> $row[descr_prod] </td>
					         <td> $row[precio] </td>
					         <td> $row[cantidad] </td>
					         <td> $row[imp_total] </td>
					     </tr>";
}
$deatelle = $deatelle."</table>";

}

 $html = "<head>
		  <meta charset='UTF-8'>

			</head>
			<body>
					
			      Nro. Factura: $nro_fact <br><br>
				  Fecha de Vencimiento : $fecha_vencimiento<br><br>
				  Total a abonar: $total_fact <br><br>	

				  Numero de cliente: $id_perfil<br><br>
				  Nombres: $nombres <br><br> 
				  Apellidos: $apellidos <br><br>
				  Tipo de documento: $descr_tipdoc	Nro: $nro_doc <br><br>
				  Pais: $descr_pais  -- Provincia: $descr_prov -- Localidad: $descr_loc <br><br> 
				  Direccion: $direccion $num_direccion <br><br> 
				  
				  
				  $deatelle
				  
			</body>
			</html> ";

 $dompdf = new DOMPDF();
 $dompdf->load_html($html);
 $dompdf->render();
 $dompdf->stream("sample.pdf");

 ?>
