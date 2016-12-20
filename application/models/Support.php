<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

    class Support extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper('string');
        }

        public function send_ticket($id_equipo , $descripcion , $tipo , $ci_user)
        {
            $db = $this->load->database('default' , TRUE); 
            $id_falla = random_string('alnum', 17);
            /*
            Tipo:
            0 -> Mouse 
            1 -> Teclado
            2 -> Monitor 
            3 -> Sistema Operativo
            4 -> No enciende 
            5 -> Otro 
            */ 
            $sql_falla = "INSERT INTO `falla` (`id_falla` , `id_equipo` , `descripcion` , `tipo`) VALUES('" . $id_falla . "','" . $id_equipo . "','" .  $descripcion 
            . "','" .  $tipo . "');" ;
            $db->query($sql_falla);
            if ($db->affected_rows() > 0 )
            {
                // Estado : 0 -> Sin reparar | 1 -> Nesesita Revision | 2 -> Reparado 

                $sql_reporte = "INSERT INTO `reporte` (`id_reporte`, `id_falla` , `cedula_usuario` , `fecha` , `estado`) VALUES (NULL,'" . $id_falla . "','" . 
                $ci_user . "','" . date("y-m-d") . "', '0');" ; 
                $db->query($sql_reporte); 
                if ($db->affected_rows() > 0 )
                {
                    return true ;
                }else 
                {
                    return false ;
                }
            }else 
            {
                return false ; 
            }   
        }

        public function check_ticket()
        {

        }

        public function check_damagedb()
        {

        }

    }

?>