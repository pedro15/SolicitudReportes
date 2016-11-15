<div class = "container">
<?php
    include_once('Computer.php');
    include_once('Laboratory.php');
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
    $labs = Laboratory::GetAll();
 ?>
</div>

<form method="POST" action="#" name="formregpc" class = "form-horizontal" >
    <div class = "container">
             <h3>Registrar Equipo</h3>
            <div class = "row">
                <div class = "col-md-6">
                    <label>Laboratorio:</label>
                    <?php 
                        if (mysqli_num_rows($labs) > 0)
                        {
                    ?>
                    <select name="Lab" class = "form-control">
                    <?php
                            while ($row = mysqli_fetch_assoc($labs))
                            {
                                $content =  "<option value =" . $row['numero'] . ">" . $row['descripcion'] . "</option>";
                                echo($content);
                            }
                    ?>
                    </select>
                    <?php
                        }else
                        {
                            echo 'No se encuentran laboratorios registrados';
                        }
                    ?>
                </div>
                <div class = "col-md-2">
                    <Label>Numero Equipo:</label>
                    <input type="text" class="form-control" name= "IDPC" required ="">
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-4">
                     <Label>Procesador:</label>
                    <input type="text" class="form-control" name= "CPU" required ="">
                </div>
                <div class = "col-md-4">
                    <Label>Tarjeta de video (dejar en blanco si no tiene):</label>
                    <input type="text" class="form-control" name= "GPU">
                </div>
                <div class = "col-md-4">
                    <Label>Memoria Ram:</label>
                    <input type="text" class="form-control" name= "RAM" required ="">
                </div>
            </div>
            
            <div class = "row">
                <div class = "col-md-4">
                     <Label>Tarjeta Madre:</label>
                    <input type="text" class="form-control" name= "Motherboard" required ="">
                </div>
                <div class = "col-md-4">
                    <Label>Disco Duro:</label>
                    <input type="text" class="form-control" name= "HDD" required ="">
                </div>
                <div class = "col-md-4">
                    <Label>Fuente de poder:</label>
                    <input type="text" class="form-control" name= "FuentePoder" required ="">
                </div>
            </div>
            <div class = "col-md-4 col-md-offset-4">
                <div class="btn-group">
                    <div class="m-5">
                        <input class= "btn btn-primary" type="submit" value="Registrar Equipo">
                    </div>
                </div>
            </div>
    </div>
</form>