<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Sede extends CI_Model
{
    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `sede` ;";
        $query = $db->query($sql);
        $rows = $query->result();
        return $rows;
    }

    public function register($id,$name,$place)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "INSERT INTO `sede` (`id_sede`,`ubicacion`,`nombre`) VALUES('" . $id . "','" . $place . "','" . $name . "');" ; 
        $query = $db->query($sql);
        if ($db->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false;
        }
    }

    public function get_sede($id)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `sede` WHERE `id_sede` = '". $id  ."' ;";
        $query = $db->query($sql);
        return $query->row();
    }

    public function isin_db($id)
    {
        $curr = $this->get_sede($id);
        if(isset($curr)) 
        {
            return true ;
        }else
        {
            return false ;
        }
    }

    public function edit($id , $newname , $newlocation)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "UPDATE `sede` SET `nombre` = '" . $newname . "', `ubicacion` = '" . $newlocation  . "' WHERE `id_sede` = '" . $id . "';" ;
        $db->query($sql);
        if ($db->affected_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false;
        }
    }

    public function delete($id)
    {
        if ($this->isin_db($id))
        {
            $db = $this->load->database('default' , TRUE);
            $sql = "DELETE FROM `sede` WHERE `id_sede` = '" . $id . "';" ; 
            $db->query($sql);
            if ($db->affected_rows() > 0 )
            {
                return true ;
            }else 
            {
                return false;
            }
        }else 
        {
            return false ;
        }
    }
}
?>