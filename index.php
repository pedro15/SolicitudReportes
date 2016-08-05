<!DOCTYPE html>
<html>
    <head> 
        <title>Solicitud de reportes::Inicio</title>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/reset.css">
        <link rel="Stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/app.js"></script>
    </head>
    <body style="
        background:
        url('images/fundacite01.png') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;">
    <div>
       <header>
          <div class="indexpage">
           <img class="loginicons_r" id="logofundacite" alt="fundacite logo" src="images/BannerIcons.png" width="920" height="160">
          <h1>Sistema Automatizado de Solicitud de Soporte Tecnico</h1>
          <h2>Bienvenido</h2>
          </div>
        </header>
        <section>
             <div class="LoginPanel">
                 <div class="LoginHeader">
                    <h2>Ingresar</h2>
                 </div>
                        
                 <form name="loginform" action="checkpoint.php" method="POST" onsubmit="return validatelogin();" >

                    <div class="LoginWarning" id ="lwargning">
                        <?php
                        session_start();
                        if (isset($_SESSION['message']))
                        {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>

                    <div class="LoginPanelField" >
                        <div><label for = "ci" >CI</label></div>
                        <input type="text" name="cilogin" value="" id="ci" placeholder="Ej: 123456789" > 
                    </div>

                    <div class="LoginPanelField" >
                        <div><label for = "pw">Contraseña</label></div>
                        <input type="password" name="passlogin" value="" id = "pw" placeholder="**********" >
                    </div>

                    <div class = "BtnNormalCenter">
                        <input type="submit" name="sendlogin" value="Entrar" >
                    </div>
                </form>       
            </div>
         </section>
         <footer>
            <p>Solicitud de reportes para la academia de software libre FUNDACITE, contacto: 0123456789</p>
         </footer> 
        </div>
    </body>
</html>