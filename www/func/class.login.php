<?php
//For security reasons, don't display any errors or warnings. Comment out in DEV.
session_start();
error_reporting(0);

class logmein {
    //database setup
       //MAKE SURE TO FILL IN DATABASE INFO
    var $hostname_logon = 'localhost';      //Database server LOCATION
    var $database_logon = 'login';       //Database NAME
    var $username_logon = 'root';       //Database USERNAME
    var $password_logon = 'qVFqcvDXFGDFAcSRtRMl';       //Database PASSWORD
 
    //table fields
    var $user_table = 'logon';          //Users table name
    var $user_column = 'useremail';     //USERNAME column (value MUST be valid email)
    var $pass_column = 'password';      //PASSWORD column
    var $user_level = 'userlevel';      //(optional) userlevel column
 
    //encryption
    var $encrypt = false;       //set to true to use md5 encryption for the password
 
    //connect to database
    function dbconnect(){
        $connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
        mysql_select_db($this->database_logon) or die ('Unable to select database!');
        return;
    }
 
    //login function
    function login($table, $username, $password){
		//conect to DB
        $this->dbconnect();
        //make sure table name is set
        if($this->user_table == ""){
            $this->user_table = $table;
        }
        //check if encryption is used
        if($this->encrypt == true){
            $password = md5($password);
        }
        //execute login via qry function that prevents MySQL injections
        $result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column."='?' AND ".$this->pass_column." = '?';" , $username, $password);
        $row=mysql_fetch_assoc($result);
        if($row != "Error"){
            if($row[$this->user_column] !="" && $row[$this->pass_column] !=""){
                //register sessions
                //you can add additional sessions here if needed
                $_SESSION['loggedin'] = $row[$this->pass_column];
                //userlevel session is optional. Use it if you have different user levels
                $_SESSION['userlevel'] = $row[$this->user_level];
                return true;
            }else{
                session_destroy();
                return false;
            }
        }else{
            return false;
        }
 
    }
	
	function show_users(){
	
	$this->dbconnect();
	$result = mysql_query("SELECT * FROM logon") or die(mysql_error());
	return $result;
	}
 
    //prevent injection
    function qry($query) {
      $this->dbconnect();
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysql_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      $result = mysql_query($query) or die(mysql_error());
          if($result){
            return $result;
          }else{
             $error = "Error";
             return $result;
          }
    }
 
    //logout function
    function logout(){
        session_destroy();
        return;
    }
 
    //check if loggedin
    function logincheck($logincode, $user_table, $pass_column, $user_column){
        //conect to DB
        $this->dbconnect();
        //make sure password column and table are set
        if($this->pass_column == ""){
            $this->pass_column = $pass_column;
        }
        if($this->user_column == ""){
            $this->user_column = $user_column;
        }
        if($this->user_table == ""){
            $this->user_table = $user_table;
        }
        //exectue query
        $result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->pass_column." = '?';" , $logincode);
        $rownum = mysql_num_rows($result);
        //return true if logged in and false if not
        if($row != "Error"){
            if($rownum > 0){
                return true;
            }else{
                return false;
            }
        }
    }
 
     
    
    //login form
    function loginform($formname, $formclass, $formaction){
        //conect to DB
        $this->dbconnect();
        echo'
<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
<div><label for="username">Identifiant&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<input name="username" id="username" type="text"></div>
<div><label for="password">Mot de passe &nbsp</label>
<input name="password" id="password" type="password"></div>
<input name="action" id="action" value="login" type="hidden">
<div>
<input name="submit" id="submit" value="                        Se connecter                     " type="submit"></div>
</form>
 
';
    }
    //reset password form
    function resetform($formname, $formclass, $formaction){
        //conect to DB
        $this->dbconnect();
        echo'
<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
<div><label for="username">Username</label>
<input name="username" id="username" type="text"></div>
<input name="action" id="action" value="resetlogin" type="hidden">
<div>
<input name="submit" id="submit" value="Reset Password" type="submit"></div>
</form>
 
';
    }
    //function to install logon table
    function cratetable($tablename){
        //conect to DB
        $this->dbconnect();
        $qry = "CREATE TABLE IF NOT EXISTS ".$tablename." (
              userid int(11) NOT NULL auto_increment,
              useremail varchar(50) NOT NULL default '',
              password varchar(50) NOT NULL default '',
              userlevel int(11) NOT NULL default '0',
              PRIMARY KEY  (userid)
            )";
        $result = mysql_query($qry) or die(mysql_error());
        return;
    }
	
	function create_login($username, $password){
        //Insert login/pass
		$this->dbconnect();
        $qry = ("INSERT INTO logon (useremail,password,userlevel) VALUES('".$username."','".$password."','1')");
		$result = mysql_query($qry) or die(mysql_error());
		title('<img src="/img/info.png" height="32" width="32" > <font color="#990000">Utilisateur crée</font>');
    }
	
	function delete_login($username){
        //Insert login/pass
		$this->dbconnect();
        $qry = ("DELETE FROM logon WHERE useremail='".$username."'");
		$result = mysql_query($qry) or die(mysql_error());
		echo '<meta http-equiv="refresh" content="0; URL=admin.php">';
    }
			
	function check_login($username){
	 $result = $this->qry("SELECT * FROM logon WHERE useremail='".$username."'");
     $row=mysql_fetch_assoc($result);
	 return $row;
	}
	
	function update_password($username,$password){
	$qry = "UPDATE logon SET password='".$password."' WHERE useremail='".$username."'";
    $result = mysql_query($qry) or die(mysql_error());
	title('<img src="/img/info.png" height="32" width="32" > <font color="#990000">Mot de passe changé</font>');
	}
 	
	function update_username($oldusername,$username){
	$qry = "UPDATE logon SET useremail='".$username."' WHERE useremail='".$oldusername."'";
    $result = mysql_query($qry) or die(mysql_error());
	echo '<meta http-equiv="refresh" content="0; URL=admin.php">';
	}
	
	function update_log($type,$ip)
	{
		$this->dbconnect();
        $qry = ("INSERT INTO log_security (date,type,ip) VALUES(NOW(),'".$type."','".$ip."')");
		$result = mysql_query($qry) or die(mysql_error());
	}
	
	function show_logs(){
	
	$this->dbconnect();
	$result = mysql_query("SELECT * FROM log_security WHERE type='OK' OR type='fail'") or die(mysql_error());
	return $result;
	}
	
	function delete_log(){
        //Insert login/pass
		$this->dbconnect();
        $qry = ("DELETE FROM log_security");
		$result = mysql_query($qry) or die(mysql_error());
    }
	
	function fail2ban($ip){
	$this->dbconnect();
	$result = mysql_query("SELECT * FROM log_security WHERE type='FAIL' AND ip='".$ip."'") or die(mysql_error());
	$count = mysql_affected_rows();
	return $count;
	}
}
	
?>

