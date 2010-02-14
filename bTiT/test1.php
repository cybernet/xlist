<?php
$date = new DateTime("2006-12-12 ");
$date->modify("+1 day");
echo $date->format("Y-m-d H:i:s");

$nextWeek = time() + (7 * 24 * 60 * 60);
                   // 7 days; 24 hours; 60 mins; 60secs
echo 'Now:       '. date('Y-m-d') ."\n";
echo 'Next Week: '. date('Y-m-d', $nextWeek) ."\n";
// or using strtotime():
echo 'Next Week: '. date('Y-m-d', strtotime('+1 week')) ."\n";
echo 'Next Week: '. date('Y-m-d', strtotime('+24 hours')) ."\n";
?>
