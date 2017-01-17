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
    'No prende/inicia' ,
    'Se reinicia' ,
    'Configurar mail' ,
    'Archivos perdios' ,
    'Bloqueo' ,
    'Mensajes de error' ,
    'Mouse' ,
    'Teclado' ,  
    'Fuente de poder' , 
    'Otro'  
);

$config['security_questions'] = array
(
 'Nombre de tu primera mascota',
 'Apellido de tu madre',
 'Fruta favorita',
 'Color favorito'
);

?>