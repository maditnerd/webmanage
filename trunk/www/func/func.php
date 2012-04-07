<?php

################ PROGRAMMES EXTERNE ###########################
#Affiche une notification
#$type info/warn/error
#$title Titre
#$message : Message
function notify($type,$title,$message)
{
$WshShell = new COM("WScript.Shell");
$command = 'cmd /C %cd%/exe/notifu.exe /t '.$type.' /p "'.$title.'" /m "'.$message.'"';
exec($command);
$WshShell->Run($command, 0, false);
}

#Execute un script VBS
function script($script_name)
{
$result = exec('%systemroot%\system32\cscript.exe ./vbs/'.$script_name.'.vbs');
return $result;
}

#Execute un SCRIPT VBS WMI
function script_wmi($script)
{
$datas = shell_exec('c:\windows\system32\cscript.exe ./vbs/'.$script.'.vbs //NoLogo');
$datas = explode(";", $datas);
return $datas;
} 



################ PROGRAMMES RESEAUX #########################

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

function scan_netbios($network,$cidr)
{
$nbtscan = '"./exe/nbtscan.exe " -P  '.$network;
$result = shell_exec($nbtscan);
return $result;
}

############# CONVERSIONS #################


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

#Convertit le résultat d'une commande DOS
function dosencode($text)
{
$result = mb_convert_encoding($text, "auto", "IBM-850");
return $result;
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

#Affiche un objet dans le menu et l'ouvre en popup
function menu_popup($img,$php,$txt)
{
$javascript = "javascript:popup('$php.php','popup_1');";
echo '
	<td><img src="/img/'.$img.'.png" height="64" width="64" ></td>
	<td><a href="'.$javascript.'"><h2> '.$txt.' </h2></a></td>';
}


#Texte mis en valeur
function text($txt)
{
echo '<h3>'.$txt.'<h3>';
}

#Bouton Enregistrer
function submit()
{
title('<INPUT  type="submit" value="Enregistrer" />');
}

#Retour à l'accueil
function back()
{
echo "<a href='accueil.php'><h1>Revenir à l'accueil</h1>";
}

##########################################


?>