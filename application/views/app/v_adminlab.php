<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar laboratorios</h3>
    </div>
    <form action = "#" method = "POST">
        <div class = "from-group" >
             <label>Filtrar por:</label>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre laboratorio</label>
                    <div class = "input-group">
                        <span class = "input-group-addon">
                            <input type = "checkbox" id = "check_labname" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro">
                        </span>
                        <input type = "text" id = "txt_labname" class = "form-control">
                    </div>
                </div>
                <div class = "col-md-5">
                    <label>Nombre sede</label>
                    <div class = "input-group">
                        <span class = "input-group-addon">
                            <input type = "checkbox" id = "check_sedename" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro">
                        </span>
                        <select id = "txt_sedename" class = "form-control">
                            <option value = "none">Seleccionar</option>
                            <?php 
                                 foreach($sedes as $sede)
                                 {
                                     $opc = '<option value ="' . $sede->id_sede . '">' . $sede->nombre . '</option>' ; 
                                     echo $opc;
                                 }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class = "table-responsive" >
        <table class = "table table-striped">
            <thead>
                <tr>
                    <th>Laboratorio</th>
                    <th>Sede</th>
                </tr>
            </thead>
            <tbody id = "tablefill">

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
    
    var json  = "" ; 

    function validate_edit()
    {
        return confirm("Desea editar este laboratorio ?");
    }

    function validate_delete()
    {
        return confirm("Desea ELIMINAR este laboratorio ?");
    }

    $(document).ready(function() 
    {
        get_data();
    });

    $("#check_labname").change(function()
    {
        get_data();
    });

    $("#txt_labname").keyup(function()
    {
        get_data();
    });

    $("#check_sedename").change(function()
    {
        get_data();
    });

    $("#txt_sedename").change(function()
    {
        get_data();
    });

    function get_data()
    {
        $.ajax
        ({
            type: "POST",
            url: "<?php echo base_url('index.php/user/ajax_getall_labs'); ?>",
            data: {request: true},
            success:
            function (res)
            {
                json = JSON.parse(res);   
                var labchecked = $("#check_labname").is(':checked');
                if (labchecked)
                {
                    var lab_arr = json.filter(function(value){
                        var f_lab = $("#txt_labname").val();
                        var canpass =  value.descripcion.includes(f_lab);
                        return canpass;
                    });
                    json = lab_arr;
                }

                var sedechecked = $("#check_sedename").is(':checked');
                if (sedechecked)
                {
                    var sede_arr = json.filter(function(value)
                    {
                        var f_sede = $("#txt_sedename").val();
                        var canpass = value.id_sede.includes(f_sede);
                        return canpass;
                    });
                    json = sede_arr ;
                }
                populate(json);
            }

        });    
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
        var sede = xjson[data].sedename;
        var lab = xjson[data].descripcion;
        _html += "<tr>" + 
        "<th>" + lab + "</th>" + 
        "<th>" + sede + "</th>" + 
        "<th>" + '<a href = "<?php echo base_url("index.php/user/adminlab");?>?labid=' +  xjson[data].id_laboratorio + '&action=edit"  class = "btn btn-primary" onclick = "return validate_edit();"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>' + "</th>" + 
        "<th>" + '<a href = "<?php echo base_url("index.php/user/adminlab");?>?labid=' +  xjson[data].id_laboratorio + '&action=delete"  class = "btn btn-danger" onclick = "return validate_delete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>' + "</th>" + 
        + "</tr>"
    }
    $("#tablefill").html(_html);
}
</script>