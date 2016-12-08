<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Tecnico</h3>
    </div>
    <form action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre y Apellido</label>
                    <input type = "text" name = "name" class = "form-control" required>
                    <label>Correo:</label>
                    <input type = "email" name = "email" class = "form-control" required>
                </div>
                <div class = "col-md-5">
                    <label>Cedula</label>
                    <input type = "text" onkeypress="return isNumberKey(event);"  name = "userci" class = "form-control" required>
                </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar tecnico">
    </form>
</div>