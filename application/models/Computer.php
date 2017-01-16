<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Computer extends CI_Model
{
    public function register($num,$cpu,$video,$ram,$hdd,$motherboard,$fuente,$monitor,$teclado,$mouse,$lector_dvd,$sistema_operativo,$lab_id)
    {
        if (!$this->isindb($lab_id , $num))
        {
            $db = $this->load->database('default' , TRUE);
            $pc_id = $lab_id . "pc_" .$num ;  
            $sql = "INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado` , `mouse` , `lector_dvd`, `sistema_operativo`, `id_laboratorio`)
             VALUES('" . $pc_id . "','" . $num . "','" . $cpu  .  "','" . $video . "','" . $ram . "','" . $hdd . "','" . $motherboard 
             . "','" . $fuente . "','" . $monitor . "','" . $teclado . "','" . $mouse . "','" . $lector_dvd . "','" . $sistema_operativo . "','" .  $lab_id . "');" ; 
             $query = $db->query($sql);
             if ($db->affected_rows() > 0 )
             {
                 return true ;
             }else 
             {
                 return false;
             }
         }else 
         {
             return false;
         }
    }

    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `equipo` ;";
        $query = $db->query($sql);
        return $query->result_array();
    }

    public function getby_lab($lab_id)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `equipo` WHERE `id_laboratorio` = '" . $lab_id . "' ;";
        $query = $db->query($sql);
        return $query->result();    
    }
    
    public function isindb($lab_id , $num)
    {
        $pc_id = $lab_id . "pc_" .$num ; 
        return $this->isindb_byid($pc_id);
    }

    public function isindb_byid($id)
    { 
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $id . "';" ;
        $query = $db->query($sql);
        if ($query->num_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function isindb_ignoring($id , $ignoringid)
    { 
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $id . "' AND `id_equipo` != '" . $ignoringid . "' ;" ;
        $query = $db->query($sql);
        if ($query->num_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function editpc ($pcnum , $lab_id , $newcpu , $newvideo , $newram , $newhdd , $newmotherboard , $newfuente , $newmonitor , $newteclado , $newmouse , $newdvd , $newso , $newlabid , $newnumpc)
    {
        
        if ($this->isindb($lab_id, $pcnum))
        {
            $db = $this->load->database('default' , TRUE);
            $pc_id = $newlabid . "pc_" .$newnumpc ; 

            $sql = "UPDATE `equipo` SET " . 
            "`descripcion` = '" . $newnumpc . "', " .
            "`id_laboratorio` = '" . $newlabid . "', " .
            "`id_equipo` = '" . $newlabid . "pc_" . $newnumpc . "', " .
            "`procesador` = '" . $newcpu . "', " .
            "`tarjeta_grafica` = '" . $newvideo . "', " .
            "`memoria_ram` = '" . $newram . "', " .
            "`disco_duro` = '" . $newhdd . "', " .
            "`tarjeta_madre` = '". $newmotherboard . "', " .
            "`fuente_poder` = '" . $newfuente . "', " .
            "`monitor` = '" . $newmonitor . "', " .
            "`teclado` = '" . $newteclado . "', " .
            "`mouse` = '" . $newmouse . "', " .
            "`lector_dvd` = '" . $newdvd . "', " .
            "`sistema_operativo` = '" . $newso . "' WHERE `id_equipo` = '" . $lab_id . "pc_" . $pcnum. "' ; " ; 
            $query = $db->query($sql);
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

    public function deletepc( $pcnum )
    {
        $db = $this->load->database('default', TRUE);
        $check_sql = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $pcnum . "' ; " ; 
        $check_query = $db->query($check_sql) ;
        $check_row = $check_query->row();
        if (isset($check_row))
        {
            $remove_sql = "DELETE FROM `equipo` WHERE `id_equipo` = '" . $pcnum . "' ;" ; 
            $db->query($remove_sql); 
            if ( $db->affected_rows() > 0 )
            {
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
    
    public function get_pc_info($pcnum)
    {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT * FROM `equipo`  WHERE `id_equipo` = '" . $pcnum . "' ;" ; 
        $query = $db->query($sql);
        return $query->row();
    }
}