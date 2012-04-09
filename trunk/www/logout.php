<?php
include("func/class.login.php");
$log = new logmein();
$log->encrypt = true; //set encryption
//Log out
$log->logout();
$log = new logmein();
$log->update_log("out",$ip_admin);
echo '<meta http-equiv="refresh" content="0; URL=index.php">';
?>
