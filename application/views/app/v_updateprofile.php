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
                <input type = "text" class = "form-control" name = "username">
            </div>
            <div class = "col-md-5">
                <label>Correo</label>
                <input type = "email" class = "form-control" name = "useremail">
            </div>
        </div> 
        </div>
        <div class = "form-group">
             <label>Actualizar Contrasena</label><input type = "checkbox" name = "updatepw" checked>
             <div class = "row">
                <div class = "col-md-5">
                    <label>Escriba contrasena actual:</label>
                    <input type = "password" name = "useractualpw" class = "form-control" maxlenght="19"> 
                </div>
             </div>
        </div>

        <div class = "form-group">
             <div class = "row">

                <div class = "col-md-5 password-container">
                    <label>Escriba la nueva contrasena:</label>
                    <div class = "input-group form-group">
                        <input id = "pass" type = "password" class = "form-control">
                        <div class = "input-group-addon" id = "addonpw" >
                            <span id = "s-newp" class = "" aira-hidden = "true" ></span>
                        </div>
                    </div>
                    <div class="progress">
                        <div id = "pbar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                    <label id = "passinfo" ></label>
                </div>

                <div class = "col-md-5 password-container">
                    <label>Confirme la nueva contrasena:</label>
                    <div class = "input-group form-group">
                        <input type = "password" class = "form-control">
                        <div class = "input-group-addon" id = "addonpw" >
                            
                        </div>
                    </div>
                    <label>No se permite</label>
                </div>
             </div>
        </div>
    </form>
</div>
<script type = "text/javascript" >

    // No permitidas
    var bannedpasswords = 
    [
        '123',
        '1234',
        '12345' , 
        '123456' , 
        '1234567' ,
        '12345678' ,
        '123456789' , 
        '1234567890' , 
        'password' , 
        'contrasena' ,
        'clave' ,
        'qwerty' , 
        'futbol' , 
        'football' , 
        'abc123' , 
        '111111' , 
        '1qaz2wsx' , 
        'dragon' , 
        'master' , 
        'login' , 
        'passw0rd' , 
        'starwars'
    ];

    function ispwbanned(pval)
    {
        var z =  $.inArray(pval , bannedpasswords ) > -1 ;
        console.log(z);
        return z;
    }

    function checksecurity(pval)
    {
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        if (false == enoughRegex.test( pval )) {
                $('#passinfo').css('color' , '#ce4444');
                $('#passinfo').text('Mas characteres!');
                $("#pbar").css('background-color' , '#ce4444' ) ;
                $("#pbar").transition({ width: '25%' } , 100) ;
                $("#s-newp").attr('class' , 'glyphicon glyphicon-remove');
                $("#s-newp").css('color' , '#ce4444');
                return false ;
        } else if (strongRegex.test( pval )) {
                $('#passinfo').css('color' , 'black');
                $('#passinfo').text('Contrasena fuerte');
                $("#pbar").css('background-color' , '#127b9b' ) ;
                $("#pbar").transition({ width: '100%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');
                return true ;
        } else if (mediumRegex.test( pval )) {
                $('#passinfo').css('color' , 'black');
                $('#passinfo').text('Contrasena segura');
                $("#pbar").css('background-color' , '#5d9b12' ) ;
                $("#pbar").transition({ width: '75%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');

                return true ;
        } else {
                $('#passinfo').css('color' , 'black');
                $('#passinfo').text('Contrasena regular');
                $("#pbar").css('background-color' , '#e2c800' ) ;
                $("#pbar").transition({ width: '45%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');

                return true ;
        }
    }

    $('#pass').keyup(function(e) 
    {
       // console.log("call");
        var pvalue = $(this).val(); 
        if (ispwbanned(pvalue) == true )
        {
            $("#pbar").transition({ width: '0%' } , 100) ;
            $('#passinfo').css('color' , '#ce4444');
            $('#passinfo').text('Contrasena no permitida');
            $("#s-newp").attr('class' , 'glyphicon glyphicon-remove');
            $("#s-newp").css('color' , '#ce4444');
        }else 
        {
              $('#passinfo').css('color' , 'black');
             $('#passinfo').text('');
             if (checksecurity(pvalue))
             {

             }
        }
    });

</script>