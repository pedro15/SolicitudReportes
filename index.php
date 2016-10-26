<!DOCTYPE html>
<html>
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Solicitud Soporte Tecnico::Inicio</title>
     <link href="css/style.css" rel="reset.css">
     <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
<div>
    <img class="bannerheader" id="membretefundacite" alt="Membrete" src="images/MembreteFundacite.png">
    <img class="bannerheader_der" id="membretefundacite" alt="Membrete" src="images/200.png">
</div>
  <div class = "fundacitebackground">
     <div>
          <div class = "text-left">
          <img class="LoginHeaderIcon" id="logofundacite" alt="fundacite logo" src="images/BannerIcons.png" width="100" height="100">
          </div>
          <div class ="text-center">
          <h3>Sistema Automatizado de Solicitud de Soporte Tecnico</h3>
          <h4>Bienvenido</h4>
          </div>
     </div>
    <div class="wrapper">
    <div class = "form-signin">
     <?php
        // Login alert !
        session_start();
        if (isset($_SESSION['message']))
        {
            ?>
                <div class = "alert alert-danger" style = "padding : 5px; margin-top: 5px; border-radius: 5px; ">
                    <?php 
                        $message = $_SESSION['message'];
                        echo $message;
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php    
        }
        // -----
    ?>
    <form name="loginform" action="checkpoint.php" method="POST">       
      <h2 class="form-signin-heading">Ingresar</h2>
      <input type="text" class="form-control" style = "margin-top: 5px;" name="cilogin" placeholder="Cedula" required="" autofocus="" />
      <input type="password" class="form-control" style = "margin-top: 5px;" name="passlogin" placeholder="Contraseña" required=""/>      
      <button class="btn btn-lg btn-primary btn-block" type="submit" style = "margin-top: 10px;">Entrar</button>   
    </form>
    </div>
  </div>
  </body>
</html>