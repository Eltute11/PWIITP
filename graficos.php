<?php 
/*session_start();
//session_destroy();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}*/

include_once('header.php');
include_once ('aside.php');


 ?>

 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<!-- Titulo -->
	   	<div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Estadisticas</h1>
		</div>

		<?php 

		include ("php/clases.php");
		// CONEXION A BASE DE DATOS
		$base = new BD;
		$conexion = $base->Conectar();

		$query = "	SELECT B.descr_loc, COUNT(*) cantidad
					FROM PERFILES A
					INNER JOIN LOCALIDADES B ON A.cod_loc = B.cod_loc	
					-- WHERE cod_tiporol = 3
					GROUP BY A.cod_loc";

		$result = mysqli_query($query);
	/*		while($line = mysql_fetch_array($result)) {
				$localidad = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera
				$cantidad = $line[1];
			}	*/

		$row = mysqli_fetch_array($result,MYSQLI_NUM);
		printf ("%s (%s)\n",$row[0],$row[1]);

		 ?>

	</div>
 </div>