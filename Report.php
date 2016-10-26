<div class = "Alert">
<?php
    if (isset($_POST['TipoFalla']) && isset($_POST['NumEquipo']) && isset($_POST['DescripcionF']) )
    {
        $_TipoFalla = $_POST['TipoFalla'];
        $_NumEquipo = $_POST['NumEquipo'];
        $_DescripcionF = $_POST['DescripcionF'];
        if (RegistrarFalla($_DescripcionF,$_TipoFalla,$_NumEquipo))
        {
            echo 'Registrado correctamente';
        }else
        {
            echo 'Error al registrar falla'; 
        }
    }
?>
</div>
<form method="POST" action="#"  name="formreport" >
    <h1>Registrar Falla</h1>
    <div>
    <input class="TextboxAncho"  type="text"  name="NumEquipo" id="numequipo" placeholder="Numero equipo" >
    <Label>Tipo</Label>
    <select name= "TipoFalla" id="tipoFalla" class="ComboboxNormal" >
        <option value = "Hardware" >Hardware</option>
        <option value = "Softwate" >Softwate</option>
    </select>
    </div>

    <Label>Descripcion</Label>
    <div>
    <textarea maxlength = "450" rows="12" cols="10"  class="TextboxAncho"name="DescripcionF" id="descripcionF" placeholder="Descripcion de Falla" >
    </textarea>
    </div>
    <div class="BtnNormalCenter">
         <input type="submit" value="Registrar Falla">
    </div>
</form>