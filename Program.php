<?php
class Program 
{
        // Conecta a la base de datos
        // Devuelve el enlace Mysql
        public static function Connect()
        {
            $config = include('db_config.php');
            return mysqli_connect($config['host'], $config['username'] , $config['password'] , $config['database']);
        }

        //Login interno segun tabla y base de datos
        public static function LoginInternal($link, $table , $userfield,$passfield , $userdata,$passdata)
        {
            $sql =  "SELECT * FROM " . $table . " WHERE " . $userfield ." = '" . $userdata . "' AND " . $passfield . " = '" . $passdata ."';";
            
            if (!$link)
            {
                header("Location: index.php");
                die();
            }

            $res =  mysqli_query($link, $sql) or trigger_error("SQL ERROR: " . mysqli_error($link) );
            if (mysqli_num_rows($res) <= 0 )
            {            
                return false;
            }else
            {
                    session_start();
                    $_SESSION['ciuser'] = $ci;
                    return true;
            }  
        }

        public static function CheckDataExist ($link,$table , $row , $data ) 
        {
            if (!$link)
            {
                return false;
            }
            $verifydbsql = "SELECT * FROM " . $table . " WHERE " . $row . " = '" . $data . "'" ;
            $result = mysqli_query($link, $verifydbsql) ;
            if (mysqli_num_rows($result) > 0 )
            {
                return true ;
            }else
            {
                return false;
            }
        }

        public static function Redirect($url) 
        {
            if(!headers_sent()) {
            header('Location: '. $url);
            exit;
            } else 
            {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>';
            exit;
            }
        }
        
        public static function LogOut()
        {
            session_destroy();
            Redirect("index.php");
        }
}