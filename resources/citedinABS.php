<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from ABS where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("HNF4")
		->setCiteCount($num_rows)
		->setInfoLink("http://genome.imim.es/datasets/abs2005")
		->setDetailsLink(''); //TODO: details link

	print ResourceFormatter::getHTML($data);

}   
?>
