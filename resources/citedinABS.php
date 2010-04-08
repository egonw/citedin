<?php
require_once("ResourceRegistry.php");


class ABSResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from ABS where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName("ABS")
		     ->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("ABS", new ABSResource());  
?>
	
