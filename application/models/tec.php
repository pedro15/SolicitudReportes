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
        $sql = "SELECT * FROM `usuario` WHERE `tipo` = '2' OR  `tipo` = '0' ; "; 
        $query = $db->query($sql);
        return $query->result();
    }

    public function remove( $ci )
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "DELETE FROM `usuario` WHERE ( `tipo` = '2' OR `tipo` = '0' ) AND `cedula_usuario` = '".  $ci . "' ; "; 
            $query = $db->query($sql);
            if ( $db->affected_rows() > 0 )
            {
                return true ;
            }else 
            {
                return false ;
            }
        }else 
        {
            return false;
        }
    }

    public function edit($ci , $new_ci , $new_name , $new_pw , $new_question , $new_email)
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "UPDATE `usuario` SET `cedula_usuario` = '" . $new_ci . "', `nombre` = '" . $new_name . "', `pregunta_seguridad` = '" . $new_question . 
            "', `correo` = '" . $new_email . "' WHERE `cedula_usuario` = '" . $ci . "' ;" ; 
            $query = $db->query($sql);
            if ($db->affected_rows() > 0 )
            {
                return true ;
            }else 
            {
                return false ;
            }
        }else 
        {
            return false;
        }
    }

    public function change_state($ci , $new_state)
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "UPDATE `usuario` SET `tipo` = '" . $new_state ."' WHERE `cedula_usuario` = '" . $ci . "' ;" ;
            $db->query($sql);
            if ($db->affected_rows() > 0 )
            {
                return true ;
            }else
            {
                return false ;
            }
        }else 
        {
            return false;
        }
    }

    function register($ci , $name , $pw , $security_question , $type , $email  )
    {
        if (!$this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_seguridad`, `tipo`, `correo`) VALUES ('" . 
            $ci . "','" . $name . "','" .  password_hash($pw , PASSWORD_DEFAULT ) . "','" . $security_question . "','" . $type . "','" . $email . "');" ;
            $db->query($sql); 
            if ($db->affected_rows() > 0 )
            {
                return true;
            }else 
            {
                return false;
            } 
        }else 
        {
            return false ;
        }
    } 

    public function is_in_database($ci)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' ;" ;
        $query = $db->query($sql);
        $row = $query->row();
        if (isset($row))
        {
            return true ;
        }else 
        {
            return false;
        }
    }
}