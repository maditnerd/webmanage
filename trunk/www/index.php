<Title>WebManage : Chargement...</Title>
<html>
<?php
$ip_admin = $_SERVER['REMOTE_ADDR'];
$WshShell = new COM("WScript.Shell");
$ip_admin = 'cmd /C notifu.exe /t warn /p "Alerte Sécurité" /m "Connexion depuis l\'adresse IP: ' . $ip_admin. '"';
exec($ip_admin);
$WshShell->Run($ip_admin, 0, false);
?>
<meta http-equiv="refresh" content="0; URL=accueil.php">
</html>