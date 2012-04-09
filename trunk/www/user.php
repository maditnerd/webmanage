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
$user = $_GET["user"];

$log = new logmein();
$login_existence = $log->check_login($_GET["user"]);
if ($login_existence["useremail"] !== $_GET["user"])
			{
				echo '<meta http-equiv="refresh" content="0; URL=admin.php">';
			}
else
			{

// Vérifie sur un utilisateur a été spécifié
if (!isset($user)) 
{
  echo '<meta http-equiv="refresh" content="0; URL=admin.php">';
}

else
 {

////////////////////////
//CHANGE USER NAME
//////////////////////// 
if (isset($_POST["username_box"]))
	{
		$login = $_POST['username_box'];
		$login = str_replace('"','',$login);
		$login = str_replace("'",'',$login);
		$login = trim($login);
		$log = new logmein();
		$log->update_username($_GET["user"],$login);
	}

////////////////////////
// DELETE USER
//////////////////////// 
 
if ($_GET["delete"] == 1)
{
$log = new logmein();
$log->delete_login($user);

}

/////////////////////////
/// UPDATE PASSWORD
/////////////////////////
if ($_POST["pass"] == "")
{
// DO NOTHING
}
else
{
if ($_POST["pass"] == $_POST["pass_confirm"])
{
$password = md5($_POST["pass"]);
$log = new logmein();
$log->update_password($user,$password);
}
else
{
	title('<img src="/img/info.png" height="32" width="32" > <font color="#990000">Vous avez rentré un mot de passe différent</font>');
	}
}

header_show($user,"style2");

echo '
<form method="post">
';
title('<INPUT style="background-color:transparent; border:none; text-align:center; font-size:150%; color: #333333;" type="text" value="'.$user.'" name="username_box"><INPUT  type="submit" value="OK" />');


echo '
</form>
<form method="post">
<table align=center><tr>';
menu_img_get("delete","user.php?user=".$user."&delete=1","Supprimer l'utilisateur");

echo '<td>
        Mot de passe : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="password" name="pass"><br />
		Confirmer le Mot de passe :
		<input type="password" name="pass_confirm"><br /></td></tr><tr><td></td><td align=center>
		<INPUT  type="submit" value="Enregistrer" />
		
		</td></tr></table>
		</form>
';

 back_user();
 }
 }
 }
 ?>