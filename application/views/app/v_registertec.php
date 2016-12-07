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
                    <label>Nombre</label>
                    <input type = "text" name = "username" class = "form-control">
                    <label>Clave</label>
                    <input type = "password" name = "userpass" class = "form-control">
                    <label>Confirmar clave</label>
                    <input type = "password" class = "form-control">
                    <label>Correo:</label>
                    <input type = "email" name = "useremail" class = "form-control">
                </div>
                <div class = "col-md-5">
                    <label>Cedula</label>
                    <input type = "text" name = "userci" class = "form-control">
                    <label>Pregunta seguridad</label>
                    <select name = "opcquestion" class = "form-control" >
                        <option>Color favorito</option>
                    </select>
                    <input type = "password" name = "userquestion" class = "form-control">
                </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar tecnico">
    </form>
</div>