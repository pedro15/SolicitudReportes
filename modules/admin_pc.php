<?php

?>
<div class = "page-header">
    <h2>Administrar Equipos</h2>
</div>
<div class = "container">
        <?php 
            for ($i = 0 ; $i < 1 ; $i++)
            {
        ?>
        <div class="centerpanel-body row" style= "background = #f4f4f4;">
            <div class = "centerpanel-shadow">
                <div class = "container">
                    <!-- Cabecera -->
                    <div class = "row">
                        <div class = "col-lg-4 col-md-5 col-sm-4">
                            <div class = "centerpanel-header">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <a href = "#">Sede</a>
                                <span class = "glyphicon glyphicon-chevron-right" aria-hidden = "true"></span>
                                <span class = "glyphicon glyphicon-tasks" aria-hidden = "true"></span>
                                <a href = "#">Laboratorio</a>
                                <span class = "glyphicon glyphicon-chevron-right" aria-hidden = "true">
                                </span>
                                <label>PC1</label>
                            </div>
                        </div>
                         <div class = "col-md-4">
                                <div class = "btn-group">
                                    <buttun formaction = ""  class="btn btn-primary">
                                        <span class = "glyphicon glyphicon-pencil"></span>
                                        Editar
                                    </buttun>
                                    <buttun formaction = ""  class="btn btn-danger btn-borrar">
                                        <span class = "glyphicon glyphicon-trash"></span>
                                        Eliminar
                                    </buttun>
                                </div>
                            </div>
                    </div>
                    <!-- Area de formulario -->
                    <div class = "row">
                        <div class = "col-md-4">
                            <!-- Formulario Inicio -->
                            <form class = "form-horizontal">
                                <div class = "container">
                                    <div class = "col-md-3">
                                        <label>Numero Equipo:</label><p>PC1</p>
                                        <label>Procesador:</label><p>procesador</p>
                                        <label>Tarjeta grafica:</label><p>Tarjeta grafica</p>
                                        <label>Memoria Ram:</label><p>ram</p>
                                    </div>
                                    <div class = "col-md-3">
                                        <label>Disco duro:</label><p>disco duro</p>
                                        <label>Tarjeta Madre:</label><p>tarjeta madre</p>
                                        <label>Fuente poder:</label><p>fuente poder</p>
                                    </div>
                                </div>

                            </form>
                            <!-- Formulario Fin  -->
                        </div>

                    </div>

                </div>

            </div>
        </div>
    <?php
            }
    ?>
</div>