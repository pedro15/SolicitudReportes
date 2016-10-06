// Validar Login
function validatelogin() 
{
    var ci = document.getElementById("ci").value;
    var pass = document.getElementById("pw").value;

    if ( ci == null || ci == "" || pass == null || pass == ""  )
    {
        var _html = document.getElementById("lwargning");
        var imghtml = "<img src=" + "images/warning.png" + " alt=" + "Alert" + " height=" +"32" + " width=" +"32" + ">";
        _html.innerHTML = imghtml + "Debe Completar todos los campos";
        return false;
    }else
    {
        return true;
    }
}