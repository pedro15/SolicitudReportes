<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Editar nivel de privilegio para : <?php echo  $nombre_usuario . " ( " . $tipo . " ) " ; ?></h3>
    </div>
    <form method = "POST" action = "#" >
        <div class = "form-group">
            <div class = "row">
                 <div class = "col-md-8">
                    <label>Nuevo nivel de privilegio:</label>
                    <select name = "newtype" class = "form-control" >
                        <option value = "1" >Participante/Instructor</option>
                        <option value = "2" >Tecnico</option>
                        <option value = "3">Administrador</option>
                    </select>
                </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Cambiar">
    </form>
</div>