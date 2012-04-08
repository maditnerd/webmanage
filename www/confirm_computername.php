<?php
include('func/class.login.php');
include('func/func.php');

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END

header_show("Confirmation","style");

$arg1 = $_POST['computername'];
$arg2 = $_POST['oldcompname'];

notify("info","Informations","L'administrateur réseau requiert votre attention");

$modcn = script(computername);
$modcn = dosencode($modcn);

if ($modcn=="OK") {
title("Action acceptée");
$rep = exec('c:\windows\system32\cscript.exe ./vbs/changecn.vbs '.$arg1);
if ($rep==1) {
text("Le changement de nom a échoué");
back();
}
if ($rep==0) {
text("Le changement de nom est un succés!");
menu("reboot","reboot","Rebooter");
back();
}
}
else
{
title("Action refusée");
if ($modcn=="")
{
$modcn = "Aucune";
}
text("Raison invoqué : ".$modcn);
back();
}

footer_show();
}

?>