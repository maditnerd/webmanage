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

// PASSWORD GENERATION

header_show("Utilisateurs","style2");

//////////////////////
//CREATE USER
/////////////////////

// Vérifie que les informations ont été correctement entrer

$pass = trim($_POST['pass']);
$login = $_POST['login'];
$login = str_replace('"','',$login);
$login = str_replace("'",'',$login);
$login = trim($login);
$pass_confirm = trim($_POST['pass_confirm']);

if ($pass == "" || $login == "" || $pass_confirm == "")
	{
		// DO NOTHING (car on ne peut pas deviner si y a eu un post
	}
else
	{
		
	if ($pass == $pass_confirm)
		{		
			//VERIFICATION existance du login
			$log = new logmein();
			$login_existence = $log->check_login($login);
			if ($login_existence["useremail"] == $login)
				{
					title('<img src="/img/info.png" height="32" width="32" ><font color="#990000">Ce login existe déjà</font>');
				}
			else
				{
				$username = $login;
				$password = md5($pass);
				$log = new logmein();
				$log->create_login($username, $password);
				}
		}
	else
		{
			title('<img src="/img/info.png" height="32" width="32" > <font color="#990000">Vous avez rentré un mot de passe différent</font>');
		}	
	}
	
/////////////////////////
//CREATE USER END
////////////////////////

title("Utilisateurs");
/////////////////////////
//SHOW USER
////////////////////////
$log = new logmein();
$result = $log->show_users();
echo "<table align=center><tr>";
while ($row = mysql_fetch_assoc($result))
		{
		 $username = $row["useremail"] ;
		
		 menu_usr($username);
		}
		
/////////////////////////
//SHOW USER END
////////////////////////	
	
echo "</tr></table>";
title("Nouveau Utilisateur");
echo '
<form method="post">
<table align=center><tr><td>
        Identifiant : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="text" name="login"></td></tr><td>
		Mot de passe : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="password" name="pass"></td></tr><td>
		Confirmer le mot de passe :
		<input type="password" name="pass_confirm"><br /></td></tr><td align=center>
		<INPUT  type="submit" value="Enregistrer" />
		
</td></tr></table>
</form>
';


back();
footer_show();
}
?>