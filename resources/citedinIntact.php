<?php
require_once("ResourceRegistry.php");

class IntactResource implements Resource {
	function getResourceName() { return "Intact"; }
	function getInfoLink() { return "http://www.ebi.ac.uk/intact/main.xhtml"; }
	function getResourceType() { return "Published data"; }
	function getResourceDescription() { return "IntAct provides a freely available, open source database system and analysis tools for protein interaction data. All interactions are derived from literature curation or direct user submissions and are freely available."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from intact where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Intact", new IntactResource());

?>
