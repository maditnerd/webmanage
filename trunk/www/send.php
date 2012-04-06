<?php

include('func/func.php');

$netbios = user_netbios();
$mess = $_POST['limitedtextarea'];



if ($netbios == "")
$netbios = $ipaddress;

notify("info",$netbios,$mess)

?>
'<meta http-equiv="refresh" content="0; URL=messagerie.php">'