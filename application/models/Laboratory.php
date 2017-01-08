<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
class Laboratory extends CI_Model 
{
    function  __construct()
    {
        parent::__construct();
    }

    public function register($idsede , $desc)
    {
        $db = $this->load->database('default' , TRUE);
        $labid  = random_string('alnum', 18);
        $sql = "INSERT INTO `laboratorio` (`id_laboratorio`,`id_sede`,`descripcion`) VALUES('" . $labid . "','" . $idsede . "','" . $desc . "');";
        $db->query($sql);
        if ($db->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function edit($id , $desc)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "UPDATE `laboratorio` SET `descripcion` = '". $desc . "' WHERE `id_laboratorio` = '" . $id . "' ;" ; 
        $db->query($sql);
        if ($db->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` ; ";
        $query = $db->query($sql);
        return $query->result();
    }

    public function find_by_sede($sedeid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` WHERE `id_sede` = '" . $sedeid . "' ;"; 
        $query = $db->query($sql);
        return $query->result();
    }

    public function get_lab($labid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` WHERE `id_laboratorio` = '" . $labid  . "' ;"; 
        $query = $db->query($sql);
        return $query->row();
    }

    public function remove($labid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "DELETE FROM `laboratorio` WHERE `id_laboratorio` = '" . $labid . "' ;" ; 
        $db->query($sql);
        if ($db->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function isin_db($labid)
    {
        $curr = $this->get_lab($labid);
        if (isset($curr))
        {
            return true ;
        }else 
        {
            return false ; 
        }
    }
}
?>