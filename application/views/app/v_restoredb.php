<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    
    <div class = "page-header">
        <div class = "row">
            <div class = "col-xs-1">
                <img src = "<?php echo base_url('images/db.png') ?>" alt = "database icon" width = "30" height = "30" style = "margin-top: 15px; " />
            </div>
            <div class = "col-md-5">
                <h3>Restaurar base de datos</h3>
            </div>
        </div>
    </div>
    <div class = "alert alert-warning" > 
        <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
        Seleccione un elemento de la lista de respaldos, luego haga clic en el botón 'restaurar' para ejecutar la restauración del mismo.
    </div>
    <form action = "#" method = "POST">
        <div class = "form-group">
            <label>Buscar:</label>
            <div class = "input-group">
                <div class = "input-group-addon">
                    <input type = "checkbox" id = "ch_filter" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" > 
                </div>
                <input type = "text" id = "txt_filter" class = "form-control">
            </div>
        </div>
    </form>
    <div class = "table-responsive">
        <table class = "table table-hover">
            <thead>
                <tr>
                    <th>
                        Respaldo
                    </th>
                </tr>
            </thead>
            <tbody id = "backupfill" >

            </tbody>
        </table>
    </div>
    <div id = "paginate">
    </div>
</div>

<div id = "dialog-loading">
    <label>Restaurando base de datos, por favor espere.</label>
    <div id="fountainG">
    	<div id="fountainG_1" class="fountainG"></div>
    	<div id="fountainG_2" class="fountainG"></div>
    	<div id="fountainG_3" class="fountainG"></div>
    	<div id="fountainG_4" class="fountainG"></div>
    	<div id="fountainG_5" class="fountainG"></div>
    	<div id="fountainG_6" class="fountainG"></div>
    	<div id="fountainG_7" class="fountainG"></div>
    	<div id="fountainG_8" class="fountainG"></div>
    </div>
</div>

<script type = "text/javascript">

    $('[data-toggle="tooltip"]').mouseenter(function()
    {
        $(this).tooltip('show');
    });
    $('[data-toggle="tooltip"]').mouseout(function()
    {
        $(this).tooltip('hide');
    });

    $("#ch_filter").change(function(){ updatebackups(); }); 
    
    $("#txt_filter").keyup(function(){ updatebackups(); });

    $("#txt_filter").change(function(){ updatebackups(); });

    function populate(xjson)
    {
        updatehtml(xjson);
        $("#paginate").pagination
        ({
                dataSource: xjson,
                pageSize : 8,
                callback: function(data, pagination) 
                {
                   xjson = data;
                   updatehtml(xjson);
                }
        });
    }

    function updatebackups()
    {
        $.ajax
        ({
            url: "<?php echo base_url('index.php/user/get_backupsjson'); ?>" ,
            type: "POST" ,
            data: {request: true },
            success: 
            function (data)
            {
                var json = JSON.parse(data);
                var filter_enabled = $("#ch_filter").is(':checked');
                if (filter_enabled)
                {
                    var filter_arr = json.filter(function(val)
                    {
                        var filterval = $("#txt_filter").val();
                        return val.includes(filterval);
                    });
                    json = filter_arr;
                }
                populate(json);
            }
        });
    }

    function Restore(xid)
    {
        if (confirm("Desea restaurar la base de datos con el elemento seleccionado?"))
        {
            $.ajax
            ({
                 url: "<?php echo base_url('index.php/user/call_backup'); ?>" ,
                 type: "POST" ,
                 data: {id: xid },
                 success:
                 function (val)
                 {
                     $("#dialog-loading").dialog("close");
                     var result = JSON.parse(val);
                     if (result == true )
                     {
                         alert("Base de datos restaurada correctamente");
                     }else 
                     {
                         alert("Error al restaurar base de datos");
                     }
                 },
                 beforeSend: function (val)
                 {
                     $("#dialog-loading").dialog("open");
                 }
            });
        }
    }

    function Remove(xid)
    {
        if (confirm("Desea eliminar el elemento seleccionado?"))
        {
            $.ajax
            ({
                 url: "<?php echo base_url('index.php/user/call_remove_backup'); ?>" ,
                 type: "POST" ,
                 data: {id: xid },
                 success:
                 function (val)
                 {
                    updatebackups();
                 }
            });
        }
    }

    function updatehtml(xjson)
    {
        html = '' ; 
        for (i = xjson.length - 1 ; i >= 0 ; i--)
        {
            html+= 
            '<tr>' +
            '<th>' + xjson[i] + '</th>' +  
            '<th>' + '<a class = "btn btn-primary" onclick = "Restore(' + i + ');" >' + '<span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span> ' +  'Restaurar' +  '</a>' + '</th>' +  
            '<th>' + '<a class = "btn btn-danger" onclick = "Remove(' + i + ');" >' + '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ' +  'Eliminar' +  '</a>' + '</th>' +
            '</tr>' ;   
        }
        $("#backupfill").html(html);
    }

    $(document).ready(function()
    {
        updatebackups();
        $("#dialog-loading").dialog(
        {
            dialogClass: "no-close",
            modal: true ,
            autoOpen: false ,
            draggable: false  ,
            minWidth: 400,
            title: "Restaurando base de datos..."
        });

    });

</script>