<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

$alert_class = "alert alert-success";

if (isset($a_type))
{
    if ($a_type == "DANGER")
    {
        $alert_class = "alert alert-danger";
    }else if ($a_type == "WARNING")
    {
        $alert_class = "alert alert-warning";
    }else if ($a_type == "INFO")
    {
        $alert_class = "alert alert-info";
    }else if ($a_type == "SUCESS")
    {
        $alert_class = "alert alert-success";
    }
}

?>
<div class = "container">
    <div class = "<?php echo $alert_class ?>">
        <?php 
            if (isset($message))
            {
                echo $message;
            }
        ?>
    </div>
</div>