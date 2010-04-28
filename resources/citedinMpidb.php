<?php

require_once("ResourceRegistry.php");

class MpidbResource implements Resource {
	function getResourceName() { return "Mpidb: The Microbial Protein Interaction Database"; }
	function getInfoLink() { return "http://www.jcvi.org/mpidb/about.php"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The microbial protein interaction database (MPIDB) aims to collect and provide all known physical microbial interactions."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from mpidb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("resources/details_Mpidb.php?pmid=$pmid"); //TODO: details link
	     
		return $data;
	}
}

ResourceRegistry::register("Mpidb", new MpidbResource());

?>
