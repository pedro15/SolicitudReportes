<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
         <div class = "row">
            <div class = "col-xs-1">
                <img src = "<?php echo base_url('images/db.png') ?>" alt = "database icon" width = "30" height = "30" style = "margin-top: 15px; " />
            </div>
            <div class = "col-md-5">
                <h3>Respaldar base de datos</h3>
            </div>
        </div>
    </div>
    <div class = "alert alert-warning" > 
        <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
        Haga clic en el botón 'Respaldar base de datos' para crear un nuevo punto de restauración con la información actual de la base de datos.
    </div> 
    <form action = "#" method = "POST" >
        <input type = "hidden" name = "request" value = "true">
        <button type = "submit" class = "btn btn-primary">
             <span class = "glyphicon glyphicon-floppy-save" aria-hidden = "true"  ></span>
            Respaldar base de datos
        </button>
    </form>
</div>