<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Usuario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="Stylesheet" href="css/reset.css">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="Stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/Timer.js"></script>
    </head>
    <body onload= "resetTimer()">
    <?php 
       session_start();
    ?>
     <div>
        <img class="bannerheader" id="membretefundacite" alt="Membrete" src="images/MembreteFundacite.png">
        <img class="bannerheader_der" id="membretefundacite" alt="Membrete" src="images/200.png">
    </div>
      <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">   
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fallas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                     <li><a href="user_tec.php?opc=1">Reportar Falla</a></li>
                     <li><a href="user_tec.php?opc=2">Consultar fallas</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registro<span class="caret"></span></a>
              <ul class="dropdown-menu">
                    <li><a href="user_tec.php?opc=3">Registrar Laboratorio</a></li>
                    <li><a href="user_tec.php?opc=4">Registrar Equipo</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadisticas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li><a href="user_tec.php?opc=5">Solicitudes de soporte tecnico</a></li>
                 <li><a href="user_tec.php?opc=6">Equipos</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li><a href="user_tec.php?opc=7">Manual de usuario</a></li>
                 <li><a href="user_tec.php?opc=8">Creditos</a></li>
              </ul>
            </li>

            <li><a href="user_tec.php?opc=9">Salir</a></li>
          </ul>
          <div class="nav navbar-nav navbar-right">
                <div class="navbar-brand" style = "font-size: 10pt;">
                <?php
                    require 'App.php';
                    if (isset( $_SESSION['ciuser'] ))
                    {
                        $ci = $_SESSION['ciuser'];
                        $name = getuserdata($ci, 'nombre');
                        echo 'Bienvenido, ' . $name;
                    }else{
                        closesystem();
                    }
                ?>
                </div>
          </div>
        </div>
      </div>
    </nav>
        <section>
            <div class="content" >
                     <?php
                        if (isset($_GET['opc']))
                        {
                            if ($_GET['opc'] == 1 )
                            {
                                include 'Report.php';
                            }else if ($_GET['opc'] == 2 )
                            {
                                echo '<br>consultar fallas</br>' ;
                            }else if ($_GET['opc'] == 3 )
                            {
                                include 'register_lab.php';
                               
                            }else if ($_GET['opc'] == 4 )
                            {
                                 include 'register_pc.php';
                            }else if ($_GET['opc'] == 5)
                            {
                                   echo '<br>solicitudes de soporte tecnico</br>' ;
                              
                            }else if ($_GET['opc'] == 6)
                            {
                                  echo '<br>equipos</br>' ;
                              
                            }else if ($_GET['opc'] == 7)
                            {
                                  echo '<br>Manual de usuario</br>';
                               
                            }else if ($_GET['opc'] == 8)
                            {
                                 include 'credits.php';
                                
                            }else if ($_GET['opc'] == 9)
                            {
                                 logout();
                            }
                        }else
                        {
                            echo 'Seleccione una opcion';
                        }
                    ?>
            </div>
         </section>
         <footer>
            <p>Solicitud de reportes para la academia de software libre FUNDACITE, contacto: 0123456789</p>
         </footer> 
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>