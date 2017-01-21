<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar usuarios</h3>
    </div>
    <form method = "POST" action = "#">
        <label>Filtrar por:</label>
        <div class = "form-group">
            <div class = "row">
                <!-- Nombre -->
                <div class = "col-md-5">
                    <label>Nombre</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" id = "ch_name" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                    </span>
                    <input type="text" id = "txt_name" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <!-- Cedula -->
                 <div class = "col-md-5">
                    <label>Cedula</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_ci" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                    </span>
                    <input type="text" onkeypress="return isNumberKey(event);" maxlength="11" id = "txt_ci" class="form-control" name = "filtrerci" >
                    </div>
                 </div>
                 <!-- Nivel de privilegio -->
                 <div class = "col-md-5">
                    <label>Nivel de privilegio</label>
                    <div class = "input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" id = "ch_type" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                        </span>
                        <select id = "selecttype" class = "form-control">
                            <option value = "none">Seleccionar</option>
                            <option value = "1">Participante / Instructor</option>
                            <option value = "2">Técnico</option>
                            <option value = "3">Administrador</option>
                        </select>
                    </div>
                 </div>
            </div>
        </div>
    </form>

    <div class="table-responsive" >
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Estado</th>
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

function validate_delete()
{
    return confirm("Desea ELIMINAR a este usuario ?");
}

function validate_disable()
{
    return confirm("Desea deshabilitar a este usuario en el sistema ?");
}

function validate_hability()
{
    return confirm("Desea habilitar a este usuario en el sistema?");
}

function validate_resetpw()
{
    return confirm("Desea reinicar la clave para este usuario ?");
}

var m_json = "";

$(document).ready(function()
{
    updatetable();
});
$("#ch_name").change(function()
{
    updatetable();
});

$("#ch_ci").change(function()
{
    updatetable();
});

$("#ch_type").change(function()
{
    updatetable();
});

$("#selecttype").change(function()
{
    updatetable();
});

$("#txt_name").keyup(function()
{
    updatetable();
});
$("#txt_ci").keyup(function()
{
    updatetable();
});

function updatetable()
{
    $.ajax
    (
        {
            type : "POST",
            url: "<?php echo base_url('index.php/user/ajax_getallusers'); ?>",
            data: {},
            success:
            function (res)
            {
                m_json = JSON.parse(res);
                var name_checked = $("#ch_name").is(':checked');
                if (name_checked)
                {
                    var f_arr = m_json.filter(function (value)
                    {
                        var filtrer_name = $("#txt_name").val();
                        var x = value.nombre.includes(filtrer_name);
                        return x ;
                    });
                    m_json = f_arr;
                }
                var ci_checked = $("#ch_ci").is(":checked");
                if (ci_checked)
                {
                    var m_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_ci").val();
                        var x = value.cedula_usuario.includes(filter_ci);
                        return x;
                    });
                    m_json = m_arr;
                }

                var type_checked = $("#ch_type").is(":checked");
                if (type_checked)
                {
                    var m_arr = m_json.filter(function (value)
                    {
                        var filtrer_ch = $("#selecttype").val();
                        var x = value.tipo.includes(filtrer_ch);
                        return x;
                    });
                    m_json = m_arr;
                }
                populate(m_json);
            }
        }
    );
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
        var _t = xjson[data].habilitado > 0 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Habilitado' :  '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Desabilitado' ;
        var _h = xjson[data].habilitado > 0 ? 
        "<th>" + '<a class = "btn btn-danger" onclick="return validate_disable();"  href = "<?php echo current_url()?>?ci=' + xjson[data].cedula_usuario + '&action=disable"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deshabilitar</a> ' + "</th>" 
        : "<th>" + '<a class = "btn btn-success" onclick="return validate_hability();"  href = "<?php echo current_url()?>?ci=' + xjson[data].cedula_usuario + '&action=enable"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Habilitar</a> ' + "</th>" ;
        var type = "" ;
        var currt = xjson[data].tipo;
        switch(currt)
        {
            // Participante/instructor
            case "1" :     
                type = "Participante/Instructor"; 
            break;

            // Tecnico
            case "2" :
                type = "Técnico" ; 
            break ; 

            // Administrador
            case "3" : 
                type = "Administrador" ;
            break;
        }

        _html += "<tr><th>" + xjson[data].cedula_usuario + "</th>" + 
        "<th>" + xjson[data].nombre + "</th>" +
        "<th>" + xjson[data].correo + "</th>" +
        "<th>" + type + "</th>" +
        "<th>" + _t + "</th>" +
        _h  +
        "<th>" + '<a class = "btn btn-danger" onclick="return validate_delete();"  href = "<?php echo current_url()?>?ci=' + xjson[data].cedula_usuario + '&action=remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a> ' + "</th>" +
        "<th>" + '<a class = "btn btn-primary" onclick ="" href = "<?php echo base_url('index.php/user/changetype')?>?ci=' + xjson[data].cedula_usuario + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Cambiar privilegio</a></th>' + 
        "<th>" + '<a class = "btn btn-primary" onclick ="return validate_resetpw();" href = "<?php echo current_url()?>?ci=' + xjson[data].cedula_usuario + '&action=resetpw"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reiniciar clave</a></th>' + 
        "</tr>" ;
    }
    $("#tablecont").html(_html); 
}
</script>