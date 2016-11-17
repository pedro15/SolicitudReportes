<?php
    
    include_once('ReportTicket.php');
    include_once('Laboratory.php');
    include_once('Computer.php');
    include_once('Program.php');
    //Limpia los parametros GET de la url actual
    function Cleanurl()
    {
        $url = Program::getCurrentURL();
        $finalurl = "";
        if (isset($_GET['reportid']) && isset($_GET['action'])  )
        {
            $finalurl = Program::RemoveGetParam($url,'action');
            $finalurl = Program::RemoveGetParam($finalurl , 'reportid');
        } 
        if (isset($_GET['state']))
        {
            $finalurl = Program::RemoveGetParam($finalurl,'state');       
        }
        return $finalurl;   
    }

    // Redirecciona a la url limpia
    function Redirect()
    {
        $myurl = Cleanurl();
        Program::Redirect($myurl);
    }

    if (isset($_GET['reportid']) && isset($_GET['action']) )
    {
        $_action = $_GET['action'];
        $_id = $_GET['reportid'];

        if ($_action == "changestate")
        {
           if (isset($_GET['state']))
           {
               $state = $_GET['state'];
               $number = 0;

               if ($state == 'reparado')
               {
                   $number = 1;
               }else if ($state == 'sinreparar')
               {
                   $number = 0;
               }else if ($state == 'revision')
               {
                   $number = 2;
               }

               if (ReportTicket::ChangeState($_id,$number))
               {
                    Redirect();   
               }
           }
        }else if ($_action == "delete")
        {
            if (ReportTicket::DeleteReport($_id))
            {
                echo '<script type ="text/javascript"> alert("Eliminado correctamente") </script>';
                Redirect();
            }
        }
    }

    $reportes = ReportTicket::GetAllReports();
?>
<div class = "container" >

<?php 
    $count = mysqli_num_rows($reportes);
    if ( $count > 0)
    {
?>
    <div class = "col-lg-7">
        <h2>Administrar Solicitudes de Soporte Tecnico</h2>
    </div>
    <!-- inicio reporte -->
    <?php
        for ($i = 0; $i < $count; $i++)
        {   
            $row = mysqli_fetch_assoc($reportes);
            if ($row)
            {
                $reporte_info = ReportTicket::GetReportInfo($row['id_falla']);
    ?>
    <div class = "col-lg-9 report-bg">
        <div class = "row">
            <div class = "col-md-3 report-info-t-3">
                <?php
                     $reporte_data = mysqli_fetch_assoc($reporte_info);
                     $pcnum = $reporte_data['numero_equipo'];
                     $lab_info = Laboratory::GetFromPCNumber($pcnum);
                     $lab_data = mysqli_fetch_assoc($lab_info);
                     $computer_info = Computer::GetFromNumber($pcnum);
                     $computer_data = mysqli_fetch_assoc($computer_info);
                     echo ' <span class = "glyphicon glyphicon-tasks"></span> ';
                     echo($lab_data['descripcion']);
                     echo '<span class = "glyphicon glyphicon-triangle-right"></span>';
                     echo $computer_data['descripcion'] ;
                     echo ' <span class = "glyphicon glyphicon-exclamation-sign"></span>';
                ?>
            </div>
            <div class = "col-lg-8">
                <!-- Cabecera !-->
                <div class = "row">
                    <div class = "col-md-3">
                        <div class = "report-info-t-10">
                            <div class = "bg-warning">
                                <?php 
                                     $estado_reporte = $row['estado'];
                                     if ($estado_reporte == "REPARADO")
                                     {
                                          echo '<span class = "glyphicon glyphicon-ok-sign"></span>'; 
                                     }else 
                                     {
                                          echo '<span class = "glyphicon glyphicon-info-sign"></span>';
                                     }
                                     echo ' <strong>Estado:</strong><br>' . $estado_reporte ; 
                                ?>
                            </div>
                        </div>
                    </div>
                 <div class = "col-md-9">
                    <div class = "row" >
                        <form method = "POST" action = "#" name = "form1"  >
                            <div class = "report-info-tb-5">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Cambiar estado <span class="caret"></span>
                                    </button>
                                        <ul class="dropdown-menu">
                                            <?php
                                                $url = Program::getCurrentURL();
                                                $geturi = $url . "&reportid=" . $row['id'] . "&action=" ;
                                                $reparado_uri = $geturi . "changestate&state=reparado";
                                                $sinreparar_uri = $geturi . "changestate&state=sinreparar";
                                                $revision_uri = $geturi . "changestate&state=revision";
                                                $borrar_url = $geturi . "delete";
                                                echo '<li><a onclick = "form1.submit()" href = "'. $reparado_uri . '">Reparado</a></li>';
                                                echo '<li><a onclick = "form1.submit()" href = "'. $revision_uri . '">En revision</a></li>';
                                                echo '<li><a onclick = "form1.submit()" href = "'. $sinreparar_uri . '">Sin Reparar</a></li>';
                                            ?>
                                        </ul>
                                        <?php
                                        echo '<button formaction ="'. $borrar_url .'" type="buttun" class="btn btn-danger btn-borrar">';
                                        ?>
                                        <span class = "glyphicon glyphicon-trash"></span>
                                            Eliminar
                                        </button>
                                    </div>
                            </div>
                        </form>
                     </div>
                  </div>
                </div>
                <!-- Contenido !-->
            </div>
        </div>
            <div class = "report-content">
            <div>
                <span class = "glyphicon glyphicon-calendar"></span>
                <strong>Fecha:</strong>
                <?php
                   $fecha = $row['fecha'];
                   echo $fecha;
                ?>
            </div>
            <div>
                <span class = "glyphicon glyphicon-user"></span>
                <strong>Enviado por:</strong>
            </div>
            <div>
                <span class = "glyphicon glyphicon-info-sign"></span>
                <strong>Categoria:</strong>
                <?php
                   echo $reporte_data['tipo_falla'];
                ?>
            </div>
            <p>
            <?php
                $desc = $reporte_data['descripcion'];
                echo $desc;
            ?>
            </p>
        </div>
    </div>
    <?php
          }
      }
    }else
    {
        ?>
        <div class = "col-lg-7">
            <?php
               echo '<h2>No se encontraron reportes</h2>' ;
            ?>
        </div>
        <?php
    }
    ?>
    <!-- Script !-->
    <script type = "text/javascript">
        $(".btn-borrar").click(function()
        {
            return confirm("Desea eliminar el registro?");
        });
    </script>
</div>