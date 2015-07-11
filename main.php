<!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
          <div class="aside-wrap">
        <div class="navi-wrap">
          <!-- user -->
          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Navigation</span>
              </li>
              <li>
                <a href class="auto">      
                  
                  <i class="glyphicon glyphicon-stats icon text-primary-dker"></i>
                  <span class="font-bold">Dashboard</span>
                </a>
                
                  <li class="nav-sub-header">
                    <a href="index.html">
                      <span>Dashboard</span>
                    </a>
                  </li>
                 
                
              </li>
              <li>
                <a href="mail.html">
                  <b class="badge bg-info pull-right">9</b>
                  <i class="glyphicon glyphicon-envelope icon text-info-lter"></i>
                  <span class="font-bold">Email</span>
                </a>
              </li>
              <li class="line dk"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Components</span>
              </li>
              <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <b class="badge bg-info pull-right">3</b>
                  <i class="glyphicon glyphicon-th"></i>
                  <span>ABM</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>Layout</span>
                    </a>
                  </li>
                  <li>
                    <a href="layout_app.html">
                      <i class="icon-user-follow"></i>
                      <span>Alta</span>
                    </a>
                  </li>
                  <li>
                    <a href="layout_fullwidth.html">
                      <i class="icon-user-unfollow"></i>
                      <span>Baja</span>
                    </a>
                  </li>
                  <li>
                    <a href="layout_boxed.html">
                      <i class="icon-user-following"></i>
                      <span>Modificacion</span>
                    </a>
                  </li>      
                </ul>
              </li>
              <li>
                <a href="ui_chart.html">
                  <i class="glyphicon glyphicon-signal"></i>
                  <span>Historiales</span>
                </a>
              </li>            
              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-file icon"></i>
                  <span>Pages</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>Pages</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_profile.html">
                      <span>Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_post.html">
                      <span>Post</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_search.html">
                      <span>Search</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_invoice.html">
                      <span>Invoice</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_price.html">
                      <span>Price</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_lockme.html">
                      <span>Lock screen</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_signin.html">
                      <span>Signin</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_signup.html">
                      <span>Signup</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_forgotpwd.html">
                      <span>Forgot password</span>
                    </a>
                  </li>
                  <li>
                    <a href="page_404.html">
                      <span>404</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="line dk hidden-folded"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>Your Stuff</span>
              </li>  
              <li>
                <a href="page_profile.html">
                  <i class="icon-user icon text-success-lter"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li>
                <a href>
                  <i class="icon-question icon"></i>
                  <span>Documents</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- nav -->
        </div>
      </div>
  </aside>
  <!-- / aside -->
  
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
                            header('location: index.php?nError=10');
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
              <li class="active"><a href>Alta de perfil</a></li>
              <li><a href>Baja de perfil</a></li>
              <li><a href>Modificacion de perfil</a></li>
            </ul>
          </div>

        </div>

      </div>


      </div>