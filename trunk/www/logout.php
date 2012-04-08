<?php
include("func/class.login.php");
$log = new logmein();
$log->encrypt = true; //set encryption
//Log out
$log->logout();
echo '<meta http-equiv="refresh" content="0; URL=index.php">';
?>
