<html>
<title>WebManage : Réseau</title>
<head>
<link rel='stylesheet' type='text/css' href='../style.css' />
</head>

<body>
<?php
echo "<h1>Configuration Réseau</h1>";

function ext_wmi($script)
{

$datas = shell_exec('c:\windows\system32\cscript.exe '.$script.'.vbs //NoLogo');
$datas = explode(";", $datas);
return $datas;
} 
$ips = ext_wmi(ipaddress);
$macs = ext_wmi(macaddress);
$masks = ext_wmi(netmask);
$netname = ext_wmi(netname);
$netid = ext_wmi(netid);
$gateway = ext_wmi(gateway);
$dns = ext_wmi(dns);
$dhcp = ext_wmi(dhcp);






$count = count($ips);

for ($i = 1; $i < $count; $i++) {

echo "<h2>" . $netid[$i]."</h2>";
echo "Marque : " . $netname[$i]."<br>";
echo "Mac : " . $macs[$i]."<br>";
echo "IP : " . $ips[$i]."<br>";
echo "Masque : " . $masks[$i]."<br>";
echo "Passerelle : " . $gateway[$i]."<br>";
echo "DHCP Activé : " . $dhcp[$i]."<br><br>";

echo "<u>Serveur de Nom :</u><br>";
$dns_subcount = count(explode(",", $dns[$i]));
for ($j = 0; $j < $dns_subcount; $j++) {
$dns_sub = explode(",", $dns[$i]);
echo $dns_sub[$j]."<br>";


}


echo "<br>";
}


echo "<a href='../accueil.php'><h1>Revenir à l'index</h1>";
?>

</body>