<?php 
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                      Modelo del sistema                            ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Incluye todos los metodos correspondientes a respaldo,restauracion de    |
    | base de datos.                                                           |
    |--------------------------------------------------------------------------|
*/

class Syshelper extends CI_Model
{
    private $dbutility;
    private $db;

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default' , TRUE) ;
        $this->dbutility = $this->load->dbutil($this->db , TRUE);
        $this->load->library('encryption');
        $this->load->helper('file');
        $this->encryption->initialize(
        array('cipher' => 'aes-256'));
    }

    public function install_database()
    {
        $url = base_url('resources/database.sql');
        $sql_script = file_get_contents( $url , FILE_USE_INCLUDE_PATH);
        return $this->restore_database($sql_script);
    }

    public function restore_from_backup($backupid)
    {
        $backups = $this->get_backups_file_list();
        $backups_count = count($backups);
        if (isset($backups) && $backups_count > 0 )
        {
            if ($backupid < $backups_count)
            {
                $url = base_url('backups/' . $backups[$backupid] );
                $sql_script = file_get_contents($url , FILE_USE_INCLUDE_PATH);
                return $this->restore_database($sql_script);
            }else 
            {
                return false ; 
            }
        }else 
        {
            return false ;
        }
    }

    public function delete_backup($backupid)
    {
        $backups = $this->get_backups_file_list();
        $backups_count = count($backups);
        if (isset($backups) && $backups_count > 0 )
        {
            if ($backupid < $backups_count)
            {
                 $p = './backups/'  . $backups[$backupid] ;
                 return unlink($p);
            }else 
            {
                return false ; 
            }
        }else 
        {
            return false ;
        }
    }

    public function database_valid()
    {
        $tabla_equipo = $this->db->table_exists('equipo');
        $tabla_falla = $this->db->table_exists('falla');
        $tabla_laboratorio = $this->db->table_exists('laboratorio');
        $tabla_reporte = $this->db->table_exists('reporte');
        $tabla_sede = $this->db->table_exists('sede');
        $tabla_usuario = $this->db->table_exists('usuario');

        return $tabla_equipo && 
        $tabla_falla && 
        $tabla_laboratorio && 
        $tabla_reporte && 
        $tabla_sede && 
        $tabla_usuario ; 
    }

    public function get_backups_file_list()
    {
        $allfiles = scandir('./backups/');
        $backups = array();
        foreach ($allfiles as $file)
        {
            $parts = explode('.' , $file );
            $p_lenght = count($parts);
            $elm = $parts[$p_lenght - 1] ; 
            if ($elm == 'sql' )
            {
                array_push($backups , $file);
            }
        }
        return $backups;
    }

    public function backup_database()
    {
        $fecha = date("Y-m-d.G-i-s");
        $filename = 'respaldo-' . $fecha . '.sql'; 
        $prefs = array
        (
            'format'        => 'txt',        
            'filename'      => $filename ,   
            'add_drop'      => TRUE,         
            'add_insert'    => TRUE,
            'foreign_key_checks' => FALSE ,         
            'newline'       => "\n"          
        );
        $backup = $this->dbutility->backup($prefs);
        $p = './backups/'  . $filename ;
        return  write_file( $p  , $backup );
    }

    public function restore_database($backup)
    {
        $this->clear_tables();

        $sqlclean = "" ;

        foreach ( explode("\n" , $backup) as $line  )
        {
            if (!empty($line) && ($line[0] != "#" && $line[0] != "-" ) )
            {
                $sqlclean .= $line . "\n" ; 
            }
        }

        $arrstr = explode(";" , $sqlclean ) ; 

        foreach ( $arrstr as $sql ) 
        {
            $sql = rtrim($sql); 
            if (!empty($sql))
            {
                 $launchsql = $sql . ";" ;  
                 $this->db->query($launchsql);
            }
        }
        return true ;
    }

    public function clear_tables()
    {
        if ($this->database_valid())
        {
            $drop_usuarios = "DELETE  FROM `usuario` ; " ; 
            $drop_sedes = "DELETE  FROM `sede` ; " ; 
            $this->db->query($drop_usuarios); 
            $this->db->query($drop_sedes); 
        }
    }
} 
?>