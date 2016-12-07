<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Tec extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `tipo` = '2' ; "; 
        $query = $db->query($sql);
        return $query->result();
    }

    public function remove( $ci )
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "DELETE FROM `usuario` WHERE `tipo` = '2' AND `cedula_usuario` = '".  $ci . "' ; "; 
        $query = $db->query($sql);
        if ($query->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function edit($ci , $new_ci , $new_name , $new_pw , $new_question , $new_email)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "UPDATE `usuario` SET `cedula_usuario` = '" . $new_ci . "', `nombre` = '" . $new_name . "', `pregunta_seguridad` = '" . $new_question . 
        "', `correo` = '" . $new_email . "' WHERE `cedula_usuario` = '" . $ci . "' ;" ; 
        $query = $db->query($sql);
        if ($query->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }
}