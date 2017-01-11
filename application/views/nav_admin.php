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
            <!-- Sedes  !-->
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sedes<span class="caret"></span></a>
                 <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url('index.php/user/registersede')?>">Registrar sede</a></li>
                      <li><a href="<?php echo base_url('index.php/user/adminsede')?>">Administrar sedes</a></li>
                 </ul>
                </li>
            <!-- Laboratorios !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laboratorios<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                       <li><a href="<?php echo base_url('index.php/user/registerlab')?>">Registrar laboratorio</a></li>
                       <li><a href="<?php echo base_url('index.php/user/adminlab')?>">Administrar laboratorios</a></li>
                  </ul>
                </li>
            <!-- Equipos !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipos<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                       <li><a href="<?php echo base_url('index.php/user/registerpc')?>">Registrar equipo</a></li>
                       <li><a href="<?php echo base_url('index.php/user/adminpc')?>">Administrar equipos</a></li>
                  </ul>
                </li>
             <!-- Usuarios !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url('index.php/user/registerusr')?>">Registrar usuario</a></li>
                      <li><a href="<?php echo base_url('index.php/user/adminusr')?>">Administrar usuario</a></li>
                  </ul>
                </li>
            <!-- Estadisticas !-->
            <li><a href="<?php echo base_url('index.php/user/stats')?>">Estadisticas</a></li>
             <!-- Herramientas !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/backupdb')?>">Respaldo de base de datos</a></li>
                         <li><a href="<?php echo base_url('index.php/user/restoredb')?>">Restauracion de base de datos</a></li>
                         <li role="separator" class="divider"></li>
                         <li><a href="<?php echo base_url('index.php/user/manual')?>">Manual de usuario</a></li>
                         <li><a href="<?php echo base_url('index.php/user/credits')?>">Creditos</a></li>
                  </ul>
                </li>
                <!-- Perfil !-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url('index.php/user/updateprofile')?>">Actualizar informacion</a></li>
                         <li><a href="<?php echo base_url('index.php/user/')?>">Cambiar clave</a></li>
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