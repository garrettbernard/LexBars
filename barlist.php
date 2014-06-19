<?php
require('./header.php');


$sql    = 'SELECT id,name FROM name';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "Datenbank Fehler! Koennten nicht die Datenbank zu bezweifeln!";
    echo 'MySQL Fehler: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    print("<a href='./bardetails.php?sid=" . $row['id'] . "'>" . $row['name'] . "</a><br />");
}

mysql_free_result($result);

?> 