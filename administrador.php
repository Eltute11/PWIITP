<?php 
  session_start();
// session_destroy();
    if(!isset($_SESSION['usuario'])){
      session_destroy();
      header('location: index.php?error=loguearse');
      
    }
	include_once("header.php");
	include_once("aside.php");
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
                        //@session_start();
                          if(isset($_SESSION['usuario'])){
                            echo 'Bienvenido seas ', $_SESSION['usuario'], ' a esta nueva sesion.';
                          }else{
                            #session_start(); // Si no hay sesion definida, comprobar datos de sesion #Ya esta siendo llamada arriba
                            session_destroy();
                            header('location: ../index.php?error=loguearse');
                          }
                        ?>
                      Matias Araus</span>
                      <small class="m-l">Castelar, Buenos Aires</small>
                    </div>
                   
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="wrapper bg-white b-b">
            <ul class="nav nav-pills nav-sm">
              <li class="active"><a href="frmAltaPerfil.php">Alta de perfil</a></li>
              <li><a href="frmConsultarBaja.php">Baja de perfil</a></li>
              <li><a href="frmConsultarPerfil.php">Modificacion de perfil</a></li>
            </ul>
          </div>

        </div>

   </div>

<?php include'footer.php'; ?>