<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                  Vista agregar sede                                ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    |  Interfaz de usuario correspondiente a agregar las sedes.                |
    |--------------------------------------------------------------------------|
*/

?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Sede</h3>
    </div>
    <form  action = "#" method = "POST">
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre Sede:</label>
                    <input type = "text" maxlength = "45" class = "form-control" name = "sede_nombre" required>
                 </div>
                 <div class = "col-md-5">
                    <label>Ubicación Sede:</label>
                    <input type = "text" maxlength = "45" class = "form-control" name = "sede_ubicacion" required>
                 </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar sede">
    </form>
</div>