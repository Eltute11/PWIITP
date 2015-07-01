<?php 
 function validar_var_session($formulario,$campo){
	if (isset($_SESSION["$formulario"]["$campo"])){
			echo $_SESSION["$formulario"]["$campo"];
 	} 
 	else{
 		return -1; // Se agrega este RETURN para utilizarlo en frmModificacion.
 	}
}
 ?>
	
