<!-- bardetails.php template -->


<div id='barpage_top'>
	<div id='barpage_top_left'>
	<span id='bar_name'>var->name</span><br />
	<span id='bar_comments'>var->bar_comments</span><br />
	var->image
	</div>
	<!-- submenu border -->
	<div class="submenu_t">
	<div class="submenu_b">
	<div class="submenu_l">
	<div class="submenu_r">
	<div class="submenu_bl">
	<div class="submenu_br">
	<div class="submenu_tl">
	<div class="submenu_tr">
	<div class='submenu'><p class='submenu_title'>Jump to...</p>
	<a href="#comments">Comments</a><br />
	<a href="#events">Events</a><br />
	<a href="#">Contact</a><br /><br />
	<a href="#">Stock List</a><br />
	<a href="#">Food/Drink Menu</a><br />
	</div>
	</div></div></div></div></div></div></div></div>
	<!-- end submenu border -->
	</div>
	<div id="maininfo">
<p><img src="./images/about.png" alt="About" /></p>
		<p id='crowd'>var->crowd</p>
<div class='barpage_description'>
	<p>var->address<br />var->phonenumber</p>
	<!-- <p>Date added: var->dateadded</p> -->
	<p>Bar Open: var->time_open - var->time_closed</p>
</div>
</div>


<a name="events"></a>
<p><img src="./images/events.png" alt-"Events" /></p>
<div id='events_container'>
var->events
</div>