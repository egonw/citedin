<?php
include 'connectdb.inc';
$table=$_GET["table"];
$pmid=$_GET["pmid"];
$resourceId = $_GET["resourceid"];
$url=urldecode($_GET["url"]);
$sql = "SELECT * from $table where pmid=$pmid";

$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) {
   print "$pmid is mentioned in <a href = \"$url$$resourceId\" target'\"_new\">".$row[$resourceId]."</a><br>";
}
?>
