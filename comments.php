<?php

// comments.php

if (is_numeric($_GET['sid'])) {
	$sid = $_GET['sid'];
} else {
	die('Illegal database function');
}


class comments {
	var $db;
	
	function datembank() {
		require("./connect_db.php");
	}
	
	function listcomments($sid) {
		require("./connect_db.php");
		$sql    = "SELECT * FROM comments WHERE bar_id = " . $sid . " ORDER BY dateadded DESC";
		$this->name_result = mysql_query($sql, $link);
		$num_rows = mysql_num_rows($this->name_result);
		
		if ( $num_rows&1 ) {
			// odd rule
   			$rowclass = 1;
		} else {
			// even rule
			$rowclass = 0;
		}


		print("<br /><div class='comment_t'><div class='comment_b'><div class='comment_l'><div class='comment_r'><div class='comment_bl'><div class='comment_br'><div class='comment_tl'><div class='comment_tr'>");
		print("<a name='comments'></a><p><img src='./images/comments.png' alt-'Comments' style='margin:auto;display:block;' /></p><br />");
		
		if ($num_rows == 0) {
			print("No Comments");
		} else {
			print("<div class='comments'>");
		while($row = mysql_fetch_array($this->name_result)) {
			$this->comment_name = $row['name'];
			$this->comment_text = $row['comments'];
			$this->comment_date = $row['dateadded'];
			
			$this->comment_date = strtotime($this->comment_date);
			$this->comment_date = strftime("%b %d, %Y",$this->comment_date);

			$comments = str_replace("\n","<br />",$row['comments']);
			print("<div id='comment_section' class='row" . $rowclass . "'><div class='commenttext'>" . $comments . "</div>");
			print("<div class='commentname'>" . $this->comment_name . "<br />");
			print($this->comment_date . "</div></div>");
			$rowclass = 1 - $rowclass;

			}
		}
		print("</div></div></div></div></div></div></div></div></div>");
		
	}
}

		
switch (@$_GET['act']) {
    case 'listcomments':
        $comments = new comments();
        $comments->listcomments($sid);
        break;
}