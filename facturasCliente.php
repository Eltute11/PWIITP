<?php 
session_start();
// session_destroy();
		// if(!isset($_SESSION['usuario'])){
		// 	session_destroy();
		// 	header('location: index.php?nError=10');
			
		// }

include_once ("php/clases.php");
include_once ("php/funciones.php");


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
   							<tr>
					            <td>1</td>
					            <td>Servicios de vigilancia</td>
					            <td>Ene 25, 2015</td>
					            <td>$1800</td>
					            <td>
					              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
					            </td>
							</tr>
							<tr style="background-color: #f7f7f7;">
					            <td>2</td>
					            <td>Servicios de vigilancia</td>
					            <td>Feb 25, 2015</td>
					            <td>$1800</td>
					            <td>
					              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
					            </td>
							</tr>
							<tr>
					            <td>3</td>
					            <td>Servicios de vigilancia</td>
					            <td>Mar 25, 2015</td>
					            <td>$1900</td>
					            <td>
					              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
					            </td>
							</tr>
							<tr style="background-color: #f7f7f7;">
					            <td>4</td>
					            <td>Servicios de vigilancia</td>
					            <td>Abril 25, 2015</td>
					            <td>$1950</td>
					            <td>
					              <a href="" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text-active"></i></a>
					            </td>
							</tr>
   						</tbody>
   					</table>
   				</div>
   			</div>
   		</div>


	</div>
</div>	
<?php include_once('footer.php') ?>