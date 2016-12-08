<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Laboratorio</h3>
    </div>
    <form  action = "#" method = "POST">
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Sede:</label>
                    <?php 
                       if (isset($rows_sedes) && count($rows_sedes) > 0 )
                       {
                    ?>
                    <select name = "sedeopc" class = "form-control" >
                        <?php
                            foreach( $rows_sedes as $sede )
                            {
                                $opc = '<option value = "' . $sede->id_sede . '">' . $sede->nombre . ' - ' . $sede->ubicacion . '</option>' ; 
                                echo $opc;
                            }
                        ?>
                    </select>
                    <?php
                       }else 
                       {
                           echo '<p>No hay sedes registradas</p>' ; 
                       }
                    ?>
                 </div>
                 <div class = "col-md-5">
                    <label>Nombre Laboratorio:</label>
                    <input type = "text" maxlength = "45" class = "form-control" name = "nombre_lab" required>
                 </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar laboratorio">
    </form>
</div>