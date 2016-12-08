<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar equipos</h3>
    </div>
    <form method = "POST" action = "#">
        <label>Filtrar por:</label>
        <div class = "form-group">
            <div class = "row">
                  <div class = "col-md-5">
                    <label>Procesador</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_cpu" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_cpu" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Tarjeta grafica</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_gpu" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_gpu" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Memoria Ram:</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_ram" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_ram" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Disco duro:</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_hdd" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_hdd" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Tarjeta madre</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_mother" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_mother" class="form-control" name = "filtrername">
                    </div>
                 </div>
                 <div class = "col-md-5">
                    <label>Fuente de poder</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_power" name = "canfiltrername" >
                    </span>
                    <input type="text" id = "txt_power" class="form-control" name = "filtrername">
                    </div>
                 </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Procesador</th>
                    <th>Tarjeta grafica</th>
                    <th>Memoria Ram</th>
                    <th>Disco duro</th>
                    <th>Tarjeta madre</th>
                    <th>Fuente poder</th>
                </tr>
            <thead>
            <tbody id = "tablecont">

            </tbody>
        </table>
        <div id = "mpag">
        </div>
    </div>
</div>
<script type = "text/javascript">

$(document).ready(function()
{
    updatetable();
});

$("#ch_cpu").change(function()
{
    updatetable();
});

$("#ch_gpu").change(function()
{
    updatetable();
});

$("#ch_ram").change(function()
{
    updatetable();
});

$("#ch_hdd").change(function()
{
    updatetable();
});

$("#ch_mother").change(function()
{
    updatetable();
});

$("#ch_power").change(function()
{
    updatetable();
});

$("#txt_cpu").keyup(function()
{
    updatetable();
});

$("#txt_gpu").keyup(function()
{
    updatetable();
});

$("#txt_ram").keyup(function()
{
    updatetable();
});

$("#txt_hdd").keyup(function()
{
    updatetable();
});

$("#txt_mother").keyup(function()
{
    updatetable();
});

$("#txt_power").keyup(function()
{
    updatetable();
});

function updatetable()
{
    $.ajax
    (
        {
            type : "POST",
            url: "<?php echo base_url('index.php/user/getallpcs'); ?>",
            datatype : 'json', 
            data: {} ,
            success:
            function (res)
            {
                m_json = JSON.parse(res);
                
                var cpu_checked = $("#ch_cpu").is(':checked');
                if (cpu_checked)
                {
                    var cpu_arr = m_json.filter(function (value)
                    {
                        var filtrer_name = $("#txt_cpu").val();
                        var x = value.procesador.includes(filtrer_name);
                        return x ;
                    });
                    m_json = cpu_arr;
                }

                var gpu_checked = $("#ch_gpu").is(":checked");
                if (gpu_checked)
                {
                    var gpu_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_gpu").val();
                        var x = value.tarjeta_grafica.includes(filter_ci);
                        return x;
                    });
                    m_json = gpu_arr;
                }

                var ram_checked = $("#ch_ram").is(":checked");
                if (ram_checked)
                {
                    var ram_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_ram").val();
                        var x = value.memoria_ram.includes(filter_ci);
                        return x;
                    });
                    m_json = ram_arr;
                }

                var hdd_checked = $("#ch_hdd").is(":checked");
                if (hdd_checked)
                {
                    var hdd_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_hdd").val();
                        var x = value.disco_duro.includes(filter_ci);
                        return x;
                    });
                    m_json = hdd_arr;
                }

                var power_checked = $("#ch_power").is(":checked");
                if (power_checked)
                {
                    var hdd_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_power").val();
                        var x = value.fuente_poder.includes(filter_ci);
                        return x;
                    });
                    m_json = hdd_arr;
                }

                var mother_checked = $("#ch_mother").is(":checked");
                if (mother_checked)
                {
                    var hdd_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_mother").val();
                        var x = value.fuente_poder.includes(filter_ci);
                        return x;
                    });
                    m_json = hdd_arr;
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
        _html += "<tr><th>" + xjson[data].descripcion + "</th>" + 
        "<th>" + xjson[data].procesador + "</th>" +
        "<th>" + xjson[data].tarjeta_grafica + "</th>" +
        "<th>" + xjson[data].memoria_ram + "</th>" +
        "<th>" + xjson[data].disco_duro + "</th>" +
        "<th>" + xjson[data].tarjeta_madre + "</th>" +
        "<th>" + xjson[data].fuente_poder + "</th>" +
        "<th>" + '<a class = "btn btn-primary" onclick="return validate_delete();"  href = "<?php echo current_url()?>?id=' + xjson[data].id_equipo + '&action=remove"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a> ' + "</th>" +
        "<th>" + '<a class = "btn btn-danger" onclick="return validate_delete();"  href = "<?php echo current_url()?>?id=' + xjson[data].id_equipo + '&action=remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a> ' + "</th></tr>" ;
    }
    $("#tablecont").html(_html); 
}

</script>