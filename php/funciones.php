<?php 
 function validar_var_session($campo){
	if (isset($_SESSION["$campo"])){
			echo $_SESSION["$campo"];
 	} 
 	else{
 		return -1; // Se agrega este RETURN para utilizarlo en frmModificacion.
 	}
}
 ?>
	
