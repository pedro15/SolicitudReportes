<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Restaurar base de datos</h3>
    </div>
    <div class = "alert alert-warning" > 
        <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
        Debe seleccionar el archivo .sql que ha descargado en la seccion 'Respaldo de base de datos', dicho archivo <strong>NO</strong> se debe editar.
    </div>
    <form id = "sendfrm" action = "#" method = "POST" enctype="multipart/form-data">
        <div class = "form-group">
            <input type = "file"  onchange = "return checkfile(this);">
        </div>
        <div class = "form-group">
            <input type = "submit" onsubmit = "return validatesend();"  class = "btn btn-primary" value = "Restaurar">
        </div>
    </form>
</div>
<script type = "text/javascript">
    var cansend = false ;
    var xdata = "" ; 
    function checkfile(sender) 
    {
        var validExts = new Array(".sql");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0){
          alert("Archivo invalido seleccionado, el archivo debe ser de tipo: " +
                   validExts.toString() );
          cansend = false;
        }
        else{ cansend = true; }
        return cansend; 
    }

    $("input[type=file]").change(function()
    {
        
        if (this.files && this.files[0]) 
        {
            var reader = new FileReader();
            reader.readAsText(this.files[0]);
            reader.onload = function (e) 
            {
                xdata = e.target.result;
            }
        }

    });

    function validatesend()
    {
        console.log(cansend); 
        console.log(xdata);

        if (cansend && xdata != "")
        {
            return true ;
        }else 
        {
            alert("No ha seleccionado ningun archivo o ha seleccionado un archivo invalido.");
            return false ;
        }
    }

    $("#sendfrm").submit(function (event)
    {
        var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "sqlstring").val(xdata);
        $('#sendfrm').append($(input));
    });

</script>