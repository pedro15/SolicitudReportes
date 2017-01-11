<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<nav class="navbar navbar-default navbar-static-top">
    <div class = "container">
        <div class = "navbar-header">
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soporte Tecnico<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/user/sendticket')?>">Enviar solicitud</a></li>
                        <li><a href="<?php echo base_url('index.php/user/admintickets')?>">Administrar solicitudes</a></li>
                  </ul>
                </li>
            <!-- Estadisticas !-->
            <li><a href="<?php echo base_url('index.php/user/stats')?>">Estadisticas</a></li>
             <!-- Herramientas !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/manual')?>">Manual de usuario</a></li>
                         <li><a href="<?php echo base_url('index.php/user/credits')?>">Creditos</a></li>
                  </ul>
                </li>
                <!-- Perfil !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/updateprofile')?>">Actualizar informacion</a></li>
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