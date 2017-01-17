<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar solicitudes de soporte tecnico (solo consulta)</h3>
    </div>
    <form method = "post" action = "#">
        <label>Filtrar por:</label>
        <div class = "row">
            <div class = "col-md-5">
            <label>Sede</label>
            <div class = "input-group">
                <div class = "input-group-addon">
                    <input type = "checkbox" id = "ch_sede" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                </div>
                <select id = "selectsede" class = "form-control">
                    <option value = "none">Seleccionar</option>
                    <?php 
                        if (isset($sedes))
                        {
                            foreach ($sedes as $sede)
                            {
                                $opc = '<option value = "' . $sede->id_sede . '">' . $sede->nombre . '</option>' ; 
                                echo $opc;
                            }
                        }
                    ?>
                </select>
            </div>
            </div>
            <div class = "col-md-5">
                <label>Laboratorio</label>
                <div class = "input-group">
                    <div class = "input-group-addon">
                        <input type = "checkbox" id = "ch_lab" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" > 
                    </div>
                    <select id = "selectlab" class = "form-control" >
                        <option value = "none" >Seleccionar</option>
                    </select>
                </div>
            </div>

            <div class = "col-md-5">
                <label>Estado</label>
                <div class = "input-group">
                    <div class = "input-group-addon">
                        <input type = "checkbox" id = "ch_estado" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                    </div>
                    <select id = "selectestado" class = "form-control">
                        <option value = "none">Seleccionar</option>
                        <option value = "0">Sin Reparar</option>
                        <option value = "1">En revision</option>
                        <option value = "2">Reparado</option>
                    </select>
                </div>
            </div>

            <div class = "col-md-5">
                <label>Categoria</label>
                <div class = "input-group" >
                    <div class = "input-group-addon">
                        <input type = "checkbox" id = "ch_categoria" data-toggle="tooltip" data-placement="top" title="Activar/Desactivar filtro" >
                    </div>
                    <select id = "selectcategoria" class = "form-control">
                        <option value = "none">Seleccionar</option>
                         <?php 
                          if (isset($categorias))
                          {
                            foreach ($categorias as $key => $cat)
                            {
                                $opc = '<option value ="' . $key . '">' . $categorias[$key] . '</option>' ; 
                                echo $opc;
                            }
                          }
                        ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>
<div class = "container report-container">
    <div class = "row" id = "fillticket">

    </div>
    <div id = "paginate" >
                
    </div>
</div>
<form name = "dataform" action = "#" mathod = "POST" > 
    <?php 
        $opc = '<input type = "hidden" id = "userci" value ="' . $userci . '">' ; 
        echo $opc;
    ?>
</form>

<script type = "text/javascript">

    $('[data-toggle="tooltip"]').mouseenter(function()
    {
        $(this).tooltip('show');
    });
    $('[data-toggle="tooltip"]').mouseout(function()
    {
        $(this).tooltip('hide');
    });
    
    $(document).ready(function()
    {
        updateticketdata();
    });

    $("#ch_categoria").change(function()
    {
        updateticketdata();
    });

    $("#ch_sede").change(function()
    {
        updateticketdata();
    });

    $("#ch_lab").change(function()
    {
        updateticketdata();
    });

    $("#ch_estado").change(function()
    {
        updateticketdata();
    });

    $("#selectestado").change(function()
    {
        updateticketdata();
    });

    $("#selectlab").change(function()
    {
        updateticketdata();
    });

    $("#ch_sede").change(function()
    {
        updateticketdata();
    });

    $("#ch_lab").change(function()
    {
        updateticketdata();
    });

    $("#ch_estado").change(function()
    {
        updateticketdata();
    });

    $("#selectcategoria").change(function()
    {
        updateticketdata();
    });

    $("#selectsede").change(function()
    {
        var sedeval = $(this).val();
        $.ajax
        ({
            url: "<?php echo base_url('index.php/user/getall_labs'); ?>",
            type: "POST" ,
            dataType: 'json' ,
            data: {} ,
            success: function (data){
                var json = data.filter(function(value)
                {
                    return value.id_sede == sedeval ; 
                });
                var _html = '<option value = "none">Seleccionar</option>' ; 
                for (id in json)
                {
                    var elm = '<option value = "' + json[id].id_laboratorio + '">' + 
                    json[id].descripcion + '</option>' ; 
                    _html += elm;
                }
                $("#selectlab").html(_html);
            }
        });
        updateticketdata();
    });

    function paginatetickets(json)
    {
        filltickets(json);
        $("#paginate").pagination
        ({
            dataSource: json,
            pageSize : 20,
            callback: function(data, pagination) 
            {
               filltickets(data);
            }
        });
    }

    function updateticketdata()
    {
        $.ajax
        ({
            url: "<?php echo base_url('index.php/user/getallticketsjson'); ?>" ,
            type: "POST",
            dataType : 'json' , 
            data: {request: true } ,
            success: function (data)
            {
                var xdata = data.filter(function (val)
                {
                    return val.usuarioactual.cedula_usuario == $("#userci").val();
                });

                var sedechecked = $("#ch_sede").is(':checked');

                if (sedechecked)
                {
                    var sede_arr = xdata.filter(function (value)
                    {
                        return value.sedeactual.id_sede == $("#selectsede").val();
                    });

                    xdata = sede_arr;
                }

                var labchecked = $("#ch_lab").is(':checked');

                if (labchecked)
                {
                    var lab_arr = xdata.filter(function (value)
                    {
                        return value.laboratorioactual.id_laboratorio == $("#selectlab").val();
                    });

                    xdata = lab_arr;
                }

                var estadochecked = $("#ch_estado").is(':checked');
                if (estadochecked)
                {
                    var estado_arr = xdata.filter(function(value)
                    {
                        return value.estadoactual.estado == $("#selectestado").val();
                    });

                    xdata = estado_arr ; 
                }

                var categoriacheceked = $("#ch_categoria").is(':checked');
                if (categoriacheceked)
                {
                    var categoria_arr = xdata.filter(function(value)
                    {
                        return value.tipo == $("#selectcategoria").val();
                    });
                    xdata = categoria_arr;
                }

                paginatetickets(xdata);
            }
        });
    }

    function filltickets(xjson)
    {
            var html = "";
            for ( data in xjson )
            {
                var iconurl = "<?php echo base_url('images/alerticons/'); ?>" ; 
                var estado = "Sin reparar" ;  
                var estadonum = xjson[data].estadoactual.estado;
                switch (estadonum)
                {
                    case "0": 
                        estado = "Sin reparar" ; 
                        iconurl = iconurl + "red.png" ; 
                    break;

                    case "1": 
                        estado = "En revision" ;
                        iconurl += "yellow.png" ;  
                    break ;

                    case "2": 
                        estado = "Reparado" ; 
                        iconurl += "green.png" ; 
                    break; 
                }
                html += 
                '<div class = "col-md-5 report-ticket" >'
                + '<div class = "report-header">'
                + '<div class = "row">' 
                + '<div class = "col-md-5">' 
                + 'Estado: <strong>' + estado + '</strong>' 
                + ' <img src ="' + iconurl + '" alt="alerticon" width = "16" height = "16" />'
                + '</div>'
                + '</div>'
                + '</div>'
                + '<div class = "report-ticket-darkbody">'  
                + '<div class = "row" >'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Sede:</strong> ' +  xjson[data].sedeactual.nombre 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><strong> Laboratorio:</strong> ' +  xjson[data].laboratorioactual.descripcion 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span><strong> Equipo:</strong>' +  xjson[data].equipoactual.descripcion
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><strong> Fecha:</strong> ' +  xjson[data].estadoactual.fecha
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><strong> Categoria:</strong> ' +  xjson[data].categoria
                + '</div></div></div>'
                + '<div class = "report-body"><strong>Descripcion de la falla:</strong>'
                + '<p>' + xjson[data].descripcion + '</p>' 
                + '</div></div>'; 
        }
        $("#fillticket").html(html);
    }
</script>