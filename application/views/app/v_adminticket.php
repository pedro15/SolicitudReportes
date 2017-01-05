<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>

<div class = "container">
    <div class = "page-header">
        <h3>Administrar solicitudes de soporte tecnico</h3>
    </div>
    <form method = "post" action = "#">
        <label>Filtrar por:</label>
        <div class = "row">
            <div class = "col-md-5">
            <label>Sede</label>
            <div class = "input-group">
                <div class = "input-group-addon">
                    <input type = "checkbox" name = "ch_sede">
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
                        <input type = "checkbox" id = "ch_lab" > 
                    </div>
                    <select id = "selectlab" class = "form-control" >
                        <option value = "none" >Seleccionar</option>
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
<div id = "dialog">
    <div class = "dialog-container" > 
        <table class = "table table-stripped">
            <thead>
                <tr>
                
                    <th><span class = "glyphicon glyphicon-user" aria-hidden = "true"></span> Estado</th>
                    <th><span class = "glyphicon glyphicon-user" aria-hidden = "true"></span> Modificado por</th>
                </tr>
            </thead>
            <tbody id = "table-dialog-fill" >
                
                <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>

                <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>

                <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>

                <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>

                 <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>

                 <tr>
                    <th>item</th>
                    <th>Usuario</th>
                </tr>
                
            </tbody>
        </table>
        <div id = "table-dialog-pagination" >
            
        </div>
    </div>
</div>

<script type = "text/javascript">

    $(document).ready(function()
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
    });

    $("#dialog").dialog(
    {
        dialogClass: "no-close",
        modal: true ,
        autoOpen: false ,
        draggable: false  ,
        title: "Historial de cambios" ,
        buttons:
        [
            {
			    text: "Aceptar",
			    click: function() 
                {
			    	$( this ).dialog( "close" );
			    }
		    }
        ]
    });


    function loaddialog(reports)
    {
        console.log(reports);
        
        $("#dialog").dialog("open");    
    }

    function changestate(id , newstate)
    {
        
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
                filltickets(data);
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
                + ' <div class = "report-header">'
                + ' <div class = "row">' 
                + '<div class = "col-md-5">' 
                + 'Estado: <strong>' + estado + '</strong>' 
                + ' <img src ="' + iconurl + '" alt="alerticon" width = "16" height = "16" />'
                + '</div><div class = "col-md-5"><a class = "report-header-link" onclick = "javascript:loaddialog(\'' + xjson[data].id_falla + '\')">'
                + '<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Ver historial de cambios </a></div></div></div>' 
                + '<div class = "report-ticket-darkbody">' 
                + '<div class = "row"><div class = "report-ticket-controls">'
                + '<div class = "input-group" > <div class = "input-group-addon">Cambiar estado:</div>' 
                + '<select class = "form-control" onchange = "changestate(\'' + xjson[data].id_falla + ',' + this.value + '\');" >' 
                + '<option value = "none">Seleccionar</option>' 
                + '<option value = "0">Sin reparar</option>' 
                + '<option value = "1">En revision</option>' 
                + '<option value = "2">Reparado</option>'
                + '</select>' 
                + '<div class = "input-group-btn">' 
                + '<button type="button" class="btn btn-danger">'
                + '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar </button>' 
                + '</div></div></div></div>'
                + '<div class = "row" >'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Sede:</strong> ' +  xjson[data].sedeactual.nombre 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><strong> Laboratorio:</strong> ' +  xjson[data].laboratorioactual.descripcion 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span><strong> Equipo:</strong> ' +  xjson[data].equipoactual.descripcion
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><strong> Fecha:</strong> ' +  xjson[data].estadoactual.fecha
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-user" aria-hidden="true"></span><strong> Enviado por:</strong> ' +  xjson[data].usuarioactual.nombre
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><strong> Categoria:</strong> ' +  xjson[data].categoria
                + '</div></div></div>'
                + '<div class = "report-body"><strong>Descripcion de la falla:</strong>'
                + '<p>' + xjson[data].descripcion + '</p>' 
                + '</div></div>'; 
            $("#fillticket").html(html);
        }
    }
</script>