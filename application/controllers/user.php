<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class User extends CI_Controller 
{    
    /* Constructor de la clase, se usa para inicializar e importar librerias
    =================================================*/
    function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper('string');
        
        $this->load->model('laboratory');
        $this->load->model('computer');
        $this->load->model('sede');
        $this->load->model('tec');

        $this->load->library('loginsystem');
    }

    /* carga el header, la cabezera , y la barra de navegacion.
    =================================================*/
    function start_page()
    {
        $this->load->view('head.php');
        $this->load->view('letterhead.php');

        $usr_type = $this->loginsystem->getuserdata()['usuario_tipo'];

        switch($usr_type)
        {
            case 1 :
                // barra navegacion usuario

            break;

            case 2 :
                // barra navegacion tecnico

            break;
                
            case 3 :
                 // barra navegacion administrador
                 $this->load->view('nav_admin.php');
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

            // pie de pagina
            $this->end_page();
        }
    }

    /* Administrar solicitudes
    =================================================*/
    public function admintickets()
    {
        if ($this->canload_module(array(2,3))) //3  para probar modulo
        {

            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Sedes
    ==========================*/ 

    /* Agregar sede
    =================================================*/
    public function registersede()
    {
        if ($this->canload_module(array(2,3))) //3  para probar modulo
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
        if ($this->canload_module(array(2,3))) //3  para probar modulo
        {

            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Laboratorios
    ==========================*/ 

    /* Registrar laboratorio
    =================================================*/
    public function registerlab()
    {
        if ($this->canload_module(array(2,3)))
        {

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

            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Equipos
    ==========================*/ 


    /* Registrar equipo ---
    =================================================*/
    public function registerpc()
    {
        if ($this->canload_module(array(2,3)))
        {
            $num_pc = $this->input->post('pc_num');
            $cpu_pc = $this->input->post('pc_cpu');
            $video_pc = $this->input->post('pc_video');
            $ram_pc = $this->input->post('pc_ram');
            $hdd_pc = $this->input->post('pc_hdd');
            $motherboar_pc = $this->input->post('pc_motherboard');
            $fuente_pc = $this->input->post('pc_fuente');
            $id_lab = $this->input->post('lab_id');

            if ( isset($num_pc) && isset($cpu_pc) && isset($video_pc)
            && isset($ram_pc) && isset($hdd_pc) && isset($motherboar_pc) 
            && isset($fuente_pc) && isset($id_lab) && !($id_lab == "Seleccione Sede" || $id_lab == "Seleccionar" ) )
            {
                if ($this->computer->register($num_pc,$cpu_pc,$video_pc,$ram_pc,$hdd_pc,$motherboar_pc,
                $fuente_pc,$id_lab))
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
        if ($this->canload_module(array(2,3)))
        {
            $this->load->view('app/v_adminpc.php');
            // pie de pagina
            $this->end_page();
        }
    }

    /* ========================
    Tecnicos
    ==========================*/ 

    /* Registrar Tecnico
    =================================================*/
    public function registertec()
    {
        if ($this->canload_module(array(2,3)))
        {
            $this->load->view('app/v_registertec.php');
            // pie de pagina
            $this->end_page();
        }
    }

    /* Administrar tecnicos
    =================================================*/
    public function admintec()
    {
        if ($this->canload_module(array(2,3)))
        {
            $canname = $this->input->post('canfiltrername');
            $canci = $this->input->post('canfiltrerci');

            if (isset($canname) && $canname == true )
            {
                
            }
            if (isset($canci) && $canci == true )
            {
                
            }
            
            $this->load->view('app/v_admintec.php');
            // pie de pagina
            $this->end_page();
        }
    }

    public function getalltecs()
    {
        $data = $this->tec->get_all();
        echo json_encode($data);
    }

    /* Estadisticas de solicitud de soporte tecnico
    =================================================*/
    public function stats()
    {
        if ($this->canload_module(array(2,3)))
        {
            
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
        if ($this->canload_module(array(2,3)))
        {
            
            // pie de pagina
            $this->end_page();
        }
    }

    /* Restauracion de base de datos
    =================================================*/
    public function restoredb()
    {
        if ($this->canload_module(array(2,3)))
        {
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
        if ($this->canload_module(array(2,3)))
        {
            
            // pie de pagina
            $this->end_page();
        }
    }

    /* Creditos
    =================================================*/
    public function credits()
    {
        if ($this->canload_module(array(2,3)))
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