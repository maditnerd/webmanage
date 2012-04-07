<?php

if (isset($_POST['pass']))
{

	$exec = '"exe/htpasswd.exe" -nb pass '.$_POST["pass"];
	$pass_crypte = shell_exec($exec);
	$pass_crypte = str_replace("pass:","",$pass_crypte);
	
    $login = "admin";
	$towrite = $login.":localhost:".$pass_crypte;

	$fichier="../pass.txt"; 
	$handle =fopen($fichier,"w");
	fwrite($handle,$towrite);
	

}

else // On n'a pas encore rempli le formulaire
{
?>

</p>

<p>Entrez votre mot de passe </p>

<form method="post">
    <p>
        Login : Admin<br />
        Mot de passe : <input type="text" name="pass"><br /><br />
    
        <input type="submit" value="Enregistrer !">
    </p>
</form>
<?php } ?>