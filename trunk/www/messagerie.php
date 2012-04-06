<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
<link rel='stylesheet' type='text/css' href='style2.css' />
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
<br><p align=center>URL<INPUT type="submit" value="Envoyer"</p>
</form>