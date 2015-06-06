<?php

date_default_timezone_set("America/Argentina/Buenos_Aires");
class BD {

	function BD() {	
		$this->Servidor = "localhost";
		$this->BaseDatos = "Seguralandia";
		$this->Usuario = "root";
		$this->Pass = "";
	}
	
	function Conectar() {
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

class acceso{
		
	protected $user;
	protected $pass;

	public function __construct($usuario, $password){
		$this->user = $usuario;
		$this->pass = $password;	
	}

	public function login(){
		$base = new BD;
		$base->Conectar();

		$query = "SELECT cod_tipper FROM usuarios WHERE usuario =  '$this->user' AND password = '$this->pass'";
		$consulta = mysql_query($query);

		while($line = mysql_fetch_array($consulta)) {
      		$existe = $line[0];
		}

		if ($existe==1 ||  $existe==2 || $existe==3){
			session_start(); //Crea una nueva sesion cuando no haya ninguna activa. En caso de que ya estemos logeado, controla los datos.
   			$_SESSION['usuario'] = $this->user;

 			if ($_POST['sesion'] == 1) { // Si el checkbox esta activado
   			 ini_set(session.cookie_lifetime,time() + (60*60));//Seteamos el tiempo que durara la sesion
   			} 			
   
		   switch ($existe) {
		      case 1: header('location: frmRegistro-Administrador.php');//Redirecciona la pagina
		      case 2: header('location: monitoreador.php');//Redirecciona la pagina
		      case 3: header('location: clientes.php');//Redirecciona la pagina
		    }
 		}else{
		  header('location: index.php?error=datos_incorrectos');
		}

	} // Cerramos el metodo login

} // Cerramos la clase acceso

?>

