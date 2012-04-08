<?php
include('func/class.login.php');
include('func/func.php');

header_show("Reboot en cours...","style");
// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END
title("REBOOT EN COURS VEUILLEZ PATIENTEZ");
script('reboot');
back();

footer();
}
?>
