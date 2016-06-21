<div class = "Alert">
<?php
    if ( isset( $_POST['IDLab'] ) && isset( $_POST['DescLab'] )   )
    {
        $idlab = $_POST['IDLab'] ;
        $desclab = $_POST['DescLab'];
        
        if ($idlab && $desclab)
        {
           if(RegisterLab($idlab, $desclab))
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
    <div><input class="TextboxNormal"  type="text"  name="IDLab" id="idlab" placeholder="Numero Laboratorio" ></div>
    <div><input class="TextboxAncho"  type="text"  name="DescLab" id="desclab" placeholder="Descripcion" ></div>
    <div class="BtnNormalCenter">
         <input type="submit" value="Registrar">
    </div>
</form>