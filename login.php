<?php
include('./header.php');
class login {
	
	function loginform() {
?>

		<form action="./login.php?act=verify" method="POST">
		<table>
			<tr>
			<td>Username:</td><td><INPUT type="text" name="username" /></td></tr>
			<tr><td>Password:</td><td><INPUT type="password" name="password" /></td>
			</tr>
		</table>
			<INPUT type="submit" value="Login" />
		</form>
<?php
	}
	
	function verify() {
		
		require('./connect_db.php');
		
		$password = md5(@$_POST['password']);
		$username = $_POST['username'];
		
		
		$sql    = "SELECT userid,username,password,editaccess FROM users WHERE username = '" . $username . "'";
		$this->name_result = mysql_query($sql, $link);

		if (!$this->name_result) {
			echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
			echo 'MySQL Fehler: ' . mysql_error();
			exit;
		}
		
		$row = mysql_fetch_assoc($this->name_result);
		
		$user_id = $row['userid'];
		
		if ($row['password'] == $password AND $row['username'] == $username) {
			$_SESSION['username'] = $username;
			
			
			$_SESSION['user_id'] = $user_id;
			
			$editaccess = explode("|",$row['editaccess']);
			print("Login successful. You are logged in as " . $_SESSION['username']);
			print("<br />Go back <a href='./index.php'>home</a>");
			print("<p>" . print_r($editaccess) . "</p>");
			$_SESSION['editaccess'] = $editaccess;
		} else {
			print("Incorrect password.");
		}
	}
	
	function logout() {
		$_SESSION = array();
		//if (isset($_COOKIE[session_name()])) {
		//	    setcookie(session_name(), '', time()-42000, '/');
		//}
		session_destroy();
		
		print("You are now logged out. <a href='./index.php'>Return home</a>");
	}

	function register_form() {
		print("<p>Registration</p>");
		print("<p>Why is registration important?<br />");
		print("Unregistered users are able to view everything on the site. ");
		print("However, to post comments and rate bars, you'll have to register.<br />");
		print("This is to prevent misuse and spam within the system. It shouldn't take more than two minutes!</p>");
		print("<p>Items marked with a * are required.</p>");
?>
		<!-- <form action="" method="POST" onsubmit="return false;" id="myid"> -->
		<form action="./login.php?act=verify_reg" method="POST">
		<table>
			<tr><td>*Username:</td><td><INPUT type="text" name="username" /></td></tr>
			<tr><td>*Password:</td><td><INPUT type="password" name="password1" /></td></tr>
			<tr><td>*Password (again):</td><td><INPUT type="password" name="password2" /></td></tr>
			<tr><td>*Email address:</td><td><INPUT type="text" name="email" /></td></tr>
			<tr><td>College or Employer:</td><td><INPUT type="text" name="employer" /></td></tr>
			<tr><td>Favorite Bar:</td><td><INPUT type="text" name="favorite_bar" /></td></tr>			
		</table>
			<!-- <INPUT type="submit" class="positive" onclick="ajax_form('myid','./login.php?act=verify_reg','receiver');"> -->
			<INPUT type="submit" value="Submit" />
		</form>
<?php		
	}
	
	function verify_reg() {
				require('./connect_db.php');
	if ($_POST['username'] == NULL) {
		print("Please enter a valid username.");
	}
	if (!empty($_POST['password1']) && !empty($_POST['password2']) && $_POST['password1'] != $_POST['password2']) { print("The password you entered does not match! Please try again."); }
		$password = (md5(@$_POST['password1']));
		$username = mysql_real_escape_string($_POST['username']);
		$employer = mysql_real_escape_string($_POST['employer']);
		$favorite_bar = mysql_real_escape_string($_POST['favorite_bar']);
		
		mysql_query("INSERT INTO users (username,password,employer,favorite_bar, editaccess) VALUES('$username','$password','employer','favorite_bar','none') "); 

		print($username . $password . $employer . $favorite_bar);
		
}
}


$login = new login();
switch (@$_GET['act']) {
    case 'verify':
        $login->verify();
        break;
    case 'logout':
		$login->logout();
		break;
	case 'register':
		$login->register_form();
		break;
	case 'verify_reg':
		$login->verify_reg();
		break;
    default:
        $login->loginform();
        break;
   }