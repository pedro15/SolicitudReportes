<div class = "Alert">
<?php
    if (isset( $_POST['DescLab'] )   )
    {
        $desclab = $_POST['DescLab'];
        
        if ($desclab)
        {
           if(RegisterLab($desclab))
           {
                echo 'Agregado correctamente';
           }else
           {
               echo 'Error al agregar los datos';
           }
        }
    }
?>
</div>

<form method="POST" action="#"  name="formregpc" >
    <h1>Registrar Laboratorio</h1>
    <div><input class="TextboxAncho"  type="text"  name="DescLab" id="desclab" placeholder="Descripcion" ></div>
    <div class="BtnNormalCenter">
         <input type="submit" value="Registrar">
    </div>
</form>