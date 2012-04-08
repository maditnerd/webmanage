<?php

include('func/class.login.php');
include('func/func.php');

header_show("Accueil","style");

#CHECK LOGIN
if (isset($_POST['password']) AND isset($_POST['username']))
{
$log = new logmein();
$log->encrypt = true; //set encryption
if($_REQUEST['action'] == "login"){
    if($log->login("logon", $_REQUEST['username'], $_REQUEST['password']) == true){
	
    }
	else{
		$ip_admin = $_SERVER['REMOTE_ADDR'];
		notify("error","Alerte Securité","Mot de passe refusée depuis l'adresse IP: ".$ip_admin);
        title('<font color="#990000">Mot de passe incorrecte!</font>');
		echo '<meta http-equiv="refresh" content="4; URL=index.php">';
    }
}
}
#CHECK LOGIN

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END

$computername = script("getcomputername");
$windowsver = script("windows");
$windowsver = dosencode($windowsver);

// INTERFACE
echo '<form name="accform" action="confirm_computername.php" onsubmit="return validateForm()" method="post">';

// INFORMATIONS GENERALES
echo "<table align=center>";
menu_img("logout","logout","Se déconnecter");
title('<td><INPUT type="text" value="'.$computername.'" name="computername"></td>');
menu_img("shutdown","shutdown","Arrêter WebManage");
echo '</table>';
text($windowsver);

// CONFIGURATION	  
 title('Configuration');

echo'<table align=center>';
	menu("reseau","network","Configuration Réseau");
	menu_popup("chat","messagerie","Messagerie");
	menu("lan","scan_net","Voisinage réseau");
	menu("dos","dos","Invite de commande");
echo'</table>';

title('Administration');
echo'<table align=center>';
	menu("admin","admin","Utilisateurs");
echo'</table>';

submit();

echo '</form>';

footer_show();

echo '<SCRIPT LANGUAGE="Javascript" SRC="js/accueil.js"> </SCRIPT>';
}
?>