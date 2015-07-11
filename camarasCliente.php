<?php 
session_start();
session_destroy();
		if(!isset($_SESSION['usuario'])){
			session_destroy();
			header('location: index.php?nError=10');
			
		}

include_once ("php/clases.php");
include_once ("php/funciones.php");
include_once('header.php');
include_once ('aside_cliente.php');


?>
<head>
	<link rel="stylesheet" href="css/lightbox.css">
</head>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
	    <div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3"> Camaras Cliente</h1>
	    </div>
   		<div class="panel-body">
			<div class='col-sm-7'>
			 		<br><br><a class='btn btn-info' href='http://webcam.hotelbibionepalace.it/mjpg/video.mjpg' data-lightbox='Mi ipCam 1' data-title='Mi ipCam 1'>CAMARA PRUEBA</a>
			</div>
		</div>	
	</div>
</div>	

<script src="js/lightbox-plus-jquery.min.js"></script>
<?php include_once('footer.php') ?>