<?php
require_once("ResourceRegistry.php");

class IedbResource implements Resource {
	function getResourceName() { return "Iedb: Immune epitope database and analysis resource"; }
	function getInfoLink() { return "http://www.iedb.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The IEDB contains data related to antibody and T cell epitopes for humans, non-human primates, rodents, and other animal species."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from iedb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink('http://www.iedb.org/reference_list.php?total_rows=9358'); 

		return $data;
	}
}

ResourceRegistry::register("Iedb", new IedbResource());

?>
