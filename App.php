<?php
// Modulos del software
// 
    // Conectar a la base de datos
    function Connectdb()
    {
        $config = include('db_config.php');
        error_reporting(0); // ocultar errores por defecto
        return mysqli_connect($config['host'], $config['username'] , $config['password'] , $config['database']) ;
    }
    
    // Entrar al sistema
    function login( $username , $password )
    {
         $link = Connectdb();
         
         $sql =  "SELECT * FROM usuarios WHERE usuario = '" . $username . "' AND clave = '" . $password ."'"; ; 

        if (!$link){
            die("Error al conectar a la base de datos") ;
        }
       
        $res =  mysqli_query($link, $sql) or trigger_error("SQL ERROR: " . mysqli_error($link) );
        
        if (mysqli_num_rows($res) <= 0 )
        {
            echo '<script>'
                 . 'alert(" Datos incorrectos");'
                    . 'window.location.href = "index.html"; </script>';
           
        }else
        {
            while ( $row = mysqli_fetch_assoc($res) )
            {
                echo '<p>Bienvenido: ' . $row['nombre'] . " " . $row['apellido'] . "</p> <p>ci: " . $row['cedula'] . '</p>' ;
            }
        } 
    }
    
    function register_user ($nombre , $apellido , $cedula , $usuario , $clave)
    {
        $link = Connectdb();
        if (!$link)
        {
            die("Error al conectar a la base de datos");
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
?>
