<?php

include('func/class.login.php');
include('func/func.php');

header_show("Messagerie","style2");
echo '<SCRIPT LANGUAGE="Javascript" SRC="js/messagerie.js"> </SCRIPT>';

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END

echo '
<form name="mesform" action="send.php"  method="post">
<textarea style="resize: none;" name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,65);" onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,65);">
</textarea><br>
<font size="1">
<input readonly type="text" name="countdown" size="3" value="65"> caractères.</font>
<INPUT type="submit" value="Envoyer" />
</form>

<form name="urlform" action="sendurl.php"  method="post">
<input type="text" name="urlsender" size="27" value="">
<br><p>URL<INPUT type="submit" value="Envoyer"</p>
</form>
';

footer_show;
}
?>