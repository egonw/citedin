<?php

require_once("ResourceRegistry.php");

class HmdbResource implements Resource {
	function getResourceName() { return "Hmdb: Human Metabolome DataBase"; }
	function getInfoLink() { return "http://www.hmdb.ca/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The Human Metabolome Database (HMDB) is a freely available electronic database containing detailed information about small molecule metabolites found in the human body."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from hmdb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("details.php?db=hmdb&pmid=$pmid&fields=hmdbid,url"); 
	     
		return $data;
	}
}

ResourceRegistry::register("Hmdb", new HmdbResource());

?>
