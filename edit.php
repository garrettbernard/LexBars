<?php
require('./header.php');
// edit.php

if (is_numeric($_GET['sid'])) {
	$sid = $_GET['sid'];
} else {
	die('Illegal database function');
}

class edit {
	
	function is_allowed($sid) {
		if (@$_SESSION['editaccess'] != NULL) {
			if (in_array($sid,@$_SESSION['editaccess'])) {
				$this->sid = $sid;
				$this->show_current();
			} else {
				print("You aren't allowed here.");
			}
		}
	}
		
	function show_current() {
		require('./connect_db.php');
		$sql    = "SELECT * FROM name WHERE id = '" . $this->sid . "'";
		$this->name_result = mysql_query($sql, $link);

		if (!$this->name_result) {
			echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
			echo 'MySQL Fehler: ' . mysql_error();
			exit;
		}
		
		$row = mysql_fetch_assoc($this->name_result);
		
		if ($row['crowd'] == '') { $s4 = "selected='selected'"; }
		if ($row['crowd'] == 'College') { $s1 = "selected='selected'"; }
		if ($row['crowd'] == 'Business') { $s2 = "selected='selected'"; }
		if ($row['crowd'] == 'grade_horse') { $s3 = "selected='selected'"; }
		
	
?>
		<form action="./edit.php?act=send_updates" method="POST">
		<table>
			<tr><td>Bar Name:</td><td><INPUT type="text" name="name" value="<?php print($row['name']); ?>" /></td></tr>
			<tr><td>Bar Comments:</td><td><TEXTAREA name="barcomments" cols='40' rows='8'><?php print($row['bar_comments']); ?></TEXTAREA></td></tr>
			<tr><td>Typical Crowd:</td><td><SELECT>
											<OPTION value="" <?php print($s4) ?> ></OPTION>
											<OPTION value="College" <?php print($s1) ?> >College</OPTION>
											<OPTION value="Business" <?php print($s2) ?> >Business</OPTION>
											<OPTION value="grade_horse" <?php print($s3) ?> >A Variety</OPTION>
											</SELECT></td></tr>
			<tr><td>Address:</td><td><TEXTAREA name="address" cols='40' rows='5'><?php print($row['address']); ?></TEXTAREA></td></tr>
			<tr><td>Phone Number:<br />(10 digits, no dashes)</td><td><INPUT type="text" name="phonenumber" maxlength='10' value="<?php print($row['phonenumber']); ?>" /></td></tr>
			<tr><td colspan='2'>Bar Open From <INPUT type="text" size='7' name="time_open" value="<?php print($row['time_open']); ?>" /> until <INPUT type="text" name="time_closed" size='7' value="<?php print($row['time_closed']); ?>" /></td></tr>
			</table>
			<INPUT type="submit" value="Login" />
		</form>
<?php
	}

	function send_updates() {
		print("test2");
	}
}
        $edit = new edit($sid);
switch (@$_GET['act']) {
    case 'edit':
        $edit->is_allowed($sid);
        break;
    default:
        break;
    
}
