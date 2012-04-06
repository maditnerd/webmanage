<html>
<Title>WebManage : Chargement...</Title>
<?php
include('func/func.php');

$ip_admin = $_SERVER['REMOTE_ADDR'];
notify("warn","Alerte Securité","Connexion depuis l'adresse IP: ".$ip_admin);
?>


<meta http-equiv="refresh" content="0; URL=accueil.php">
</html>