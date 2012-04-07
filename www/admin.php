<html>

<head>

<title>Webmanage : Utilisateurs</title>

<link rel='stylesheet' type='text/css' href='css/style2.css' />
</head>

<?php
include("/func/func.php");
include("/func/class.login.php");

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
?>



<form method="post">
    <p align=center>
        Login : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="text" name="login"><br />
        Mot de passe :
		<input type="text" name="pass"><br />
 <?php
 submit();
 echo '</form>';
?>