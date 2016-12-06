<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
class Laboratory extends CI_Model 
{
    public function register($idsede , $desc)
    {
        $db = $this->load->database('default' , TRUE);
        $labid  = "";
        $sql = "INSERT INTO `laboratorio` (`id_laboratorio`,`id_sede`,`descripcion`) VALUES('" . $labid . "','" . $idsede . "','" . $desc . "');";
        $query = $db->query($sql);
        if ($query->affected_rows() > 0 )
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

}
?>