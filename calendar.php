<?php
$Calendar= new Calendar();
// calendar.php
$sid = @$_GET['sid'];
class calendar {
	
	function define_details_calendar() {
		
		$this->monthNames = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		
		if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
		if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
		
		$this->cMonth = $_REQUEST["month"];
		$this->cYear = $_REQUEST["year"];
		$this->monthNames = $this->monthNames[$this->cMonth-1];
		$this->prev_year = $this->cYear;
		$this->next_year = $this->cYear;
		$this->prev_month = $this->cMonth-1;
		$this->next_month = $this->cMonth+1;

		if ($this->prev_month == 0 ) {
			$this->prev_month = 12;
			$this->prev_year = $this->cYear - 1;
		}
		if ($this->next_month == 13 ) {
			$this->next_month = 1;
			$this->next_year = $this->cYear + 1;
		}
		
		$this->timestamp = mktime(0,0,0,$this->cMonth,1,$this->cYear);
		$this->maxday = date("t",$this->timestamp);
		$this->thismonth = getdate ($this->timestamp);
		$this->startday = $this->thismonth['wday'];
		$this->weblocation = $_SERVER["PHP_SELF"];
		
		for ($i=0; $i<($this->maxday+$this->startday); $i++) {
			if(($i % 7) == 0 ) {
				$this->newweek .= "<tr>\n";
			} 
			if ($i < $this->startday) {
				$this->newweek .= "<td></td>\n";
			} else {
				$this->newweek .= "<td align='center' valign='middle' height='20px'><a href='./calendar.php?month=" . $this->cMonth . "&year=" . $this->cYear . "&day=" . ($i - $this->startday + 1) . "'>" . ($i - $this->startday + 1) . "</a></td>\n";
			}
			if(($i % 7) == 6 ) {
				$this->changeweek .= "</tr>\n";
			} else {
				$this->changeweek = NULL;
			}
		}
	}
	
	function display_details_calendar() {
		$this->define_details_calendar();
		$this->file = file_get_contents('./template/calendar.php', FILE_USE_INCLUDE_PATH);
		$pattern = array('var->weblocation','var->monthNames','var->prev_year','var->next_year','var->prev_month','var->next_month','var->cYear','var->cMonth','var->newweek','var->changeweek');
		$replacement = array($this->weblocation,$this->monthNames,$this->prev_year,$this->next_year,$this->prev_month,$this->next_month,$this->cYear,$this->cMonth,$this->newweek,$this->changeweek);
		echo str_replace($pattern, $replacement, $this->file);
		ob_end_flush();
	}
	
	function datenbank_events($sid) {
		include("./connect_db.php");

		$day = @$_GET['day'];
		$month = @$_GET['month'];
		$year = @$_GET['year'];
		
		$date = ($year . "-" . $month . "-" . $day);
		//$date = "2009-07-24";
		$daterange_start = ($date . " 00:00:00");
		$daterange_end = ($date . " 23:59:59");
		
		$sql    = "SELECT events.*,name.id,name.name FROM events,name WHERE events.bar_id = name.id AND events.date_start >= '" . $daterange_start . "' AND events.date_start <= '" . $daterange_end . "'";
		$this->name_result = mysql_query($sql, $link);

		if (!$this->name_result) {
			echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
			echo 'MySQL Fehler: ' . mysql_error();
			exit;
		}
	}


	function define_details_events($sid) {
		$this->datenbank_events($sid);
		
		$this->events = NULL;
		$array = array();
		$numrows = mysql_num_rows($this->name_result);
		
		if ($numrows == 0) {
			$this->events = "No Events Scheduled";
		} else {
		while($row = mysql_fetch_array($this->name_result)) {
			
			$this->events .= "<div class='event'>" . $row['name'] . "<br />";
			$this->events .= "Artist: <i>";
			$this->events .= $row['artist'];
			$this->events .= "</i><br /> Cover Charge: ";
			$this->events .= $row['covercharge'];
			$this->events .= "<br />";
			$date_start = date('l, M d',strtotime($row['date_start']));
			$time_start = date('g:ia',strtotime($row['date_start']));
			$this->events .= $date_start . " at " . $time_start;
			$this->events .= "</div>";
		}
		
		print($this->events);
	}
}
}



        $Calendar->define_details_events($sid);	

