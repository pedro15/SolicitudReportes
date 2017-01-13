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
                Debe agregar una cuenta de administrador para poder usar el sistema.
                Tome en cuenta que una vez registrado la clave inicialmente es la cedula, luego se puede cambiar una vez ingresado al sistema.
            </div>
            <div class = "page-header">
                <h3>Agregar cuenta de administrador</h3>
            </div>
            <form method = "POST" action = "#" > 
                <div class = "form-group">
                    <label>Nombre y apellido</label>
                    <input type = "text" class = "form-control" name = "admin_name" required ="" >
                </div>
                <div class = "form-group">
                    <label>Cedula de identidad</label>
                    <input type = "text" class = "form-control" name = "admin_ci"  onkeypress="return isNumberKey(event);" maxlength="11" >
                </div>
                <div class = "form-group">
                    <label>Correo electronico</label>
                    <input type = "email" class = "form-control" name = "admin_email" required>
                </div>
                <input type = "hidden" name = "request_type" value = "admin" >
                <input type = "submit" class = "btn btn-lg btn-primary btn-block" value = "Agregar" >
            </form>
        </div>
    </div>
</div>
</html>