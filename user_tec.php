<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Tecnico</title>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/reset.css">
        <link rel="Stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/Timer.js"></script>
    </head>
    <body onload= "resetTimer()">
     <div>
    <img class="bannerheader" id="membretefundacite" alt="Membrete" src="images/MembreteFundacite.png">
    <img class="bannerheader_der" id="membretefundacite" alt="Membrete" src="images/200.png">
    </div>
    <div>
        <nav>
            <div class="wrapper" > 
            <ul>
                <li><a href="">Fallas</a>
                    <ul>
                         <li><a href="user_tec.php?opc=1">Reportar Falla</a></li>
                         <li><a href="user_tec.php?opc=2">Consultar fallas</a></li>
                    </ul>
                </li>

                <li><a href="">Registro</a>
                    <ul>
                          <li><a href="user_tec.php?opc=3">Laboratorio</a></li>
                          <li><a href="user_tec.php?opc=4">Equipo</a></li>
                    </ul>
                </li>
                
               <li><a href="user_tec.php?opc=5">Perfil</a></li>
               <li><a href="">Herramientas</a>
                    <ul>
                        <li><a href="user_tec.php?opc=6">Respaldo DB</a></li>
                        <li><a href="user_tec.php?opc=7">Restauracion DB</a></li>
                        <li><a href="user_tec.php?opc=8">Manual de usuario</a></li>
                        <li><a href="user_tec.php?opc=9">Creditos</a></li>
                    </ul>
               </li>
               <li><a href="user_tec.php?opc=10">Salir</a></li>
            </ul>

            <div class="NavUserinfo" id="navuserinfo" > 
                <?php
                    session_start();
                    require 'App.php';
                    if (isset( $_SESSION['ciuser'] ))
                    {
                        $ci = $_SESSION['ciuser'];
                        $name = getuserdata($ci, 'nombre');
                        echo '<p>Bienvenido, ' . $name . '</p>' ;
                    }else{
                        closesystem();
                    }
                ?>
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
                                
                            }else if ($_GET['opc'] == 3 )
                            {
                                include 'register_lab.php';
                               
                            }else if ($_GET['opc'] == 4 )
                            {
                                 include 'register_pc.php';

                            }else if ($_GET['opc'] == 5 )
                            {
                                echo 'perfil';
                                
                            }else if ($_GET['opc'] == 6)
                            {
                                include 'backup.php';
                              
                            }else if ($_GET['opc'] == 7)
                            {
                                  include 'restore.php';
                              
                            }else if ($_GET['opc'] == 8)
                            {
                                  echo '<br>Manual de usuario</br>';
                               
                            }else if ($_GET['opc'] == 9)
                            {
                                 include 'credits.php';
                                
                            }else if ($_GET['opc'] == 10)
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
        </div>
    </body>
</html>