<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from HNF4 where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("HNF4")
		->setCiteCount($num_rows)
		->setInfoLink("http://www.sladeklab.ucr.edu/")
		->setDetailsLink(''); //TODO: details link

	print ResourceFormatter::getHTML($data);

}   
?>
