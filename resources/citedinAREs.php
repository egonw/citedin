<?php
	require_once("ResourceRegistry.php");

class AREsResource extends ResourceData {
	//TODO: infolink methods etc.
	
	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from AREs where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setInfoLink("http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1")
			->setDetailsLink('http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1'); //TODO: details link     
		return $data;
	}
}

ResourceRegistry::register("AREs", new AREsResource());


 
?>
