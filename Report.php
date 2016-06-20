    <form method="POST" action="#" onsubmit="" name="formreport" >
        <label>Laboratorio: </label>
        <?php
            $sql = "SELECT * FROM laboratorio" ;
            $result = mysqli_query(Connectdb(), $sql);
            if ($result && mysqli_num_rows($result) > 0 )
            {
        ?>
        <select name="labsfields" id="lab" >
                <?php
                        while ($row = mysqli_fetch_assoc($result))
                        {
                             echo '<option value= "' . $row['numero'] .'" >' . $row['numero'] . '</option>'   ;
                        }
                ?>
        </select>
        <?php  
            }else
            {
                echo '<p>No se encuentran laboratorios</p>' ;
            }
        ?>
        
        <p style="font-size: 72pt; text-align: center" >EN CONSTRUCCION</p>
       
    </form>