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
        <nav>
            <div class="wrapper" > 
            <ul>
               <li><a href="user_tec.php?opc=1">Reportar Falla</a></li>
               <li><a href="user_tec.php?opc=2">Administrar fallas</a></li>
               <li><a href="user_tec.php?opc=3">Estadisticas</a></li>
               <li><a href="user_tec.php?opc=4">Perfil</a></li>
               <li><a href="user_tec.php?opc=5">Perfil</a></li>
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
                                echo '<br>Administrar fallas</br>';
                            }else if ($_GET['opc'] == 3 )
                            {
                                echo '<br>Estadisticas</br>';
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