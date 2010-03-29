<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from iedb where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Iedb: Immune epitope database and analysis resource")
		->setCiteCount($num_rows)
                ->setInfoLink('http://www.iedb.org/')
		->setDetailsLink('http://www.iedb.org/reference_list.php?total_rows=9358'); //TODO: details link

	print ResourceFormatter::getHTML($data);
}   
?>
