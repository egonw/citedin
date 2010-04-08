<?php
require_once("ResourceRegistry.php");

class OregannoResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from oregano where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Oreganno")
			->setCiteCount($num_rows)
			->setInfoLink("http://www.oreganno.org/oregano/")
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("Oreganno", new OregannoResource()); 
?>
