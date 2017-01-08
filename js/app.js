// Funcion para imprimir un elemento en especifico
function PrintElem(elem)
{
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head><title>' + 'Imprimir'  + '</title>' +
        '<link href="chartist-js/chartist.css" rel="stylesheet" type="text/css" /><link href="css/style.css" rel="stylesheet" type ="text/css">');
        mywindow.document.write('</head><body ><div>'
       + '<img class="bannerheader" id="membretefundacite" alt="Membrete" src="images/MembreteFundacite.png">');
        mywindow.document.write('<h1>Estadisticas de Estadisticas de Solicitud de Soporte Tecnico</h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
        mywindow.close();
        return true;
}

// verifica si es numerico el evento. 
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}