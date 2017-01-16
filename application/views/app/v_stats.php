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
                    <input type = "text" class = "form-control" id = "date-start" onkeydown="return false;" name = "fechainicio" value = "<?php if (isset($fechainicio)) echo $fechainicio; ?>" required>
                </div>
                <div class = "col-md-6">
                     <label>Fecha fin:</label>
                    <input type = "text" class = "form-control" id = "date-end" onkeydown="return false;" name = "fechafin" value = "<?php if (isset($fechafin)) echo $fechafin; ?>" required>
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
                    <a class = "btn btn-primary" id = "printbtn">
                         Imprimir  <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
       </div>
    </form>
    <div id = "stats-container">
        <div class = "container">
            <div id = "stats-header">
            </div>
            <div class = "ct-chart" >
            </div>
            <div id = "stats-body">
            </div>
        </div>
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
                    if (isset($currentsede))
                    {
                        $opc = '<input type = "hidden" name = "sedecurr" value ="' . $currentsede . '" >
                            ' ; 
                        echo $opc;
                    }
                ?>
            </form>
        <?php
    }
?>
<div id = "editor"></div>
<script type="text/javascript" src="<?php echo base_url('/')?>chartist-js/chartist.min.js"></script>
<script type = "text/javascript">

     var labels_chart = [] ; 
     var series_chart = [] ; 
     var chart;

     $(document).ready(function()
     {
         var currsede =  $('input[name="sedecurr"]').val();
         if (currsede != undefined )
         {
             $("#selectsede").val(currsede).change();
         }
     });

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
                chart = new Chartist.Bar('.ct-chart',data,options,responsiveOptions);
          }
      }

      $(document).ready(function()
      {
          initdates();
          initchart();
      });

      $("#printbtn").click(function()
      {
           var opcselected = $('input[name="tipo-busqueda"]'); 
           var opctxt = ( opcselected.is(':checked') ) ? 'fallas comunes' : 'equipos con mas fallas' ;
            var xhtml =
            '<div class = "row">' + 
            '<div class = "col-md-6">' +
            '<img alt="Membrete" src="<?php echo base_url("")?>images/MembreteFundacite.png">' +
            '</div><div class = "col-md-4">' +
            '<img alt="Membrete" src="<?php echo base_url("/")?>images/200.png">' + 
            '</div></div>' + 
            '<div class = "page-header"><h4>Estadisticas (' + opctxt + ') </h4>' + 
            '<p>Fecha: ' + "<?php echo date('Y-m-d'); ?>" + '</p>' + 
            '<p>Fecha inicio estadistica: ' + $("#date-start").val() + '</p>' + 
            '<p>Fecha fin estadistica: ' + $("#date-end").val() + '</p>' + 
            '<p>Sede: ' + $("#selectsede option:selected").text() + '</p></div>' ;

            $("#stats-header").html(xhtml);

            //$("#stats-body").html(bhtml);

            $("#stats-container").print(
            {
                    // Use Global styles
                    globalStyles : true, 

                    // Add link with attrbute media=print
                    mediaPrint : false, 

                    //Custom stylesheet
                   // stylesheet : "", 

                    //Print in a hidden iframe
                    iframe : false, 

                    // Don't print this
                   // noPrintSelector : ".avoid-this",

                    // Add this on top
                    append : "Estadisticas", 

                    // Add this at bottom
                   // prepend : "OK",

                    // Manually add form values
                    manuallyCopyFormValues: true,

                    // resolves after print and restructure the code for better maintainability
                    deferred: $.Deferred(),

                    // timeout
                    timeout: 250,

                    // Custom title
                    title: null,

                    // Custom document type
                    doctype: '<!DOCTYPE html>'
            });
            $("#stats-header").html("");
      });
</script>