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
$ips = script_wmi(ipaddress);
$masks = script_wmi(netmask);

$ip = trim($ips[1]);
$mask = trim($masks[1]);

$cidr = mask2cidr($mask);
$network = network($ip,$mask);
$network_scan = $network."/".$cidr;

$result = scan_netbios($network_scan,$cidr);


$result = str_replace ("MACAddress","",$result);
$result = str_replace ("ComputerName","",$result);
$result = str_replace ("Sharing","",$result);
$result = str_replace ("'","",$result);
$result = str_replace (",","",$result);

$j = 0;
$result = explode('=>',$result);
for($i=6;$i<sizeof($result);$i++)
   {
$ip_save[$j] = $result[$i];
$i = $i +2;
$groupe_save[$j] = $result[$i];
$i = $i +1;
$nom_save[$j] = $result[$i];
$i = $i +8;
$j++;
} 

header_show("Voisinage Réseau","style");
title("Voisinage Réseau");

text("Réseau: ".$network_scan);

echo "<table align=center>";
echo "<tr>";
for($k=0;$k<sizeof($ip_save);$k++)
{
echo "<td>";
echo "<img src='/img/computer.png' height='64' width='64' >";
echo "</td>";
}
echo "</tr>";
echo "<tr>";
for($k=0;$k<sizeof($ip_save);$k++)
{

echo "<td>";
echo '<a href="http://'.trim($ip_save[$k]).'">';
echo $ip_save[$k];
echo"</td>";
}
echo "</tr>";
echo "<tr>";

for($k=0;$k<sizeof($nom_save);$k++)
{
echo "<td>";
echo '<a href="https://'.trim($ip_save[$k]).':1000">'.trim($nom_save[$k]).'</a>';
echo "</td>";
}
echo "</tr>";
echo "<tr>";
for($k=0;$k<sizeof($groupe_save);$k++)
{

echo "<td>";
echo $groupe_save[$k];
echo "</td>";
}
echo "</tr></table>";
back();

footer_show();
}
?>
