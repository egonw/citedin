<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from cosmic where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Cosmic: Catalogue Of Somatic Mutations In Cancer")
		->setCiteCount($num_rows)
                ->setInfoLink('http://www.sanger.ac.uk/genetics/CGP/cosmic/')
		->setDetailsLink(''); //TODO: details link

	print ResourceFormatter::getHTML($data);
}   
?>
