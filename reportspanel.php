<?php
    include_once('ReportTicket.php');
    if (isset($_POST['btn-eliminar']))
    {
        echo 'eliminar';
    }else if (isset($_GET['opcion']))
    {
        echo $_GET['opcion'];
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
            <div class = "col-md-2">
                <?php
                     $reporte_data = mysqli_fetch_assoc($reporte_info);
                     echo '<h3>' . $reporte_data['numero_equipo'] . '</h3>';
                ?>
            </div>
            <div class = "col-lg-9">
                <!-- Cabecera !-->
                <div class = "row">
                    <div class = "col-md-3">
                        <div class = "report-info">
                            <div class = "bg-warning">
                                <span class = "glyphicon glyphicon-info-sign"></span>
                                <strong>Estado:</strong><br>Sin Reparar
                            </div>
                        </div>
                    </div>
                    <div class = "col-md-9">
            <form method = "POST" action = "#" name = "form1"  >
                <div class = "report-info">
                    <div class="btn-group">
                        <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Small button <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a onclick = "form1.submit()" href = "?opcion=1">Opcion</a>
                            <li><a href = "#?">Opcion</a>
                            <li><a href = "#">Opcion</a>
                            <li><a href = "#">Opcion</a>
                        </ul>
                    </div>

                    <div class="btn-group" role="group" aria-label="...">
                        <button name="btn-eliminar" type="submit" class="btn btn-danger">
                            <span class = "glyphicon glyphicon-trash"></span>
                            Eliminar
                        </button>
                    </div>

                </div>
            </form>
                </div>
                </div>
                <!-- Contenido !-->
            </div>
        </div>
            <div class = "report-content">
            <div>
                <span class = "glyphicon glyphicon-calendar"></span>
                <strong>Fecha:</strong> 2016-11-5
            </div>
            <div>
                <span class = "glyphicon glyphicon-user"></span>
                <strong>Enviado por:</strong> Pedro Duran
            </div>
            <div>
                <span class = "glyphicon glyphicon-info-sign"></span>
                <strong>Categoria:</strong> Otro
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus augue diam, varius id diam eu, dapibus laoreet augue. Pellentesque pellentesque et urna at viverra. Curabitur molestie lectus a hendrerit rhoncus. Quisque id accumsan neque. Integer in eros mi. Nullam malesuada, risus sit amet efficitur egestas, ipsum quam fermentum purus, nec malesuada erat felis sed ligula. Morbi fermentum, dui sit amet rutrum hendrerit, mi lacus maximus enim sed.
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

    </script>
</div>