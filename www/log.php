<?php
include('func/class.login.php');
include('func/func.php');

// LOGIN START
$log = new logmein();
$log->encrypt = true; //set encryption
//parameters are(SESSION, name of the table, name of the password field, name of the username field)
if($log->logincheck($_SESSION['loggedin'], "logon", "password", "useremail") == false){
  echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}
	else{
//LOGIN END

header_show("Historique des connexions","style");
$log = new logmein();
$result = $log->show_logs();
title("Historique des connexions");
echo "<table align=center>";
while ($row = mysql_fetch_assoc($result))
		{
		 $type = $row["type"] ;
		 $date = $row["date"] ;
		 $ip = $row["ip"] ;
		
		 echo "<tr>";
		 echo "<td>".$date."</td>";
	 	 echo "<td>".($type)."</td>";
		 echo "<td>".($ip)."</td>";
		 echo "</tr>";
		}

echo "</table>";
back();
footer_show();
}
?>