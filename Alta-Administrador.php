<?php 

include ("conexionBDD.php");

$base = new BD;
$conexion = $base->Conectar();


$tipoAlta  = $_POST['tipoAlta'];
$tipo_doc  = $_POST['tipo_doc'];
$nro_doc   = $_POST['nro_doc'];
$nombres   = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha_nac = $_POST['fecha'];
$pais      = $_POST['pais'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$direccion = $_POST['direccion'];
$num_direc = $_POST['num_direc']; 
$sexo 	   = $_POST['sexo'];
$telefono1 = $_POST['telefono1'];
$telefono2 = $_POST['telefono2'];
$email 	   = $_POST['email']; 

if ($tipoAlta == 2) 
	$disponibilidad = $_POST['disponibilidad'];
else
	$disponibilidad = 'NULL';

 //Validar que se acepte solo para monitoreadores. Admin y clientes -> NULL

//OBTENER MAXIMO ID_PERSPONA PARA EL TIPO DE PERSONA INGRESADO

$query  = "SELECT IFNULL(MAX(id_persona),0) + 1 as 'id_personaMax' FROM PERSONAS where cod_tipper = $tipoAlta";
$result = mysql_query($query);


while($line = mysql_fetch_array($result)) {
    		$id_persona = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera y unica en este caso
}



$query = "INSERT INTO PERSONAS (cod_tipper,         id_persona,         cod_tipdoc,         
								nro_doc,            nombres,            apellidos,          
								fecha_nac,          cod_pais,           cod_prov,           
								cod_loc,            direccion,          num_direccion,
								sexo,               telefono_1,         telefono_2,         
								direccion_email,    disponibilidad)

						VALUES ($tipoAlta,      $id_persona,    $tipo_doc,     
								$nro_doc,      '$nombres',     '$apellidos',     
							   '$fecha_nac',    $pais,          $provincia,     
								$localidad,    '$direccion',    $num_direc,
								'$sexo'	,       $telefono1,     $telefono2,     
								'$email' ,		$disponibilidad );	" or die(mysql_error());


mysql_query($query);


 switch($tipoAlta) 
	 		 {	
	 		 case 1 :
	             $tipoRol = 'Administrador';
	             break;
	         case 2 :
	             $tipoRol = 'Monitoreador';
	             break;
	         case 3 :
	             $tipoRol = 'Cliente';
	             break;
	        }


if (mysql_affected_rows() == 1) 
	echo "<h3>El $tipoRol $nombres $apellidos se dio de Alta exitosamente.</h3>";	        
else
	echo "<h3>Ha ocurrido un problema al querer dar de alta al $tipoRol $nombres $apellidos:<br><br>" . mysql_error()."</h3>";



// Cerrar la conexión
//mysql_close($link);

//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET


 ?>

 <html>
 	<a href="frmRegistro-Administrador.php"><h3>Volver</h3></a>

 </html>