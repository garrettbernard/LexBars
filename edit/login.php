<?php

// /edit/login.php
session_start();

 class login {
	
	function verify() {	
				require("/connect_db.php");
		
		if ((@$_POST['barpassword']) != NULL) {
			$barpassword = md5($_POST['barpassword']);
			$bar_id = ($_POST['bar_id']);
		} else {
			die('You didn\'t enter a password!');
		}
		
		$sql    = 'SELECT id,name,barpassword FROM name WHERE id = ' . $bar_id;
		$result = mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
		
		if ($row['barpassword'] == $barpassword) {
			$_SESSION['bar'] = $row['name'];
			$_SESSION['bar_id'] = $row['id'];
			$_SESSION['password'] =  $row['barpassword'];
			print("<p>Successful login...</p><p><a href='./index.php'>Return</a></p>");
		} else {
			print("<p><a href='./index.php'>Return</a></p>");
			die('Incorrect password!');
		}
	}
	
}

if (@$_GET['act'] == 'verify') {
	$login = new login();
	$login->verify();
}

if (@$_GET['act'] == 'logoff') {
	session_destroy();
	print("<a href='./index.php'>Continue...</a>");
}
?>	