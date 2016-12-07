<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar tecnicos</h3>
    </div>
    <form method = "POST" action = "#">
        <label>Filtrar por:</label>
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_name" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_name" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Cedula</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_ci" name = "canfiltrerci">
                    </span>
                    <input type="text" id = "txt_ci" class="form-control" name = "filtrerci" >
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
                    <th>correo</th>
                </tr>
            <thead>
            <tbody id = "tablecont">
                
            </tbody>
        </table>
        <div id = "mpag" >
        </div>
    </div>
</div>
<script type = "text/javascript">

function validate_delete()
{
    return confirm("Desea eliminar este registro?");
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
            url: "<?php echo base_url('index.php/user/getalltecs'); ?>",
            datatype : 'json', 
            data: {} ,
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
                populate(m_json);
            }
        }
    );
}
function populate(xjson , isfiltrer)
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
        _html += "<tr><th>" + xjson[data].cedula_usuario + "</th>" + 
        "<th>" + xjson[data].nombre + "</th>" +
        "<th>" + xjson[data].correo + "</th>" +
        "<th>" + '<a class = "btn btn-primary" href = "<?php echo base_url('/')?>?ci=' + xjson[data].cedula_usuario + '&action=edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a> ' + "</th>" +
        "<th>" + '<a class = "btn btn-danger" onclick="return validate_delete();"  href = "<?php echo base_url('/')?>?ci=' + xjson[data].cedula_usuario + '&action=remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</a> ' + "</th></tr>" ;
    }
    $("#tablecont").html(_html); 
}
</script>