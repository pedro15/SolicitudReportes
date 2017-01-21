<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Equipo</h3>
    </div>
    <form name = "pcform" action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-3">
                    <label>Numero Equipo*</label>
                    <input type = "text" autocomplete = "off" class = "form-control" maxlength="10" name = "pc_num" onkeypress = "return validadesharp(event);" required>
                </div>
                <div class = "col-md-7">
                    <label>Procesador*</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_cpu" required>
                </div>
            </div>
            <div class = "row">

                <div class = "col-md-5">
                    <label>Memoria Ram*</label>
                    <input type = "text" class = "form-control"  maxlength="45" name = "pc_ram" required>
                </div>

                <div class = "col-md-5">
                    <label>Disco duro*</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_hdd" required>
                </div>
                
                <div class = "col-md-5">
                    <label>Tarjeta gráfica</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_video">
                </div>

                <div class = "col-md-5">
                    <label>Tarjeta Madre*</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_motherboard" required>
                </div>
                <div class = "col-md-5">
                    <label>Fuente de poder*</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_fuente" required>
                </div>

                <div class = "col-md-5">
                    <label>Monitor</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_monitor">
                </div>

                <div class = "col-md-5">
                    <label>Teclado</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_teclado">
                </div>

                <div class = "col-md-5">
                    <label>Mouse</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_mouse">
                </div>

                <div class = "col-md-5">
                    <label>Lector CD / DVD</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_dvd">
                </div>

                <div class = "col-md-5">
                    <label>Sistema Operativo</label>
                    <input type = "text" class = "form-control" maxlength="45" name = "pc_so">
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-5">
                    <label>Sede</label>
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
                    <label>Registrar en laboratorio:</label>
                    <select id = "select_lab" name = "lab_id" class = "form-control" >
                        <option value = "none" >Seleccione Sede</option>
                    </select>
                </div>
            </div>
        </div>
        <p>( * ) Campos requeridos</p>
        <input type = "submit" class = "btn btn-primary" value = "Registrar Equipo">
    </form>
    <script type = "text/javascript">
        
        var idlab ; 
        var idpc ;
        var cancontinue = false ;

        $('form[name="pcform"]').submit(function(event)
        {
            if (!cancontinue)
            {
                event.preventDefault();
            }
        });

        $('input[name="pc_num"]').popover(
        {
           template: '<div class="popover popover-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' ,
           placement: 'top',
           trigger: 'manual' ,
           content: 'Este equipo ya se encuentra registrado'
        });

        function validatepc()
        {
            if (idlab != undefined && idpc != undefined )
            {
                $.ajax(
                {
                    type:"POST" ,
                    url: "<?php echo site_url('/user/ajax_validatepc'); ?>" ,
                    data: {pcid: idpc , labid: idlab },
                    success: function(data)
                    {
                        var json = JSON.parse(data);
                        cancontinue = !json;
                        if (!cancontinue)
                        {
                              $('input[name="pc_num"]').popover('show');
                        }else 
                        {
                            $('input[name="pc_num"]').popover('hide');
                        }
                    }
                });
            }else 
            {
                cancontinue = false ;
            }
        }

        $('input[name="pc_num"]').keyup(function()
        {
            idpc = $(this).val(); 
            validatepc();
            
        });

        $("#select_lab").change(function()
        {
            idlab = $(this).val();
            validatepc();
        });


        $("#select_sede").change(function()
        {
            var _value = $("#select_sede").val();
            $.ajax
            (
                {
                    type: "POST" ,
                    url: "<?php echo base_url('index.php/user/ajax_getlabsbysede'); ?>", 
                    data: { id_sede: _value },
                    success: 
                    function (res)
                    {
                        var json = JSON.parse(res);
                        var _content = '<option value = "none" >Seleccionar</option>';
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