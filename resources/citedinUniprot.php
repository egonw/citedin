<?php
if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from uniprot where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

print "<div id=\"row\"><div id=\"sourceName\">Uniprot:</div><div id=\"numberInSources\">$num_rows</div><div id=\"details\"><a href=\"\">Details</a></div></div></div>";

}   
?>
