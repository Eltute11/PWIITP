<?php 
session_start();
//session_destroy();
if(!isset($_SESSION['usuario'])){
	session_destroy();
	header('location: index.php?nError=10');
			
}

include_once('header.php');
include_once ('aside.php');
 ?>

 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<!-- Titulo -->
	   	<div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Estadisticas</h1>
		</div>
		<div class="wrapper-md">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<!-- Titulo del grafico -->
						<div class="panel-heading font-bold">Clientes por zona</div>
						<div class="panel-body">
							<div class="col-sm-12">
								<img src="php/GraficodeBarraLoc.php" alt="grafico de barra localdad">
								<a href="php/PDF.php?grafico=GraficodeBarraLoc.php"><button class="btn m-b-xs w-xs btn-info">Descargar</button></a>
							</div>
							<div class="col-sm-12">
								<img src="php/GraficodeTortaLoc.php" alt="grafico de torta localdad">
								<a href="php/PDF.php?grafico=GraficodeTortaLoc.php"><button class="btn m-b-xs w-xs btn-info">Descargar</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<!-- Titulo del grafico -->
						<div class="panel-heading font-bold">Cantidad de alarmas disparadas</div>
							<div class="col-sm-12">
								<img src="php/GraficodeBarraAlarmTotal.php" alt="grafico de barra total">
								<a href="php/PDF.php?grafico=GraficodeBarraAlarmTotal.php"><button class="btn m-b-xs w-xs btn-info">Descargar</button></a>
							</div>
							<div class="col-sm-12">
								<img src="php/GraficodeTortaAlarmTotal.php" alt="grafico de torta total">
								<a href="php/PDF.php?grafico=GraficodeTortaAlarmTotal.php"><button class="btn m-b-xs w-xs btn-info">Descargar</button></a>
							</div>	
						<div class="panel-body">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<!-- Titulo del grafico -->
						<div class="panel-heading font-bold">Cantidad de alarmas disparadas por fecha</div>
							<div class="col-sm-12">
								<img src="php/GraficodeLinea.php" alt="grafico de linea total">
								<a href="php/PDF.php?grafico=GraficodeLinea.php"><button class="btn m-b-xs w-xs btn-info">Descargar</button></a>
							</div>
						<div class="panel-body">
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
 </div>

<?php include_once('footer.php'); ?>