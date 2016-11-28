<?php 
require_once('Program.php');
session_start();
$ci = $_POST['cilogin'] ;
$pw = $_POST['passlogin'];
$isloggedin = Program::LoginInternal($ci , $pw);
if ($isloggedin == true )
{
    $_SESSION['ciuser'] = $ci;
    Program::Redirect_user($ci);
    die();
}else{
    $img = "<img src=" . "images/warning.png" . " alt=" . "Alert" . " height=" ."32" . " width=" ."32" . ">";
    $_SESSION['message'] = $img . ' Datos incorrectos '  ;
    closesystem();
}
?>