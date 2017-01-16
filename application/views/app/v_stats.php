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
                     <input type = "radio" id = "radio-falla" name = "tipo-busqueda" value = "falla-comun"> <label>Falla mas comun</label>
                </div>
                <div class = "col-md-3">
                     <input type = "radio" if = "radio-equipo"  name = "tipo-busqueda" value = "equipo-comun"> <label>Equipo con mas fallas</label>
                </div>
            </div>
       </div>
       <div class = "form-group">
            <div class = "row">
                <div class = "col-md-2 col-xs-3">
                    <input type = "submit" class = "btn btn-primary" value = "Generar estadistica">
                </div>
                <div class = "col-md-2 col-xs-2">
                    <a class = "btn btn-primary" id = "printbtn">
                         Imprimir  <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
       </div>
    </form>
    <div id = "stats-container"  >
        <div class = "container">
            <div id = "stats-header">
            </div>
            <div class = "ct-golden-section ct-chart" >
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
                    if (isset($busquedatipo))
                    {
                        $opc = '<input type = "hidden" name = "opcurr" value ="' . $busquedatipo . '" >
                            '; 
                        echo $opc;    
                    }
                ?>
            </form>
        <?php
    }
?>
<script type = "text/javascript">

     var labels_chart = [] ; 
     var series_chart = [] ;

      function orderarr()
      {
          if (labels_chart.length > 0 && series_chart.length > 0 )
          {
              for (var i = 0; i < series_chart.length ; i++)
              {
                  for (var j = 0 ; j < series_chart.length ; j++)
                  {
                    var _next = i + 1 ; 
                    if (_next < series_chart.length )
                    {
                         if ( series_chart[j] >  series_chart[_next] )
                         {
                             series_aux = series_chart[j];
                             labels_aux = labels_chart[j];
                             series_chart[j] = series_chart[_next] ; 
                             series_chart[_next] = series_aux ;
                             labels_chart[j] = labels_chart[_next] ; 
                             labels_chart[_next] = labels_aux ; 
                         }
                    }
                  }
              }
          }
      }

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

          orderarr();

          if (labels_chart.length > 0 && series_chart.length > 0 )
          {
            new Chartist.Bar('.ct-chart', 
            {
              labels: labels_chart,
              series: [series_chart]
            },{fullWidth: true, height: 600, axisY: { onlyInteger: true,offset: 20}});
          }
            var itemsbody = '' ; 
            for (var i = series_chart.length - 1; i >= 0  ; i--)
            {
                itemsbody += '<tr>' + '<th>' + labels_chart[i] + '</th>' + '<th>' + series_chart[i] + '</th>'  + '</tr>' ; 
            }
            var bhtml = '<div class = "table-responsive">' + 
            '<table class = "table table-stripped table-bordered">' + 
            '<thead><tr><th>Elemento</th><th>Cantidad</th></thead>' + 
            '<tbody>' + 
            itemsbody + 
            '</tbody></table></div>' ;  
            $("#stats-body").html(bhtml);
      }
      $(document).ready(function()
      {
         initdates();
         initchart();
         var currsede =  $('input[name="sedecurr"]').val();
         if (currsede != undefined )
         {
             $("#selectsede").val(currsede).change();
         }
      });

      $("#printbtn").click(function()
      {
            var opcselected = $('input[name="opcurr"]').val(); 
            var opctxt = "" ; 
            if (opcselected == 'falla-comun')
            {
                opctxt = "falla mas comun" ;
            }else if (opcselected == 'equipo-comun')
            {
                opctxt = "equipos con mas fallas" ; 
            }
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
                    title: 'Estadisticas',

                    // Custom document type
                    doctype: '<!DOCTYPE html>'
            });
            $("#stats-header").html("");
      });
</script>
<script type="text/javascript" src="<?php echo base_url('/')?>chartist-js/chartist.min.js"></script>