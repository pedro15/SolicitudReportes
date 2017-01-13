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
                    <input type="checkbox" id = "ch_cpu"  >
                    </span>
                    <input type="text" id = "txt_cpu" class="form-control">
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Tarjeta grafica</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_gpu"  >
                    </span>
                    <input type="text" id = "txt_gpu" class="form-control">
                    </div>
                 </div>
                 
                 <div class = "col-md-5">
                    <label>Memoria Ram:</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_ram"  >
                    </span>
                    <input type="text" id = "txt_ram" class="form-control">
                    </div>
                 </div>
                 
                 <div class = "col-md-5">
                    <label>Disco duro:</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_hdd"  >
                    </span>
                    <input type="text" id = "txt_hdd" class="form-control">
                    </div>
                 </div>
                 
                 <div class = "col-md-5">
                    <label>Tarjeta madre</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_mother"  >
                    </span>
                    <input type="text" id = "txt_mother" class="form-control">
                    </div>
                 </div>
                 
                 <div class = "col-md-5">
                    <label>Fuente de poder</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_power"  >
                    </span>
                    <input type="text" id = "txt_power" class="form-control">
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Monitor</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_monitor">
                    </span>
                    <input type="text" id = "txt_monitor" class="form-control">
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Teclado</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_teclado">
                    </span>
                    <input type="text" id = "txt_teclado" class="form-control">
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Lector CD / DVD</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_dvd">
                    </span>
                    <input type="text" id = "txt_dvd" class="form-control">
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Sistema Operativo</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                    <input type="checkbox" id = "ch_so">
                    </span>
                    <input type="text" id = "txt_so" class="form-control">
                    </div>
                 </div>

                  <div class = "col-md-5">
                    <label>Sede</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <input type="checkbox" id = "ch_sede" name = "canfiltrername" >
                        </span>
                        <?php 
                            if (isset($sedes))
                            {
                        ?>
                        <select id = "select_sede" class = "form-control" > 
                            <option>Seleccionar</option>
                            <?php 
                                foreach($sedes as $sede)
                                {
                                    $opc = '<option value ="' . $sede->id_sede . '">' . $sede->nombre . '</option>' ; 
                                    echo $opc;
                                }
                            ?>
                        </select>
                        <?php 
                            }else 
                            {
                                echo '<p>No hay sedes registradas</p>' ;
                            }
                        ?>
                    </div>
                 </div>

                 <div class = "col-md-5">
                    <label>Laboratorio</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <input type="checkbox" id = "ch_lab" name = "canfiltrername" >
                        </span>
                        <select id = "select_lab" class = "form-control" > 

                        </select>
                    </div>
                 </div>

            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sede</th>
                    <th>Laboratorio</th>
                    <th>Procesador</th>
                    <th>Tarjeta grafica</th>
                    <th>Memoria ram</th>
                    <th>Disco duro</th>
                    <th>Tarjeta madre</th>
                    <th>Fuente poder</th>
                    <th>Monitor</th>
                    <th>Teclado</th>
                    <th>Lector CD/DVD</th>
                    <th>Sistema Operativo</th>
                </tr>
            </thead>
            <tbody id = "tablecont">

            </tbody>
        </table>
        <div id = "mpag">
        </div>
    </div>
<script type = "text/javascript">

$(document).ready(function()
{
    updatetable();
});

$("#select_sede").change(function()
{
    var _value = $("#select_sede").val();
    $.ajax
    (
        {
            type: "POST" ,
            url: "<?php echo base_url('index.php/user/getlabsbysede'); ?>",
            datatype : 'json', 
            data: { id_sede_json: _value },
            success: 
            function (res)
            {
                var json = JSON.parse(res);
                var _content = "<option>Seleccionar</option>";
                for (data in json)
                {
                    _content += '<option>' + json[data].descripcion + '</option>' ; 
                }
                $("#select_lab").html(_content);
            }
        }
    );
    updatetable();
});

$("#select_lab").change(function()
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

$("#ch_lab").change(function()
{
    updatetable();
});

$("#ch_sede").change(function()
{
    updatetable();
});

$("#ch_monitor").change(function()
{
    updatetable();
});

$("#ch_teclado").change(function()
{
    updatetable();
});

$("#ch_dvd").change(function()
{
    updatetable();
});

$("#ch_so").change(function()
{
    updatetable();
});

$("#txt_monitor").keyup(function()
{
    updatetable();
});

$("#txt_teclado").keyup(function()
{
    updatetable();
});

$("#txt_dvd").keyup(function()
{
    updatetable();
});

$("#txt_so").keyup(function()
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
                        var x = value.tarjeta_madre.includes(filter_ci);
                        return x;
                    });
                    m_json = hdd_arr;
                }

                var lab_checked = $("#ch_lab").is(":checked");
                if (lab_checked)
                {
                    var lab_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#select_lab").val();
                        var x = value.labname.includes(filter_ci);
                        return x;
                    });
                    m_json = lab_arr;
                }

                var sede_checked = $("#ch_sede").is(":checked");
                if (sede_checked)
                {
                    var sede_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#select_sede").find('option:selected').text();
                        var x = value.sedename.includes(filter_ci);
                        return x;
                    });
                    m_json = sede_arr;
                }

                var monitor_checked = $("#ch_monitor").is(":checked");
                if (monitor_checked)
                {
                    var monitor_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_monitor").val();
                        var x = value.monitor.includes(filter_ci);
                        return x;
                    });
                    m_json = monitor_arr;
                }

                var teclado_checked = $("#ch_teclado").is(":checked");
                if (teclado_checked)
                {
                    var teclado_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_teclado").val();
                        var x = value.teclado.includes(filter_ci);
                        return x;
                    });
                    m_json = teclado_arr;
                }

                var dvd_checked = $("#ch_dvd").is(":checked");
                if (dvd_checked)
                {
                    var dvd_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_dvd").val();
                        var x = value.lector_dvd.includes(filter_ci);
                        return x;
                    });
                    m_json = dvd_arr;
                }

                var so_checked = $("#ch_so").is(":checked");
                if (so_checked)
                {
                    var dvd_arr = m_json.filter(function (value)
                    {
                        var filter_ci = $("#txt_so").val();
                        var x = value.sistema_operativo.includes(filter_ci);
                        return x;
                    });
                    m_json = dvd_arr;
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

function validate_edit()
{
    return confirm("Desea editar este equipo?"); 
}

function validate_delete()
{
    return confirm("Desea eliminar este equipo?");
}

function updatehtml(xjson)
{
    var _html = "" ;
    for (data in xjson)
    {
        var _monitor = (xjson[data].monitor != "" ) ? xjson[data].monitor  : "n/d" ;
        var _teclado = (xjson[data].teclado != "") ? xjson[data].teclado : "n/d" ;
        var _lector_dvd = (xjson[data].lector_dvd != "") ? xjson[data].lector_dvd : "n/d" ;
        var _sistema_operativo = (xjson[data].sistema_operativo != "") ? xjson[data].sistema_operativo : "n/d" ;

        _html += "<tr><th>" + xjson[data].descripcion + "</th>" + 
        "<th>" + xjson[data].sedename + "</th>" +
        "<th>" + xjson[data].labname + "</th>" +
        "<th>" + xjson[data].procesador + "</th>" +
        "<th>" + xjson[data].tarjeta_grafica + "</th>" +
        "<th>" + xjson[data].memoria_ram + "</th>" +
        "<th>" + xjson[data].disco_duro + "</th>" +
        "<th>" + xjson[data].tarjeta_madre + "</th>" +
        "<th>" + xjson[data].fuente_poder + "</th>" +
        "<th>" + _monitor + "</th>" +
        "<th>" + _teclado + "</th>" +
        "<th>" + _lector_dvd + "</th>" +
        "<th>" + _sistema_operativo + "</th>" +
        "<th>" + '<a class = "btn btn-primary" onclick="return validate_edit();"  href = "<?php echo base_url("index.php/user/editpc")?>?id=' + xjson[data].id_equipo + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a> ' + "</th>" +
        "<th>" + '<a class = "btn btn-danger" onclick="return validate_delete();"  href = "<?php echo current_url()?>?id=' + xjson[data].id_equipo + '&action=remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a> ' + "</th></tr>" ;
    }
    $("#tablecont").html(_html); 
}
</script>