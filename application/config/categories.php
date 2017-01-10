<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    En este archivo se define la configuracion de las categorias para las solicitudes de soporte tecnico y estados de las mismas,
    puede agregar mas categorias pero tome en cuenta que si se elimina categorias
    y ya existen registros con dicha categoria en la base de datos, se perdera la informacion de la categoria.
*/

$config['computer_categories'] = array
(
    '0' => 'Mouse' , 
    '1' => 'Teclado' ,
    '2' => 'Monitor' ,
    '3' => 'Sistema Operativo' ,
    '4' => 'Hardware equipo' , 
    '5' => 'Otro' 
);

?>