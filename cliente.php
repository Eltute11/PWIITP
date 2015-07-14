<?php 
  session_start();
// session_destroy();

    if (isset($_SESSION['alta_usuario_cliente']['nuevoUsuario'])){
         $_SESSION['usuario'] = $_SESSION['alta_usuario_cliente']['nuevoUsuario']; //Se guarda en variable de session usuario, el usuario del cliente al ser creado 
    }


    if(!isset($_SESSION['usuario'])){
      session_destroy();
      header('location: index.php?nError=10');
      
    }
	
  
  include_once("header.php");
	include_once("aside_cliente.php");
  include_once("php/clases.php");

  $base = new BD;
  $conexion = $base->Conectar();


?>

 <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="col">
          <div style="background:url(img/c4.jpg) center center; background-size:cover">
            <div class="wrapper-lg bg-white-opacity">
              <div class="row m-t">
                <div class="col-sm-7">
                  <a href class="thumb-lg pull-left m-r">
                    <img src="img/a0.jpg" class="img-circle">
                  </a>
                  <div class="clear m-b">
                    <div class="m-b m-t-sm">
                      <span class="h3 text-black">
                       <?php  
                           echo 'Bienvenido seas ', $_SESSION['usuario'], ' a esta nueva sesion.';

                            $usuario = $_SESSION['usuario'];

                            $query  = "SELECT A.nombres, A.apellidos,  D.descr_loc, C.descr_prov,A.id_perfil
                                       FROM PERFILES A 
                                       INNER JOIN USUARIOS B ON A.id_perfil = B.id_perfil
                                       INNER JOIN PROVINCIAS C ON A.cod_prov = C.cod_prov
                                       INNER JOIN LOCALIDADES D ON A.cod_loc = D.cod_loc
                                       WHERE B.usuario = '$usuario'";
                            
                            $result = mysql_query($query);


                            while($line = mysql_fetch_array($result)) {
                              $nombres = $line['nombres']; 
                              $apellidos = $line['apellidos']; 
                              $descr_loc = $line['descr_loc']; 
                              $descr_prov = $line['descr_prov']; 
                              $_SESSION['cliente']['id'] = $line['id_perfil'];
                            } 
                           

                           echo "<br>$nombres $apellidos <small class='m-l'>$descr_loc, $descr_prov</small>";
                          
                        ?>
                      
                    </div>
                   
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="wrapper bg-white b-b">
          <!--   <ul class="nav nav-pills nav-sm">
              <li class="active"><a href="frmAltaPerfil.php">Alta de perfil</a></li>
              <li><a href="frmConsultarBaja.php">Baja de perfil</a></li>
              <li><a href="frmConsultarPerfil.php">Modificacion de perfil</a></li>
            </ul> -->
          </div>

        </div>

   </div>

<?php include'footer.php'; ?>