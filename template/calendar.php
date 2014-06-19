<?php

class calendar_type {
	function mini() {
		
?>


<table width="200">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left">&nbsp;&nbsp;<a href="var->weblocation?month=var->prev_month&year=var->prev_year" style="color:#FFFFFF">Previous</a></td>
<td width="50%" align="right"><a href="var->weblocation?month=var->next_month&year=var->next_year" style="color:#FFFFFF">Next</a>&nbsp;&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong>var->monthNames var->cYear</strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>
var->newweek
var->changeweek
</table>
</td>
</tr>
</table>

<?php
	}
}
?>