<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from azforum where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Alzgene: Alzheimer Research Forum")
		->setCiteCount($num_rows)
                ->setInfoLink('http://www.alzforum.org/')
		->setDetailsLink('http://www.alzforum.org/pap/powsearch.asp'); //TODO: details link

	print ResourceFormatter::getHTML($data);
}   
?>
