<SCRIPT LANGUAGE="Javascript" SRC="js/messagerie.js"> </SCRIPT>
<link rel='stylesheet' type='text/css' href='css/style2.css' />
<title>Messagerie</title>

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
