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
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type = "text/javascript" src = "js/app.js"></script>
        <script type="text/javascript" src="moment/moment.js"></script>
        <script type="text/javascript" src="moment/locale/es.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src= "js/transition.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    </head>
    <body onload= "resetTimer()">
    <?php 
       require_once('include/core/Program.php');
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
            <!-- Solicitudes de soporte tecnico !-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soporte Tecnico<span class="caret"></span></a>
              <ul class="dropdown-menu">
                    <li><a href="user_admin.php?opc=1">Enviar solicitud</a></li>
                    <li><a href="user_admin.php?opc=2">Administrar solicitudes</a></li>
              </ul>
            </li>
            <!-- Sedes  !-->
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sedes<span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <li><a href="user_admin.php?opc=3">Registrar sede</a></li>
                   <li><a href="user_admin.php?opc=4">Administrar sedes</a></li>
              </ul>
            </li>
            <!-- Laboratorios !-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laboratorios<span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <li><a href="user_admin.php?opc=5">Registrar laboratorio</a></li>
                   <li><a href="user_admin.php?opc=6">Administrar laboratorios</a></li>
              </ul>
            </li>
            <!-- Equipos !-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipos<span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <li><a href="user_admin.php?opc=7">Registrar equipo</a></li>
                   <li><a href="user_admin.php?opc=8">Administrar equipos</a></li>
              </ul>
            </li>
             <!-- Administrar tecnicos !-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tecnicos<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="user_admin.php?opc=10">Registrar tecnico</a></li>
                  <li><a href="user_admin.php?opc=11">Administrar tecnicos</a></li>
              </ul>
            </li>
            <!-- Estadisticas !-->
            <li><a href="user_admin.php?opc=9">Estadisticas</a></li>
             <!-- Herramientas !-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
              <ul class="dropdown-menu">
                     <li><a href="user_admin.php?opc=12">Respaldo de base de datos</a></li>
                     <li><a href="user_admin.php?opc=13">Restauracion de base de datos</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="user_admin.php?opc=14">Manual de usuario</a></li>
                     <li><a href="user_admin.php?opc=15">Creditos</a></li>
              </ul>
            </li>
             <!-- Salir !-->
            <li><a href="user_admin.php?opc=16">Salir</a></li>
          </ul>
           <!-- ** Nombre de usuario ** !-->
          <div class="nav navbar-nav navbar-right">
                <div class="navbar-brand" style = "font-size: 10pt;">
                <?php
                    Program::WriteName(); 
                ?>
                </div>
          </div>
          <!-- ***** !-->
        </div>
      </div>
    </nav>
        <section>
            <div class = "container">
                <div class="content" >
                  <?php
                        if (isset($_GET['opc']))
                        {
                            if ($_GET['opc'] == 1 )
                            {
                               //Registrar Solicitud
                               include 'modules/report.php';
                            }else if ($_GET['opc'] == 2 )
                            {
                                //Administrar Solicitud
                               include 'modules/reports_panel.php';
                            }else if ($_GET['opc'] == 3 )
                            {
                               //Registrar Sede
                             
                            }else if ($_GET['opc'] == 4 )
                            {
                                //Administrar Sede
                               
                            }else if ($_GET['opc'] == 5)
                            {
                                //Registrar Laboratorio
                                  include 'modules/register_lab.php';
                            }else if ($_GET['opc'] == 6)
                            {
                                //Administrar laboratorio
                                 echo 'equipos';
                            }else if ($_GET['opc'] == 7)
                            {
                                //Registrar Equipos
                                 include 'modules/register_pc.php';
                            }else if ($_GET['opc'] == 8)
                            {
                                //Administrar Equipos
                                include 'modules/admin_pc.php';
                            }else if ($_GET['opc'] == 9)
                            {
                                //Estadisticas
                                include 'modules/estadisticas_solicitud.php' ;
                            }else if ($_GET['opc'] == 10)
                            {
                                 //Registrar Tecnicos
                                
                            }else if ($_GET['opc'] == 11)
                            {
                                 //Administrar Tecnicos
                                
                            }else if ($_GET['opc'] == 12)
                            {
                                //Respaldo base de datos
                                 include 'modules/backup.php';
                            }else if ($_GET['opc'] == 13)
                            {
                                //Restauracion base de datos
                                include 'modules/restore.php';
                            }else if ($_GET['opc'] == 14)
                            {
                                //Manual de usuario
                                  echo 'manual de usuario';
                            }else if ($_GET['opc'] == 15)
                            {
                                //Creditos
                                 echo 'creditos';
                            }else if ($_GET['opc'] == 16)
                            {
                                //Salir
                                Program::LogOut();
                            }
                        }else
                        {
                            echo 'Seleccione una opcion';
                        }
                    ?>
                </div>
            </div>
         </section>
         <footer class = "footer">
            <div class = "container">
                <p>Solicitud de reportes para la academia de software libre FUNDACITE, contacto: 0123456789</p>
            </div>
         </footer> 
    </body>
</html>