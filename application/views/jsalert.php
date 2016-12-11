<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

if (isset($msg))
{
?>

<script type = "text/javascript">
    alert("<?php echo $msg; ?>");    
</script>

<?php 
}
?>