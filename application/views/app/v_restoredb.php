<?php
    defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <div class = "row">
            <div class = "col-xs-1">
                <img src = "<?php echo base_url('images/db.png') ?>" alt = "database icon" width = "30" height = "30" style = "margin-top: 15px; " />
            </div>
            <div class = "col-md-5">
                <h3>Restaurar base de datos</h3>
            </div>
        </div>
    </div>
    <div class = "alert alert-warning" > 
        <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"  ></span>
        Debe seleccionar el archivo .sql que ha descargado en la seccion 'Respaldo de base de datos', dicho archivo <strong>NO</strong> se debe editar.
    </div>
    <form id = "sendfrm" action = "#" method = "POST" enctype="multipart/form-data">
        <div class = "form-group">
            <label>Archvio de restauracion (.sql) </label>
            <input type = "file"  onchange = "return checkfile(this);">
        </div>
        <div class="progress">
            <div id = "progress" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              
            </div>
        </div>
        <div class = "form-group">
            <button type = "submit" class = "btn btn-primary" > 
                <span class = "glyphicon glyphicon-arrow-up" aria-hidden = "true"  ></span> Restaurar
            </button>
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
            reader.onprogress = function (progress)
            {
                var total = (progress.loaded / progress.total ) * 100  ;
                $("#progress").transition({ width: total + '%' } , 300) ; 
            }
        }
    });

    $("#sendfrm").submit(function (event)
    {
        if (cansend == true && xdata != "")
        {
            if (confirm("Desea restaurar la base de datos con el archivo seleccionado? tome en cuenta que toda la informacion actual sera reemplazada con la nueva informacion que contiene dicho archivo."))
            {
                var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "sqlstring").val(xdata);
                $('#sendfrm').append($(input));   
            }else 
            {
                event.preventDefault();
            }
        }else 
        {
            alert("No ha seleccionado ningun archivo o ha seleccionado un archivo invalido.");
            event.preventDefault();
        }
    });

</script>