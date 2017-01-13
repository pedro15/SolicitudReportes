<?php 
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Syshelper extends CI_Model
{
    private $dbutility;
    private $db;

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default' , TRUE) ;
        $this->dbutility = $this->load->dbutil($this->db , TRUE);
        $this->load->helper('download');
    }

    public function install_database()
    {
        $url = base_url('database/database.sql');
        $sql_script = file_get_contents( $url , FILE_USE_INCLUDE_PATH);
        return $this->restore_database($sql_script);
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

    public function backup_database()
    {
        $fecha = date("Y-m-d.g.i.s");
    
        $filename = 'respaldo-' . $fecha . '.sql'; 
        $prefs = array
        (
            'format'        => 'txt',        // gzip, zip, txt
            'filename'      => $filename ,   // File name
            'add_drop'      => TRUE,         // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,         // Whether to add INSERT data to backup file
            'newline'       => "\n"          // Newline character used in backup file
        );
        $backup = $this->dbutility->backup($prefs);
        force_download( $filename , $backup);
    }

    public function restore_database($backup)
    {
        $this->clear_tables();

        $sqlclean = "SET FOREIGN_KEY_CHECKS=0;" ;

        foreach ( explode("\n" , $backup) as $line  )
        {
            if (!empty($line) && ($line[0] != "#" && $line[0] != "-" ) )
            {
                $sqlclean .= $line . "\n" ; 
            }
        }
        
        $sqlclean .= "SET FOREIGN_KEY_CHECKS=1;\n" ; 

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

    function encode_security_answer($plaintext)
    {
        $p_arr =  explode(" " , $plaintext);
        $p_final  = "" ; 
        $maxelm = count($p_arr);
        foreach ( $p_arr as $key => $element )
        {
            $p_final .= $p_arr[$key] ;
            if ($key + 1 < $maxelm)
            {
                $p_final .= '*' ;
            }
        }
    }

    function verify_security_answer( $question , $answer )
    {
        $encoded_q = $this->encode_security_answer($question); 
        $encoded_a = $this->encode_security_answer($answer);
        if ($encoded_q === $encoded_a)
        {
            return true ; 
        }else 
        {
            return false ; 
        }
    }

} 
?>