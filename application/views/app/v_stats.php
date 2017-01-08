<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container" >
    <div class = "page-header">
        <h3>Estadisticas</h3>
    </div>
    <form action = "#" method = "POST" name = "radioform">
       <div class = "form-group">
            <div class = "row">
                <div class = "col-md-6">
                    <label>Sede</label>
                        <select name = "sede" class = "form-control" id = "selectsede">
                            <option value = "none">Seleccionar</option>
                            <?php 
                                foreach($sedes as $sede)
                                {
                                    $opc = '<option value ="' . $sede->id_sede . '">' . $sede->nombre . '</option>';
                                    echo $opc;
                                }
                            ?>
                        </select>
                </div>
            </div>
       </div>
       <div class = "form-group">
            <div class = "row">                
                <div class = "col-md-6">
                    <label>Fecha Inicio:</label>
                    <input type = "text" class = "form-control" id = "date-start" onkeydown="return false;" name = "fechainicio" required>
                </div>
                <div class = "col-md-6">
                     <label>Fecha fin:</label>
                    <input type = "text" class = "form-control" id = "date-end" onkeydown="return false;" name = "fechafin" required>
                </div>
            </div>
       </div>
       <div class = "form-group">
            <label>Tipo</label>
            <div class = "row">
                <div class = "col-md-3">
                     <input type = "radio" name = "tipo-busqueda" value = "falla-comun" checked> <label>Falla mas comun</label>
                </div>
                <div class = "col-md-3">
                     <input type = "radio" name = "tipo-busqueda" value = "equipo-comun"> <label>Equipo con mas fallas</label>
                </div>
            </div>
       </div>
       <div class = "form-group">
            <div class = "row">
                <div class = "col-md-2">
                    <input type = "submit" class = "btn btn-primary" value = "Generar estadistica">
                </div>
                <div class = "col-md-3">
                    <a class = "btn btn-primary" id = "printbtn" href = "<?php echo base_url() ?>index.php/user/generatepdf" target = "_blank">
                         Imprimir  <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
       </div>
    </form>
    <div class = "ct-chart" >
    </div>
</div>
<?php 
    if (count($labels) > 0 && count($series) > 0  )
    {
        ?>
            <form name = "dataform" action = "#" method = "POST" > 
                <?php 
                    foreach( $labels as $label )
                    {
                        $opc = '<input type = "hidden" name = "labels[]" value ="' . $label . '" >
                        ' ; 
                        echo $opc;
                    }
                    foreach ($series as $serie)
                    {
                        $opc = '<input type = "hidden" name = "series[]" value ="' . $serie . '" >
                        ' ; 
                        echo $opc;
                    }
                ?>
            </form>
        <?php
    }
?>
<script type="text/javascript" src="<?php echo base_url('/')?>chartist-js/chartist.min.js"></script>
<script type = "text/javascript">

     var labels_chart = [] ; 
     var series_chart = [] ; 

      function initdates()
      {
            $('#date-start').datetimepicker(
            {
              format : 'YYYY-MM-DD',
              locale: 'es'
            });

            $('#date-end').datetimepicker(
            {
              format : 'YYYY-MM-DD',
              locale: 'es'
            });
      }

      function initchart()
      {
          $('input[name="labels[]"]').each(function()
          {
              labels_chart.push($(this).val());
          });

          $('input[name="series[]"]').each(function()
          {
              series_chart.push(parseInt($(this).val()));
          });

          if (labels_chart.length > 0 && series_chart.length > 0 )
          {
              var data = {labels: labels_chart , series: series_chart};
              var options = {distributeSeries: true};
              var responsiveOptions = [
              ['screen and (min-width: 641px) and (max-height: 1024px)', {
                showPoint: false,
                axisY: 
                {
                    onlyInteger: true
                }}]];
                var chart = new Chartist.Bar('.ct-chart',data,options,responsiveOptions);
          }
      }
      
      $(document).ready(function()
      {
          initdates();
          initchart();
      });

      $("#printbtn").click(function()
      {

      });

      $("#generarbtn").click(function()
      {
          
      });

</script>