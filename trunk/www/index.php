<?php
include('func/class.login.php');
include('func/func.php');

header_show("Mot de passe requis","style2");

$computername = script("getcomputername");

title("WebManage sur ".$computername);
echo '<table align=center><td>';
$log = new logmein();
$log->loginform("loginformname", "loginformid", "accueil.php");
echo '</td></table>';
title("Toutes tentatives d'intrusion sera loggué");

footer_show();
?>