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

        public function get_all()
        {
            $sql_falla = "SELECT * FROM `falla` ;" ;
            $db = $this->load->database('default' , TRUE); 
            $query = $db->query($sql_falla); 
            $results = $query->result_array();
            foreach ($results as $key => $current )
            {
                $sql_reportes = "SELECT * FROM `reporte` WHERE `id_falla` = '" .  $results[$key]['id_falla'] . "' ;" ; 
                $query_reportes = $db->query($sql_reportes);  
                $results[$key]['reportes'] = $query_reportes->result_array(); 
                $actualestado = $query_reportes->last_row();
                $results[$key]['estadoactual'] = $actualestado;
                $pcid = $results[$key]['id_equipo'] ;
                $current_pc = $this->computer->get_pc_info($pcid);
                $results[$key]['equipoactual'] = $current_pc; 
                $current_lab = $this->laboratory->get_lab($current_pc->id_laboratorio);
                $results[$key]['laboratorioactual'] = $current_lab;
                $current_sede = $this->sede->get_sede($current_lab->id_sede);
                $results[$key]['sedeactual'] = $current_sede;
                $current_user = $this->usr->get_data($actualestado->cedula_usuario);
                $results[$key]['usuarioactual'] = $current_user;
                $tipo = $results[$key]['tipo'] ; 
                $categoria = "" ;
                switch ($tipo)
                {
                    case "0" : 
                        $categoria = "Mouse" ; 
                    break ;

                    case "1" : 
                        $categoria = "Teclado" ; 
                    break ;

                    case "2" : 
                        $categoria = "Monitor" ; 
                    break; 

                    case "3" :
                        $categoria = "Sistema Operativo" ;
                    break; 

                    case "4" :
                        $categoria = "No enciende" ; 
                    break; 

                    case "5" :
                        $categoria = "Otro" ; 
                    break;
                }
                $results[$key]['categoria'] = $categoria; 
            }
            return $results; 
        }

    }
?>