<html>

<head>
<title>Webmanage : Confirmation</title>
<link rel='stylesheet' type='text/css' href='css/style.css' />

</head>

<?php
include('func/func.php');

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
 

?>