<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Editar laboratorio</h3>
    </div>
    <form action = "#" method = "POST">
        <div class = "form-group">
            <label>Nombre laboratorio</label>
            <input type = "text"  maxlength = "45" name = "labname" class = "form-control" value = "<?php echo $mlaboratory->descripcion; ?>" required = "" >
        </div>
        <div class = "row">
            <div class = "col-md-1">
                <input type = "submit" class = "btn btn-primary" value = "Actualizar" >
            </div>
            <div class = "col-md-1">
                <a href = "<?php echo base_url("index.php/user/adminlab");?>" class = "btn btn-primary">Volver</a>
            </div>
        </div>
    </form>
</div>