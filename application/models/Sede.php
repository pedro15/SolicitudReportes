<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

/* 
    ----------------------------------------------------------------------------
    |***                      Modelo de las sedes                           ***|
    ----------------------------------------------------------------------------
    |                                                                          |
    |                                                                          |
    | Inlcuye los metodos correspondientes a las sedes.                        |
    |--------------------------------------------------------------------------|
*/

class Sede extends CI_Model
{

   /* Inicializacion del modelo
  =================================================*/
  function  __construct()
  {
      parent::__construct();
  }

   /* Obtiene todas las sedes almacenadas en la base de datos
  ===========================================================*/
  public function get_all()
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `sede` ;";
        $query = $db->query($sql);
        $rows = $query->result();
        return $rows;
    }

     /* Registra una nueva sede en la base de datos
    =================================================*/
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

     /* Inicializacion del modelo
    =================================================*/
    public function get_sede($id)
    {
        $db = $this->load->database('default' , TRUE);
        $sql = "SELECT * FROM `sede` WHERE `id_sede` = '". $id  ."' ;";
        $query = $db->query($sql);
        return $query->row();
    }

     /* Verifica que una sede se encuentre registrada 
     en la base de datos
    =================================================*/
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

     /* Actualiza la informacion de una sede en la base de datos
    =============================================================*/
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

     /* Elimina una sede de la base de datos
    =================================================*/
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