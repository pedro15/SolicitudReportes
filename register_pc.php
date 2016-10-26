<div class = "Alert" id = "alertform">
<?php
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

        if ($lab && $numpc && $cpu && $gpu && $ram && $hdd && $mother && $power)
        {
            $uniqueid = $lab . "_" . $numpc;
            if( RegisterPC($lab, $uniqueid, $cpu, $gpu, $ram, $hdd, $power, $mother) )
            {
                echo 'Agregado correctamente';
            }else
            {
            
                echo 'Error al agregar los datos';
            
            }
        }
    }
?>
</div>

<form method="POST" action="#" name="formregpc" >
    <h1>Registrar Equipo</h1>
    <div>
    <label>Laboratorio:</label>
    <?php
        $link = Connectdb();
        $sql = "SELECT * FROM laboratorio" ;
        $resultlab = mysqli_query($link, $sql);
        if ($resultlab && mysqli_num_rows($resultlab) > 0 ) 
        {
    ?>
    <select name= "Lab" id="labid" class="ComboboxNormal" >
        <?php
            while ( $row =  mysqli_fetch_assoc($resultlab))
            {
                echo '<option value= "' . $row['numero'] .'" >' . $row['descripcion'] . '</option>'   ;
            }
        ?>
    </select>
    <?php
        }else
        {
            echo '<label>No se encuentran laboratorios</label>';
        }
    ?>
    <input class="TextboxNormal"  type="text"  name="IDPC" id="idpc" placeholder="Numero PC" >
    </div>
    <div>
    <!-- <label for="cpu" >CPU:</label> -->
    <input class="TextboxAncho"  type="text"  name="CPU" id="cpu" placeholder="CPU" >
    <!-- <label for="gpu" >GPU:</label> -->
    <input class="TextboxAncho" ype="text" name="GPU" id="gpu" placeholder="GPU" >
    </div>
    <div>
    <!-- <label for="ram" >Memoria RAM:</label> -->
    <input class="TextboxAncho" type="text" name="RAM" id="ram" placeholder="Memoria RAM" >
    <!-- <label for="hdd" >Disco Duro:</label> -->
    <input class="TextboxAncho" type="text" name="HDD" id="hdd" placeholder="Disco Duro" >
    </div>
    <div>
    <!-- <label for="motherboard" >Tarjeta Madre:</label> -->
     <input class="TextboxAncho" type="text" name="Motherboard" id="motherboard" placeholder="Tarjeta Madre" >
    <!-- <label for="fuente" >Fuente de Poder:</label> -->
     <input class="TextboxAncho" type="text" name="FuentePoder" id="fuente" placeholder="Fuente de Poder" >
    </div>
     <div class="BtnNormal">
         <input type="submit" value="Registrar Equipo">
    </div>
</form>