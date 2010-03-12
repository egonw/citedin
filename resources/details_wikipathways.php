<?php
include 'connectdb.inc';
$pmid=$_GET["pmid"];
$sql = "SELECT distinct * from wikipathways where pmid=$pmid";
$url = "http://www.wikipathways.org/index.php/Pathway:";
$result = mysql_query($sql);
print "<h2>Wikipathways</h2>";
while ($row = mysql_fetch_assoc($result)) {
   print "$pmid is mentioned in <a href = \"$url".$row["pwid"]."\" target=\"_blank\">".$row["pwid"]."</a><br>";
}
?>
