<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Usuario</title>
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
                         <li><a href="user_normal.php?opc=1">Reportar Falla</a></li>
                         <li><a href="user_normal.php?opc=2">Consultar fallas</a></li>
                    </ul>
                </li>
               <li><a href="">Herramientas</a>
                    <ul>
                        <li><a href="user_normal.php?opc=3">Creditos</a></li>
                    </ul>
               </li>
               <li><a href="user_normal.php?opc=4">Salir</a></li>
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
                                include 'credits.php';
                               
                            }else if ($_GET['opc'] == 4 )
                            {
                                 logout();
                            }
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