<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from wikipathways where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("WikiPathways")
		->setCiteCount($num_rows)
		->setInfoLink("http://www.wikipathways.org")
		->setDetailsLink("resources/details_wikipathways?pmid=$pmid");

	print ResourceFormatter::getHTML($data);
}   
?>


