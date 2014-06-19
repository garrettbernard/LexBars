<?php
session_start();
/*
# header.php
# This header file manages how each page of the website operates. It sets the
# template correctly. It is also present on every page (such as with the
# top header menu). This file is pretty important.
#
#
*/
$lastupdated = "July 23, 2009 05:11:51 PM ";
require('./connect_db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr"> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <div xmlns:cc="http://creativecommons.org/ns#" about="http://www.flickr.com/photos/spine/2085941610/"></div>
    <title>Lexington Bars</title>

    
    <link rel="stylesheet" type="text/css" href="./main.css" /> 
    <meta name="robots" content="noindex,nofollow" />
    <link href="./alphacube.css" rel="stylesheet" type="text/css"/>
    <script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/custom.js" type="text/javascript"></script>


  <style type="text/css"> 
    .popup_effect1 {
      background:#11455A;
      opacity: 0.2;
    }
    .popup_effect2 {
      background:#FF0041;
      border: 3px dashed #000;
    }
    
  </style>	
</head>

<div id='master_container'>
<div class="menu"><a href="./index.php"><img alt="Home" src="./images/nav_home.png"></a>&nbsp; <a href="./barlist.php"><img alt="List" src="./images/nav_list.png"></a>&nbsp; <a href="#"><img alt="Home" src="./images/nav_map.png"></a><br /></div>
<div id='header'>
<img id="logo" alt="Logo" src="./images/logo.jpg"><br />
<br />
</div>
<?php
	if ((@$_GET['act'] != 'verify') AND (@$_GET['act'] != 'logout')) {
?>

<div class="userbox">
<div class='userbox_t'>
<div class='userbox_b'>
<div class='userbox_l'>
<div class='userbox_r'>
<div class='userbox_bl'>
<div class='userbox_br'>
<div class='userbox_tl'>
<div class='userbox_tr'>
<?php

	if (@$_SESSION['username'] != NULL) {
		print("Welcome back, " . $_SESSION['username'] . " (<a href='./login.php?act=logout'>Logout</a>)");
		if (@$_SESSION['editaccess'] != NULL) {
			if (in_array(@$_GET['sid'],@$_SESSION['editaccess'])) {
				print("<br /><a href='./edit.php?act=edit&sid=" . $_GET['sid'] . "'>Edit this page</a>");
			}
		
		}
	} else {
		print("You are not logged in. <a href='./login.php'>Login</a> | <a href='./login.php?act=register'>Register</a>");
		echo "<br /><a href='./updates.txt'>Last updated</a>: ";
		print($lastupdated);
	}

?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<div id='maintext'>
<!-- start the rounded corners -->

<div class="t">
<div class="b">
<div class="l">
<div class="r">
<div class="bl">
<div class="br">
<div class="tl">
<div class="tr">