<?php
require_once("ResourceRegistry.php");

class PIDReactomeResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	 include 'connectdb.inc';
	   $result = mysql_query("SELECT * from PID_Reactome where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Nature Pathway interaction database (Reactome)")
			->setCiteCount($num_rows)
	 		->setInfoLink('http://pid.nci.nih.gov/PID/index.shtml')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("PIDReactome", new PIDReactomeResource());
?>
