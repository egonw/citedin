<?php
require_once("ResourceRegistry.php");

class PIDNCIResource implements Resource {
	function getResourceName() { return "Nature Pathway interaction database (NCI)"; }
	function getInfoLink() { return "http://pid.nci.nih.gov/PID/index.shtml"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The Pathway Interaction Database is a highly-structured, curated collection of information about known biomolecular interactions and key cellular processes assembled into signaling pathways. It is a collaborative project between the US National Cancer Institute (NCI) and Nature Publishing Group (NPG), and is an open access online resource."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from NCI where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("PIDNCI", new PIDNCIResource());

?>
