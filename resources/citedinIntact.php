<?php
require_once("ResourceRegistry.php");

class IntactResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from intact where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Intact")
			->setCiteCount($num_rows)
			->setInfoLink('http://www.ebi.ac.uk/intact/main.xhtml')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("Intact", new IntactResource());  
?>
