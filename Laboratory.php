<?php
    include_once 'Program.php';
    include_once 'RandomStringGenerator.php';
    //Clase Para Identificar los laboratorios
    class Laboratory
    {
        public $descripcion = "";
        public $sede_id = "";
        
        public static function FindByNumber($labnum)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql = "SELECT * FROM `laboratorio` WHERE `id_laboratorio` = '" . $labnum . "';" ;
               $res = mysqli_query($link,$sql);
               return $res;
        }

        public function Register()
        {
            $link = Program::Connect();
            $generator = new  RandomStringGenerator;
            $id = $generator->generate(12);
            $sql = "INSERT INTO `laboratorio` (`id_laboratorio`,`id_sede` , `descripcion`) VALUES ('".  $id  ."','" . $this->sede_id  . "','" . $this->descripcion . "');";
            if (mysqli_query($link,$sql))
            {
                return true ;
            }else 
            {
                return false ;
            }
        }

        public static function GetFromPCNumber($pcnum)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql_pc = "SELECT * FROM `equipo` WHERE `id_equipo` = '" . $pcnum . "';";
               $res_pc = mysqli_query($link, $sql_pc);
               $result = mysqli_fetch_assoc($res_pc);
               $numlab = $result['id_laboratorio'];
               $sql_lab = "SELECT * FROM `laboratorio` WHERE `id_laboratorio` = '" . $numlab . "';" ;
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

        public static function GetFromSede($sedeid)
        {
               $link = Program::Connect();
               if (!$link)
               {
                   Program::LogOut();
               }
               $sql = "SELECT * FROM `laboratorio` WHERE `id_sede` = '" . $sedeid . "';";
               $res = mysqli_query($link,$sql);
               return $res;
        }

        public function __construct($_descripcion , $_sedeid)
        {
            $this->descripcion = $_descripcion;
            $this->sede_id = $_sedeid;
        }
    }
?>