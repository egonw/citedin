<?php
if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from wikipathways where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

   print "<div id=\"row\"><div id=\"sourceName\"><a href = \"http://www.wikipathways.org\">WikiPathways</a>:</div><div id=\"numberInSources\">$num_rows</div><div id=\"details\"><a href=\"resources/details_wikipathways?pmid=$pmid\" onclick=\"return hs.htmlExpand(this, {objectType: 'iframe' } )\">Details</a></div></div>";

}   
?>


