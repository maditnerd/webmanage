<?php
include('func/class.login.php');
include('func/func.php');

$ipaddress = $_SERVER["REMOTE_ADDR"];
$netbios = user_netbios();
$mess = $_POST['limitedtextarea'];

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END

if ($netbios == "")
{
$netbios = $ipaddress;
}

notify("info",$netbios,$mess);

echo '<meta http-equiv="refresh" content="0; URL=messagerie.php">';
}
?>
