<?php 
include ("conexionBDD.php");

$base = new BD;
$conexion = $base->Conectar();

 ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ALTA CLIENTE - MONITOREADOR - ADMINISTRADOR</title>
    </head>
    <body>

        <h2>ALTA CLIENTE - MONITOREADOR - ADMINISTRADOR </h2>
        	
        <form action="Alta-Administrador.php" method="POST">

	        <label>Seleccionar tipo de alta</label>
			<input id="adm" name="tipoAlta" type="radio" value="1" required/><label for="adm">Administrador</label>
			<input id="mon" name="tipoAlta" type="radio" value="2" required/><label for="mon">Monitoreador</label>
			<input id="cli" name="tipoAlta" type="radio" value="3" required/><label for="cli">Cliente</label>
			<br>
			<br>
			
			<label for="tipo_doc">Tipo de Documento:</label>
			<?php 
				LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc');
			 ?>
			 
			<label for="nro_doc">Número Documento:</label>
			<input type="text" id="nro_doc"name="nro_doc"> 
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

			<label>Sexo</label>
			<input id="fem" name="sexo" type="radio" value="F" required/><label for="fem">Femenino</label>
			<input id="mas" name="sexo" type="radio" value="M" required/><label for="mas">Masculino</label>
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
			
			<label for="disponibilidad">Disponible para monitorear:</label>
			<input id="si" name="disponibilidad" type="radio" value="1" required/><label for="si">Si</label>
			<input id="no" name="disponibilidad" type="radio" value="0" required/><label for="no">No</label>		
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


	