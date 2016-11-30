// Expiracion de sesiones
var timer1;
var wait= 1; // Tiempo de Expiracion
document.onkeypress=resetTimer;
document.onmousemove=resetTimer;
function resetTimer()
{
    clearTimeout(timer1);
    timer1=setTimeout(logout, 60000 * wait);
}
function logout()
{
     window.location.href='/include/core/logout.php';
}