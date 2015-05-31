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
?>