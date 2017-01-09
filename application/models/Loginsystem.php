<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Loginsystem extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function login_internal($ci , $pass)
    {
        $user_data = $this->get_user_data($ci);
        if (isset($user_data))
        {
            $encr_pw = $user_data->clave; 
            if (password_verify($pass , $encr_pw))
            {
                $data = array
                (
                    'usuario_ci' => $user_data->cedula_usuario,
                    'usuario_nombre' => $user_data->nombre,
                    'usuario_tipo' => $user_data->tipo,
                    'usuario_correo' => $user_data->correo,
                    'logged' => true
                );
                $this->session->set_userdata($data);
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

    public function login_external ($ci , $pass)
    {
        
    }

    function is_disabled($ci)
    {
        $row = $this->get_user_data($ci);
        if (isset($row))
        {
            if ($row->habilitado <= 0 )
            {
                return true ;
            }else 
            {
                return false ;
            }
        }else 
        {
            return true ;
        }
    }

    public function user_exists($ci)
    {
        $row = $this->get_user_data($ci);
        return isset($row);
    }

    function get_user_data($ci)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' ; " ;
        $query = $db->query($sql);
        return $query->row(); 
    }
    
    public function logout()
    {
        if ($this->isloggedin())
        {
            $useritems = array('usuario_ci' , 'usuario_nombre' , 'usuario_tipo' , 'usuario_correo' , 'logged' );
            $this->session->unset_userdata($useritems);
        }
        redirect('/');
    }

    public function isloggedin()
    {
        $logged = $this->session->logged;
        if (isset($logged))
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function getuserdata()
    {
        return array
        (
            'usuario_ci' => $this->session->usuario_ci,
            'usuario_nombre' => $this->session->usuario_nombre,
            'usuario_tipo' => $this->session->usuario_tipo,
            'usuario_correo' => $this->session->usuario_correo
        );
    }
}

?>