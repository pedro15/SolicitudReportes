<div class = "container">
<?php
    require_once('Laboratory.php');
    require_once('Sede.php');
    $sedes = Sede::GetAll();
    if (isset( $_POST['DescLab'] )   )
    {
        $desclab = $_POST['DescLab'];
        if ($desclab)
        {
           $lab = new Laboratory($desclab);
           if ($lab->Register())
           {
               ?>
                <div class="alert alert-success">
                <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <?php
                        echo("Registrado correctamente");
                    ?>
                </div>
                <?php
           }else if (isset($_SESSION['UserAlert']))
           {
               ?>
               <div class="alert alert-danger">
               <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <?php
                    echo($_SESSION['UserAlert']);
                ?>
               </div>
               <?php
           }
        }
    }
?>
</div>

<form method="POST" action="#"  name="formregpc" class = "form-horizontal" >
    <div class = "container">
    <div class = "col-md-4 col-md-offset-4">
    <h3>Registrar Laboratorio</h3>
    <div class = "form-group" >
        <label>Sede:</label>
        <?php 
            $count = mysqli_num_rows($sedes);
            echo $count;
            if ( $count > 0)
            {
        ?>
        <select name= "sede_id" class = "form-control" > 
            <?php
                for ($i = 0; $i < $count ; $i++)
                {
                     $row = mysqli_fetch_assoc($sedes);
                     echo '<option value="' . $row["id_sede"] . '>' . $row['nombre'] . " : " . $row["ubicacion"] . '</option>';
                }
            ?>
        </select>
        <?php
            }else
            {
                echo 'No hay Sedes registradas';
            }
        ?>
        <label>Nombre del laboratorio:</label>
        <input class="form-control"  type="text"  name="DescLab" id="desclab" required ="">
    </div>

    <div class="btn-group">
        <div class = "m-5">
             <input class = "btn btn-primary" type="submit" value="Registrar Laboratorio">
        </div>
    </div>
    </div>
    </div>
</form>