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
            0 => "SIN REPARAR",
            1 => "REPARADO",
            2 => "NESESITA REVISION"
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
         "(NULL,'" . $__id . "','" . $this->ciuser . "','" . $this->datereport . "','" . $this->GetStates()[0] . "');" ;
         if(mysqli_query($this->link,$sql))
         {
             return true;
         }else
         {
             //print_r(mysqli_error($this->link));
             return false;
         }
    }

    public static function ChangeState( $id , $stateid )
    {
        $link = Program::Connect();
        if (!$link)
        {
            Program::LogOut();
        }
        $estados = ReportTicket::GetStates();
        $sql = "UPDATE `reporte` SET `estado` = '" . $estados[$stateid] . "' WHERE `id` = '" .  $id . "' ;" ;
        return mysqli_query($link,$sql);
    }

    public static function DeleteReport( $id )
    {
        $link = Program::Connect();
        if (!$link)
        {
            Program::LogOut();
        }
        $sql_consulta = "SELECT * FROM `reporte` WHERE `id` = '" . $id . "';" ;
        $cont = mysqli_query($link,$sql_consulta);
        $row = mysqli_fetch_assoc($cont);
        
        if ($row)
        {
            if (mysqli_num_rows($cont) > 0)
            {
                 $fallaid = $row['id_falla'];
                 $sqlreporte = "DELETE FROM `reporte` WHERE `id` = '" . $id . "';" ;
                 $sqlfalla = "DELETE FROM `falla` WHERE `id` = '" . $fallaid . "';" ;
                 $result_reporte = mysqli_query($link,$sqlreporte);
                 $result_falla = mysqli_query($link,$sqlfalla);
                 return $result_falla && $result_reporte;
            }
        }
        return false ;
    }

    public static function GetAllReports()
    {
         $link = Program::Connect();
         if (!$link)
         {
             Program::LogOut();
         }
         $sql = "SELECT * FROM `reporte` ;";
         return mysqli_query($link , $sql);
    }

    public static function GetReportInfo($reportid)
    {
         $link = Program::Connect();
         if (!$link)
         {
             Program::LogOut();
         }
         $sql = "SELECT * FROM `falla` WHERE `id` = '" . $reportid . "' ;";
         return mysqli_query($link,$sql);
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