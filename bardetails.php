<?php
require('./header.php');
//require('/template/bardetails.php');

if (is_numeric($_GET['sid'])) {
	$sid = $_GET['sid'];
} else {
	die('Illegal database function');
}

class Bardetails {
	
	function precalls() {
		$this->file = file_get_contents('./template/bardetails.php', FILE_USE_INCLUDE_PATH);
	}

	function datenbank_bars($sid) {
		
		require('./connect_db.php');
		
		$sql    = "SELECT * FROM name WHERE id = " . $sid;
		$this->name_result = mysql_query($sql, $link);

		if (!$this->name_result) {
			echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
			echo 'MySQL Fehler: ' . mysql_error();
			exit;
		}
		
	}
	
	function datenbank_events($sid) {
		
		require('./connect_db.php');
		
		$sql    = "SELECT * FROM events WHERE bar_id = " . $sid . " ORDER BY date_start ASC";
		$this->name_result = mysql_query($sql, $link);

		if (!$this->name_result) {
			echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
			echo 'MySQL Fehler: ' . mysql_error();
			exit;
		}
	}
	
	function define_details_bars($sid) {
		$this->datenbank_bars($sid);
		
		$row = mysql_fetch_assoc($this->name_result);
					
		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->image = "./bar_images/" . $this->id . ".jpg";
		$this->bar_comments = $row['bar_comments'];
		$this->crowd = "<img src='./images/crowd_" . $row['crowd'] . ".png' />";
		$this->address = str_replace("\n","<br />",$row['address']);
		$this->dateadded = $row['dateadded'];
		$this->time_open = $row['time_open'];
		$this->time_closed = $row['time_closed'];
		$this->phonenumber = preg_replace("/[^0-9]/", "", $row['phonenumber']);
		
		
		if ((@$_SESSION['is_bar'] == $this->id) OR (@$_SESSION['is_bar'] == 'all')) {
			$this->editpage = "<a href='./edit.php?sid=" . $this->id . "'>Edit this page</a>";
		} else {
			$this->editpage = "";
		}

	if(strlen($this->phonenumber) == 7) {
		$this->phonenumber = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $this->phonenumber);
	} elseif(strlen($this->phonenumber) == 10) {
		$this->phonenumber = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $this->phonenumber);
	} else {
		$this->phonenumber;
	}

				
		if (file_exists($this->image)) {
			$this->image = "<img src='" . $this->image . "' height='260' width='500' />";
		} else {
			$this->image = "<p>(No image available)</p>";
		}
		
		$this->bar_comments = (str_replace("\r\n","<br />",$this->bar_comments));		

	}
	
	function define_details_events($sid) {
		$this->datenbank_events($sid);
		$this->precalls();
		
		$this->events = NULL;
		$array = array();
		$numrows = mysql_num_rows($this->name_result);
		
		if ($numrows == 0) {
			$this->events = "No Events Scheduled";
		} else {
		while($row = mysql_fetch_array($this->name_result)) {

			$this->events .= "<div class='event'>Artist: <i>";
			$this->events .= $row['artist'];
			$this->events .= "</i><br /> Cover Charge: ";
			$this->events .= $row['covercharge'];
			$this->events .= "<br />";
			$date_start = date('l, M d',strtotime($row['date_start']));
			$time_start = date('g:ia',strtotime($row['date_start']));
			$this->events .= $date_start . " at " . $time_start;
			$this->events .= "</div>";
		}
	}

}
			


	
	function display_details_all($sid) {
		$this->define_details_bars($sid);
		$this->define_details_events($sid);
		include('./comments.php');
		$comments = new comments($sid);
		ob_start();
		ob_clean();
		$pattern = array('var->image','var->name','var->bar_comments','var->crowd','var->address','var->dateadded','var->phonenumber','var->time_open','var->time_closed','var->events');
		$replacement = array($this->image,$this->name,$this->bar_comments,$this->crowd,$this->address,$this->dateadded,$this->phonenumber,$this->time_open,$this->time_closed,$this->events);

		echo str_replace($pattern, $replacement, $this->file);



		$comments->listcomments($sid);
		ob_end_flush();

	}
	
}
		
$Bardetails = new Bardetails($sid);
$Bardetails->display_details_all($sid);
