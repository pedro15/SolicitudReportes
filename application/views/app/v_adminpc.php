<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<div class = "container">
    <div class = "page-header">
        <h3>Administrar equipos</h3>
    </div>

    <form method = "POST" action = "#">
        
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Procesador</th>
                    <th>Tarjeta grafica</th>
                    <th>Memoria Ram</th>
                    <th>Disco duro</th>
                    <th>Tarjeta madre</th>
                    <th>Fuente poder</th>
                    <th>Laboratorio</th>
                    <th>Sede</th>
                </tr>
            <thead>
            <tbody>
                <?php for ($i = 0 ; $i < 1 ; $i++): ?>
                <tr>
                    <th>1</th>
                    <th>amd </th>
                    <th>nvidia</th>
                    <th>hseugusie</th>
                    <th>hesiugesi</th>
                    <th>heseuisgegs</th>
                    <th>ehsgheuisg</th>
                    <th>heosheusg</th>
                    <th>sehbsueusg</th>
                    <th> <buttun class = "btn btn-primary">Editar</buttun> </th>
                </tr>
                <?php endfor ?>
            </tbody>
        </table>

    </div>
</div>