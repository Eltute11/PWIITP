<?php 
session_start();

	include_once ("php/clases.php");
	include_once ("php/funciones.php");

	$base = new BD;
	$conexion = $base->Conectar();

	if (isset($_GET['error-val'])){
		$error_val = $_GET['error-val'];
	}
	else
	{
		$error_val ='';
	}

	if (isset($_GET['nError'])) {
	$nError = $_GET['nError'];
	switch ($nError) {
		case 1: $campo_obligatorio = "<span class='cd-error-message is-visible'>Campo obligatorio </span>";
				break;
		case 2: $solo_numeros =  "<span class='cd-error-message is-visible'>Solo numeros</span>";		
				break;		
		case 4: $usuario_existente = "<span class='cd-error-message is-visible'>El usuario ya existe </span>";	
				break;
		case 5: $cliente_inexistente = "<span class='cd-error-message is-visible'>Cliente inexistente</span>";	
				break;	
		case 6: $perfil_existente =  "<span class='cd-error-message is-visible'> <h3>El perfil que esta intentando dar de alta ya existe </h3></span>";		
				break;
		case 8: $pass_error =  "<span class='cd-error-message is-visible'>Las contraseñas no coinciden</span>";		
				break;
		case 9: $datos_incorrectos =  "<span class='cd-error-message is-visible'>El usuario y/o contraseña son incorrecto</span><br>";
				break;	
		case 10: $loguearse =  "<span class='cd-error-message is-visible'>Debes iniciar sesion para poder acceder</span><br>";
				break;				
		
	}
	
}
else{
	$nError = 0;
}


	?>
	
	<nav class="main-nav">
		<ul>
			<li><a class="cd-signin" href="#0">Acceso</a></li>
			<li><a class="cd-signup" href="#0">Registrarse</a></li>
		</ul>
	</nav>
	<!-- TODO ESTE NO SE VE HASTA QUE SE PRODUCE EL ONCLICK -->
	<div class="cd-user-modal"> 
		<div class="cd-user-modal-container"> 
			<ul class="cd-switcher">
				<li><a href="#0">Acceso</a></li>
				<li ><a id="registrarse" href="#0">Registrarse</a></li>
			</ul>


<!-- ========================================= ACCESO  ========================================= -->
			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form" action="php/login.php" method="POST">
					<p class="fieldset">

						<label class="image-replace cd-username" for="signup-username">Username</label>
						<input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Usuario" name="user" value=<?php validar_var_session('acceso','user') ?>>
						<span class="cd-error-message">Error message here!</span><!--   MENSAJE DE ERROR, QUE POR DEFAULT ESTA EN HIDDEN, Y POR .JS SE ACTIVA-->
						<?php if (strpos($error_val,'user') || $nError == 10){
								switch($nError){
								case 1: echo "$campo_obligatorio";
										break;
								case 9: echo"$datos_incorrectos";
										break;
								case 10: echo "$loguearse ";
										 break;		
								}
							}
						?>
						</p>

						<p class="fieldset">
							<label class="image-replace cd-password" for="signin-password">Password</label>
							<input class="full-width has-padding has-border" id="signin-password" type="text" placeholder="Contraseña" name="pass" value=<?php validar_var_session('acceso','pass') ?>>
							<a href="#0" class="hide-password">Hide</a>
							<span class="cd-error-message">Error message here!</span>
							<?php if  (strpos($error_val,'pass') || $nError == 10){
									switch($nError){
									case 1: echo "$campo_obligatorio";
											break;
									case 9: echo"$datos_incorrectos";
											break;
									case 10: echo "$loguearse ";
										 break;				
									}
								}
							?>
							</p>
							
							<p class="fieldset">
								<input type="checkbox" id="remember-me" name="sesion" value="1">
								<label for="remember-me">Recuerdame</label>
							</p>

							<p class="fieldset">
								<input class="full-width" type="submit" value="Ingresar">
							</p>
						</form>

						<p class="cd-form-bottom-message"><a href="#0">Olvido su contraseña?</a></p>
					</div> <!-- cd-login -->

<!-- ================================= REGISTRARSE  ================================ -->

					<div id="cd-signup"> <!-- sign up form -->
						<form class="cd-form" action="php/aplicarAltaUsuarioCliente.php" method="POST">
							<p class="fieldset">
								<label class="image-replace cd-username" for="tipo_doc">Tipo de Documento:</label>
								<?php 
								$formulario = new formulario;
								$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc','alta_usuario_cliente');
								if ($nError == 1 && strpos($error_val,'tipo_doc')) {
									echo "$campo_obligatorio";
								}
								?>
								<span class="cd-error-message">Error message here!</span>
							</p>

							<p class="fieldset">
								<label for="nro_doc" class="image-replace cd-username">Número Documento:</label>
								<input type="text" id="nro_doc" class="full-width has-padding has-border" name="nro_doc" placeholder="Número de Documento" value=<?php validar_var_session('alta_usuario_cliente','nro_doc') ?>>
								<?php 
								if  (strpos($error_val,'nro_doc')){
									switch ($nError) {
										case 1: echo "$campo_obligatorio";
										break;
										case 2: echo "$solo_numeros";
										break;	
										case 5: echo "$cliente_inexistente";
										break;			
									}
								}

								?>	
								<span class="cd-error-message">Error message here!</span>
							</p>

							<p class="fieldset">
								<label class="image-replace cd-username" for="usuario">Usuario</label>
								<input class="full-width has-padding has-border" id="usuario" name="nuevoUsuario" placeholder="Nuevo nombre de usuario" value=<?php validar_var_session('alta_usuario_cliente','nuevoUsuario') ?>>
								<?php 
								if  (strpos($error_val,'nuevoUsuario')){
									switch ($nError) {
										case 1: echo "$campo_obligatorio";
										break;
										case 4: echo "$usuario_existente";
										break;	
									}
								}	
								?>
								<span class="cd-error-message">Error message here!</span>

							</p>

							<p class="fieldset">
								<label class="image-replace cd-password" for="password1">Password</label>
								<input class="full-width has-padding has-border" id="password1" name="pass1" type="text"  placeholder="Contraseña" value=<?php validar_var_session('alta_usuario_cliente','pass1') ?>>
								<a href="#0" class="hide-password">Hide</a>
								<span class="cd-error-message">Error message here!</span>
								<?php 
							    	if ($nError == 1 && strpos($error_val,'pass1')) {
										echo "$campo_obligatorio";
									}
							     ?>

							</p>

							<p class="fieldset">
								<label class="image-replace cd-password" for="password2">Password</label>
								<input class="full-width has-padding has-border" id="password2" name="pass2" type="text"  placeholder="Repetir Contraseña" value= <?php validar_var_session('alta_usuario_cliente','pass2') ?>>
								<a href="#0" class="hide-password">Hide</a>
								<span class="cd-error-message">Error message here!</span>
								<?php 
								    if (strpos($error_val,'pass2') || $nError == 7 ){
									 	switch ($nError) {
									 		case 1: echo "$campo_obligatorio";
									 				break;
									 		case 7: echo "$pass_error";
									 				break;	
									 	}
									 }
						    	?>

							</p>
							<p class="fieldset">
								<input class="full-width has-padding" type="submit" value="Crear usuario">
							</p>
						</form>
					</div> <!-- cd-signup -->

<!-- ================================ OLVIDO SU CONTRASEÑA ================================ -->
					<div id="cd-reset-password"> 
						<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

						<form class="cd-form">
							<p class="fieldset">
								<label class="image-replace cd-email" for="reset-email">E-mail</label>
								<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
								<span class="cd-error-message">Error message here!</span>
							</p>

							<p class="fieldset">
								<input class="full-width has-padding" type="submit" value="Reset password">
							</p>
						</form>

						<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
					</div> 
					<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->

<!-- SE CIERRA TODO EL LOGIN -->