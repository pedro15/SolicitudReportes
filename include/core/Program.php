<?php
class Program 
{
        // Conecta a la base de datos interna
        public static function Connect()
        {
            $config = array();
            if (stream_resolve_include_path("../db_config.php") != false)
            {
                 $config = require('../db_config.php');
            }else 
            {
                 $config = require('/db_config.php');
            }
            $host = $config['host'];
            $user = $config['username'];
            $pass = $config['password'];
            $db = $config['database'];
            return mysqli_connect($host, $user , $pass , $db);
        }
        // Conecta a la base de datos externa
        public static function ConnectExtern()
        {
            $config = array();
            if (stream_resolve_include_path("../db_config.php") != false)
            {
                 $config = require('../db_config.php');
            }else 
            {
                 $config = require('/db_config.php');
            }
            $host = $config['host'];
            $user = $config['username'];
            $pass = $config['password'];
            $db = $config['Parent_database'];
            return mysqli_connect($host, $user , $pass , $db);
        }

        //Login segun tabla y base de datos
        public static function Login($link, $table , $userfield,$passfield , $userdata,$passdata)
        {
            $sql =  "SELECT * FROM " . $table . " WHERE " . $userfield ." = '" . $userdata . "' AND " . $passfield . " = '" . $passdata ."';";
            
            if (!$link)
            {
                Program::LogOut();
            }

            $res =  mysqli_query($link, $sql) or trigger_error("SQL ERROR: " . mysqli_error($link) );
            if (mysqli_num_rows($res) <= 0 )
            {            
                return false;
            }else
            {
                if (session_status() == PHP_SESSION_NONE) 
                {
                    session_start();
                }
                return true;
            }  
        }

        // Inicia sesion en el sistema con la base de datos interna

        public static function LoginInternal($ci , $password)
        {
            $link = Program::Connect();
            return Program::Login($link, "usuario" , "cedula_usuario" , "clave" , $ci , $password);
        }

        // Verifica si existe informacion 

        public static function CheckDataExist ($link,$table , $row , $data ) 
        {
            if (!$link)
            {
                return false;
            }
            $verifydbsql = "SELECT * FROM `" . $table . "` WHERE `" . $row . "` = '" . $data . "'" ;
            $result = mysqli_query($link, $verifydbsql) ;
            if (mysqli_num_rows($result) > 0 )
            {
                return true ;
            }else
            {
                return false;
            }
        }

        // Redirecciona a otra pagina

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
        
        // Sale de el sistema

        public static function LogOut()
        {
            session_destroy();
            Program::Redirect("index.php");
        }

        // obtiene la fecha actual

        public static function GetDateFormatter()
        {
            $mDate = getdate();
            $_year = $mDate['year'];
            $_month = $mDate['mon'];
            $_day = $mDate['mday'];
            return $_year . "-" . $_month . "-" . $_day ;
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
            if (count($validnumbers) > 0 )
            {
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
            }else
            {
                return 0;
            }
        }

        //Esta funcion obtiene la de la pagina actual
        public static function GetCurrentURL()
        {
            $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            $currentURL .= $_SERVER["SERVER_NAME"];

            if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
            {
                $currentURL .= ":".$_SERVER["SERVER_PORT"];
            } 

            $currentURL .= $_SERVER["REQUEST_URI"];
            return $currentURL;
        }
        
        // Esta funcion remueve un parametro GET de la url 
        public static function RemoveGetParam($url , $param)
        {
            $parts = parse_url($url);
            $queryparams = array();
            parse_str($parts['query'],$queryparams);
            unset($queryparams[$param]);
            $querystring = http_build_query($queryparams);
            return  $parts['path'] . '?' . $querystring;
        }


    //Obtiene infomacion de el usuario actual
    public static function Getuserdata($ci , $field)
    {
         $link = Program::Connect();
         $verifydbsql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "'" ;
         $result = mysqli_query($link, $verifydbsql) ;
         
         if (mysqli_num_rows($result) > 0 )
         {
            while ( $row_ = mysqli_fetch_assoc($result) )
            {
                return $row_[$field];
            }
         }else
         {
             return null ;
         }
    }



    // Redirecciona a un usuario segun su nivel de acceso

    public static function Redirect_user( $ci )
    {
         $link = Program::Connect();
         if (!$link)
         {
            
         }

         $verifydbsql = "SELECT `tipo` FROM `usuario` WHERE `cedula_usuario`  = '" . $ci . "'" ;
         $result = mysqli_query($link, $verifydbsql);
         if (mysqli_num_rows($result) > 0 )
         {
                
                 $type = Program::Getuserdata($ci, 'tipo');
                 switch ($type)
                 {
                     case 0:
                         $_SESSION['message'] = "Usted se encuentra desabilitado en el sistema";
                         Program::LogOut();
                         break;
                     case 1:
                         Program::Redirect("user_normal.php?opc=1");
                         break;
                     case 2:
                         Program::Redirect("user_tec.php?opc=1");
                         break;
                     case 3:
                         Program::Redirect("user_admin.php?opc=1");
                     break;
                 }
         }
    }
    // Imprime un mensaje de bienvenida al usuario actual
    public static function  WriteName()
    {
        if (isset( $_SESSION['ciuser'] ))
        {
            $ci = $_SESSION['ciuser'];
            $name = Program::Getuserdata($ci, 'nombre');
            echo 'Bienvenido, ' . $name;
        }else
        {
            Program::LogOut();
        }
    }
}