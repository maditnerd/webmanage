<html>

<head>

<title>Webmanage : Accueil</title>

<link rel='stylesheet' type='text/css' href='css/style.css' />
</head>

<body>
<?php
include('func/func.php');

$computername = script("getcomputername");
$windowsver = script("windows");
$windowsver = dosencode($windowsver);

// INTERFACE
echo '<form name="accform" action="modifycomputername.php" onsubmit="return validateForm()" method="post">';

// INFORMATIONS GENERALES

title('<INPUT type="text" value="'.$computername.'" name="computername">');
echo '<h3>'.$windowsver.'<h3>';

// CONFIGURATION	  
	  
title('Configuration');

echo'<table align=center>';
	menu("reseau","network/network","Configuration Réseau");
	menu("chat","messagerie","Messagerie");
	menu("lan","scan_net","Voisinage réseau");
echo'</table>';




submit();

echo '</form>';


?>

</body>
</html>

<SCRIPT LANGUAGE="Javascript" SRC="js/accueil.js"> </SCRIPT>
