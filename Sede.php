<?php
    require_once('Program.php');
    require_once('RandomStringGenerator.php');
    class Sede
    {
        private $id;
        private $ubicacion;
        private $nombre;

        public static function GetAll()
        {
            $link = Program::Connect();
            if (!$link)
            {
                Program::LogOut();
            }
            $sql = "SELECT * FROM `sede` ;" ;
            return mysqli_query($link , $sql);
        }

        public static function GetFromid($sedeid)
        {
            $link = Program::Connect();
            if (!$link)
            {
                Program::LogOut();
            }
             $sql = "SELECT * FROM `sede` WHERE `id_sede` = '" . $sedeid . "';" ;
            return mysqli_query($link , $sql);
        }

        public function IsOnDatabase()
        {
            $link = Program::Connect();
            if (!$link)
            {
                Program::LogOut();
            }
            $sql = "SELECT * FROM `sede` WHERE `id_sede` = '" . $id . "';" ;

            $result = mysqli_query($link,$sql);

            if (mysqli_num_rows($result) > 0 )
            {
                return true ;
            }else 
            {
                return false;
            }
        }

        public function Register()
        {

            $link = Program::Connect();
            if (!$link)
            {
                Program::Connect();
            }
            $gen = new RandomStringGenerator;
            $id_sede = $gen->generate(12);
            $_ubicacion = $this->ubicacion;
            $_nombre = $this->nombre;
            $sql = "INSERT INTO `sede` (`id_sede`,`ubicacion`,`nombre`) VALUES ('" . $id_sede . "','" . $_ubicacion . "','" . $_nombre . "');";
            if (mysqli_query($link,$sql) === TRUE)
            {
                return true;
            }else{ return false; }
        }

        public function __construct($id , $ubicacion , $nombre)
        {
            $this->id = $id;
            $this->$ubicacion = $ubicacion;
            $this->nombre = $nombre;
        }
    }
?>