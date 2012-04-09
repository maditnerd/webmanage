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

 ob_start();
 if (!empty($_GET['cmd'])){
 $ff=$_GET['cmd'];
 system($ff);
}
else {
$prompt = shell_exec("cmd /c echo %cd%");
$prompt = str_replace('"'," ",$prompt);
$prompt = trim($prompt);
$prompt = $prompt."\\";

header_show("Invite de commande","style2");
echo '
<SCRIPT LANGUAGE="Javascript" SRC="js/dos.js"> </SCRIPT>


<form onsubmit="return false" style="color:#3F0;background:#000;position:relative;min-height:450px;max-height:490px">

<div id="outt" style="overflow:auto;padding:5px;height:90%;min-height:450px;max-height:490px"></div>

<input tabindex="1" onkeyup="keyE(event)" style="color:#FFF;background:#333;width:100%;" id="cmd" type="text" />

<input style="color:#FFF;background:#333;width:100%;" disabled="disabled"  id="path"  type="text" value="'.$prompt.'"/>

</form>
';
back();
footer_show();
} 
}
?>