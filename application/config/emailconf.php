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
    'email' => 'lastframegames@gmail.com' , //Correo electronico 
    'password' => 'LastFrameGames2015$' , // Clave del correo electronico
    'port' => 465 ,  // Puerto usado por el servidor de correo
    'host' => 'ssl://smtp.googlemail.com' , // host del servidor de correo
    'enabled' => true // determina si esta activado esta funcion, debe asignarla como true junto con sus credenciales para hacerla funcionar.
);

?>