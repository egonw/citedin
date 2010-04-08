<?php
require_once("ResourceRegistry.php");

class HNF4Resource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from HNF4 where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("HNF4")
			->setCiteCount($num_rows)
			->setInfoLink("http://www.sladeklab.ucr.edu/")
			->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("HNF4", new HNF4Resource()); 
?>
