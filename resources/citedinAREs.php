<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from AREs where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("AREs")
		->setCiteCount($num_rows)
		->setInfoLink("http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1")
		->setDetailsLink('http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1'); //TODO: details link

	print ResourceFormatter::getHTML($data);

}   
?>
