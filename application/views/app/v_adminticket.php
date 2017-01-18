<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>

<div class = "container">
    <div class = "page-header">
        <h3>Administrar solicitudes de soporte técnico</h3>
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
                <label>Categoría</label>
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

<div id = "pcdialog" >
    <div class = "dialog-container" > 
        <div class = "row">

            <div class = "col-md-15">
                <label>Procesador: </label> <label id = "cpu_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Memoria RAM: </label> <label id = "ram_fill" ></label>
            </div>

             <div class = "col-md-15">
                <label>Tarjeta gráfica: </label> <label id = "gpu_fill" ></label>
            </div>

             <div class = "col-md-15">
                <label>Tarjeta Madre: </label> <label id = "motherboard_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Disco duro: </label> <label id = "hdd_fill" ></label>
            </div>

             <div class = "col-md-15">
                <label>Fuente poder: </label> <label id = "fuente_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Sistema Operativo: </label> <label id = "so_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Monitor: </label> <label id = "monitor_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Teclado: </label> <label id = "keyboard_fill" ></label>
            </div>

            <div class = "col-md-15">
                <label>Mouse: </label> <label id = "mouse_fill" ></label>
            </div>

             <div class = "col-md-15">
                <label>Lector CD / DVD: </label> <label id = "dvd_fill" ></label>
            </div>

        </div>
    </div>
</div>

<div id = "dialog">
    <div class = "dialog-container" > 
        <table class = "table table-stripped">
            <thead>
                <tr>
                    <th><span class = "glyphicon glyphicon-calendar" aria-hidden = "true"></span> Fecha</th>
                    <th><span class = "glyphicon glyphicon-info-sign" aria-hidden = "true"></span> Estado</th>
                    <th><span class = "glyphicon glyphicon-user" aria-hidden = "true"></span> Modificado por</th>
                </tr>
            </thead>
            <tbody id = "table-dialog-fill" >
                
            </tbody>
        </table>
        <div id = "table-dialog-pagination" >
                
        </div>
    </div>
</div>

<script type = "text/javascript">

    var fjson ;
    
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

    $("#dialog").dialog(
    {
        dialogClass: "no-close",
        modal: true ,
        autoOpen: false ,
        draggable: false  ,
        minWidth: 400,
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
    
    $("#pcdialog").dialog(
    {
        dialogClass: "no-close",
        modal: true ,
        autoOpen: false ,
        draggable: false  ,
        minWidth: 400,
        title: "Características del equipo" ,
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


    function loaddialog(id)
    {
        $.ajax
        ({
            url: "<?php echo base_url('index.php/user/getallreportsjson'); ?>" ,
            type: "POST" , 
            dataType: 'json',
            data: {idfalla: id },
            success: function (data)
            {
               paginatestates(data);
            }
        });
        
        $("#dialog").dialog("open");    
    }

    function changestate(id,val)
    {
        if (val != "none")
        {
            if (confirm("Desea actualizar el estado ?" )  )
            {
                $.ajax
                ({
                    url: "<?php echo base_url('index.php/user/requestchangereportstate'); ?>" ,
                    type: "POST" ,
                    dataType: 'json',
                    data:  {reportid: id , newvalue: val },
                    success: function(data)
                    {
                        if (data)
                        {
                            alert("Estado actualizado correctamente");
                            updateticketdata();
                        }
                    }
                });
            }
        }
    }

    function showpcinfo(id)
    {
        $.ajax
        ({
            url: "<?php echo base_url('index.php/user/getpcinfojson'); ?>" ,
            type: "POST" ,
            dataType: 'json',
            data:  {pcid: id},
            success: function(data)
            {
                $("#hdd_fill").text(data.disco_duro);

                $("#fuente_fill").text(data.fuente_poder);

                $("#dvd_fill").text(data.lector_dvd);

                $("#ram_fill").text(data.memoria_ram);

                $("#monitor_fill").text(data.monitor);

                $("#cpu_fill").text(data.procesador);

                $("#so_fill").text(data.sistema_operativo);

                $("#motherboard_fill").text(data.tarjeta_madre);

                $("#keyboard_fill").text(data.teclado);

                $("#mouse_fill").text(data.mouse);

                $("#gpu_fill").text(data.tarjeta_grafica);

                $("#pcdialog").dialog("open");
            }
        });
    }

    function removeticket(id)
    {
        if (confirm("Desea ELIMINAR esta solicitud ?"))
        {
            $.ajax
            ({
                url: "<?php echo base_url('index.php/user/requestdeletereport'); ?>" ,
                type: "POST" , 
                data: {reportid: id},
                success: function (data)
                {
                    if (data)
                    {
                        alert("Solicitud eliminada correctamente");
                        updateticketdata();
                    }
                }
            });
        }
    }

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

    function paginatestates(json)
    {
        filltabledialogs(json);
        $("#table-dialog-pagination").pagination
        ({
            dataSource: json,
            pageSize : 10,
            callback: function(data, pagination) 
            {
               filltabledialogs(data);
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
                var xdata = data ;

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
                fjson = xdata ;
            }
        });
    }

    function filltabledialogs(xjson)
    {
        var html = "" ; 
        for (data in xjson)
        {
            var estadotxt = "" ; 
            
            html += 
            '<tr>' 
            + '<th>' + xjson[data].fecha + '</th>'
            + '<th>' + xjson[data].estadotext + '</th>'
            + '<th>' + xjson[data].nombreusuario + '</th>' 
            + '</tr>' ; 
        }
        $("#table-dialog-fill").html(html);
    }

    function addimagefromurl(url, callback) 
    {
    	var img = new Image, data, ret={data: null, pending: true};
    	img.onError = function() 
        {
    		throw new Error('Cannot load image: "'+url+'"');
    	}
    	img.src = url;
    	img.onload = function() {
    		var canvas = document.createElement('canvas');
    		document.body.appendChild(canvas);
    		canvas.width = img.width;
    		canvas.height = img.height;
    		var ctx = canvas.getContext('2d');
    		ctx.drawImage(img, 0, 0);
    		data = canvas.toDataURL('image/png').slice('data:image/png;base64,'.length);
    		data = atob(data)
    		document.body.removeChild(canvas);
    		ret['data'] = data;
    		ret['pending'] = false;
    		if (typeof callback === 'function') {
    			callback(data);
    		}
    	}
    	return ret;
    }

    function getxcenter(text , doc )
    {
        var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        return (doc.internal.pageSize.width - textWidth) / 2;
    }

    function downloadpdf(xid)
    {
        updateticketdata();
        var curr ;
        for ( elm in fjson )
        {
            if (fjson[elm].id_falla == xid)
            {
                curr = fjson[elm] ; 
                if (curr != undefined )
                {
                    var doc = new jsPDF();
                    doc.setLineWidth(0.5);

                    var titulo = 'Sistema de solicitud de soporte técnico (SASSTEC)' ; 

                    doc.text( titulo , getxcenter(titulo,doc) , 30);
                
                    var subtitulo = 'Solicitud de soporte técnico' ;
                
                    doc.text( subtitulo , getxcenter(subtitulo,doc) , 45);
                
                    doc.line(10, 48, 200, 48);
                
                    doc.text('Equipo: ' + curr.equipoactual.descripcion , 10 , 55  );
                    doc.text('Categoría: ' + curr.categoria , 100 , 55  );

                    doc.line(10, 58 , 200, 58);
                
                    doc.text('Laboratorio: ' + curr.laboratorioactual.descripcion , 10 , 65  );
                    doc.text('Fecha: ' + curr.estadoactual.fecha , 100 , 65  );
                
                    doc.line(10, 70 , 200, 70);
                
                    doc.text('Enviado por: ' + curr.usuarioactual.nombre , 10 , 77  );
                
                    doc.line(10, 80 , 200, 80);
                
                    doc.text('Descripción de la falla: ' , 10 , 86 );

                    var paragraph =  doc.splitTextToSize(curr.descripcion,190);
                
                    doc.text(paragraph , 10 , 93 );

                    doc.line(10, 150 , 200,150);

                    doc.text('Observaciones:' , 10 , 160 );
                    doc.setLineWidth(0.3);
                    doc.line(10, 165 , 200 , 165);
                    doc.line(10, 175 , 200 , 175);
                    doc.line(10, 185 , 200 , 185);
                    doc.line(10, 195 , 200 , 195);
                    doc.line(10, 205 , 200 , 205);
                    doc.line(10, 215 , 200 , 215);
                    doc.line(10, 225 , 200 , 225);
                    doc.line(10, 235 , 200 , 235);
                    doc.line(10, 245 , 200 , 245);

                    addimagefromurl('../../images/MembreteFundacite.png' , function(imgdata){
                        doc.addImage(imgdata , 'PNG' ,10,0,150,12);
                        doc.save('solicitud-' + xid  + '.pdf');
                    });
                    break;
                }
            }
        }
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
                        estado = "En revisión" ;
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
                + '</div><div class = "col-md-5"><a class = "report-header-link" onclick = "javascript:loaddialog(\'' + xjson[data].id_falla + '\')">'
                + '<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Ver historial de cambios </a></div></div></div>' 
                + '<div class = "report-ticket-darkbody">' 
                + '<div class = "row"><div class = "report-ticket-controls">'
                + '<div class = "input-group" > <div class = "input-group-addon">Cambiar estado:</div>' 
                + '<select class = "form-control" onchange = "javascript:changestate(\'' + xjson[data].id_falla + '\'' + ',' + 'this.value)" >' 
                + '<option value = "none">Seleccionar</option>' 
                + '<option value = "0">Sin reparar</option>' 
                + '<option value = "1">En revision</option>' 
                + '<option value = "2">Reparado</option>'
                + '</select>' 
                + '<div class = "input-group-btn">' 
                + '<a  class="btn btn-danger" onclick = "javascript:removeticket(\'' + xjson[data].id_falla + '\')" >'
                + '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar </a>' 
                + '</div>'
                + '</div>'
                + '<a class ="btn btn-primary" onclick= "javascript:downloadpdf(\'' + xjson[data].id_falla + '\')" >'  + '<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Descargar PDF </a>'
                + '</div></div>'
                + '<div class = "row" >'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Sede:</strong> ' +  xjson[data].sedeactual.nombre 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><strong> Laboratorio:</strong> ' +  xjson[data].laboratorioactual.descripcion 
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span><strong> Equipo:</strong> <a onclick = "javascript:showpcinfo(\'' +  xjson[data].equipoactual.id_equipo + '\')">' +  xjson[data].equipoactual.descripcion + '</a>'
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><strong> Fecha:</strong> ' +  xjson[data].estadoactual.fecha
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-user" aria-hidden="true"></span><strong> Enviado por:</strong> ' +  xjson[data].usuarioactual.nombre
                + '</div>'
                + '<div class = "col-md-6">'
                + '<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><strong> Categoría:</strong> ' +  xjson[data].categoria
                + '</div></div></div>'
                + '<div class = "report-body"><strong>Descripcion de la falla:</strong>'
                + '<p>' + xjson[data].descripcion + '</p>' 
                + '</div></div>'; 
        }
        $("#fillticket").html(html);
    }
</script>