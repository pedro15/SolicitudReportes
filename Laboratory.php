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
            }
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