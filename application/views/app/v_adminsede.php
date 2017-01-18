<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar Sedes</h3>
    </div>
    <div class = "row">
            <label>Filtrar por:</label>
            <div classs = "row">
                    <div class = "col-md-6">
                        <label>Nombre</label>
                        <div class = "input-group">
                            <span class = "input-group-addon">
                                <input type = "checkbox" id = "ch_sede" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                            </span>
                            <input type = "text" class = "form-control" id = "txt_sede"> 
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <label>Ubicación</label>
                        <div class = "input-group">
                            <span class = "input-group-addon">
                                <input type = "checkbox" id = "ch_location" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                            </span>
                            <input type = "text" class = "form-control" id = "txt_location"> 
                        </div>
                    </div>
            </div>
    </div>
        <div class="table-responsive" >
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                </tr>
            </thead>
            <tbody id = "tablecont">
                
            </tbody>
        </table>
        <div id = "mpag" >
        </div>
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

    var json = "" ;
    function validate_delete()
    {
        return confirm("Desea eliminar esta sede?, toda la infomacion relacionada con la misma sera eliminada.");
    }

    function validate_edit()
    {
        return confirm("Desea editar esta sede?");
    }

    $(document).ready(function(){
        get_data();
    });

    $("#ch_sede").change(function()
    {
        get_data();
    });

    $("#txt_sede").change(function()
    {
         get_data();
    });

    $("#txt_sede").keyup(function()
    {
         get_data();
    });

    $("#ch_location").change(function()
    {
         get_data();
    });

    $("#txt_location").change(function(){
         get_data();
    });

    $("#txt_location").keyup(function()
    {
         get_data();
    });

    function get_data()
    {
        $.ajax
        (
            {
                type : "POST" ,
                url: "<?php echo base_url('index.php/user/getallsedes'); ?>",
                datatype: 'json',
                data: {},
                success:
                function (res)
                {
                    json = JSON.parse(res);

                    var enablefilter = $("#ch_sede").is(':checked');
                    if (enablefilter)
                    {
                        var filterarr = json.filter(function(value)
                        {
                            var text_sede = $("#txt_sede").val();
                            var canpass = value.nombre.includes(text_sede);
                            return canpass;
                        });
                        json = filterarr ; 
                    }

                    var locfilter = $("#ch_location").is(':checked');
                    if (locfilter)
                    {
                        var locarr = json.filter(function(value)
                        {
                            var text_loc = $("#txt_location").val();
                            var canpass = value.ubicacion.includes(text_loc);
                            return canpass;
                        });
                        json = locarr;
                    }
                    populate(json);
                }
            }
        )
    }

    function populate(xjson)
    {
       updatehtml(xjson);
       $("#mpag").pagination
       ({
           dataSource: xjson,
           pageSize : 20,
           callback: function(data, pagination) 
           {
              xjson = data;
              updatehtml(xjson);
           }
       });
    }

    function updatehtml(xjson)
    {
         var _html = "" ; 
         for (data in xjson)
         {
            _html += "<tr>" +
            "<th>" + xjson[data].nombre + "</th>" +
            "<th>" + xjson[data].ubicacion + "</th>" +
            "<th>" + '<a onclick = "return validate_edit();" href = "<?php echo current_url()?>?idsede=' + xjson[data].id_sede + '&action=edit" class = "btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>' + "</th>" +
            "<th>" + '<a onclick = "return validate_delete();" href = "<?php echo current_url()?>?idsede=' + xjson[data].id_sede + '&action=delete" class = "btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>' + "</th>" + "</tr>" ;
         }
         $("#tablecont").html(_html);
    }
</script>