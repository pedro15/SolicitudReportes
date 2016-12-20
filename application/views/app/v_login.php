<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "fundacitebackground">
            <div>
                 <div class = "text-left">
                 <img class="LoginHeaderIcon" id="logofundacite" alt="fundacite logo" src="<?php echo base_url('/')?>images/BannerIcons.png" width="100" height="100">
                 </div>
                 <div class ="text-center">
                 <h3>Sistema Automatizado de Solicitud de Soporte Tecnico</h3>
                 <h4>Bienvenido</h4>
                 </div>
            </div>
            <div class = "container">
                    <div class = "form-signin">
                    <?php
                        if (isset($message))
                        {
                        ?>
                            <div class = "alert alert-danger" style = "padding : 5px; margin-top: 5px; border-radius: 5px; ">
                                <span class = "glyphicon glyphicon-remove-sign" aria-hidden = "true"></span>
                                <?php 
                                    echo $message;
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                       <form name="loginform" action="#" method="POST"> 
                           <div class = "row">
                               <div class = "col-md-12">      
                                 <h2 class="form-signin-heading">Ingresar</h2>
                                 <input type="text" maxlength="11" onkeypress="return isNumberKey(event);" class="form-control" style = "margin-top: 5px;" name="cilogin" placeholder="Cedula" required="" autofocus="" />
                                 <input type="password" class="form-control" style = "margin-top: 5px;" name="passlogin" placeholder="Contraseña" required=""/>      
                                 <button class="btn btn-lg btn-primary btn-block" type="submit" style = "margin-top: 10px;">Entrar</button>   
                               </div>
                           </div>
                       </form>
                 </div>
            </div>
        </div>
    </body>
</html>