<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
$nbtscan = "nbtscan ". $ipaddress;
$result = exec($nbtscan);
$result = explode('    ',$result);

$mess = $_POST['limitedtextarea'];
$WshShell = new COM("WScript.Shell");
$mess = 'cmd /C notifu.exe /t info /p "'.$result[1].'" /m "'.$mess.'"';
$WshShell->Run($mess, 0, false);
echo '<meta http-equiv="refresh" content="0; URL=messagerie.php">';
?>