<?php

// connect_db.php

if (!$link = mysql_connect('localhost', '', '')) {
    echo 'Koennten nicht mySQL zu auswaehlen!';
    exit;
}

if (!mysql_select_db('', $link)) {
    echo 'Koennten nicht die Datenbank zu auswaehlen!';
    exit;
}

?>