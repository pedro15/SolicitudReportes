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
        <nav>
            <div class="wrapper" > 
            <ul>
                <li><a href="user_normal.php?opc=1">Reportar Falla</a></li>
               <li><a href="user_normal.php?opc=2">Perfil</a></li>
               <li><a href="user_normal.php?opc=3">Salir</a></li>
            </ul>
            </div>
        </nav>
        <section>
            <div class="content">
                    <?php
                        require 'App.php';
                        if ($_GET['opc'] == 1 )
                        {
                            include 'Report.php';
                        }else if ($_GET['opc'] == 2 )
                        {
                            echo '<br>Perfil</br>';
                        }else if ($_GET['opc'] == 3 )
                        {
                            echo '<br>salir</br>';
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