
<?php 
session_start();

include_once ('php/clases.php');
include_once ('php/funciones.php');
include_once('header.php');
include_once ('aside.php');

$base = new BD;
$conexion = $base->Conectar();

if(isset($_GET['generar'])){
	

$query_clientes = "	SELECT id_perfil
					FROM PERFILES
					WHERE cod_tiporol = 3"; 

$result_clientes = mysql_query($query_clientes) or die(mysql_error());

while($row = mysql_fetch_array($result_clientes)){

	$query_fact_men = "	INSERT INTO FACTURA_RES (id_cliente, fecha_vencimiento, estado_pago, total_fact)
 						VALUES	($row[id_perfil], DATE_ADD(CURDATE(),INTERVAL 30 DAY), 0, 200)";
	$result_fact_men = mysql_query($query_fact_men) or die(mysql_error());
}


}



?>
<div class="wrapper-md">
<div id='content' class='app-content' role='main'>
    <div class='app-content-body '>
	    <div class='bg-light lter b-b wrapper-md'>
	  		<h1 class='m-n font-thin h3'> Facturas Mensuales</h1>
	    </div>
   		<div class='panel-body'>
			<div class='col-sm-7'>
			 	
				<?php 
				if(isset($_GET['generar'])){
				?>
					
					<table class="table table-striped b-t b-ligth">
   						<thead>
   							<tr style="background-color: #f7f7f7;">
   								<th style="width: 100px;">Nº</th>
   								<th style="width: 500px;">Detalle</th>
   								<th style="width: 500px;">ID Cliente</th>
   								<th style="width: 700px;">Nombre - Apellido</th>
   								<th>Vencimiento</th>
   								<th>Total</th>
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   								$queryR = "	SELECT B.nro_fact, A.id_perfil,  CONCAT(nombres,' ' , apellidos) as 'Nom_Apel' , B.fecha_vencimiento, B.total_fact
											FROM PERFILES A
											INNER JOIN FACTURA_RES B ON A.id_perfil = B.id_cliente
											WHERE fecha_vencimiento = DATE_ADD(CURDATE(),INTERVAL 30 DAY)
											ORDER BY B.nro_fact ASC";

								$resultR= mysql_query($queryR) or die(mysql_error());

   								$tablaR = '';
   								
								while($row=mysql_fetch_array($resultR)){
									$tablaR = $tablaR."	<tr>
															<td>$row[nro_fact]</td>
												            <td>Servicios de vigilancia</td>
												            <td>$row[id_perfil]</td>
												            <td>$row[Nom_Apel]</td>
												            <td>$row[fecha_vencimiento]</td>
												            <td>$$row[total_fact]</td>
												        </tr>";
									}
									echo $tablaR;
							?>
   						</tbody>
   					</table>
				<?php 
				}
				else{
					echo "<br><br><a class='btn btn-info' href='generarFacturasMensuales.php?generar=1'>GENERAR</a>";
				}

				?>
				
			</div>
		</div>	
	</div>
</div>	
<?php include_once('footer.php') ?>