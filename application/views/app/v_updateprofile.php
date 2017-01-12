<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container" > 
    <div class = "page-header">
        <h3>Actualizar informacion</h3>
    </div>
    <form action = "#" method = "POST" >
        <div class = "form-group">
            <div class = "row">
                <div class = "col-md-5">
                    <label>Nombre y Apellido</label>
                    <input type = "text" class = "form-control" name = "username" value = "<?php echo $nombre ; ?>" >
                </div>
                <div class = "col-md-5">
                    <label>Correo</label>
                    <input type = "email" class = "form-control" name = "useremail" value = "<?php echo $correo ; ?>" >
                </div>
                <div class = "col-md-5" >
                    <label>Pregunta de seguridad activa:</label> <input type = "checkbox" name = "questionenabled" id = "ch_questions" > <br>
                    <label>Pregunta de seguridad </label>
                    <select name = "questionid" class = "form-control" id = "questionselect" >
                        <option value = "none" >Seleccionar</option>
                        <?php 
                            foreach ( $questions as $key => $question )
                            {
                                $opc = '<option value = "' . $key . '">' . $questions[$key] . '</option>' ; 
                                echo $opc ;
                            }
                        ?>
                    </select>
                    <Label>Respuesta de seguridad:</Label>
                    <input type = "text" name = "question" class = "form-control" value = "<?php echo $respuesta ; ?>" >
                </div>
            </div>
        </div>
        <input type = "hidden" name = "request" value = "true">
        <input type = "hidden" id = "question_id" value = "<?php echo $pregunta ; ?>" >
        <input type = "hidden" id = "question_enabled" value = "<?php echo $question_enabled ; ?>" >
        <input type = "submit" class = "btn btn-primary" value = "Actualizar perfil" >
    </form>
</div>
<script type = "text/javascript" > 
    $(document).ready(function()
    {
        $("#questionselect").val($("#question_id").val()).change();
        var q_e = $("#question_enabled").val() == '1' ? true : false ;
        $("#ch_questions").prop('checked', q_e ); 
    });
</script>