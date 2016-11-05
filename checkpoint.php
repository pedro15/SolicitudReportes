<?php 
session_start();
require 'App.php';
$ci = $_POST['cilogin'] ;
$pw = $_POST['passlogin'];
$isloggedin = login($ci, $pw);
if ($isloggedin == true )
{   
    $_SESSION['ciuser'] = $ci;
    redirect_user($ci);
    die();
}else{
    $img = "<img src=" . "images/warning.png" . " alt=" . "Alert" . " height=" ."32" . " width=" ."32" . ">";
    $_SESSION['message'] = $img . ' Datos incorrectos '  ;
    closesystem();
}
?>