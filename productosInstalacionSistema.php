
<?php

include_once ("php/clases.php");
include_once('header.php');
include_once ('aside.php');
$base = new BD;
$conexion = $base->Conectar();



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
			<form action="php/calcularTotal.php" class="form-horizontal" method="POST">
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
											if ($row['obligatorio'] == 1) {
											echo "<td><label class='i-checks m-b-none'><input type='checkbox' checked name='post[]'><i></i></label></td>";
											}		
											else{
											echo "<td><label class='i-checks m-b-none'><input type='checkbox' name='post[]'><i></i></label></td>";
											}
									echo	"<td>".str_pad($row['cod_prod'],3,'000',STR_PAD_LEFT)."</td> 
											<td> $row[descr_prod] </td>
											<td> $row[precio] </td>";
											 if ($row['permite_cant'] == 1 || $row['cod_prod'] == 7 || $row['cod_prod'] == 8 ){
											  echo "<td style='vertical-align:middle;'><input type='text' class='form-control' name='".$row['cod_prod']."' style='height: 1.5em;' maxlength='2'></td>";
											}
											else{
											  echo "<td style='vertical-align:middle;'><input type='text' class='form-control' name='".$row['cod_prod']."' style='height: 1.5em;' maxlength='2' value = '1'></td>";
											}  
									echo  "</tr>";
							}
							
							
							?>		
						</table>	
					</div>
				</div>
			</div>
			<div class="wrapper-md" style="width: 30%;float: left;">	 
				<div> 
					<input type="submit" value="Calcular Total" class="btn btn-info">
				</div>
			</div>
			</form>

		</div>
	</div>	 
</div>			
<?php include('footer.php') ?>
