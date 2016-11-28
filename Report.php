<!--  
    Interfaz para reporte de fallas
!-->
<div class = "container">
<?php
    include_once('Laboratory.php');
    include_once('Computer.php');
    include_once('ReportTicket.php');
    include_once('Sede.php');
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
    $sedes = Sede::GetAll();
    $labnumber = null;
    $labs = null;
    $pcs = null;
    if (isset($_POST['Sedeid']))
    {
        $labs = Laboratory::GetFromSede($_POST['Sedeid']);
    }
    if (isset($_POST['Laboratorio']))
    {
        $pcs = Computer::GetFromLab($_POST['Laboratorio']);
    }
?>
</div>

<form name = "form_sede" class = "form-horizontal" method="POST" action="#" >
    <div class = "container">
        <h3>Enviar Solicitud de soporte tecnico</h3>
        <div class = "row col-md-4">
        <label>Sede:</label>
        <?php
           if (isset($_POST['Sedeid']))
           {
               $curr = Sede::GetFromid($_POST['Sedeid']);
               $data = mysqli_fetch_assoc($curr);
               echo $data['nombre'];
           }
           if(mysqli_num_rows($sedes) > 0)
           {
        ?>
        <select onchange= "form_sede.submit()" name = "Sedeid" class = "form-control">
            <option>Seleccionar</option>
            <?php
                while($row = mysqli_fetch_assoc($sedes))
                {
                    $info = '<option value =' . $row['id_sede'] . '>' . $row['nombre'] . " : " . $row['ubicacion'] . '</option>';
                    echo $info;
                }
            ?>
        </select>
        <?php
           }else
           {
               echo 'No hay sedes registradas';
           }
        ?>
        </div>
    </div>
</form>

<form name= "form_lab" class = "form-horizontal" method="POST" action="#" >
    <div class = "container col-md-4">
    <Label>Laboratorio:</Label>
    <?php
        if (isset($_POST['Laboratorio']))
        {
            $curr = Laboratory::FindByNumber($_POST['Laboratorio']);
            $data = mysqli_fetch_assoc($curr);
            echo $data['descripcion'];
        }
     if ($labs)
     {
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
        <select onchange="form_lab.submit()" name= "Laboratorio" id="laboratorio" class="form-control" >
        <option>Seleccionar</option>
        <?php
        while($row =  mysqli_fetch_assoc($labs))
        {
            $content = "<option value =" . $row['id_laboratorio'] . ">" . $row['descripcion'] . "</option>";
            echo($content);
        }
        ?>
        </select>
        <?php
      }else
      {
          echo("No se encuentran laboratorios registrados");
      }
     }
     ?>
     </div>
</form>

<form name = "form_main" class = "form-horizontal" method="POST" action="#"  name="formreport" >
    <div class = "container">
    <div class = "row">
    <div class = "col-md-4">
    <Label>Equipo</Label><br>
    <?php
    if ($pcs)
    {
        $number = mysqli_num_rows($pcs);
        if ( $number > 0 )
        {
            ?>
            <select name= "NumEquipo" id="numequipo" class="form-control" >
            <?php
            while ($curr = mysqli_fetch_assoc($pcs))
            {
                echo '<option value= "' . $curr['id_equipo'] .'" >' . $curr['descripcion'] . '</option>'   ;
            }
            ?>
            </select>
            <?php
        }else
        {
           if (isset($_POST['Laboratorio']))
           {
               echo 'No se encuentran equipos registrados para el laboratorio seleccionado';
           }else
           {
               echo 'Seleccione un laboratorio';
           }
        }
      }else 
      {
          echo 'Seleccione un laboratorio';
      }
    ?>
    </div>
    <div class = "col-md-4">
    <Label>Categoria</Label>
    <select name= "TipoFalla" id="tipoFalla" class="form-control" >
        <option value = "TECLADO NO SIRVE" >Teclado no sirve</option>
        <option value = "MONITOR NO SIRVE" >Monitor no sirve</option>
        <option value = "MOUSE NO SIRVE" >Mouse no sirve</option>
        <option value = "PC NO ENCIENDE" >No enciende el PC</option>
        <option value = "NO INICIA SISTEMA OPERATIVO" >No arranca el sistema operativo</option>
        <option value = "CLAVE DE INICIAR SESION PERDIDA" >Clave de iniciar sesion perdida</option>        
        <option value = "OTRO" >Otro (especificar)</option>
    </select>
    </div>
    </div>
    <Label style = "padding: 5px;">Descripcion</Label>
    <textarea maxlength = "450" rows="6" cols="6"  class="form-control"name="DescripcionF" id="descripcionF" placeholder="Descripcion de Falla" required = "" >
    </textarea>
    <div class = "text-center" style = "padding: 5px;">
        <input class= "btn btn-primary" type="submit" value="Enviar solicitud">
    </div>
    </div>
</form>