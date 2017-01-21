<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<nav class="navbar navbar-default navbar-static-top">
    <div class = "container">
        <div class = "navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">alterar navegacion</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soporte Técnico<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/user/sendticket')?>">Enviar solicitud</a></li>
                        <li><a href="<?php echo base_url('index.php/user/viewtickets')?>">Administrar Solicitudes</a></li>
                  </ul>
                </li>
             <!-- Herramientas !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/manual')?>">Manual de usuario</a></li>
                         <li><a href="<?php echo base_url('index.php/user/credits')?>">Créditos</a></li>
                  </ul>
                </li>
                <!-- Perfil !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/updateprofile')?>">Actualizar información</a></li>
                         <li><a href="<?php echo base_url('index.php/user/updatepassword')?>">Cambiar clave</a></li>
                  </ul>
                </li>
                <!-- Salir !-->
                    <li><a href="<?php echo base_url('index.php/user/logout')?>">Salir</a></li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <div class="navbar-brand">
                        <?php
                            echo 'Bienvenido ' . $nombre_usuario ; 
                        ?>
                    </div>
                </div>
             </div>
        </div>
    </div>
</nav>