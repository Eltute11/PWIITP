<?php

include_once ("php/clases.php");
include_once ("php/funciones.php");

session_start();
include_once('header.php');

if (isset($_SESSION['sCamposVal'])) { //VACIO VARIABLES SI FUERON SETEADAS, PARA REALIZAR UNA NUEVA VALIDACION.
	unset($_SESSION['sCamposVal']);
	}

if (isset($_SESSION['nError'])) {
	unset($_SESSION['nError']);
}

if (isset($_POST['tipo_rol'])){
		$_SESSION['tipo_rol']=$_POST['tipo_rol'];
}

if (isset($_POST['tipo_doc'])){
		$_SESSION['tipo_doc']=$_POST['tipo_doc'];
}

if (isset($_POST['nro_doc'])){
		$_SESSION['nro_doc']=$_POST['nro_doc'];
}

if (isset($_SESSION['tipo_doc'])){
		$tipo_doc = $_SESSION['tipo_doc'];	
	}	

	if (isset($_SESSION['nro_doc'])){
		$nro_doc = $_SESSION['nro_doc'];	
	}	

	if (isset($_SESSION['tipo_rol'])){
		$tipo_rol = $_SESSION['tipo_rol'];	
	}	


	
if (isset($_POST['valido_perfil'])){		
	$val = new validacion;
	$val->val_campo_obligatorio('frmConsultarBaja.php', $tipo_rol,'tipo_rol',0);
	$val->val_campo_obligatorio('frmConsultarBaja.php', $tipo_doc,'tipo_doc',0);
	$val->val_campo_obligatorio('frmConsultarBaja.php', $nro_doc, 'nro_doc',1);

	$val->val_perfil_inexistente ('frmConsultarBaja.php', $tipo_rol, $tipo_doc, $nro_doc);
}


include_once ('aside.php'); 

 if(!isset($_SESSION['usuario'])){
 			session_destroy();
 			header('location: index.php?error=loguearse');
			
 }


$base = new BD;
$conexion = $base->Conectar();

switch($tipo_rol) 
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


 ?>

 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<!-- Titulo -->
	   	<div class="bg-light lter b-b wrapper-md">
	  		<h1 class="m-n font-thin h3">Baja perfil <small> Datos del <?php echo $tipo_rol_desc ?> a dar de baja</small></h1>
		</div>
		<div class="wrapper-md" ng-cotroller="FormDemoCtrl">		
		    <div class="panel panel-default">
		    <!-- Formulario -->
		    <div class="panel-body">
			<form action='frmBajaPerfil.php' class="form-horizontal" method='POST'>
		
	<?php 
	 
	
		$cMySQL = "SELECT A.nombres,      A.apellidos,      A.id_perfil,
						  B.descr_tipdoc	    		   

		  		   FROM PERFILES A
		  		   INNER JOIN TIPOS_DOCUMENTOS B ON A.cod_tipdoc = B.cod_tipdoc
		  		   WHERE A.cod_tiporol = $tipo_rol 
		  		   	 AND A.cod_tipdoc  = $tipo_doc
		  		   	 AND A.nro_doc     = $nro_doc ;"or die(mysql_error());

	    $query = mysql_query($cMySQL);

		// $resultado = mysql_num_rows($query);

		// if ($resultado == 0){
		// 	header('location: frmConsultarBaja.php?nError=7');
		// 	exit();
		// }


	   	while ($line = mysql_fetch_array($query)){
	   		$_SESSION['nombres'] 		= $line['nombres'];
	        $_SESSION['apellidos'] 		= $line['apellidos'];
	        $_SESSION['descr_tipdoc'] 	= $line['descr_tipdoc'];
	        $_SESSION['id_perfil']		= $line['id_perfil'];
	    }

	    //Guardo en variables de SESSION para poder utilizarlas en la pagina aplicarBajaPerfil.
	    $nombres = $_SESSION['nombres'];
	    $apellidos = $_SESSION['apellidos'];
	    $descr_tipdoc = $_SESSION['descr_tipdoc'];
	    $id_perfil = $_SESSION['id_perfil'];


	    ?>

	   <form action='php/aplicarBajaPerfil.php' method='POST'>
	   <!-- ID de Perfil -> para luego tomarlo en el UPDATE -->
	    
	   <input type="hidden" name="id_perfil" value=<?php echo $id_perfil ?>> 

	    <div class="line line-dashed b-b line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nombres">Nombres:</label>
				<div class="col-sm-10">
					<input type="text" name="nombres" id="nombres" class='form-control' value=<?php echo $nombres ?>> 
				 </div>
		 </div>
		<div class="line line-dashed b-b line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="apellidos">Apellidos:</label>
				<div class="col-sm-10">
					<input type="text" name="apellidos" id="apellidos" class='form-control' value=<?php echo $apellidos ?>> 
				</div>
		 </div>

		<div class="line line-dashed b-b line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tipo_doc">Tipo de Documento:</label>
				<div class="col-sm-10">
					<input type="text" name="tipo_doc" id="tipo_doc" class='form-control' value=<?php echo $descr_tipdoc ?>> 
				</div>
		 </div>
		
		<div class="line line-dashed b-b line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nro_doc">Número de Documento:</label>
				<div class="col-sm-10">
					<input type="text" name="nro_doc" id="nro_doc" class='form-control' value=<?php echo $nro_doc ?>> 
				</div>
		 </div>

		<input type="submit" value="Dar de baja" class="btn btn-info">
		<br><br>
		<a class="btn btn-default" href="administrador.php">Volver</a>

		</form>
	</body>
</html>
<?php include'footer.php' ?>