<div class = "container">
<?php
    require_once('/include/Computer.php');
    require_once('/include/Laboratory.php');
    require_once('/include/Sede.php');
    
    if ( isset( $_POST['Lab']) && isset( $_POST['IDPC']) && isset( $_POST['CPU']) 
            && isset( $_POST['GPU']) && isset( $_POST['RAM']) && isset( $_POST['HDD']) && isset( $_POST['Motherboard'])
            && isset( $_POST['FuentePoder']))
    {
        $lab = $_POST['Lab'] ;
        $numpc = $_POST['IDPC'];
        $cpu = $_POST['CPU'];
        $gpu = $_POST['GPU'];
        $ram = $_POST['RAM'];
        $hdd = $_POST['HDD'];
        $mother = $_POST['Motherboard'];
        $power = $_POST['FuentePoder'];
        $pc = new Computer($numpc,$cpu,$gpu,$ram,$hdd,$power,$mother,$lab);
        if($pc->Register())
        {
            ?>
            <div class="alert alert-success">
            <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php
                echo 'Registrado correctamente';
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
    $sedes = Sede::GetAll();
 ?>
</div>

<div class = "page-header">
    <h3>Registrar Equipo</h3>
</div>
<form method="POST" action="#" name="formregpc" class = "form-horizontal" >
    <div class = "container">
        <div class = "row">
            <div class = "col-md-4">
                <label>Sede:</label><br>
                <select name = "sedeid" class = "form-control" id = "SedeSelect">
                    <option>Seleccionar</option>
                    <?php 
                        if (mysqli_num_rows($sedes) > 0 )
                        {
                            while ($row = mysqli_fetch_assoc($sedes))
                            {
                                $data = '<option value=' . $row['id_sede'] . '>' . $row['nombre'] . " - " . $row['ubicacion'] . '</option>' ;
                                echo $data;
                            }
                        }
                    ?>
                </select>
            </div>
             
            <div class = "col-md-3">
                <label>Laboratorio:</label><br>
                <select name = "Lab" class = "form-control" id = "LabSelect">
                   
                </select>
            </div>
            <div class = "col-md-2">
                <label>Numero de PC:</label><br>
                <input name = "IDPC" type = "text" required = "" class = "form-control" >
            </div>
            <div class = "col-md-3">
                <label>Procesador:</label><br>
                <input name = "CPU" type = "text" required = "" class = "form-control" >
            </div>
            <div class = "col-md-4">
                <label>Tarjeta de video (se deja en blanco si no tiene):</label><br>
                <input name = "GPU" type = "text"  class = "form-control" >
            </div>
            <div class = "col-md-4">
               <label>Memoria ram:</label><br>
               <input name = "RAM" type = "text"  class = "form-control" >
            </div>
            <div class = "col-md-4">
                <label>Disco duro:</label><br>
                <input name = "HDD" type = "text"  class = "form-control" >
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-4">
                 <label>Tarjeta Madre:</label><br>
                 <input name = "Motherboard" type = "text"  class = "form-control" >
            </div>
            <div class = "col-md-4">
                 <label>Fuente de poder:</label><br>
                 <input name = "FuentePoder" type = "text"  class = "form-control" >
            </div>
        </div>
        <div class = "row">
            <div class="text-center m-5 col-md-10 col-md-offest-10">
                <input class = "btn btn-primary" type="submit" value="Registrar Equipo">
            </div>
        </div>
    </div>
</form>
<script type = "text/javascript" >
    $("#SedeSelect").change(function()
    {
        var value = $("#SedeSelect").val();
        $("#LabSelect").load("modules/register_pc_loader.php?sede=" + value);
    });
</script>