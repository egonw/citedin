<?php
if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from hmdb where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

 print "<div id=\"row\"><div id=\"sourceName\">Hmdb:</div><div id=\"numberInSources\">$num_rows</div><div id=\"details\"><a href=\"\">Details</a></div></div>";

}   
?>
