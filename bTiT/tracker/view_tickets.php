<?php
require_once("include/config.php");
require_once("include/functions.php");

dbconn();

standardheader(SOLD_TICKETS);
block_begin(SOLD_TICKETS);
?>

<table align="center" width="80%" class="lista">
<tr>
  <td class="header"><?php print ID; ?></td>
  <td class="header"><?php print USERNAME; ?></td>
  <td class="header"><?php print NUMBER_OF_TICKETS; ?></td>
  <td class="header"><?php print UPLOADED; ?></td>
  <td class="header"><?php print DOWNLOADED; ?></td>
  </tr>
<?php

$sql = mysql_query("SELECT user FROM tickets") or die (mysql_error());
if(mysql_num_rows($sql) == 0){
	print("<tr><td class=lista align=center colspan=5>".NO_TICKET_SOLD."</td></tr>");
}
else{
	while ($myrow = mysql_fetch_assoc($sql))
		$user[] = $myrow["user"];
		$user = array_values(array_unique($user));
		for ($i = 0; $i < sizeof($user); $i++)
			$tickets[] = mysql_num_rows(mysql_query("SELECT * FROM tickets WHERE user=$user[$i]"));
			for ($i = 0; $i < sizeof($user); $i++)
				$username[] = end(mysql_fetch_row(mysql_query("SELECT username FROM users WHERE id=$user[$i]")));
				for ($i = 0; $i < sizeof($user); $i++)
					$uploaded[] = makesize(end(mysql_fetch_row(mysql_query("SELECT uploaded FROM users WHERE id=$user[$i]"))));
					for ($i = 0; $i < sizeof($user); $i++)
						$downloaded[] = makesize(end(mysql_fetch_row(mysql_query("SELECT downloaded FROM users WHERE id=$user[$i]"))));
						for ($i = 0; $i < sizeof($user); $i++)
							echo "<tr><td class=lista>" . ($i + 1) . "</td><td class=lista>$username[$i]</td><td class=lista>$tickets[$i]</td><td class=lista>$uploaded[$i]</td><td class=lista>$downloaded[$i]</td></tr>";
}
?>

</table>
<?PHP
block_end();
stdfoot();
die;
?>