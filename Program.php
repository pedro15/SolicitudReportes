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

        public static function GetDateFormatter()
        {
            $mDate = getdate();
            $_year = $mDate['year'];
            $_month = $mDate['mon'];
            $_day = $mDate['mday'];
            return $_year . "-" . $_month . "-" . $_day ;
        }

        public static function GetFirstDay()
        {
            $mDate = getdate();
            $_year = $mDate['year'];
            $_month = $mDate['mon'];
            return $_year . "-" . $_month . "-1" ;
        }
        
        // Esta funcion cuenta los repotes de X categoria desde una fecha 'A' hasta una fecha 'B' 
        public static function CountCategoryReports($category , $startdate , $enddate)
        {
            $link = Program::Connect();
            if (!$link)
            {
                Program::LogOut();
            }
            $sql_falla = "SELECT * FROM `falla` WHERE `tipo_falla` = '" . $category . "';" ;
            $res_falla = mysqli_query($link,$sql_falla);
            $validnumbers = array();
            if ($res_falla)
            {
                $count = mysqli_num_rows($res_falla);
                for ( $i = 0 ; $i < $count ; $i ++)
                {
                    $data = mysqli_fetch_assoc($res_falla);
                    if ($data)
                    {
                        array_push($validnumbers , $data['id']);
                    }
                }
            }else
            {
                //print_r(mysqli_error($link));
                return 0;
            }
            sort($validnumbers);
            $sql = "SELECT * FROM `reporte` WHERE `fecha` BETWEEN '" . $startdate . "' AND '". $enddate ."' AND `id_falla` BETWEEN '" . 
            $validnumbers[0] . "' AND '" . $validnumbers[count($validnumbers) - 1] . "';";
            $res = mysqli_query($link,$sql);
            if ($res)
            {
                return mysqli_num_rows($res);
            }else
            {
                //print_r(mysqli_error($link));
                return 0;
            }
        }
}