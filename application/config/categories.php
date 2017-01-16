<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/*
| ------------------------------------------------------------------------------------
|  Categorias
| -------------------------------------------------------------------------------------
| En este archivo se especifican las categorias usadas en las 
| solicitudes de soporte tecnico y en las preguntas de seguridad,
| puede agregar y modificar dichas categorias, pero tome en cuenta 
| que si tiene registros en la base de datos estos estaran afectados con dichos cambios.
|
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

$config['security_questions'] = array
(
    '0' => 'Nombre de tu primera mascota',
    '1' => 'Apellido de tu madre',
    '2' => 'Fruta favorita',
    '3' => 'Color favorito'
);

?>