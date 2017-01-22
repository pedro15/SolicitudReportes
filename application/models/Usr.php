<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                      Modelo del usuario                            ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Incluye todos los metodos correspondientes a los usuarios en el sistema  |
    |--------------------------------------------------------------------------|
*/

class Usr extends CI_Model
{
    /* Inicializacion del modelo
    =================================================*/
    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->encryption->initialize(
        array('cipher' => 'aes-256'));
    }
    
    /* devuelve todos los usuarios del sistema
    =================================================*/
    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` ;"; 
        $query = $db->query($sql);
        return $query->result();
    }
    
    /* Registra una nueva sede en la base de datos
    =================================================*/
    public function getsendmails()
    {
         $db = $this->load->database('default' , TRUE);
         $sql = "SELECT * FROM `usuario` WHERE `tipo` = '3' OR `tipo` = '2' AND `habilitado` = '1' ;" ; 
         $mailsarr = array();
         $query = $db->query($sql);
         $result = $query->result();
         foreach ($result as $item)
         {
             if (!empty($item->correo))
             {
                 array_push($mailsarr,$item->correo);
             }
         }
         return $mailsarr;
    }

     /* Registra una nueva sede en la base de datos
    =================================================*/
    public function remove( $ci )
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "DELETE FROM `usuario` WHERE `cedula_usuario` = '".  $ci . "' ; "; 
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

     /* Habilita o deshabilita un usuario en el sistema
    ====================================================*/
    public function change_state($ci , $new_state)
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "UPDATE `usuario` SET `habilitado` = '" . $new_state ."' WHERE `cedula_usuario` = '" . $ci . "' ;" ;
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

     /* Cambia el nivel de privilegio de un usuario.
    =================================================*/
    public function change_type($ci , $newtype)
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "UPDATE `usuario` SET `tipo` = '" . $newtype ."' WHERE `cedula_usuario` = '" . $ci . "' ;" ;
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

     /* Actualiza la informacion de un usuario.
    =================================================*/
    function update_profile($ci , $new_name , $new_email , $new_questionid , $new_question , $questionenabled )
    {
         if($this->is_in_database($ci))
        {
            $q_enabled = $questionenabled == 'on' ?  '1' : '0' ; 
            $db = $this->load->database('default' , TRUE);
            $sql = "UPDATE `usuario` SET  `nombre` = '" . $new_name . "', `pregunta_seguridad` = '" . $new_questionid . 
            "', `respuesta_seguridad` = '" . $this->encryption->encrypt($new_question) . "' , `pregunta_activada` = '" . $q_enabled . "'  , `correo` = '" . $new_email . "' WHERE `cedula_usuario` = '" . $ci . "' ;" ; 
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

     /* Actualiza la clave de un usuario
    =================================================*/
    function change_password($ci , $new_password)
    {
        if($this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $encrypted_password = password_hash($new_password , PASSWORD_DEFAULT );
            $sql = "UPDATE `usuario` SET  `clave` = '" . $encrypted_password . "'  WHERE `cedula_usuario` = '" . $ci . "' ;" ; 
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
    
     /* Registra un usuario en la base de datos
    =================================================*/
    function register($ci , $name , $pw , $security_question , $type , $email  )
    {
        if (!$this->is_in_database($ci))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_seguridad`, `tipo` , `habilitado` , `correo`) VALUES ('" . 
            $ci . "','" . $name . "','" .  password_hash($pw , PASSWORD_DEFAULT ) . "','" . $security_question . "','" . $type . "', '1' , '" . $email . "');" ;
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

     /* Verifica si un usuario se encuentra registrado en la base de datos
    =======================================================================*/
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

     /* Verficia si un usuario en especifico es administrador
    ==========================================================*/
    public function is_admin($ci)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "';" ;
        $query = $db->query($sql);
        $row = $query->row();
        if (isset($row))
        {
            if ($row->tipo == 3 )
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

     /* Verifica si puede eliminar a un usuario de 
     la base de datos
    =================================================*/
    public function can_remove($ci)
    {
        if ($this->is_admin($ci))
        {
            $db = $this->load->database('default' , TRUE); 
            $sql = "SELECT * FROM `usuario` WHERE `tipo` = '3'; " ; 
            $query = $db->query($sql); 
            $count_r = $query->num_rows(); 
            if ($count_r > 1 )
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

     /* Verficia si existen administradores en la 
     base de datos
    =================================================*/
    public function has_admins()
    {
         $db = $this->load->database('default' , TRUE); 
         $sql = "SELECT * FROM `usuario` WHERE `tipo` = '3' ; " ;
         $query = $db->query($sql) ; 
         $row = $query->row();
         return isset($row); 
    }

     /* Obtiene la informacion de un usuario en 
     especifico
    =================================================*/
    public function get_data($ci)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' ; " ; 
        $query = $db->query($sql);
        return $query->row_array();
    }
    
     /* Obtiene las preguntas de seguridad predefinidas
     desde el archivo: application/config/categories.php
    =====================================================*/
    public function get_questions()
    {
        $this->config->load('categories',TRUE);
        return $this->config->item('security_questions' , 'categories');
    }

     /* Obtiene una pregunta de  seguridad especifica
    =================================================*/
    public function get_question_name($id)
    {
        $questions = $this->get_questions();
        if (array_key_exists($id,$questions))
        {
            return $questions[$id];
        }else 
        {
            return "" ; 
        }
    }

}