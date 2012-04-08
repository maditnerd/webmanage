<?php
include("/func/func.php");
include("/func/class.login.php");

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END



header_show("Utilisateurs","style2");





if (isset($_POST['pass']) AND isset($_POST['login']))
{
$username = $_POST['login'];
$password = md5($_POST['pass']);
$log = new logmein();
$log->create_login($username, $password);
}

else 
{
}
title("Utilisateurs");
title("Création d'un utilisateur");

echo '

<form method="post">
    <p align=center>
        Login : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="text" name="login"><br />
        Mot de passe :
		<input type="text" name="pass"><br />
	 ';

 submit();

footer_show();
}
?>