
<?php
session_start();

include_once ("php/clases.php");
include_once ("php/funciones.php");
include_once('header.php');
include_once ('aside.php');
$base = new BD;
$conexion = $base->Conectar();

if (isset($_GET['error-val'])){
	$error_val = $_GET['error-val'];
}
else
{
	$error_val ='';

}


if (isset($_GET['nError'])) {
	$nError = $_GET['nError'];
	switch ($nError) {
		case 1: $campo_obligatorio = "<span class='help-block m-b-none' style='color: red;'> *Se debe adquirir 1 por habitacion/abertura</span>";
				break;
	}
}
else{
	$nError = 0;
}
				

?>

<div id="content" class="app-content" role="main">
	<div class="app-content-body ">
		<div class="bg-light lter b-b wrapper-md">
			<h1 class="m-n font-thin h3">Productos para la instalación de Sistema</h1>
		</div>
		<div class="panel-body">
		<?php 


			/* Realizamos la consulta SQL */
			$sql="select * from PRODUCTOS_SISTEMA";
			$result= mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

			/* Desplegamos cada uno de los registros dentro de una tabla */  
			?>
			<form action="php/calcularTotal.php" class="form-horizontal col-sm-12" method="POST">
				<div class="wrapper-md" style="width: 60%;float: left;">
					<div class="row"></div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Seleccionar productos que el cliente desea en la instalación
						</div>
						<div class="table-responsive">
							<table class="table table-striped b-t b-light">
								<thead>
									<tr>
										<th style="width: 1%;">
											<!-- <label class="i-checks m-b-none">
												<input type="checkbox"><i></i>
											</label> -->
										</th>
										<th style="width: 7%;">Cod.</th>
										<th style="width: 35%;">Descripcion</th>
										<th style="width: 7%;">Precio</th>
										<th style="width: 2%;">Cant.</th>
									</tr>
								</thead>	
								<?php

								while($row=mysql_fetch_array($result))
								{	
									echo "<tr>";
											if ($row['obligatorio'] == 1) { //Si es obligatorio; le pongo el check activado y no disponible para modificar
											echo "<td><label class='i-checks m-b-none'><input type='checkbox' disabled checked name='post[]'><i></i></label></td>";
											}		
											else{
											echo "<td><label class='i-checks m-b-none'><input type='checkbox' name='post[]'><i></i></label></td>";
											}
											// Le agrego formato 000 al codigo de producto
											// Descripcion de producto, los codigos 5 y 6 seran validados para que ingresen una cantidad obligatoria.
									  echo	"<td>".str_pad($row['cod_prod'],3,'000',STR_PAD_LEFT)."</td>
											 <td> $row[descr_prod]";											 ;
											  if ($nError == 1 && strpos($error_val,"cod_prod_$row[cod_prod]")) {
												echo "$campo_obligatorio";
										      }
         							  echo	"</td>
         							  		 <td> $row[precio] </td>";
         							  		 // Si la cantidad de productos puede ser != a 1, pongo el text vacio, sino en 1-
											 if ($row['permite_cant'] == 1){
											 ?>
											  <td style='vertical-align:middle;'><input type="text"  style='height: 1.5em;' maxlength='2' <?php echo ("name='cod_prod_$row[cod_prod]'"); ?> class='form-control' value=<?php  $resultado = validar_var_session('producto',"cod_prod_$row[cod_prod]"); 
											   if ($resultado == -1){ 
													echo "";
											  }?>>
											 <?php

											 }
											 else{
											 ?> <td style='vertical-align:middle;'><input type="text" style='height: 1.5em;' maxlength='2' <?php echo ("name='cod_prod_$row[cod_prod]'");?>  class='form-control' value=<?php  $resultado = validar_var_session('producto',"cod_prod_$row[cod_prod]"); 
										   		if ($resultado == -1){ 
													echo 1;
											  }?>>
											 <?php
											}  
									echo  "</tr>";
							}
							?>		
						</table>	
						<div class="panel-heading">
							<label class='i-checks m-b-none'><input type='checkbox' name='disp_monitor' 
								   value='1' <?php if(isset($_SESSION['producto']['disp_monitor']) && 
								   							$_SESSION['producto']['disp_monitor']!=0)
														echo "checked"; ?>>
							<i></i></label> Permitir monitoreador
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper-md" style="width: 30%;float: left;">	 
				<div> 
					
					<!-- <input type="submit" value="Calcular Total" class="btn btn-info"> -->

					<?php 
					
					if(isset($_SESSION['producto']['totalFactura'])){
						echo "<input type='submit' value='Calcular nuevo total' class='btn btn-info'>";
						$totalFactura = $_SESSION['producto']['totalFactura'];
					 	echo "<br><br>TOTAL A ABONAR: <br><br><input type='text' style='width: 28%;'  class='form-control' name='totalFactura' value= '$$totalFactura'>";
						echo"<br><br><a class='btn btn-info' href='php/generarPrimerFactura.php'>GENERAR PRIMER FACTURA</a>";					

					}
					else{
						echo "<input type='submit' value='Calcular Total' class='btn btn-info'>";
					}

					?>

				</div>
			</div>
			</form>
			<div class="wrapper-md">
				<div class="col-sm-2">
					<a href="administrador.php"><button class="btn btn-primary">Volver</button></a>
				</div>
			</div>

		</div>
	</div>	 
</div>			
<?php include('footer.php') ?>
