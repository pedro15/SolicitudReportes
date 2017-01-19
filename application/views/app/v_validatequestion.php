<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "fundacitebackground">
    <div class = "container">
        <div class = "text-center">
            <img alt = "SASTEC" src = "<?php echo base_url('/'); ?>images/logo_SASTEC.png" width = "350" height = "200"/>
            <h2>Control de seguridad</h2>
        </div>
        <div class = "form-signin">
            <div class = "alert alert-warning" > 
                <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
                Usted tiene activada pregunta de seguridad en su perfil, deberá responderla para continuar. 
            </div>
            
            <?php if (isset($errormsg)){ ?>
            <div class = "alert alert-danger" > 
                <span class = "glyphicon glyphicon-error" aria-hidden = "true"  ></span>
                <?php echo $errormsg ; ?> 
            </div>
            <?php } ?>

            <div class = "page-header">
                <h3>Pregunta de seguridad</h3>
            </div>
            <form method = "POST" action = "#" > 
                <div class = "form-group">
                    <label><?php echo $question; ?></label>
                    <input type = "text" name = "user_a" class = "form-control" onkeypress = "return validatespace(event);" required autocomplete = "off" >
                </div>
                <input type = "submit" class = "btn btn-lg btn-primary btn-block" value = "Continuar" >
            </form>
        </div>
    </div>
</div>
</html>