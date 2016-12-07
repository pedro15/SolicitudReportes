<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Equipo</h3>
    </div>
    <form action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-2">
                    <label>Numero PC</label>
                    <input type = "text" class = "form-control" name = "pc_num" required>
                </div>
                <div class = "col-md-5">
                    <label>Procesador</label>
                    <input type = "text" class = "form-control" name = "pc_cpu" required>
                </div>
                <div class = "col-md-5">
                    <label>Tarjeta de video (dejar en blanco si no tiene)</label>
                    <input type = "text" class = "form-control" name = "pc_video">
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Memoria Ram</label>
                    <input type = "text" class = "form-control" name = "pc_ram" required>
                </div>
                <div class = "col-md-5">
                    <label>Disco duro</label>
                    <input type = "text" class = "form-control" name = "pc_hdd" required>
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Tarjeta Madre</label>
                    <input type = "text" class = "form-control" name = "pc_motherboard" required>
                </div>
                <div class = "col-md-5">
                    <label>Fuente de poder</label>
                    <input type = "text" class = "form-control" name = "pc_fuente" required>
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Sede</label>
                    <select id ="select_sede" name = "sede_id" class = "form-control">
                        <option>Seleccionar</option>
                        <?php 
                            if (isset($sedes))
                            {
                                foreach($sedes as $sede)
                                {
                                    $opc = '<option value ="' . $sede->id_sede . '">' . $sede->nombre . '</option>';
                                    echo $opc;
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class = "col-md-5">
                    <label>Registrar en laboratorio:</label>
                    <select id = "select_lab" name = "lab_id" class = "form-control" >
                        <option>Seleccione Sede</option>
                    </select>
                </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar Equipo">
    </form>
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
                        var _content = "<option>Seleccionar</option>";
                        for (data in json)
                        {
                            _content += '<option value="' + json[data].id_laboratorio 
                            + '">' + json[data].descripcion + '</option>' ; 
                        }
                        $("#select_lab").html(_content);
                    }
                }
            );
        });
    </script>
</div>