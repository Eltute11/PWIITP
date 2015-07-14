<?php 
session_start();
//session_destroy();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');		
}

include_once ("php/clases.php");
// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();

if(isset($_GET['filtro'])){
	$query = "	SELECT H.id_cliente,P.nombres, P.apellidos, H.fecha_hora, H.real_falsa
				FROM hist_alarma_cliente H
				INNER JOIN perfiles P ON H.id_cliente = P.id_perfil
				WHERE H.id_cliente = $_GET[filtro]" or die(mysql_error());
}else{
	$query = "	SELECT H.id_cliente,P.nombres, P.apellidos, H.fecha_hora, H.real_falsa
				FROM hist_alarma_cliente H
				INNER JOIN perfiles P ON H.id_cliente = P.id_perfil" or die(mysql_error());
}

$result= mysql_query($query) or die(mysql_error());

include_once('header.php');
include_once ('aside.php');
?>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Historial</h1>
	    </div>
   		<div class="wrapper-md">
   			<div class="panel panel-default">
   				<div class="panel-heading">
   					Todas los registros
   				</div>
   				<div class="panel-body b-b b-light">
			    	<form class="col-sm-5" action="historiales.php" method="GET">
			    		Filtrar por ID de cliente: <input id="filter" type="text" name="filtro" class="form-control input-sm w-sm inline m-r">
			    	</form>
			    	<a href="historiales.php" class="col-sm-3"><button class="btn btn-sm btn-default">Restablecer</button></a>
			    </div>
   				<div class="table-responsive">
   					<table class="table table-striped b-t b-ligth">
   						<thead>
   							<tr style="background-color: #f7f7f7;">
   								<th style="width: 100px;">Nº</th>
   								<th>Cliente</th>
   								<th style="width: 200px;">Fecha</th>
   								<th style="width: 150px;">Real o Falsa</th>
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   								$tabla = '';
								while($row = mysql_fetch_array($result)){
									$tabla = $tabla."	<tr>
									<td>$row[id_cliente]</td>
									<td>$row[nombres] $row[apellidos]</td>
									<td>$row[fecha_hora]</td>
									<td>$row[real_falsa]</td>
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