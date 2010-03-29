<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from hmdb where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Hmdb")
		->setCiteCount($num_rows)
                ->setInfoLink('http://www.hmdb.ca/')
		->setDetailsLink(''); //TODO: details link

	print ResourceFormatter::getHTML($data);
}   
?>
