<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Cambiar clave</h3>
    </div>
    <form  action = "#" method = "POST" onsubmit="return validateform();" >
         <div class = "form-group">
                 <div class = "row">
                     <div class = "col-md-5">
                         <label>Escriba su clave actual</label>
                         <input type = "password" class = "form-control" name = "currentpw" maxlength="20" >
                    </div>  
                 </div>
                 <div class = "row">
                    <div class = "col-md-5">
                        <label>Escriba la nueva clave:</label>
                        <div class = "input-group form-group">
                            <input name = "newpass" id = "pass" type = "password" class = "form-control" maxlength="20">
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

                    <div class = "col-md-5">
                        <label>Confirme la nueva clave:</label>
                        <div class = "input-group form-group">
                            <input type = "password" class = "form-control" id = "confirmpw" maxlength="20">
                            <div class = "input-group-addon">
                                <span id = "addonpw-confirm" class = "" aria-hidden = "true" ></span>
                            </div>
                        </div>
                        <label id = "confirmlabel" ></label>
                    </div>
                 </div>
            </div>
            <input type = "submit" class = "btn btn-primary" id = "sendbtn" value = "Cambiar clave" > 
    </form>
</div>
<script type = "text/javascript" >

    var validpassword = false ;
    var confirmedpassword = false ; 

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
        return $.inArray(pval , bannedpasswords ) > -1 ;
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
                $('#passinfo').text('Clave fuerte');
                $("#pbar").css('background-color' , '#127b9b' ) ;
                $("#pbar").transition({ width: '100%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');
                return true ;
        } else if (mediumRegex.test( pval )) {
                $('#passinfo').css('color' , 'black');
                $('#passinfo').text('Clave segura');
                $("#pbar").css('background-color' , '#5d9b12' ) ;
                $("#pbar").transition({ width: '75%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');

                return true ;
        } else {
                $('#passinfo').css('color' , 'black');
                $('#passinfo').text('Clave regular');
                $("#pbar").css('background-color' , '#e2c800' ) ;
                $("#pbar").transition({ width: '45%' } , 100) ;

                $("#s-newp").attr('class' , 'glyphicon glyphicon-ok');
                $("#s-newp").css('color' , '#5d9b12');

                return true ;
        }
    }

    function checkconfirmation()
    {
        if ( $("#confirmpw").val() == $('#pass').val() )
        {
            $("#confirmlabel").css('color' , 'black' );
            $("#confirmlabel").text("Ok");
            $("#addonpw-confirm").css('color', '#5d9b12');
            $("#addonpw-confirm").attr('class' , 'glyphicon glyphicon-ok'  );
            confirmedpassword = true ;
        }else 
        {
            $("#confirmlabel").css('color' , '#ce4444' );
            $("#confirmlabel").text("Las claves no coinciden!");
            $("#addonpw-confirm").css('color', '#ce4444');
            $("#addonpw-confirm").attr('class' , 'glyphicon glyphicon-remove'  );
            confirmedpassword = false ;
        }
    }

    $('#pass').keyup(function() 
    {
       // console.log("call");
        var pvalue = $(this).val(); 
        if (ispwbanned(pvalue) == true )
        {
            $("#pbar").transition({ width: '0%' } , 100) ;
            $('#passinfo').css('color' , '#ce4444');
            $('#passinfo').text('Clave no permitida');
            $("#s-newp").attr('class' , 'glyphicon glyphicon-remove');
            $("#s-newp").css('color' , '#ce4444');
        }else 
        {
             $('#passinfo').css('color' , 'black');
             $('#passinfo').text('');
             validpassword = checksecurity(pvalue);
             if (validpassword)
             {
                 checkconfirmation();
             }
        }
    });

    $("#confirmpw").keyup(function()
    {
        checkconfirmation();
    });


    function validateform()
    {
        if (validpassword && confirmedpassword )
        {
            return true ;
        }else 
        {
            
            return false ;
        }
    }
    
</script>