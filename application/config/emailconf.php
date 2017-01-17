<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/*
| ------------------------------------------------------------------------------------
|  Email
| -------------------------------------------------------------------------------------
| En este archivo se especifica las credenciales de correo para el cliente instantaneo 
| el cual se usa para el envio de correo en la solicitudes de soporte tecnico
*/

$config['emailcredentials'] = array
(
    'email' => '' , //Correo electronico
    'password' => '' , // Clave del correo electronico
    'port' => '' , // Puerto usado por el cliente de correo electronico
    'enabled' => FALSE // determina si esta activado esta funcion, debe asignarla como TRUE junto con sus credenciales para hacerla funcionar.
);

?>