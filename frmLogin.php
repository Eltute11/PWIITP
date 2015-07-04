<?php 
session_start();
	if (isset($_GET['error'])) {
		$error = $_GET['error'];
		switch ($error) {
			case 'campos_vacios': $campos_vacios = "<span class='cd-error-message is-visible'>Campo obligatorio</span><br>";
				break;
			case 'datos_incorrectos': $datos_incorrectos =  "<span class='cd-error-message is-visible'>El usuario y/o contraseña son incorrecto</span><br>";
				break;
			case 'loguearse' : $loguearse = "<span class='cd-error-message is-visible'>No debes acceder sin iniciar sesion</span><br>";
				break;											   	
		}
	}	
	unset($_GET['error']); //Borramos de memoria para optimizar PHP

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


?>
<!-- LogIn -->
								<nav class="main-nav">
									<ul>
										<!-- all your main menu links here -->
										<li><a class="cd-signin" href="#0">Acceso</a></li>
										<li><a class="cd-signup" href="#0">Registrarse</a></li>
									</ul>
								</nav>
								<!-- TODO ESTE NO SE VE HASTA QUE SE PRODUCE EL ONCLICK -->
										<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
											<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
												<ul class="cd-switcher">
													<li><a href="#0">Acceso</a></li>
													<li ><a id="registrarse" href="#0">Registrarse</a></li>
												</ul>

												<div id="cd-login"> <!-- log in form -->
													<form class="cd-form" action="PHP/login.php" method="POST">
														<p class="fieldset">
															
															<label class="image-replace cd-username" for="signup-username">Username</label>
															<input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Usuario" name="user">
															 <span class="cd-error-message">Error message here!</span><!--   MENSAJE DE ERROR, QUE POR DEFAULT ESTA EN HIDDEN, Y POR .JS SE ACTIVA-->
															<?php if(isset($error)){switch($error){case'campos_vacios':echo"$campos_vacios";break;case'datos_incorrectos':echo"$datos_incorrectos";break;case'loguearse':echo"$loguearse";break;}}?>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signin-password">Password</label>
															<input class="full-width has-padding has-border" id="signin-password" type="text" placeholder="Contraseña" name="pass">
															<a href="#0" class="hide-password">Hide</a>
															<span class="cd-error-message">Error message here!</span>
															<?php if(isset($error)){switch($error){case'campos_vacios':echo"$campos_vacios";break;case'datos_incorrectos':echo"$datos_incorrectos";break;case'loguearse':echo"$loguearse";break;}}?>
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
													<!-- <a href="#0" class="cd-close-form">Close</a> -->
												</div> <!-- cd-login -->

												<div id="cd-signup"> <!-- sign up form -->
													<form class="cd-form" name="registrarse">
														<p class="fieldset">
															<label class="image-replace cd-username" for="tipo_doc">Tipo de Documento:</label>
															<?php 
																$formulario = new formulario;
																$formulario->LlenarCombos('cod_tipdoc','descr_tipdoc','TIPOS_DOCUMENTOS','tipo_doc','registrarse');
															 	if ($error_val == 1 && strpos($error_val,'tipo_doc')) {
																	echo "$campo_obligatorio";
																}
															?>
															<span class="cd-error-message">Error message here!</span>
														</p>

														<p class="fieldset">
															<label for="nro_doc" class="image-replace cd-username">Número Documento:</label>
																<input type="text" id="nro_doc" class="full-width has-padding has-border" name="nro_doc" placeholder="Número de Documento" value=<?php validar_var_session('registrarse','nro_doc') ?>>
																<?php 
																 	if ($error_val == 'nro_doc')	{
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
															<input class="full-width has-padding has-border" id="usuario" type="email" placeholder="Nuevo nombre de usuario" value=<?php validar_var_session('registrarse','newUser') ?>>
															<?php 
														    	if ($error_val == 'newUser') {
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
															<input class="full-width has-padding has-border" id="password1" type="text"  placeholder="Contraseña">
															<a href="#0" class="hide-password">Hide</a>
															<span class="cd-error-message">Error message here!</span>

														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="password2">Password</label>
															<input class="full-width has-padding has-border" id="password2" type="text"  placeholder="Repetir Contraseña">
															<a href="#0" class="hide-password">Hide</a>
															<span class="cd-error-message">Error message here!</span>

														</p>

											<!--			<p class="fieldset">
															<input type="checkbox" id="accept-terms">
															<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
														</p> -->

														<p class="fieldset">
															<input class="full-width has-padding" type="submit" value="Crear usuario">
														</p>
													</form>

													<!-- <a href="#0" class="cd-close-form">Close</a> -->
												</div> <!-- cd-signup -->

												<div id="cd-reset-password"> <!-- reset password form -->
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
												</div> <!-- cd-reset-password -->
												<a href="#0" class="cd-close-form">Close</a>
											</div> <!-- cd-user-modal-container -->
										</div> <!-- cd-user-modal -->

										<!-- SE CIERRA TODO EL LOGIN -->