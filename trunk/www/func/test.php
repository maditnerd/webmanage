<?php
include('func.php');

function ext_wmi($script)
{
$datas = shell_exec('c:\windows\system32\cscript.exe ../network/'.$script.'.vbs //NoLogo');
$datas = explode(";", $datas);
return $datas;
} 

$ips = ext_wmi(ipaddress);
$masks = ext_wmi(netmask);

$ip = trim($ips[1]);
$mask = trim($masks[1]);

$cidr = mask2cidr($mask);
$network = network($ip,$mask);
$network_scan = $network."/".$cidr;
$nbtscan = '"../exe/nbtscan.exe" '.$network_scan;
$result = shell_exec($nbtscan);
$result = explode('SHARING',$result);
for($i=0;$i<sizeof($result);$i++) // tant que $i est inferieur au nombre d'éléments du tableau...
    {
    echo $result[$i].'<br>'; // on affiche l'élément du tableau d'indice $i
    } 
?>