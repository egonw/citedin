<?php

require_once("ResourceRegistry.php");

class CutResource implements Resource {
	function getResourceName() { return "Cutdb: Proteolytic Event Database"; }
	function getInfoLink() { return "http://cutdb.burnham.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from cutdb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
                     ->setInfoLink($this->getInfoLink())
		     ->setDetailsLink('http://cutdb.burnham.org/literatures/list'); 
	     
		return $data;
	}
}

ResourceRegistry::register("Cutdb", new CutResource());

?>
