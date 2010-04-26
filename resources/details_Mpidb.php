<?php
include 'connectdb.inc';
$pmid=$_GET["pmid"];
$sql = "SELECT distinct * from mpidb where pmid=$pmid";
$url = "http://www.jcvi.org/mpidb/experiment.php?interaction_id=";
$result = mysql_query($sql);
print "<h2>MPIDB</h2>";
while ($row = mysql_fetch_assoc($result)) {
   print "$pmid is mentioned in <a href = \"$url".$row["interactionid"]."\" target=\"_blank\">".$row["interactionid"]."</a><br>";
}
?>
