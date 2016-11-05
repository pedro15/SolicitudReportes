<!--  
    Interfaz para reporte de fallas
!-->
<div class = "container">
<?php
    include_once('Laboratory.php');
    include_once('Computer.php');
    include_once('ReportTicket.php');
    if (isset($_POST['TipoFalla']) && isset($_POST['NumEquipo']) && isset($_POST['DescripcionF']) )
    {
        $_TipoFalla = $_POST['TipoFalla'];
        $_NumEquipo = $_POST['NumEquipo'];
        $_DescripcionF = $_POST['DescripcionF'];
        $_ciuser = $_SESSION['ciuser'];
        $ticket = new ReportTicket($_DescripcionF,$_TipoFalla,$_NumEquipo,$_ciuser);
        if($ticket->Register())
        {
            ?>
            <div class="alert alert-success">
            <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                <?php
                    echo 'Reporte enviado correctamente';
                ?>   
            </div>
            <?php
        }else
        {
            ?>
            <div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <?php
                    echo 'Error al enviar el reporte';
                ?>
            </div>
            <?php
        }
    }
    $labs = Laboratory::GetAll();
    $pcs = null;
    if (isset($_POST['Laboratorio']))
    {
        $pcs = Computer::GetFromLab($_POST['Laboratorio']);
    }
    $labnumber = null;
?>
</div>
<form class = "form-horizontal" method="POST" action="#" >
    <div class = "form-group" style = "margin-right: 25%; margin-left: 25%;">
    <div class = "text-center">
        <h3>Registrar Falla</h3>
    </div>
    <Label style = "padding: 5px;">Laboratorio: </Label>
    <?php
      if ( mysqli_num_rows($labs) > 0 )
      {
          if (isset($_POST['Laboratorio']))
          {
          $labnumber = $_POST['Laboratorio'];
          $currentlab = Laboratory::FindByNumber($_POST['Laboratorio']);
          $currentlab_row = mysqli_fetch_assoc($currentlab);
          echo($currentlab_row['descripcion']);
          }else
          {
              echo 'No se ha seleccionado';
          }
        ?>
        <select onchange="form.submit()" name= "Laboratorio" id="laboratorio" class="form-control" >
        <option value = "-1" >Seleccionar</option>
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
    <div class = "container">
    <div class = "row">
    <div class = "col-md-4">
    <Label>Equipo</Label>
    <?php
    //if ($pcs != null)
    //{
    ?>
    <select name= "NumEquipo" id="numequipo" class="form-control" >
    <?php
      if ($pcs){
        $number = mysqli_num_rows($pcs);
        if ( $number > 0 )
        {
            while ($curr = mysqli_fetch_assoc($pcs))
            {
                echo '<option value= "' . $curr['num_equipo'] .'" >' . $curr['decripcion'] . '</option>'   ;
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
      }
    ?>
    </select>
    <?php
     /* }else
      {
           if (isset($_POST['NumEquipo']) && isset($_POST['Laboratorio'] ))
           {
               echo 'No se encuentran equipos registrados para el laboratorio ' 
               . $_POST['Laboratorio'] ;
           }else
           {
               echo '<p>Seleccione un laboratorio</p>';
           }
      }*/
    ?>
    </div>
    <div class = "col-md-4">
    <Label>Tipo</Label>
    <select name= "TipoFalla" id="tipoFalla" class="form-control" >
        <option value = "Hardware" >Hardware</option>
        <option value = "Softwate" >Softwate</option>
    </select>
    </div>
    </div>
    <Label style = "padding: 5px;">Descripcion</Label>
    <textarea maxlength = "450" rows="6" cols="6"  class="form-control"name="DescripcionF" id="descripcionF" placeholder="Descripcion de Falla" >
    </textarea>
    <div class = "text-center" style = "padding: 5px;">
        <input class= "btn btn-primary" type="submit" value="Registrar Falla">
    </div>
    </div>
</form>