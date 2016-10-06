<div class = "Alert">

</div>
<form method="POST" action="#"  name="formreport" >
    <h1>Registrar Falla</h1>
    <div>
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