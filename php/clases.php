<?php

date_default_timezone_set("America/Argentina/Buenos_Aires");
class BD{
	protected $Servidor;
	protected $BaseDatos;
	protected $Usuario;
	protected $Pass;

	function Conectar() {
		$this->Servidor = "localhost";
		$this->BaseDatos = "Seguridadlandia";
		$this->Usuario = "root";
		$this->Pass = "";

			$this->IdConexion = mysql_connect($this->Servidor, $this->Usuario, $this->Pass);
			if (!$this->IdConexion) {
				$this->Error_ = "Fallo al intentar conectar";
				exit ;
			}
	
			//Si no ha habido ningún fallo, seleccionamos la Base de Datos
			if (!@mysql_select_db($this->BaseDatos, $this->IdConexion)) {
				$this->Error_ = "No se ha podido abrir la Base de Datos " . $this->BaseDatos;
				return 0;
			}		
		return $this->IdConexion;	
		}	
}		



class formulario{

	protected $campo_cod;
	protected $campo_descr;
	protected $tabla;
	protected $name;

	public function LlenarCombos ($cod, $descr, $table, $name,$form){
			$this->campo_cod = $cod;
			$this->campo_descr = $descr;
			$this->tabla = $table;
			$this->name = $name;
			$this->form = $form;
			
			$sMySQL = "SELECT $this->campo_cod, $this->campo_descr FROM $this->tabla ORDER BY $this->campo_descr ASC";
			$rQuery =  mysql_query ($sMySQL);
			
			echo "<select name='$this->name' id='$this->name' class='form-control'>";
			echo  "<option></option>";				
				while ($resultado = mysql_fetch_array($rQuery)) {
					if (isset($_SESSION["$this->form"]["$this->name"])){ //Este tratamiento se agrego para que si selecciono un valor, y por alguna validacion no se dio de alta el perfil, guarde el valor seleccionado en el combo.
						if ($_SESSION["$this->form"]["$this->name"] == $resultado[$cod] ){
							echo "<option value= $resultado[$cod] selected> $resultado[$descr]</option>";
						}	
						else{
							echo "<option value= $resultado[$cod]> $resultado[$descr]</option>";
						}

					}		
					else{	
					echo "<option value= $resultado[$cod]> $resultado[$descr]</option>";
					}
				}
			//validar_var_session("$name");
			

			echo "</select>";
		}

	public function ObtenerDatosBD ($cod, $descr, $table, $name, $valor){
		$this->campo_cod = $cod;
		$this->campo_descr = $descr;
		$this->tabla = $table;
		$this->name = $name;	
		$this->valor = $valor;

	   $sMySQL = "SELECT $this->campo_cod, $this->campo_descr FROM $this->tabla ORDER BY $this->campo_descr ASC";

	   $rQuery = mysql_query($sMySQL);

	   echo "<select name='$this->name' id='$this->name' class='form-control'>";
			echo  "<option></option>";				
				while ($resultado = mysql_fetch_array($rQuery)) {
						if ( $this->valor== $resultado[$cod] ){
							echo "<option value= $resultado[$cod] selected> $resultado[$descr]</option>";
						}	
						else{
							echo "<option value= $resultado[$cod]> $resultado[$descr]</option>";
						}
				}
			//validar_var_session("$name");
			echo "</select>";
	}

}
class acceso{
		
	protected $user;
	protected $pass;
	protected $cookie;

	public function login($usuario, $password, $cookie){
		$this->user = $usuario;
		$this->pass = $password;
		$this->cookie = $cookie;

		$existe = 0;  // Seteo en 0, ya que requiere de un valor para realizar el IF en caso de que no encuetre ningun usuario.

		$query = "SELECT cod_tiporol FROM USUARIOS WHERE usuario =  '$this->user' AND password = '$this->pass'";
		$consulta = mysql_query($query);

		while($line = mysql_fetch_array($consulta)) {
      		$existe = $line[0];
		}

		if ($existe==1 ||  $existe==2 || $existe==3){
			session_start(); //Crea una nueva sesion cuando no haya ninguna activa. En caso de que ya estemos 					   logeado, controla los datos.
   			$_SESSION['usuario'] = $this->user;

 			if ($this->cookie == 1) { // Si el checkbox esta activado
   			 ini_set(session.cookie_lifetime,time() + (60*60));//Seteamos el tiempo que durara la sesion
   			} 			
   
		   switch ($existe) {
		      // case 1: header('location: ../profile.php');//Redirecciona la pagina
		   		case 1: header('location: ../administrador.php');//Redirecciona la pagina
		      		  break;	
		      case 2: header('location: ../monitoreador.php');//Redirecciona la pagina
		      		  break;	
		      case 3: header('location: ../cliente.php');//Redirecciona la pagina
				      break;	
		    }
 		}

 		else{	
 				header('location: ../index.php?nError=9&error-val=-user-pass');
 				exit ();
		  				;
		}

	} // Cerramos el metodo login

} // Cerramos la clase acceso



class validacion{
	// ERROR 1: CAMPO OBLIGATORIOO
	// ERROR 2: SOLO NUMEROS
	// ERROR 3: SOLO LETRAS
	// ERROR 4: USUARIO EXISTENTE
	// ERROR 5: CLIENTE INEXISTENTE
	// ERROR 6: PERFIL EXISTENTE
	// ERROR 7: CLIENTE INEXISTENTE
	// ERROR 8: LAS CONTRASEÑAS NO COINCIDEN
	// ERROR 9: MAIL INCORRECTO

	
	protected $radio;
	protected $combo;
	protected $num;
	protected $car;
	protected $date;
	protected $mail;
	public $nError;
	

	public function val_campo_obligatorio ($pagina,$var_campo,$nombre_campo,$es_ultimo){
		$this->var_campo = $var_campo;
		$this->nombre_campo=$nombre_campo;
		$this->pagina = $pagina;
		$this->es_ultimo = $es_ultimo;


		if (!isset( $_SESSION['nError'])){
			$_SESSION['nError'] = 0;
		}

		if (empty ($this->var_campo) ) {

			$_SESSION['nError'] = 1;
			if (!isset($_SESSION['sCamposVal'])){
				 $_SESSION['sCamposVal'] ="-$this->nombre_campo-";
			}	
			 	 else{
			 	 	$_SESSION['sCamposVal'] = $_SESSION['sCamposVal'].$this->nombre_campo.'-';
			 	 }	
			 }
		if ($this->es_ultimo == 1 && $_SESSION['nError'] == 1){
				$sCamposVal =$_SESSION['sCamposVal']; 
				$nError = 1;
				header("location: $this->pagina?nError=$nError&error-val=$sCamposVal");
				exit();
			}

	}



	public function val_campo_numerico ($pagina,$var_campo_numerico, $nombre_campo,$es_ultimo){
		$this->var_campo_numerico = $var_campo_numerico;
		$this->nombre_campo=$nombre_campo;
		$this->pagina = $pagina;
		$this->es_ultimo = $es_ultimo;


		if (!isset( $_SESSION['nError'])){
			$_SESSION['nError'] = 0;
		}

		if (!is_numeric($this->var_campo_numerico)) {

			$_SESSION['nError'] = 2;
			if (!isset($_SESSION['sCamposVal'])){
				 $_SESSION['sCamposVal'] ="-$this->nombre_campo-";
			}	
			 	 else{
			 	 	$_SESSION['sCamposVal'] = $_SESSION['sCamposVal'].$this->nombre_campo.'-';
			 	 }	
			 }
		if ($this->es_ultimo == 1 && $_SESSION['nError'] == 2){
				$sCamposVal =$_SESSION['sCamposVal']; 
				$nError = 2;
				header("location: $this->pagina?nError=$nError&error-val=$sCamposVal");
				exit();
			}

	}


	public function val_campo_letras ($pagina,$var_campo_letras, $nombre_campo,$es_ultimo){
		$this->var_campo_letras = $var_campo_letras;
		$this->nombre_campo=$nombre_campo;
		$this->pagina = $pagina;
		$this->es_ultimo = $es_ultimo;


		if (!isset( $_SESSION['nError'])){
			$_SESSION['nError'] = 0;
		}

		if (!preg_match("/^[a-zA-Z ]*$/",$this->var_campo_letras)) {

			$_SESSION['nError'] = 3;
			if (!isset($_SESSION['sCamposVal'])){
				 $_SESSION['sCamposVal'] ="-$this->nombre_campo-";
			}	
			 	 else{
			 	 	$_SESSION['sCamposVal'] = $_SESSION['sCamposVal'].$this->nombre_campo.'-';
			 	 }	
			 }
		if ($this->es_ultimo == 1 && $_SESSION['nError'] == 3){
				$sCamposVal =$_SESSION['sCamposVal']; 
				$nError = 3;
				header("location: $this->pagina?nError=$nError&error-val=$sCamposVal");
				exit();
			}

	}

	public function val_campo_mail ($pagina,$mail,$nombre_campo,$es_ultimo){
		$this->mail = $mail;
		$this->nombre_campo=$nombre_campo;
		$this->pagina = $pagina;
		$this->es_ultimo = $es_ultimo;


		if (!isset( $_SESSION['nError'])){
			$_SESSION['nError'] = 0;
		}

		if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {

			$_SESSION['nError'] = 9;
			if (!isset($_SESSION['sCamposVal'])){
				 $_SESSION['sCamposVal'] ="-$this->nombre_campo-";
			}	
			 	 else{
			 	 	$_SESSION['sCamposVal'] = $_SESSION['sCamposVal'].$this->nombre_campo.'-';
			 	 }	
			 }
		if ($this->es_ultimo == 1 && $_SESSION['nError'] == 9){
				$sCamposVal =$_SESSION['sCamposVal']; 
				$nError = 9;
				header("location: $this->pagina?nError=$nError&error-val=$sCamposVal");
				exit();
			}

	}

	public function val_usuario ($pagina,$usuario, $nombre_campo){
		$this->pagina = $pagina;
		$this->usuario=$usuario;
		$this->nombre_campo =$nombre_campo;
		
		$existe = 0;

		$sMySQL = "SELECT 1 FROM USUARIOS WHERE usuario = '$this->usuario'";
		$rQuery = mysql_query($sMySQL);

		if($rQuery == FALSE) { 
    		die(mysql_error()); 
		}
		
		while($line = mysql_fetch_array($rQuery)) {
				$existe = $line[0];
			}
		
		
		if ($existe == 1){ //1- EXISTE Y NO TIENE QUE DEJAR DAR DE ALTA
			$nError = 4;
			header("location: $this->pagina?nError=$nError&error-val=-$this->nombre_campo");
			exit();
		}
 	}

	public function val_cliente_inexistente ($pagina,$cod_tipdoc, $nro_doc, $nombre_campo){
		$this->pagina = $pagina;
		$this->cod_tipdoc = $cod_tipdoc;
		$this->nro_doc = $nro_doc;
		$this->nombre_campo =$nombre_campo;

		$sMySQL = "SELECT id_perfil FROM PERFILES WHERE cod_tiporol = 3 AND cod_tipdoc = $this->cod_tipdoc AND nro_doc = $this->nro_doc";

		$rQuery = mysql_query($sMySQL);
		
		while($line = mysql_fetch_array($rQuery)) {
				$_SESSION['id_perfil'] = $line[0];
				$id_perfil = $_SESSION['id_perfil'];
			}
		 	
		if (!isset($id_perfil)){
			$nError = 5;
			header("location: $this->pagina?nError=$nError&error-val=-$nombre_campo");
			exit();
		}

	}
		public function val_perfil_existente ($pagina, $tipo_rol, $cod_tipdoc, $nro_doc){
		$this->pagina = $pagina;
		$this->tipo_rol =  $tipo_rol;
		$this->cod_tipdoc = $cod_tipdoc;
		$this->nro_doc = $nro_doc;
	
		$base = new BD;
		$conexion = $base->Conectar();
		
		$sMySQL = "SELECT id_perfil 
			   FROM PERFILES 
			   WHERE cod_tiporol = $this->tipo_rol  
			   	 AND cod_tipdoc = $this->cod_tipdoc 
			   	 AND nro_doc = $this->nro_doc; ";
		
		
		$rQuery = mysql_query($sMySQL);
		
		
		while($line = mysql_fetch_array($rQuery)) {
				$id_perfil = $line[0];
				// $existe = 1;
			}

		if (isset($id_perfil)){
			$nError = 6;
			header("location: $this->pagina?nError=$nError");
			exit();
		}
	
		}

		public function val_perfil_inexistente ($pagina, $tipo_rol, $cod_tipdoc, $nro_doc){
		$this->pagina = $pagina;
		$this->tipo_rol =  $tipo_rol;
		$this->cod_tipdoc = $cod_tipdoc;
		$this->nro_doc = $nro_doc;
	
		$base = new BD;
		$conexion = $base->Conectar();
		
		$sMySQL = "SELECT id_perfil 
				   FROM PERFILES 
				   WHERE cod_tiporol = $this->tipo_rol  
				   	 AND cod_tipdoc = $this->cod_tipdoc 
				   	 AND nro_doc = $this->nro_doc; ";
		
		
		$rQuery = mysql_query($sMySQL);
		
		
		while($line = mysql_fetch_array($rQuery)) {
				$id_perfil = $line[0];
				// $existe = 1;
			}

		if (!isset($id_perfil)){
			$nError = 7;
			header("location: $this->pagina?nError=$nError");
			exit();
		}
	
		}

		

		public function val_passwords ($pagina, $pass1, $pass2){
		$this->pagina = $pagina;
		$this->pass1 = $pass1;
		$this->pass2 = $pass2;
 
		if ($this->pass1 != $this->pass2){
			$nError = 8;
			header("location: $this->pagina?nError=$nError");
			exit();
		}


		}




}

?>

