<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Editar Sede</h3>
    </div>
    <form action = "#" method = "POST">
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre Sede</label>
                    <input type = "text"  maxlength = "45" name = "sedename" class = "form-control" value = "<?php echo $currentsede->nombre; ?>" required = "" >
                </div>
                <div class = "col-md-5">
                    <label>Ubicación Sede</label>
                    <input type = "text"  maxlength = "45" name = "sedelocation" class = "form-control" value = "<?php echo $currentsede->ubicacion; ?>" required = "" >
                </div>
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-1">
                <input type = "submit" class = "btn btn-primary" value = "Actualizar" >
            </div>
            <div class = "col-md-1">
                <a href = "<?php echo base_url("index.php/user/adminsede");?>" class = "btn btn-primary">Volver</a>
            </div>
        </div>
    </form>
</div>