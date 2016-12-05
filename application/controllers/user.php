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

    /* Registrar equipo
    =================================================*/
    public function registerpc()
    {
        if ($this->canload_module(array(2,3)))
        {
            
            // pie de pagina
            $this->end_page();
        }
    }

    /* Administrar Equipo
    =================================================*/
    public function adminpc()
    {
        if ($this->canload_module(array(2,3)))
        {
            
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
            
            // pie de pagina
            $this->end_page();
        }
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