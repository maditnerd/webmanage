<?php
include('func/class.login.php');
include('func/func.php');

//BAN NUMBER
$ban_number = 3;

$ip_admin = $_SERVER['REMOTE_ADDR'];
$log = new logmein();
$fail2ban = $log->fail2ban($ip_admin);

if ($fail2ban >= 3)

{
echo '<br><p align=center><img src="/img/fake.png">';
}
else
{

$log = new logmein();
$log->update_log("in",$ip_admin);



#CHECK LOGIN
if (isset($_POST['password']) AND isset($_POST['username']))
{
$log = new logmein();
$log->encrypt = true; //set encryption
if($_REQUEST['action'] == "login"){
    if($log->login("logon", $_REQUEST['username'], $_REQUEST['password']) == true){
	$log = new logmein();
	$log->update_log("OK",$ip_admin);
	echo '<meta http-equiv="refresh" content="0; URL=accueil.php">';

    }
	else{
		$log = new logmein();
		$log->update_log("FAIL",$ip_admin);
		notify("error","Alerte Securité","Mot de passe refusée depuis l'adresse IP: ".$ip_admin);
        title('<font color="#990000">Mot de passe incorrecte!</font>');
		echo '<meta http-equiv="refresh" content="4; URL=index.php">';
    }
}
}
#CHECK LOGIN

header_show("Mot de passe requis","style2");

$computername = script("getcomputername");

title("WebManage sur ".$computername);
echo '<table align=center><td>';
$log = new logmein();
$log->loginform("loginformname", "loginformid", "index.php");
echo '</td></table>';
title("Toutes tentatives d'intrusion sera loggué");

footer_show();
}
?>