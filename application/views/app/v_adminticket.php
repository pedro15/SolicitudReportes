<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar solicitudes de soporte tecnico</h3>
    </div>
</div>
<div class = "container report-container">
    <div class = "row" id = "fillticket">
            <?php 
                for ($i = 0 ; $i < 10 ; $i++ )
                {
            ?>
            <div class = "col-md-5 report-ticket" >
                <div class = "report-header">
                    <div class = "row">
                        <div class = "col-md-5">
                            Estado: <strong>Sin reparar</strong> 
                            <img src = "<?php echo base_url('images/alerticons/red.png'); ?>" alt = "alerticon" width = "16" height = "16" />
                        </div>
                        <div class = "col-md-5">
                            <a class = "report-header-link" href = ""><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Ver historial de cambios</a>
                        </div>
                    </div>
                </div>
                <div class = "report-ticket-darkbody">
                    <div class = "row">    
                        <div class = "report-ticket-controls">
                            <div class = "input-group" >
                                <div class = "input-group-addon">
                                    Cambiar estado:
                                </div>
                                <select class = "form-control">
                                    <option>Seleccionar</option>
                                    <option>Reparado</option>
                                    <option>En revision</option>
                                    <option>Sin reparar</option>
                                </select>
                                <div class = "input-group-btn">
                                    <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-md-6">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Sede:</strong> Fundacite merida
                        </div>
                        <div class = "col-md-6">
                            <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> <strong>Laboratorio:</strong>
                        </div>

                         <div class = "col-md-6">
                            <span class = "glyphicon glyphicon-hdd" aria-hidden = "true"></span> <strong>Equipo:</strong>
                        </div>

                        <div class = "col-md-6">
                             <span class = "glyphicon glyphicon-calendar" aria-hidden = "true"></span><strong> Fecha:</strong>
                        </div>
                        <div class = "col-md-6">
                            <span class = "glyphicon glyphicon-user" aria-hidden = "true"></span><strong> Enviado por:</strong>
                        </div>
                        <div class = "col-md-6">
                             <span class = "glyphicon glyphicon-bookmark" aria-hidden = "true"></span><strong> Categoria:</strong>
                        </div>
                    </div>
                </div>

                <div class = "report-body">
                    <strong>Descripcion de la falla:</strong>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a hendrerit sem. Nulla ut tincidunt quam, sed finibus augue. Sed ex tortor, posuere sit amet dignissim sit amet, mollis in ex. Curabitur vehicula, felis commodo ornare sodales, erat tellus porta nibh, ut interdum nulla turpis non tortor. Vestibulum varius metus erat, in mollis ante efficitur sed. Phasellus viverra non massa sit amet mattis. Fusce a turpis in tortor lacinia consectetur sed et massa. Phasellus facilisis erat id felis pulvinar ultrices. Fusce eget mauris ante. Fusce luctus dui metus, sit amet fermentum metus semper ut. Donec sit amet augue sed mauris viverra commodo. Phasellus varius diam lacus, eget accumsan lacus ultricies ac. Donec blandit ligula in euismod tristique. Curabitur id convallis massa, at efficitur orci. Praesent vestibulum ut nulla ut aliquet. </p>
                </div>
            </div>
            <?php 
                }
            ?>
    </div>
</div>

<script type = "text/javascript">

</script>