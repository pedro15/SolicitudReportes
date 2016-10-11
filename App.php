<?php
// Modulos del software
// 
    // Conectar a la base de datos
    function Connectdb()
    {
        $config = include('db_config.php');
        // ocultar errores por defecto
        return mysqli_connect($config['host'], $config['username'] , $config['password'] , $config['database']) ;
    }
    // Entrar al sistema
    function login( $ci , $password )
    {
         $link = Connectdb();
         
         $sql =  "SELECT * FROM usuario WHERE cedula = '" . $ci . "' AND clave = '" . $password ."'"; ; 

        if (!$link){
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
    // 
    function redirect_user( $ci )
    {
        $link = Connectdb();
         if (!$link){
            header("Location: index.php");
            die();
        }
        
         $verifydbsql = "SELECT tipo FROM usuario WHERE cedula = '" . $ci . "'" ;
         
         $result = mysqli_query($link, $verifydbsql);
        
         if (mysqli_num_rows($result) > 0 )
         {
                
                 $type = getuserdata($ci, 'tipo');
                 echo $type;
                 switch ($type)
                 {
                     case 0:
                         $_SESSION['message'] = "Usted se encuentra desabilitado en el sistema";
                         closesystem();
                         break;
                     case 1:
                         header("Location: user_normal.php?opc=1");
                         die();
                         break;
                     case 2:
                         header("Location: user_tec.php?opc=1");
                         die();
                         break;
                     case 3:
                         header("Location: user_admin.php?opc=1");
                        die();
                     break;
                 }
         }else{
             closesystem();
         }
    }
    
    function getuserdata($ci , $field)
    {
        $link = Connectdb();
         if (!$link){
             closesystem();
        }
         $verifydbsql = "SELECT * FROM usuario WHERE cedula = '" . $ci . "'" ;
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
    
   
    // registrar usuario
    function register_user ($nombre , $apellido , $cedula , $usuario , $clave)
    {
        $link = Connectdb();
         if (!$link)
         {
             closesystem();
         }
        if ($nombre != "" && $apellido != "" && $cedula != "" && $usuario != "" && $clave != "")
        {
            
            $verifydbsql = "SELECT * FROM usuarios" ;
            
            $result_data = mysqli_query($link, $verifydbsql) ;
            
            if (mysqli_num_rows($result_data) > 0) 
            {
                while ($row = mysqli_fetch_assoc($result_data)){
                    $ci = $row['cedula'];
                    $usern = $row['usuario'];
                    
                    if ($ci == $cedula || $usern == $usuario)
                    {
                        echo 'Este usuario o cedula ya existe';
                        break;
                    }else{
                          
                          $sql = "INSERT INTO usuarios(nombre,apellido,cedula,usuario,clave) VALUES('" . $nombre . "','" .
                          $apellido . "','" . $cedula . "','" . $usuario . "','" . $clave . "')" ;
        
                        if (mysqli_query($link, $sql) )
                        {
                            echo 'Agregado correctamente' ;
                            break;
                        }else{
                            echo 'Error al agregar los datos';
                            break;
                        }
                    }
                    
                }
            }else{
                 $sql = "INSERT INTO usuarios(nombre,apellido,cedula,usuario,clave) VALUES('" . $nombre . "','" .
                        $apellido . "','" . $cedula . "','" . $usuario . "','" . $clave . "')" ;
        
                        if (mysqli_query($link, $sql) )
                        {
                            echo 'Agregado correctamente' ;
                            
                        }else{
                            echo 'Error al agregar los datos';
                        }
            }
        }else{
            echo 'Debe de llenar todos los campos';
        }  
    }

    function LoadMenu( $index )
    {
        switch ($index)
        {
            case 0:
                include 'Report.php';
                break;
            case 1:
                
                break;
            
        }
    }
    
    function logout()
    {
        session_destroy();
        closesystem();
    }
    
    function closesystem()
    {
            header("Location: index.php");
            die();
    }
    
    function displayalert($text)
    {
        echo '<script type = "text/javascript" >alert("' . $text .'");</script>';
    }
    
    function checkdataexist ($table , $row , $data ) 
    {
        $link = Connectdb();
         if (!$link){
             closesystem();
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
    
    function RegisterPC ($labnum , $id , $cpu , $gpu , $ram , $hdd , $power , $motherboard )
    {
         $link = Connectdb();
         if (!$link)
         {
             closesystem();
         }
        
         $verifydbsql = "SELECT * FROM equipo WHERE num_equipo = '" . $id . "' AND num_laboratorio = '" . $labnum . "'" ;
         $result = mysqli_query($link, $verifydbsql) ;
        
        if (mysqli_num_rows($result) <= 0 )
        {
        
         $sql = "INSERT INTO `equipo` (`id` , `num_equipo`, `cpu`, `gpu`, `ram`, `hdd`, `tarjeta_madre`, `fuente_poder`, `num_laboratorio`)" . 
                 "VALUES (NULL,'" . $id ."','" . $cpu ."','" . $gpu . "','" . $ram . "','" . $hdd . "','" . $motherboard . "',' " . $power ." ','" . $labnum . "');" ;
         if (mysqli_query($link, $sql) )
         {
             return true ;
         }else
         {
             return false ;
         }
            
        }else
        {
            return false ;
        }
    }
    
    function RegisterLab($descripcion)
    {
        if (!checkdataexist("laboratorio", "descripcion" , $descripcion) )
        {
        
        $link = Connectdb();
         if (!$link)
         {
             closesystem();
         }
         
         $sql = "INSERT INTO `laboratorio` (`descripcion`) VALUES ('". $descripcion ."');";
         
          if (mysqli_query($link, $sql) )
         {
             return true ;
         }else
         {
             return false ;
         }
        }else
        {
            return false ;
        }
     }