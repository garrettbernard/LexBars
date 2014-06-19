<?php
// index.php

require('./header.php');
require('./calendar.php');
$calendar = NULL;
?>
<p>Note: For the best BETA example, take a look at the <a href='./bardetails.php?sid=1'>Rosebud Bar and Scarlett Lounge</a> entry. It is the 
only one that has any substantial data inputted into the database (and that's only because it happened to 
be bar #1 on my list).</p>
<p>Note: The registration and login system does work. Feel free to try it, but be aware that the database 
is still being developed (which sometimes results in the deletion of entire database tables). No email 
functions exist yet, so registering now won't allow you to receive any special announcements. Sorry!</p>
<p>Note: There are a lot of functions that are not currently active, and a few that are active that won't 
be much longer because they're already in need of updating. Obviously, the website isn't active yet. Our 
hopeful time frame is to have a fully-functional site running prior to September 1. (Those interested in helping 
out with this project should check back in the very near future.)</p>
<p>Here you'll find the low down on Lexington's night life. Looking for a certain drink? We've got the menus. 
In the mood for a certain type of music? We've got the calendars. You can click below and see a list of what 
is happening at every bar in Downtown Lexington, or you can check out the bar's individual page, which includes 
all upcoming events, contact info, and even reviews.</p>
<p>While you're here, take a minute to register (that's all it will take). While unregistered users see everything 
there is to see on this page, registered users do get access to a couple of sweet functions: registered users can 
select individual calendars to be emailed directly to them when updated, they can write reviews, and occasionally 
even be let in on a couple of secret (and awesome) deals.</p>
  <?php
$Calendar->display_details_calendar();
?>

<p>How does this all work?<br />
Every bar listed on this page has access to change and update information, whether that is a menu, hours, contact 
info, or events to name a few. For the bars, this is a fantastic method of free advertising. For everyone else, this 
is a great way to figure out what you want to do over the weekend.</p>
<p>Of course, if you're looking for something new, the info that can be found here offers a great way to find that 
special bar you've never heard of. There are nearly 40 bars to be found here, and most are within a couple of miles 
of each other, and all are located downtown (or within a short walking distance).</p>
<p>As expected, more will come here over time. This site still has pretty lengthy to-do list, and new functions are 
added weekly (of course, some of these you'll see, some you won't). If you register, you'll start getting emails from 
time-to-time letting you know about neat events in the near future. Consider us your one-stop resource for 
after-hours Downtown Lexington.</p>