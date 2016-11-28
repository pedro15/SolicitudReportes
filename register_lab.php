<div class = "container">
<?php
    require_once('Laboratory.php');
    require_once('Sede.php');
    $sedes = Sede::GetAll();
    if (isset( $_POST['DescLab'] ) && isset($_POST['sede_id']))
    {
        $desclab = $_POST['DescLab'];
        $sedeid = $_POST['sede_id'];
        $lab = new Laboratory($desclab,$sedeid);
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
?>
</div>
<form method="POST" action="#"  name="formregpc" class = "form-horizontal" >
   <div class = "container">
    <h3>Registrar Laboratorio</h3>
        <div class = "row">
            <div class = "col-md-4">
                <label>Sede:</label><br>
                <?php 
                    $count = mysqli_num_rows($sedes);
                    if ( $count > 0)
                    {
                         //while ( $row = mysqli_fetch_assoc($sedes) ){ echo $row['nombre'] . " - "; }
                ?>
                <select name= "sede_id" class = "form-control" > 
                    <?php
                        while ( $row = mysqli_fetch_assoc($sedes) )
                        {
                             $content =  "<option value =" . $row['id_sede'] . ">" . $row['nombre'] . " : " . $row['ubicacion'] . "</option>";
                             echo $content;
                        }
                    ?>
                </select>
                <?php
                    }else
                    {
                        echo 'No hay Sedes registradas<br>';
                    }
                ?>
            </div>
            <div class = "col-md-5">
                    <label>Nombre del laboratorio:</label>
                    <input class="form-control"  type="text"  name="DescLab" id="desclab" required ="">
            </div>
        </div>
        <div class = "row">
            <div class="text-center m-5 col-md-10 col-md-offest-10">
                <input class = "btn btn-primary" type="submit" value="Registrar Laboratorio">
            </div>
        </div>
    </div>
</form>