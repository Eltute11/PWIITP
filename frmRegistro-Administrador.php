<?php 
include ("conexionBDD.php");

$base = new BD;
$conexion = $base->Conectar();

 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h3>ALTA CLIENTE - MONITOREADOR - ADMINISTRADOR</h3>
        	
        <form action="Alta-Administrador.php" method="POST">

	        <label for="tipoAlta">SELECCIONAR TIPO DE ALTA</label>
			<input id="tipoAlta" name="tipoAlta" type="radio" value="1" required/ >Administrador
			<input id="tipoAlta" name="tipoAlta" type="radio" value="2" required/ >Monitoreador
			<input id="tipoAlta" name="tipoAlta" type="radio" value="3" required/ >Cliente
			<br>
			<br>
			
			<label for="tipo_doc">Tipo de Documento:</label>
			<?php 
				LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
			 ?>
			 
			<label for="nro_doc">Número Documento:</label>
			<input type="text" name="nro_doc"> 
			<br>
			<br>
			
			<label for="nombres">Nombres: </label>
			<input type="text" name="nombres" id="nombres"> 
			<label for="apellidos">Apellidos: </label>
			<input type="text" name="apellidos" id="apellidos"> 
			<br>
			<br>

			<label for="fecha">Fecha de nacimiento: </label>
		    <input id="fecha" name="fecha" type="date" required="">
			<br>
			<br>

		    <!--<label for="pais">País:</label>
		    <select name="pais" id="pais">
				<option value="1">1 - Argentina</option>
			</select>
		    <br>
		    <br>
		    
		    <label for="provincia">Pronvincia:</label>
		    <select name="provincia" id="provincia">
				<option value="1">1 - Buenos Aires</option>
			</select>
		    <br>
		    <br>

		    <label for="localidad">Localidad:</label>
		    <select name="localidad" id="localidad">
				<option value="1">1 - San Antonio de Padua</option>
			</select>
		    <br>
		    <br> -->

			<label for="pais">País: </label>
			<?php 
				LlenarCombos('cod_pais','descr_pais','PAISES','pais');
		     ?>
		     <br>
		     <br>
			
			<label for='provincias'>Provincia: </label>
		    <?php 
		    	LlenarCombos('cod_prov','descr_prov','PROVINCIAS','provincia');
		    ?>
		    <br>
		    <br>
			
			<label for='localidades'>Localidad: </label>
		    <?php 
		    	LlenarCombos('cod_loc','descr_loc','LOCALIDADES','localidad');
		    ?>
			<br>
			<br>

			<label for="direccion">Dirección: </label>
			<input type="text" name="direccion" id="direccion">
			
			<label for="num_direc">Numero: </label>
			<input type="text" name="num_direc" id="num_direc">
			<br>
			<br>

			<label for="sexo">Sexo</label>
			<input id="sexo" name="sexo" type="radio" value="F" required/ >Femenino
			<input id="sexo" name="sexo" type="radio" value="M" required/ >Masculino
			<br>
			<br>

			<label for="telefono1">Teléfono 1:</label>
			<input type="text" name="telefono1" id="telefono1">
			
			<label for="telefono2">Teléfono 2:</label>
			<input type="text" name="telefono2" id="telefono2">
			<br>
			<br>

			<label for="email">Dirección E-mail:</label>
			<input type="text" name="email" id="email">
			<br>
			<br>
			
			<label for="disponibilidad">Disponible para monitorear: </label>
			<input id="disponibilidad" name="disponibilidad" type="radio" value="1" required/ >Si
			<input id="disponibilidad" name="disponibilidad" type="radio" value="0" required/ >No		
			<br>
			<br>

			<input type="submit" value="Enviar">
		</form>
			<?php 

				 function LlenarCombos ($campo_cod, $campo_descr, $tabla, $name)
		        {
		        	$sMySQL = "SELECT $campo_cod, $campo_descr FROM $tabla ORDER BY $campo_descr ASC";

					$rQuery =  mysql_query ($sMySQL);

					echo "<select name='$name' id='$name'>";
					while ($resultado = mysql_fetch_array($rQuery)) {

							echo "<option value= $resultado[$campo_cod]> $resultado[$campo_descr]</option>";
					 }

					echo "</select>";
		        }


			 ?>

	</body>
</html>


	