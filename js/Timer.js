// Expiracion de sesiones
var timer1;
var wait= 15; // Tiempo de Expiracion
document.onkeypress=resetTimer;
document.onmousemove=resetTimer;
function resetTimer()
{
    clearTimeout(timer1);
    timer1=setTimeout(logout, 60000 * wait);
}
function logout()
{
     window.location.href='logout.php';
}