<?php
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
   $pmid = $_GET["pmid"];
   include 'connectdb.inc';
   $result = mysql_query("SELECT * from regtransbase where pmid=$pmid");
   $num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName("Regtransbase")
		->setCiteCount($num_rows)
		->setDetailsLink('') //TODO: details link
		->setInfoLink("http://regtransbase.lbl.gov/cgi-bin/regtransbase?page=main");
		
	print ResourceFormatter::getHTML($data);
}   
?>
