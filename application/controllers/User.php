<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class User extends CI_Controller 
{    
    /* carga el header, la cabezera , y la barra de navegacion.
    =================================================*/
    function start_page()
    {
        $this->load->view('head.php');
        $this->load->view('letterhead.php');
        $usr_data = $this->loginsystem->getuserdata();
        $usr_type = $usr_data['usuario_tipo'];
        switch($usr_type)
        {
            case 1 :
                // barra navegacion usuario
            break;

            case 2 :
                // barra navegacion tecnico
                $data['nombre_usuario'] = $usr_data['usuario_nombre'] ; 
                $this->load->view('nav_tec.php' , $data);
                $this->load->view('timerscript.php');
            break;

            case 3 :
                 // barra navegacion administrador
                 $data['nombre_usuario'] = $usr_data['usuario_nombre'] ; 
                 $this->load->view('nav_admin.php' , $data);
                 $this->load->view('timerscript.php');
            break;

            default:
                $this->loginsystem->logout();
            break;
        }
    }

    /* Carga el footer de la pagina
    =================================================*/
    function end_page()
    {
        $this->load->view('footer.php');
    }

    /* devuelve TRUE si el nivel de acceso actual corresponde
    a los niveles de acceso especificados
    =================================================*/
    function canload_module( $permisionlevels = array() )
    {
        if ($this->loginsystem->isloggedin() === false )
        {
            redirect('/');
        }else
        {
            $this->start_page();
            $usr_type = $this->loginsystem->getuserdata()['usuario_tipo'];
            if (in_array($usr_type , $permisionlevels))
            {
                return true ;
            }else 
            {
                redirect('user');
                return false;
            }
        }
    }

    function load_alert($message , $type)
    {
        $data['message'] = $message;
        $data['a_type'] = $type;
        $this->load->view('alert.php' , $data ); 
    }

    /* se inicia por defecto al ingresar al sistema
    =================================================*/
    public function index()
	{
        if ($this->loginsystem->isloggedin() === false )
        {
            redirect('/');
        }else
        {
            $this->start_page();
            
            $this->end_page();
        }
    }

    /*  *** MODULOS DE EL SISTEMA *** */

    /* ==============================
    Solicitudes de soporte tecnico
    =================================*/ 

    /* Enviar Solicitud
    =================================================*/
    public function sendticket ()
    {
        if ($this->canload_module(array(1,2,3)))
        {
            $id_pc = $this->input->post('idequipo');
            $category = $this->input->post('category');
            $desc = $this->input->post('descripcion');

            if (isset($id_pc) && $this->computer->isindb_byid($id_pc) && 
            isset($category) && isset($desc) && $id_pc != "none" ) 
            {
                $ci = $this->loginsystem->getuserdata()['usuario_ci'];
                if ($this->support->send_ticket($id_pc,$desc,$category,$ci))
                {
                    $this->load_alert("Solicitud enviada correctamente" , "SUCESS");
                }
            }

            $data['sedes'] = $this->sede->get_all(); 
            $data['categorias'] = $this->support->get_categories();

            $this->load->view('app/v_sendticket.php' , $data);
            // pie de pagina
            $this->end_page();
        }
    }

    public function getpcsbylab()
    {
        $labid = $this->input->post('laboratoryid');
        if (isset($labid))
        {
            $pcs = $this->computer->getby_lab ($labid);
            echo json_encode($pcs);
        }
    }

    /* Administrar solicitudes
    =================================================*/
    public function admintickets()
    {
        if ($this->canload_module(array(3))) 
        {
            $data['sedes'] = $this->sede->get_all(); 
            $this->load->view('app/v_adminticket.php' , $data);
            // pie de pagina
            $this->end_page();
        }
    }

    // Devuelve todas las solicitudes de soporte tecnico en un JSON 

    public function getpcinfojson()
    {
        $pcid = $this->input->post('pcid');
        if (isset($pcid))
        {
            $result = $this->computer->get_pc_info($pcid);
            echo json_encode($result);
        }
    }

    public function getallticketsjson()
    {
        $request = $this->input->post('request');
        if (isset($request))
        {
           $data = $this->support->get_all();
           echo json_encode($data);
        }
    }

    public function getallreportsjson()
    {
        $id_falla = $this->input->post('idfalla');
        if (isset($id_falla))
        {
            $data = $this->support->get_reports($id_falla);
            echo json_encode($data);
        }
    }

    public function requestchangereportstate()
    {
        $id = $this->input->post('reportid');
        $newvalue = $this->input->post('newvalue'); 
        if (isset($id) && isset($newvalue))
        {
            $ci = $this->loginsystem->getuserdata()['usuario_ci'];
            $result = $this->support->updatereport($id , $newvalue , $ci);
            echo json_encode($result);
        }
    }

    public function requestdeletereport()
    {
        $id = $this->input->post('reportid');
        if (isset($id))
        {
            $result = $this->support->remove($id);
            echo json_encode($result);
        }
    }

    /* ========================
    Sedes
    ==========================*/ 

    /* Agregar sede
    =================================================*/
    public function registersede()
    {
        if ($this->canload_module(array(3))) 
        {
            $name = $this->input->post('sede_nombre');
            $ubicacion = $this->input->post('sede_ubicacion');
            if (isset($ubicacion) && isset($name))
            {
                $id = random_string('alnum', 19);
                if ($this->sede->register($id,$name,$ubicacion))
                {
                    $this->load_alert("Sede registrada correctamente" , "SUCESS");
                }else 
                {
                    $this->load_alert("Error al registrar sede" , "DANGER");
                }
            }
            $this->load->view('app/v_addsede.php');
            // pie de pagina
            $this->end_page();
        }
    }

    /* Administrar sede
    =================================================*/
    public function adminsede()
    {
        if ($this->canload_module(array(3)))
        {
            $idsede = $this->input->get('idsede');
            $action = $this->input->get('action');
            if (isset($idsede) && isset($action) && $this->sede->isin_db($idsede))
            {
                switch($action)
                {
                    case "edit" :                         
                        $sedename = $this->input->post('sedename');
                        $sedeloc = $this->input->post('sedelocation');
                        if (isset($sedename))
                        {
                            if ($this->sede->edit($idsede,$sedename,$sedeloc))
                            {
                                $this->load_alert("Sede actualizada correctamente" , "SUCESS");
                            }
                        }
                        $data['currentsede'] = $this->sede->get_sede($idsede);
                        $this->load->view('app/v_updatesede.php' , $data);
                    break;

                    case "delete" :
                        
                        if ($this->sede->delete($idsede))
                        {
                            $this->load_alert("Sede eliminada correctamente" , "SUCESS");
                        }
                        $this->load->view('app/v_adminsede.php');
                    break ;

                    default : 
                        $this->load->view('app/v_adminsede.php');
                    break;
                }
            }else
            {
                $this->load->view('app/v_adminsede.php');
            }
            // pie de pagina
            $this->end_page();
        }
    }

    public function getallsedes()
    {
        $sedes = $this->sede->get_all();
        echo json_encode($sedes);
    }

    /* ========================
    Laboratorios
    ==========================*/ 

    /* Registrar laboratorio
    =================================================*/
    public function registerlab()
    {
        if ($this->canload_module(array(3)))
        {

            $opc_sede = $this->input->post('sedeopc');
            $lab_name = $this->input->post('nombre_lab');
            if (isset($opc_sede) && isset($lab_name) )
            {
               if ($this->laboratory->register($opc_sede , $lab_name))
               {
                   $this->load_alert("Laboratorio registrado correctamente" , "SUCCESS");
               }
            }

            $sedes = $this->sede->get_all();
            $data['rows_sedes'] = $sedes;
            $this->load->view('app/v_addlab.php' , $data);
           
            // pie de pagina
            $this->end_page();
        }
    }

    /* Administrar laboratorio
    =================================================*/
    public function adminlab()
    {
        if ($this->canload_module(array(2,3)))
        {
            $data['sedes'] = $this->sede->get_all();
            $opc = $this->input->get('action');
            $labid = $this->input->get('labid');
            if (isset($opc) && isset($labid) && $this->laboratory->isin_db($labid))
            {
                switch($opc)
                {
                    case "edit" : 
                        $namedata = $this->input->post('labname');
                        if (isset($namedata))
                        {
                            if ($this->laboratory->edit($labid,$namedata))
                            {
                                $this->load_alert("Laboratorio actualizado correctamente" , "SUCCESS");
                            }
                        }
                        $data['mlaboratory'] = $this->laboratory->get_lab($labid);
                        $this->load->view('app/v_editlab.php',$data);
                    break;
                    case "delete" : 
                        if ($this->laboratory->remove($labid))
                        {
                            $this->load_alert("Laboratorio eliminado correctamente" , "SUCCESS");
                        }
                        $this->load->view('app/v_adminlab.php' , $data);
                    break;
                } 
            }else
            {
                $this->load->view('app/v_adminlab.php' , $data);
            }
            // pie de pagina
            $this->end_page();
        }
    }

    // Devuelve la lista de todos los laboratorios en un json
    public function getall_labs()
    {
        $labs = $this->laboratory->get_all();
        foreach ($labs as $key => $row)
        {
            $currsede = $this->sede->get_sede($labs[$key]->id_sede);
            $labs[$key]->sedename = $currsede->nombre; 
        }
        echo json_encode($labs);
    }

    /* ========================
    Equipos
    ==========================*/ 

    /* Registrar equipo ---
    =================================================*/
    public function registerpc()
    {
        if ($this->canload_module(array(3)))
        {
            $num_pc = $this->input->post('pc_num');
            $cpu_pc = $this->input->post('pc_cpu');
            $video_pc = $this->input->post('pc_video');
            $ram_pc = $this->input->post('pc_ram');
            $hdd_pc = $this->input->post('pc_hdd');
            $motherboar_pc = $this->input->post('pc_motherboard');
            $fuente_pc = $this->input->post('pc_fuente');
            $monitor_pc = $this->input->post('pc_monitor');
            $teclado_pc = $this->input->post('pc_teclado');
            $dvd_pc = $this->input->post('pc_dvd');
            $so_pc = $this->input->post('pc_so');
            $id_lab = $this->input->post('lab_id');

            if ( isset($num_pc) && isset($cpu_pc) && isset($video_pc)
            && isset($ram_pc) && isset($hdd_pc) && isset($motherboar_pc) 
            && isset($fuente_pc) && isset($id_lab) && !($id_lab == "Seleccione Sede" || $id_lab == "Seleccionar" ) )
            {
                if ($this->computer->register($num_pc,$cpu_pc,$video_pc,$ram_pc,$hdd_pc,$motherboar_pc,
                $fuente_pc, $monitor_pc , $teclado_pc , $dvd_pc , $so_pc ,$id_lab))
                {
                    $this->load_alert("Equipo registrado correctamente" , "SUCESS");
                }else 
                {
                    $this->load_alert("Este equipo ya se encuentra registrado", "DANGER");
                }
            }
            $data['sedes'] = $this->sede->get_all();

            $this->load->view('app/v_registerpc.php' , $data);
            // pie de pagina
            $this->end_page();
        }
    }
    
    // debuelve los laboratorios en un json segun una variable post asignada a esta url .. se usa en el formulario registrar equipo. 
    public function getlabsbysede()
    {
        $id_sede = $this->input->post('id_sede_json');
        if (isset($id_sede))
        {
            $data = $this->laboratory->find_by_sede($id_sede);
            echo json_encode($data);
        }
    }

    /* Administrar Equipo 
    =================================================*/
    public function adminpc()
    {
        if ($this->canload_module(array(3)))
        { 

            $idpc = $this->input->get('id');
            $actionform = $this->input->get('action');

            if (isset($actionform) && isset($idpc) )
            {
                switch ($actionform)
                {
                    case "remove" : 
                        if ($this->computer->deletepc($idpc))
                        {
                            $this->load_alert("Equipo eliminado correctamente" , "SUCESS");
                        }
                    break; 
                }
            }

            $data['sedes'] = $this->sede->get_all();

            $this->load->view('app/v_adminpc.php' , $data);
            // pie de pagina
            $this->end_page();
        }
    }

    // Editar equipo
    public function editpc()
    {
        if ($this->canload_module(array(3)))
        {
            $id = $this->input->get('id');
            if (isset($id))
            {
                $pcinfo = $this->computer->get_pc_info($id);
                if (isset($pcinfo))
                {
                    $num_pc = $this->input->post('pc_num');
                    $id_lab = $this->input->post('lab_id');

                    $cpu_pc = $this->input->post('pc_cpu');
                    $video_pc = $this->input->post('pc_video');
                    $ram_pc = $this->input->post('pc_ram');
                    $hdd_pc = $this->input->post('pc_hdd');
                    $motherboar_pc = $this->input->post('pc_motherboard');
                    $fuente_pc = $this->input->post('pc_fuente');
                    $monitor_pc = $this->input->post('pc_monitor');
                    $teclado_pc = $this->input->post('pc_teclado');
                    $dvd_pc = $this->input->post('pc_dvd');
                    $so_pc = $this->input->post('pc_so');

                    $data['pc_id'] = $pcinfo->id_equipo;
                    $data['pc_num'] = $pcinfo->descripcion; // Numero pc establecido por el usuario
                    $data['pc_cpu'] = $pcinfo->procesador;  // Procesador 
                    $data['pc_gpu'] = $pcinfo->tarjeta_grafica; // Tarjeta de video
                    $data['pc_ram'] = $pcinfo->memoria_ram; // Memoria Ram
                    $data['pc_hdd'] = $pcinfo->disco_duro; // Disco duro
                    $data['pc_tm'] = $pcinfo->tarjeta_madre; // Tarjeta madre
                    $data['pc_fp'] = $pcinfo->fuente_poder; // Fuente de poder
                    $data['pc_monitor'] = $pcinfo->monitor; // Monitor
                    $data['pc_teclado'] = $pcinfo->teclado ; // Teclado
                    $data['pc_dvd'] = $pcinfo->lector_dvd ; // Lector dvd 
                    $data['pc_so'] = $pcinfo->sistema_operativo; // sistema operativo
                    $data['lab_id'] = $pcinfo->id_laboratorio; // id de laboratorio
                    $labinfo = $this->laboratory->get_lab($pcinfo->id_laboratorio); 
                    $data['lab_name'] = $labinfo->descripcion ; // Nombre laboratorio
                    $data['sedes'] = $this->sede->get_all(); // Listas de sedes 
                    $sedeinfo = $this->sede->get_sede($labinfo->id_sede);
                    $data['sede_name'] = $sedeinfo->nombre;

                    if ( isset($num_pc) && isset($cpu_pc) && isset($video_pc)
                    && isset($ram_pc) && isset($hdd_pc) && isset($motherboar_pc) 
                    && isset($fuente_pc) )
                    {
                        $editnumpc = $pcinfo->descripcion;
                        $editlabid = $pcinfo->id_laboratorio;

                        if (isset($num_pc) && $num_pc != "none"  )
                        {
                            $editnumpc = $num_pc;
                        }

                        if (isset($id_lab) && $id_lab != "none" )
                        {
                            $editlabid = $id_lab;
                        }

                        if ($this->computer->editpc( $pcinfo->descripcion , $pcinfo->id_laboratorio , $cpu_pc , $video_pc , $ram_pc , $hdd_pc , $motherboar_pc, 
                        $fuente_pc , $monitor_pc , $teclado_pc , $dvd_pc , $so_pc , $editlabid , $editnumpc ))
                        {
                            redirect('user/adminpc'); 
                        }
                    }
                    $this->load->view('app/v_updatepc.php',$data); 
                }else
                {
                     redirect('user');
                }
            }else 
            {
                redirect('user');
            }
            // Pie de pagina 
            $this->end_page();
        }
    }

    public function canchange_pc()
    {
        $labid = $this->input->post('lab_id'); 
        $pcname = $this->input->post('pc_name');
        $ignoreid = $this->input->post('ignoreid');

        if (isset($labid) && isset($pcname))
        {
            $pc_id = $labid . "pc_" . $pcname ;  
            echo json_encode($this->computer->isindb_ignoring($pc_id , $ignoreid));
        }else 
        {
            echo json_encode(false);
        }
    }

    // obtiene todas las pcs y las devuelve en un json
    public function getallpcs()
    {
        $rows = $this->computer->get_all();
        foreach($rows as $key => $row)
        {
            $_labdata = $this->laboratory->get_lab($rows[$key]['id_laboratorio']);
            if (isset($_labdata))
            {
                 $rows[$key]['labname'] = $_labdata->descripcion;
                 $currsede = $this->sede->get_sede($_labdata->id_sede);
                 $rows[$key]['sedename'] = $currsede->nombre;
            }
        }
        echo json_encode($rows);
    }

    /* ========================
    Usuarios
    ==========================*/ 

    /* Registrar Usuario
    =================================================*/
    public function registerusr()
    {
        if ($this->canload_module(array(3)))
        {
            $_name = $this->input->post('name');
            $_email = $this->input->post('email');
            $_ci = $this->input->post('userci');
            $type = $this->input->post('usrtype');
            if (isset($_name) && isset($_email) && isset($_ci))
            {
                $default_pw = $_ci; // Clave por defecto
                $sec_question = "" ;
                if ($this->usr->register($_ci , $_name , $default_pw , $sec_question , $type , $_email))
                {
                    $this->load_alert("Usuario registrado correctamente ! <strong>la clave inicialmente es la Cedula</strong>, puede cambiarla una vez que ingrese en la seccion de : 'Perfil/Cambiar clave' " , "SUCCESS");
                }
            }
            $this->load->view('app/v_registerusr.php');
            // pie de pagina
            $this->end_page();
        }
    }

    public function usr_ci_validation()
    {
        $ci_info = $this->input->post('cedula_user');
        if ($this->usr->is_in_database($ci_info))
        {
            echo json_encode(true) ;
        }else 
        {
            echo json_encode(false) ;
        }
    }

    /* Administrar usuarios
    =================================================*/
    public function adminusr()
    {
        if ($this->canload_module(array(3)))
        {
            $ci = $this->input->get('ci' , TRUE);
            $action = $this->input->get('action', TRUE);

            if (isset($ci) && isset($action))
            {
                switch ($action)
                {
                    case "remove" :
                        
                        if ($this->usr->can_remove($ci))
                        {
                            if ($this->usr->remove($ci))
                            {
                                $this->load_alert("Usuario eliminado correctamente" , "SUCCESS");
                            }
                        }else 
                        {
                            $this->load_alert("No se puede eliminar: Debe existir al menos 1 administrador en el sistema" , "DANGER");
                        }
                    break;

                    case "disable" :

                        if ($this->usr->can_remove($ci))
                        {
                            if ($this->usr->change_state($ci , 0)) // 0 Es desabilitado
                            {
                                $this->load_alert("Usuario desabilitado correctamente" , "SUCCESS");
                            }
                        }else 
                        {
                            $this->load_alert("No se puede desabilitar: Debe existir al menos 1 administrador habilitado en el sistema" , "DANGER");    
                        }
                    break;

                    case "enable" :
                        if ($this->usr->change_state($ci , 1)) // 1 estado normal
                        {
                            $this->load_alert("Usuario habilitado correctamente" , "SUCCESS");
                        }
                    break;
                }
            }

            $this->load->view('app/v_adminusr.php');
            // pie de pagina
            $this->end_page();
        }
    }
    // Cambiar privilegio de usuario
    public function changetype()
    {
        if ($this->canload_module(array(3)))
        {
            $ci = $this->input->get('ci');
            if (isset($ci))
            {
                $newt = $this->input->post('newtype');
                if ($newt != "none" && !empty($newt))
                {
                    if($this->usr->can_remove($ci))
                    {
                        if ($this->usr->change_type($ci , $newt))
                        {
                            $this->load_alert("Nivel de privilegio actualizado correctamente" , "SUCCESS");
                        }
                    }else 
                    {
                        $this->load_alert("No se puede cambiar el privilegio: debe existir al menos 1 administrador. " , "DANGER");
                    }
                }
                
                $row_data = $this->usr->get_data($ci);
                if (isset($row_data))
                {
                    $data['nombre_usuario'] = $row_data['nombre'] ; 
                    $data['tipo'] = "" ;

                    switch($row_data['tipo'])
                    {
                        case 1 : 
                            $data['tipo'] = "Participante/Instructor" ; 
                        break;
                        
                        case 2 :
                            $data['tipo'] = "Tecnico" ;
                        break;

                        case 3 : 
                            $data['tipo'] = "Administrador";
                        break; 
                    }

                    $this->load->view('app/v_changeusrtype.php' , $data);
                }else 
                {
                    redirect('user');
                }
            }else 
            {
               redirect('user');
            }
            $this->end_page();
        }
    }

    // obtiene todos los tecnicos y los devuelve en un json
    public function getalltecs()
    {
        $data = $this->usr->get_all();
        echo json_encode($data);
    }

    /* Estadisticas de solicitud de soporte tecnico
    =================================================*/
    public function stats()
    {
        if ($this->canload_module(array(2,3)))
        {
            $tipo_busqueda  = $this->input->post('tipo-busqueda');
            $fecha_inicio = $this->input->post('fechainicio');
            $fecha_fin = $this->input->post('fechafin');
            $sede = $this->input->post('sede');
            $data_arr = array();
            $label_arr = array();
            if (isset( $fecha_inicio , $fecha_fin ) )
            {
                $reports = $this->stats->get_reports($fecha_inicio,$fecha_fin);
                $ids_arr = array();

                for ($i = 0; $i < count($reports) ; $i++)
                {
                    if (!in_array($reports[$i]['id_falla'], $ids_arr))
                    {
                        $current_falla = $this->support->get_falla($reports[$i]['id_falla']);
                        $current_pc = $this->computer->get_pc_info($current_falla->id_equipo);
                        
                        if ($tipo_busqueda == "falla-comun")
                        {
                            $current_tipofalla = $current_falla->tipo;
                            $current_txtfalla = "" ;
                            $current_txtfalla = $this->support->get_categorie_name($current_tipofalla);
                            if (!in_array($current_txtfalla , $label_arr))
                            {
                                $counted = $this->stats->count_reports_category($current_tipofalla , $sede);
                                array_push($data_arr , $counted ) ; 
                                array_push($label_arr , $current_txtfalla);
                            }  

                        }else if ($tipo_busqueda == "equipo-comun")
                        {
                            $current_pcid = $current_falla->id_equipo ; 
                            $current_pc = $this->computer->get_pc_info($current_pcid);
                            $current_lab = $this->laboratory->get_lab($current_pc->id_laboratorio);
                            $computerdesc = $current_lab->descripcion . ' - ' . $current_pc->descripcion;
                            if (!in_array($computerdesc , $label_arr) && $current_lab->id_sede == $sede )
                            {
                                $counted = $this->stats->count_reports_pc($current_pcid , $sede); 
                                array_push($label_arr , $computerdesc);
                                array_push($data_arr , $counted);
                            }
                        }
                        array_push($ids_arr , $reports[$i]['id_falla']);
                    }
                }
            }
            $data['sedes'] = $this->sede->get_all();
            $data['labels'] = $label_arr;
            $data['series'] = $data_arr;
            $this->load->view('app/v_stats.php', $data);
            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Respaldo y restuauracion
    ==========================*/ 

    /* Respaldo de base de datos
    =================================================*/
    public function backupdb()
    {
        if ($this->canload_module(array(3)))
        {
            $this->syshelper->backup_database();
            // pie de pagina
            $this->end_page();
        }
    }

    /* Restauracion de base de datos
    =================================================*/
    public function restoredb()
    {
        if ($this->canload_module(array(3)))
        {
            $sql = $this->input->post('sqlstring');
            if (isset($sql))
            {
                $this->syshelper->restore_database($sql);
                print_r("ok");
            }

            $this->load->view('app/v_restoredb.php');
            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Extras
    ==========================*/ 

    /* Manual de usuario
    =================================================*/
    public function manual()
    {
        if ($this->canload_module(array(1,2,3)))
        {

            // pie de pagina
            $this->end_page();
        }
    }

    /* Creditos
    =================================================*/
    public function credits()
    {
        if ($this->canload_module(array(1,2,3)))
        {
            
            // pie de pagina
            $this->end_page();
        }
    }

    /* Salir
    =================================================*/
    public function logout()
    {
        $this->loginsystem->logout();
    }
}