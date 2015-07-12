<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }
$id_cliente = $_SESSION['cliente']['id'];
include_once ("php/clases.php");
// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();

$query = "	SELECT nro_fact, fecha_vencimiento, total_fact, estado_pago
			FROM factura_res
			WHERE id_cliente = $id_cliente";

$result= mysql_query($query) or die(mysql_error());

include_once('header.php');
include_once ('aside_cliente.php');
?>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3"> Facturas del cliente</h1>
	    </div>
   		<div class="wrapper-md">
   			<div class="panel panel-default">
   				<div class="panel-heading">
   					Todas las Facturas
   				</div>
   				<div class="table-responsive">
   					<table class="table table-striped b-t b-ligth">
   						<thead>
   							<tr style="background-color: #f7f7f7;">
   								<th style="width: 100px;">Nº</th>
   								<th style="width: 500px;">Detalle</th>
   								<th>Vencimiento</th>
   								<th>Total</th>
   								<th style="width: 100px;">Estado</th>
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   								$sinPagar = '<a href="php/resumenServicioPDF.php" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text-active"></i></a>';
   								$pagado = '<a href="#" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i></a>';
   								$tabla = '';
								while($row=mysql_fetch_array($result)){
									if($row['estado_pago'] == 0) { 
					            		$estado_pago = $sinPagar;
					            	}else{
					            		$estado_pago = $pagado;
					            	};


									$tabla = $tabla."	<tr>
															<td>$row[nro_fact]</td>
												            <td>Servicios de vigilancia</td>
												            <td>$row[fecha_vencimiento]</td>
												            <td>$$row[total_fact]</td>
												            <td>$estado_pago </td>
											           	</tr>";
									}
									echo $tabla;
							?>
   						</tbody>
   					</table>
   				</div>
   			</div>
   		</div>


	</div>
</div>	
<?php include_once('footer.php') ?>