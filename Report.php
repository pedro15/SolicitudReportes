<!--  
    Interfaz para reporte de fallas
!-->
<div class = "Alert">
<?php
    include_once('Laboratory.php');
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
?>
</div>

<form class = "form-horizontal" method="POST" action="#"  name="formreport" >
    <div class = "form-group" style = "margin-right: 25%; margin-left: 25%;">
    <div class = "text-center">
        <h3>Registrar Falla</h3>
    </div>
    <Label style = "padding: 5px;">Laboratorio:</Label>
    <?php

      if ( mysqli_num_rows($labs) > 0 )
      {
        echo '<select name= "NumEquipo" id="numequipo" class="form-control" >' ;
        while($row =  mysqli_fetch_assoc($labs))
        {
            $content = "<option value =" . "Hardware" . ">" . $row['descripcion'] . "</option>";
            echo($content);
        }
        echo '</select>';
      }else
      {
          echo("No se encuentran laboratorios registrados");
      }
     ?>
    <Label style = "padding: 5px;">Equipo</Label>
    <select name= "NumEquipo" id="numequipo" class="form-control" >
        <option value = "Hardware" >Hardware</option>
       
    </select>
    <Label style = "padding: 5px;">Tipo</Label>
    <select name= "TipoFalla" id="tipoFalla" class="form-control" >
        <option value = "Hardware" >Hardware</option>
        <option value = "Softwate" >Softwate</option>
    </select>
    <Label style = "padding: 5px;">Descripcion</Label>
    <textarea maxlength = "450" rows="12" cols="10"  class="form-control"name="DescripcionF" id="descripcionF" placeholder="Descripcion de Falla" >
    </textarea>
    <div class = "text-center" style = "padding: 5px;">
            <input class= "btn btn-primary" type="submit" value="Registrar Falla">
    </div>
    </div>
</form>