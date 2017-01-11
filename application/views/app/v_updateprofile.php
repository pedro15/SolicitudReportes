<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container" > 
    <div class = "page-header">
        <h3>Actualizar informacion</h3>
    </div>
    <form action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre y Apellido</label>
                    <input type = "text" class = "form-control" name = "username">
                </div>
                <div class = "col-md-5">
                    <label>Correo</label>
                    <input type = "email" class = "form-control" name = "useremail">
                </div>
            </div> 
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Actualizar perfil" >
    </form>
</div>