<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Editar Equipo</h3>
    </div>
    <form action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-3">
                    <label>Numero Equipo</label>
                    <input type = "text" class = "form-control" maxlength="10" id = "pcnum" name = "pc_num" value = "<?php echo $pc_num ; ?>" autocomplete="off" required=""> 
                    <label id = "labelalert" class = "fieldalert" ></label>
                </div>
                <div class = "col-md-7">
                    <label>Procesador</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_cpu" value = "<?php echo $pc_cpu ; ?>" required="">
                </div>
            </div>
            <div class = "row">
                 <div class = "col-md-5">
                    <label>Memoria Ram</label>
                    <input type = "text" class = "form-control"  maxlength="45" name = "pc_ram" value = "<?php echo $pc_ram ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Disco duro</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_hdd" value = "<?php echo $pc_hdd ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Tarjeta Madre</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_motherboard" value = "<?php echo $pc_tm ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Tarjeta de video</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_video" value = "<?php echo $pc_gpu ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Fuente de poder</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_fuente" value = "<?php echo $pc_fp ;  ?>" >
                </div>

                <div class = "col-md-5">
                    <label>Monitor</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_monitor" value = "<?php echo $pc_monitor ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Teclado</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_teclado" value = "<?php echo $pc_teclado ;  ?>">
                </div>

                <div class = "col-md-5">
                    <label>Mouse</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_mouse" value = "<?php echo $pc_mouse ; ?>">
                </div>

                <div class = "col-md-5">
                    <label>Lector CD/DVD</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_dvd" value = "<?php echo $pc_dvd;  ?>" >
                </div>

                <div class = "col-md-5">
                    <label>Sistema Operativo</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_so" value = "<?php echo $pc_so ;  ?>">
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Sede ( actual : <?php echo $sede_name ; ?> )</label>
                    <?php 
                        if (isset($sedes) && count($sedes) > 0)
                        {
                    ?>
                    <select id ="select_sede" name = "sede_id" class = "form-control">
                        <option value = "none">Seleccionar</option>
                        <?php 
                            foreach($sedes as $sede)
                            {
                                $opc = '<option value ="' . $sede->id_sede . '">' . $sede->nombre . '</option>';
                                echo $opc;
                            }
                        ?>
                    </select>
                    <?php 
                        }else 
                        {
                            echo '<p>No hay sedes registradas</p>';
                        }
                    ?>
                </div>
                <div class = "col-md-5">
                    <label>Actualizar laboratorio: ( actual : <?php echo $lab_name; ?> )</label>
                    <select id = "select_lab" name = "lab_id" class = "form-control" >
                        <option value = "none">Seleccione Sede</option>
                    </select>
                </div>
            </div>
        </div>
        <input id = "sendbtn" type = "submit" class = "btn btn-primary" value = "Actualizar equipo">
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
                        var _content = '<option value = "none">Seleccionar</option>';
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

        $("#select_lab").change(function()
        {
            validate_pcnumber();
        });

        $("#pcnum").keyup(function()
        {
           validate_pcnumber();
        });

        $("#pcnum").change(function()
        {
            validate_pcnumber();
        });
        var cansend = true;

        function validate_pcnumber()
        {
            var labid = $("#select_lab").val() != "none" ? $("#select_lab").val() : 
            "<?php echo $lab_id; ?>" ;
            var currid = "<?php echo $pc_id ?>" ; 
            var pcname = $("#pcnum").val();
            $.ajax
            ({
                type : "POST" ,
                url : "<?php echo base_url('index.php/user/canchange_pc'); ?>",
                datatype : 'json' , 
                data: {lab_id: labid , pc_name: pcname , ignoreid: currid},
                success:
                function (res)
                {
                   var m_exists = JSON.parse(res);
                   if (m_exists)
                   {
                       $("#labelalert").text("Ya existe un equipo registrado con este numero");
                       $("#pcnum").css("background-color" , "#ffdbdb"); 

                   }else 
                   {
                        $("#pcnum").css("background-color" , "white"); 
                        $("#labelalert").text("");
                   }
                   cansend = !m_exists; 
                }
            });
        }
    </script>
</div>