<?php
require_once("ResourceRegistry.php");

class PIDReactomeResource implements Resource {
	function getResourceName() { return "Nature Pathway interaction database (Reactome)"; }
	function getInfoLink() { return "http://www.reactome.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "REACTOME is a free, online, open-source, curated pathway database encompassing many areas of human biology. Information is authored by expert biological researchers, maintained by the Reactome editorial staff and cross-referenced to a wide range of standard biological databases."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from PID_Reactome where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("PIDReactome", new PIDReactomeResource());
?>
