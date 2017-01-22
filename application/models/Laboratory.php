<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                      Modelo de los laboratorios                    ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Inlcuye los metodos correspondientes a los laboratorios.                 |
    |--------------------------------------------------------------------------|
*/

class Laboratory extends CI_Model 
{
     /*  Inicializacion del modelo
    =================================================*/
    function  __construct()
    {
        parent::__construct();
    }

     /* Registra un nuevo laboratorio en la base 
     de datos.  
    =================================================*/
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

     /* Actualiza la informacion de un laboratorio 
     existente en la base de datos
    =================================================*/
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


     /*  Obtiene todos los laboratorios registrados
     en la base de datos
    =================================================== */
    public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` ; ";
        $query = $db->query($sql);
        return $query->result();
    }

     /*  Obtiene un laboratorio segun una sede especifica
    =======================================================*/
    public function find_by_sede($sedeid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` WHERE `id_sede` = '" . $sedeid . "' ;"; 
        $query = $db->query($sql);
        return $query->result();
    }

     /*  Obtiene un laboratorio segun su id
    =================================================*/
    public function get_lab($labid)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `laboratorio` WHERE `id_laboratorio` = '" . $labid  . "' ;"; 
        $query = $db->query($sql);
        return $query->row();
    }

     /*  Elimina un laboratorio especifico de la 
     base de dataos
    =================================================*/
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

     /*  Verifica que un laboratorio exista en la base de datos
    ============================================================*/
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