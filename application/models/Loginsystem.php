<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                    Modelo del sistema de login                     ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Inlcuye los metodos correspondientes a los equipos.                      |
    |--------------------------------------------------------------------------|
*/

class Loginsystem extends CI_Model
{
    /*  Inicializacion del modelo
    =================================================*/
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('encryption');
        $this->encryption->initialize(
        array('cipher' => 'aes-256'));
    }
    
    /*  Ingresa al sistema 
    =================================================*/
    public function login_internal($ci , $pass)
    {
        $user_data = $this->get_user_data($ci);
        if (isset($user_data))
        {
            if ($this->verify_password($ci , $pass ))
            {
                $data = array
                (
                    'usuario_ci' => $user_data->cedula_usuario,
                    'usuario_nombre' => $user_data->nombre,
                    'usuario_tipo' => $user_data->tipo,
                    'usuario_correo' => $user_data->correo,
                    'usuario_pregunta' => $user_data->pregunta_seguridad,
                    'usuario_respuesta' => $user_data->respuesta_seguridad,
                    'usuario_pregunta_activa' => $user_data->pregunta_activada,
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

    /*  Guarda la informacion de usuario en la session
    =================================================*/
    public function set_user_data($ci)
    {
        $user_data = $this->get_user_data($ci);
        $data = array
        (
            'usuario_ci' => $user_data->cedula_usuario,
            'usuario_nombre' => $user_data->nombre,
            'usuario_tipo' => $user_data->tipo,
            'usuario_correo' => $user_data->correo,
            'usuario_pregunta' => $user_data->pregunta_seguridad,
            'usuario_respuesta' => $user_data->respuesta_seguridad,
            'usuario_pregunta_activa' => $user_data->pregunta_activada,
            'logged' => true
        );
        $this->session->set_userdata($data);
    }

    /* Valida la clave de un usuario especifico 
    =================================================*/
    public function verify_password($ci , $pass )
    {
        $user_data = $this->get_user_data($ci);
        if (isset($user_data))
        {
            $encr_pw = $user_data->clave;
            return password_verify($pass , $encr_pw);
        }else 
        {
            return false ;
        }
    }

    /* Verifica si tiene la pregunta de seguridad
    activada 
    =================================================*/
    public function has_user_question($ci)
    {
        $usr = $this->get_user_data($ci); 
        if (isset($usr))
        {
            $q_enabled = $usr->pregunta_activada ; 
            $r_security = $usr->respuesta_seguridad ; 
            $ison = (int)$q_enabled > 0 ; 
            return $ison && !empty($r_security); 
        }else 
        {
            return false ; 
        }
    }

    /*  Obtiene la pregunta de seguridad de un usuario 
    =================================================*/
    public function get_user_question($ci)
    {
         $usr = $this->get_user_data($ci); 
        if (isset($usr))
        { 
            $p_security = $usr->pregunta_seguridad ; 
            return $this->usr->get_question_name($p_security);
        }else      
        {
            return "" ; 
        }
    }
    
    /* Valida la respuesta de seguridad de un usuario
    =================================================*/
    function verify_user_answer( $ci , $answer )
    {
        $usr = $this->get_user_data($ci);
        if (isset($usr))
        {
            $decrypted_q = $this->encryption->decrypt($usr->respuesta_seguridad);
            $q = strtolower($decrypted_q);
            $a = strtolower($answer);
            if ($q === $a)
            {
                return true ; 
            }else 
            {
                return false ; 
            }
        }
    }
    
    /*  Verifica si esta deshabilitado un usuario
    =================================================*/
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

      /*  Verifica si existe un usuario en la base de datos
    =======================================================*/
    public function user_exists($ci)
    {
        $row = $this->get_user_data($ci);
        return isset($row);
    }

    /*  Obtiene la informacion de un usuario especifico
    ====================================================*/
    function get_user_data($ci)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' ; " ;
        $query = $db->query($sql);
        return $query->row(); 
    }
    
    /*  Desconecta a un usuario del sistema
    =================================================*/
    public function logout()
    {
        if ($this->isloggedin())
        {
            $useritems = array('usuario_ci' , 'usuario_nombre' ,
             'usuario_tipo' , 'usuario_correo' , 'logged' , 'usuario_pregunta' , 'usuario_respuesta' );
            $this->session->unset_userdata($useritems);
        }
        redirect('/');
    }

    /*  Verifica si un usuario esta ingresado al sistema
    ====================================================*/
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

    /*  obtiene la informacion del usuario conectaco a la session
    =============================================================*/
    public function getuserdata()
    {
        return array
        (
            'usuario_ci' => $this->session->usuario_ci,
            'usuario_nombre' => $this->session->usuario_nombre,
            'usuario_tipo' => $this->session->usuario_tipo,
            'usuario_correo' => $this->session->usuario_correo,
            'usuario_pregunta' => $this->session->usuario_pregunta ,
            'usuario_respuesta' => $this->session->usuario_respuesta,
            'usuario_pregunta_activa' => $this->session->usuario_pregunta_activa
        );
    }
}
?>