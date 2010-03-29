<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from pleiades_genes where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Pleiades genes")
		->setCiteCount($num_rows)
		->setInfoLink("http://www.pleiades.org/")
		->setDetailsLink(''); //TODO: details link

	print ResourceFormatter::getHTML($data);

}   
?>
