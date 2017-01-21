<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Registrar Usuario</h3>
    </div>
    <form id = "formuser" action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre y Apellido</label>
                    <input type = "text" name = "name" class = "form-control" required>
                    <label>Correo:</label>
                    <input type = "email" name = "email" class = "form-control" required>
                </div>
                <div class = "col-md-5">
                    <label>Cédula:</label> 
                    <input id = "cifield" autocomplete = "off" type = "text" onkeypress="return isNumberKey(event);"  name = "userci" class = "form-control" required>
                </div>
                <div class = "col-md-5">
                    <label>Nivel de privilegio</label> 
                    <select name = "usrtype" class = "form-control"> 
                        <option value = "1" >Participante / Instructor</option>
                        <option value = "2" >Técnico</option>
                        <option value = "3">Administrador</option>
                    </select>
                </div>
            </div>
        </div>
        <input type = "submit" class = "btn btn-primary" value = "Registrar usuario">
    </form>
</div>
<script type = "text/javascript">

// Validacion en base de datos Cedula de identidad
var cansend = true ;
function validate_ci()
{
      var civalue = $("#cifield").val();
        $.ajax(
        {
            type : "POST",
            url: "<?php echo base_url('index.php/user/ajax_usr_ci_validation'); ?>", 
            data: { cedula_user: civalue } ,
            success:
            function (res)
            {
                var isin_database = JSON.parse(res);
                if (isin_database)
                {
                     $('#cifield').popover('show');
                    cansend = false ;
                }else 
                {
                     $('#cifield').popover('hide');
                    cansend = true ;
                }
            }
        }
    );
}

$("#cifield").keyup(function()
{
    validate_ci();
});

$("#cifield").change(function()
{
    validate_ci();
});

 $('#cifield').popover(
 {
    template: '<div class="popover popover-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' ,
    placement: 'top',
    trigger: 'manual' ,
    content: 'Ya existe un usuario registrado con esta cédula'
 });

$("#formuser").on('submit',function()
{
    return cansend ;
});

</script>