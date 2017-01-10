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
            if ($line[0] && $line[0] != "#") // ERROR:  Uninitialized string offset: 0
            {
                $sqlclean .= $line . "\n" ; 
            }
        }

        $sqlclean .= "SET FOREIGN_KEY_CHECKS=1;\n" ; 

        foreach (explode(";\n" , $sqlclean ) as $sql ) 
        {
            $sql = tirm($sql); // ERROR: Call to undefined function tirm() 
            if ($sql)
            {
                $this->db->query($sql);
            }
        }
        return true ;
    }

    public function clear_tables()
    {
        $drop_usuarios = "DELETE  FROM `usuario` ; " ; 
        $drop_sedes = "DELETE  FROM `sede` ; " ; 
        $this->db->query($drop_usuarios); 
        $this->db->query($drop_sedes); 
    }
} 

?>