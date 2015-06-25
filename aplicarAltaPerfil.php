<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Alta</title>
</head>
<body>
<?php 
	session_start();
	
	// Si la variable $_SESSION['sCamposVal'], esta seteada, la vacio.
	// Se aplica para el caso de que si se trato de realizar un ALTA y existieron validaciones,
	// Al intentar de dar de alta nuevamente, no obtenga valores anteriores.
	if (isset($_SESSION['sCamposVal'])) {
		unset($_SESSION['sCamposVal']);
	}

	if (isset($_SESSION['nError'])) {
		unset($_SESSION['nError']);
	}
	

	$tipo_rol  = $_POST['tipo_rol'];
	$_SESSION['tipo_rol']=$tipo_rol;

	$tipo_doc  = $_POST['tipo_doc'];
	$_SESSION['tipo_doc']=$tipo_doc;

	$nro_doc = $_POST['nro_doc'];
	$_SESSION['nro_doc']=$nro_doc;

	$nombres   = $_POST['nombres'];
	$_SESSION['nombres']=$nombres;

	$apellidos = $_POST['apellidos'];
	$_SESSION['apellidos']=$apellidos;

	$fecha_nac = $_POST['fecha_nac'];
	$_SESSION['fecha_nac']=$fecha_nac;

	$pais = $_POST['pais'];
	$_SESSION['pais']=$pais;

	$provincia = $_POST['provincia'];
	$_SESSION['provincia']=$provincia;

	$localidad = $_POST['localidad'];
	$_SESSION['localidad']=$localidad;

	$direccion = $_POST['direccion'];
	$_SESSION['direccion']=$direccion;

	$num_direc = $_POST['num_direc']; 
	$_SESSION['num_direc']=$num_direc;

	$sexo = $_POST['sexo'];
	$_SESSION['sexo']=$sexo;

	$telefono1 = $_POST['telefono1'];
	$_SESSION['telefono1']=$telefono1;

	$telefono2 = $_POST['telefono2'];
	$_SESSION['telefono2']=$telefono2;

	$email 	   = $_POST['email']; 
	$_SESSION['email']=$email;


	include ("clases.php");
	
	$val = new validacion;
			
	/*EL METODO val_campo_obligatorio RECIBE:
	  1 - Pagina a la que volveria si hay un error.
	  2 - Variable a validar siesta vacia
	  3 - Nombre de la variable.
	  4 - 1 si es el ultimo campo a validar. 0 en caso contrario.
	*/

	$val->val_campo_obligatorio('frmAltaPerfil.php',$tipo_rol,'tipo_rol',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$tipo_doc,'tipo_doc',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$nro_doc, 'nro_doc',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$nombres,'nombres',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$apellidos, 'apellidos',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$fecha_nac, 'fecha_nac',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$pais, 'pais',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$provincia, 'provincia',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$localidad, 'localidad',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$direccion, 'direccion',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$telefono1,'telefono1',0);
	$val->val_campo_obligatorio('frmAltaPerfil.php',$sexo,'sexo',1);
	
	if (trim($telefono2) != ''){
		$val->val_campo_numerico('frmAltaPerfil.php',$telefono2,'telefono2');
	}
	$val->val_campo_numerico('frmAltaPerfil.php',$nro_doc, 'nro_doc',0);
	$val->val_campo_numerico('frmAltaPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_numerico('frmAltaPerfil.php',$telefono1,'telefono1',1);
	
	if (trim($direccion) != ''){
		$val->val_campo_letras('frmAltaPerfil.php',$direccion, 'direccion',0);
	}
	
	$val->val_campo_letras('frmAltaPerfil.php',$nombres,'nombres',0);
	$val->val_campo_letras('frmAltaPerfil.php',$apellidos, 'apellidos',1);
	
	$val-> val_perfil_existente ('frmAltaPerfil.php', $tipo_rol, $tipo_doc, $nro_doc);


	// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();
 	
 	// Si estos valores no se ingresaron, se setea nulos ya que los acepta en las tabla.

	if ($telefono2 ==''){
		$telefono2 = 'NULL';
	}

	if ($email ==''){
		$email = 'NULL';
	}
 	
/*	$val = new validacion;
	$validar = $val->validar_check($tipo_rol);*/

	


	$query  = "SELECT IFNULL(MAX(id_perfil),0) +1 FROM PERFILES";
	$result = mysql_query($query);


	while($line = mysql_fetch_array($result)) {
	    		$id_persona = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera y unica en este caso
	}

	
	
	$query = "INSERT INTO PERFILES (cod_tiporol,        id_perfil,          cod_tipdoc,         
									nro_doc,            nombres,            apellidos,          
									fecha_nac,          cod_pais,           cod_prov,           
									cod_loc,            direccion,          num_direccion,
									sexo,               telefono_1,         telefono_2,         
									direccion_email )

							VALUES ($tipo_rol,       $id_persona,   $tipo_doc,     
									$nro_doc,      '$nombres',     '$apellidos',     
								   '$fecha_nac',    $pais,          $provincia,     
									$localidad,    '$direccion',    $num_direc,
									'$sexo'	,       $telefono1,     $telefono2,     
									'$email'  );	" or die(mysql_error());

	
	
	mysql_query($query);

	
	 switch($tipo_rol) 
		 		 {	
		 		 case 1 :
		             $tipo_rol_desc = 'Administrador';
		             break;
		         case 2 :
		             $tipo_rol_desc = 'Monitoreador';
		             break;
		         case 3 :
		             $tipo_rol_desc = 'Cliente';
		             break;
		        }


	if (mysql_affected_rows() == 1) {
		echo "<h3>El $tipo_rol_desc $nombres $apellidos se dio de Alta exitosamente.</h3>";	        
		//session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer dar de alta al $tipo_rol_desc $nombres $apellidos:<br><br>" . mysql_error()."</h3>";

	//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET



 ?>
	<a href="frmAltaPerfil.php"><h3>Volver</h3></a>

</body>
</html>