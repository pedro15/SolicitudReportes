<?php
include_once('Program.php');
// Clase para identificar los reportes de las fallas
class ReportTicket
{
    private $desc; //descripcion
    private $tipo;  //Tipo de falla
    private $numpc; // Numero de pc afectado
    private $ciuser; //Cedula de el usuario que reporto la falla
    private $datereport;  //Fecha que se realizo el repote
    
    private $link;

    public static function GetStates()
    {
        return array
        (
            'alert' => "SIN REPARAR",
            'ok' => "REPARADO",
            'warning' => "NESESITA REVISION"
        );
    }

    public function Register()
    {
        return $this->RegisterTicket() && $this->RegisterReport(); 
    }

    function RegisterTicket()
    {
         $this->link = Program::Connect();
         if (!$this->link)
         {
            Program::LogOut();
         }
         $sql = "INSERT INTO `falla` (`id`, `numero_equipo`, `descripcion`, `tipo_falla`) VALUES ".
         "(NULL,'" . $this->numpc . "','" . $this->desc . "','" . $this->tipo . "');" ;

         if (mysqli_query($this->link,$sql))
         {
             return true ;
         }else
         {
             //print_r(mysqli_error($this->link));
             return false;
         }
    }

    function RegisterReport()
    {
         if (!$this->link)
         {
            Program::LogOut();
         }
         $__id = mysqli_insert_id($this->link);
         $sql = "INSERT INTO `reporte` (`id`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES " . 
         "(NULL,'" . $__id . "','" . $this->ciuser . "','" . $this->datereport . "','" . $this->GetStates()['alert'] . "');" ;
         if(mysqli_query($this->link,$sql))
         {
             return true;
         }else
         {
             //print_r(mysqli_error($this->link));
             return false;
         }
    }

    public function __construct($_descripcion , $_tipo , $_pcnum, $_ci)
    {
        $this->desc = $_descripcion;
        $this->numpc = $_pcnum;
        $this->tipo = $_tipo;
        $this->ciuser = $_ci;
        $this->datereport = Program::GetDateFormatter();
    }
}
?>