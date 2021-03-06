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
	

	if (isset($_SESSION['msjResultadoOperacion'])) {
		unset($_SESSION['msjResultadoOperacion']);
		unset($_SESSION['tituloResultado']);
	}


	//$formulario = $_POST['alta']; // COMO RECIBIR NOMBRE DE FORMULARIO POR PHP

	$cod_tiporol  = $_POST['tipo_rol'];
	$_SESSION['alta']['tipo_rol']=$cod_tiporol;

	$cod_tipdoc  = $_POST['tipo_doc'];
	$_SESSION['alta']['tipo_doc']=$cod_tipdoc;

	$nro_doc = $_POST['nro_doc'];
	$_SESSION['alta']['nro_doc']=$nro_doc;

	$nombres   = $_POST['nombres'];
	$_SESSION['alta']['nombres']=$nombres;

	$apellidos = $_POST['apellidos'];
	$_SESSION['alta']['apellidos']=$apellidos;

	$fecha_nac = $_POST['fecha_nac'];
	$_SESSION['alta']['fecha_nac']=$fecha_nac;

	$pais = $_POST['pais'];
	$_SESSION['alta']['pais']=$pais;

	$provincia = $_POST['provincia'];
	$_SESSION['alta']['provincia']=$provincia;

	$localidad = $_POST['localidad'];
	$_SESSION['alta']['localidad']=$localidad;

	$direccion = $_POST['direccion'];
	$_SESSION['alta']['direccion']=$direccion;

	$num_direc = $_POST['num_direc']; 
	$_SESSION['alta']['num_direc']=$num_direc;

	$address = $_POST['address'];

	$latitud = $_POST['lat']; 
	// $_SESSION['alta']['lat']=$latitud;

	$longitud = $_POST['long']; 
	// $_SESSION['alta']['long']=$longitud;

	$sexo = $_POST['sexo'];
	$_SESSION['alta']['sexo']=$sexo;

	$telefono1 = $_POST['telefono1'];
	$_SESSION['alta']['telefono1']=$telefono1;

	$telefono2 = $_POST['telefono2'];
	$_SESSION['alta']['telefono2']=$telefono2;

	$email 	   = $_POST['email']; 
	$_SESSION['alta']['email']=$email;

	if ($cod_tiporol !=3) {
		$newUser  = $_POST['newUser'];
		$_SESSION['alta']['newUser']=$newUser;

		$pass1 = $_POST['pass1'];
		$_SESSION['alta']['pass1']=$pass1;

		$pass2 = $_POST['pass2'];
		$_SESSION['alta']['pass2']=$pass2; 
	}
	include ("clases.php");
	
	$val = new validacion;
			
	/*EL METODO val_campo_obligatorio RECIBE:
	  1 - Pagina a la que volveria si hay un error.
	  2 - Variable a validar siesta vacia
	  3 - Nombre de la variable.
	  4 - 1 si es el ultimo campo a validar. 0 en caso contrario.
	*/

	$val->val_perfil_existente ('../frmAltaPerfil.php', $cod_tiporol, $cod_tipdoc, $nro_doc); 

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
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$address, 'address',0);	
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$telefono1,'telefono1',0);
	if ($email != '') {
		$val->val_campo_mail('../frmAltaPerfil.php',$mail,'email',0);
	}
	$val->val_campo_obligatorio('../frmAltaPerfil.php',$sexo,'sexo',1);

	

	if ($cod_tiporol != 3) {
		$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['newUser'],'newUser',0);
		$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['pass1'], 'pass1', 0);
		$val->val_campo_obligatorio('../frmAltaPerfil.php',$_POST['pass2'], 'pass2',1);
	}
		
	if (trim($telefono2) != ''){
		$val->val_campo_numerico('../frmAltaPerfil.php',$telefono2,'telefono2',0);
	}

	$val->val_campo_numerico('../frmAltaPerfil.php',$nro_doc, 'nro_doc',0);
	$val->val_campo_numerico('../frmAltaPerfil.php',$num_direc, 'num_direc',0);
	$val->val_campo_numerico('../frmAltaPerfil.php',$telefono1,'telefono1',1);
	
	if (trim($direccion) != ''){
		$val->val_campo_letras('../frmAltaPerfil.php',$direccion, 'direccion',0);
	}
	
	$val->val_campo_letras('../frmAltaPerfil.php',$nombres,'nombres',0);
	$val->val_campo_letras('../frmAltaPerfil.php',$apellidos, 'apellidos',1);
	
	if ($cod_tiporol != 3) {
		$val->val_usuario('../frmAltaPerfil.php', $newUser, 'newUser');
		$val->val_passwords('../frmAltaPerfil.php',$pass1, $pass2);
	}


	// CONEXION A BASE DE DATOS
	$base = new BD;
	$conexion = $base->Conectar();
 	
 	// Si estos valores no se ingresaron, se setea nulos ya que los acepta en las tabla.
	
	if (trim($telefono2) ==''){
	$telefono2 = "NULL";
	}

	if (trim($email) ==''){
		$email = "NULL";
	}
	else{
		$email = "'$email'"; //Agrego este tratamiento para que pueda enviarlo como string con '' o NULL sin ''
	}
 	
	$query  = "SELECT IFNULL(MAX(id_perfil),0) +1 FROM PERFILES";
	$result = mysql_query($query);


	while($line = mysql_fetch_array($result)) {
	    		$id_perfil = $line[0]; //line es el registro, 0 es el numero de columna. 0 es la primera y unica en este caso
	}

	$_SESSION['alta']['id_perfil'] = $id_perfil ; // Guardo el perfil para ser utilizado en generarPrimerFactura.php

	$query = "INSERT INTO PERFILES (cod_tiporol,          id_perfil,            cod_tipdoc,           
									nro_doc,              nombres,              apellidos,            
									fecha_nac,            cod_pais,             cod_prov,             
									cod_loc,              direccion,            num_direccion,        
									latitud,              longitud,             sexo,                 
									telefono_1,           telefono_2,           direccion_email )

							VALUES ($cod_tiporol,    $id_perfil,      $cod_tipdoc,     
									$nro_doc,       '$nombres',      '$apellidos',    
								   '$fecha_nac',     $pais,           $provincia,      
									$localidad,     '$direccion',     $num_direc,      
								   '$latitud',      '$longitud',     '$sexo'	,       
									$telefono1,      $telefono2,      $email  );	" or die(mysql_error());

	
	mysql_query($query);

	
	 switch($cod_tiporol) 
		 		 {	
		 		 case 1 :
		             $tipo_rol_desc = 'administrador';
		             break;
		         case 2 :
		             $tipo_rol_desc = 'monitoreador';
		             break;
		         case 3 :
		             $tipo_rol_desc = 'cliente';
		             break;
		        }

$_SESSION['tituloResultado'] = "Alta de perfil"; // Guardo en esta variable session el titulo que se va a mostrar en la pagina resultadoOperacion.php
		        
	if (mysql_affected_rows() == 1) {
		if ($cod_tiporol!=3){
			$_SESSION['msjResultadoOperacion'] = "El $tipo_rol_desc  $nombres $apellidos ";      
		}
		else{
			$_SESSION['msjResultadoOperacion'] = "El $tipo_rol_desc $nombres $apellidos se dio de Alta exitosamente.";
			 header("location: ../resultadoOperacion.php");
		}	

	}
	else{
		$_SESSION['msjResultadoOperacion'] = "Ha ocurrido un problema al querer dar de alta al $tipo_rol_desc $nombres $apellidos:<br><br>" . mysql_error();
		header("location: ../resultadoOperacion.php?errorOperacion=1&volverPagina=frmAltaPerfil");
	}
	//PRINT "<br>Registros insertados: ". mysql_affected_rows(); // mysql_affected_rows(); devuelve la cantidad de filas afectadas. EN EL ULTIMO UPDATE,DELETE,INSET
	

	if ($cod_tiporol!=3) { 
		$passEncrip = md5($pass1);
		

		$sMySQL = "INSERT INTO USUARIOS (cod_tiporol, id_perfil, usuario, password)
				   VALUES ( $cod_tiporol ,$id_perfil , '$newUser', '$passEncrip')";

		$rQuery = mysql_query($sMySQL);


		if (mysql_affected_rows() == 1) {
			  $_SESSION['msjResultadoOperacion'] = $_SESSION['msjResultadoOperacion']." con usuario '$newUser' se dio de alta exitosamente.";
			  header("location: ../resultadoOperacion.php");
			   
		}
		else{
			$_SESSION['msjResultadoOperacion'] = "Ha ocurrido un problema al querer dar de alta al usuario $newUser :".mysql_error();	
			header("location: ../resultadoOperacion.php?errorOperacion=1&volverPagina=frmAltaPerfil");
		}
	
	}
	 


 ?>
  
