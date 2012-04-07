<html>
<head>
<Title>WebManage : Mot de passe requis</Title>
<link rel='stylesheet' type='text/css' href='css/style2.css' />
</head>
<body>
<?php
include('func/func.php');
include('func/class.login.php');

$computername = script("getcomputername");

$ip_admin = $_SERVER['REMOTE_ADDR'];
notify("warn","Alerte Securité","Connexion depuis l'adresse IP: ".$ip_admin);

title("WebManage sur ".$computername);
echo '<table align=center><td>';
$log = new logmein();
$log->loginform("loginformname", "loginformid", "form_action.php");
echo '</td></table>';
title("Une alerte a été envoyé sur la machine");
?>
</body>


</html>