<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');
?>
<script type = "text/javascript" >
// Tiempo de Expiracion en minutos:
var wait=   1  ;
// ----
function resetTimer(){timer=window.setTimeout(logout,6e4*wait)}function logout(){var a='<?php echo base_url("index.php/user/logout"); ?>';window.location.href=a}var timer;$(document).ready(function(){resetTimer()}),$(document).keypress(function(){resetTimer()}),$(document).mousemove(function(){resetTimer()});
</script>