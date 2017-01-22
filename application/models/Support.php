<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                     Modelo de Soporte tecnico                      ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Inlcuye los metodos correspondientes a las solicitudes de soporte tecnico|
    |--------------------------------------------------------------------------|
*/

    class Support extends CI_Model
    {
        /* Inicializacion del modelo
        ===============================================*/
        function __construct()
        {
            parent::__construct();
            $this->load->model('usr');
            $this->load->model('computer');
            $this->load->model('laboratory');
        }

        /* Obtiene las credenciales del correo electronico
        servidor.
        ==================================================*/
        public function get_mail_credentials()
        {
            $this->config->load('emailconf',TRUE);
            return $this->config->item('emailcredentials' , 'emailconf');
        }

        /* Envia una solicitud de soporte tecnico
        ===============================================*/
        public function send_ticket($id_equipo , $descripcion , $tipo , $ci_user)
        {
            $db = $this->load->database('default' , TRUE); 
            $id_falla = random_string('alnum', 17);
            $sql_falla = "INSERT INTO `falla` (`id_falla` , `id_equipo` , `descripcion` , `tipo`) VALUES('" . $id_falla . "','" . $id_equipo . "','" .  $descripcion 
            . "','" .  $tipo . "');" ;
            $db->query($sql_falla);
            if ($db->affected_rows() > 0 )
            {
                // Estado : 0 -> Sin reparar | 1 -> En revision | 2 -> Reparado 
                $sql_reporte = "INSERT INTO `reporte` (`id_reporte`, `id_falla` , `cedula_usuario` , `fecha` , `estado`) VALUES (NULL,'" . $id_falla . "','" . 
                $ci_user . "','" . date("y-m-d") . "', '0');" ; 
                $db->query($sql_reporte); 
                if ($db->affected_rows() > 0 )
                {
                    $ec = $this->get_mail_credentials();
                    if ($ec['enabled'] == true )
                    {
                            $config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' =>  $ec['host'] ,
                                'smtp_port' =>  $ec['port'] ,
                                'smtp_user' =>  $ec['email'] ,
                                'smtp_pass' =>  $ec['password'] ,
                                'mailtype' => 'html',
                                'charset' => 'utf-8',
                                'wordwrap' => TRUE
                            );

                            $htmldata = file_get_contents('resources/mailtemplate.html');
                            $user = $this->loginsystem->get_user_data($ci_user);
                            
                            $htmldata = str_replace('%from%' , $user->nombre , $htmldata);
                            
                            $catname = $this->get_categorie_name($tipo);
                            
                            $htmldata = str_replace('%cat%' , $catname , $htmldata);
                            
                            $htmldata = str_replace('%descripcion%' , $descripcion , $htmldata);
                            
                            $pc = $this->computer->get_pc_info($id_equipo);

                            $htmldata = str_replace('%pc%' , $pc->descripcion , $htmldata);
                            
                            $lab = $this->laboratory->get_lab($pc->id_laboratorio);
                            
                            $htmldata = str_replace( '%laboratorio%' , $lab->descripcion , $htmldata);
                            $htmldata = str_replace( '%url%' , base_url() , $htmldata);

                            $this->load->library('email' , $config);
                            $this->email->set_newline("\r\n");

                            $mails = $this->usr->getsendmails();

                            foreach($mails as $email)
                            {
                                $this->email->from( $ec['email'] , 'SASSTEC Correo');
                                $this->email->to($email);
                                $this->email->subject('Nueva solicitud de soporte tecnico');
                                $this->email->message($htmldata);
                                $s = $this->email->send();
                                if( $s == false )
                                {
                                    show_error($this->email->print_debugger());
                                }
                            }                            
                    }
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

        /* Obtiene la cantidad de los estados segun 
        una solicitud especifica.
        ===============================================*/
        public function get_reports($id_falla)
        {
            $db = $this->load->database('default' , TRUE); 
            $sql_reportes = "SELECT * FROM `reporte` WHERE `id_falla` = '" .  $id_falla  . "' ;" ; 
            $query_reportes = $db->query($sql_reportes);  
            $allreports = $query_reportes->result_array(); 
            foreach ( $allreports as $key => $current )
            {
                $current_user = $this->usr->get_data($allreports[$key]['cedula_usuario']); 
                $allreports[$key]['nombreusuario'] = $current_user['nombre'];
                $currestado = $allreports[$key]['estado'] ; 
                $estado_text = "" ; 
                switch($currestado)
                {
                    case "0" : 
                        $estado_text = "Sin reparar" ; 
                    break ;

                    case "1" : 
                        $estado_text = "En revision" ; 
                    break; 

                    case "2" : 
                        $estado_text = "Reparado" ; 
                    break ;
                }
                $allreports[$key]['estadotext'] = $estado_text ; 
            }
            return $allreports;
        }

        /* Obtiene todas las solicitudes de soporte 
        tecnico
        ===============================================*/
        public function get_all()
        {
            $sql_falla = "SELECT * FROM `falla` ;" ;
            $db = $this->load->database('default' , TRUE); 
            $query = $db->query($sql_falla); 
            $results = $query->result_array();
            foreach ($results as $key => $current )
            {
                $sql_reportes = "SELECT * FROM `reporte` WHERE `id_falla` = '" .   $results[$key]['id_falla']   . "' ;" ; 
                $query_reportes = $db->query($sql_reportes);  
                $actualestado = $query_reportes->last_row();
                $estadoinicial = $query_reportes->first_row();
                $results[$key]['estadoactual'] = $actualestado;
                $pcid = $results[$key]['id_equipo'] ;
                $current_pc = $this->computer->get_pc_info($pcid);
                $results[$key]['equipoactual'] = $current_pc; 
                $current_lab = $this->laboratory->get_lab($current_pc->id_laboratorio);
                $results[$key]['laboratorioactual'] = $current_lab;
                $current_sede = $this->sede->get_sede($current_lab->id_sede);
                $results[$key]['sedeactual'] = $current_sede;
                $current_user = $this->usr->get_data($estadoinicial->cedula_usuario);
                $results[$key]['usuarioactual'] = $current_user;
                $tipo = $results[$key]['tipo'] ; 
                $categoria = "" ;
                $categoria = $this->get_categorie_name($tipo);
                $results[$key]['categoria'] = $categoria; 
            }
            return $results; 
        }

        /* Cambia y agrega el estado de una solicitud 
        de soporte tecnico.
        ===============================================*/
        public function updatereport($id_falla , $estado , $ci_user)
        {
             $db = $this->load->database('default' , TRUE); 
             $sql = "INSERT INTO `reporte`(`id_reporte` , `id_falla`, `cedula_usuario` ,`fecha` , `estado` ) VALUES (" . 
             "NULL,'" . $id_falla . "','" . $ci_user . "','" . date("y-m-d") . "','" . $estado . "');" ; 
             $db->query($sql);
             if ($db->affected_rows() > 0 )
             {
                 return true ;
             }else 
             {
                 return false ; 
             }
        }

        /* Elimina una solicitud de soporte tecnico 
        especifica
        ===============================================*/
        public function remove($id)
        {
             $db = $this->load->database('default' , TRUE); 
             $sql = "DELETE FROM `falla` WHERE `id_falla` = '" . $id . "' ; " ; 
             $db->query($sql);
             if ($db->affected_rows() > 0 )
             {
                 return true ; 
             }else 
             {
                 return false ;
             }
        }

        /* Obtiene una solicitud de soporte tecnico 
        especifica
        ===============================================*/
        public function get_falla($id_falla)
        {
            $db = $this->load->database('default' , TRUE); 
            $sql = "SELECT * FROM `falla` WHERE `id_falla` = '" . $id_falla . "' ; " ;
            $query = $db->query($sql);
            return $query->row();
        }

        /* Obtiene la lista de las categoria de soporte 
        tecnico desde el archivo de configuracion 
        ubicado en : application/config/categories.php
        ===============================================*/
        public function get_categories()
        {
            $this->config->load('categories',TRUE);
            return $this->config->item('computer_categories' , 'categories');
        }

        /* Obtiene una categoria especifica desde la 
        lista de categorias de soporte tecnico.
        ===============================================*/
        public function get_categorie_name($categorieindex)
        {
            $cats = $this->get_categories();
            if(array_key_exists($categorieindex , $cats))
            {
                return $cats[$categorieindex]; 
            }else 
            {
                return "" ; 
            }
        }

    }
?>