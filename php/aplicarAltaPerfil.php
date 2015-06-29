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
	

	$cod_tiporol  = $_POST['tipo_rol'];
	$_SESSION['tipo_rol']=$cod_tiporol;

	$cod_tipdoc  = $_POST['tipo_doc'];
	$_SESSION['tipo_doc']=$cod_tipdoc;

	$cod_tipdoc   = $_POST['nro_doc'];
	$_SESSION['nro_doc']=$cod_tipdoc;

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

	$newUser  = $_POST['newUser'];
	$_SESSION['newUser']=$newUser;

	$pass1 = $_POST['pass1'];
	$_SESSION['pass1']=$pass1;

	$pass2 = $_POST['pass2'];
	$_SESSION['pass2']=$pass2;
<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
=======

>>>>>>> origin/master:php/aplicarAltaPerfil.php

	include ("clases.php");
	
	$val = new validacion;
			
	/*EL METODO val_campo_obligatorio RECIBE:
	  1 - Pagina a la que volveria si hay un error.
	  2 - Variable a validar siesta vacia
	  3 - Nombre de la variable.
	  4 - 1 si es el ultimo campo a validar. 0 en caso contrario.
	*/

<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	$val->val_perfil_existente ('../frmAltaPerfil.php', $cod_tiporol, $cod_tipdoc, $nro_doc); 
=======
	$val-> val_perfil_existente ('../frmAltaPerfil.php', $cod_tiporol, $cod_tipdoc, $nro_doc); 
>>>>>>> origin/master:php/aplicarAltaPerfil.php

	$val->val_campo_obligatorio('../frmAltaPerfil.php',$cod_tiporol,'tipo_rol',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$cod_tipdoc,'tipo_doc',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$nro_doc, 'nro_doc',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$nombres,'nombres',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$apellidos, 'apellidos',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$fecha_nac, 'fecha_nac',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$pais, 'pais',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$provincia, 'provincia',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$localidad, 'localidad',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$direccion, 'direccion',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$telefono1,'telefono1',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$sexo,'sexo',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['newUser'],'newUser',0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['pass1'], 'pass1', 0);
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['pass2'], 'pass2',1);
<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	
=======

>>>>>>> origin/master:php/aplicarAltaPerfil.php
	if (trim($telefono2) != ''){
		$val->val_campo_numerico('../frmAltaPerfil.php',$telefono2,'telefono2');
	}
	$val->val_campo_numerico('../frmAltaPerfil.php',$nro_doc, 'nro_doc',0);
	$val->val_campo_numerico('../frmAltaPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_numerico('../frmAltaPerfil.php',$telefono1,'telefono1',1);
	
	if (trim($direccion) != ''){
		$val->val_campo_letras('../frmAltaPerfil.php',$direccion, 'direccion',0);
	}
	
	$val->val_campo_letras('../frmAltaPerfil.php',$nombres,'nombres',0);
	$val->val_campo_letras('../frmAltaPerfil.php',$apellidos, 'apellidos',1);
	
	$val->val_usuario('../frmAltaPerfil.php', $newUser, 'newUser');
<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	$val->val_passwords('../frmAltaPerfil.php',$pass1, $pass2);
=======
>>>>>>> origin/master:php/aplicarAltaPerfil.php

	$val->val_passwords('../frmAltaPerfil.php',$pass1, $pass2);	

	// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();
 	
 	// Si estos valores no se ingresaron, se setea nulos ya que los acepta en las tabla.

	if (trim($telefono2) ==''){
<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	$telefono2 = "NULL";
=======
		$telefono2 = "NULL";
>>>>>>> origin/master:php/aplicarAltaPerfil.php
	}

	if (trim($email) ==''){
		$email = "NULL";
<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	}else{
		$email = "'$email'"; //Agrego este tratamiento para que pueda enviarlo como string con '' o NULL sin ''
=======
>>>>>>> origin/master:php/aplicarAltaPerfil.php
	}
	else{
		$email = "'$email'"; //Agrego este tratamiento para que pueda enviarlo como string con '' o NULL sin ''
	}




 	
/*	$val = new validacion;
	$validar = $val->validar_check($tipo_rol);*/

	$query  = "SELECT IFNULL(MAX(id_perfil),0) +1 FROM PERFILES";
	$result = mysql_query($query);


	while($line = mysql_fetch_array($result)) {
	    		$id_perfil = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera y unica en este caso
	}

	
	
	$query = "INSERT INTO PERFILES (cod_tiporol,        id_perfil,          cod_tipdoc,         
									nro_doc,            nombres,            apellidos,          
									fecha_nac,          cod_pais,           cod_prov,           
									cod_loc,            direccion,          num_direccion,
									sexo,               telefono_1,         telefono_2,         
									direccion_email )

<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
							VALUES ($cod_tiporol ,  $id_perfil,   $cod_tipdoc,     
									$nro_doc,      '$nombres',     '$apellidos',     
								   '$fecha_nac',    $pais,          $provincia,     
									$localidad,    '$direccion',    $num_direc,
									'$sexo'	,       $telefono1,     $telefono2,     
									'$email'  );	" or die(mysql_error());
=======
							VALUES ($cod_tiporol,    $id_perfil,     $cod_tipdoc,     
									$nro_doc,       '$nombres',     '$apellidos',     
								   '$fecha_nac',     $pais,          $provincia,     
									$localidad,     '$direccion',    $num_direc,
								   '$sexo'	,        $telefono1,     $telefono2,     
								    $email  );	" or die(mysql_error());
>>>>>>> origin/master:php/aplicarAltaPerfil.php

	mysql_query($query);

	
	 switch($cod_tiporol) 
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

<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
	//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET
=======
		//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET

>>>>>>> origin/master:php/aplicarAltaPerfil.php
	$passEncrip = md5($pass1);
	
	$sMySQL = "INSERT INTO USUARIOS (cod_tiporol, id_perfil, usuario, password)
			  VALUES ( $cod_tiporol ,$id_perfil , '$newUser', '$passEncrip')";

	$rQuery = mysql_query($sMySQL);

<<<<<<< HEAD:seguridadlandia/php/aplicarAltaPerfil.php
=======

	if (mysql_affected_rows() == 1) {
		echo "<h3>El usuario $newUser se dio de Alta exitosamente.</h3>";	        
		session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer dar de alta al usuario $newUser :<br><br>" . mysql_error()."</h3>";	



>>>>>>> origin/master:php/aplicarAltaPerfil.php

	if (mysql_affected_rows() == 1) {
		echo "<h3>El usuario $newUser se dio de Alta exitosamente.</h3>";	        
		session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer dar de alta al usuario $newUser :<br><br>" . mysql_error()."</h3>";	


 ?>
	<a href="../frmAltaPerfil.php"><h3>Volver</h3></a>

</body>
</html>