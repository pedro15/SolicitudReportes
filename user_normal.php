<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Usuario</title>
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
                <li><a href="user_normal.php?opc=1">Reportar Falla</a></li>
               <li><a href="user_normal.php?opc=2">Perfil</a></li>
               <li><a href="user_normal.php?opc=3">Salir</a></li>
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
                    }else
                    {
                        closesystem();
                    }
                ?>
            </div>
            
            </div>
        </nav>
        <section>
            <div class="contentbg">
           
                <div class="content" >
                    <div class = "Alert">
                        <p>Hola</p>
                    </div>
                    <?php
                        if (isset($_GET['opc']))
                        {
                            if ($_GET['opc'] == 1 )
                            {
                                include 'Report.php';
                            }else if ($_GET['opc'] == 2 )
                            {
                              echo '<br>Perfil</br>';
                            }else if ($_GET['opc'] == 3 )
                            {
                                logout();
                            } 
                        }else
                        {
                            echo 'Seleccione una opcion';
                        }
                    ?>
                </div>
            </div>
         </section>
         <footer>
            <p>Solicitud de reportes para la academia de software libre FUNDACITE, contacto: 0123456789</p>
         </footer> 
        </div>
    </body>
</html>