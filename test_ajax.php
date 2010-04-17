<?php
exec("curl \"http://en.wikipedia.org/w/api.php?format=xml&action=query&list=search&srsearch=15489334\"", $printarray);
print $printarray[0];
?>
