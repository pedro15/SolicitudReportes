<!DOCTYPE html>
<html>
    <head>
        <title>Espera...</title>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/reset.css">
        <link rel="Stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/app.js"></script>
        
    </head>
    <body>
        <section>
            <div class="loadingcheckpoint">
                <div>
                     <?php 
                         session_start();
                         require 'App.php';
                         $ci = $_POST['cilogin'] ;
                         $pw = $_POST['passlogin'];
                         $isloggedin = login($ci, $pw);
                         if ($isloggedin == true )
                         {
                             redirect_user($ci);
                             die();
                         }else{
                             $img = "<img src=" . "images/warning.png" . " alt=" . "Alert" . " height=" ."32" . " width=" ."32" . ">";
                             $_SESSION['message'] = $img . 'Cedula y/o Contraseña incorrectos'  ;
                             header("Location: index.php");
                             die();
                         }
                      ?>
                </div>
            </div>
        </section>
    </body>
</html>