<?php
    include_once 'Program.php';
    //Clase Para Identificar los laboratorios
    class Laboratory
    {
        public $descripcion = "";
        
        public function isOnDatabase()
        {
            $Link = Program::Connect();
            return Program::CheckDataExist($Link,"laboratorio" , "descripcion", $this->descripcion );
        }

        public static function FindByNumber($labnum)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql = "SELECT * FROM `laboratorio` WHERE `numero` = " . $labnum . ";" ;
               $res = mysqli_query($link,$sql);
               return $res;
        }

        public function Register()
        {
            if ($this->isOnDatabase() == false)
            {
                $link = Program::Connect();
                $sql = "INSERT INTO `laboratorio` (`descripcion`) VALUES ('". $this->descripcion ."');";
                if (mysqli_query($link,$sql))
                {
                    return true ;
                }else 
                {
                    return false ;
                }
            }else
            {
                $_SESSION['UserAlert'] = "<strong>No se puede registrar:</strong> este laboratorio ya se encuentra registrado";
            }
        }

        public static function GetFromPCNumber($pcnum)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql_pc = "SELECT * FROM `equipo` WHERE `num_equipo` = '" . $pcnum . "';";
               $res_pc = mysqli_query($link, $sql_pc);
               $result = mysqli_fetch_assoc($res_pc);
               $numlab = $result['num_laboratorio'];
               $sql_lab = "SELECT * FROM `laboratorio` WHERE `numero` = '" . $numlab . "';" ;
               return mysqli_query($link,$sql_lab);
        }

        public static function GetAll()
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               
               $sql = "SELECT * FROM `laboratorio`;";
               $res = mysqli_query($link,$sql);
               return $res;
        }

        public function __construct($_descripcion)
        {
            $this->descripcion = $_descripcion;
        }
    }
?>