<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "fundacitebackground">
    <div class = "container">
        <div class = "text-center">
            <img alt = "SASTEC" src = "<?php echo base_url('/'); ?>images/logo_SASTEC.png" width = "350" height = "200"/>
            <h2>Instalación</h2>
        </div>
        <div class = "form-signin">
            <div class = "alert alert-warning" > 
                <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
                La base de datos del sistema parece vacía, para instalarla haga clic en el botón "Instalar"
            </div>
            <div class = "page-header">
                <h3>Instalar base de datos</h3>
            </div>
            <form method = "POST" action = "#" > 
                <input type = "hidden" name = "request_type" value = "db" >
                <input type = "submit" class = "btn btn-lg btn-primary btn-block" value = "Instalar" >
            </form>
        </div>
    </div>
</div>
</html>