<html>

<head>

<title>Webmanage : Accueil</title>

<link rel='stylesheet' type='text/css' href='style.css' />
</head>

<body>
<?php
ini_set ('max_execution_time', 0);
$computername = exec('c:\windows\system32\cscript.exe getcomputername.vbs');
$windowsver = exec('c:\windows\system32\cscript.exe windows.vbs');
$windowsver = mb_convert_encoding($windowsver, "auto", "IBM-850");


// INTERFACE

echo '<form name="accform" action="modifycomputername.php" onsubmit="return validateForm()" method="post">';

// INFORMATIONS GENERALES

echo '<h1> <INPUT type="text" value="'.$computername.'" name="computername"></h1>';

echo '<h3 align=center> '.$windowsver.'<h3>';

// CONFIGURATION	  
	  
echo '<h1> Configuration </h1>';

echo'
<table align=center>
<tr>
	<td><img src="/img/reseau.png" height="64" width="64" ></td>
	<td><a href="./network/network.php" ><h2> Configuration Réseau </h2></a></td>

	<td><img src="/img/chat.png" height="64" width="64" ></td>
	<td><a href="" onClick=javascript:popup("messagerie.php") ><h2>Messagerie</h2></a></td>

</table>';
echo '<h1><INPUT  type="submit" value="Enregistrer" /></h1>';

echo '</form>';


?>

</body>
</html>

<script type="text/javascript">

'TEST
function popup(page) {
window.open(page,'popup','width=201,height=200,toolbar=false,scrollbars=0');
}


function validateForm(){
var x=document.forms["accform"]["computername"].value;
if (x==null || x=="")
{  
  alert("Vous n'avez pas rentrer de nom pour l'ordinateur");
  return false;
}
else
{
var answer = confirm ("Etes vous sûr?")
if (answer)
{
return true;
}
else
{
return false;
}
}

}
</script>