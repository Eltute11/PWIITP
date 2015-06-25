<?php
session_start();
//session_destroy();
/*
		if(!isset($_SESSION['usuario'])){
			session_destroy();
			header('location: index.php?error=loguearse');
			#echo '<h1>Sesion: ',$_SESSION['usuario'],'</h1>';
			
		}
*/

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>aplicarModificacionPerfil</title>
</head>
<body>
	
<?php 
	// Si la variable $_SESSION['sCamposVal'], esta seteada, la vacio.
	// Se aplica para el caso de que si se trato de realizar un ALTA y existieron validaciones,
	// Al intentar de dar de alta nuevamente, no obtenga valores anteriores.
	if (isset($_SESSION['sCamposVal'])) {
		unset($_SESSION['sCamposVal']);
	}

	if (isset($_SESSION['nError'])) {
		unset($_SESSION['nError']);
	}

	$id_perfil  = $_POST['id_perfil'];
	$_SESSION['id_perfil']=$id_perfil;

	$tipo_rol   = $_SESSION['tipo_rol']; //Guardo en $tipo_rol, el valor del tipo ingresado en la consulta del perfil al inicio ya que el mismo no se va a poder modificar

	
	if (isset($_POST['nuevo_tipo_doc'])){ 					// Se agrego tratamiento nuevo_tipo_doc y nuevo_nro_doc, para poder realizar la modificacion de los mismo 
		$tipo_doc = "NULL";				  					// y ademas, en caso de haberse modificado y exista un rechazo por validacion, se muestren estos nuevos ingresados 
		$nuevo_tipo_doc = $_POST['nuevo_tipo_doc']; 		// y no los obtenidos al realizar la consulta del perfil.	
		$_SESSION['nuevo_tipo_doc']  = $nuevo_tipo_doc ;	// Tambien, por el hecho de que al existir rechazo por validacion, al volver al frmModificarPerfil, debia mantener los valores
	}														// de tipo y nro doc ingresados en la busqueda, para poder obtener el resto de los datos. Es decir, siempre busque al perfil por lo mismo valores ingresados.
	else{
		$nuevo_tipo_doc  = "NULL";
		$tipo_doc   = $_POST['tipo_doc'];
		$_SESSION['nuevo_tipo_doc'] = $tipo_doc;
	}


	if (isset($_POST['nuevo_nro_doc'])) {
		$nro_doc = "NULL";
		$nuevo_nro_doc = $_POST['nuevo_nro_doc'];
		$_SESSION['nuevo_nro_doc']  = $nuevo_nro_doc ;		
	}
	else
	{	$nuevo_nro_doc = "NULL";
		$nro_doc = $_POST['nro_doc'] ;
		$_SESSION['nuevo_nro_doc']  =  $nro_doc;
	}	

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
	if ( !trim($telefono2) ==''){
		$_SESSION['telefono2']=$telefono2;
	}
	else{
		$telefono2 = "NULL";
		$_SESSION['telefono2'] = '';
	}

	$email = $_POST['email'];
	if ( !trim($email) ==''){
		$email = "'$email'";
		$_SESSION['email']  = $email ;	
	}
	else{
		$email = "NULL";
		$_SESSION['email'] = '';
	}



	include ("clases.php");
	$val = new validacion;
			
	/*EL METODO val_campo_obligatorio RECIBE:
	  1 - Pagina a la que volveria si hay un error.
	  2 - Variable a validar si esta vacia
	  3 - Nombre de la variable.
	  4 - 1 si es el ultimo campo a validar. 0 en caso contrario.
	*/
	

	if (isset($_POST['nuevo_tipo_doc'])) {
		$val->val_campo_obligatorio('frmModificacionPerfil.php',$nuevo_tipo_doc,'nuevo_tipo_doc',0); // Dejar asi.	

	}
	else{
		$val->val_campo_obligatorio('frmModificacionPerfil.php',$tipo_doc,'tipo_doc',0); // Dejar asi.	
	}	
	
	if (isset($_POST['nuevo_tipo_doc'])) {
		$val->val_campo_obligatorio('frmModificacionPerfil.php',$nuevo_nro_doc,'nuevo_nro_doc',0); // Dejar asi.	

	}
	else{
		$val->val_campo_obligatorio('frmModificacionPerfil.php',$nro_doc,'nro_doc',0); // Dejar asi.	
	}	

	$val->val_campo_obligatorio('frmModificacionPerfil.php',$nombres,'nombres',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$apellidos, 'apellidos',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$fecha_nac, 'fecha_nac',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$pais, 'pais',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$provincia, 'provincia',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$localidad, 'localidad',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$direccion, 'direccion',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$telefono1,'telefono1',0);
	$val->val_campo_obligatorio('frmModificacionPerfil.php',$sexo,'sexo',1);
	

	if (trim($telefono2) != '' && $telefono2 != "NULL"){
		$val->val_campo_numerico('frmModificacionPerfil.php',$telefono2,'telefono2');
	}

	if (isset($_POST['nuevo_tipo_doc'])) {
		$val->val_campo_numerico('frmModificacionPerfil.php',$nuevo_nro_doc, 'nuevo_tipo_doc',0);
	}
	else{	
		$val->val_campo_numerico('frmModificacionPerfil.php',$nro_doc, 'nro_doc',0);
	}
	$val->val_campo_numerico('frmModificacionPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_numerico('frmModificacionPerfil.php',$telefono1,'telefono1',1);
	
	if (trim($direccion) != ''){
		$val->val_campo_letras('frmModificacionPerfil.php',$direccion, 'direccion',0);
	}
	
	$val->val_campo_letras('frmModificacionPerfil.php',$nombres,'nombres',0);
	$val->val_campo_letras('frmModificacionPerfil.php',$apellidos, 'apellidos',1);
	
	
	if (isset($_POST['nuevo_nro_doc'])){
		if ($_SESSION['nro_doc'] != $_POST['nuevo_nro_doc']) {
			$val-> val_perfil_existente ('frmModificacionPerfil.php', $_SESSION['tipo_rol'], $_POST['nuevo_tipo_doc'], $_POST['nuevo_nro_doc']);
		}
	}
	elseif($_SESSION['nro_doc'] != $_POST['nro_doc']) {		
		$val-> val_perfil_existente ('frmModificacionPerfil.php', $_SESSION['tipo_rol'], $_POST['tipo_doc'], $_POST['nro_doc']);
	}

	/*FALTA MAIL*/



	// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();

	$query = "	UPDATE 	perfiles
				SET		cod_tipdoc      =    IFNULL($nuevo_tipo_doc,$tipo_doc), 
						nro_doc         =    IFNULL($nuevo_nro_doc,$nro_doc), 
						nombres			=	'$nombres',
						apellidos		=	'$apellidos',
						fecha_nac		=	'$fecha_nac',
						cod_pais		=	 $pais,
						cod_prov		=	 $provincia,
						cod_loc			=	 $localidad,
						direccion		=	'$direccion',
						num_direccion	=	 $num_direc,
						sexo			=	'$sexo',
						telefono_1		=	 $telefono1,
						direccion_email = 	 $email,
						telefono_2 		=    $telefono2
				WHERE	id_perfil 		=	 $id_perfil
				  
	;" or die(mysql_error());


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
		echo "<h3>El $tipo_rol_desc $nombres $apellidos se actualizo exitosamente.</h3>";	        
		//session_destroy();
		}
	else
		echo "<h3>Ha ocurrido un problema al querer actualizar al $tipo_rol_desc $nombres $apellidos  $id_perfil:<br><br>" . mysql_error()."</h3>";

	//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET



 ?>
	<a href="frmModificacionPerfil.php"><h3>Volver</h3></a>

</body>
</html>