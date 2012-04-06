<?php

#Affiche une notification
#$type info/warn/error
#$title Titre
#$message : Message

################ PROGRAMMES EXTERNE ###########################

function notify($type,$title,$message)
{
$WshShell = new COM("WScript.Shell");
$command = 'cmd /C %cd%/exe/notifu.exe /t '.$type.' /p "'.$title.'" /m "'.$message.'"';
exec($command);
$WshShell->Run($command, 0, false);
}

#Recupère le nom du groupe et de l'ordinateur de l'utilisateur
function user_netbios()
{
$ipaddress = $_SERVER["REMOTE_ADDR"];
$nbtscan = "%cd%/exe/nbtscan.exe ". $ipaddress;
$result = exec($nbtscan);
$result = explode('    ',$result);
return $result[1];
}

function netbios()
{
$ipaddress = $_SERVER["REMOTE_ADDR"];
$nbtscan = "%cd%/exe/nbtscan.exe ". $ipaddress;
$result = exec($nbtscan);
$result = explode('    ',$result);
return $result[1];
}

#Execute un script VBS
function script($script_name)
{
$result = exec('%systemroot%\system32\cscript.exe ./vbs/'.$script_name.'.vbs');
return $result;
}

#Convertit le résultat d'une commande DOS
function dosencode($text)
{
$result = mb_convert_encoding($text, "auto", "IBM-850");
return $result;
}

############# CONVERSION RESEAU #################


## NETMASK TO CIDR
## Ex:255.255.255.0 --> 24

function mask2cidr($netmask){
  $long = ip2long($netmask);
  $base = ip2long('255.255.255.255');
  return 32-log(($long ^ $base)+1,2);
}

## IP/NETMASK TO NETWORK
## Ex: 192.168.0.20 255.255.255.0 --> 192.168.0.0
function network($ip,$netmask)
{
$ip = ip2long($ip);
$netmask = ip2long($netmask);
$network = $netmask & $ip;
return long2ip($network);
}
################################################


############# AFFICHAGE #################

#Affiche un titre
function title($texte)
{
echo '<h1>'.$texte.'</h1>';
}

#Affiche un objet dans le menu
function menu($img,$php,$txt)
{
echo '
	<td><img src="/img/'.$img.'.png" height="64" width="64" ></td>
	<td><a href="'.$php.'.php" ><h2> '.$txt.' </h2></a></td>';
}

#Bouton Enregistrer
function submit()
{
title('<INPUT  type="submit" value="Enregistrer" />');
}

##########################################


?>