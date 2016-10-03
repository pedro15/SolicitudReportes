<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Tecnico</title>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/reset.css">
        <link rel="Stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/app.js"></script>
    </head>
    <body>
     <div>
    <img class="bannerheader" id="membretefundacite" alt="Membrete" src="images/MembreteFundacite.png">
    <img class="bannerheader_der" id="membretefundacite" alt="Membrete" src="images/200.png">
    </div>
    <div>
        <nav>
            <div class="wrapper" > 
            <ul>
               <li><a href="user_tec.php?opc=1">Reportar Falla</a></li>
               <li><a href="user_tec.php?opc=2">Registrar Laboratorio</a></li>
               <li><a href="user_tec.php?opc=3">Registrar Equipo</a></li>
               <li><a href="user_tec.php?opc=4">Perfil</a></li>
               <li><a href="user_tec.php?opc=5">Salir</a></li>
            </ul>

            <div class="NavUserinfo" id="navuserinfo" > 
                <?php
                    session_start();
                    require 'App.php';
                    if (isset( $_SESSION['ciuser'] ))
                    {
                        $ci = $_SESSION['ciuser'];
                        $name = getuserdata($ci, 'nombre');
                        echo '<p>Hola, ' . $name . '</p>' ;
                    }else{
                        closesystem();
                    }
                ?>
            </div>
            
            </div>
        </nav>
        <section>
            <div class="content">
                    <?php
                        if (isset($_GET['opc']))
                        {
                            if ($_GET['opc'] == 1 )
                            {
                                include 'Report.php';
                            }else if ($_GET['opc'] == 2 )
                            {
                                include 'register_lab.php';
                            }else if ($_GET['opc'] == 3 )
                            {
                                include 'register_pc.php';
                            }else if ($_GET['opc'] == 4 )
                            {
                                echo '<br>Perfil</br>';
                            }else if ($_GET['opc'] == 5 )
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