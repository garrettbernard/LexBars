<?php

// /edit/index.php
// The /edit directory is solely for the use by local bars.
// They each have their own unique login, which allows them
// to edit their bar's information (events, open times, etc.)
session_start();

class Edit {
	
	function barlist() {
		require("/connect_db.php");
		$sql    = 'SELECT id,name FROM name';
		$result = mysql_query($sql, $link);
		print("<select name='bar_id'>");
		while ($row = mysql_fetch_assoc($result)) {
			print("<option name='barname[" . $row['id'] . "]' value='" . $row['id'] . "'>" . $row['name'] . "</option>");
		}
		print("</select");
	}
	
	function login_form() {
		
?>
		<form action='login.php?act=verify' method='post'>
			<p>Bar: <?php $this->barlist(); ?></p>
			<p>Password: <input name='barpassword' /></p>				
			<p><input type="submit" value="Login" /></p>
		</form>
		
<?php
	}


		function loggedin_header() {
			print("<p>You are logged in! (<a href='./login.php?act=logoff'>Logout</a>)</p>");
			print("<p>From here, you can edit your bar entry within our system.</p>");
		}
	}

			
			
if (@$_SESSION['bar_id'] != NULL) {
$loggedin = TRUE;
$Edit = new Edit();
$Edit->loggedin_header();
} else {
$Edit = new Edit();
$Edit->login_form();
}