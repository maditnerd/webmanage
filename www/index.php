<html>
<head>
<Title>WebManage : Chargement...</Title>
</head>
<body>
<?php
include('func/func.php');

$ip_admin = $_SERVER['REMOTE_ADDR'];
notify("warn","Alerte Securité","Connexion depuis l'adresse IP: ".$ip_admin);
?>
</body>

<meta http-equiv="refresh" content="0; URL=accueil.php">
</html>