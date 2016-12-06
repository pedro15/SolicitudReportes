<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Computer extends CI_Model
{
    public function register($num,$cpu,$video,$ram,$hdd,$motherboard,$fuente,$lab_id)
    {
        if (!$this->isindb($lab_id , $num))
        {
            $db = $this->load->database('default' , TRUE);
            $pc_id = $lab_id . "pc_" .$num ;  
            $sql = "INSERT INTO `equipo`(`id_equipo`,`descripcion`,`procesador`,`tarjeta_grafica`,`memoria_ram`,`disco_duro`,`tarjeta_madre`,`fuente_poder`,
            `id_laboratorio`) VALUES('" . $pc_id . "','" . $num . "','" . $cpu  .  "','" . $video . "','" . $ram . "','" . $hdd . "','" . $motherboard 
             . "','" . $fuente . "','" . $lab_id . "');" ; 
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
    
    public function isindb($lab_id , $num)
    {
        $pc_id = $lab_id . "pc_" .$num ;  
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $pc_id . "';" ;
        $query = $db->query($sql);
        if ($query->num_rows() > 0 )
        {
            return true ;
        }else 
        {
            return false ;
        }
    }

    public function editpc ($pcnum , $lab_id , $newcpu , $newvideo , $newram , $newhdd , $newmotherboard , $newfuente , $newlabid , $newnumpc)
    {
        
        if ($this->isindb($lab_id, $pcnum))
        {
            $db = $this->load->database('default' , TRUE);
            $pc_id = $newlabid . "pc_" .$newnumpc ; 

            $sql = "UPDATE `equipo` SET `procesador` = '" . $newcpu . "', `tarjeta_grafica` = '" . $newvideo . "', `memoria_ram` = '" .  $newram . "', `disco_duro` = '" . 
            $newhdd . "', `tarjeta_madre` = '" . $newmotherboard . "', `fuente_poder` = ' " . $newfuente . "', `id_laboratorio` = '" . $newlabid . "', `id_equipo` = '" . $pc_id . "' 
            WHERE `id_equipo` = '" . $pcnum . "' ;" ; 

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

}