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
   		<div class="panel-body">
			<div class='col-sm-7'>
			 	<?php  
			 		
					
				 ?>
			</div>
		</div>	
	</div>
</div>	
<?php include_once('footer.php') ?>