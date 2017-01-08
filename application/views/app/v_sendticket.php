<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Enviar Solicitud de soporte tecnico</h3>
    </div>
    <form action = "#" method = "POST">
        <div class = "form-group">
            <div class = "row">

                <div class = "col-md-5">
                    <Label>Sede</label>
                    <select id = "select_sede" class = "form-control" >
                        <option value = "none">Seleccionar</option>
                        <?php
                            foreach ($sedes as $sede)
                            {
                                $opc = '<option value = "' . $sede->id_sede . '">' . $sede->nombre . " - "  . $sede->ubicacion . '</option>' ; 
                                echo $opc;      
                            }
                        ?>
                    </select>
                </div>

                <div class = "col-md-5">
                    <Label>Laboratorio</label>
                    <select id = "select_laboratorio" class = "form-control" >
                        <option value = "none">Seleccione Sede</option>
                    </select>
                </div>

                <div class = "col-md-5">
                    <Label>Equipo</label>
                    <select id = "select_equipo" name = "idequipo" class = "form-control" >
                        <option value = "none">Seleccione Laboratorio</option>
                    </select>
                </div>
                <div class = "col-md-5">
                    <label>Categoria de la falla</label>
                    <select name = "category" class = "form-control" > 
                        <?php 
                            foreach ($categorias as $key => $cat)
                            {
                                $opc = '<option value ="' . $key . '">' . $categorias[$key] . '</option>' ; 
                                echo $opc;
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class = "row">
                <label>Desscripcion de la falla:</label>
                <textarea class = "form-control" name = "descripcion" rows = "15" cols = "0" maxlenght = "600">

                </textarea>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Enviar Solicitud" > 
    </form>
</div>
<script type = "text/javascript">
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
                        var _content = '<option>Seleccionar</option>';
                        for (data in json)
                        {
                            _content += '<option value="' + json[data].id_laboratorio 
                            + '">' + json[data].descripcion + '</option>' ; 
                        }
                        $("#select_laboratorio").html(_content);
                    }
                }
            );
        });

        $("#select_laboratorio").change(function()
        {
            var labval = $("#select_laboratorio").val(); 
            $.ajax
            ({
                type: "POST",
                url: "<?php echo base_url('index.php/user/getpcsbylab'); ?>" ,
                datatype : 'json', 
                data: { laboratoryid: labval },
                success:
                function (res)
                {
                    var json = JSON.parse(res);
                     var _content = '<option value = "none" >Seleccionar</option>' ;
                    for (index in json)
                    {
                        _content += '<option value = "' + json[index].id_equipo + '">' 
                        + json[index].descripcion + '</option>' ; 
                    }
                    $("#select_equipo").html(_content);
                }
            });
        });
</script>