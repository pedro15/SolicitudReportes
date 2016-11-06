<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Css !-->
        <link rel="Stylesheet" href="css/reset.css" type ="text/css">
        <link href="chartist-js/chartist.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type ="text/css">
         <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type ="text/css">
        <link href="css/style.css" rel="stylesheet" type ="text/css">
        <!-- Javascript !-->
        <script type="text/javascript" src="js/Timer.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
         <script type="text/javascript" src="moment/moment.js"></script>
         <script type="text/javascript" src="moment/locale/es.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src= "js/transition.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
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
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">   
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fallas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                    <li><a href="user_admin.php?opc=1">Reportar Falla</a></li>
                    <li><a href="user_admin.php?opc=2">Consultar fallas</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registro<span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <li><a href="user_admin.php?opc=3">Registrar Laboratorio</a></li>
                   <li><a href="user_admin.php?opc=4">Registrar Equipo</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadisticas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                    <li><a href="user_admin.php?opc=5">Solicitudes de soporte tecnico</a></li>
                    <li><a href="user_admin.php?opc=6">Equipos</a></li>
              </ul>
            </li>

            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar Tecnicos<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="user_admin.php?opc=7">Agregar tecnico</a></li>
                  <li><a href="user_admin.php?opc=8">Modificar tecnico</a></li>
                  <li><a href="user_admin.php?opc=9">Eliminar tecnico</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                     <li><a href="user_admin.php?opc=10">Respaldo de base de datos</a></li>
                     <li><a href="user_admin.php?opc=11">Restauracion de base de datos</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="user_admin.php?opc=12">Manual de usuario</a></li>
                     <li><a href="user_admin.php?opc=13">Creditos</a></li>
              </ul>
            </li>
            <li><a href="user_admin.php?opc=14">Salir</a></li>
          </ul>
          <div class="nav navbar-nav navbar-right">
                <div class="navbar-brand" style = "font-size: 10pt;">
                <?php
                    require 'App.php';
                    WriteName();
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
                               echo 'consultar fallas';
                            }else if ($_GET['opc'] == 3 )
                            {
                               include 'register_lab.php';
                            }else if ($_GET['opc'] == 4 )
                            {
                                include 'register_pc.php';
                            }else if ($_GET['opc'] == 5)
                            {
                                 include 'estadisticas_solicitud.php' ;
                            }else if ($_GET['opc'] == 6)
                            {
                                 echo 'equipos';
                            }else if ($_GET['opc'] == 7)
                            {
                                echo 'agregar tecnico';
                            }else if ($_GET['opc'] == 8)
                            {
                                echo 'modificar tecnico';
                            }else if ($_GET['opc'] == 9)
                            {
                                echo 'eliminar tecnico';
                            }else if ($_GET['opc'] == 10)
                            {
                                 include 'backup.php';
                            }else if ($_GET['opc'] == 11)
                            {
                                 include 'restore.php';
                            }else if ($_GET['opc'] == 12)
                            {
                                echo 'manual de usuario';
                            }else if ($_GET['opc'] == 13)
                            {
                                echo 'creditos';
                            }else if ($_GET['opc'] == 14)
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
    </body>
</html>