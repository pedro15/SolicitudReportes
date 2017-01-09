<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Stats extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_reports($fecha_inicio , $fecha_fin)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `reporte` WHERE `reporte`.`fecha` BETWEEN '" . $fecha_inicio ."' AND '" .  $fecha_fin . "' ; " ;
        $query = $db->query($sql);
        return $query->result_array();
    }

    public function count_reports_pc($pcid , $sedeid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `falla` WHERE `id_equipo` = '" . $pcid . "' ;";
        $query = $db->query($sql);
        $result = $query->result_array(); 
        $cleanarr = array();
        foreach ( $result as $current )
        {
            $current_pc = $this->computer->get_pc_info($current['id_equipo']);
            $lab = $this->laboratory->get_lab($current_pc->id_laboratorio);
            if ($lab->id_sede == $sedeid)
            {
                array_push($cleanarr , $current);
            }
        }
        return count($cleanarr);
    }

    public function count_reports_category($categorynum , $sedeid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `falla` WHERE `tipo` = '" . $categorynum . "' ;" ;
        $query = $db->query($sql) ; 
        $result = $query->result_array();
        $cleanarr = array() ; 
        foreach ( $result as $current )
        {
            $current_pc = $this->computer->get_pc_info($current['id_equipo']);
            $lab = $this->laboratory->get_lab($current_pc->id_laboratorio);
            if ($lab->id_sede == $sedeid)
            {
                array_push($cleanarr , $current);
            }
        }
        return count($cleanarr);
    }
}