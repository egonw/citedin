<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from CTDatabase where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("CTDatabase: Cancer-Testis Database")
		->setCiteCount($num_rows)
                ->setInfoLink('http://www.cta.lncc.br/')
		->setDetailsLink('http://www.cta.lncc.br/index.php?id=4'); //TODO: details link

	print ResourceFormatter::getHTML($data);
}   
?>
