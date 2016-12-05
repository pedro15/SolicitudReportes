<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class loginsystem 
{
    private $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->library('session');
    }

    public function login($ci , $pass)
    {
        $db = $this->_ci->load->database('default' , TRUE);
		$sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' AND `clave`= '" . $pass . "';" ;
		$query = $db->query($sql);
		$row = $query->row();
        if (isset($row))
        {
            $data = array
            (
                'usuario_ci' => $row->cedula_usuario,
                'usuario_nombre' => $row->nombre,
                'usuario_tipo' => $row->tipo,
                'usuario_correo' => $row->correo,
                'logged' => true
            );
            $this->_ci->session->set_userdata($data);
            return true ;
        }else 
        {
            return false;
        }
    }

    public function logout()
    {
        if ($this->isloggedin())
        {
            $useritems = array('usuario_ci' , 'usuario_nombre' , 'usuario_tipo' , 'usuario_correo' , 'logged' );
            $this->_ci->session->unset_userdata($useritems);
            redirect('/');
        }
    }

    public function isloggedin()
    {
        $logged = $this->_ci->session->logged;
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
            'usuario_ci' => $this->_ci->session->usuario_ci,
            'usuario_nombre' => $this->_ci->session->usuario_nombre,
            'usuario_tipo' => $this->_ci->session->usuario_tipo,
            'usuario_correo' => $this->_ci->session->usuario_correo
        );
    }
}

?>