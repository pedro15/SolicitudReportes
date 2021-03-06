<?php
    require_once ('core/Program.php');
    require_once ('Laboratory.php');
    // Clase para identificar los equipos
    class Computer
    {
        // Identificadores: 
        private $labnum; // Numero laboratorio
        private $idpc; // Numero de pc
        
        //Caracteristicas:
        private $desc; // descripcion que se muestra al seleccionar equipo en los demas modulos.
        public $cpu ; // CPU ( Procesador )
        public $gpu ; // Tarjeta Grafica
        public $ram; // Memoria RAM
        public $hdd ; // Disco Duro
        public $power ; // Fuente de poder
        public $motherboard; //Tarjeta Madre
        // Funcion para determinar si el equipo se encuentra agregado a la base de datos o no
        
        public function isOnDatabase()
        {
            $link = Program::Connect();
            if (!$link)
            {
                return false;
            }
            return Program::CheckDataExist($link,"equipo" , "id_equipo" , $this->idpc);
        }

        public static function GetFromLab($lab)
        {
              $link = Program::Connect();
              if (!$link)
              {
                  Program::LogOut();
              }
              $sql = "SELECT * FROM `equipo` WHERE `id_laboratorio` = '" . $lab . "';";
              $res = mysqli_query($link,$sql);
              return $res;
        }

        public static function GetAll()
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               
               $sql = "SELECT * FROM `equipo`;";
               $res = mysqli_query($link,$sql);
               return $res;
        }

        public static function GetFromNumber($number)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $number . "';";
               return mysqli_query($link,$sql);
        }

        // Registra el equipo en la base de datos
        public function Register()
        {
            if ($this->isOnDatabase() == false)
            {     
                 $link = Program::Connect();
                 if (!$link)
                 {
                     return false;
                 }
                 $sql = "INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `id_laboratorio`)" . 
                 "VALUES ('". $this->idpc . "','" . $this->desc ."','" . $this->cpu ."','" . $this->gpu . "','" . $this->ram . "','" . $this->hdd . "','" . $this->motherboard . "',' " . $this->power ." ','" . $this->labnum . "');" ;
                 if (mysqli_query($link,$sql))
                 {
                     return true;
                 }else
                 {
                     $_SESSION['UserAlert'] = "Error al agregar los datos: " . 
                     mysqli_error($link);
                     return false;
                 }
            }else
            {
                $_SESSION['UserAlert'] = "Este equipo ya se encuentra registrado";
                return false;
            }
        }
        // Constructor
        public function __construct($_idpc  , $_cpu ,
        $_gpu , $_ram , $_hdd , $_power , $_motherboard , $_labnum )
        {
            $this->labnum = $_labnum;
            $this->idpc = $_idpc . '-' . $_labnum ;
            $this->desc = $_idpc;
            $this->cpu = $_cpu;
            $this->gpu = $_gpu;
            $this->ram = $_ram;
            $this->hdd = $_hdd;
            $this->power = $_power;
            $this->motherboard = $_motherboard;
        }
    }
?>