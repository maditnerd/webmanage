<?php
include('func/func.php');
include('func/class.login.php');

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END
header_show("Réseau","style");

title("Configuration Réseau");

$ips = script_wmi(ipaddress);
$macs = script_wmi(macaddress);
$masks = script_wmi(netmask);
$netname = script_wmi(netname);
$netid = script_wmi(netid);
$gateway = script_wmi(gateway);
$dns = script_wmi(dns);
$dhcp = script_wmi(dhcp);

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

back();

footer_show();
}
?>
