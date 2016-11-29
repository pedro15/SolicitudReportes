
<?php
    require_once('../include/Laboratory.php');
    if (isset($_GET['sede']))
    {
        $lab = Laboratory::GetFromSede($_GET['sede']);
        if (mysqli_num_rows($lab) > 0 )
        {
            while ($row = mysqli_fetch_assoc($lab))
            {
                $data = '<option value=' . $row['id_laboratorio'] . '>' . $row['descripcion'] . '</option>' ; 
                echo $data;
            }
        }else 
        {
            echo '<option>Seleccionar</option>';
        }
    }
?>