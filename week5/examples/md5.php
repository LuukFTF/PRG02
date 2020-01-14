<?php
$wachtwoord = 'h&9 admin1234';

echo $wachtwoord;
echo '<br>';

$hash = md5($wachtwoord);
echo $hash;
?>
