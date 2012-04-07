<?php

include('func/func.php');

$ipaddress = $_SERVER["REMOTE_ADDR"];
$netbios = user_netbios();
$mess = $_POST['limitedtextarea'];



if ($netbios == "")
{
$netbios = $ipaddress;
}

notify("info",$netbios,$mess);

?>
<meta http-equiv="refresh" content="0; URL=messagerie.php">