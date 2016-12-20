<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Enviar Solicitud de soporte tecnico</h3>
    </div>
    <form action = "#" method = "POST">
        <div class = "form-group">
            <div class = "row">

                <div class = "col-md-5">
                    <Label>Sede</label>
                    <select  class = "form-control" >
                        <option value = "none">Seleccionar</option>
                    </select>
                </div>

                <div class = "col-md-5">
                    <Label>Laboratorio</label>
                    <select id = "select_laboratorio" class = "form-control" >
                        <option value = "none">Seleccione Sede</option>
                    </select>
                </div>

                <div class = "col-md-5">
                    <Label>Equipo</label>
                    <select id = "select_equipo" name = "idequipo" class = "form-control" >
                        <option value = "none">Seleccione Laboratorio</option>
                    </select>
                </div>

                <div class = "col-md-5">
                    <label>Categoria de la falla</label>
                    <select name = "category" class = "form-control" > 
                        <option value = "0" >Mouse</option>
                        <option value = "1" >Teclado</option>
                        <option value = "2" >Monitor</option>
                        <option value = "3" >Sistema operativo</option>
                        <option value = "4" >Hardware equipo</option>
                        <option value = "5">Otro</option>
                    </select>
                </div>
            </div>
            <div class = "row">
                <label>Desscripcion de la falla:</label>
                <textarea class = "form-control" name = "descripcion" rows = "15" cols = "0" maxlenght = "600">
                    
                </textarea>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Enviar Solicitud" > 
    </form>
</div>
