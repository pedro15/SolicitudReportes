<!--  
    Interfaz para reporte de fallas
!-->
<div class = "Alert">
<?php
    include_once('Laboratory.php');
    include_once('Computer.php');
    if (isset($_POST['TipoFalla']) && isset($_POST['NumEquipo']) && isset($_POST['DescripcionF']) )
    {
        $_TipoFalla = $_POST['TipoFalla'];
        $_NumEquipo = $_POST['NumEquipo'];
        $_DescripcionF = $_POST['DescripcionF'];
        if (RegistrarFalla($_DescripcionF,$_TipoFalla,$_NumEquipo))
        {
            echo 'Registrado correctamente';
        }else
        {
            echo 'Error al registrar falla'; 
        }
    }
    $labs = Laboratory::GetAll();
    $pcs = null;
    if (isset($_POST['Laboratorio']))
    {
        $pcs = Computer::GetFromLab($_POST['Laboratorio']);
    }
?>
</div>

<form class = "form-horizontal" method="POST" action="#" >
    <div class = "form-group" style = "margin-right: 25%; margin-left: 25%;">
    <div class = "text-center">
        <h3>Registrar Falla</h3>
    </div>
    <Label style = "padding: 5px;">Laboratorio:</Label>
    <?php
      if ( mysqli_num_rows($labs) > 0 )
      {
        ?>
        <select onchange="form.submit()" name= "Laboratorio" id="laboratorio" class="form-control" >
        <?php
        while($row =  mysqli_fetch_assoc($labs))
        {
            $content = "<option value =" . $row['numero'] . ">" . $row['descripcion'] . "</option>";
            echo($content);
        }
        ?>
        </select>
        <?php
      }else
      {
          echo("No se encuentran laboratorios registrados");
      }
     ?>
     </div>
</form>

<form class = "form-horizontal" method="POST" action="#"  name="formreport" >
    <div class = "form-group" style = "margin-right: 25%; margin-left: 25%;">
    <Label style = "padding: 5px;">Equipo</Label>
    <?php

    if ($pcs)
    {
        if (isset($_POST['Laboratorio']))
        {
            echo($_POST['Laboratorio']);
        }
        ?>
    <select name= "NumEquipo" id="numequipo" class="form-control" >
    <?php
        $number = mysqli_num_rows($pcs);
        if ( $number > 0 )
        {
            while ($curr = mysqli_fetch_assoc($pcs))
            {
                 $say = explode('/',$row['num_equipo']);
                 
                 
                    // $content = "<option value = '" .  . "'>" .  . "</option>";
                echo '<option value= "' . $curr['num_equipo'] .'" >' . $say[0] . '</option>'   ;
            }
        }else
        {
           if (isset($_POST['Laboratorio']))
           {
               echo 'No se encuentran equipos registrados para el laboratorio ' 
               . $_POST['Laboratorio'] ;
           }else
           {
               echo 'Seleccione un laboratorio';
           }
           echo $number;
        }
    ?>
    </select>
    <?php
      }else
      {
           if (isset($_POST['NumEquipo']))
           {
               echo 'No se encuentran equipos registrados para el laboratorio ' 
               . $_POST['Laboratorio'] ;
           }else
           {
               echo 'Seleccione un laboratorio';
           }
      }
    ?>
    <Label style = "padding: 5px;">Tipo</Label>
    <select name= "TipoFalla" id="tipoFalla" class="form-control" >
        <option value = "Hardware" >Hardware</option>
        <option value = "Softwate" >Softwate</option>
    </select>
    <Label style = "padding: 5px;">Descripcion</Label>
    <textarea maxlength = "450" rows="6" cols="6"  class="form-control"name="DescripcionF" id="descripcionF" placeholder="Descripcion de Falla" >
    </textarea>
    <div class = "text-center" style = "padding: 5px;">
            <input class= "btn btn-primary" type="submit" value="Registrar Falla">
    </div>
    </div>
</form>